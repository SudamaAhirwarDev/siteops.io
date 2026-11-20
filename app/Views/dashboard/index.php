<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="space-y-8">

    <!-- 15-Day Free Trial / Quota Progress Banner -->
    <?php if (isset($trial_status) && $trial_status['plan_type'] === 'trial'): ?>
        <div class="bg-gradient-to-r from-indigo-50/80 via-white to-violet-50/60 border border-indigo-100 rounded-3xl p-5 sm:p-6 shadow-soft-sm flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-4 flex-1">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200/80 flex items-center justify-center text-amber-600 shrink-0 font-bold text-lg shadow-soft-xs">
                    ⚡
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                        <span class="text-xs font-bold text-slate-900">Free Trial Active</span>
                        <span class="text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-200 px-2.5 py-0.5 rounded-full">
                            <?= esc($trial_status['days_left']) ?> Days Left
                        </span>
                        <span class="text-slate-300 text-xs">&bull;</span>
                        <span class="text-xs text-slate-600 font-semibold">
                            Today's Tasks: <strong class="text-slate-900 font-mono"><?= esc($trial_status['used_today']) ?> / <?= esc($trial_status['limit']) ?></strong> Used
                        </span>
                    </div>
                    <!-- Visual Progress Bar -->
                    <div class="w-full max-w-md bg-slate-100 rounded-full h-2.5 overflow-hidden border border-slate-200">
                        <div class="h-full rounded-full transition-all duration-500 <?= $trial_status['used_today'] >= 5 ? 'bg-rose-500' : ($trial_status['used_today'] >= 4 ? 'bg-amber-500' : 'bg-emerald-500') ?>"
                             style="width: <?= min(100, ($trial_status['used_today'] / 5) * 100) ?>%"></div>
                    </div>
                </div>
            </div>
            <button onclick="openUpgradeModal()" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all whitespace-nowrap shrink-0 flex items-center gap-1.5">
                <span>Upgrade to Unlimited ($39/mo)</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    <?php elseif (isset($trial_status) && $trial_status['is_expired']): ?>
        <div class="bg-rose-50/70 border border-rose-200 rounded-3xl p-5 sm:p-6 shadow-soft-sm flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 border border-rose-200 flex items-center justify-center text-rose-600 shrink-0 font-bold text-lg shadow-soft-xs">
                    🔒
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Your 15-Day Free Trial Has Ended</h3>
                    <p class="text-xs text-slate-600 mt-0.5">Automated task audits and widget features are paused. Upgrade to Pro for unlimited access.</p>
                </div>
            </div>
            <button onclick="openUpgradeModal()" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-500 shadow-soft-sm transition-all whitespace-nowrap shrink-0">
                Unlock Unlimited Access ($39/mo) &rarr;
            </button>
        </div>
    <?php endif; ?>

    <!-- Top Hero / Metrics Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest">Universal Hub</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Your Monitored Domains</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Manage your domains, copy universal &lt;15KB CDN snippets, and configure live modules.
            </p>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-soft-xs min-w-[125px]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Active Sites</span>
                <p class="text-2xl font-mono font-extrabold text-slate-900 mt-0.5"><?= esc($total_sites) ?></p>
            </div>
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-soft-xs min-w-[125px]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Active Modules</span>
                <p class="text-2xl font-mono font-extrabold text-indigo-600 mt-0.5"><?= esc($active_modules) ?></p>
            </div>
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-soft-xs min-w-[125px]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Reviews Synced</span>
                <p class="text-2xl font-mono font-extrabold text-amber-600 mt-0.5"><?= esc($total_reviews) ?></p>
            </div>
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-soft-xs min-w-[125px]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Recovered MRR</span>
                <p class="text-2xl font-mono font-extrabold text-emerald-600 mt-0.5">$<?= number_format($total_recovered, 2) ?></p>
            </div>
        </div>
    </div>

    <!-- Add Website Domain Card -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm relative overflow-hidden">
        <div class="max-w-3xl">
            <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Connect a New Website Domain
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Enter your website URL. SiteOps will immediately generate your unique 16-character secure script token.
            </p>

            <form action="<?= site_url('dashboard/site/create') ?>" method="POST" class="mt-4 flex flex-col sm:flex-row gap-3">
                <?= csrf_field() ?>
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-mono text-xs">
                        https://
                    </div>
                    <input type="text" name="domain" placeholder="example.com or app.yourbrand.io" required
                           class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl pl-20 pr-4 py-2.5 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 font-mono transition-all">
                </div>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all whitespace-nowrap">
                    + Generate Site Key
                </button>
            </form>
        </div>
    </div>

    <!-- Sites List -->
    <?php if (empty($sites)): ?>
        <div class="bg-white border border-dashed border-slate-300 rounded-3xl p-12 text-center shadow-soft-xs">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
            </div>
            <h3 class="text-base font-bold text-slate-900">No Domains Added Yet</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                Add your primary domain above to unlock universal ADA/EAA compliance, review popups, AI SEO, and dunning.
            </p>
        </div>
    <?php else: ?>
        <div class="space-y-6">
            <?php foreach ($sites as $site): ?>
                <?php 
                    $embedSnippet = '<script src="' . base_url('loader.js?id=' . esc($site['site_key'])) . '" async></script>';
                ?>
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-soft-sm hover:shadow-soft-md transition-shadow">
                    <!-- Site Header -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b border-slate-100">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-2xl bg-indigo-50 border border-indigo-100/80 flex items-center justify-center font-bold text-sm text-indigo-700 font-mono shadow-soft-xs">
                                <?= esc(strtoupper(substr($site['domain'], 0, 2))) ?>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-bold text-slate-900 font-mono"><?= esc($site['domain']) ?></h3>
                                    <a href="https://<?= esc($site['domain']) ?>" target="_blank" class="text-slate-400 hover:text-slate-600 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                    </a>
                                </div>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[11px] text-slate-500 font-mono">Site Key: <strong class="text-slate-700"><?= esc($site['site_key']) ?></strong></span>
                                    <span class="text-slate-300">&bull;</span>
                                    <span class="text-[11px] text-slate-400">Added <?= date('M d, Y', strtotime($site['created_at'])) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Direct Module Navigation Shortcuts -->
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="<?= site_url('modules/reviews/' . $site['id']) ?>" class="px-3.5 py-1.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors flex items-center gap-1.5 shadow-soft-xs">
                                <span class="text-amber-500">&#9733;</span> Reviews
                            </a>
                            <a href="<?= site_url('modules/seo/' . $site['id']) ?>" class="px-3.5 py-1.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors flex items-center gap-1.5 shadow-soft-xs">
                                <span class="text-indigo-600">&#9889;</span> AI SEO / GEO
                            </a>
                            <a href="<?= site_url('modules/dunning/' . $site['id']) ?>" class="px-3.5 py-1.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700 hover:text-slate-900 transition-colors flex items-center gap-1.5 shadow-soft-xs">
                                <span class="text-emerald-600">&#36;</span> Stripe Dunning
                            </a>
                        </div>
                    </div>

                    <!-- 1-Click Embed Snippet Box -->
                    <div class="mt-5 p-4 rounded-2xl bg-slate-900 text-slate-200 border border-slate-800 shadow-soft-xs">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                Universal 1-Line Embed Script (&lt;15KB Bundle)
                            </span>
                            <button onclick="copyToClipboard('<?= addslashes($embedSnippet) ?>', 'btn-copy-<?= $site['id'] ?>')" id="btn-copy-<?= $site['id'] ?>"
                                    class="text-xs bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1 rounded-lg shadow-sm transition-colors flex items-center gap-1.5 font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                <span>Copy 1-Line Script</span>
                            </button>
                        </div>
                        <div class="font-mono text-xs text-indigo-300 overflow-x-auto py-1">
                            <?= esc($embedSnippet) ?>
                        </div>
                    </div>

                    <!-- 4 Live AJAX Toggle Modules -->
                    <div class="mt-6">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-3">
                            Live Module Control Panel (Real-Time State)
                        </span>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <!-- Module A: Accessibility -->
                            <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full <?= $site['module_accessibility'] ? 'bg-emerald-500' : 'bg-slate-300' ?>" id="dot-accessibility-<?= $site['id'] ?>"></span>
                                        EU/ADA Accessibility
                                    </h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">WCAG + Auto Alt-Tag Fixer</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" <?= $site['module_accessibility'] ? 'checked' : '' ?>
                                           onchange="handleModuleToggle(<?= $site['id'] ?>, 'accessibility', this)"
                                           class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <!-- Module B: Social Proof Reviews -->
                            <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full <?= $site['module_reviews'] ? 'bg-emerald-500' : 'bg-slate-300' ?>" id="dot-reviews-<?= $site['id'] ?>"></span>
                                        Social Proof Reviews
                                    </h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Trustpilot &amp; Google Popup</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" <?= $site['module_reviews'] ? 'checked' : '' ?>
                                           onchange="handleModuleToggle(<?= $site['id'] ?>, 'reviews', this)"
                                           class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <!-- Module C: AI SEO / GEO -->
                            <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full <?= $site['module_seo'] ? 'bg-emerald-500' : 'bg-slate-300' ?>" id="dot-seo-<?= $site['id'] ?>"></span>
                                        AI SEO &amp; GEO Engine
                                    </h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">LLM &amp; ChatGPT Auditing</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" <?= $site['module_seo'] ? 'checked' : '' ?>
                                           onchange="handleModuleToggle(<?= $site['id'] ?>, 'seo', this)"
                                           class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <!-- Module D: Stripe Dunning -->
                            <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full <?= $site['module_dunning'] ? 'bg-emerald-500' : 'bg-slate-300' ?>" id="dot-dunning-<?= $site['id'] ?>"></span>
                                        Stripe Dunning
                                    </h4>
                                    <p class="text-[10px] text-slate-500 mt-0.5">Failed Payment Webhook</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" <?= $site['module_dunning'] ? 'checked' : '' ?>
                                           onchange="handleModuleToggle(<?= $site['id'] ?>, 'dunning', this)"
                                           class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<!-- ================================================================= -->
