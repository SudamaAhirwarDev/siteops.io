<?php

namespace App\Controllers;

use App\Models\SiteModel;
use App\Models\DunningLogModel;
use CodeIgniter\Controller;

/**
 * Class DunningController
 * 
 * Configures automated Stripe failed payment recovery webhooks,
 * monitors recovered subscription revenue, and tracks dunning events.
 */
class DunningController extends Controller
{
    protected SiteModel $siteModel;
    protected DunningLogModel $dunningLogModel;

    public function __construct()
    {
        $this->siteModel       = new SiteModel();
        $this->dunningLogModel = new DunningLogModel();
        helper(['form', 'url']);
    }

    /**
     * Display Dunning recovery setup & logs
     */
    public function index($siteId = null)
    {
        $userId = (int) session()->get('user_id');
        $sites  = $this->siteModel->getUserSites($userId);

        if (empty($sites)) {
            return redirect()->to(site_url('dashboard'))
                ->with('error', 'Please add a website before configuring dunning recovery.');
        }

        // Selected site
        $selectedSite = null;
        if ($siteId !== null) {
            $selectedSite = $this->siteModel->getSiteForUser((int) $siteId, $userId);
        }
        if (!$selectedSite) {
            $selectedSite = $sites[0];
        }

        $logs  = $this->dunningLogModel->getSiteLogs((int) $selectedSite['id'], 25);
        $stats = $this->dunningLogModel->getSiteStats((int) $selectedSite['id']);

        $recoveryRate = ($stats['total_logs'] > 0)
            ? round(($this->dunningLogModel->where('site_id', $selectedSite['id'])->where('status', 'recovered')->countAllResults() / $stats['total_logs']) * 100, 1)
            : 0;

        return view('modules/dunning', [
            'page_title'    => 'Failed Payment Recovery — SiteOps',
            'sites'         => $sites,
            'selected_site' => $selectedSite,
            'logs'          => $logs,
            'stats'         => $stats,
            'recovery_rate' => $recoveryRate,
            'webhook_url'   => site_url('api/webhook/stripe/' . $selectedSite['site_key']),
        ]);
    }
}
