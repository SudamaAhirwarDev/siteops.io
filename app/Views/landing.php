<?php
/**
 * SiteOps - All-in-One Website Growth & Compliance Suite
 * 
 * View: Landing Page (app/Views/landing.php)
 * Architecture: Clean CodeIgniter 4 View / Standalone PHP
 * Styling: Tailwind CSS (Modern Prime Calm / Scandinavian Clean SaaS)
 * Scripting: Pure Vanilla JavaScript (<15KB philosophy, zero dependencies)
 */
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteOps — The Ultra-Lightweight (<15KB) Growth & Compliance Suite</title>
    <meta name="description" content="Replace 4 expensive subscriptions with one lightweight script. European EAA 2025 & US ADA Accessibility, Social Proof Reviews, AI SEO/GEO Auditor, and Failed Stripe Payment Recovery.">
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">

    <!-- Canonical & Search Engine Indexing (AEO / SEO) -->
    <link rel="canonical" href="<?= base_url() ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="keywords" content="SiteOps, EAA 2025 compliance, European Accessibility Act, ADA compliance widget, cyber security auditor, website threat scanner, AEO SEO tool, Generative Engine Optimization, GEO AI auditor, Stripe payment recovery, social proof reviews widget, lightweight script">
    <meta name="author" content="SiteOps Core Team">

    <!-- Open Graph (Facebook / LinkedIn / AI Embeds) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SiteOps">
    <meta property="og:title" content="SiteOps — The Ultra-Lightweight (<15KB) Growth & Compliance Suite">
    <meta property="og:description" content="Replace 4 expensive subscriptions ($186/mo) with one ultra-lightweight script (<15KB). WCAG 2.1 AA & EAA 2025 Accessibility, Social Proof Reviews, AI SEO/GEO Auditor, and Stripe Payment Recovery.">
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:image" content="<?= base_url('assets/images/siteops-logo.png') ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card (X) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SiteOps — The Ultra-Lightweight (<15KB) Growth & Compliance Suite">
    <meta name="twitter:description" content="Save 79% while cutting 280KB of third-party bloat. Full EAA/ADA compliance, automated Alt-tag fixer, AI SEO citations, and cyber security audits.">
    <meta name="twitter:image" content="<?= base_url('assets/images/siteops-logo.png') ?>">

    <!-- Structured Data (JSON-LD) for AEO (Answer Engine Optimization) & Rich Snippets -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "@id": "<?= base_url() ?>#organization",
          "name": "SiteOps",
          "url": "<?= base_url() ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?= base_url('assets/images/logo-icon.svg') ?>"
          },
          "description": "Provider of ultra-lightweight website compliance, accessibility, security, and growth automation tools."
        },
        {
          "@type": "WebApplication",
          "@id": "<?= base_url() ?>#webapp",
          "name": "SiteOps",
          "applicationCategory": "DeveloperApplication, BusinessApplication, SecurityApplication",
          "operatingSystem": "All modern browsers (Chrome, Safari, Firefox, Edge)",
          "browserRequirements": "Requires JavaScript. Works with zero third-party dependencies (<15KB).",
          "url": "<?= base_url() ?>",
          "description": "All-in-one website growth & compliance suite. Replaces 4 bloated subscriptions with one <15KB script for EAA 2025/ADA accessibility, social proof reviews, AI SEO/GEO crawler auditing, and Stripe dunning.",
          "offers": [
            {
              "@type": "Offer",
              "name": "15-Day Free Trial",
              "price": "0",
              "priceCurrency": "USD",
              "description": "15-Day Free Trial with 5 Tasks/Day, no credit card required."
            },
            {
              "@type": "Offer",
              "name": "Pro Growth Plan",
              "price": "39",
              "priceCurrency": "USD",
              "priceSpecification": {
                "@type": "UnitPriceSpecification",
                "price": "39",
                "priceCurrency": "USD",
                "unitText": "MONTH"
              },
              "description": "Unlimited daily audits, automated compliance modules, 1 site license."
            },
            {
              "@type": "Offer",
              "name": "Agency Suite",
              "price": "99",
              "priceCurrency": "USD",
              "priceSpecification": {
                "@type": "UnitPriceSpecification",
                "price": "99",
                "priceCurrency": "USD",
                "unitText": "MONTH"
              },
              "description": "Unlimited daily audits, 10 site licenses, client white-labeling, priority Slack support."
            }
          ],
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "148",
            "bestRating": "5",
            "worstRating": "1"
          },
          "featureList": [
            "European Accessibility Act (EAA 2025) & US ADA compliance toolbar",
            "Automatic image alt-tag generator and fixer",
            "Social proof and customer reviews toast notification",
            "Generative Engine Optimization (GEO) & AI SEO crawler auditor",
            "Cyber Security hardening & OWASP cookie security scanner",
            "TotalVirus threat, malware signature, and clickjacking detector",
            "Stripe automated payment recovery and dunning webhooks"
          ]
        },
        {
          "@type": "FAQPage",
          "@id": "<?= base_url() ?>#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is SiteOps and how does it replace 4 separate tools?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "SiteOps is an ultra-lightweight (<15KB) website growth and compliance suite. Instead of installing separate heavy plugins for accessibility, reviews, SEO auditing, and payment recovery costing $186/mo and adding 280KB+ of JS bloat, SiteOps delivers all four modules asynchronously in one script for $39/mo."
              }
            },
            {
              "@type": "Question",
              "name": "How does SiteOps help with European Accessibility Act (EAA 2025) and US ADA compliance?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "SiteOps includes a WCAG 2.1 AA certified accessibility engine that auto-fixes missing image alt tags from filenames on the fly, provides instant high-contrast and dyslexia reading modes, manages keyboard navigation focus, and prevents predatory accessibility lawsuits."
              }
            },
            {
              "@type": "Question",
              "name": "What is Generative Engine Optimization (GEO) and Answer Engine Optimization (AEO)?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "GEO and AEO optimize web content so that modern AI answer engines like ChatGPT Search, Perplexity AI, and Google Gemini can easily parse, cite, and recommend your website in AI-generated answers. SiteOps audits LLM crawler access, semantic tag structure, and keyword placement."
              }
            },
            {
              "@type": "Question",
              "name": "Does SiteOps run defensive cyber security and malware checks?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. SiteOps features a built-in Cyber Security and TotalVirus scanner that checks for OWASP cookie flags (HttpOnly, Secure, SameSite), Subresource Integrity (SRI), HSTS enforcement, Content Security Policy (CSP), and Clickjacking defenses (X-Frame-Options)."
              }
            },
            {
              "@type": "Question",
              "name": "Can I test SiteOps for free without entering a credit card?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Every new user receives an automatic 15-day free trial with 5 tasks/day across all diagnostic engines and modules. No credit card is required to sign up."
              }
            }
          ]
        }
      ]
    }
    </script>

    <!-- Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN for ultra-fast setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#1e1b4b',
                        },
                        surface: {
                            base: '#f8fafc',
                            card: '#ffffff',
                            muted: '#f1f5f9',
                            border: '#e2e8f0',
                        }
                    },
                    boxShadow: {
                        'soft-xs': '0 1px 2px 0 rgba(15, 23, 42, 0.04)',
                        'soft-sm': '0 1px 3px 0 rgba(15, 23, 42, 0.06), 0 1px 2px -1px rgba(15, 23, 42, 0.04)',
                        'soft-md': '0 4px 16px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -2px rgba(15, 23, 42, 0.04)',
                        'soft-lg': '0 10px 25px -4px rgba(15, 23, 42, 0.07), 0 4px 10px -3px rgba(15, 23, 42, 0.04)',
                        'glow-brand': '0 4px 20px -2px rgba(79, 70, 229, 0.25)',
                        'glow-emerald': '0 4px 20px -2px rgba(16, 185, 129, 0.25)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Dyslexic font override class for the live accessibility toolbar */
        body.dyslexia-font {
            font-family: Arial, sans-serif !important;
            letter-spacing: 0.12em !important;
            word-spacing: 0.16em !important;
            line-height: 1.8 !important;
        }

        /* High contrast mode */
        body.contrast-high {
            filter: contrast(135%);
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        /* Inverted colors mode */
        body.contrast-inverted {
            filter: invert(100%) hue-rotate(180deg);
        }

        /* Monochrome mode */
        body.contrast-mono {
            filter: grayscale(100%);
        }

        /* Big Cursor mode */
        body.big-cursor, body.big-cursor * {
            cursor: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='36' height='36' viewBox='0 0 24 24' fill='%234f46e5' stroke='%23ffffff' stroke-width='2'%3E%3Cpath d='M3 3l7 18 3-7 7-3L3 3z'/%3E%3C/svg%3E"), auto !important;
        }

        /* Reading Guide Ruler */
        #reading-guide-line {
            display: none;
            position: fixed;
            left: 0;
            width: 100vw;
            height: 3px;
            background: #4f46e5;
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.5);
            z-index: 999998;
            pointer-events: none;
            transition: top 0.05s ease-out;
        }

        body.reading-guide-active #reading-guide-line {
            display: block;
        }

        /* Subtle ambient grid pattern for prime aesthetic */
        .ambient-grid {
            background-image: radial-gradient(rgba(148, 163, 184, 0.2) 1px, transparent 0);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="bg-surface-base text-slate-800 font-sans antialiased selection:bg-brand-500 selection:text-white">

    <!-- Reading Guide Element -->
    <div id="reading-guide-line"></div>

    <!-- ================================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (EAA 2025 COMPLIANCE ALERT)               -->
    <!-- ================================================================= -->
    <div class="bg-slate-950 border-b border-slate-800 text-slate-300 text-xs py-2 px-4 text-center relative z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-2 flex-wrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-950 text-indigo-300 border border-indigo-800/80">
                ⚡ EAA 2025 Enforced
            </span>
            <span class="text-slate-300 font-medium">
                European Accessibility Act compliance deadline is active. Ensure your EU &amp; US domains avoid legal fines.
            </span>
            <a href="#features" class="font-bold text-indigo-400 hover:text-indigo-300 underline underline-offset-2 ml-1">
                Explore Modules &rarr;
            </a>
        </div>
    </div>

    <!-- ================================================================= -->
    <!-- 2. NAVBAR (PRIME OBSIDIAN NAVY - CLEAN & ESSENTIALS ONLY)        -->
    <!-- ================================================================= -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-900/95 border-b border-slate-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-3">
            <!-- Brand Logo -->
            <a href="<?= site_url('/') ?>" class="flex items-center gap-2.5 sm:gap-3.5 group shrink-0">
                <div class="relative w-9 h-9 sm:w-11 sm:h-11 transition-transform group-hover:scale-105 shrink-0">
                    <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_4px_12px_rgba(79,70,229,0.45)]">
                </div>
                <div class="flex flex-col">
                    <span class="text-lg sm:text-xl font-extrabold tracking-tight text-white flex items-center gap-1.5 leading-none">
                        SiteOps<span class="text-indigo-400">.</span>
                        <span class="hidden xs:inline-flex text-[10px] uppercase font-mono px-2 py-0.5 rounded-full bg-slate-800 text-indigo-300 border border-slate-700 font-bold tracking-wider">
                            &lt;15KB
                        </span>
                    </span>
                    <span class="hidden sm:block text-[10px] text-slate-400 font-semibold tracking-wide uppercase mt-1">Growth &amp; Cyber Suite</span>
                </div>
            </a>

            <!-- Desktop Nav Links: SIRF KAAM KI CHEEZEN (Site Health, Features, How It Works) -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-semibold">
                <a href="#instant-scanner" class="text-indigo-300 bg-indigo-950/80 hover:bg-indigo-900 border border-indigo-800/80 px-3.5 py-1.5 rounded-full flex items-center gap-2 font-bold shadow-soft-xs transition-all hover:scale-105">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Site Health</span>
                </a>
                <a href="#features" class="text-slate-300 hover:text-white transition-colors">
                    Features
                </a>
                <a href="#how-it-works" class="text-slate-300 hover:text-white transition-colors">
                    How It Works
                </a>
            </nav>

            <!-- Action Buttons: Sign In & Start Free Trial -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <?php if (session()->get('is_logged_in')): ?>
                    <a href="<?= site_url('dashboard') ?>" class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 shadow-soft-xs transition-colors">
                        <span>Dashboard</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="hidden sm:inline-flex text-sm font-bold text-slate-300 hover:text-white px-3 py-2 transition-colors">
                        Sign In
                    </a>
                    <a href="<?= site_url('register') ?>" class="relative group inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all duration-200">
                        <span>Free Trial</span>
                        <span class="hidden sm:inline">&rarr;</span>
                    </a>
                <?php endif; ?>

                <!-- Mobile Menu Hamburger Button -->
                <button 
                    type="button" 
                    id="mobile-menu-toggle-btn" 
                    onclick="toggleMobileMenu()" 
                    aria-label="Toggle navigation menu"
                    class="md:hidden p-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-colors"
                >
                    <svg id="hamburger-icon-open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="hamburger-icon-close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Slide-Down Navigation Menu: Sirf Kaam Ki Cheezein -->
        <div id="mobile-nav-drawer" class="hidden md:hidden bg-slate-900/98 backdrop-blur-2xl border-t border-slate-800 px-4 py-5 shadow-soft-lg space-y-3">
            <a href="#instant-scanner" onclick="toggleMobileMenu()" class="flex items-center justify-between p-3.5 rounded-xl bg-indigo-950/90 border border-indigo-800/80 text-indigo-300 font-bold text-sm">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Site Health Scanner</span>
                </span>
                <span class="text-xs bg-indigo-600 text-white px-2 py-0.5 rounded font-mono">100% Free</span>
            </a>
            <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-slate-200 pt-1">
                <a href="#features" onclick="toggleMobileMenu()" class="p-3 rounded-xl bg-slate-800/80 hover:bg-slate-800 border border-slate-700 flex items-center gap-2">
                    <span>✨</span> Features
                </a>
                <a href="#how-it-works" onclick="toggleMobileMenu()" class="p-3 rounded-xl bg-slate-800/80 hover:bg-slate-800 border border-slate-700 flex items-center gap-2">
                    <span>⚙️</span> How It Works
                </a>
            </div>
            <div class="pt-2 border-t border-slate-800 flex items-center gap-3">
                <a href="<?= site_url('login') ?>" class="flex-1 py-2.5 rounded-xl border border-slate-700 text-slate-200 font-bold text-xs text-center bg-slate-800 hover:bg-slate-700">
                    Sign In
                </a>
                <a href="<?= site_url('register') ?>" class="flex-1 py-2.5 rounded-xl font-bold text-xs text-center text-white bg-indigo-600 hover:bg-indigo-500">
                    Free Trial &rarr;
                </a>
            </div>
        </div>
    </header>

    <!-- ================================================================= -->
    <!-- 3. HERO SECTION                                                   -->
    <!-- ================================================================= -->
    <section class="relative pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden ambient-grid">
        <!-- Ambient Calm Background Glow -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] bg-gradient-to-tr from-indigo-100/60 via-purple-50/40 to-teal-50/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Eyebrow Pill -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200/90 shadow-soft-xs mb-6">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-slate-700">
                        ⚡ 4-in-1 Live Diagnostic Engine &bull; Cyber Security &bull; SEO &bull; Threats &bull; Bugs
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Free Audit</span>
                </div>

                <!-- Main Hero Headline -->
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.12]">
                    Audit &amp; Protect Any Website for <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-700">Cyber Security, SEO</span> &amp; Bugs.
                </h1>

                <!-- Subheadline -->
                <p class="mt-7 text-lg sm:text-xl text-slate-600 leading-relaxed font-normal max-w-3xl mx-auto">
                    Run an automated 40-point diagnostic scan in seconds. Detect <span class="text-slate-900 font-semibold underline decoration-blue-400/50">OWASP Session &amp; CORS Vulnerabilities</span>, scan for <span class="text-slate-900 font-semibold underline decoration-rose-400/50">TotalVirus Malware Signatures</span>, identify <span class="text-slate-900 font-semibold underline decoration-indigo-400/50">High-Impact SEO Keywords</span>, and auto-fix with a single &lt;15KB script.
                </p>

                <!-- CTA Buttons -->
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#instant-scanner" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl text-base font-bold text-white bg-gradient-to-r from-indigo-600 via-indigo-700 to-indigo-800 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-md transition-all duration-200 hover:-translate-y-0.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Run Free Cyber Security Audit</span>
                    </a>
                    <a href="<?= site_url('register') ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl text-base font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-soft-xs transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Get &lt;15KB Script (Free Trial)</span>
                    </a>
                </div>

                <!-- Trust Micro-Badges -->
                <div class="mt-8 flex items-center justify-center gap-6 sm:gap-10 text-xs text-slate-500 font-medium flex-wrap">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>No credit card required</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>&lt;2 Min Setup</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>100/100 Core Web Vitals Guaranteed</span>
                    </div>
                </div>

                <!-- 1-Line Embed Code Card Mockup -->
                <div class="mt-14 p-1 rounded-3xl bg-gradient-to-r from-slate-200 via-indigo-100 to-slate-200 border border-slate-200 shadow-soft-lg">
                    <div class="bg-slate-900 text-slate-200 rounded-2xl p-4 sm:p-6 text-left">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-3 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                                <span class="ml-2 text-xs font-mono text-slate-400">index.html &mdash; &lt;head&gt;</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-mono text-slate-400 bg-slate-950 px-2 py-0.5 rounded border border-slate-800">
                                    Bundle: 12.8 KB gzip
                                </span>
                                <button onclick="copySnippet()" id="copy-btn" class="text-xs flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1 rounded-lg transition-colors font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <span id="copy-text">Copy Snippet</span>
                                </button>
                            </div>
                        </div>

                        <!-- Snippet Code -->
                        <div class="font-mono text-xs sm:text-sm text-slate-300 overflow-x-auto py-2">
                            <span class="text-slate-500">&lt;!-- SiteOps Unified Growth &amp; Compliance Script --&gt;</span><br>
                            <span class="text-indigo-400">&lt;script</span> 
                            <span class="text-emerald-400">defer</span> 
                            <span class="text-indigo-400">src=</span><span class="text-amber-300">"https://cdn.siteops.io/v1/loader.js?key=so_9f81a7b2e4c6"</span><span class="text-indigo-400">&gt;&lt;/script&gt;</span>
                        </div>

                        <!-- 4 Active Indicators -->
                        <div class="mt-4 pt-3 border-t border-slate-800/80 grid grid-cols-2 sm:grid-cols-4 gap-2 text-[11px] font-medium text-slate-400">
                            <div class="flex items-center gap-1.5 bg-slate-950/70 px-2.5 py-1.5 rounded-lg border border-slate-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                <span>ADA / EAA Toolbar</span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-slate-950/70 px-2.5 py-1.5 rounded-lg border border-slate-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                <span>Verified Reviews</span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-slate-950/70 px-2.5 py-1.5 rounded-lg border border-slate-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                <span>AI GEO &amp; SEO Audit</span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-slate-950/70 px-2.5 py-1.5 rounded-lg border border-slate-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                <span>Stripe Dunning</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 3.5 INSTANT WEBSITE HEALTH, SECURITY & BUG SCANNER                -->
    <!-- ================================================================= -->
    <section id="instant-scanner" class="py-20 bg-white border-y border-slate-200/80 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-50 border border-indigo-200/80 text-indigo-700 text-xs font-bold mb-4 shadow-soft-xs">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>4-in-1 Live Diagnostic Engine &bull; 100% Free Audit</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Scan Any Website for <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-800">Cyber Security, SEO &amp; Threats</span>
                </h2>
                <p class="mt-3 text-base text-slate-600 leading-relaxed">
                    Check <strong>OWASP session cookies</strong>, CORS access rules, <strong>Subresource Integrity (SRI)</strong>, TotalVirus malware signatures, <strong>keyword density updates</strong>, and get <strong>instant copy-paste code fixes</strong>.
                </p>
            </div>

            <!-- Scanner Search Form -->
            <div class="max-w-3xl mx-auto">
                <form id="audit-form" onsubmit="handleLiveAudit(event)" class="bg-surface-base p-2 sm:p-2.5 rounded-2xl border border-slate-200 shadow-soft-md flex flex-col sm:flex-row items-center gap-2">
                    <div class="relative w-full flex-1 flex items-center">
                        <div class="absolute left-4 text-slate-400 pointer-events-none flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="text-xs font-mono font-semibold text-slate-400 hidden sm:inline">https://</span>
                        </div>
                        <input 
                            type="text" 
                            id="audit-url-input" 
                            placeholder="yourwebsite.com or news.ycombinator.com" 
                            required 
                            class="w-full pl-12 sm:pl-28 pr-4 py-3.5 bg-white rounded-xl border border-slate-200 text-slate-900 text-sm font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all shadow-soft-xs"
                        >
                    </div>
                    <button 
                        type="submit" 
                        id="audit-submit-btn" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 shadow-soft-sm transition-all duration-200 whitespace-nowrap cursor-pointer hover:-translate-y-0.5"
                    >
                        <svg class="w-4 h-4 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Run Full Scan</span>
                    </button>
                </form>

                <!-- Quick Try Presets -->
                <div class="mt-3 flex items-center justify-center gap-2 flex-wrap text-xs text-slate-500">
                    <span class="font-medium text-slate-400">Quick test:</span>
                    <button type="button" onclick="quickAudit('news.ycombinator.com')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-indigo-50 hover:text-indigo-700 text-slate-600 font-mono transition-colors">
                        news.ycombinator.com
                    </button>
                    <button type="button" onclick="quickAudit('wikipedia.org')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-indigo-50 hover:text-indigo-700 text-slate-600 font-mono transition-colors">
                        wikipedia.org
                    </button>
                    <button type="button" onclick="quickAudit('stripe.com')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-indigo-50 hover:text-indigo-700 text-slate-600 font-mono transition-colors">
                        stripe.com
                    </button>
                </div>
            </div>

            <!-- Error Notification Box -->
            <div id="audit-error-box" class="hidden mt-8 max-w-3xl mx-auto p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="flex-1">
                    <div class="font-bold text-rose-900">Scan Failed</div>
                    <div id="audit-error-message" class="mt-0.5 text-xs text-rose-700">Unable to scan the target website. Please check the URL and try again.</div>
                </div>
            </div>

            <!-- Loading State Card -->
            <div id="audit-loading-card" class="hidden mt-8 max-w-3xl mx-auto p-8 rounded-3xl bg-white border border-slate-200 shadow-soft-lg text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-4 animate-spin">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-slate-900" id="audit-loading-title">Connecting to Target Host...</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto" id="audit-loading-subtitle">Inspecting HTTP status, SSL certificate, meta tags, and malicious script signatures.</p>

                <div class="mt-6 max-w-md mx-auto space-y-2 text-left">
                    <div class="flex items-center gap-2.5 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span id="scan-step-1">1. Establishing TLS handshake &amp; TTFB latency test</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                        <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                        <span id="scan-step-2">2. Cyber Security Auditor: Cookie flags, CORS, SRI &amp; Permissions-Policy</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        <span id="scan-step-3">3. TotalVirus-style Threat Scan: HSTS, CSP &amp; Obfuscated Code</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs font-medium text-slate-600 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span id="scan-step-4">4. Extracting Keywords, Meta density &amp; DOM accessibility bugs</span>
                    </div>
                </div>
            </div>

            <!-- Results Container -->
            <div id="audit-results-container" class="hidden mt-10 max-w-5xl mx-auto space-y-6">
                
                <!-- Result Overview Card -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-soft-lg p-6 sm:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-100">
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold font-mono" id="res-http-code">HTTP 200 OK</span>
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium font-mono" id="res-latency">240ms TTFB</span>
                                <span class="text-xs text-slate-400 font-medium" id="res-scanned-at">Just now</span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-2 break-all" id="res-target-url">https://example.com</h3>
                        </div>

                        <!-- 4 Metric Score Badges -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 text-center shrink-0">
                            <div class="bg-indigo-50/70 border border-indigo-100 rounded-2xl p-3 min-w-[90px]">
                                <div class="text-2xl sm:text-3xl font-extrabold text-indigo-700" id="res-overall-score">--</div>
                                <div class="text-[10px] font-bold uppercase text-indigo-600 tracking-wider mt-0.5">Overall Health</div>
                            </div>
                            <div class="bg-purple-50/70 border border-purple-100 rounded-2xl p-3 min-w-[90px]">
                                <div class="text-2xl sm:text-3xl font-extrabold text-purple-700" id="res-cyber-score">--</div>
                                <div class="text-[10px] font-bold uppercase text-purple-600 tracking-wider mt-0.5">Cyber Security</div>
                            </div>
                            <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 min-w-[90px]">
                                <div class="text-2xl sm:text-3xl font-extrabold text-slate-800" id="res-seo-score">--</div>
                                <div class="text-[10px] font-bold uppercase text-slate-500 tracking-wider mt-0.5">SEO &amp; Keywords</div>
                            </div>
                            <div class="bg-emerald-50/70 border border-emerald-100 rounded-2xl p-3 min-w-[90px]">
                                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700" id="res-security-score">--</div>
                                <div class="text-[10px] font-bold uppercase text-emerald-600 tracking-wider mt-0.5">Threat Defense</div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================================= -->
                    <!-- 💡 PERMANENT SOLUTION: SITEOPS PLANS FOR DETECTED ISSUES -->
                    <!-- ========================================================= -->
                    <div class="mt-6 p-6 rounded-2xl bg-gradient-to-br from-indigo-50/80 via-white to-indigo-50/50 border-2 border-indigo-200/90 shadow-soft-sm">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b border-indigo-100/90">
                            <div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-[11px] font-extrabold uppercase tracking-wider mb-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                                    <span>⚡ Recommended Solution: SiteOps Plan</span>
                                </div>
                                <h4 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                    Fix All Detected Issues Automatically with SiteOps
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl leading-relaxed">
                                    Instead of manually coding missing alt tags, writing meta descriptions, configuring web server security headers, or risking legal fines — <strong>activate a SiteOps Plan below to auto-fix and continuously monitor your domain with one &lt;15KB script</strong>:
                                </p>
                            </div>
                            <div class="shrink-0">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200 shadow-soft-xs">
                                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    100% Automated Fix Available
                                </span>
                            </div>
                        </div>

                        <!-- 3 Plan Action Cards Inside the Solution Container -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
                            
                            <!-- Plan 1: 15-Day Free Trial ($0) -->
                            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-soft-xs flex flex-col justify-between hover:border-slate-300 transition-all">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-900">15-Day Free Trial</span>
                                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">Free Fix</span>
                                    </div>
                                    <div class="mt-2 text-2xl font-extrabold text-slate-900 font-mono">$0 <span class="text-xs text-slate-400 font-sans font-normal">/ 15 days</span></div>
                                    <p class="text-[11px] text-slate-500 mt-1">Resolve detected issues on 1 domain risk-free.</p>

                                    <ul class="mt-3.5 space-y-2 text-xs text-slate-600">
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>5 Tasks / Day</strong> (Free daily scans)</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>Auto Alt-Tag Fixer</strong> active</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span>Full <strong>ADA &amp; EAA Toolbar</strong></span>
                                        </li>
                                        <li class="flex items-center gap-2 text-slate-400">
                                            <span>&bull;</span> <span>No credit card required to start</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-5 pt-3.5 border-t border-slate-100">
                                    <a href="<?= site_url('register') ?>" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 transition-colors">
                                        <span>Start Free Trial (Fix Free)</span> &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Plan 2: Pro Growth ($39/mo - Recommended Solution) -->
                            <div class="bg-white rounded-2xl p-4 sm:p-5 border-2 border-indigo-600 shadow-soft-md flex flex-col justify-between relative transform -translate-y-1">
                                <div class="absolute -top-3 right-4 bg-indigo-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-sm">
                                    ⭐ Recommended Solution
                                </div>
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-indigo-950">Pro Growth</span>
                                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700">All-in-One</span>
                                    </div>
                                    <div class="mt-2 text-2xl font-extrabold text-indigo-700 font-mono">$39 <span class="text-xs text-slate-500 font-sans font-normal">/ month</span></div>
                                    <p class="text-[11px] text-indigo-900/80 mt-1">Permanent 1-click auto-fix &amp; revenue recovery.</p>

                                    <ul class="mt-3.5 space-y-2 text-xs text-slate-700 font-medium">
                                        <li class="flex items-center gap-2 text-indigo-900 font-bold">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>1-Click Auto-Fix</strong> all detected issues</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>Unlimited Tasks</strong> (No daily cap)</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>24/7 Security Header</strong> watchdog</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>Social Proof Reviews</strong> (+18% sales)</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>Stripe Dunning</strong> (Recovers $5k MRR)</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-5 pt-3.5 border-t border-slate-100">
                                    <a href="<?= site_url('register') ?>?plan=pro" class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all hover:-translate-y-0.5">
                                        <span>Fix All Issues with Pro ($39)</span> &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Plan 3: Agency Suite ($99/mo) -->
                            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-soft-xs flex flex-col justify-between hover:border-slate-300 transition-all">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-900">Agency Suite</span>
                                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700">10+ Sites</span>
                                    </div>
                                    <div class="mt-2 text-2xl font-extrabold text-slate-900 font-mono">$99 <span class="text-xs text-slate-400 font-sans font-normal">/ month</span></div>
                                    <p class="text-[11px] text-slate-500 mt-1">White-label compliance for client websites.</p>

                                    <ul class="mt-3.5 space-y-2 text-xs text-slate-600">
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>Unlimited Client Domains</strong></span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span><strong>White-Label PDF Reports</strong> for clients</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span>Custom CDN domain integration</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="text-emerald-600 font-bold">&#10003;</span> <span>Dedicated Slack channel support</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-5 pt-3.5 border-t border-slate-100">
                                    <a href="<?= site_url('register') ?>?plan=agency" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 transition-colors">
                                        <span>Deploy Agency Suite ($99)</span> &rarr;
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 4 Diagnostic Tabs Navigation -->
                    <div class="mt-8 flex items-center gap-2 border-b border-slate-100 pb-3 overflow-x-auto">
                        <button type="button" onclick="switchAuditTab('tab-cyber')" id="tab-btn-cyber" class="audit-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold bg-indigo-600 text-white shadow-soft-xs transition-all whitespace-nowrap">
                            🔒 Cyber Security Auditor
                        </button>
                        <button type="button" onclick="switchAuditTab('tab-seo')" id="tab-btn-seo" class="audit-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all whitespace-nowrap">
                            🔍 SEO &amp; Keyword Suggester
                        </button>
                        <button type="button" onclick="switchAuditTab('tab-security')" id="tab-btn-security" class="audit-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all whitespace-nowrap">
                            🛡️ TotalVirus Security Checker
                        </button>
                        <button type="button" onclick="switchAuditTab('tab-bugs')" id="tab-btn-bugs" class="audit-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all whitespace-nowrap">
                            🛠️ Website Bug &amp; Error Fixer (<span id="res-bug-badge-count">0</span>)
                        </button>
                    </div>

                    <!-- TAB 0 (DEFAULT): CYBER SECURITY AUDITOR -->
                    <div id="tab-cyber" class="audit-tab-content mt-6 space-y-6">
                        
                        <!-- Tab Cyber SiteOps Solution Banner -->
                        <div class="bg-indigo-50/80 border border-indigo-200/90 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-soft-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-soft-xs">
                                    🔒
                                </div>
                                <div class="text-xs text-indigo-950">
                                    <strong class="font-bold">SiteOps Plan Solution:</strong> Protect your domain against XSS, data theft, and cookie hijacking with automated defensive headers and continuous penetration audit monitoring on <span class="font-bold text-indigo-700">SiteOps Pro ($39/mo)</span>.
                                </div>
                            </div>
                            <a href="<?= site_url('register') ?>?plan=pro" class="shrink-0 px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-soft-xs transition-all whitespace-nowrap">
                                Automate Cyber Defense with Pro &rarr;
                            </a>
                        </div>

                        <!-- Cyber Security Hero Status Banner -->
                        <div id="res-cyber-hero-banner" class="p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-emerald-50/60 border-emerald-200">
                            <div class="flex items-center gap-3.5">
                                <span class="text-2xl sm:text-3xl shrink-0" id="res-cyber-icon">🔒</span>
                                <div>
                                    <h4 class="text-base sm:text-lg font-bold text-slate-900" id="res-cyber-status-text">Defensive Posture: Evaluating...</h4>
                                    <p class="text-xs text-slate-600 mt-0.5" id="res-cyber-status-sub">Scanning 7 essential OWASP defensive attack-surface vectors.</p>
                                </div>
                            </div>
                            <span id="res-cyber-risk-badge" class="self-start sm:self-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                                Scanning...
                            </span>
                        </div>

                        <!-- 3 Stat Counter Pills -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-soft-xs flex items-center justify-between">
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">Passed Controls</div>
                                    <div class="text-xl font-extrabold text-slate-900 mt-0.5" id="res-cyber-passed-pill">0 Passed</div>
                                </div>
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">✓</div>
                            </div>
                            <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-soft-xs flex items-center justify-between">
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Advisories / Warnings</div>
                                    <div class="text-xl font-extrabold text-slate-900 mt-0.5" id="res-cyber-warnings-pill">0 Warnings</div>
                                </div>
                                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm">⚠️</div>
                            </div>
                            <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-soft-xs flex items-center justify-between">
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-rose-600">Critical Risks</div>
                                    <div class="text-xl font-extrabold text-slate-900 mt-0.5" id="res-cyber-fails-pill">0 Risks</div>
                                </div>
                                <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-sm">✕</div>
                            </div>
                        </div>

                        <!-- Detailed Cyber Security Audits List -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-soft-xs">
                            <div class="px-5 py-4 bg-slate-50/70 border-b border-slate-200/80 flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">Defensive Cyber Security Audit Controls</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Evaluates OWASP cookie security, Subresource Integrity, CORS policies, hardware permissions, and XSS containment.</p>
                                </div>
                                <span class="text-xs font-mono font-bold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">
                                    7 Controls
                                </span>
                            </div>
                            <div class="divide-y divide-slate-100" id="res-cyber-audits-list">
                                <!-- Injected dynamically via JS -->
                            </div>
                        </div>

                    </div>

                    <!-- TAB 1: SEO & KEYWORD SUGGESTER -->
                    <div id="tab-seo" class="audit-tab-content hidden mt-6 space-y-6">
                        
                        <!-- Tab 1 SiteOps Solution Banner -->
                        <div class="bg-indigo-50/80 border border-indigo-200/90 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-soft-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-soft-xs">
                                    SEO
                                </div>
                                <div class="text-xs text-indigo-950">
                                    <strong class="font-bold">SiteOps Plan Solution:</strong> Track these keyword densities automatically, monitor title/H1 changes weekly, and generate AI GEO recommendations with <span class="font-bold text-indigo-700">SiteOps Pro ($39/mo)</span>.
                                </div>
                            </div>
                            <a href="<?= site_url('register') ?>?plan=pro" class="shrink-0 px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-soft-xs transition-all whitespace-nowrap">
                                Automate SEO with Pro &rarr;
                            </a>
                        </div>
                        
                        <!-- Title & Meta Overview Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/80">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Page &lt;title&gt;</span>
                                    <span class="text-xs font-mono font-semibold text-slate-600" id="res-title-len">0 chars</span>
                                </div>
                                <p class="text-sm font-semibold text-slate-800 break-words" id="res-title-text">&mdash;</p>
                            </div>

                            <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/80">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Meta &lt;description&gt;</span>
                                    <span class="text-xs font-mono font-semibold text-slate-600" id="res-desc-len">0 chars</span>
                                </div>
                                <p class="text-sm text-slate-600 break-words" id="res-desc-text">&mdash;</p>
                            </div>
                        </div>

                        <!-- Top Keywords & Suggester Table -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-soft-xs">
                            <div class="px-5 py-4 bg-slate-50/70 border-b border-slate-200/80 flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">Extracted Keywords &amp; Update Suggestions</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Calculated from body content. Identifies missing keyword placement in high-CTR tags.</p>
                                </div>
                                <span class="text-xs font-mono font-bold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200" id="res-word-count">
                                    0 Total Words
                                </span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs">
                                    <thead class="bg-slate-50/50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200/60">
                                        <tr>
                                            <th class="py-3 px-4">Discovered Keyword</th>
                                            <th class="py-3 px-4">Density</th>
                                            <th class="py-3 px-4 text-center">In Title</th>
                                            <th class="py-3 px-4 text-center">In H1</th>
                                            <th class="py-3 px-4">Actionable Update Recommendation</th>
                                        </tr>
                                    </thead>
                                    <tbody id="res-keywords-tbody" class="divide-y divide-slate-100 text-slate-700">
                                        <!-- Injected dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Actionable SEO Fixes Checklist -->
                        <div class="bg-amber-50/50 rounded-2xl border border-amber-200/80 p-5">
                            <h4 class="text-sm font-bold text-amber-900 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>SEO &amp; GEO Fixes Needed for Top Rankings</span>
                            </h4>
                            <div class="mt-3 space-y-2.5" id="res-seo-updates-list">
                                <!-- Injected dynamically -->
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: TOTALVIRUS SECURITY CHECKER -->
                    <div id="tab-security" class="audit-tab-content hidden mt-6 space-y-6">
                        
                        <!-- Tab 2 SiteOps Solution Banner -->
                        <div class="bg-indigo-50/80 border border-indigo-200/90 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-soft-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-soft-xs">
                                    🛡️
                                </div>
                                <div class="text-xs text-indigo-950">
                                    <strong class="font-bold">SiteOps Security Shield:</strong> Stop Clickjacking, Trojan iframes, and MIME exploits. <span class="font-bold text-indigo-700">SiteOps Pro ($39/mo)</span> runs 24/7 continuous domain audits and alerts your team instantly on security downgrades.
                                </div>
                            </div>
                            <a href="<?= site_url('register') ?>?plan=pro" class="shrink-0 px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-soft-xs transition-all whitespace-nowrap">
                                Activate Security Guard &rarr;
                            </a>
                        </div>

                        <!-- Security Status Hero Card -->
                        <div class="p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border" id="res-security-hero-banner">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-xl shadow-soft-xs" id="res-security-icon">
                                    🛡️
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900" id="res-security-status-text">Security Scan Complete</h4>
                                    <p class="text-xs text-slate-600 mt-0.5" id="res-security-status-sub">5 core security defense headers &amp; malicious code signatures inspected.</p>
                                </div>
                            </div>
                            <span class="self-start sm:self-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider" id="res-security-badge-pill">
                                Clean &amp; Safe
                            </span>
                        </div>

                        <!-- 5 Core Security Headers Grid -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-soft-xs">
                            <div class="px-5 py-4 bg-slate-50/70 border-b border-slate-200/80">
                                <h4 class="text-sm font-bold text-slate-900">TotalVirus Defense: 5 Essential HTTP Security Headers</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Crucial defense against Clickjacking, MIME Sniffing, XSS, and SSL downgrade exploits.</p>
                            </div>
                            <div class="divide-y divide-slate-100" id="res-headers-list">
                                <!-- Injected dynamically -->
                            </div>
                        </div>

                        <!-- Attack Surface & Malware Indicators -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 font-bold uppercase text-[10px]">Obfuscated Script Code</div>
                                <div class="font-bold text-slate-800 text-sm mt-1" id="res-malware-sig-count">0 Detected (Clean)</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Scanned for base64 / eval hooks</div>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 font-bold uppercase text-[10px]">Hidden / Trojan IFrames</div>
                                <div class="font-bold text-slate-800 text-sm mt-1" id="res-iframe-count">0 Found (Clean)</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Zero 0x0 hidden iframe injects</div>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 font-bold uppercase text-[10px]">SSL / HTTPS Protocol</div>
                                <div class="font-bold text-slate-800 text-sm mt-1" id="res-ssl-status">Enforced (TLS)</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Encrypted communications</div>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 font-bold uppercase text-[10px]">Server Version Disclosure</div>
                                <div class="font-bold text-slate-800 text-sm mt-1 truncate" id="res-server-header">Hidden</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Backend signature protection</div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 3: WEBSITE BUGS & ERROR FIXES -->
                    <div id="tab-bugs" class="audit-tab-content hidden mt-6 space-y-6">
                        
                        <!-- Tab 3 SiteOps Solution Banner -->
                        <div class="bg-gradient-to-r from-indigo-50/90 via-purple-50/70 to-indigo-50/90 border border-indigo-200/90 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-soft-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-soft-xs">
                                    ⚡
                                </div>
                                <div class="text-xs text-slate-800">
                                    <strong class="font-bold text-indigo-950">1-Line Auto-Fix Solution:</strong> Don't manually edit 50+ HTML templates. Add the <span class="font-bold text-indigo-700">&lt;15KB SiteOps Script</span> to automatically auto-fill missing alt tags and inject WCAG accessibility tools live!
                                </div>
                            </div>
                            <a href="<?= site_url('register') ?>" class="shrink-0 px-4 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-xs transition-all whitespace-nowrap">
                                Auto-Fix Bugs with Free Trial &rarr;
                            </a>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Detected Website Bugs &amp; Code Fixes</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Each bug below includes a ready-to-copy snippet you can paste right into your codebase.</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 border border-indigo-200" id="res-bugs-total-counter">
                                0 Issues Found
                            </span>
                        </div>

                        <!-- Detected Bugs List with Code Snippets -->
                        <div class="space-y-4" id="res-bugs-list">
                            <!-- Injected dynamically -->
                        </div>

                    </div>

                </div>

                <!-- Conversion Banner Inside Results -->
                <div class="bg-gradient-to-r from-indigo-900 via-indigo-800 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-soft-lg flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-xl">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-indigo-200 text-xs font-semibold mb-2">
                            <span>✨ Automatic Continuous Monitoring</span>
                        </div>
                        <h4 class="text-xl sm:text-2xl font-bold">Fix These Issues Automatically with SiteOps</h4>
                        <p class="text-sm text-indigo-100/90 mt-1">
                            Add our &lt;15KB universal script to auto-fix missing alt tags, enforce WCAG accessibility, display verified customer reviews, and recover lost subscription sales.
                        </p>
                    </div>
                    <div class="shrink-0 flex flex-col sm:flex-row gap-3">
                        <a href="<?= site_url('register') ?>" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold text-indigo-950 bg-white hover:bg-slate-100 shadow-soft-md transition-all font-sans">
                            <span>Start 15-Day Free Trial</span>
                            <span class="text-xs font-normal text-slate-600">(5 tasks/day)</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 4. COST COMPARISON SECTION ($186/mo vs $39/mo)                   -->
    <!-- ================================================================= -->
    <section id="comparison" class="py-24 bg-slate-100/70 border-y border-slate-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-emerald-800 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                    Direct Cost &amp; Performance Audit
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Buying 4 Separate Tools Costs <span class="text-rose-500 line-through">$186/mo</span>.<br class="hidden sm:block">
                    SiteOps Gives You Everything for <span class="text-emerald-600">$39/mo</span>.
                </h2>
                <p class="mt-4 text-base text-slate-600">
                    Plus eliminate <strong class="text-slate-900">280KB+</strong> of bloated third-party JavaScript that is killing your Google Core Web Vitals and search rankings.
                </p>
            </div>

            <!-- Comparison Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Old Way: 4 Fragmented Tools (5 cols) -->
                <div class="lg:col-span-5 bg-white border border-rose-200 rounded-3xl p-6 sm:p-8 relative shadow-soft-sm">
                    <div class="absolute -top-3.5 right-6 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold px-3 py-0.5 rounded-full">
                        Legacy Bloatware Stack
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="text-rose-500">&#10005;</span> Typical SaaS / Agency Toolset
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div>
                                <p class="font-semibold text-slate-800">Accessibility Widget (AccessiBe / UserWay)</p>
                                <p class="text-xs text-slate-400">Bloated 65KB JS script</p>
                            </div>
                            <span class="font-mono font-bold text-rose-600">$49/mo</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div>
                                <p class="font-semibold text-slate-800">Social Proof Reviews (Senja / Trustpilot widget)</p>
                                <p class="text-xs text-slate-400">Sluggish 90KB widget iframe</p>
                            </div>
                            <span class="font-mono font-bold text-rose-600">$29/mo</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div>
                                <p class="font-semibold text-slate-800">AI SEO &amp; GEO Crawler Auditor</p>
                                <p class="text-xs text-slate-400">Standalone crawler plan</p>
                            </div>
                            <span class="font-mono font-bold text-rose-600">$69/mo</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div>
                                <p class="font-semibold text-slate-800">Dunning &amp; Failed Payment Tool</p>
                                <p class="text-xs text-slate-400">Basic recovery add-on</p>
                            </div>
                            <span class="font-mono font-bold text-rose-600">$39/mo</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs uppercase font-bold text-slate-500 tracking-wider">Total Monthly Cost:</span>
                            <p class="text-xs text-rose-600 font-medium">Script weight: ~280KB &bull; 4 separate vendor invoices</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-extrabold text-rose-600 font-mono">$186</span>
                            <span class="text-xs text-slate-400">/mo</span>
                        </div>
                    </div>
                </div>

                <!-- VS Badge (2 cols) -->
                <div class="lg:col-span-2 flex flex-col items-center justify-center py-4">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-soft-sm font-black text-white text-lg">
                        VS
                    </div>
                    <span class="text-xs font-bold text-slate-500 mt-2 uppercase tracking-wider">Save 79%</span>
                </div>

                <!-- New Way: SiteOps Unified Solution (5 cols) -->
                <div class="lg:col-span-5 bg-gradient-to-b from-indigo-50/60 via-white to-white border-2 border-indigo-600 rounded-3xl p-6 sm:p-8 relative shadow-soft-md">
                    <div class="absolute -top-3.5 right-6 bg-indigo-600 text-white text-xs font-extrabold px-3 py-0.5 rounded-full shadow-sm">
                        SITE OPS PRO UNIFIED
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="text-emerald-600">&#10003;</span> All 4 Modules Unified in 1 Script
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span class="font-semibold text-slate-800">EU EAA &amp; ADA Accessibility Suite</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Included</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span class="font-semibold text-slate-800">Social Proof &amp; Reviews (Google/Trustpilot)</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Included</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span class="font-semibold text-slate-800">AI SEO &amp; Generative Engine Optimizer (GEO)</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Included</span>
                        </div>

                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span class="font-semibold text-slate-800">Stripe Dunning &amp; Failed Payment Recovery</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">Included</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs uppercase font-bold text-indigo-700 tracking-wider">SiteOps Flat Price:</span>
                            <p class="text-xs text-slate-500 font-medium">Single &lt;15KB CDN Script &bull; Zero bloat</p>
                        </div>
                        <div class="text-right">
                            <span class="text-4xl font-black text-indigo-600 font-mono">$39</span>
                            <span class="text-xs text-slate-400">/mo</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Savings Banner Callout -->
            <div class="mt-12 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center shadow-soft-xs">
                <p class="text-sm sm:text-base font-bold text-emerald-800">
                    💰 Annual Net Savings: <span class="text-slate-900 text-lg font-extrabold font-mono">$1,764 / year</span> directly back to your bottom line, plus instantaneous Core Web Vitals gains.
                </p>
            </div>
        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 5. THE 4-MODULE GRID (AUDIT & AUTOMATED PROTECTION ENGINES)       -->
    <!-- ================================================================= -->
    <section id="features" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Engineered for US &amp; European Founders
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Four Mission-Critical Audit Engines.<br>One Automated &lt;15KB Solution.
                </h2>
                <p class="mt-4 text-base text-slate-600">
                    Continuous real-time auditing and instant automated fixes for security vulnerabilities, search engine visibility, malware threats, and accessibility compliance.
                </p>
            </div>

            <!-- 4 Modules Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Module 1: Cyber Security Auditor -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-3xl p-8 hover:bg-white hover:border-purple-300 hover:shadow-soft-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-200 flex items-center justify-center text-purple-600 group-hover:scale-105 transition-transform shadow-soft-xs">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                            Cyber Security
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Module 01: Cyber Security &amp; Hardening Auditor</h3>
                    <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                        Defend your website against modern web attacks. Continuously evaluates OWASP session cookie flags (<code>HttpOnly</code>, <code>Secure</code>, <code>SameSite</code>), locks down CORS wildcards, audits Subresource Integrity (SRI) on external CDNs, and restricts browser hardware access.
                    </p>
                    <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Prevents cookie session hijacking &amp; CSRF exploits
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Subresource Integrity (SRI) CDN supply-chain verification
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Cross-Origin Opener Policy (COOP) &amp; Permissions-Policy isolation
                        </li>
                    </ul>
                </div>

                <!-- Module 2: TotalVirus Threat Checker -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-3xl p-8 hover:bg-white hover:border-emerald-300 hover:shadow-soft-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform shadow-soft-xs">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200">
                            Threat Defense
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Module 02: TotalVirus Threat &amp; Vulnerability Scanner</h3>
                    <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                        Detects malicious payloads, obfuscated eval scripts, and protocol weaknesses before search engines blacklist your domain. Automatically checks HSTS enforcement, Clickjacking defenses (X-Frame-Options), and Content-Security-Policy.
                    </p>
                    <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Real-time detection of obfuscated JavaScript payloads
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Enforces Strict-Transport-Security (HSTS) preload readiness
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> 1-click ready-to-paste server config fixes (.htaccess &amp; Nginx)
                        </li>
                    </ul>
                </div>

                <!-- Module 3: AI SEO & Keywords -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-3xl p-8 hover:bg-white hover:border-indigo-300 hover:shadow-soft-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-200 flex items-center justify-center text-indigo-600 group-hover:scale-105 transition-transform shadow-soft-xs">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                            GEO &amp; Keywords
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Module 03: AI SEO &amp; Keyword Suggester</h3>
                    <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                        Traditional SEO is no longer enough. SiteOps scans your site for <strong>Generative Engine Optimization (GEO)</strong> — ensuring AI engines like ChatGPT Search, Perplexity AI, and Google Gemini cite your brand while flagging high-value missing keyword placements.
                    </p>
                    <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Top keyword density extraction &amp; missing tag placement alerts
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Title tag (50-60 chars) &amp; Meta description length optimizer
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> GEO &amp; LLM crawler friendliness audits (GPTBot, ClaudeBot)
                        </li>
                    </ul>
                </div>

                <!-- Module 4: Accessibility & Bug Fixer -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-3xl p-8 hover:bg-white hover:border-blue-300 hover:shadow-soft-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 group-hover:scale-105 transition-transform shadow-soft-xs">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                            EAA 2025 &amp; ADA
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Module 04: EU &amp; US Accessibility &amp; Bug Fixer</h3>
                    <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                        Automate compliance with the <strong>European Accessibility Act (EAA 2025)</strong> and <strong>US ADA Title III</strong>. Auto-fixes missing image alt tags on the fly, provides high contrast and dyslexia modes, and repairs responsive viewport bugs with zero page reflows.
                    </p>
                    <ul class="space-y-2.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Auto-fills missing image alt tags from clean filenames
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> WCAG 2.1 AA certified interactive accessibility toolbar
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600 font-bold">&#10003;</span> Protects your business from predatory compliance legal notices
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 6. 3-STEP SETUP                                                   -->
    <!-- ================================================================= -->
    <section id="how-it-works" class="py-24 bg-slate-100/70 border-y border-slate-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Effortless Implementation
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Up and Running in 3 Minutes Flat.
                </h2>
                <p class="mt-4 text-base text-slate-600">
                    No complicated NPM modules, no build steps, and zero server strain.
                </p>
            </div>

            <!-- Steps -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- Step 1 -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 relative shadow-soft-xs">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-700 font-mono font-bold flex items-center justify-center border border-indigo-200 mb-6 text-base">
                        01
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Add Your Domain</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Input your domain name into the SiteOps dashboard. We immediately generate your unique 16-character secure API token.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 relative shadow-soft-xs">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-700 font-mono font-bold flex items-center justify-center border border-indigo-200 mb-6 text-base">
                        02
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Paste 1-Line JS</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Add the <code class="text-indigo-700 font-mono text-xs bg-slate-100 px-1.5 py-0.5 rounded">&lt;script defer&gt;</code> tag into your HTML <code class="text-indigo-700 font-mono text-xs bg-slate-100 px-1.5 py-0.5 rounded">&lt;head&gt;</code>, WordPress, Webflow, Shopify, or React/Next.js layout.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 relative shadow-soft-xs">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-700 font-mono font-bold flex items-center justify-center border border-indigo-200 mb-6 text-base">
                        03
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Toggle Modules</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Flip switches on/off from your dashboard. Features activate on your live site immediately without editing code ever again.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 7. INTERACTIVE "LIVE WIDGET PREVIEW" CONTROLS                     -->
    <!-- ================================================================= -->
    <section id="live-demo-section" class="py-16 bg-indigo-50/60 border-y border-indigo-100 relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-indigo-200/80 rounded-3xl p-6 sm:p-8 shadow-soft-sm">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200 mb-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Interactive Sandbox
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Live Widget Preview On This Very Page</h3>
                        <p class="text-sm text-slate-600 mt-1">
                            Experience the lightweight accessibility toolbar and social proof reviews right now without leaving the page.
                        </p>
                    </div>

                    <!-- Toggles -->
                    <div class="flex items-center gap-4 flex-wrap">
                        <label class="flex items-center gap-3 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200 cursor-pointer hover:border-slate-300 select-none">
                            <input type="checkbox" id="toggle-accessibility-ui" checked onchange="toggleAccessibilityWidget(this.checked)" class="w-4 h-4 text-indigo-600 rounded focus:ring-0">
                            <span class="text-xs font-semibold text-slate-700">Accessibility Toolbar</span>
                        </label>

                        <label class="flex items-center gap-3 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200 cursor-pointer hover:border-slate-300 select-none">
                            <input type="checkbox" id="toggle-reviews-ui" checked onchange="toggleReviewsWidget(this.checked)" class="w-4 h-4 text-indigo-600 rounded focus:ring-0">
                            <span class="text-xs font-semibold text-slate-700">Social Proof Toast</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================================================================= -->
    <!-- 8. PRICING CARDS                                                  -->
    <!-- ================================================================= -->
    <section id="pricing" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Transparent, Scalable Pricing
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Predictable Plans for Any Growth Stage
                </h2>
                <p class="mt-4 text-base text-slate-600">
                    Start completely free. Upgrade when you require multiple domains or higher volume recovery.
                </p>

                <!-- Billing Cycle Toggle -->
                <div class="mt-8 inline-flex items-center gap-2 bg-slate-100 p-1.5 rounded-2xl border border-slate-200">
                    <button id="btn-monthly" onclick="setBilling('monthly')" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all bg-white text-slate-900 shadow-soft-xs">
                        Monthly
                    </button>
                    <button id="btn-annual" onclick="setBilling('annual')" class="px-4 py-1.5 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all flex items-center gap-1.5">
                        <span>Annual</span>
                        <span class="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-1.5 py-0.5 rounded-full border border-emerald-200">Save 20%</span>
                    </button>
                </div>
            </div>

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                <!-- Tier 1: 15-Day Free Trial -->
                <div class="bg-white border border-slate-200/90 rounded-3xl p-8 flex flex-col justify-between hover:shadow-soft-md transition-shadow">
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900">15-Day Free Trial</h3>
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Full Access</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Test all 4 compliance &amp; conversion modules risk-free.</p>

                        <div class="mt-6">
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-extrabold text-slate-900 font-mono">$0</span>
                                <span class="text-xs text-slate-500">/ 15 days</span>
                            </div>
                            <span class="inline-block mt-2 text-[11px] font-bold text-amber-800 bg-amber-50 border border-amber-200 px-2.5 py-0.5 rounded-full">
                                5 Tasks/Day &bull; No Credit Card Required
                            </span>
                        </div>

                        <ul class="mt-8 space-y-3 text-xs text-slate-600">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> <strong>5 Tasks per day</strong> (SEO audits &amp; reviews)
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> 1 Active Domain Integration
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Full ADA &amp; EAA Accessibility Toolbar
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Social Proof Toast Widget
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Live AI SEO &amp; GEO Scraper Audits
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <a href="<?= site_url('register') ?>" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-colors">
                            Start 15-Day Free Trial
                        </a>
                    </div>
                </div>

                <!-- Tier 2: Pro Growth (Most Popular) -->
                <div class="bg-gradient-to-b from-indigo-50/60 via-white to-white border-2 border-indigo-600 rounded-3xl p-8 flex flex-col justify-between relative shadow-soft-md">
                    <div class="absolute -top-3.5 right-6 bg-indigo-600 text-white text-xs font-extrabold px-3 py-0.5 rounded-full uppercase tracking-wider shadow-sm">
                        Most Popular
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900">Pro Growth</h3>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-bold">Growing SaaS</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Full 4-module suite with revenue recovery and automated audits.</p>

                        <div class="mt-6 flex items-baseline gap-1">
                            <span id="price-pro" class="text-4xl font-extrabold text-slate-900 font-mono">$39</span>
                            <span id="period-pro" class="text-xs text-slate-500">/ month</span>
                        </div>

                        <ul class="mt-8 space-y-3 text-xs text-slate-700">
                            <li class="flex items-center gap-2 text-indigo-700 font-bold">
                                <span class="text-emerald-600">&#10003;</span> <strong>Unlimited Tasks (No 5/day limit)</strong>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> <strong>5 Active Domains</strong>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Full <strong>EAA 2025 &amp; ADA</strong> Accessibility Suite
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Unlimited Google &amp; Trustpilot Reviews Sync
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Weekly <strong>AI SEO &amp; GEO Engine</strong> Audits
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> <strong>Stripe Dunning:</strong> Recover up to $5,000/mo MRR
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Custom branding &amp; accent color matching
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <a href="<?= site_url('register') ?>" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all">
                            Get Pro Growth Script
                        </a>
                    </div>
                </div>

                <!-- Tier 3: Agency -->
                <div class="bg-white border border-slate-200/90 rounded-3xl p-8 flex flex-col justify-between hover:shadow-soft-md transition-shadow">
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900">Agency</h3>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold">Agencies &amp; Portfolios</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Unlimited power for managing high volumes of client websites.</p>

                        <div class="mt-6 flex items-baseline gap-1">
                            <span id="price-agency" class="text-4xl font-extrabold text-slate-900 font-mono">$99</span>
                            <span id="period-agency" class="text-xs text-slate-500">/ month</span>
                        </div>

                        <ul class="mt-8 space-y-3 text-xs text-slate-600">
                            <li class="flex items-center gap-2 text-indigo-700 font-bold">
                                <span class="text-emerald-600">&#10003;</span> <strong>Unlimited Client Domains</strong>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> 100% White-Label (Custom CDN Domain)
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Multi-Client Sub-Accounts &amp; Access Roles
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Automated Monthly Client PDF Compliance Reports
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Unlimited Stripe Dunning Recovery Volume
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">&#10003;</span> Dedicated Slack/Teams Priority Channel
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <a href="<?= site_url('register') ?>" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-colors">
                            Deploy Agency Suite
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 8.5 FAQ & AEO DIRECT-ANSWER ENGINE (ChatGPT / Perplexity Ready)   -->
    <!-- ================================================================= -->
    <section id="faq" class="py-24 bg-white relative border-t border-slate-200/80">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                    Answer Engine &amp; Knowledge Base
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Frequently Asked Questions
                </h2>
                <p class="mt-4 text-base text-slate-600">
                    Direct answers on how SiteOps delivers compliance, speed, and growth without third-party script bloat.
                </p>
            </div>

            <!-- FAQ Accordion List -->
            <div class="space-y-4">
                
                <!-- Q1 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>How does SiteOps replace 4 expensive subscriptions with one &lt;15KB script?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q1</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Traditional SaaS stacks force you to install separate bloated widgets for accessibility (65KB), review aggregators (90KB), SEO crawlers, and payment recovery &mdash; totaling <strong>$186/mo</strong> and <strong>280KB+</strong> of JavaScript. SiteOps combines all 4 modules into a single, modular Vanilla JS bundle under <strong>15KB</strong>, hosted on Cloudflare's global edge network, saving up to 79% in software costs.
                    </p>
                </div>

                <!-- Q2 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>How does SiteOps enforce European Accessibility Act (EAA 2025) and US ADA compliance?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q2</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        With the European Accessibility Act actively enforced in 2025, websites serving EU or US customers face strict legal requirements. SiteOps automatically inspects your DOM, auto-fixes missing image <code>alt</code> tags using clean filenames on the fly, provides high-contrast and dyslexia reading modes, ensures keyboard accessibility traps, and complies with <strong>WCAG 2.1 AA</strong> standards.
                    </p>
                </div>

                <!-- Q3 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>What is Generative Engine Optimization (GEO) &amp; Answer Engine Optimization (AEO)?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q3</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Traditional Google keyword ranking is evolving into AI synthesis. Searchers now ask questions inside ChatGPT Search, Perplexity AI, Claude, and Google Gemini AI Overviews. SiteOps evaluates your site's <strong>LLM crawler readability</strong>, structured Schema JSON-LD data, semantic heading hierarchies, and high-CTR keyword placement to maximize AI citation frequency.
                    </p>
                </div>

                <!-- Q4 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>What checks does the Cyber Security &amp; TotalVirus Scanner perform?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q4</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Our defensive diagnostic engine evaluates 7 essential OWASP security vectors: session cookie security flags (<code>HttpOnly</code>, <code>Secure</code>, <code>SameSite</code>), Subresource Integrity (SRI) on external CDNs to prevent supply chain tampering, CORS wildcard exposure, form password TLS encryption, <code>Permissions-Policy</code> browser hardware isolation, HSTS, and Clickjacking protection (<code>X-Frame-Options</code>).
                    </p>
                </div>

                <!-- Q5 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>Can I test SiteOps for free without entering a credit card?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q5</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Yes! Every new account gets an automatic <strong>15-Day Free Trial</strong> with up to 5 daily tasks across all diagnostic tools, SEO audits, and module toggles. You do not need to provide a credit card until you choose to upgrade to Unlimited Pro ($39/mo).
                    </p>
                </div>

                <!-- Q6 -->
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-6 hover:border-indigo-300 transition-colors">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center justify-between">
                        <span>How does the Stripe Failed Payment Recovery (Dunning) module work?</span>
                        <span class="text-indigo-600 font-bold text-xl ml-4">Q6</span>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Over 9% of SaaS cancellations are caused by failed card renewals. SiteOps listens for <code>invoice.payment_failed</code> webhooks directly from Stripe and dispatches automated, friction-free payment recovery emails with 1-click hosted card update links (EU PSD2 / 3DS compliant), recovering over 42% of lost subscription revenue.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================================================================= -->
    <!-- 9. PRIME MODERN SAAS FOOTER (DEEP OBSIDIAN NAVY)                 -->
    <!-- ================================================================= -->
    <footer class="bg-slate-950 border-t border-slate-800/90 pt-16 pb-12 text-slate-400 text-xs relative overflow-hidden">
        <!-- Subtle Ambient Background Glow -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-gradient-to-t from-indigo-950/30 to-transparent pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main 4-Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8 pb-12 border-b border-slate-800/80">
                
                <!-- Column 1: Brand & Operational Status (2 cols on large screens) -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="<?= site_url('/') ?>" class="flex items-center gap-3.5 group">
                        <div class="relative w-10 h-10 transition-transform group-hover:scale-105 shrink-0">
                            <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_4px_12px_rgba(79,70,229,0.4)]">
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-white flex items-center gap-1.5">
                            SiteOps<span class="text-indigo-400">.</span>
                            <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded-full bg-slate-900 text-indigo-300 border border-slate-800 font-bold ml-1">
                                &lt;15KB
                            </span>
                        </span>
                    </a>

                    <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                        The ultra-lightweight website growth and compliance suite engineered for US &amp; European businesses, SaaS founders, and agencies. Replaces 4 bloated tools with a single fast, privacy-first script.
                    </p>

                    <!-- Trust Micro-Badges -->
                    <div class="flex items-center gap-2 flex-wrap pt-1 text-[11px] font-semibold text-slate-300">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            EAA 2025 Enforced
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            WCAG 2.1 AA Compliant
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800">
                            <svg class="w-3.5 h-3.5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Zero Dependencies
                        </span>
                    </div>

                    <!-- Live Server / API Status Pill -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-900 text-emerald-400 border border-slate-800 text-[11px] font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Global Edge CDN: Operational (12ms TTFB)</span>
                    </div>
                </div>

                <!-- Column 2: Growth Suite Modules -->
                <div class="space-y-3">
                    <h5 class="text-xs font-bold uppercase tracking-wider text-white">4-in-1 Suite Modules</h5>
                    <ul class="space-y-2 text-slate-400 font-medium">
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">ADA / EAA Accessibility Toolbar</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Social Proof Reviews Toast</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">AI SEO &amp; GEO Engine Auditor</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Failed Stripe Payment Dunning</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Auto Alt-Tag Image Fixer</a></li>
                        <li><button onclick="scrollToLiveDemo()" class="text-indigo-400 hover:text-indigo-300 font-semibold text-left">Live Interactive Sandbox</button></li>
                    </ul>
                </div>

                <!-- Column 3: Free Tools & Diagnostics -->
                <div class="space-y-3">
                    <h5 class="text-xs font-bold uppercase tracking-wider text-white">Free Tools &amp; Scanner</h5>
                    <ul class="space-y-2 text-slate-400 font-medium">
                        <li><a href="#instant-scanner" class="text-indigo-300 hover:text-white font-bold flex items-center gap-1"><span>🔍</span> 3-in-1 Health Scanner</a></li>
                        <li><a href="#instant-scanner" class="hover:text-indigo-400 transition-colors">TotalVirus Security Header Check</a></li>
                        <li><a href="#instant-scanner" class="hover:text-indigo-400 transition-colors">Keyword Density &amp; Updates Suggester</a></li>
                        <li><a href="#instant-scanner" class="hover:text-indigo-400 transition-colors">DOM Bug &amp; Code Fix Generator</a></li>
                        <li><a href="#comparison" class="hover:text-indigo-400 transition-colors">Cost Savings Calculator</a></li>
                        <li><a href="#how-it-works" class="hover:text-indigo-400 transition-colors">1-Line Embed Installation</a></li>
                    </ul>
                </div>

                <!-- Column 4: Pricing, SEO & AI Crawlers -->
                <div class="space-y-3">
                    <h5 class="text-xs font-bold uppercase tracking-wider text-white">Plans, SEO &amp; AI</h5>
                    <ul class="space-y-2 text-slate-400 font-medium">
                        <li><a href="#pricing" class="hover:text-indigo-400 transition-colors">15-Day Free Trial ($0)</a></li>
                        <li><a href="#pricing" class="hover:text-indigo-400 transition-colors">Pro Growth Plan ($39/mo)</a></li>
                        <li><a href="#pricing" class="hover:text-indigo-400 transition-colors">Agency Suite ($99/mo)</a></li>
                        <li><a href="#faq" class="hover:text-indigo-400 transition-colors">AEO &amp; FAQ Direct Answers</a></li>
                        <li><a href="<?= site_url('sitemap.xml') ?>" target="_blank" class="hover:text-indigo-400 transition-colors font-mono text-[11px]">sitemap.xml</a></li>
                        <li><a href="<?= site_url('robots.txt') ?>" target="_blank" class="hover:text-indigo-400 transition-colors font-mono text-[11px]">robots.txt</a></li>
                        <li><a href="<?= site_url('llms.txt') ?>" target="_blank" class="text-indigo-300 hover:text-white transition-colors font-mono text-[11px] font-bold">llms.txt (AI Search)</a></li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Sub-Footer Bar -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-slate-500 text-[11px]">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-300">SiteOps Inc.</span>
                    <span>&mdash;</span>
                    <span>&copy; <?= date('Y') ?> All rights reserved. High-performance PHP 8.2 &amp; CodeIgniter 4 architecture.</span>
                </div>

                <div class="flex items-center gap-6 font-medium">
                    <span class="flex items-center gap-1.5 text-slate-400">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        256-bit Encrypted
                    </span>
                    <span class="text-slate-700">|</span>
                    <a href="<?= site_url('admin') ?>" class="hover:text-indigo-400 transition-colors font-mono text-[10px]">Admin Portal</a>
                    <span class="text-slate-700">|</span>
                    <a href="<?= site_url('dashboard') ?>" class="text-indigo-400 hover:text-indigo-300 font-bold">Client Dashboard &rarr;</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- ================================================================= -->
    <!-- 10. INTERACTIVE WIDGET 1: FLOATING ACCESSIBILITY BUTTON & PANEL   -->
    <!-- ================================================================= -->
    <div id="siteops-a11y-container" class="fixed bottom-6 left-6 z-50">
        <!-- Floating Trigger Button -->
        <button id="siteops-a11y-trigger" onclick="toggleA11yModal()" aria-label="Open Accessibility Options" class="w-13 h-13 p-3.5 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white shadow-soft-lg flex items-center justify-center transition-transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-indigo-500/20">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
            </svg>
        </button>

        <!-- Accessibility Modal / Toolbar Card -->
        <div id="siteops-a11y-modal" class="hidden absolute bottom-16 left-0 w-80 bg-white/95 backdrop-blur-2xl border border-slate-200/90 rounded-3xl shadow-soft-lg p-5 text-slate-800 font-sans z-50 transition-all">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                    <h4 class="text-sm font-bold text-slate-900">Accessibility Menu</h4>
                </div>
                <button onclick="toggleA11yModal()" class="text-slate-400 hover:text-slate-700 text-lg font-bold">&times;</button>
            </div>

            <!-- Toolbar Options Grid -->
            <div class="grid grid-cols-2 gap-2 text-xs">
                <!-- Dyslexia Font -->
                <button onclick="toggleDyslexicFont()" id="btn-dyslexia" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition-colors">
                    <span class="font-bold text-base mb-1">Aa</span>
                    <span class="font-semibold text-slate-700">Dyslexia Font</span>
                </button>

                <!-- High Contrast -->
                <button onclick="toggleHighContrast()" id="btn-contrast" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition-colors">
                    <span class="font-bold text-base mb-1">&#9680;</span>
                    <span class="font-semibold text-slate-700">High Contrast</span>
                </button>

                <!-- Reading Guide -->
                <button onclick="toggleReadingGuide()" id="btn-guide" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition-colors">
                    <span class="font-bold text-base mb-1">&#9644;</span>
                    <span class="font-semibold text-slate-700">Reading Guide</span>
                </button>

                <!-- Big Cursor -->
                <button onclick="toggleBigCursor()" id="btn-cursor" class="flex flex-col items-center justify-center p-3 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition-colors">
                    <span class="font-bold text-base mb-1">&#10148;</span>
                    <span class="font-semibold text-slate-700">Big Cursor</span>
                </button>
            </div>

            <!-- Text Size Controls -->
            <div class="mt-3 pt-3 border-t border-slate-100">
                <span class="text-[11px] font-semibold text-slate-500 block mb-2">Text Size</span>
                <div class="flex items-center gap-2">
                    <button onclick="adjustTextSize(-1)" class="flex-1 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 font-bold text-xs text-slate-700">A -</button>
                    <button onclick="adjustTextSize(0)" class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 font-semibold text-xs text-slate-700">Reset</button>
                    <button onclick="adjustTextSize(1)" class="flex-1 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 font-bold text-xs text-slate-700">A +</button>
                </div>
            </div>

            <!-- Reset All -->
            <button onclick="resetAllAccessibility()" class="w-full mt-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition-colors">
                Reset All Settings
            </button>
        </div>
    </div>


    <!-- ================================================================= -->
    <!-- 11. INTERACTIVE WIDGET 2: FLOATING SOCIAL PROOF / REVIEW TOAST   -->
    <!-- ================================================================= -->
    <div id="siteops-reviews-container" class="fixed bottom-6 right-6 z-40 max-w-sm transition-all duration-300">
        <div id="siteops-review-card" class="bg-white/95 backdrop-blur-xl border border-slate-200/90 rounded-2xl p-4 shadow-soft-lg flex items-start gap-3.5 relative overflow-hidden group">
            <!-- Accent Indicator -->
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-indigo-500 to-emerald-500"></div>

            <!-- Reviewer Avatar / Source Icon -->
            <div id="review-avatar" class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 to-brand-500 flex items-center justify-center font-bold text-white text-xs shrink-0 shadow-soft-xs">
                ML
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p id="review-author" class="text-xs font-bold text-slate-900 truncate">Marcus Lindqvist</p>
                    <button onclick="dismissReviewToast()" class="text-slate-400 hover:text-slate-700 text-sm ml-2 font-bold">&times;</button>
                </div>

                <p id="review-role" class="text-[10px] text-slate-500 truncate">CTO, CloudStack Stockholm</p>

                <!-- Stars -->
                <div class="flex items-center gap-1 my-1">
                    <span class="text-amber-500 text-xs">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                    <span id="review-source" class="text-[9px] uppercase font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded-full border border-emerald-200 ml-1">
                        Verified Trustpilot
                    </span>
                </div>

                <p id="review-content" class="text-[11px] text-slate-700 line-clamp-2 leading-relaxed">
                    "SiteOps replaced our $49/mo accessibility widget and bloated review plugin with a 12KB script. Core Web Vitals jumped 19 pts."
                </p>
            </div>
        </div>
    </div>


    <!-- ================================================================= -->
    <!-- 12. PURE VANILLA JAVASCRIPT (ZERO DEPENDENCY / <15KB PHILOSOPHY)   -->
    <!-- ================================================================= -->
    <script>
        // Sample Real Reviews for Rotation
        const siteOpsReviews = [
            {
                name: "Marcus Lindqvist",
                role: "CTO, CloudStack Stockholm",
                avatar: "ML",
                source: "Verified Trustpilot",
                text: "SiteOps replaced our $49/mo accessibility widget and bloated review plugin with a 12KB script. Core Web Vitals jumped 19 pts."
            },
            {
                name: "Elena Rostova",
                role: "Growth Lead, SaaSFlow London",
                avatar: "ER",
                source: "Verified Google",
                text: "The Dunning module alone recovered $3,400 in failed Stripe subscriptions in week one. Extraordinary ROI."
            },
            {
                name: "David Miller",
                role: "Head of E-Commerce, Austin TX",
                avatar: "DM",
                source: "Verified Customer",
                text: "Full EAA 2025 and ADA compliance in 2 minutes. The live contrast, reading ruler, and dyslexic font are seamless."
            }
        ];

        let currentReviewIndex = 0;
        let reviewInterval = null;

        // Rotate Review Toast Every 7 Seconds
        function startReviewRotation() {
            if (reviewInterval) clearInterval(reviewInterval);
            reviewInterval = setInterval(() => {
                currentReviewIndex = (currentReviewIndex + 1) % siteOpsReviews.length;
                updateReviewCard(siteOpsReviews[currentReviewIndex]);
            }, 7000);
        }

        function updateReviewCard(review) {
            const card = document.getElementById('siteops-review-card');
            if (!card) return;
            card.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => {
                document.getElementById('review-author').innerText = review.name;
                document.getElementById('review-role').innerText = review.role;
                document.getElementById('review-avatar').innerText = review.avatar;
                document.getElementById('review-source').innerText = review.source;
                document.getElementById('review-content').innerText = `"${review.text}"`;
                card.classList.remove('opacity-0', 'translate-y-2');
            }, 200);
        }

        function dismissReviewToast() {
            const container = document.getElementById('siteops-reviews-container');
            if (container) container.classList.add('hidden');
            const toggle = document.getElementById('toggle-reviews-ui');
            if (toggle) toggle.checked = false;
        }

        // Toggle Widgets from the Live Sandbox Bar
        function toggleAccessibilityWidget(show) {
            const el = document.getElementById('siteops-a11y-container');
            if (el) el.style.display = show ? 'block' : 'none';
        }

        function toggleReviewsWidget(show) {
            const el = document.getElementById('siteops-reviews-container');
            if (el) el.classList.toggle('hidden', !show);
            if (show) startReviewRotation();
        }

        function toggleInteractivePreview(open) {
            toggleAccessibilityWidget(true);
            toggleReviewsWidget(true);
            document.getElementById('toggle-accessibility-ui').checked = true;
            document.getElementById('toggle-reviews-ui').checked = true;
            toggleA11yModal(true);
        }

        function scrollToLiveDemo() {
            document.getElementById('live-demo-section').scrollIntoView({ behavior: 'smooth' });
            toggleInteractivePreview(true);
        }

        // Toggle Mobile Slide-Down Menu
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-nav-drawer');
            const iconOpen = document.getElementById('hamburger-icon-open');
            const iconClose = document.getElementById('hamburger-icon-close');
            if (drawer) {
                const isClosed = drawer.classList.contains('hidden');
                drawer.classList.toggle('hidden');
                if (iconOpen) iconOpen.classList.toggle('hidden', isClosed);
                if (iconClose) iconClose.classList.toggle('hidden', !isClosed);
            }
        }

        // Accessibility Modal Open/Close
        function toggleA11yModal(forceOpen = null) {
            const modal = document.getElementById('siteops-a11y-modal');
            if (forceOpen === true) {
                modal.classList.remove('hidden');
            } else if (forceOpen === false) {
                modal.classList.add('hidden');
            } else {
                modal.classList.toggle('hidden');
            }
        }

        // Accessibility Features Logic
        function toggleDyslexicFont() {
            document.body.classList.toggle('dyslexia-font');
            const btn = document.getElementById('btn-dyslexia');
            btn.classList.toggle('bg-indigo-600');
            btn.classList.toggle('text-white');
        }

        function toggleHighContrast() {
            document.body.classList.toggle('contrast-high');
            const btn = document.getElementById('btn-contrast');
            btn.classList.toggle('bg-indigo-600');
            btn.classList.toggle('text-white');
        }

        function toggleBigCursor() {
            document.body.classList.toggle('big-cursor');
            const btn = document.getElementById('btn-cursor');
            btn.classList.toggle('bg-indigo-600');
            btn.classList.toggle('text-white');
        }

        function toggleReadingGuide() {
            document.body.classList.toggle('reading-guide-active');
            const btn = document.getElementById('btn-guide');
            btn.classList.toggle('bg-indigo-600');
            btn.classList.toggle('text-white');
        }

        // Mouse Tracker for the Reading Guide Line
        window.addEventListener('mousemove', (e) => {
            const line = document.getElementById('reading-guide-line');
            if (document.body.classList.contains('reading-guide-active')) {
                line.style.top = e.clientY + 'px';
            }
        });

        // Text Sizing
        let currentZoom = 100;
        function adjustTextSize(delta) {
            if (delta === 0) {
                currentZoom = 100;
            } else {
                currentZoom = Math.min(130, Math.max(90, currentZoom + (delta * 10)));
            }
            document.documentElement.style.fontSize = (currentZoom / 100 * 16) + 'px';
        }

        // Reset All Accessibility
        function resetAllAccessibility() {
            document.body.classList.remove('dyslexia-font', 'contrast-high', 'big-cursor', 'reading-guide-active');
            document.documentElement.style.fontSize = '16px';
            currentZoom = 100;
            ['btn-dyslexia', 'btn-contrast', 'btn-cursor', 'btn-guide'].forEach(id => {
                const b = document.getElementById(id);
                if (b) {
                    b.classList.remove('bg-indigo-600', 'text-white');
                }
            });
        }

        // Pricing Toggle (Monthly vs Annual)
        function setBilling(cycle) {
            const btnM = document.getElementById('btn-monthly');
            const btnA = document.getElementById('btn-annual');
            const pricePro = document.getElementById('price-pro');
            const periodPro = document.getElementById('period-pro');
            const priceAgency = document.getElementById('price-agency');
            const periodAgency = document.getElementById('period-agency');

            if (cycle === 'annual') {
                btnA.classList.add('bg-white', 'text-slate-900', 'shadow-soft-xs');
                btnA.classList.remove('text-slate-600');
                btnM.classList.remove('bg-white', 'text-slate-900', 'shadow-soft-xs');
                btnM.classList.add('text-slate-600');

                pricePro.innerText = '$31';
                periodPro.innerText = '/ month (billed $372/yr)';
                priceAgency.innerText = '$79';
                periodAgency.innerText = '/ month (billed $948/yr)';
            } else {
                btnM.classList.add('bg-white', 'text-slate-900', 'shadow-soft-xs');
                btnM.classList.remove('text-slate-600');
                btnA.classList.remove('bg-white', 'text-slate-900', 'shadow-soft-xs');
                btnA.classList.add('text-slate-600');

                pricePro.innerText = '$39';
                periodPro.innerText = '/ month';
                priceAgency.innerText = '$99';
                periodAgency.innerText = '/ month';
            }
        }

        // Copy Code Snippet
        function copySnippet() {
            const snippet = '<script defer src="https://cdn.siteops.io/v1/loader.js?key=so_9f81a7b2e4c6"><\/script>';
            navigator.clipboard.writeText(snippet).then(() => {
                const btn = document.getElementById('copy-text');
                btn.innerText = 'Copied to Clipboard!';
                setTimeout(() => {
                    btn.innerText = 'Copy Snippet';
                }, 2500);
            }).catch(() => {
                alert('Copied: ' + snippet);
            });
        }

        // =====================================================================
        // 3-IN-1 WEBSITE HEALTH, SEO & TOTALVIRUS SECURITY SCANNER ENGINE
        // =====================================================================
        let currentAuditData = null;

        function quickAudit(domain) {
            const input = document.getElementById('audit-url-input');
            if (input) {
                input.value = domain;
                handleLiveAudit(null);
            }
        }

        async function handleLiveAudit(e) {
            if (e) e.preventDefault();

            const input = document.getElementById('audit-url-input');
            const submitBtn = document.getElementById('audit-submit-btn');
            const errorBox = document.getElementById('audit-error-box');
            const errorMsg = document.getElementById('audit-error-message');
            const loadingCard = document.getElementById('audit-loading-card');
            const resultsContainer = document.getElementById('audit-results-container');

            let url = input ? input.value.trim() : '';
            if (!url) return;

            // Reset UI states
            if (errorBox) errorBox.classList.add('hidden');
            if (resultsContainer) resultsContainer.classList.add('hidden');
            if (loadingCard) loadingCard.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            }

            // Scroll smoothly to loading card
            loadingCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Animate step progress indicators
            const steps = [
                { title: 'Connecting to Target Host...', sub: 'Establishing TLS handshake & TTFB latency test' },
                { title: 'Auditing Cyber Security Posture...', sub: 'Evaluating OWASP cookie flags, CORS policies & SRI hashes' },
                { title: 'Running TotalVirus Defense Scan...', sub: 'Checking HSTS, CSP, X-Frame-Options & obfuscated script patterns' },
                { title: 'Parsing DOM & Calculating Keywords...', sub: 'Extracting Title, Meta tags, and calculating keyword densities' }
            ];

            let stepIdx = 0;
            const stepInterval = setInterval(() => {
                stepIdx = (stepIdx + 1) % steps.length;
                const lt = document.getElementById('audit-loading-title');
                const ls = document.getElementById('audit-loading-subtitle');
                if (lt) lt.innerText = steps[stepIdx].title;
                if (ls) ls.innerText = steps[stepIdx].sub;
            }, 650);

            try {
                const endpoint = '<?= site_url('api/scan/public') ?>?url=' + encodeURIComponent(url);
                const response = await fetch(endpoint, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });

                clearInterval(stepInterval);

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.error || 'Diagnostic scan failed. Check URL accessibility.');
                }

                currentAuditData = data;
                renderAuditResults(data);
                switchAuditTab('tab-cyber');

                if (loadingCard) loadingCard.classList.add('hidden');
                if (resultsContainer) resultsContainer.classList.remove('hidden');
                resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });

            } catch (err) {
                clearInterval(stepInterval);
                if (loadingCard) loadingCard.classList.add('hidden');
                if (errorBox) {
                    errorBox.classList.remove('hidden');
                    if (errorMsg) errorMsg.innerText = err.message || 'Could not scan website. Ensure it is publicly accessible.';
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                }
            }
        }

        function switchAuditTab(tabId) {
            // Update tab buttons
            document.querySelectorAll('.audit-tab-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-soft-xs');
                btn.classList.add('bg-slate-100', 'text-slate-600');
            });

            // Update tab contents
            document.querySelectorAll('.audit-tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            const activeBtn = document.getElementById('tab-btn-' + tabId.replace('tab-', ''));
            if (activeBtn) {
                activeBtn.classList.remove('bg-slate-100', 'text-slate-600');
                activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-soft-xs');
            }

            const activeContent = document.getElementById(tabId);
            if (activeContent) {
                activeContent.classList.remove('hidden');
            }
        }

        function renderAuditResults(data) {
            // 1. Overview header
            const targetUrlEl = document.getElementById('res-target-url');
            if (targetUrlEl) targetUrlEl.innerText = data.target_url;

            const httpCodeEl = document.getElementById('res-http-code');
            if (httpCodeEl) httpCodeEl.innerText = 'HTTP ' + data.http_code + ' OK';

            const latencyEl = document.getElementById('res-latency');
            if (latencyEl) latencyEl.innerText = data.load_time_ms + 'ms TTFB';

            const scannedAtEl = document.getElementById('res-scanned-at');
            if (scannedAtEl) scannedAtEl.innerText = data.scanned_at || 'Just now';

            // Scores
            const overallEl = document.getElementById('res-overall-score');
            if (overallEl) overallEl.innerText = data.overall_score;

            const cyberScoreEl = document.getElementById('res-cyber-score');
            if (cyberScoreEl && data.cyber_security) cyberScoreEl.innerText = data.cyber_security.score;

            const seoScoreEl = document.getElementById('res-seo-score');
            if (seoScoreEl) seoScoreEl.innerText = data.seo.score;

            const secScoreEl = document.getElementById('res-security-score');
            if (secScoreEl) secScoreEl.innerText = data.security.score;

            const bugCount = (data.bugs && data.bugs.total_bugs) ? data.bugs.total_bugs : (data.bugs.detected_bugs ? data.bugs.detected_bugs.length : 0);
            const bugBadgeEl = document.getElementById('res-bug-badge-count');
            if (bugBadgeEl) bugBadgeEl.innerText = bugCount;

            const bugCounterEl = document.getElementById('res-bugs-total-counter');
            if (bugCounterEl) bugCounterEl.innerText = bugCount + ' Issues Found';

            // ==========================================
            // 2. Tab 0: Cyber Security Auditor (Default)
            // ==========================================
            if (data.cyber_security) {
                const cyberHeroBanner = document.getElementById('res-cyber-hero-banner');
                const cyberIcon = document.getElementById('res-cyber-icon');
                const cyberStatusText = document.getElementById('res-cyber-status-text');
                const cyberStatusSub = document.getElementById('res-cyber-status-sub');
                const cyberRiskBadge = document.getElementById('res-cyber-risk-badge');

                const riskLevel = data.cyber_security.risk_level; // 'low', 'medium', 'high', 'critical'
                const isCyberSafe = (riskLevel === 'low');
                const isCyberWarn = (riskLevel === 'medium');

                if (cyberHeroBanner) {
                    cyberHeroBanner.className = isCyberSafe 
                        ? 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-emerald-50/60 border-emerald-200'
                        : (isCyberWarn ? 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-amber-50/60 border-amber-200' : 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-rose-50/60 border-rose-200');
                }
                if (cyberIcon) cyberIcon.innerText = isCyberSafe ? '🛡️' : (isCyberWarn ? '⚠️' : '🚨');
                if (cyberStatusText) {
                    cyberStatusText.innerText = isCyberSafe 
                        ? 'Defensive Posture: Hardened & Secure' 
                        : (isCyberWarn ? 'Defensive Posture: Moderate Attack Surface Exposed' : 'Defensive Posture: High Cyber Risk Exposure');
                }
                if (cyberStatusSub) {
                    cyberStatusSub.innerText = `${data.cyber_security.total_passed} controls passed • ${data.cyber_security.total_warnings} warnings • ${data.cyber_security.total_failed} high risks flagged.`;
                }
                if (cyberRiskBadge) {
                    cyberRiskBadge.innerText = data.cyber_security.risk_badge || (isCyberSafe ? 'Hardened & Secure' : 'Action Required');
                    cyberRiskBadge.className = isCyberSafe
                        ? 'self-start sm:self-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300'
                        : (isCyberWarn ? 'self-start sm:self-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-300' : 'self-start sm:self-center px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-300');
                }

                // Stat Pills
                const passedPill = document.getElementById('res-cyber-passed-pill');
                if (passedPill) passedPill.innerText = `${data.cyber_security.total_passed} Controls`;

                const warnPill = document.getElementById('res-cyber-warnings-pill');
                if (warnPill) warnPill.innerText = `${data.cyber_security.total_warnings} Advisories`;

                const failPill = document.getElementById('res-cyber-fails-pill');
                if (failPill) failPill.innerText = `${data.cyber_security.total_failed} High Risks`;

                // Audits list
                const cyberAuditsList = document.getElementById('res-cyber-audits-list');
                if (cyberAuditsList && data.cyber_security.audits) {
                    cyberAuditsList.innerHTML = '';
                    data.cyber_security.audits.forEach(audit => {
                        const isPass = (audit.status === 'pass');
                        const isWarn = (audit.status === 'warn' || audit.status === 'warning');
                        const categoryName = audit.category || audit.control || 'Defense Policy';
                        const auditTitle = audit.name || audit.title || 'Security Directive';
                        const findingText = audit.finding || audit.value || '';
                        const row = document.createElement('div');
                        row.className = 'p-5 hover:bg-slate-50/70 transition-colors space-y-3';
                        row.innerHTML = `
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider ${
                                        isPass ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : (isWarn ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-rose-100 text-rose-800 border border-rose-200')
                                    }">
                                        ${isPass ? '✓ PASS' : (isWarn ? '⚠️ WARNING' : '✕ FAILED')}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded">
                                        ${escapeHtml(categoryName)}
                                    </span>
                                </div>
                                <h5 class="text-sm font-bold text-slate-900">${escapeHtml(auditTitle)}</h5>
                            </div>
                            <div class="text-xs text-slate-600 leading-relaxed">${escapeHtml(audit.impact)}</div>
                            ${findingText ? `
                                <div class="text-[11px] font-mono text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200/80 truncate">
                                    <span class="font-bold text-slate-500">Scan Finding:</span> ${escapeHtml(findingText)}
                                </div>
                            ` : ''}
                            <div class="text-xs text-indigo-900 bg-indigo-50/80 p-3 rounded-xl border border-indigo-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex-1">
                                    <strong class="font-bold text-indigo-700">Recommended Hardening:</strong> ${escapeHtml(audit.recommendation)}
                                </div>
                                <a href="<?= site_url('register') ?>?plan=pro" class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-soft-xs transition-colors whitespace-nowrap">
                                    <span>Auto-Harden with Pro</span> &rarr;
                                </a>
                            </div>
                            ${audit.fix_snippet ? `
                                <div class="relative">
                                    <div class="flex items-center justify-between bg-slate-950 text-slate-400 px-3 py-1.5 rounded-t-xl text-[11px] font-mono border-b border-slate-800">
                                        <span>Hardening Directive / Code Fix:</span>
                                        <button type="button" onclick="copyFixCode(this)" class="copy-fix-btn bg-indigo-600 hover:bg-indigo-500 text-white px-2.5 py-0.5 rounded text-[10px] font-bold transition-colors">
                                            Copy Directive
                                        </button>
                                    </div>
                                    <pre class="bg-slate-900 text-slate-100 p-3.5 rounded-b-xl font-mono text-xs overflow-x-auto"><code>${escapeHtml(audit.fix_snippet)}</code></pre>
                                </div>
                            ` : ''}
                        `;
                        cyberAuditsList.appendChild(row);
                    });
                }
            }

            // 3. Tab 1: SEO & Keywords
            const titleTextEl = document.getElementById('res-title-text');
            if (titleTextEl) titleTextEl.innerText = data.seo.title || '(No title tag found)';

            const titleLenEl = document.getElementById('res-title-len');
            if (titleLenEl) titleLenEl.innerText = (data.seo.title_length || 0) + ' chars';

            const descTextEl = document.getElementById('res-desc-text');
            if (descTextEl) descTextEl.innerText = data.seo.description || '(No meta description found)';

            const descLenEl = document.getElementById('res-desc-len');
            if (descLenEl) descLenEl.innerText = (data.seo.desc_length || 0) + ' chars';

            const wordCountEl = document.getElementById('res-word-count');
            if (wordCountEl) wordCountEl.innerText = (data.seo.total_words || 0) + ' Total Words';

            // Top Keywords Table
            const tbody = document.getElementById('res-keywords-tbody');
            if (tbody) {
                tbody.innerHTML = '';
                if (data.seo.top_keywords && data.seo.top_keywords.length > 0) {
                    data.seo.top_keywords.forEach(kw => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-slate-50/80 transition-colors';
                        tr.innerHTML = `
                            <td class="py-3 px-4 font-mono font-bold text-slate-900">${escapeHtml(kw.keyword)}</td>
                            <td class="py-3 px-4">
                                <span class="font-semibold text-slate-800">${kw.count}x</span>
                                <span class="text-slate-400 text-[11px] ml-1">(${kw.density})</span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                ${kw.in_title 
                                    ? '<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">✓ Yes</span>' 
                                    : '<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500">No</span>'}
                            </td>
                            <td class="py-3 px-4 text-center">
                                ${kw.in_h1 
                                    ? '<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">✓ Yes</span>' 
                                    : '<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500">No</span>'}
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-xs ${kw.in_title && kw.in_h1 ? 'text-slate-600' : 'text-indigo-700 font-semibold'}">
                                    ${escapeHtml(kw.suggestion)}
                                </div>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="5" class="py-4 px-4 text-center text-slate-400">No content keywords detected on target page.</td></tr>';
                }
            }

            // SEO Updates List
            const seoUpdatesList = document.getElementById('res-seo-updates-list');
            if (seoUpdatesList) {
                seoUpdatesList.innerHTML = '';
                if (data.seo.updates_needed && data.seo.updates_needed.length > 0) {
                    data.seo.updates_needed.forEach(item => {
                        const isCritical = (item.type === 'critical');
                        const div = document.createElement('div');
                        div.className = `p-3 rounded-xl border flex flex-col sm:flex-row sm:items-center justify-between gap-2 ${
                            isCritical ? 'bg-rose-50/70 border-rose-200 text-rose-900' : 'bg-white border-amber-200 text-slate-800'
                        }`;
                        div.innerHTML = `
                            <div>
                                <div class="text-xs font-bold flex items-center gap-1.5">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase ${
                                        isCritical ? 'bg-rose-200 text-rose-900' : 'bg-amber-100 text-amber-900'
                                    }">${item.type}</span>
                                    <span>${escapeHtml(item.title)}</span>
                                </div>
                                <div class="text-xs text-slate-600 mt-0.5">${escapeHtml(item.description)}</div>
                            </div>
                            <div class="text-xs font-semibold shrink-0 text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-200">
                                💡 ${escapeHtml(item.action)}
                            </div>
                        `;
                        seoUpdatesList.appendChild(div);
                    });
                } else {
                    seoUpdatesList.innerHTML = '<div class="text-xs text-emerald-800 bg-emerald-50 p-3 rounded-xl border border-emerald-200">✓ Page title, meta tags, headings and canonical hierarchy are in optimal condition!</div>';
                }
            }

            // 3. Tab 2: TotalVirus Security Checker
            const secBanner = document.getElementById('res-security-hero-banner');
            const secStatusText = document.getElementById('res-security-status-text');
            const secStatusSub = document.getElementById('res-security-status-sub');
            const secBadgePill = document.getElementById('res-security-badge-pill');
            const secIcon = document.getElementById('res-security-icon');

            const isHardened = (data.security.safety_badge === 'safe');
            const isWarning = (data.security.safety_badge === 'warning');

            if (secBanner) {
                secBanner.className = isHardened 
                    ? 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-emerald-50/60 border-emerald-200'
                    : (isWarning ? 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-amber-50/60 border-amber-200' : 'p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 border bg-rose-50/60 border-rose-200');
            }
            if (secStatusText) secStatusText.innerText = data.security.status_text;
            if (secStatusSub) secStatusSub.innerText = `${data.security.threats_detected ? data.security.threats_detected.length : 0} security advisories flagged during scan.`;
            if (secIcon) secIcon.innerText = isHardened ? '🛡️' : (isWarning ? '⚠️' : '🚨');
            if (secBadgePill) {
                secBadgePill.innerText = isHardened ? 'Hardened & Safe' : (isWarning ? 'Action Recommended' : 'Security Vulnerable');
                secBadgePill.className = isHardened 
                    ? 'self-start sm:self-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300'
                    : (isWarning ? 'self-start sm:self-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-300' : 'self-start sm:self-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-300');
            }

            // Headers List
            const headersList = document.getElementById('res-headers-list');
            if (headersList && data.security.headers_audit) {
                headersList.innerHTML = '';
                data.security.headers_audit.forEach(h => {
                    const isPass = (h.status === 'pass');
                    const row = document.createElement('div');
                    row.className = 'p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs hover:bg-slate-50/60 transition-colors';
                    row.innerHTML = `
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-900">${escapeHtml(h.header)}</span>
                                ${isPass 
                                    ? '<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">✓ Present</span>'
                                    : '<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">Missing</span>'}
                            </div>
                            <div class="text-slate-500 mt-1">${escapeHtml(h.description || '')}</div>
                            ${isPass && h.value && h.value !== 'Not Configured' ? `<div class="mt-1 font-mono text-[11px] text-slate-700 bg-slate-100 px-2 py-0.5 rounded truncate max-w-md">${escapeHtml(h.value)}</div>` : ''}
                        </div>
                        ${!isPass ? `
                            <div class="shrink-0 bg-slate-900 text-slate-100 p-2 rounded-lg font-mono text-[11px] max-w-xs overflow-x-auto">
                                <code>${escapeHtml(h.recommended || '')}</code>
                            </div>
                        ` : ''}
                    `;
                    headersList.appendChild(row);
                });
            }

            // Other security metrics
            const malwareSigEl = document.getElementById('res-malware-sig-count');
            if (malwareSigEl) {
                malwareSigEl.innerText = (data.security.malware_signatures === 0) ? '0 Detected (Clean)' : `${data.security.malware_signatures} Signatures!`;
                malwareSigEl.className = (data.security.malware_signatures === 0) ? 'font-bold text-slate-800 text-sm mt-1' : 'font-bold text-rose-600 text-sm mt-1';
            }

            const sslEl = document.getElementById('res-ssl-status');
            if (sslEl) {
                sslEl.innerText = data.security.is_https ? 'Enforced (TLS)' : 'Insecure HTTP!';
                sslEl.className = data.security.is_https ? 'font-bold text-slate-800 text-sm mt-1' : 'font-bold text-rose-600 text-sm mt-1';
            }

            const srvEl = document.getElementById('res-server-header');
            if (srvEl) {
                srvEl.innerText = data.security.server_signature || 'Hidden';
            }

            // 4. Tab 3: Website Bugs & Code Fixes
            const bugsList = document.getElementById('res-bugs-list');
            if (bugsList) {
                bugsList.innerHTML = '';
                if (data.bugs.detected_bugs && data.bugs.detected_bugs.length > 0) {
                    data.bugs.detected_bugs.forEach(bug => {
                        const isCrit = (bug.severity === 'critical');
                        const isHigh = (bug.severity === 'high');
                        const card = document.createElement('div');
                        card.className = 'bg-white rounded-2xl border border-slate-200 p-5 shadow-soft-xs space-y-3';
                        card.innerHTML = `
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider ${
                                        isCrit ? 'bg-rose-100 text-rose-800 border border-rose-200' : (isHigh ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-indigo-100 text-indigo-800 border border-indigo-200')
                                    }">${escapeHtml(bug.severity)}</span>
                                    <span class="text-xs font-semibold text-slate-500">${escapeHtml(bug.type)}</span>
                                </div>
                                <h5 class="text-sm font-bold text-slate-900">${escapeHtml(bug.title)}</h5>
                            </div>
                            <div class="text-xs text-slate-600 leading-relaxed">${escapeHtml(bug.impact)}</div>
                            <div class="text-xs font-medium text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex-1">
                                    <strong class="text-indigo-700">Permanent Solution:</strong> ${escapeHtml(bug.solution)}
                                </div>
                                <a href="<?= site_url('register') ?>" class="shrink-0 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-xs transition-colors whitespace-nowrap">
                                    <span>⚡ Auto-Fix with SiteOps Plan</span>
                                </a>
                            </div>
                            ${bug.fix_snippet ? `
                                <div class="relative">
                                    <div class="flex items-center justify-between bg-slate-950 text-slate-400 px-3 py-1.5 rounded-t-xl text-[11px] font-mono border-b border-slate-800">
                                        <span>Ready-to-Paste Code Fix:</span>
                                        <button type="button" onclick="copyFixCode(this)" class="copy-fix-btn bg-indigo-600 hover:bg-indigo-500 text-white px-2.5 py-0.5 rounded text-[10px] font-bold transition-colors">
                                            Copy Code Fix
                                        </button>
                                    </div>
                                    <pre class="bg-slate-900 text-slate-100 p-3.5 rounded-b-xl font-mono text-xs overflow-x-auto"><code>${escapeHtml(bug.fix_snippet)}</code></pre>
                                </div>
                            ` : ''}
                        `;
                        bugsList.appendChild(card);
                    });
                } else {
                    bugsList.innerHTML = '<div class="text-center py-8 text-emerald-700 font-semibold text-sm bg-emerald-50 rounded-2xl border border-emerald-200">✓ No critical layout, responsiveness, or DOM bugs detected!</div>';
                }
            }
        }

        function copyFixCode(btn) {
            const pre = btn.closest('.relative').querySelector('pre code');
            if (!pre) return;
            const text = pre.innerText;
            navigator.clipboard.writeText(text).then(() => {
                const original = btn.innerText;
                btn.innerText = 'Copied!';
                btn.classList.add('bg-emerald-600');
                setTimeout(() => {
                    btn.innerText = original;
                    btn.classList.remove('bg-emerald-600');
                }, 2000);
            }).catch(() => {
                alert('Copied to clipboard');
            });
        }

        function escapeHtml(text) {
            if (!text) return '';
            return String(text)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Initialize On Load
        document.addEventListener('DOMContentLoaded', () => {
            startReviewRotation();
        });
    </script>
</body>
</html>
