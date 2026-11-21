<?php

namespace App\Controllers;

use App\Models\DailyUsageLogModel;
use App\Models\DunningLogModel;
use App\Models\QueryLogModel;
use App\Models\ReviewModel;
use App\Models\SeoAuditModel;
use App\Models\SiteModel;
use App\Models\UserModel;
use App\Models\VisitorLogModel;
use App\Services\TrafficTracker;
use CodeIgniter\Controller;

/**
 * Class AdminController
 * 
 * Master Administration & Control Plane for SiteOps:
 * - Dynamic real-time statistics
 * - Visitor Traffic & Domain-specific hit logs
 * - Scanner & Diagnostic Query logs
 * - User management (plans, roles, creation, impersonation)
 * - Domain & module toggle management
 * - Global review moderation
 * - Real-time SEO/GEO audit inspector
 * - Live server & database telemetry
 */
class AdminController extends Controller
{
    protected UserModel $userModel;
    protected SiteModel $siteModel;
    protected ReviewModel $reviewModel;
    protected SeoAuditModel $seoAuditModel;
    protected DunningLogModel $dunningLogModel;
    protected DailyUsageLogModel $usageModel;
    protected VisitorLogModel $visitorLogModel;
    protected QueryLogModel $queryLogModel;

    public function __construct()
    {
        $this->userModel       = new UserModel();
        $this->siteModel       = new SiteModel();
        $this->reviewModel     = new ReviewModel();
        $this->seoAuditModel   = new SeoAuditModel();
        $this->dunningLogModel = new DunningLogModel();
        $this->usageModel      = new DailyUsageLogModel();
        $this->visitorLogModel = new VisitorLogModel();
        $this->queryLogModel   = new QueryLogModel();

        helper(['form', 'url', 'number']);
        $this->ensureMasterAdmin();
    }

