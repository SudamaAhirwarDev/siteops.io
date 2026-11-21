<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'SiteOps — Dashboard') ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">
    
    <!-- CSRF Meta Tags for AJAX calls -->
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
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
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 7px; height: 7px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-surface-base text-slate-800 font-sans antialiased min-h-screen flex flex-col selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-40 backdrop-blur-xl bg-white/90 border-b border-surface-border shadow-soft-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-3">
            <!-- Brand -->
            <div class="flex items-center gap-4 sm:gap-6 min-w-0">
                <a href="<?= site_url('dashboard') ?>" class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                    <div class="relative w-8 h-8 sm:w-9 sm:h-9 transition-transform group-hover:scale-105 shrink-0">
                        <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_2px_8px_rgba(79,70,229,0.35)]">
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-base sm:text-lg font-extrabold tracking-tight text-slate-900">SiteOps<span class="text-indigo-600">.</span></span>
                        <span class="hidden xs:inline-flex text-[10px] font-mono px-2 py-0.5 rounded-full bg-brand-50 text-brand-700 border border-brand-200/80 font-bold uppercase tracking-wider">
                            &lt;15KB
                        </span>
                    </div>
                </a>

                <!-- Module Quick Links (Desktop) -->
                <nav class="hidden md:flex items-center gap-1 text-xs font-semibold">
                    <a href="<?= site_url('dashboard') ?>" class="px-3 py-1.5 rounded-lg transition-colors <?= uri_string() === 'dashboard' ? 'bg-slate-100 text-brand-700 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' ?>">
                        Overview
                    </a>
                    <a href="<?= site_url('modules/reviews') ?>" class="px-3 py-1.5 rounded-lg transition-colors <?= str_contains(uri_string(), 'reviews') ? 'bg-slate-100 text-brand-700 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' ?>">
                        Social Proof &amp; Reviews
                    </a>
                    <a href="<?= site_url('modules/seo') ?>" class="px-3 py-1.5 rounded-lg transition-colors <?= str_contains(uri_string(), 'seo') ? 'bg-slate-100 text-brand-700 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' ?>">
                        AI SEO &amp; GEO
                    </a>
                    <a href="<?= site_url('modules/dunning') ?>" class="px-3 py-1.5 rounded-lg transition-colors <?= str_contains(uri_string(), 'dunning') ? 'bg-slate-100 text-brand-700 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' ?>">
                        Stripe Dunning
                    </a>
                    <button type="button" onclick="openInstallGuideModal()" class="ml-2 px-3 py-1.5 rounded-lg text-xs font-bold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/80 transition-all flex items-center gap-1.5 shadow-soft-xs cursor-pointer">
                        <span>📖 How to Add Script</span>
                    </button>
                </nav>
            </div>

            <!-- User Menu & Mobile Controls -->
            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                <?php if (session()->get('is_admin') || session()->get('user_role') === 'admin' || session()->get('is_impersonating')): ?>
                    <a href="<?= site_url('admin') ?>" class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1.5 rounded-lg bg-indigo-950 text-indigo-200 border border-indigo-700/60 hover:bg-slate-900 transition-colors shadow-soft-xs">
                        <span>🛡️ Admin Panel</span>
                    </a>
                <?php endif; ?>

                <a href="<?= site_url('/') ?>" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-soft-xs hover:border-slate-300">
                    <span>Landing Page</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <div class="flex items-center gap-2 pl-2 sm:pl-3 border-l border-slate-200">
                    <div class="flex flex-col text-right">
                        <span class="text-xs font-bold text-slate-900 max-w-[110px] sm:max-w-[160px] truncate"><?= esc(session()->get('user_name') ?? 'Site Owner') ?></span>
                        <div class="flex items-center justify-end gap-1.5">
                            <?php 
                                $userPlan = strtolower(session()->get('plan_type') ?? 'trial');
                                $isPro = in_array($userPlan, ['pro', 'agency'], true);
                                $isExp = ($userPlan === 'expired');
                            ?>
                            <span class="w-2 h-2 rounded-full <?= $isPro ? 'bg-emerald-500' : ($isExp ? 'bg-rose-500' : 'bg-amber-500') ?>"></span>
                            <span class="text-[9px] sm:text-[10px] uppercase font-bold tracking-wider <?= $isPro ? 'text-emerald-700' : ($isExp ? 'text-rose-700' : 'text-amber-800') ?>">
                                <?= $isPro ? esc(strtoupper($userPlan)) : ($isExp ? 'EXPIRED' : '15D TRIAL') ?>
                            </span>
                        </div>
                    </div>

                    <a href="<?= site_url('logout') ?>" title="Sign Out" class="p-1.5 sm:p-2 rounded-xl bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 shadow-soft-xs transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </div>

                <!-- Dashboard Mobile Menu Toggle Button -->
                <button 
                    type="button" 
                    id="dash-mobile-toggle-btn" 
                    onclick="toggleDashboardMobileMenu()" 
                    aria-label="Toggle navigation drawer"
                    class="md:hidden p-2 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-colors"
                >
                    <svg id="dash-hamburger-icon-open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="dash-hamburger-icon-close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Dashboard Mobile Slide-Down Drawer -->
        <div id="dashboard-mobile-nav" class="hidden md:hidden bg-white/98 backdrop-blur-2xl border-t border-slate-200 px-4 py-4 space-y-2 shadow-soft-lg">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block px-1">Modules &amp; Tools</span>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-semibold">
                <a href="<?= site_url('dashboard') ?>" class="p-2.5 rounded-xl border flex items-center gap-2.5 <?= uri_string() === 'dashboard' ? 'bg-indigo-50 border-indigo-200 text-indigo-700 font-bold' : 'bg-slate-50 border-slate-200/80 text-slate-700 hover:bg-slate-100' ?>">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                    <span>Domains Overview</span>
                </a>
                <a href="<?= site_url('modules/reviews') ?>" class="p-2.5 rounded-xl border flex items-center gap-2.5 <?= str_contains(uri_string(), 'reviews') ? 'bg-indigo-50 border-indigo-200 text-indigo-700 font-bold' : 'bg-slate-50 border-slate-200/80 text-slate-700 hover:bg-slate-100' ?>">
                    <span class="text-amber-500 font-bold">★</span>
                    <span>Social Proof &amp; Reviews</span>
                </a>
                <a href="<?= site_url('modules/seo') ?>" class="p-2.5 rounded-xl border flex items-center gap-2.5 <?= str_contains(uri_string(), 'seo') ? 'bg-indigo-50 border-indigo-200 text-indigo-700 font-bold' : 'bg-slate-50 border-slate-200/80 text-slate-700 hover:bg-slate-100' ?>">
                    <span class="text-indigo-600 font-bold">⚡</span>
                    <span>AI SEO &amp; GEO Engine</span>
                </a>
                <a href="<?= site_url('modules/dunning') ?>" class="p-2.5 rounded-xl border flex items-center gap-2.5 <?= str_contains(uri_string(), 'dunning') ? 'bg-indigo-50 border-indigo-200 text-indigo-700 font-bold' : 'bg-slate-50 border-slate-200/80 text-slate-700 hover:bg-slate-100' ?>">
                    <span class="text-emerald-600 font-bold">$</span>
                    <span>Stripe Dunning</span>
                </a>
                <?php if (session()->get('is_admin') || session()->get('user_role') === 'admin' || session()->get('is_impersonating')): ?>
                    <a href="<?= site_url('admin') ?>" class="p-2.5 rounded-xl border flex items-center gap-2.5 bg-indigo-950 border-indigo-800 text-indigo-200 font-bold sm:col-span-2">
                        <span>🛡️</span>
                        <span>Master Admin Control</span>
                    </a>
                <?php endif; ?>
                <button type="button" onclick="openInstallGuideModal(); toggleDashboardMobileMenu();" class="p-2.5 rounded-xl border flex items-center gap-2.5 bg-indigo-50 border-indigo-200 text-indigo-700 font-bold hover:bg-indigo-100 transition-colors sm:col-span-2 text-left">
                    <span>📖</span>
                    <span>How to Add Script (WordPress, Shopify, Next.js, HTML)</span>
                </button>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                <a href="<?= site_url('/') ?>" target="_blank" class="text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                    <span>View Landing Page</span>
                    <span>&rarr;</span>
                </a>
                <a href="<?= site_url('logout') ?>" class="text-rose-600 hover:text-rose-700 font-bold">
                    Sign Out
                </a>
            </div>
        </div>
    </header>

    <!-- Global Flash Alerts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center justify-between mb-4 shadow-soft-sm">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 font-bold text-base">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-semibold flex items-center justify-between mb-4 shadow-soft-sm">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 font-bold text-base">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm mb-4 shadow-soft-sm">
                <p class="font-bold mb-1.5 flex items-center gap-2 text-rose-900">
                    <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    Please fix the following validation errors:
                </p>
                <ul class="list-disc list-inside space-y-1 text-rose-700 text-xs">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Content Injection -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-surface-border py-6 text-xs text-slate-500 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-700">SiteOps Architecture</span>
                <span>&bull;</span>
                <span>Ultra-Lightweight &lt;15KB Growth &amp; Compliance Suite</span>
            </div>
            <div class="text-slate-400">
                Built on PHP <?= phpversion() ?> &bull; CodeIgniter 4 MVC &bull; MySQL
            </div>
        </div>
    </footer>

    <!-- Global Installation Guide Modal (Available Across All Dashboard Pages) -->
    <div id="install-guide-modal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 bg-slate-950/70 backdrop-blur-md hidden overflow-y-auto">
        <div class="bg-white border border-slate-200/90 rounded-3xl max-w-2xl w-full shadow-2xl overflow-hidden my-auto animate-in fade-in zoom-in-95 duration-150">
            <!-- Modal Header -->
            <div class="px-6 py-5 bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white flex items-center justify-between border-b border-indigo-900/60">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-600/30 border border-indigo-500/40 flex items-center justify-center text-indigo-300 font-bold text-lg shadow-inner">
                        📖
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            How to Add SiteOps Script
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">&lt;15KB Bundle</span>
                        </h3>
                        <p class="text-xs text-indigo-200/80 mt-0.5">Works on any CMS, framework, or static HTML in under 60 seconds</p>
                    </div>
                </div>
                <button onclick="closeInstallGuideModal()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors text-lg">
                    &times;
                </button>
            </div>

            <!-- Active Target Domain Info Bar -->
            <div class="px-6 py-3 bg-indigo-50/70 border-b border-indigo-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-slate-700">Target Domain:</span>
                    <span id="guide-active-domain" class="font-mono font-bold text-indigo-700 bg-white px-2.5 py-1 rounded-lg border border-indigo-200">mywebsite.com</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-500">Site Key:</span>
                    <span id="guide-active-key" class="font-mono text-slate-700 bg-white px-2 py-0.5 rounded border border-slate-200 text-[11px]">so_xxxxxxxxxxxx</span>
                </div>
            </div>

            <!-- 1-Click Code Box -->
            <div class="p-6 border-b border-slate-100 bg-slate-900 text-slate-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Universal 1-Line Embed Snippet
                    </span>
                    <button onclick="copyCurrentScriptSnippet()" id="btn-copy-guide-script"
                            class="text-xs bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1.5 rounded-lg shadow-sm transition-all flex items-center gap-1.5 font-bold cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        <span id="guide-copy-btn-label">Copy Script Tag</span>
                    </button>
                </div>
                <pre class="text-xs font-mono text-emerald-400 overflow-x-auto p-3.5 bg-slate-950 rounded-xl border border-slate-800"><code id="guide-code-snippet">&lt;script src="<?= base_url('loader.js?id=YOUR_SITE_KEY') ?>" async&gt;&lt;/script&gt;</code></pre>
                <p class="text-[11px] text-slate-400 mt-2 flex items-center gap-1.5">
                    <span>💡</span>
                    <span>Asynchronous non-blocking loading. Zero impact on PageSpeed &amp; Core Web Vitals.</span>
                </p>
            </div>

            <!-- Platform Tabs -->
            <div class="px-6 pt-4 bg-slate-50 border-b border-slate-200">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Select Your Platform / CMS:</span>
                <div class="flex items-center gap-2 overflow-x-auto pb-3 text-xs font-bold" id="platform-tabs">
                    <button type="button" onclick="switchGuideTab('html')" id="tab-btn-html" class="guide-tab-btn active px-3.5 py-1.5 rounded-xl bg-indigo-600 text-white shadow-soft-xs transition-all whitespace-nowrap">
                        🌐 HTML / PHP
                    </button>
                    <button type="button" onclick="switchGuideTab('wordpress')" id="tab-btn-wordpress" class="guide-tab-btn px-3.5 py-1.5 rounded-xl bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 transition-all whitespace-nowrap">
                        🟦 WordPress
                    </button>
                    <button type="button" onclick="switchGuideTab('shopify')" id="tab-btn-shopify" class="guide-tab-btn px-3.5 py-1.5 rounded-xl bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 transition-all whitespace-nowrap">
                        🟢 Shopify
                    </button>
                    <button type="button" onclick="switchGuideTab('nextjs')" id="tab-btn-nextjs" class="guide-tab-btn px-3.5 py-1.5 rounded-xl bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 transition-all whitespace-nowrap">
                        ⚛️ Next.js / React
                    </button>
                    <button type="button" onclick="switchGuideTab('webflow')" id="tab-btn-webflow" class="guide-tab-btn px-3.5 py-1.5 rounded-xl bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 transition-all whitespace-nowrap">
                        🎨 Webflow / Wix
                    </button>
                </div>
            </div>

            <!-- Tab Content Panels -->
            <div class="p-6 max-h-[380px] overflow-y-auto space-y-4 text-xs text-slate-600 leading-relaxed">
                <!-- Tab Panel 1: HTML / PHP -->
                <div id="panel-html" class="guide-panel space-y-3">
                    <div class="p-3.5 rounded-2xl bg-indigo-50/60 border border-indigo-100 text-slate-800">
                        <h4 class="font-bold text-sm text-indigo-950 mb-1">Standard HTML / PHP Installation</h4>
                        <p>Paste the snippet directly into your website's main HTML template inside the <code class="bg-indigo-100 px-1 py-0.5 rounded text-indigo-900 font-mono font-bold">&lt;head&gt;</code> section.</p>
                    </div>

                    <ol class="list-decimal list-inside space-y-2 text-slate-700">
                        <li>Open your root layout or header template file (e.g., <code class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-900">index.html</code>, <code class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-900">header.php</code>, or <code class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-900">layout.blade.php</code>).</li>
                        <li>Paste the SiteOps <code class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-900">&lt;script&gt;</code> tag right before the closing <code class="font-mono text-indigo-600 font-bold">&lt;/head&gt;</code> tag.</li>
                        <li>Save and upload the file to your web server.</li>
                    </ol>

                    <div class="p-3 bg-slate-900 rounded-xl font-mono text-[11px] text-slate-300">
                        <span class="text-slate-500">&lt;!-- Example Placement: --&gt;</span><br>
                        <span class="text-indigo-400">&lt;head&gt;</span><br>
                        &nbsp;&nbsp;<span class="text-slate-400">&lt;title&gt;My Website&lt;/title&gt;</span><br>
                        &nbsp;&nbsp;<span class="text-emerald-400" id="html-guide-example">&lt;script src="..." async&gt;&lt;/script&gt;</span><br>
                        <span class="text-indigo-400">&lt;/head&gt;</span>
                    </div>
                </div>

                <!-- Tab Panel 2: WordPress -->
                <div id="panel-wordpress" class="guide-panel hidden space-y-3">
                    <div class="p-3.5 rounded-2xl bg-indigo-50/60 border border-indigo-100 text-slate-800">
                        <h4 class="font-bold text-sm text-indigo-950 mb-1">WordPress (No Coding Required)</h4>
                        <p>You can add the SiteOps universal script in under 60 seconds using the free WPCode plugin or your active theme's Header settings.</p>
                    </div>

                    <div class="space-y-3">
                        <div class="border border-slate-200 rounded-xl p-3 bg-white">
                            <span class="font-bold text-slate-900 block mb-1">Option A: Using WPCode Plugin (Recommended &bull; 60 seconds)</span>
                            <ol class="list-decimal list-inside space-y-1 text-slate-600 text-xs">
                                <li>In WordPress Admin, go to <strong>Plugins &rarr; Add New</strong>.</li>
                                <li>Search for <strong>"WPCode"</strong> (or "Insert Headers and Footers") and click <strong>Install &amp; Activate</strong>.</li>
                                <li>Navigate to <strong>Code Snippets &rarr; Header &amp; Footer</strong> in your left admin sidebar.</li>
                                <li>In the <strong>Header</strong> box, paste your SiteOps <code class="font-mono bg-slate-100 px-1 text-indigo-700">&lt;script&gt;</code> tag.</li>
                                <li>Click <strong>Save Changes</strong>. Done!</li>
                            </ol>
                        </div>

                        <div class="border border-slate-200 rounded-xl p-3 bg-white">
                            <span class="font-bold text-slate-900 block mb-1">Option B: Theme Header Editor</span>
                            <ol class="list-decimal list-inside space-y-1 text-slate-600 text-xs">
                                <li>Go to <strong>Appearance &rarr; Theme File Editor</strong>.</li>
                                <li>On the right side list, click <strong>Theme Header (<code class="font-mono">header.php</code>)</strong>.</li>
                                <li>Paste the script tag just above the closing <code class="font-mono text-indigo-600">&lt;/head&gt;</code> line.</li>
                                <li>Click <strong>Update File</strong>.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Tab Panel 3: Shopify -->
                <div id="panel-shopify" class="guide-panel hidden space-y-3">
                    <div class="p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-100 text-slate-800">
                        <h4 class="font-bold text-sm text-emerald-950 mb-1">Shopify Online Store Setup</h4>
                        <p>Add SiteOps directly to your Shopify store theme to instantly activate review toasts and compliance.</p>
                    </div>

                    <ol class="list-decimal list-inside space-y-2 text-slate-700">
                        <li>Log in to your <strong>Shopify Admin</strong>.</li>
                        <li>Click <strong>Online Store &rarr; Themes</strong> in the left menu.</li>
                        <li>Next to your active theme, click the <strong>... (three dots)</strong> and select <strong>Edit code</strong>.</li>
                        <li>In the left sidebar under <strong>Layout</strong>, click <code class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-indigo-700">theme.liquid</code>.</li>
                        <li>Scroll down or press <kbd class="px-1.5 py-0.5 bg-slate-200 rounded text-[10px]">Ctrl+F</kbd> to find the <code class="font-mono text-indigo-600 font-bold">&lt;/head&gt;</code> tag.</li>
                        <li>Paste your SiteOps script code immediately above <code class="font-mono text-indigo-600 font-bold">&lt;/head&gt;</code>.</li>
                        <li>Click <strong>Save</strong> at the top right of the editor.</li>
                    </ol>
                </div>

                <!-- Tab Panel 4: Next.js / React -->
                <div id="panel-nextjs" class="guide-panel hidden space-y-3">
                    <div class="p-3.5 rounded-2xl bg-slate-100 border border-slate-200 text-slate-800">
                        <h4 class="font-bold text-sm text-slate-900 mb-1">Next.js &amp; Modern React</h4>
                        <p>Use Next.js built-in <code class="font-mono font-bold text-indigo-600">&lt;Script&gt;</code> component for optimal hydration and performance.</p>
                    </div>

                    <div class="space-y-2">
                        <span class="font-bold text-slate-900 block">Next.js App Router (<code class="font-mono text-xs">app/layout.tsx</code> or <code class="font-mono text-xs">app/layout.js</code>):</span>
                        <div class="p-3 bg-slate-900 rounded-xl font-mono text-[11px] text-slate-300 overflow-x-auto">
                            <span class="text-indigo-400">import</span> Script <span class="text-indigo-400">from</span> <span class="text-emerald-400">'next/script'</span>;<br><br>
                            <span class="text-indigo-400">export default function</span> RootLayout({ children }) {<br>
                            &nbsp;&nbsp;<span class="text-indigo-400">return</span> (<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&lt;html lang=<span class="text-emerald-400">"en"</span>&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;head&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;Script<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-slate-400">src</span>=<span class="text-amber-300" id="nextjs-script-src">"<?= base_url('loader.js?id=YOUR_SITE_KEY') ?>"</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-slate-400">strategy</span>=<span class="text-emerald-400">"afterInteractive"</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/head&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;{children}&lt;/body&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&lt;/html&gt;<br>
                            &nbsp;&nbsp;);<br>
                            }
                        </div>
                    </div>
                </div>

                <!-- Tab Panel 5: Webflow / Wix / Squarespace -->
                <div id="panel-webflow" class="guide-panel hidden space-y-3">
                    <div class="p-3.5 rounded-2xl bg-indigo-50/60 border border-indigo-100 text-slate-800">
                        <h4 class="font-bold text-sm text-indigo-950 mb-1">No-Code Website Builders</h4>
                    </div>

                    <div class="space-y-3">
                        <div class="border border-slate-200 rounded-xl p-3 bg-white">
                            <span class="font-bold text-slate-900 block mb-0.5">Webflow</span>
                            <p class="text-slate-600">Open <strong>Project Settings &rarr; Custom Code</strong> &rarr; Paste your snippet into the <strong>Head Code</strong> field &rarr; Click <strong>Save &amp; Publish</strong>.</p>
                        </div>
                        <div class="border border-slate-200 rounded-xl p-3 bg-white">
                            <span class="font-bold text-slate-900 block mb-0.5">Wix</span>
                            <p class="text-slate-600">Go to <strong>Settings &rarr; Custom Code</strong> &rarr; Click <strong>+ Add Custom Code</strong> &rarr; Paste snippet &rarr; Set to load on <strong>All Pages (Load once)</strong> and place in <strong>Head</strong> &rarr; Click <strong>Apply</strong>.</p>
                        </div>
                        <div class="border border-slate-200 rounded-xl p-3 bg-white">
                            <span class="font-bold text-slate-900 block mb-0.5">Squarespace</span>
                            <p class="text-slate-600">Go to <strong>Settings &rarr; Advanced &rarr; Code Injection</strong> &rarr; Paste snippet into the <strong>Header</strong> box &rarr; Click <strong>Save</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer: Live Verification Section -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-xs">
                    <span id="verify-status-dot" class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                    <span id="verify-status-text" class="text-slate-600">Click verify to check if your script is live.</span>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="runScriptVerification()" id="btn-verify-guide" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-soft-sm transition-all flex items-center gap-1.5 cursor-pointer">
                        <span>⚡ Test &amp; Verify Connection</span>
                    </button>
                    <button type="button" onclick="closeInstallGuideModal()" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 bg-white border border-slate-200 transition-colors">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Helper Script for Copying, Modals and Notifications -->
    <script>
        let currentGuideSiteId = null;
        let currentGuideSiteKey = '';
        let currentGuideDomain = '';

        function openInstallGuideModal(domain = '', siteKey = '', siteId = null) {
            const modal = document.getElementById('install-guide-modal');
            if (!modal) return;

            // Default fallback if called from global navbar
            if (!domain) {
                const firstSiteEl = document.querySelector('[data-site-domain]');
                if (firstSiteEl) {
                    domain = firstSiteEl.getAttribute('data-site-domain') || 'yourdomain.com';
                    siteKey = firstSiteEl.getAttribute('data-site-key') || 'so_sample_key';
                    siteId = firstSiteEl.getAttribute('data-site-id') || null;
                } else {
                    domain = 'yourbrand.com';
                    siteKey = 'so_universal_key';
                }
            }

            currentGuideDomain = domain;
            currentGuideSiteKey = siteKey;
            currentGuideSiteId = siteId;

            const domainEl = document.getElementById('guide-active-domain');
            const keyEl = document.getElementById('guide-active-key');
            const codeEl = document.getElementById('guide-code-snippet');
            const htmlEx = document.getElementById('html-guide-example');
            const nextSrc = document.getElementById('nextjs-script-src');

            const scriptUrl = '<?= base_url('loader.js?id=') ?>' + siteKey;
            const fullSnippet = `<script src="${scriptUrl}" async><\/script>`;

            if (domainEl) domainEl.innerText = domain;
            if (keyEl) keyEl.innerText = siteKey;
            if (codeEl) codeEl.innerText = fullSnippet;
            if (htmlEx) htmlEx.innerText = fullSnippet;
            if (nextSrc) nextSrc.innerText = `"${scriptUrl}"`;

            // Reset verification status
            const statusDot = document.getElementById('verify-status-dot');
            const statusText = document.getElementById('verify-status-text');
            if (statusDot) statusDot.className = 'w-2.5 h-2.5 rounded-full bg-slate-300';
            if (statusText) statusText.innerText = 'Click verify to check if your script is live.';

            modal.classList.remove('hidden');
        }

        function closeInstallGuideModal() {
            const modal = document.getElementById('install-guide-modal');
            if (modal) modal.classList.add('hidden');
        }

        function switchGuideTab(platform) {
            document.querySelectorAll('.guide-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.guide-tab-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-slate-700');
            });

            const targetPanel = document.getElementById('panel-' + platform);
            const targetBtn = document.getElementById('tab-btn-' + platform);

            if (targetPanel) targetPanel.classList.remove('hidden');
            if (targetBtn) {
                targetBtn.classList.remove('bg-white', 'text-slate-700');
                targetBtn.classList.add('bg-indigo-600', 'text-white');
            }
        }

        function copyCurrentScriptSnippet() {
            const scriptUrl = '<?= base_url('loader.js?id=') ?>' + (currentGuideSiteKey || 'YOUR_SITE_KEY');
            const snippet = `<script src="${scriptUrl}" async><\/script>`;
            copyToClipboard(snippet, 'guide-copy-btn-label', 'Copy Script Tag');
        }

        function runScriptVerification() {
            const statusDot = document.getElementById('verify-status-dot');
            const statusText = document.getElementById('verify-status-text');
            const btn = document.getElementById('btn-verify-guide');

            if (!currentGuideSiteId) {
                if (statusText) statusText.innerText = 'Please select or add a domain first to verify connection.';
                return;
            }

            if (btn) btn.disabled = true;
            if (statusDot) statusDot.className = 'w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping';
            if (statusText) statusText.innerText = 'Pinging ' + currentGuideDomain + '...';

            fetch('<?= site_url('dashboard/site/verify/') ?>' + currentGuideSiteId)
                .then(res => res.json())
                .then(data => {
                    if (btn) btn.disabled = false;
                    if (data.connected) {
                        if (statusDot) statusDot.className = 'w-2.5 h-2.5 rounded-full bg-emerald-500';
                        if (statusText) statusText.innerHTML = `<strong class="text-emerald-700">✓ Connected!</strong> ${data.pings_count} requests logged from ${data.domain}.`;
                    } else {
                        if (statusDot) statusDot.className = 'w-2.5 h-2.5 rounded-full bg-amber-500';
                        if (statusText) statusText.innerHTML = `<span class="text-amber-700">${data.message}</span>`;
                    }
                })
                .catch(err => {
                    if (btn) btn.disabled = false;
                    if (statusDot) statusDot.className = 'w-2.5 h-2.5 rounded-full bg-rose-500';
                    if (statusText) statusText.innerText = 'Verification check failed. Ensure site is reachable.';
                });
        }

        function toggleDashboardMobileMenu() {
            const drawer = document.getElementById('dashboard-mobile-nav');
            const iconOpen = document.getElementById('dash-hamburger-icon-open');
            const iconClose = document.getElementById('dash-hamburger-icon-close');
            if (drawer) {
                const isClosed = drawer.classList.contains('hidden');
                if (isClosed) {
                    drawer.classList.remove('hidden');
                    if (iconOpen) iconOpen.classList.add('hidden');
                    if (iconClose) iconClose.classList.remove('hidden');
                } else {
                    drawer.classList.add('hidden');
                    if (iconOpen) iconOpen.classList.remove('hidden');
                    if (iconClose) iconClose.classList.add('hidden');
                }
            }
        }

        function copyToClipboard(text, elementId, defaultText = 'Copy') {
            navigator.clipboard.writeText(text).then(() => {
                const el = document.getElementById(elementId);
                if (el) {
                    const original = el.innerText;
                    el.innerText = 'Copied!';
                    setTimeout(() => { el.innerText = original; }, 2000);
                }
            }).catch(() => {
                alert('Copied: ' + text);
            });
        }
    </script>
</body>
</html>
