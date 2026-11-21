<?php

namespace App\Controllers;

use App\Models\SiteModel;
use App\Models\ReviewModel;
use App\Models\SeoAuditModel;
use App\Models\DunningLogModel;
use CodeIgniter\Controller;

/**
 * Class DashboardController
 * 
 * Main central control hub for managing websites, 1-click embed keys,
 * and live AJAX module toggles.
 */
class DashboardController extends Controller
{
    protected SiteModel $siteModel;
    protected ReviewModel $reviewModel;
    protected SeoAuditModel $seoAuditModel;
    protected DunningLogModel $dunningLogModel;

    public function __construct()
    {
        $this->siteModel       = new SiteModel();
        $this->reviewModel     = new ReviewModel();
        $this->seoAuditModel   = new SeoAuditModel();
        $this->dunningLogModel = new DunningLogModel();
        helper(['form', 'url']);
    }

    /**
     * Render main dashboard view
     */
    public function index()
    {
        $userId = (int) session()->get('user_id');
        $sites  = $this->siteModel->getUserSites($userId);

        // Aggregate statistics across user's sites
        $totalSites = count($sites);
        $totalReviews = 0;
        $totalRecovered = 0.0;
        $activeModulesCount = 0;

        foreach ($sites as $site) {
            if ($site['module_accessibility']) $activeModulesCount++;
            if ($site['module_reviews']) $activeModulesCount++;
            if ($site['module_seo']) $activeModulesCount++;
            if ($site['module_dunning']) $activeModulesCount++;

            $totalReviews += $this->reviewModel->where('site_id', $site['id'])->countAllResults();
            $stats = $this->dunningLogModel->getSiteStats($site['id']);
            $totalRecovered += $stats['total_recovered'];
        }

        $trialStatus = (new \App\Services\UsageService())->getTrialStatus($userId);

        return view('dashboard/index', [
            'page_title'         => 'Dashboard — SiteOps',
            'sites'              => $sites,
            'total_sites'        => $totalSites,
            'total_reviews'      => $totalReviews,
            'total_recovered'    => $totalRecovered,
            'active_modules'     => $activeModulesCount,
            'trial_status'       => $trialStatus,
        ]);
    }

    /**
     * Register a new website domain and auto-generate unique 16-char site_key
     */
    public function createSite()
    {
        $userId = (int) session()->get('user_id');

        $rules = [
            'domain' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please provide a valid website domain.');
        }

        $rawDomain = trim($this->request->getPost('domain'));
        // Clean protocol, path, and trailing slashes
        $cleanedDomain = preg_replace('#^https?://#i', '', $rawDomain);
        $cleanedDomain = preg_replace('#/.*$#', '', $cleanedDomain);
        $cleanedDomain = strtolower(trim($cleanedDomain));

        if (empty($cleanedDomain)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Domain format is invalid.');
        }

        // Check if user already registered this domain
        $existing = $this->siteModel->where('user_id', $userId)
                                    ->where('domain', $cleanedDomain)
                                    ->first();
        if ($existing) {
            return redirect()->back()
                ->with('error', "Domain '{$cleanedDomain}' is already added to your account.");
        }

        $siteKey = $this->siteModel->generateUniqueSiteKey();

        $siteId = $this->siteModel->insert([
            'user_id'              => $userId,
            'domain'               => $cleanedDomain,
            'site_key'             => $siteKey,
            'module_accessibility' => 1,
            'module_reviews'       => 1,
            'module_seo'           => 1,
            'module_dunning'       => 0,
        ]);

        if (!$siteId) {
            return redirect()->back()
                ->with('error', 'Could not create domain. Please try again.');
        }

        return redirect()->to(site_url('dashboard'))
            ->with('success', "Website '{$cleanedDomain}' added! Embed your universal script below.");
    }

    /**
     * AJAX endpoint: Toggle module ON/OFF for a site
     */
    public function toggleModule()
    {
        $userId = (int) session()->get('user_id');

        $siteId = (int) $this->request->getPost('site_id');
        $module = trim($this->request->getPost('module'));
        $state  = (int) $this->request->getPost('state') === 1 ? 1 : 0;

        $allowedModules = ['accessibility', 'reviews', 'seo', 'dunning'];
        if (!in_array($module, $allowedModules, true)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid module requested.',
            ]);
        }

        $site = $this->siteModel->getSiteForUser($siteId, $userId);
        if (!$site) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Website not found or unauthorized.',
            ]);
        }

        $columnName = 'module_' . $module;
        $this->siteModel->update($siteId, [
            $columnName => $state,
        ]);

        return $this->response->setJSON([
            'success'   => true,
            'site_id'   => $siteId,
            'module'    => $module,
            'state'     => $state,
            'csrf_hash' => csrf_hash(),
            'message'   => ucfirst($module) . ' module ' . ($state ? 'activated' : 'disabled') . '.',
        ]);
    }

    /**
     * AJAX endpoint: Verify if the universal script is installed and active on the site
     */
    public function verifyInstallation($siteId)
    {
        $userId = (int) session()->get('user_id');
        $site = $this->siteModel->getSiteForUser((int) $siteId, $userId);

        if (!$site) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Website not found or unauthorized.',
            ]);
        }

        // Check if visitor logs or query logs exist for this domain
        $visitorLogModel = new \App\Models\VisitorLogModel();
        $pingsCount = $visitorLogModel->where('domain', $site['domain'])->countAllResults();
        $lastLog = $visitorLogModel->where('domain', $site['domain'])->orderBy('visited_at', 'DESC')->first();

        $isConnected = ($pingsCount > 0);

        return $this->response->setJSON([
            'success'     => true,
            'connected'   => $isConnected,
            'domain'      => $site['domain'],
            'site_key'    => $site['site_key'],
            'pings_count' => $pingsCount,
            'last_seen'   => $lastLog ? date('M d, Y H:i:s', strtotime($lastLog['visited_at'])) : null,
            'message'     => $isConnected 
                ? "Universal script detected! {$pingsCount} active requests logged from {$site['domain']}."
                : "No script pings detected yet for {$site['domain']}. Ensure the script is placed inside <head> and refresh your website."
        ]);
    }
}