<!-- UPGRADE TO UNLIMITED PLANS MODAL -->
<!-- ================================================================= -->
<div id="upgrade-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md hidden transition-opacity duration-300">
    <div class="relative w-full max-w-4xl bg-white border border-slate-200 rounded-3xl p-6 sm:p-9 shadow-soft-lg overflow-hidden max-h-[92vh] overflow-y-auto">

        <!-- Close Button -->
        <button onclick="closeUpgradeModal()" class="absolute top-6 right-6 text-slate-400 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 p-2 rounded-xl transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Header -->
        <div class="text-center max-w-xl mx-auto mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Unlock Unlimited Growth
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Upgrade Your SiteOps Workspace</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-2">
                Say goodbye to the 5 tasks/day limit. Get non-stop AI SEO audits, continuous review synchronization, and full revenue dunning.
            </p>
        </div>

        <!-- Comparison Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative">
            
            <!-- Plan 1: Pro Growth ($39/mo) -->
            <div class="bg-gradient-to-b from-indigo-50/60 via-white to-white border-2 border-indigo-600 rounded-3xl p-6 sm:p-7 flex flex-col justify-between relative shadow-soft-md">
                <div class="absolute -top-3.5 right-6 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-wider px-3 py-0.5 rounded-full shadow-sm">
                    Most Popular
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900">Pro Growth</h3>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-700 font-semibold">Solo &amp; Startups</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Unlimited tasks for high-converting single websites.</p>

                    <div class="mt-5 flex items-baseline gap-1">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-mono">$39</span>
                        <span class="text-xs text-slate-500">/ month</span>
                    </div>

                    <ul class="mt-6 space-y-2.5 text-xs text-slate-700">
                        <li class="flex items-center gap-2 text-indigo-700 font-bold">
                            <span class="text-emerald-600">&#10003;</span> <span>Unlimited Daily Tasks (No 5/day cap)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> 1 Monitored Website Domain
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Unlimited AI SEO &amp; GEO Scraper Audits
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Continuous Social Proof Reviews Sync
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Full ADA &amp; EAA Accessibility Toolbar
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Stripe Dunning Recovery Automation
                        </li>
                    </ul>
                </div>

                <div class="mt-6 pt-5 border-t border-slate-100 space-y-2">
                    <button onclick="simulateUpgrade('pro')" class="w-full py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all flex items-center justify-center gap-2">
                        <span>Activate Pro ($39/mo)</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-[10px] text-center text-slate-400">Instant activation via Lemon Squeezy / Dodo Payments</p>
                </div>
            </div>

            <!-- Plan 2: Agency ($99/mo) -->
            <div class="bg-white border border-slate-200 hover:border-slate-300 rounded-3xl p-6 sm:p-7 flex flex-col justify-between relative shadow-soft-xs transition-all">
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900">Agency Scale</h3>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Client Teams</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Multi-client compliance and automated audits at scale.</p>

                    <div class="mt-5 flex items-baseline gap-1">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-mono">$99</span>
                        <span class="text-xs text-slate-500">/ month</span>
                    </div>

                    <ul class="mt-6 space-y-2.5 text-xs text-slate-700">
                        <li class="flex items-center gap-2 text-indigo-700 font-bold">
                            <span class="text-emerald-600">&#10003;</span> <span>Unlimited Daily Tasks Across All Sites</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> <strong>10 Active Domains</strong> Supported
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Whitelabel Client PDF Audit Reports
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Multi-Client Domain Dashboard
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Custom Widget CSS &amp; Branding Overrides
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-600">&#10003;</span> Priority Webhook &amp; 99.99% CDN SLA
                        </li>
                    </ul>
                </div>

                <div class="mt-6 pt-5 border-t border-slate-100 space-y-2">
                    <button onclick="simulateUpgrade('agency')" class="w-full py-3 rounded-xl text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors flex items-center justify-center gap-2">
                        <span>Activate Agency ($99/mo)</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-[10px] text-center text-slate-400">Cancel or swap plans anytime with 1-click</p>
                </div>
            </div>

        </div>

        <div class="mt-7 pt-5 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-400 flex items-center justify-center gap-4 flex-wrap">
                <span>🔒 256-bit Encrypted Checkout</span>
                <span>&bull;</span>
                <span>Instant License Provisioning</span>
                <span>&bull;</span>
                <span>30-Day Money-Back Guarantee</span>
            </p>
        </div>
    </div>