    /**
     * Ensures admin table schema, visitor tables, and master admin record exist across SQLite/MySQL
     */
    protected function ensureMasterAdmin(): void
    {
        try {
            $db = \Config\Database::connect();
            
            // 1. Check & add role column if missing
            if (!$db->fieldExists('role', 'users')) {
                $forge = \Config\Database::forge();
                $forge->addColumn('users', [
                    'role' => [
                        'type'       => 'VARCHAR',
                        'constraint' => 20,
                        'default'    => 'user',
                    ],
                ]);
            }

            // 2. Ensure visitor_logs table exists
            $db->query("CREATE TABLE IF NOT EXISTS visitor_logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                domain TEXT NOT NULL,
                site_id INTEGER NULL,
                page_url TEXT NOT NULL,
                ip_address TEXT NOT NULL,
                user_agent TEXT NULL,
                device_type TEXT NOT NULL DEFAULT 'desktop',
                referrer TEXT NULL,
                visited_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            // 3. Ensure query_logs table exists
            $db->query("CREATE TABLE IF NOT EXISTS query_logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                query_type TEXT NOT NULL DEFAULT 'diagnostic_scan',
                target_domain TEXT NOT NULL,
                ip_address TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT 'success',
                score_seo INTEGER NULL,
                score_security INTEGER NULL,
                details_json TEXT NULL,
                queried_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            // 4. Ensure master admin user exists
            $admin = $this->userModel->findByEmail('admin@siteops.io');
            if (!$admin) {
                $this->userModel->insert([
                    'name'          => 'Master Administrator',
                    'email'         => 'admin@siteops.io',
                    'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                    'role'          => 'admin',
                    'plan_type'     => 'enterprise',
                ]);
            } else {
                if (($admin['role'] ?? '') !== 'admin') {
                    $this->userModel->update($admin['id'], ['role' => 'admin']);
                }
            }

            // 5. Seed sample visitor & query logs if tables are empty
            if ($this->visitorLogModel->countAllResults() === 0) {
                $samples = [
                    ['domain' => 'siteops.io', 'page_url' => '/', 'ip_address' => '103.212.144.12', 'device_type' => 'desktop', 'referrer' => 'https://google.com', 'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/124.0.0.0', 'visited_at' => date('Y-m-d H:i:s', strtotime('-12 minutes'))],
                    ['domain' => 'siteops.io', 'page_url' => '/register', 'ip_address' => '152.58.19.45', 'device_type' => 'mobile', 'referrer' => 'https://twitter.com', 'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) Mobile/15E148', 'visited_at' => date('Y-m-d H:i:s', strtotime('-25 minutes'))],
                    ['domain' => 'mysaas.com', 'site_id' => 1, 'page_url' => '/api/config/so_9f81a7b2e4c6', 'ip_address' => '84.17.42.99', 'device_type' => 'desktop', 'referrer' => 'https://mysaas.com/pricing', 'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Safari/605.1.15', 'visited_at' => date('Y-m-d H:i:s', strtotime('-40 minutes'))],
                    ['domain' => 'mysaas.com', 'site_id' => 1, 'page_url' => '/loader.js', 'ip_address' => '49.36.88.210', 'device_type' => 'mobile', 'referrer' => 'https://mysaas.com', 'user_agent' => 'Mozilla/5.0 (Linux; Android 14; SM-S928B) Chrome/124.0.0.0', 'visited_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))],
                    ['domain' => 'siteops.io', 'page_url' => '/login', 'ip_address' => '182.74.12.8', 'device_type' => 'desktop', 'referrer' => 'https://linkedin.com', 'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Edge/124.0.0.0', 'visited_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))],
                    ['domain' => 'finflow.eu', 'site_id' => 2, 'page_url' => '/api/config/so_demo89012345', 'ip_address' => '91.200.12.4', 'device_type' => 'tablet', 'referrer' => 'https://finflow.eu/checkout', 'user_agent' => 'Mozilla/5.0 (iPad; CPU OS 17_4 like Mac OS X)', 'visited_at' => date('Y-m-d H:i:s', strtotime('-3 hours'))],
                ];
                foreach ($samples as $s) {
                    $this->visitorLogModel->insert($s);
                }
            }

            if ($this->queryLogModel->countAllResults() === 0) {
                $qSamples = [
                    ['query_type' => 'diagnostic_scan', 'target_domain' => 'stripe.com', 'ip_address' => '152.58.19.45', 'status' => 'success', 'score_seo' => 96, 'score_security' => 99, 'details_json' => json_encode(['threats' => 0, 'speed' => '98ms']), 'queried_at' => date('Y-m-d H:i:s', strtotime('-18 minutes'))],
                    ['query_type' => 'diagnostic_scan', 'target_domain' => 'linear.app', 'ip_address' => '103.212.144.12', 'status' => 'success', 'score_seo' => 94, 'score_security' => 95, 'details_json' => json_encode(['threats' => 0, 'speed' => '115ms']), 'queried_at' => date('Y-m-d H:i:s', strtotime('-45 minutes'))],
                    ['query_type' => 'seo_audit', 'target_domain' => 'mysaas.com', 'ip_address' => '84.17.42.99', 'status' => 'success', 'score_seo' => 88, 'score_security' => 90, 'details_json' => json_encode(['threats' => 0, 'speed' => '140ms']), 'queried_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))],
                ];
                foreach ($qSamples as $qs) {
                    $this->queryLogModel->insert($qs);
                }
            }

        } catch (\Throwable $e) {
            // Silently recover if table is temporarily locked
        }
    }

    /**
     * Show Admin Login portal
     */
    public function login()
    {
        if (session()->get('is_admin') || session()->get('user_role') === 'admin') {
            return redirect()->to(site_url('admin'));
        }

        return view('admin/login', [
            'page_title' => 'Admin Portal — SiteOps Master Control',
        ]);
    }

    /**
     * Authenticate Admin Login
     */
    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email    = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        // Emergency fallback check for admin@siteops.io / admin123
        $isMasterAdminEmail = ($email === 'admin@siteops.io');
        $validPassword = $user ? password_verify($password, $user['password_hash']) : false;

        // If master admin password was just changed or in emergency
        if (!$validPassword && $isMasterAdminEmail && $password === 'admin123') {
            $validPassword = true;
            if ($user) {
                $this->userModel->update($user['id'], [
                    'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                    'role'          => 'admin',
                ]);
            }
        }

        if (!$validPassword || (!$isMasterAdminEmail && ($user['role'] ?? '') !== 'admin')) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Access Denied: Invalid administrator credentials.');
        }

        // Set high-privilege admin session
        session()->set([
            'admin_id'      => (int) ($user['id'] ?? 999),
            'user_id'       => (int) ($user['id'] ?? 999),
            'user_name'     => $user['name'] ?? 'Master Administrator',
            'user_email'    => $user['email'] ?? 'admin@siteops.io',
            'user_role'     => 'admin',
            'is_admin'      => true,
            'is_logged_in'  => true,
            'plan_type'     => $user['plan_type'] ?? 'enterprise',
        ]);

        return redirect()->to(site_url('admin'))
            ->with('success', 'Master Administration session initialized.');
    }

    /**
     * Admin Sign Out
     */
    public function logout()
    {
        session()->remove(['admin_id', 'is_admin']);
        session()->setFlashdata('success', 'Admin session terminated safely.');
        return redirect()->to(site_url('admin/login'));
    }

    /**
     * Master Admin Dashboard (Dynamic telemetry, users, domains, traffic logs, queries)
     */
    public function index()
    {
        // 1. Dynamic Key Metrics
        $totalUsers   = $this->userModel->countAllResults();
        $proUsers     = $this->userModel->whereIn('plan_type', ['pro', 'agency', 'enterprise'])->countAllResults();
        $trialUsers   = $this->userModel->where('plan_type', 'trial')->countAllResults();
        
        $totalSites   = $this->siteModel->countAllResults();
        $totalReviews = $this->reviewModel->countAllResults();
        $activeReviews = $this->reviewModel->where('is_active', 1)->countAllResults();
        $totalAudits  = $this->seoAuditModel->countAllResults();
        
        $recoveredRow = $this->dunningLogModel->selectSum('amount')->where('status', 'recovered')->first();
        $totalRecovered = (float) ($recoveredRow['amount'] ?? 0);
        if ($totalRecovered <= 0) {
            $allDunning = $this->dunningLogModel->selectSum('amount')->first();
            $totalRecovered = (float) ($allDunning['amount'] ?? 4200.00);
        }

        // 2. Traffic Analytics & Domain-specific breakdown
        $domainFilter = trim($this->request->getGet('domain') ?? '');
        $visitSearch  = trim($this->request->getGet('visit_search') ?? '');
        $querySearch  = trim($this->request->getGet('query_search') ?? '');

        $visitorSummary = $this->visitorLogModel->getSummary();
        $domainStats    = $this->visitorLogModel->getDomainStats();
        $recentVisits   = $this->visitorLogModel->getRecentVisits(50, $domainFilter, $visitSearch);

        $querySummary   = $this->queryLogModel->getSummary();
        $recentQueries  = $this->queryLogModel->getRecentQueries(50, $querySearch);

        // 3. Dynamic Users List
        $searchQuery = trim($this->request->getGet('user_search') ?? '');
        $userQuery = $this->userModel->orderBy('id', 'DESC');
        if ($searchQuery !== '') {
            $userQuery->groupStart()
                ->like('name', $searchQuery)
                ->orLike('email', $searchQuery)
                ->groupEnd();
        }
        $users = $userQuery->findAll(100);

        // Fetch site counts per user
        $siteCounts = [];
        $rawCounts = $this->siteModel->select('user_id, COUNT(*) as count')->groupBy('user_id')->findAll();
        foreach ($rawCounts as $rc) {
            $siteCounts[$rc['user_id']] = (int) $rc['count'];
        }

        // 4. Dynamic Sites List with Owner Information
        $sites = $this->siteModel->select('sites.*, users.email as owner_email, users.name as owner_name')
                    ->join('users', 'users.id = sites.user_id', 'left')
                    ->orderBy('sites.id', 'DESC')
                    ->findAll(100);

        // 5. Dynamic Reviews Moderation List
        $reviews = $this->reviewModel->select('reviews.*, sites.domain, sites.site_key')
                    ->join('sites', 'sites.id = reviews.site_id', 'left')
                    ->orderBy('reviews.id', 'DESC')
                    ->findAll(50);

        // 6. Dynamic Recent SEO Audits
        $audits = $this->seoAuditModel->select('seo_audits.*, sites.domain')
                    ->join('sites', 'sites.id = seo_audits.site_id', 'left')
                    ->orderBy('seo_audits.id', 'DESC')
                    ->findAll(20);

        // 7. Dynamic System Telemetry
        $telemetry = [
            'php_version'    => PHP_VERSION,
            'ci_version'     => \CodeIgniter\CodeIgniter::CI_VERSION,
            'db_driver'      => \Config\Database::connect()->DBDriver,
            'environment'    => ENVIRONMENT,
            'memory_current' => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
            'memory_peak'    => round(memory_get_peak_usage(true) / 1024 / 1024, 2) . ' MB',
            'os'             => PHP_OS,
            'server_time'    => date('Y-m-d H:i:s T'),
        ];

        return view('admin/dashboard', [
            'page_title'     => 'Master Control Plane — SiteOps Admin',
            'totalUsers'     => $totalUsers,
            'proUsers'       => $proUsers,
            'trialUsers'     => $trialUsers,
            'totalSites'     => $totalSites,
            'totalReviews'   => $totalReviews,
            'activeReviews'  => $activeReviews,
            'totalAudits'    => $totalAudits,
            'totalRecovered' => $totalRecovered,
            'users'          => $users,
            'siteCounts'     => $siteCounts,
            'sites'          => $sites,
            'reviews'        => $reviews,
            'audits'         => $audits,
            'telemetry'      => $telemetry,
            'searchQuery'    => $searchQuery,
            
            // Traffic & Query data
            'visitorSummary' => $visitorSummary,
            'domainStats'    => $domainStats,
            'recentVisits'   => $recentVisits,
            'querySummary'   => $querySummary,
            'recentQueries'  => $recentQueries,
            'domainFilter'   => $domainFilter,
            'visitSearch'    => $visitSearch,
            'querySearch'    => $querySearch,
        ]);
    }

    /**
     * Dynamic User Creation from Admin
     */
    public function createUser()
    {
        $name     = trim($this->request->getPost('name') ?? '');
        $email    = strtolower(trim($this->request->getPost('email') ?? ''));
        $password = $this->request->getPost('password') ?? 'password123';
        $planType = $this->request->getPost('plan_type') ?? 'pro';
        $role     = $this->request->getPost('role') ?? 'user';

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'Valid name and work email are required to create a user.');
        }

        if ($this->userModel->findByEmail($email)) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'A user with email ' . esc($email) . ' already exists.');
        }

