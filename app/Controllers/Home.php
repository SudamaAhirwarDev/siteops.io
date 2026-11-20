<?php

namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Class Home
 * 
 * Default Controller rendering the SiteOps SaaS Landing Page.
 * Follows CodeIgniter 4 clean MVC architecture.
 */
class Home extends Controller
{
    /**
     * Display the SiteOps conversion landing page.
     *
     * @return string
     */
    public function index(): string
    {
        $data = [
            'page_title' => 'SiteOps — Ultra-Lightweight Growth & Compliance Suite',
            'meta_description' => 'Replace 4 expensive subscriptions with one lightweight script (<15KB). EU/ADA Accessibility, Social Proof Reviews, AI SEO/GEO Auditor, and Failed Payment Recovery.',
        ];

        return view('landing', $data);
    }
}
