<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Services\DiagnosticService;
use App\Services\TrafficTracker;

/**
 * Class DiagnosticController
 * 
 * Handles real-time public and dashboard website scans:
 * 1. Technical SEO & Keyword Extractor/Suggester
 * 2. TotalVirus-Style Security & Malware Detector
 * 3. Website Bug & Error Detector with Code Fix Suggestions
 */
class DiagnosticController extends Controller
{
    protected DiagnosticService $diagnosticService;

    public function __construct()
    {
        $this->diagnosticService = new DiagnosticService();
        helper(['url', 'form']);
    }

    /**
     * Public API & AJAX Endpoint for Live Website Scan
     * 
     * Endpoint: POST /api/scan/public or GET /api/scan/public?url=...
     * CORS Enabled (Access-Control-Allow-Origin: *)
     */
    public function scan()
    {
        // Handle OPTIONS preflight
        if (strtolower($this->request->getMethod()) === 'options') {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->setStatusCode(200);
        }

        $url = null;
        try {
            $json = $this->request->getJSON(true);
            if (is_array($json) && !empty($json['url'])) {
                $url = $json['url'];
            }
        } catch (\Throwable $e) {
            // Non-JSON payload
        }

        if (empty($url)) {
            $url = $this->request->getPost('url') ?? $this->request->getGet('url');
        }

        if (empty($url)) {
            return $this->response
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'error'   => 'Please provide a valid website URL to analyze.',
                ]);
        }

        $url = trim($url);

        // Security check: prevent internal SSRF probes against localhost/private IPs
        $parsed = parse_url(preg_match('~^https?://~i', $url) ? $url : "https://{$url}");
        $host = $parsed['host'] ?? '';
        
        // Block obvious loopback addresses in production (allow standard public domains)
        if (in_array(strtolower($host), ['127.0.0.1', '::1', '0.0.0.0'], true)) {
            // Allow localhost only if querying demo on development
            if (getenv('CI_ENVIRONMENT') !== 'development') {
                return $this->response
                    ->setHeader('Access-Control-Allow-Origin', '*')
                    ->setStatusCode(403)
                    ->setJSON([
                        'success' => false,
                        'error'   => 'Scanning localhost or private IP addresses is disabled for security.',
                    ]);
            }
        }

        $result = $this->diagnosticService->scan($url);

        // Record real-time diagnostic query in query_logs
        $seoScore = $result['seo']['score'] ?? null;
        $secScore = $result['security']['score'] ?? null;
        TrafficTracker::logQuery('diagnostic_scan', $url, 'success', $seoScore, $secScore, [
            'url'     => $url,
            'threats' => count($result['security']['threats'] ?? []),
            'bugs'    => count($result['bugs']['issues'] ?? []),
        ]);

        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Content-Type', 'application/json')
            ->setJSON($result);
    }

    /**
     * Direct Internal Scan Execution Helper for Controllers
     */
    public function executeInternalScan(string $url): array
    {
        return $this->diagnosticService->scan($url);
    }
}
