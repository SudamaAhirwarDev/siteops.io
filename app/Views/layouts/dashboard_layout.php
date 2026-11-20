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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand -->
            <div class="flex items-center gap-6">
                <a href="<?= site_url('dashboard') ?>" class="flex items-center gap-3 group">
                    <div class="relative w-9 h-9 transition-transform group-hover:scale-105 shrink-0">
                        <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_2px_8px_rgba(79,70,229,0.35)]">
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-lg font-extrabold tracking-tight text-slate-900">SiteOps<span class="text-indigo-600">.</span></span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-brand-50 text-brand-700 border border-brand-200/80 font-bold uppercase tracking-wider">
                            &lt;15KB
                        </span>
                    </div>
                </a>

                <!-- Module Quick Links -->
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
                </nav>
            </div>

            <!-- User Menu -->
            <div class="flex items-center gap-3 sm:gap-4">
                <a href="<?= site_url('/') ?>" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-soft-xs hover:border-slate-300">
                    <span>Landing Page</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                    <div class="flex flex-col text-right">
                        <span class="text-xs font-bold text-slate-900"><?= esc(session()->get('user_name') ?? 'Site Owner') ?></span>
                        <div class="flex items-center justify-end gap-1.5">
                            <?php 
                                $userPlan = strtolower(session()->get('plan_type') ?? 'trial');
                                $isPro = in_array($userPlan, ['pro', 'agency'], true);
                                $isExp = ($userPlan === 'expired');
                            ?>
                            <span class="w-2 h-2 rounded-full <?= $isPro ? 'bg-emerald-500' : ($isExp ? 'bg-rose-500' : 'bg-amber-500') ?>"></span>
                            <span class="text-[10px] uppercase font-bold tracking-wider <?= $isPro ? 'text-emerald-700' : ($isExp ? 'text-rose-700' : 'text-amber-800') ?>">
                                <?= $isPro ? esc(strtoupper($userPlan) . ' • UNLIMITED') : ($isExp ? 'TRIAL EXPIRED' : '15-DAY TRIAL') ?>
                            </span>
                        </div>
                    </div>

                    <a href="<?= site_url('logout') ?>" title="Sign Out" class="p-2 rounded-xl bg-white hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 shadow-soft-xs transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </div>
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

    <!-- Global Helper Script for Copying and Notifications -->
    <script>
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
