<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\DailyUsageLogModel;

/**
 * Class UsageService
 * 
 * Central Trial Guard & Task Usage Middleware.
 * Enforces:
 * - 15-Day Free Trial expiration checking
 * - 5 Tasks/Day limit for trial users
 * - Unlimited task execution for Pro and Agency subscribers
 */
class UsageService
{
    public const DAILY_TRIAL_LIMIT = 5;
    public const TRIAL_DURATION_DAYS = 15;

    protected UserModel $userModel;
    protected DailyUsageLogModel $usageModel;

    public function __construct()
    {
        $this->userModel  = new UserModel();
        $this->usageModel = new DailyUsageLogModel();
    }

    /**
     * Check if a user is allowed to execute a task (e.g. SEO audit, review sync, dunning trigger).
     * If permitted and user is on 'trial', increments the daily usage counter.
     *
     * @param int    $userId
     * @param string $taskType 'seo_audit'|'dunning_recovery'|'review_sync'|'accessibility_scan'
     * @param bool   $incrementOnSuccess Whether to auto-increment usage count
     * @return array ['allowed' => bool, 'message' => string, 'plan_type' => string, 'used_today' => int, ...]
     */
    public function canExecuteTask(int $userId, string $taskType = 'seo_audit', bool $incrementOnSuccess = true): array
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return [
                'allowed'    => false,
                'message'    => 'User account not found.',
                'plan_type'  => 'unknown',
                'days_left'  => 0,
                'used_today' => 0,
                'limit'      => self::DAILY_TRIAL_LIMIT,
                'is_expired' => true,
            ];
        }

        $planType = $user['plan_type'];

        // a) Pro or Agency Subscribers: Always unlimited access
        if (in_array($planType, ['pro', 'agency'], true)) {
            if ($incrementOnSuccess) {
                $this->usageModel->incrementUsage($userId, $taskType);
            }

            return [
                'allowed'    => true,
                'message'    => 'Unlimited plan active (' . ucfirst($planType) . ').',
                'plan_type'  => $planType,
                'days_left'  => null,
                'used_today' => $this->usageModel->getTodayCount($userId),
                'limit'      => null, // Unlimited
                'is_expired' => false,
            ];
        }

        // b) Check if already expired
        if ($planType === 'expired') {
            return [
                'allowed'    => false,
                'message'    => 'Your 15-day free trial has ended. Upgrade to Pro for unlimited access.',
                'plan_type'  => 'expired',
                'days_left'  => 0,
                'used_today' => $this->usageModel->getTodayCount($userId),
                'limit'      => self::DAILY_TRIAL_LIMIT,
                'is_expired' => true,
            ];
        }

        // c) Trial Plan Check: Verify if trial_ends_at is in the past
        $now = time();
        $trialEnd = !empty($user['trial_ends_at']) ? strtotime($user['trial_ends_at']) : 0;

        if ($trialEnd > 0 && $now > $trialEnd) {
            // Update user status to expired
            $this->userModel->update($userId, [
                'plan_type' => 'expired',
            ]);

            // Sync session if currently active
            if (session()->get('user_id') == $userId) {
                session()->set('plan_type', 'expired');
            }

            return [
                'allowed'    => false,
                'message'    => 'Your 15-day free trial has ended. Upgrade to Pro for unlimited access.',
                'plan_type'  => 'expired',
                'days_left'  => 0,
                'used_today' => $this->usageModel->getTodayCount($userId),
                'limit'      => self::DAILY_TRIAL_LIMIT,
                'is_expired' => true,
            ];
        }

        // d) Daily Task Limit Check for Today
        $usedToday = $this->usageModel->getTodayCount($userId);

        if ($usedToday >= self::DAILY_TRIAL_LIMIT) {
            return [
                'allowed'    => false,
                'message'    => "Daily limit reached (" . self::DAILY_TRIAL_LIMIT . "/" . self::DAILY_TRIAL_LIMIT . " free tasks used today). Upgrade to Pro for unlimited tasks or wait until tomorrow.",
                'plan_type'  => 'trial',
                'days_left'  => max(0, (int) ceil(($trialEnd - $now) / 86400)),
                'used_today' => $usedToday,
                'limit'      => self::DAILY_TRIAL_LIMIT,
                'is_expired' => false,
            ];
        }

        // Increment task counter if allowed and requested
        if ($incrementOnSuccess) {
            $usedToday = $this->usageModel->incrementUsage($userId, $taskType);
        }

        $daysLeft = max(0, (int) ceil(($trialEnd - $now) / 86400));

        return [
            'allowed'    => true,
            'message'    => "Task executed ({$usedToday}/" . self::DAILY_TRIAL_LIMIT . " tasks used today).",
            'plan_type'  => 'trial',
            'days_left'  => $daysLeft,
            'used_today' => $usedToday,
            'limit'      => self::DAILY_TRIAL_LIMIT,
            'is_expired' => false,
        ];
    }

    /**
     * Retrieve current trial & quota metrics for dashboard presentation
     *
     * @param int $userId
     * @return array
     */
    public function getTrialStatus(int $userId): array
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return [
                'plan_type'     => 'trial',
                'is_unlimited'  => false,
                'is_expired'    => true,
                'days_left'     => 0,
                'used_today'    => 0,
                'limit'         => self::DAILY_TRIAL_LIMIT,
                'percent_used'  => 0,
                'trial_ends_at' => null,
            ];
        }

        $planType = $user['plan_type'];
        if (in_array($planType, ['pro', 'agency'], true)) {
            return [
                'plan_type'     => $planType,
                'is_unlimited'  => true,
                'is_expired'    => false,
                'days_left'     => null,
                'used_today'    => $this->usageModel->getTodayCount($userId),
                'limit'         => null,
                'percent_used'  => 0,
                'trial_ends_at' => null,
            ];
        }

        $now = time();
        $trialEnd = !empty($user['trial_ends_at']) ? strtotime($user['trial_ends_at']) : 0;
        $isExpired = ($planType === 'expired') || ($trialEnd > 0 && $now > $trialEnd);

        if ($isExpired && $planType !== 'expired') {
            $this->userModel->update($userId, ['plan_type' => 'expired']);
            $planType = 'expired';
            if (session()->get('user_id') == $userId) {
                session()->set('plan_type', 'expired');
            }
        }

        $daysLeft = $isExpired ? 0 : max(0, (int) ceil(($trialEnd - $now) / 86400));
        $usedToday = $this->usageModel->getTodayCount($userId);
        $percentUsed = min(100, round(($usedToday / self::DAILY_TRIAL_LIMIT) * 100));

        return [
            'plan_type'     => $planType,
            'is_unlimited'  => false,
            'is_expired'    => $isExpired,
            'days_left'     => $daysLeft,
            'used_today'    => $usedToday,
            'limit'         => self::DAILY_TRIAL_LIMIT,
            'percent_used'  => $percentUsed,
            'trial_ends_at' => $user['trial_ends_at'],
        ];
    }
}
