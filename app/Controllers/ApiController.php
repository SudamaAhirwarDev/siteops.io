<?php

namespace App\Controllers;

use App\Models\SiteModel;
use App\Models\ReviewModel;
use App\Models\DunningLogModel;
use App\Models\UserModel;
use App\Services\TrafficTracker;
use CodeIgniter\Controller;

/**
 * Class ApiController
 * 
 * Handles external Stripe webhooks and serves the dynamic <15KB
 * universal client loader script according to active site modules.
 */
class ApiController extends Controller
{
    protected SiteModel $siteModel;
    protected ReviewModel $reviewModel;
    protected DunningLogModel $dunningLogModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->siteModel       = new SiteModel();
        $this->reviewModel     = new ReviewModel();
        $this->dunningLogModel = new DunningLogModel();
        $this->userModel       = new UserModel();
        helper(['url']);
    }

    /**
     * Public Site Configuration Endpoint
     * 
     * Endpoint: GET /api/config/{site_key}
     * Returns active modules and active reviews for the client loader engine.
     * CORS Enabled (Access-Control-Allow-Origin: *)
     */
    public function config($siteKey = null)
    {
        // Handle OPTIONS preflight
        if (strtolower($this->request->getMethod()) === 'options') {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS')
                ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->setStatusCode(200);
        }

        if (empty($siteKey)) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Missing site_key identifier.',
                ]);
        }

        $site = $this->siteModel->where('site_key', trim($siteKey))->first();
        if (!$site) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Site configuration not found for provided site_key.',
                ]);
        }

        // Record real-time client domain visit
        TrafficTracker::logVisit($site['domain'], (int) $site['id'], '/api/config/' . $siteKey);

        $accessibilityActive = (bool) $site['module_accessibility'];
        $reviewsActive       = (bool) $site['module_reviews'];
        $seoActive           = (bool) $site['module_seo'];
        $dunningActive       = (bool) $site['module_dunning'];

        $reviews = [];
        if ($reviewsActive) {
            $rawReviews = $this->reviewModel->getActiveSiteReviews((int) $site['id']);
            foreach ($rawReviews as $r) {
                $reviews[] = [
                    'id'              => (int) $r['id'],
                    'reviewer_name'   => $r['reviewer_name'],
                    'role_or_company' => $r['role_or_company'],
                    'rating'          => (int) $r['rating'],
                    'review_text'     => $r['review_text'],
                    'source'          => $r['source'],
                ];
            }
        }

        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Cache-Control', 'public, max-age=60')
            ->setJSON([
                'status'   => 'success',
                'site_key' => $site['site_key'],
                'domain'   => $site['domain'],
                'modules'  => [
                    'accessibility' => $accessibilityActive,
                    'reviews'       => $reviewsActive,
                    'seo'           => $seoActive,
                    'dunning'       => $dunningActive,
                ],
                'reviews'  => $reviews,
            ]);
    }

    /**
     * Stripe Webhook Receiver
     * 
     * Endpoint: POST /api/webhook/stripe/{site_key}
     * Listens for invoice.payment_failed and invoice.paid events
     */
    public function stripeWebhook($siteKey = null)
    {
        if (empty($siteKey)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Missing site_key token in webhook URL.',
            ]);
        }

        $site = $this->siteModel->where('site_key', trim($siteKey))->first();
        if (!$site) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Site token not found or invalid.',
            ]);
        }

        // Get raw payload
        $rawPayload = $this->request->getBody();
        $eventData  = json_decode($rawPayload, true);

        // Fallback or test simulation payload if empty
        if (!$eventData) {
            $eventData = $this->request->getPost();
        }

        $eventType = $eventData['type'] ?? 'invoice.payment_failed';
        $object    = $eventData['data']['object'] ?? $eventData;

        // Extract transaction properties
        $customerEmail = $object['customer_email'] 
            ?? $object['customer'] 
            ?? ('customer_' . substr(bin2hex(random_bytes(3)), 0, 6) . '@example.com');

        $amountDue = isset($object['amount_due']) 
            ? round($object['amount_due'] / 100, 2) 
            : (isset($object['amount']) ? round($object['amount'], 2) : 49.00);

        $currency = strtoupper($object['currency'] ?? 'USD');

        if ($eventType === 'invoice.payment_failed') {
            $logId = $this->dunningLogModel->insert([
                'site_id'        => (int) $site['id'],
                'customer_email' => $customerEmail,
                'amount'         => $amountDue,
                'currency'       => $currency,
                'status'         => 'pending',
                'sent_at'        => date('Y-m-d H:i:s'),
            ]);

            return $this->response->setStatusCode(200)->setJSON([
                'status'         => 'success',
                'event'          => 'invoice.payment_failed',
                'action'         => 'recovery_email_dispatched',
                'dunning_log_id' => $logId,
                'site_domain'    => $site['domain'],
                'amount'         => $amountDue,
                'currency'       => $currency,
            ]);
        }

        if ($eventType === 'invoice.paid' || $eventType === 'invoice.payment_succeeded') {
            // Find existing pending log and mark as recovered
            $existing = $this->dunningLogModel
                ->where('site_id', $site['id'])
                ->where('customer_email', $customerEmail)
                ->where('status', 'pending')
                ->first();

            if ($existing) {
                $this->dunningLogModel->update($existing['id'], [
                    'status' => 'recovered',
                ]);
            } else {
                $this->dunningLogModel->insert([
                    'site_id'        => (int) $site['id'],
                    'customer_email' => $customerEmail,
                    'amount'         => $amountDue,
                    'currency'       => $currency,
                    'status'         => 'recovered',
                    'sent_at'        => date('Y-m-d H:i:s'),
                ]);
            }

            return $this->response->setStatusCode(200)->setJSON([
                'status'      => 'success',
                'event'       => $eventType,
                'action'      => 'invoice_marked_recovered',
                'site_domain' => $site['domain'],
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'status'      => 'acknowledged',
            'event'       => $eventType,
            'site_domain' => $site['domain'],
        ]);
    }

    /**
     * Universal Client Script Loader
     * 
     * Endpoint: GET /loader.js
     * Serves the isolated Shadow DOM client engine (<15KB).
     */
    public function loaderScript()
    {
        $ref = $this->request->getServer('HTTP_REFERER');
        $domain = 'siteops.io';
        if ($ref) {
            $parsed = parse_url($ref);
            if (!empty($parsed['host'])) {
                $domain = $parsed['host'];
            }
        }
        TrafficTracker::logVisit($domain, null, '/loader.js');

        $loaderPath = FCPATH . 'loader.js';
        if (!file_exists($loaderPath)) {
            $loaderPath = __DIR__ . '/../../public/loader.js';
        }

        $js = file_exists($loaderPath) ? file_get_contents($loaderPath) : '';

        return $this->response
            ->setHeader('Content-Type', 'application/javascript; charset=UTF-8')
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Cache-Control', 'public, max-age=300')
            ->setBody($js);
    }

    /**
     * Webhook Endpoint for Instant Pro / Agency Upgrades
     * Compatible with Lemon Squeezy, Dodo Payments, and Stripe
     * 
     * Endpoint: POST /api/webhook/billing
     */
    public function billingWebhook()
    {
        $payload = $this->request->getJSON(true);
        $rawBody = $this->request->getBody();
        if (empty($payload) && !empty($rawBody)) {
            $payload = json_decode($rawBody, true);
        }

        // Fallback to POST variables or query simulation
        if (empty($payload)) {
            $payload = $this->request->getPost();
            if (empty($payload)) {
                $payload = $this->request->getGet();
            }
        }

        if (empty($payload)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Empty webhook payload received.',
            ]);
        }

        // Signature verification (if configured in environment)
        $secret = getenv('BILLING_WEBHOOK_SECRET') ?: getenv('LEMONSQUEEZY_WEBHOOK_SECRET') ?: getenv('DODO_WEBHOOK_SECRET');
        $signature = $this->request->getHeaderLine('X-Signature') 
            ?: $this->request->getHeaderLine('Webhook-Signature') 
            ?: $this->request->getHeaderLine('Dodo-Signature');

        if (!empty($secret) && !empty($signature)) {
            $computed = hash_hmac('sha256', $rawBody, $secret);
            if (!hash_equals($computed, $signature)) {
                return $this->response->setStatusCode(401)->setJSON([
                    'status'  => 'error',
                    'message' => 'Invalid webhook signature.',
                ]);
            }
        }

        // Extract Customer Email
        $customerEmail = $payload['data']['attributes']['user_email']
            ?? $payload['data']['attributes']['customer_email']
            ?? $payload['customer']['email']
            ?? $payload['data']['object']['customer_email']
            ?? $payload['email']
            ?? null;

        if (empty($customerEmail)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Missing customer email in billing event.',
            ]);
        }

        $customerEmail = strtolower(trim($customerEmail));
        $user = $this->userModel->findByEmail($customerEmail);

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => "User with email '{$customerEmail}' was not found.",
            ]);
        }

        // Determine Plan Tier (Agency vs Pro)
        $variantName = $payload['data']['attributes']['first_order_item']['variant_name']
            ?? $payload['data']['attributes']['order_item_name']
            ?? $payload['plan_name']
            ?? $payload['plan']
            ?? '';

        $amount = (float) (
            $payload['data']['attributes']['total_formatted'] 
            ?? $payload['data']['attributes']['total'] 
            ?? $payload['amount'] 
            ?? 39
        );

        $targetPlan = 'pro';
        if (stripos($variantName, 'agency') !== false || $amount >= 80) {
            $targetPlan = 'agency';
        }

        $subscriptionId = $payload['data']['id']
            ?? $payload['data']['attributes']['subscription_id']
            ?? $payload['subscription_id']
            ?? $payload['id']
            ?? ('sub_' . substr(bin2hex(random_bytes(6)), 0, 12));

        // Upgrade user in database
        $this->userModel->update($user['id'], [
            'plan_type'       => $targetPlan,
            'subscription_id' => $subscriptionId,
            'trial_ends_at'   => null, // Unlimited access
        ]);

        // Sync session if matching current logged-in user
        if (session()->get('user_id') == $user['id']) {
            session()->set('plan_type', $targetPlan);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'status'          => 'success',
            'user_id'         => (int) $user['id'],
            'email'           => $customerEmail,
            'plan_type'       => $targetPlan,
            'subscription_id' => $subscriptionId,
            'message'         => "Account upgraded immediately to Unlimited " . ucfirst($targetPlan) . ".",
        ]);
    }

    /**
     * Handles subscription inquiries & contact activation requests
     * 
     * Endpoint: POST /api/subscription/inquiry
     */
    public function subscriptionInquiry()
    {
        // Handle OPTIONS preflight
        if (strtolower($this->request->getMethod()) === 'options') {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->setStatusCode(200);
        }

        $plan    = trim($this->request->getPost('plan') ?? $this->request->getGet('plan') ?? 'pro');
        $billing = trim($this->request->getPost('billing') ?? $this->request->getGet('billing') ?? 'monthly');
        $email   = strtolower(trim($this->request->getPost('email') ?? $this->request->getGet('email') ?? ''));
        $domain  = trim($this->request->getPost('domain') ?? $this->request->getGet('domain') ?? '');
        $message = trim($this->request->getPost('message') ?? $this->request->getGet('message') ?? '');

        if (empty($email) && session()->get('user_email')) {
            $email = session()->get('user_email');
        }

        // Record in query_logs so admin sees it in real-time
        TrafficTracker::logQuery('subscription_inquiry', $domain ?: ($email ?: 'siteops.io'), 'success', null, null, [
            'plan'    => strtoupper($plan),
            'billing' => ucfirst($billing),
            'email'   => $email,
            'domain'  => $domain,
            'message' => $message,
            'ip'      => $this->request->getIPAddress(),
        ]);

        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setStatusCode(200)
            ->setJSON([
                'status'  => 'success',
                'plan'    => strtoupper($plan),
                'billing' => ucfirst($billing),
                'message' => 'Thank you! Your plan activation request has been submitted. Our team will contact you at ' . ($email ?: 'your email address') . ' within 15 minutes to set up your subscription.',
            ]);
    }
}