</div>

<!-- Real-Time AJAX Toggle Script & Upgrade Modal Logic -->
<script>
    let csrfHash = document.querySelector('meta[name="csrf-hash"]').getAttribute('content');
    const csrfName = document.querySelector('meta[name="csrf-token-name"]').getAttribute('content');

    function openUpgradeModal() {
        const modal = document.getElementById('upgrade-modal');
        if (modal) modal.classList.remove('hidden');
    }

    function closeUpgradeModal() {
        const modal = document.getElementById('upgrade-modal');
        if (modal) modal.classList.add('hidden');
    }

    // Auto-open if trial is expired
    <?php if (isset($trial_status) && $trial_status['is_expired']): ?>
        document.addEventListener('DOMContentLoaded', function() {
            openUpgradeModal();
        });
    <?php endif; ?>

    // Interactive 1-Click Upgrade Simulation via Webhook
    function simulateUpgrade(plan) {
        const userEmail = "<?= esc(session('email') ?? 'trial@siteops.io') ?>";
        
        fetch('<?= site_url('api/webhook/billing') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                event_type: 'subscription_created',
                plan: plan,
                email: userEmail
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(`🎉 Congratulations! Your account has been upgraded to ${plan.toUpperCase()} with UNLIMITED tasks.`);
                window.location.reload();
            } else {
                alert('Upgrade failed: ' + (data.message || 'Error occurred'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Failed to connect to billing webhook receiver.');
        });
    }

    function handleModuleToggle(siteId, moduleName, checkbox) {
        const newState = checkbox.checked ? 1 : 0;
        const dot = document.getElementById(`dot-${moduleName}-${siteId}`);

        const formData = new FormData();
        formData.append('site_id', siteId);
        formData.append('module', moduleName);
        formData.append('state', newState);
        formData.append(csrfName, csrfHash);

        fetch('<?= site_url('dashboard/module/toggle') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (data.csrf_hash) {
                    csrfHash = data.csrf_hash;
                    document.querySelector('meta[name="csrf-hash"]').setAttribute('content', csrfHash);
                }
                if (dot) {
                    dot.className = `w-2 h-2 rounded-full ${newState ? 'bg-emerald-500' : 'bg-slate-300'}`;
                }
            } else {
                alert('Error updating module: ' + (data.message || 'Unknown error'));
                checkbox.checked = !checkbox.checked;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Network error while toggling module.');
            checkbox.checked = !checkbox.checked;
        });
    }
</script>
<?= $this->endSection() ?>
