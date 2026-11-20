<?php

namespace App\Services;

/**
 * Class DiagnosticService
 * 
 * Comprehensive Website Diagnostic Engine providing:
 * 1. Technical SEO & Keyword Extractor/Suggester (Actionable Keyword Updates)
 * 2. TotalVirus-Style Security & Malware Detector (Headers, SSL, Obfuscation, Iframes)
 * 3. Website Bug & Error Detector with Actionable Code Fix Suggestions
 */
class DiagnosticService
{
    /**
     * Common English stop words to filter out during keyword extraction
     */
    protected const STOP_WORDS = [
        'a', 'about', 'above', 'after', 'again', 'against', 'all', 'am', 'an', 'and', 'any',
        'are', 'aren\'t', 'as', 'at', 'be', 'because', 'been', 'before', 'being', 'below',
        'between', 'both', 'but', 'by', 'can', 'can\'t', 'cannot', 'could', 'couldn\'t',
        'did', 'didn\'t', 'do', 'does', 'doesn\'t', 'doing', 'don\'t', 'down', 'during',
        'each', 'few', 'for', 'from', 'further', 'had', 'hadn\'t', 'has', 'hasn\'t', 'have',
        'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'he\'s', 'her', 'here', 'here\'s',
        'hers', 'herself', 'him', 'himself', 'his', 'how', 'how\'s', 'i', 'i\'d', 'i\'ll',
        'i\'m', 'i\'ve', 'if', 'in', 'into', 'is', 'isn\'t', 'it', 'it\'s', 'its', 'itself',
        'let\'s', 'me', 'more', 'most', 'mustn\'t', 'my', 'myself', 'no', 'nor', 'not', 'of',
        'off', 'on', 'once', 'only', 'or', 'other', 'ought', 'our', 'ours', 'ourselves',
        'out', 'over', 'own', 'same', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s',
        'should', 'shouldn\'t', 'so', 'some', 'such', 'than', 'that', 'that\'s', 'the',
        'their', 'theirs', 'them', 'themselves', 'then', 'there', 'there\'s', 'these',
        'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'this', 'those', 'through',
        'to', 'too', 'under', 'until', 'up', 'very', 'was', 'wasn\'t', 'we', 'we\'d',
        'we\'ll', 'we\'re', 'we\'ve', 'were', 'weren\'t', 'what', 'what\'s', 'when',
        'when\'s', 'where', 'where\'s', 'which', 'while', 'who', 'who\'s', 'whom', 'why',
        'why\'s', 'with', 'won\'t', 'would', 'wouldn\'t', 'you', 'you\'d', 'you\'ll',
        'you\'re', 'you\'ve', 'your', 'yours', 'yourself', 'yourselves', 'will', 'just',
        'get', 'like', 'one', 'also', 'new', 'use', 'page', 'site', 'click', 'home',
        'privacy', 'terms', 'rights', 'reserved', 'copyright'
    ];

    /**
     * Run full diagnostic scan on a URL
     *
     * @param string $url
     * @return array
     */
    public function scan(string $url): array
    {
        $url = trim($url);
        if (!preg_match('~^https?://~i', $url)) {
            $url = 'https://' . $url;
        }

        $crawl = $this->fetchPageWithHeaders($url);
        if (!$crawl['success']) {
            return [
                'success' => false,
                'error'   => $crawl['error'],
                'url'     => $url,
            ];
        }

        $html      = $crawl['html'];
        $headers   = $crawl['headers'];
        $httpCode  = $crawl['http_code'];
        $loadTime  = $crawl['load_time_ms'];
        $finalUrl  = $crawl['effective_url'];
        $isHttps   = str_starts_with(strtolower($finalUrl), 'https://');

        // Parse DOM
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_NOERROR | LIBXML_NOWARNING);
        libxml_clear_errors();
        $xpath = new \DOMXPath($dom);

        // 1. Technical SEO & Keyword Analysis
        $seoData = $this->analyzeSeoAndKeywords($xpath, $html, $finalUrl);

        // 2. TotalVirus-Style Security & Threat Check
        $securityData = $this->analyzeSecurityAndMalware($html, $headers, $finalUrl, $isHttps);

        // 3. Cyber Security & Hardening Audit
        $cyberSecurityData = $this->analyzeCyberSecurity($xpath, $html, $headers, $finalUrl, $isHttps);

        // 4. Website Bugs, Errors & Fix Suggestions
        $bugData = $this->analyzeBugsAndErrors($xpath, $html, $headers, $finalUrl, $loadTime, $isHttps);

        // Overall Health Score (Weighted average: 25% SEO, 25% Threat, 30% Cyber Security, 20% Bugs)
        $overallScore = (int) round(($seoData['score'] * 0.25) + ($securityData['score'] * 0.25) + ($cyberSecurityData['score'] * 0.30) + ($bugData['score'] * 0.20));

