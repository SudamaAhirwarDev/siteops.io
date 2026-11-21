<?php

namespace App\Services;

use App\Models\VisitorLogModel;
use App\Models\QueryLogModel;

class TrafficTracker
{
    /**
     * Record a site visit in visitor_logs
     */
    public static function logVisit(?string $domain = null, ?int $siteId = null, ?string $pageUrl = null): void
    {
        try {
            $request = service('request');

            // 1. Resolve domain
            if (empty($domain)) {
                $host = $request->getServer('HTTP_HOST') ?? 'siteops.io';
                // Remove port if present
                $domain = strtolower(explode(':', $host)[0]);
            }

            // 2. Resolve visited page URL
            if (empty($pageUrl)) {
                $pageUrl = $request->getServer('REQUEST_URI') ?? '/';
            }

            // 3. Resolve IP address (Render / Cloudflare / Forwarded proxy safe)
            $ip = $request->getServer('HTTP_CF_CONNECTING_IP')
                ?? $request->getServer('HTTP_X_FORWARDED_FOR')
                ?? $request->getIPAddress();

            if (str_contains($ip, ',')) {
                $ip = trim(explode(',', $ip)[0]);
            }

            // 4. Resolve User Agent & Device Type
            $userAgent = $request->getUserAgent() ? (string) $request->getUserAgent() : ($request->getServer('HTTP_USER_AGENT') ?? 'Unknown');
            $deviceType = 'desktop';

            $uaLower = strtolower($userAgent);
            if (preg_match('/(bot|crawl|spider|slurp|facebookexternalhit|curl|wget)/i', $uaLower)) {
                $deviceType = 'bot';
            } elseif (preg_match('/(tablet|ipad|playbook|silk)/i', $uaLower)) {
                $deviceType = 'tablet';
            } elseif (preg_match('/(mobile|android|touch|iphone|ipod|blackberry|opera mini)/i', $uaLower)) {
                $deviceType = 'mobile';
            }

            // 5. Referrer
            $referrer = $request->getServer('HTTP_REFERER') ?? null;
            if ($referrer && strlen($referrer) > 255) {
                $referrer = substr($referrer, 0, 255);
            }

            $model = new VisitorLogModel();
            $model->insert([
                'domain'      => strtolower(trim($domain)),
                'site_id'     => $siteId,
                'page_url'    => substr($pageUrl, 0, 255),
                'ip_address'  => substr($ip, 0, 45),
                'user_agent'  => substr($userAgent, 0, 255),
                'device_type' => $deviceType,
                'referrer'    => $referrer,
                'visited_at'  => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // Silently fail to never disrupt user request
        }
    }

    /**
     * Record a scan, diagnostic, or search query in query_logs
     */
    public static function logQuery(string $queryType, string $targetDomain, string $status = 'success', ?int $seoScore = null, ?int $secScore = null, array $details = []): void
    {
        try {
            $request = service('request');
            $ip = $request->getServer('HTTP_CF_CONNECTING_IP')
                ?? $request->getServer('HTTP_X_FORWARDED_FOR')
                ?? $request->getIPAddress();

            if (str_contains($ip, ',')) {
                $ip = trim(explode(',', $ip)[0]);
            }

            // Clean domain name
            $cleanDomain = preg_replace('~^https?://~i', '', trim($targetDomain));
            $cleanDomain = explode('/', $cleanDomain)[0];

            $model = new QueryLogModel();
            $model->insert([
                'query_type'     => $queryType,
                'target_domain'  => strtolower($cleanDomain),
                'ip_address'     => substr($ip, 0, 45),
                'status'         => $status,
                'score_seo'      => $seoScore,
                'score_security' => $secScore,
                'details_json'   => !empty($details) ? json_encode($details) : null,
                'queried_at'     => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // Silently fail
        }
    }
}