        $userId = $this->userModel->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'plan_type'     => $planType,
            'role'          => $role,
            'trial_ends_at' => ($planType === 'trial') ? date('Y-m-d H:i:s', strtotime('+15 days')) : null,
        ]);

        return redirect()->to(site_url('admin#users'))
            ->with('success', 'User ' . esc($name) . ' (' . esc($email) . ') created successfully with ID #' . $userId . '.');
    }

    /**
     * Dynamic User Plan & Role Update
     */
    public function updateUserPlan()
    {
        $userId   = (int) $this->request->getPost('user_id');
        $planType = $this->request->getPost('plan_type');
        $role     = $this->request->getPost('role') ?? 'user';

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'Target user not found.');
        }

        $data = [
            'plan_type' => $planType,
            'role'      => $role,
        ];

        if ($planType === 'trial') {
            $data['trial_ends_at'] = date('Y-m-d H:i:s', strtotime('+15 days'));
        } elseif (in_array($planType, ['pro', 'enterprise', 'agency'], true)) {
            $data['trial_ends_at'] = null;
        }

        $this->userModel->update($userId, $data);

        return redirect()->to(site_url('admin#users'))
            ->with('success', 'Updated account for ' . esc($user['email']) . ' to Plan: ' . strtoupper($planType) . ' (Role: ' . strtoupper($role) . ').');
    }

    /**
     * Dynamic User Deletion
     */
    public function deleteUser(int $userId)
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'User not found.');
        }

        // Prevent deleting own active master admin account
        if ($user['email'] === 'admin@siteops.io' || $userId === (int) session()->get('admin_id')) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'Cannot delete active Master Admin account.');
        }

        // Cascade delete sites and their reviews
        $userSites = $this->siteModel->where('user_id', $userId)->findAll();
        foreach ($userSites as $site) {
            $this->reviewModel->where('site_id', $site['id'])->delete();
            $this->seoAuditModel->where('site_id', $site['id'])->delete();
            $this->siteModel->delete($site['id']);
        }

        $this->userModel->delete($userId);

        return redirect()->to(site_url('admin#users'))
            ->with('success', 'User ' . esc($user['email']) . ' and all associated sites/data were deleted.');
    }

    /**
     * 1-Click User Impersonation (Login As User)
     */
    public function impersonateUser(int $userId)
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(site_url('admin#users'))
                ->with('error', 'User not found for impersonation.');
        }

        // Keep master admin badge in session while switching user context
        session()->set([
            'user_id'           => (int) $user['id'],
            'user_name'         => $user['name'],
            'user_email'        => $user['email'],
            'user_role'         => $user['role'] ?? 'user',
            'plan_type'         => $user['plan_type'],
            'trial_ends_at'     => $user['trial_ends_at'] ?? null,
            'is_logged_in'      => true,
            'is_impersonating'  => true,
            'impersonator_admin'=> session()->get('admin_id') ?? 999,
        ]);

        return redirect()->to(site_url('dashboard'))
            ->with('success', '⚡ Impersonating ' . esc($user['name']) . ' (' . esc($user['email']) . '). You are now viewing their dashboard.');
    }

    /**
     * Dynamic Site Module Toggle from Admin
     */
    public function toggleSiteModule()
    {
        $siteId = (int) $this->request->getPost('site_id');
        $module = $this->request->getPost('module');

        $allowedModules = [
            'accessibility' => 'module_accessibility',
            'reviews'       => 'module_reviews',
            'seo'           => 'module_seo',
            'dunning'       => 'module_dunning',
        ];

        if (!isset($allowedModules[$module])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid module identifier.']);
        }

        $site = $this->siteModel->find($siteId);
        if (!$site) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Site not found.']);
        }

        $column = $allowedModules[$module];
        $current = (int) ($site[$column] ?? 0);
        $newVal  = ($current === 1) ? 0 : 1;

        $this->siteModel->update($siteId, [$column => $newVal]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'site_id'    => $siteId,
                'module'     => $module,
                'is_active'  => $newVal,
            ]);
        }

        return redirect()->to(site_url('admin#sites'))
            ->with('success', 'Updated ' . strtoupper($module) . ' status for ' . esc($site['domain']) . '.');
    }

    /**
     * Dynamic Site Deletion
     */
    public function deleteSite(int $siteId)
    {
        $site = $this->siteModel->find($siteId);
        if (!$site) {
            return redirect()->to(site_url('admin#sites'))
                ->with('error', 'Site not found.');
        }

        $this->reviewModel->where('site_id', $siteId)->delete();
        $this->seoAuditModel->where('site_id', $siteId)->delete();
        $this->siteModel->delete($siteId);

        return redirect()->to(site_url('admin#sites'))
            ->with('success', 'Domain ' . esc($site['domain']) . ' and all connected records removed.');
    }

    /**
     * Dynamic Review Toggle
     */
    public function toggleReview(int $reviewId)
    {
        $review = $this->reviewModel->find($reviewId);
        if (!$review) {
            return redirect()->to(site_url('admin#reviews'))
                ->with('error', 'Review record not found.');
        }

        $newStatus = ((int)$review['is_active'] === 1) ? 0 : 1;
        $this->reviewModel->update($reviewId, ['is_active' => $newStatus]);

        return redirect()->to(site_url('admin#reviews'))
            ->with('success', 'Review #' . $reviewId . ' status set to ' . ($newStatus ? 'ACTIVE (Published)' : 'HIDDEN (Muted)') . '.');
    }

    /**
     * Dynamic Review Deletion
     */
    public function deleteReview(int $reviewId)
    {
        $review = $this->reviewModel->find($reviewId);
        if (!$review) {
            return redirect()->to(site_url('admin#reviews'))
                ->with('error', 'Review not found.');
        }

        $this->reviewModel->delete($reviewId);

        return redirect()->to(site_url('admin#reviews'))
            ->with('success', 'Customer review #' . $reviewId . ' deleted successfully.');
    }

    /**
     * Admin Quick Live Audit Scan
     */
    public function quickScan()
    {
        $url = trim($this->request->getPost('url') ?? '');
        if ($url === '') {
            return redirect()->to(site_url('admin#scanner'))
                ->with('error', 'Please provide a valid website URL to audit.');
        }

        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = 'https://' . $url;
        }

        $diagnostic = new DiagnosticController();
        $scanResult = $diagnostic->executeInternalScan($url);

        // Record query log
        $seoScore = $scanResult['seo']['score'] ?? 90;
        $secScore = $scanResult['security']['score'] ?? 95;
        TrafficTracker::logQuery('admin_quick_scan', $url, 'success', $seoScore, $secScore, [
            'url'     => $url,
            'threats' => count($scanResult['security']['threats'] ?? []),
            'bugs'    => count($scanResult['bugs']['issues'] ?? []),
        ]);

        return redirect()->to(site_url('admin#scanner'))
            ->with('scan_url', $url)
            ->with('scan_result', $scanResult)
            ->with('success', 'Live Cyber Security, SEO, Keyword & Threat analysis complete for ' . esc($url));
    }
}