        return [
            'success'        => true,
            'target_url'     => $finalUrl,
            'http_code'      => $httpCode,
            'load_time_ms'   => $loadTime,
            'overall_score'  => $overallScore,
            'scanned_at'     => date('M d, Y H:i:s'),
            'cyber_security' => $cyberSecurityData,
            'seo'            => $seoData,
            'security'       => $securityData,
            'bugs'           => $bugData,
        ];
    }

    /**
     * Fetch webpage HTML and HTTP headers using cURL
     */
    protected function fetchPageWithHeaders(string $url): array
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_TIMEOUT        => 14,
            CURLOPT_CONNECTTIMEOUT => 6,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 SiteOpsBot/2.0 (Security & Health Auditor)',
            CURLOPT_ENCODING       => '',
        ]);

        $rawResponse  = curl_exec($ch);
        $headerSize   = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $totalTime    = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
        $curlError    = curl_error($ch);
        curl_close($ch);

        if ($rawResponse === false || $httpCode < 200 || $httpCode >= 400) {
            return [
                'success' => false,
                'error'   => $curlError ?: "HTTP {$httpCode} - Could not establish connection.",
            ];
        }

        $rawHeaders = substr($rawResponse, 0, $headerSize);
        $html       = substr($rawResponse, $headerSize);

        // Parse HTTP headers into lowercase map
        $parsedHeaders = [];
        foreach (explode("\r\n", $rawHeaders) as $line) {
            if (str_contains($line, ':')) {
                [$k, $v] = explode(':', $line, 2);
                $parsedHeaders[strtolower(trim($k))] = trim($v);
            }
        }

        return [
            'success'       => true,
            'html'          => $html,
            'headers'       => $parsedHeaders,
            'http_code'     => $httpCode,
            'load_time_ms'  => (int) round($totalTime * 1000),
            'effective_url' => $effectiveUrl ?: $url,
        ];
    }

    /**
     * 1. Technical SEO & Keyword Suggester Engine
     */
    protected function analyzeSeoAndKeywords(\DOMXPath $xpath, string $html, string $url): array
    {
        $score = 100;
        $updatesNeeded = [];

        // Title
        $titleNodes = $xpath->query('//title');
        $title = ($titleNodes->length > 0) ? trim($titleNodes->item(0)->textContent) : '';
        $titleLen = mb_strlen($title);

        if (empty($title)) {
            $score -= 20;
            $updatesNeeded[] = [
                'type'        => 'critical',
                'title'       => 'Missing <title> Tag',
                'description' => 'Your page has no title tag. Search engines cannot index your page topic.',
                'action'      => 'Add a descriptive 50-60 character <title> tag targeting your primary keyword.',
            ];
        } elseif ($titleLen < 30) {
            $score -= 8;
            $updatesNeeded[] = [
                'type'        => 'warning',
                'title'       => "Title Tag Too Short ({$titleLen} Chars)",
                'description' => 'Short titles miss valuable keyword real estate in Google & Bing results.',
                'action'      => 'Expand title to 45-60 characters with high-converting value props.',
            ];
        } elseif ($titleLen > 65) {
            $score -= 5;
            $updatesNeeded[] = [
                'type'        => 'warning',
                'title'       => "Title Tag Truncated ({$titleLen} Chars)",
                'description' => 'Google truncates titles longer than ~60 characters on SERP displays.',
                'action'      => 'Shorten title to under 60 characters so searchers see your full message.',
            ];
        }

        // Meta Description
        $descNodes = $xpath->query('//meta[translate(@name, "DESCRIPTION", "description")="description"]/@content');
        $description = ($descNodes->length > 0) ? trim($descNodes->item(0)->nodeValue) : '';
        $descLen = mb_strlen($description);

        if (empty($description)) {
            $score -= 15;
            $updatesNeeded[] = [
                'type'        => 'critical',
                'title'       => 'Missing Meta Description',
                'description' => 'Without a meta description, search engines generate random snippet previews from page text.',
                'action'      => 'Add a 130-160 character meta description with a clear call-to-action.',
            ];
        } elseif ($descLen < 70) {
            $score -= 5;
            $updatesNeeded[] = [
                'type'        => 'warning',
                'title'       => "Meta Description Too Brief ({$descLen} Chars)",
                'description' => 'Short meta descriptions have lower click-through rates (CTR).',
                'action'      => 'Expand your meta description to 120-155 characters.',
            ];
        }

        // Headings Hierarchy
        $h1Nodes = $xpath->query('//h1');
        $h1Count = $h1Nodes->length;
        $firstH1 = ($h1Count > 0) ? trim($h1Nodes->item(0)->textContent) : '';

        if ($h1Count === 0) {
            $score -= 15;
            $updatesNeeded[] = [
                'type'        => 'critical',
                'title'       => 'No <h1> Heading Found',
                'description' => 'Pages without an H1 heading fail to establish core topic hierarchy for search crawlers.',
                'action'      => 'Insert a single <h1> heading highlighting your main product offering.',
            ];
        } elseif ($h1Count > 1) {
            $score -= 5;
            $updatesNeeded[] = [
                'type'        => 'warning',
                'title'       => "Multiple <h1> Headings Found ({$h1Count})",
                'description' => 'Best practice is having 1 primary H1 per URL, followed by H2 and H3 subheadings.',
                'action'      => 'Change secondary H1 tags to H2 or H3 tags.',
            ];
        }

        // Canonical Tag
        $canonNodes = $xpath->query('//link[@rel="canonical"]/@href');
        $hasCanonical = ($canonNodes->length > 0);
        if (!$hasCanonical) {
            $score -= 10;
            $updatesNeeded[] = [
                'type'        => 'warning',
                'title'       => 'Missing Canonical Tag',
                'description' => 'Without canonical tags, search engines may penalize duplicate query parameter variants.',
                'action'      => "Add <link rel=\"canonical\" href=\"{$url}\"> to your <head> section.",
            ];
        }

        // Clean Text Extraction & Keyword Frequency
        $bodyNodes = $xpath->query('//body');
        $bodyText = '';
        if ($bodyNodes->length > 0) {
            $clone = $bodyNodes->item(0)->cloneNode(true);
            $scripts = $xpath->query('.//script|.//style|.//noscript|.//svg', $clone);
            foreach ($scripts as $s) {
                $s->parentNode->removeChild($s);
            }
            $bodyText = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $clone->textContent);
            $bodyText = preg_replace('/\s+/', ' ', $bodyText);
        }

        $allWords = array_values(array_filter(explode(' ', mb_strtolower(trim($bodyText)))));
        $totalWords = count($allWords);

        // Filter out stop words and short tokens (< 3 chars)
        $cleanWords = array_filter($allWords, function($w) {
            return mb_strlen($w) >= 3 && !in_array($w, self::STOP_WORDS, true) && !is_numeric($w);
        });

        // 1-Word Keyword Frequency
        $singleFreq = array_count_values($cleanWords);
        arsort($singleFreq);
        $topKeywords = array_slice($singleFreq, 0, 8, true);

        // 2-Word Keyphrase Frequency
        $twoWordPairs = [];
        $wordsArray = array_values($cleanWords);
        for ($i = 0; $i < count($wordsArray) - 1; $i++) {
            $pair = $wordsArray[$i] . ' ' . $wordsArray[$i + 1];
            $twoWordPairs[] = $pair;
        }
        $phraseFreq = array_count_values($twoWordPairs);
        arsort($phraseFreq);
        $topPhrases = array_slice($phraseFreq, 0, 5, true);

        // Keyword Density & Suggestion Generation
        $keywordAnalysis = [];
        $lowerTitle = mb_strtolower($title);
        $lowerDesc  = mb_strtolower($description);
        $lowerH1    = mb_strtolower($firstH1);

        foreach ($topKeywords as $kw => $count) {
            $density = $totalWords > 0 ? round(($count / $totalWords) * 100, 2) : 0;
            $inTitle = str_contains($lowerTitle, $kw);
            $inDesc  = str_contains($lowerDesc, $kw);
            $inH1    = str_contains($lowerH1, $kw);

            // Generate actionable suggestion if missing in high-impact tags
            $suggestion = '';
            if (!$inTitle && !$inH1) {
                $suggestion = "Found {$count}x in content ({$density}%), but missing in Title and H1. Add '{$kw}' to your page title.";
            } elseif (!$inTitle) {
                $suggestion = "Consider incorporating '{$kw}' into your <title> tag for better CTR.";
            } elseif (!$inDesc) {
                $suggestion = "Mention '{$kw}' in your meta description snippet.";
            } else {
                $suggestion = "Well-optimized across Title, H1, and page body.";
            }

            $keywordAnalysis[] = [
                'keyword'    => $kw,
                'count'      => $count,
                'density'    => $density . '%',
                'in_title'   => $inTitle,
                'in_desc'    => $inDesc,
                'in_h1'      => $inH1,
                'suggestion' => $suggestion,
            ];
        }

        return [
            'score'            => max(20, $score),
            'title'            => $title,
            'title_length'     => $titleLen,
            'description'      => $description,
            'desc_length'      => $descLen,
            'h1'               => $firstH1,
            'h1_count'         => $h1Count,
            'total_words'      => $totalWords,
            'top_keywords'     => $keywordAnalysis,
            'top_phrases'      => array_slice($topPhrases, 0, 4),
            'updates_needed'   => $updatesNeeded,
        ];
    }

    /**
     * 2. TotalVirus-Style Security & Malware Threat Detector
     */
    protected function analyzeSecurityAndMalware(string $html, array $headers, string $url, bool $isHttps): array
    {
        $score = 100;
        $threats = [];
        $headerAudits = [];

        // Check 1: HTTPS & SSL Transport
        if (!$isHttps) {
            $score -= 30;
            $threats[] = [
                'severity'    => 'critical',
                'category'    => 'SSL / Transport Layer',
                'title'       => 'Insecure HTTP Connection (No SSL)',
                'description' => 'Website does not enforce HTTPS. Passwords, session cookies, and credit cards are sent in unencrypted plain text.',
                'fix'         => 'Install a free Let\'s Encrypt SSL certificate and enforce HTTPS redirect.',
            ];
        }

        // Check 2: Security Headers
        $securityHeadersList = [
            'strict-transport-security' => [
                'name'        => 'HSTS (Strict-Transport-Security)',
                'weight'      => 15,
                'description' => 'Forces browsers to only communicate over secure HTTPS, preventing SSL stripping attacks.',
                'header'      => 'Strict-Transport-Security: max-age=31536000; includeSubDomains',
            ],
            'x-frame-options' => [
                'name'        => 'Clickjacking Defense (X-Frame-Options)',
                'weight'      => 15,
                'description' => 'Prevents attackers from embedding your website into invisible iframes to hijack user clicks.',
                'header'      => 'X-Frame-Options: SAMEORIGIN',
            ],
            'x-content-type-options' => [
                'name'        => 'MIME-Sniffing Guard (X-Content-Type-Options)',
                'weight'      => 10,
                'description' => 'Prevents browsers from trying to MIME-sniff responses away from the declared content-type.',
                'header'      => 'X-Content-Type-Options: nosniff',
            ],
            'content-security-policy' => [
                'name'        => 'Content Security Policy (CSP)',
                'weight'      => 15,
                'description' => 'Restricts the resources (scripts, styles, images) that the browser is allowed to load, preventing XSS.',
                'header'      => "Content-Security-Policy: default-src 'self' https:; script-src 'self' 'unsafe-inline' https:;",
            ],
            'referrer-policy' => [
                'name'        => 'Referrer Policy',
                'weight'      => 5,
                'description' => 'Controls how much referrer information is sent with outgoing requests.',
                'header'      => 'Referrer-Policy: strict-origin-when-cross-origin',
            ],
        ];

        foreach ($securityHeadersList as $key => $meta) {
            $isFound = isset($headers[$key]);
            $val = $isFound ? $headers[$key] : null;

            if (!$isFound) {
                $score -= $meta['weight'];
                $threats[] = [
                    'severity'    => $meta['weight'] >= 15 ? 'high' : 'medium',
                    'category'    => 'HTTP Security Header',
                    'title'       => "Missing {$meta['name']}",
                    'description' => $meta['description'],
                    'fix'         => "Add header to your server configuration: `{$meta['header']}`",
                ];
            }

            $headerAudits[] = [
                'header'      => $meta['name'],
                'status'      => $isFound ? 'pass' : 'fail',
                'value'       => $val ?: 'Not Configured',
                'recommended' => $meta['header'],
                'description' => $meta['description'],
            ];
        }

        // Check 3: Malware Obfuscation Patterns (TotalVirus-Style Scan)
        $malwareIndicators = [];

        // Pattern A: Obfuscated eval/base64 patterns
        if (preg_match('/eval\s*\(\s*(base64_decode|gzinflate|unescape)\s*\(/i', $html)) {
            $score -= 35;
            $malwareIndicators[] = 'Detected highly suspicious eval(base64_decode) pattern often associated with PHP backdoors.';
        }

        // Pattern B: Obfuscated hex or unicode script injections
        if (preg_match('/(\\\\x[0-9a-f]{2}){6,}/i', $html)) {
            $score -= 25;
            $malwareIndicators[] = 'Detected long strings of hexadecimal obfuscated characters (\x..), typical in JS malware injects.';
        }

        // Pattern C: Hidden iframes (Common drive-by vector)
        if (preg_match('/<iframe[^>]*(style=["\'][^"\']*(display:\s*none|visibility:\s*hidden|width:\s*0|height:\s*0)[^"\']*|width=["\']0["\']|height=["\']0["\'])[^>]*>/i', $html, $m)) {
            $score -= 25;
            $malwareIndicators[] = 'Found hidden iframe element with 0px width/height or display:none (potential drive-by injection).';
        }

        // Pattern D: Mixed Content (Insecure HTTP resources loaded on HTTPS)
        $mixedContentMatches = [];
        if ($isHttps) {
            if (preg_match_all('/(src|href)=["\'](http:\/\/[^"\']+\.(js|css|png|jpg|jpeg|gif|webp|svg))["\']/i', $html, $m)) {
                $mixedContentMatches = array_unique($m[2]);
                if (!empty($mixedContentMatches)) {
                    $score -= 15;
                    $threats[] = [
                        'severity'    => 'high',
                        'category'    => 'Mixed Content Vulnerability',
                        'title'       => 'Insecure Mixed Content Detected (' . count($mixedContentMatches) . ' assets)',
                        'description' => 'Browser blocks active content loaded over unencrypted http:// on https:// sites.',
                        'fix'         => 'Update asset URLs to use https:// or protocol-relative // URLs.',
                    ];
                }
            }
        }

        // Check 4: Server Version Fingerprint Leaks
        $serverHeader = $headers['server'] ?? '';
        $xPoweredBy   = $headers['x-powered-by'] ?? '';
        $hasLeak = false;

        if (preg_match('/\d+\.\d+/', $serverHeader) || !empty($xPoweredBy)) {
            $hasLeak = true;
            $score -= 5;
            $threats[] = [
                'severity'    => 'low',
                'category'    => 'Information Disclosure',
                'title'       => 'Exposed Backend Version Fingerprints',
                'description' => "Server exposes detailed technology versions: " . esc(trim("{$serverHeader} {$xPoweredBy}")),
                'fix'         => 'Disable `expose_php = Off` in php.ini and set `ServerTokens Prod` in Apache/Nginx.',
            ];
        }

        if (!empty($malwareIndicators)) {
            foreach ($malwareIndicators as $m) {
                $threats[] = [
                    'severity'    => 'critical',
                    'category'    => 'Malware / Code Obfuscation',
                    'title'       => 'Malicious Code Signature Detected',
                    'description' => $m,
                    'fix'         => 'Audit recent FTP/Git deployments and clean infected theme/plugin files.',
                ];
            }
        }

        $finalScore = max(10, $score);
        $statusText = ($finalScore >= 85) ? 'Clean & Hardened' : (($finalScore >= 60) ? 'Moderate Risk — Needs Hardening' : 'Critical Security Flaws Found');
        $safetyBadge = ($finalScore >= 85) ? 'safe' : (($finalScore >= 60) ? 'warning' : 'danger');

        return [
            'score'              => $finalScore,
            'status_text'        => $statusText,
            'safety_badge'       => $safetyBadge,
            'is_https'           => $isHttps,
            'headers_audit'      => $headerAudits,
            'threats_detected'   => $threats,
            'malware_signatures' => count($malwareIndicators),
            'server_signature'   => $serverHeader ?: 'Hidden',
            'x_powered_by'       => $xPoweredBy ?: 'Hidden',
        ];
    }

    /**
     * 3. Website Bug & Error Detector with Actionable Code Fix Suggestions
     */
    protected function analyzeBugsAndErrors(\DOMXPath $xpath, string $html, array $headers, string $url, int $loadTimeMs, bool $isHttps): array
    {
        $score = 100;
        $detectedBugs = [];

        // Bug 1: Missing Alt Tags on Images (Accessibility & SEO bug)
        $imgNodes = $xpath->query('//img');
        $missingAlt = 0;
        foreach ($imgNodes as $img) {
            $alt = $img->getAttribute('alt');
            if ($alt === null || trim($alt) === '') {
                $missingAlt++;
            }
        }
        if ($missingAlt > 0) {
            $score -= min(20, $missingAlt * 3);
            $detectedBugs[] = [
                'type'        => 'Accessibility Bug',
                'severity'    => 'high',
                'title'       => "Missing Alt Text on {$missingAlt} Image(s)",
                'impact'      => 'Violates WCAG 2.1 AA and EAA 2025 compliance laws. Screen readers cannot describe visuals to visually impaired users.',
                'fix_snippet' => "<!-- Example Fix: Always add descriptive alt attributes -->\n<img src=\"logo.png\" alt=\"YourBrand Cloud Platform Logo\">",
                'solution'    => "Add descriptive alt attributes to all <img> tags, or turn on the SiteOps Auto Alt-Tag Fixer module.",
            ];
        }

        // Bug 2: Missing Mobile Viewport Meta
        $viewportNodes = $xpath->query('//meta[@name="viewport"]/@content');
        if ($viewportNodes->length === 0) {
            $score -= 20;
            $detectedBugs[] = [
                'type'        => 'Mobile Usability Bug',
                'severity'    => 'critical',
                'title'       => 'Missing <meta name="viewport"> Tag',
                'impact'      => 'Pages without a viewport meta tag render in desktop mode on smartphones, resulting in horizontal scrolling and Google mobile search penalties.',
                'fix_snippet' => "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">",
                'solution'    => 'Insert the viewport meta tag inside your HTML <head> section.',
            ];
        }

        // Bug 3: Slow Server Response Time (> 1200ms)
        if ($loadTimeMs > 1200) {
            $score -= 15;
            $detectedBugs[] = [
                'type'        => 'Performance Bug',
                'severity'    => 'medium',
                'title'       => "Slow Server Response Time ({$loadTimeMs} ms)",
                'impact'      => 'High TTFB (Time to First Byte) hurts Core Web Vitals (LCP) and increases bounce rates by up to 32%.',
                'fix_snippet' => "# Apache Gzip Compression (.htaccess)\n<IfModule mod_deflate.c>\n  AddOutputFilterByType DEFLATE text/html text/css text/javascript application/json\n</IfModule>",
                'solution'    => 'Enable Gzip/Brotli compression, configure OPcache, or deploy Cloudflare Edge Caching.',
            ];
        }

        // Bug 4: Missing OpenGraph / Twitter Social Meta Tags
        $ogTitleNodes = $xpath->query('//meta[@property="og:title"]/@content');
        $ogImageNodes = $xpath->query('//meta[@property="og:image"]/@content');
        if ($ogTitleNodes->length === 0 || $ogImageNodes->length === 0) {
            $score -= 10;
            $detectedBugs[] = [
                'type'        => 'Social Sharing Bug',
                'severity'    => 'medium',
                'title'       => 'Missing OpenGraph Social Meta Tags',
                'impact'      => 'When links are shared on LinkedIn, Twitter/X, Slack, or WhatsApp, no rich thumbnail or title card appears.',
                'fix_snippet' => "<meta property=\"og:title\" content=\"Your Page Title\">\n<meta property=\"og:description\" content=\"1-2 line summary\">\n<meta property=\"og:image\" content=\"https://example.com/assets/og-banner.jpg\">\n<meta property=\"og:type\" content=\"website\">",
                'solution'    => 'Include OpenGraph og:title, og:description, and og:image tags in your <head>.',
            ];
        }

        // Bug 5: Missing Favicon Tag
        $faviconNodes = $xpath->query('//link[contains(@rel, "icon")]/@href');
        if ($faviconNodes->length === 0) {
            $score -= 5;
            $detectedBugs[] = [
                'type'        => 'Branding Bug',
                'severity'    => 'low',
                'title'       => 'Missing <link rel="icon"> Favicon',
                'impact'      => 'Browser tabs show generic placeholder icons and Google Mobile search results show default globe icons.',
                'fix_snippet' => "<link rel=\"icon\" type=\"image/svg+xml\" href=\"/favicon.svg\">\n<link rel=\"alternate icon\" href=\"/favicon.ico\">",
                'solution'    => 'Place a 32x32 favicon.ico or SVG favicon in your document root.',
            ];
        }

        // Bug 6: Broken Navigation / Empty Anchors (<a href="#" or href="")
        $brokenLinks = 0;
        $anchorNodes = $xpath->query('//a');
        foreach ($anchorNodes as $a) {
            $href = trim($a->getAttribute('href'));
            if ($href === '' || $href === '#' || strtolower($href) === 'javascript:void(0)') {
                $brokenLinks++;
            }
        }
        if ($brokenLinks > 2) {
            $score -= 10;
            $detectedBugs[] = [
                'type'        => 'User Experience Bug',
                'severity'    => 'medium',
                'title'       => "Found {$brokenLinks} Placeholder or Empty Anchors (href=\"#\")",
                'impact'      => 'Placeholder anchor links cause abrupt page jumps to the top and confuse screen reader navigation.',
                'fix_snippet' => "<!-- Instead of <a href=\"#\">, use a semantic <button> or provide real href URLs -->\n<button type=\"button\" class=\"btn\">Perform Action</button>",
                'solution'    => 'Replace dummy # links with real URLs or semantic <button> elements.',
            ];
        }

        return [
            'score'         => max(20, $score),
            'total_bugs'    => count($detectedBugs),
            'detected_bugs' => $detectedBugs,
        ];
    }

    /**
     * 4. Cyber Security & Hardening Auditor Engine
     */
    protected function analyzeCyberSecurity(\DOMXPath $xpath, string $html, array $headers, string $url, bool $isHttps): array
    {
        $score = 100;
        $audits = [];

        // Audit 1: Cookie Security Flags (OWASP Session Management)
        $cookieHeader = $headers['set-cookie'] ?? '';
        if (!empty($cookieHeader)) {
            $isHttpOnly = (bool) preg_match('/httponly/i', $cookieHeader);
            $isSecure   = (bool) preg_match('/secure/i', $cookieHeader);
            $hasSameSite = (bool) preg_match('/samesite=(lax|strict)/i', $cookieHeader);

            if (!$isHttpOnly || !$isSecure || !$hasSameSite) {
                $score -= 20;
                $missingFlags = [];
                if (!$isHttpOnly) $missingFlags[] = 'HttpOnly';
                if (!$isSecure) $missingFlags[] = 'Secure';
                if (!$hasSameSite) $missingFlags[] = 'SameSite';

                $audits[] = [
                    'name'           => 'Cookie Security Flags (XSS & CSRF Defense)',
                    'status'         => 'fail',
                    'severity'       => 'high',
                    'category'       => 'Session Management',
                    'finding'        => 'Cookies are missing critical defense flags: ' . implode(', ', $missingFlags) . '.',
                    'impact'         => 'Without HttpOnly, malicious scripts can read session tokens via XSS. Without Secure, cookies transmit unencrypted.',
                    'fix_snippet'    => "Set-Cookie: session_id=xyz; Path=/; Secure; HttpOnly; SameSite=Lax",
                    'recommendation' => 'Enforce HttpOnly, Secure, and SameSite=Lax/Strict on all session and authentication cookies.',
                ];
            } else {
                $audits[] = [
                    'name'           => 'Cookie Security Flags (XSS & CSRF Defense)',
                    'status'         => 'pass',
                    'severity'       => 'none',
                    'category'       => 'Session Management',
                    'finding'        => 'Session cookies enforce HttpOnly, Secure, and SameSite flags.',
                    'impact'         => 'Session tokens are safeguarded against theft via cross-site scripting and cross-site request forgery.',
                    'fix_snippet'    => null,
                    'recommendation' => 'Maintain current hardened cookie policy.',
                ];
            }
        } else {
            $audits[] = [
                'name'           => 'Cookie Security Flags (XSS & CSRF Defense)',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Session Management',
                'finding'        => 'No unhardened session cookies exposed on public landing response.',
                'impact'         => 'Zero unencrypted cookie leakage detected on initial endpoint.',
                'fix_snippet'    => null,
                'recommendation' => 'Ensure any future authentication cookies include Secure, HttpOnly, and SameSite.',
            ];
        }

        // Audit 2: CORS (Cross-Origin Resource Sharing) Misconfiguration Check
        $corsHeader = $headers['access-control-allow-origin'] ?? '';
        if ($corsHeader === '*') {
            $score -= 15;
            $audits[] = [
                'name'           => 'Cross-Origin Resource Sharing (CORS) Configuration',
                'status'         => 'warning',
                'severity'       => 'medium',
                'category'       => 'Access Control',
                'finding'        => 'Wildcard Access-Control-Allow-Origin: * header detected.',
                'impact'         => 'Any external domain can query and read responses from this origin, which is dangerous if sensitive user data is returned.',
                'fix_snippet'    => "# Apache / Nginx: Restrict CORS to trusted origins only\nHeader set Access-Control-Allow-Origin \"https://app.yourdomain.com\"",
                'recommendation' => 'Restrict CORS to explicitly trusted whitelist origins rather than using a global wildcard.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Cross-Origin Resource Sharing (CORS) Configuration',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Access Control',
                'finding'        => $corsHeader ? "CORS restricted to authorized origin: {$corsHeader}" : 'No unsafe wildcard CORS origin exposed.',
                'impact'         => 'Cross-origin unauthorized data exfiltration is restricted.',
                'fix_snippet'    => null,
                'recommendation' => 'CORS headers are appropriately configured.',
            ];
        }

        // Audit 3: Subresource Integrity (SRI) on External CDN Assets (Supply-Chain Attack Defense)
        $externalScripts = 0;
        $missingSriCount = 0;
        $scriptNodes = $xpath->query('//script[@src]');
        foreach ($scriptNodes as $script) {
            $src = trim($script->getAttribute('src'));
            if (preg_match('~^https?://(?!' . preg_quote(parse_url($url, PHP_URL_HOST) ?? '', '~') . ')~i', $src)) {
                $externalScripts++;
                $integrity = $script->getAttribute('integrity');
                if (empty($integrity)) {
                    $missingSriCount++;
                }
            }
        }

        if ($missingSriCount > 0) {
            $score -= min(15, $missingSriCount * 5);
            $audits[] = [
                'name'           => "Subresource Integrity (SRI) Supply-Chain Defense ({$missingSriCount} Unchecked)",
                'status'         => 'warning',
                'severity'       => 'medium',
                'category'       => 'Supply Chain Security',
                'finding'        => "{$missingSriCount} external CDN script(s) loaded without cryptographic integrity hashes.",
                'impact'         => 'If the third-party CDN is compromised, attackers can inject malicious JavaScript into your users\' browsers.',
                'fix_snippet'    => "<!-- Always include integrity hash and crossorigin attribute -->\n<script src=\"https://cdn.example.com/lib.js\"\n  integrity=\"sha384-oqVuAfXRKap7fdgcCY5uykM6+R9GqQ8K/uxy9rx7HNQlGYl1kPzQho1wx4JwY8wC\"\n  crossorigin=\"anonymous\"></script>",
                'recommendation' => 'Add cryptographic `integrity` SHA hashes to all external script and stylesheet tags.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Subresource Integrity (SRI) Supply-Chain Defense',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Supply Chain Security',
                'finding'        => 'Zero unverified third-party CDN scripts detected.',
                'impact'         => 'Scripts are verified against third-party supply chain tampering.',
                'fix_snippet'    => null,
                'recommendation' => 'Maintain Subresource Integrity hashes on any future third-party scripts.',
            ];
        }

        // Audit 4: Form Credential Transmission & Plaintext Interception
        $passwordForms = $xpath->query('//form[.//input[@type="password"]]');
        $hasInsecureAction = false;
        foreach ($passwordForms as $f) {
            $action = trim($f->getAttribute('action'));
            if (str_starts_with(strtolower($action), 'http://')) {
                $hasInsecureAction = true;
                break;
            }
        }

        if ($hasInsecureAction || (!$isHttps && $passwordForms->length > 0)) {
            $score -= 30;
            $audits[] = [
                'name'           => 'Form Password & Credential Encryption',
                'status'         => 'fail',
                'severity'       => 'critical',
                'category'       => 'Data in Transit Encryption',
                'finding'        => 'Login or password form submits credentials over unencrypted HTTP.',
                'impact'         => 'Credentials can be intercepted via Man-in-the-Middle (MitM) packet sniffing on public networks.',
                'fix_snippet'    => "<form method=\"POST\" action=\"https://yourdomain.com/login\">",
                'recommendation' => 'Enforce HTTPS for all form action targets and verify TLS redirection.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Form Password & Credential Encryption',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Data in Transit Encryption',
                'finding'        => 'All authentication and form submissions are protected via HTTPS.',
                'impact'         => 'Zero unencrypted password transmission vectors discovered.',
                'fix_snippet'    => null,
                'recommendation' => 'Forms adhere to OWASP Transport Layer security guidelines.',
            ];
        }

        // Audit 5: Permissions-Policy (Hardware Access Lockdown)
        $permPolicy = $headers['permissions-policy'] ?? ($headers['feature-policy'] ?? '');
        if (empty($permPolicy)) {
            $score -= 10;
            $audits[] = [
                'name'           => 'Permissions-Policy (Browser Hardware Lockdown)',
                'status'         => 'warning',
                'severity'       => 'low',
                'category'       => 'Client Privilege Hardening',
                'finding'        => 'Permissions-Policy header is not configured.',
                'impact'         => 'Embedded third-party iframes or compromised scripts could potentially request camera, microphone, or geolocation permissions.',
                'fix_snippet'    => "# Apache / Nginx Header\nPermissions-Policy: camera=(), microphone=(), geolocation=(), payment=()",
                'recommendation' => 'Configure Permissions-Policy to explicitly disable unnecessary hardware access for iframes and scripts.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Permissions-Policy (Browser Hardware Lockdown)',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Client Privilege Hardening',
                'finding'        => 'Permissions-Policy is active: ' . esc(substr($permPolicy, 0, 50)) . '...',
                'impact'         => 'Unauthorized client hardware privilege escalation is blocked.',
                'fix_snippet'    => null,
                'recommendation' => 'Hardware policies are properly hardened.',
            ];
        }

        // Audit 6: Cross-Origin Isolation (COOP & COEP - Spectre Defense)
        $coop = $headers['cross-origin-opener-policy'] ?? '';
        $coep = $headers['cross-origin-embedder-policy'] ?? '';
        if (empty($coop)) {
            $score -= 5;
            $audits[] = [
                'name'           => 'Cross-Origin Opener Policy (COOP - Window Isolation)',
                'status'         => 'warning',
                'severity'       => 'low',
                'category'       => 'Cross-Origin Isolation',
                'finding'        => 'Cross-Origin-Opener-Policy header is missing.',
                'impact'         => 'Prevents cross-origin popups and windows from retaining references to your window object, defending against side-channel timing leaks.',
                'fix_snippet'    => "Cross-Origin-Opener-Policy: same-origin",
                'recommendation' => 'Deploy Cross-Origin-Opener-Policy: same-origin to isolate your browsing context.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Cross-Origin Opener Policy (COOP - Window Isolation)',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'Cross-Origin Isolation',
                'finding'        => 'COOP header enforced: ' . esc($coop),
                'impact'         => 'Window reference isolation active against cross-origin attacks.',
                'fix_snippet'    => null,
                'recommendation' => 'Cross-origin isolation configuration is optimal.',
            ];
        }

        // Audit 7: Potentially Dangerous Inline Event Handlers (XSS Vectors)
        $dangerousHandlers = 0;
        $handlerAttributes = ['onclick', 'onerror', 'onload', 'onmouseover', 'onfocus'];
        foreach ($handlerAttributes as $attr) {
            $nodes = $xpath->query("//*[translate(@{$attr}, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz') != '']");
            $dangerousHandlers += $nodes->length;
        }

        if ($dangerousHandlers > 5) {
            $score -= 10;
            $audits[] = [
                'name'           => "Inline DOM Event Handlers ({$dangerousHandlers} Instances Found)",
                'status'         => 'warning',
                'severity'       => 'medium',
                'category'       => 'XSS Attack Surface',
                'finding'        => "Found {$dangerousHandlers} inline event handlers (onclick, onerror, etc.) embedded in HTML tags.",
                'impact'         => 'Inline event handlers prevent enforcing a strict Content Security Policy (requires unsafe-inline), widening the attack surface for Stored and Reflected XSS.',
                'fix_snippet'    => "<!-- Instead of inline: <button onclick=\"run()\"> -->\n<!-- Use modern decoupled event listeners: -->\ndocument.getElementById('myBtn').addEventListener('click', run);",
                'recommendation' => 'Migrate inline event attributes to external script event listeners to enable strict CSP without unsafe-inline.',
            ];
        } else {
            $audits[] = [
                'name'           => 'Inline DOM Event Handlers & Execution Hygiene',
                'status'         => 'pass',
                'severity'       => 'none',
                'category'       => 'XSS Attack Surface',
                'finding'        => 'Minimal or zero risky inline event handlers detected.',
                'impact'         => 'DOM execution hygiene conforms to modern CSP recommendations.',
                'fix_snippet'    => null,
                'recommendation' => 'Maintain separation of JavaScript logic from HTML markup.',
            ];
        }

        $passed = count(array_filter($audits, fn($a) => $a['status'] === 'pass'));
        $warnings = count(array_filter($audits, fn($a) => $a['status'] === 'warning'));
        $fails = count(array_filter($audits, fn($a) => $a['status'] === 'fail'));

        $finalScore = max(15, $score);
        $riskLevel = ($finalScore >= 85) ? 'Low Risk (Hardened)' : (($finalScore >= 60) ? 'Moderate Risk (Hardening Needed)' : 'High / Critical Risk');
        $riskBadge = ($finalScore >= 85) ? 'safe' : (($finalScore >= 60) ? 'warning' : 'danger');

        return [
            'score'          => $finalScore,
            'risk_level'     => $riskLevel,
            'risk_badge'     => $riskBadge,
            'total_passed'   => $passed,
            'total_warnings' => $warnings,
            'total_failed'   => $fails,
            'total_audits'   => count($audits),
            'audits'         => $audits,
        ];
    }
}
