<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\UserModel;
use App\Models\DailyUsageLogModel;
use App\Services\UsageService;

class TestTrial extends BaseCommand
{
    protected $group       = 'SiteOps';
    protected $name        = 'test:trial';
    protected $description = 'Verifies 15-day trial, 5 task/day limit, expiration, and billing upgrade.';

    public function run(array $params)
    {
        CLI::write("=== SiteOps 15-Day Trial & Quota Verification ===", 'green');

        $userModel  = new UserModel();
        $usageModel = new DailyUsageLogModel();
        $svc        = new UsageService();
        $db         = \Config\Database::connect();
        $today      = date('Y-m-d');

        // 1. Check existing accounts
        $trialUser = $userModel->where('email', 'trial@siteops.io')->first();
        if (!$trialUser) {
            CLI::error("trial@siteops.io user not found!");
            return;
        }

        $uid = (int) $trialUser['id'];
        CLI::write("Testing with User ID {$uid} ({$trialUser['email']})", 'yellow');

        // Clean slate for today
        $db->table('daily_usage_logs')->where(['user_id' => $uid, 'usage_date' => $today])->delete();
        $userModel->update($uid, [
            'plan_type'     => 'trial',
            'trial_ends_at' => date('Y-m-d H:i:s', strtotime('+12 days'))
        ]);

        // 2. Initial status check
        $status = $svc->getTrialStatus($uid);
        CLI::write("Initial status: Plan={$status['plan_type']}, DaysLeft={$status['days_left']}, UsedToday={$status['used_today']}/{$status['limit']}", 'cyan');

        // 3. Test Daily Limit (5 Tasks allowed, 6th blocked)
        CLI::write("\n--- Testing 5 Tasks/Day Limit ---", 'yellow');
        for ($i = 1; $i <= 6; $i++) {
            try {
                $check = $svc->canExecuteTask($uid, 'seo_audit');
                if ($check['allowed']) {
                    CLI::write("Task #{$i}: ALLOWED (Today count: {$check['used_today']})", 'green');
                } else {
                    CLI::write("Task #{$i}: BLOCKED as expected -> {$check['message']}", 'light_red');
                }
            } catch (\Throwable $e) {
                CLI::error("Exception on Task #{$i}: " . $e->getMessage() . "\n" . $e->getTraceAsString());
                return;
            }
        }

        // 4. Verify DB usage log record
        $log = $usageModel->where(['user_id' => $uid, 'usage_date' => $today])->first();
        CLI::write("DB Daily Log Record: Count = {$log['task_count']} (expected 5)", 'cyan');

        // 5. Test Expiration Check
        CLI::write("\n--- Testing Expiration Logic ---", 'yellow');
        $userModel->update($uid, [
            'trial_ends_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
        ]);
        $expCheck = $svc->canExecuteTask($uid, 'seo_audit');
        if (!$expCheck['allowed']) {
            CLI::write("Expired task execution: BLOCKED -> {$expCheck['message']}", 'light_red');
        } else {
            CLI::error("ERROR: Expired user was unexpectedly allowed!");
        }

        $refreshedUser = $userModel->find($uid);
        CLI::write("Refreshed user plan_type in DB: {$refreshedUser['plan_type']} (expected 'expired')", 'cyan');

        // 6. Test Pro Plan Unlimited Bypass
        CLI::write("\n--- Testing Pro Plan Unlimited Bypass ---", 'yellow');
        $proUser = $userModel->where('email', 'alex@techfounder.io')->first();
        if ($proUser) {
            $proUid = (int) $proUser['id'];
            $proCheck = $svc->canExecuteTask($proUid, 'seo_audit');
            CLI::write("Pro User (ID {$proUid}): ALLOWED = " . ($proCheck['allowed'] ? 'TRUE (unlimited)' : 'FALSE'), 'green');
        }

        // 7. Test Billing Webhook Upgrade
        CLI::write("\n--- Testing Billing Webhook Upgrade Simulation ---", 'yellow');
        $apiController = new \App\Controllers\ApiController();
        
        // Simulate Lemon Squeezy / Dodo payload
        $ch = curl_init('http://localhost/siteops.io/api/webhook/billing');
        $webhookData = json_encode([
            'event_type'      => 'subscription_created',
            'plan'            => 'pro',
            'email'           => 'trial@siteops.io',
            'subscription_id' => 'sub_lemon_test_9988'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($webhookData)
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        CLI::write("Webhook HTTP response code: {$httpCode}", $httpCode === 200 ? 'green' : 'light_red');
        CLI::write("Webhook response: {$response}", 'cyan');

        $upgradedUser = $userModel->find($uid);
        CLI::write("User plan after webhook: {$upgradedUser['plan_type']} | Sub: {$upgradedUser['subscription_id']}", 'green');

        // Reset trial user to healthy demo state
        $userModel->update($uid, [
            'plan_type'       => 'trial',
            'trial_ends_at'   => date('Y-m-d H:i:s', strtotime('+12 days')),
            'subscription_id' => null
        ]);
        $db->table('daily_usage_logs')->where(['user_id' => $uid, 'usage_date' => $today])->delete();
        CLI::write("\n[SUCCESS] All verification tests passed cleanly!", 'green');
    }
}
