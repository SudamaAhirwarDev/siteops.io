<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'Master Control Plane — SiteOps Admin') ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'], 
                        mono: ['"JetBrains Mono"', 'monospace'] 
                    },
                    colors: {
                        brand: { 50: '#eef2ff', 100: '#e0e7ff', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca' },
                    },
                    boxShadow: {
                        'soft-xs': '0 1px 2px 0 rgba(0, 0, 0, 0.2)',
                        'soft-md': '0 4px 16px -2px rgba(0, 0, 0, 0.4)',
                        'soft-lg': '0 10px 25px -4px rgba(0, 0, 0, 0.5)',
                        'glow-indigo': '0 0 25px -3px rgba(99, 102, 241, 0.3)',
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 7px; height: 7px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Ambient High-Tech Atmosphere -->
    <div class="fixed -top-40 -left-40 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Top Admin Command Navigation -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-900/90 border-b border-slate-800 shadow-soft-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            <!-- Brand & Status -->
            <div class="flex items-center gap-3 sm:gap-6 min-w-0">
                <a href="<?= site_url('admin') ?>" class="flex items-center gap-2.5 group shrink-0">
                    <div class="relative w-8 h-8 sm:w-9 sm:h-9 transition-transform group-hover:scale-105 shrink-0">
                        <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_0_12px_rgba(99,102,241,0.5)]">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-base sm:text-lg font-extrabold tracking-tight text-white">SiteOps<span class="text-indigo-400">.</span></span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-indigo-950 border border-indigo-700/60 text-indigo-300 uppercase font-bold tracking-wider">
                            Master Admin
                        </span>
                    </div>
                </a>

                <!-- Quick Navigation Anchor Links (Desktop) -->
                <nav class="hidden xl:flex items-center gap-1 text-xs font-semibold">
                    <a href="#stats" class="px-2.5 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Overview</a>
                    <a href="#traffic" class="px-2.5 py-1.5 rounded-lg text-emerald-400 font-bold hover:text-white hover:bg-slate-800 transition-colors">🔥 Domain Visits (<?= $visitorSummary['total_visits'] ?>)</a>
                    <a href="#queries" class="px-2.5 py-1.5 rounded-lg text-indigo-400 font-bold hover:text-white hover:bg-slate-800 transition-colors">⚡ Queries (<?= $querySummary['total_queries'] ?>)</a>
                    <a href="#users" class="px-2.5 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Users (<?= count($users) ?>)</a>
                    <a href="#sites" class="px-2.5 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Domains (<?= count($sites) ?>)</a>
                    <a href="#reviews" class="px-2.5 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Reviews (<?= count($reviews) ?>)</a>
                    <a href="#scanner" class="px-2.5 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-colors">Live Scanner</a>
                </nav>
            </div>

            <!-- Server Telemetry Badges & Admin Actions -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <div class="hidden md:flex items-center gap-2 px-2.5 py-1 rounded-lg bg-slate-950 border border-slate-800 text-[11px] font-mono text-slate-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>PHP <?= esc($telemetry['php_version']) ?></span>
                    <span class="text-slate-600">&bull;</span>
                    <span><?= esc($telemetry['db_driver']) ?></span>
                    <span class="text-slate-600">&bull;</span>
                    <span><?= esc($telemetry['memory_current']) ?></span>
                </div>

                <a href="<?= site_url('dashboard') ?>" target="_blank" class="text-xs font-semibold text-slate-300 hover:text-white px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 border border-slate-700 transition-colors inline-flex items-center gap-1.5">
                    <span>User Dashboard</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <a href="<?= site_url('admin/logout') ?>" title="Admin Sign Out" class="p-2 rounded-xl bg-slate-800 hover:bg-rose-950/80 text-slate-400 hover:text-rose-400 border border-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Admin Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">

        <!-- Flash Notifications -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="p-3.5 rounded-xl bg-emerald-950/80 border border-emerald-700/60 text-emerald-200 text-xs sm:text-sm flex items-center justify-between shadow-soft-xs">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-300 text-xs font-bold px-2 py-0.5">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="p-3.5 rounded-xl bg-rose-950/80 border border-rose-700/60 text-rose-200 text-xs sm:text-sm flex items-center justify-between shadow-soft-xs">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-300 text-xs font-bold px-2 py-0.5">&times;</button>
            </div>
        <?php endif; ?>

        <!-- SECTION: Dynamic Overview & Telemetry Metrics -->
        <section id="stats" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
            <!-- Metric 1: Total Visits -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Total Visits</span>
                    <span class="text-emerald-400">🔥</span>
                </div>
                <div class="mt-2 text-2xl font-black text-emerald-400 font-mono"><?= number_format($visitorSummary['total_visits']) ?></div>
                <div class="mt-1 flex items-center gap-2 text-[11px] text-slate-400">
                    <span class="text-white font-semibold"><?= $visitorSummary['unique_visitors'] ?> Unique IPs</span>
                    <span>&bull;</span>
                    <span class="text-emerald-400">+<?= $visitorSummary['today_visits'] ?> Today</span>
                </div>
            </div>

            <!-- Metric 2: Total Queries -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Scans &amp; Queries</span>
                    <span class="text-indigo-400">⚡</span>
                </div>
                <div class="mt-2 text-2xl font-black text-indigo-400 font-mono"><?= number_format($querySummary['total_queries']) ?></div>
                <div class="mt-1 text-[11px] text-slate-400">+<?= $querySummary['today_queries'] ?> Queries Today</div>
            </div>

            <!-- Metric 3: Total Users -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Registered Users</span>
                    <span class="text-indigo-400">👥</span>
                </div>
                <div class="mt-2 text-2xl font-black text-white font-mono"><?= number_format($totalUsers) ?></div>
                <div class="mt-1 flex items-center gap-2 text-[11px] text-slate-400">
                    <span class="text-emerald-400 font-semibold"><?= $proUsers ?> Pro</span>
                    <span>&bull;</span>
                    <span class="text-amber-400"><?= $trialUsers ?> Trial</span>
                </div>
            </div>

            <!-- Metric 4: Connected Domains -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Monitored Domains</span>
                    <span class="text-indigo-400">🌐</span>
                </div>
                <div class="mt-2 text-2xl font-black text-white font-mono"><?= number_format($totalSites) ?></div>
                <div class="mt-1 text-[11px] text-slate-400">Active &lt;15KB Loaders</div>
            </div>

            <!-- Metric 5: Customer Reviews -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Customer Reviews</span>
                    <span class="text-amber-400">★</span>
                </div>
                <div class="mt-2 text-2xl font-black text-white font-mono"><?= number_format($totalReviews) ?></div>
                <div class="mt-1 text-[11px] text-emerald-400 font-semibold"><?= $activeReviews ?> Published Live</div>
            </div>

            <!-- Metric 6: Stripe Dunning Recovered -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-soft-xs">
                <div class="flex items-center justify-between text-xs text-slate-400 font-medium">
                    <span>Stripe Recovery</span>
                    <span class="text-emerald-400">💰</span>
                </div>
                <div class="mt-2 text-2xl font-black text-emerald-400 font-mono">$<?= number_format($totalRecovered, 0) ?></div>
                <div class="mt-1 text-[11px] text-slate-400">Saved Revenue</div>
            </div>
        </section>

        <!-- ======================================================================== -->
        <!-- SECTION 1: VISITOR TRAFFIC & DOMAIN ACCESS LOGS                          -->
        <!-- ======================================================================== -->
        <section id="traffic" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>🔥 Visitor Traffic &amp; Domain Analytics</span>
                        <span class="text-xs font-mono px-2.5 py-0.5 rounded-full bg-emerald-950 text-emerald-300 border border-emerald-700/60 font-semibold">Live Traffic Logs</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">Check kitne log aaye, kis specific domain ke liye aaye, unka device, IP address, visited URL, aur referrer.</p>
                </div>

                <!-- Domain Filter & Search Bar -->
                <form method="GET" action="<?= site_url('admin#traffic') ?>" class="flex items-center gap-2 flex-wrap">
                    <select name="domain" onchange="this.form.submit()" class="bg-slate-950 border border-slate-700 text-slate-200 rounded-xl px-3 py-1.5 text-xs font-mono focus:outline-none focus:border-indigo-500">
                        <option value="">All Target Domains (<?= count($domainStats) ?>)</option>
                        <?php foreach ($domainStats as $ds): ?>
                            <option value="<?= esc($ds['domain']) ?>" <?= ($domainFilter === $ds['domain']) ? 'selected' : '' ?>>
                                <?= esc($ds['domain']) ?> (<?= $ds['total_hits'] ?> hits)
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="text" name="visit_search" value="<?= esc($visitSearch) ?>" placeholder="Search IP, URL, or Referrer..."
                           class="bg-slate-950 border border-slate-700 text-slate-200 rounded-xl px-3 py-1.5 text-xs placeholder-slate-500 focus:outline-none focus:border-indigo-500 w-44 font-mono">

                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-semibold transition-colors">
                        Filter
                    </button>
                    <?php if ($domainFilter !== '' || $visitSearch !== ''): ?>
                        <a href="<?= site_url('admin#traffic') ?>" class="text-xs text-rose-400 hover:underline px-1">Clear</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Domain-Specific Aggregate Traffic Breakdown Cards -->
            <div>
                <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-slate-400 block mb-3">Domain-Wise Traffic Breakdown</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    <?php if (empty($domainStats)): ?>
                        <div class="col-span-full py-4 text-center text-xs text-slate-500">No domain traffic recorded yet.</div>
                    <?php else: ?>
                        <?php foreach ($domainStats as $ds): ?>
                            <a href="<?= site_url('admin?domain=' . urlencode($ds['domain']) . '#traffic') ?>" class="p-3.5 rounded-2xl bg-slate-950 border <?= ($domainFilter === $ds['domain']) ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-800 hover:border-slate-700' ?> transition-all block group">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="font-bold text-white group-hover:text-emerald-400 transition-colors font-mono truncate max-w-[150px]">
                                        <?= esc($ds['domain']) ?>
                                    </div>
                                    <span class="px-2 py-0.5 rounded bg-emerald-950/80 border border-emerald-700/60 text-emerald-300 font-mono font-bold text-[10px]">
                                        <?= number_format($ds['total_hits']) ?> hits
                                    </span>
                                </div>
                                <div class="mt-2.5 flex items-center justify-between text-[11px] text-slate-400">
                                    <span><?= $ds['unique_ips'] ?> Unique Visitors</span>
                                    <span class="text-[10px] text-slate-500 font-mono"><?= date('H:i, M d', strtotime($ds['last_seen'])) ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Detailed Real-Time Access Logs Table -->
            <div class="pt-4 border-t border-slate-800">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-slate-400">
                        Real-Time Visitor Log Entries <?= $domainFilter ? "for [" . esc($domainFilter) . "]" : '' ?> (<?= count($recentVisits) ?> Shown)
                    </span>
                    <span class="text-[11px] text-slate-500 font-mono">Updated Real-Time</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-300">
                        <thead class="text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-800 bg-slate-950/60 font-mono">
                            <tr>
                                <th class="py-2.5 px-3">Visited Time</th>
                                <th class="py-2.5 px-3">Target Domain</th>
                                <th class="py-2.5 px-3">Visited Endpoint / Path</th>
                                <th class="py-2.5 px-3">Visitor IP</th>
                                <th class="py-2.5 px-3">Device &amp; Browser</th>
                                <th class="py-2.5 px-3">Referrer Source</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80 font-mono text-[11px]">
                            <?php if (empty($recentVisits)): ?>
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-slate-500 font-sans">No visitor logs found matching your filter.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recentVisits as $v): ?>
                                    <tr class="hover:bg-slate-800/40 transition-colors">
                                        <td class="py-2.5 px-3 text-slate-400 whitespace-nowrap">
                                            <?= date('M d, H:i:s', strtotime($v['visited_at'])) ?>
                                        </td>
                                        <td class="py-2.5 px-3 font-bold text-white">
                                            <span class="px-2 py-0.5 rounded bg-indigo-950/80 border border-indigo-700/50 text-indigo-300 text-[10px]">
                                                <?= esc($v['domain']) ?>
                                            </span>
                                        </td>
                                        <td class="py-2.5 px-3 text-slate-200 truncate max-w-xs" title="<?= esc($v['page_url']) ?>">
                                            <span class="text-emerald-400 font-bold"><?= esc($v['page_url']) ?></span>
                                        </td>
                                        <td class="py-2.5 px-3 text-indigo-300">
                                            <?= esc($v['ip_address']) ?>
                                        </td>
                                        <td class="py-2.5 px-3">
                                            <?php 
                                                $devIcon = match($v['device_type'] ?? 'desktop') {
                                                    'mobile' => '📱 Mobile',
                                                    'tablet' => '📟 Tablet',
                                                    'bot'    => '🤖 Bot',
                                                    default  => '💻 Desktop',
                                                };
                                            ?>
                                            <span class="px-1.5 py-0.5 rounded bg-slate-800 text-slate-300 text-[10px]"><?= $devIcon ?></span>
                                        </td>
                                        <td class="py-2.5 px-3 text-slate-400 truncate max-w-[180px]" title="<?= esc($v['referrer'] ?? 'Direct') ?>">
                                            <?= esc($v['referrer'] ? parse_url($v['referrer'], PHP_URL_HOST) ?? $v['referrer'] : 'Direct Entry') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ======================================================================== -->
        <!-- SECTION 2: SEARCH & DIAGNOSTIC SCAN QUERY LOGS                           -->
        <!-- ======================================================================== -->
        <section id="queries" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>⚡ Diagnostic &amp; Search Queries Log</span>
                        <span class="text-xs font-mono px-2.5 py-0.5 rounded-full bg-indigo-950 text-indigo-300 border border-indigo-700/60 font-semibold"><?= count($recentQueries) ?> Scans Logged</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">Jab bhi koi website ko analyze karta hai ya diagnostic query run karta hai, unke search queries, scores aur IP yahan store hote hain.</p>
                </div>

                <form method="GET" action="<?= site_url('admin#queries') ?>" class="flex items-center gap-2">
                    <input type="text" name="query_search" value="<?= esc($querySearch) ?>" placeholder="Search queried domain or IP..."
                           class="bg-slate-950 border border-slate-700 text-slate-200 rounded-xl px-3 py-1.5 text-xs placeholder-slate-500 focus:outline-none focus:border-indigo-500 w-52 font-mono">
                    <button type="submit" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-semibold transition-colors">Search</button>
                    <?php if ($querySearch !== ''): ?>
                        <a href="<?= site_url('admin#queries') ?>" class="text-xs text-rose-400 hover:underline px-1">Clear</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Top Queried Target Domains -->
            <?php if (!empty($querySummary['top_queried'])): ?>
                <div>
                    <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-slate-400 block mb-2">Most Queried Target Websites</span>
                    <div class="flex items-center gap-2 flex-wrap">
                        <?php foreach ($querySummary['top_queried'] as $tq): ?>
                            <div class="px-3 py-1.5 rounded-xl bg-slate-950 border border-slate-800 text-xs font-mono flex items-center gap-2">
                                <span class="font-bold text-white"><?= esc($tq['target_domain']) ?></span>
                                <span class="px-1.5 py-0.5 rounded bg-indigo-950 text-indigo-300 font-bold text-[10px]"><?= $tq['count'] ?>x</span>
                                <?php if ($tq['avg_seo']): ?>
                                    <span class="text-emerald-400 text-[10px]"><?= round($tq['avg_seo']) ?>% SEO</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Recent Diagnostic Queries Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-800 bg-slate-950/60 font-mono">
                        <tr>
                            <th class="py-2.5 px-3">Queried At</th>
                            <th class="py-2.5 px-3">Target Domain</th>
                            <th class="py-2.5 px-3">Query Type</th>
                            <th class="py-2.5 px-3">SEO Score</th>
                            <th class="py-2.5 px-3">Security Score</th>
                            <th class="py-2.5 px-3">Caller IP</th>
                            <th class="py-2.5 px-3 text-right">Quick Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 font-mono text-[11px]">
                        <?php if (empty($recentQueries)): ?>
                            <tr>
                                <td colspan="7" class="py-6 text-center text-slate-500 font-sans">No diagnostic queries recorded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentQueries as $q): ?>
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="py-2.5 px-3 text-slate-400 whitespace-nowrap">
                                        <?= date('M d, H:i:s', strtotime($q['queried_at'])) ?>
                                    </td>
                                    <td class="py-2.5 px-3 font-bold text-white">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            <span><?= esc($q['target_domain']) ?></span>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <span class="px-2 py-0.5 rounded bg-slate-800 text-slate-300 text-[10px] uppercase font-bold">
                                            <?= esc($q['query_type']) ?>
                                        </span>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <?php if ($q['score_seo']): ?>
                                            <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-700/60 font-bold text-[10px]">
                                                <?= $q['score_seo'] ?> / 100
                                            </span>
                                        <?php else: ?>
                                            <span class="text-slate-600">&mdash;</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <?php if ($q['score_security']): ?>
                                            <span class="px-2 py-0.5 rounded bg-indigo-950 text-indigo-300 border border-indigo-700/60 font-bold text-[10px]">
                                                <?= $q['score_security'] ?> / 100
                                            </span>
                                        <?php else: ?>
                                            <span class="text-slate-600">&mdash;</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2.5 px-3 text-slate-400">
                                        <?= esc($q['ip_address']) ?>
                                    </td>
                                    <td class="py-2.5 px-3 text-right">
                                        <form action="<?= site_url('admin/system/quick-scan') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="url" value="<?= esc($q['target_domain']) ?>">
                                            <button type="submit" class="px-2 py-1 rounded bg-slate-800 hover:bg-indigo-600 text-slate-300 hover:text-white text-[10px] font-bold transition-colors">
                                                Re-Scan &rarr;
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- SECTION: Dynamic User Management -->
        <section id="users" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>👥 Dynamic User &amp; Tenant Management</span>
                        <span class="text-xs font-mono px-2 py-0.5 rounded-full bg-indigo-950 text-indigo-300 border border-indigo-700/60 font-semibold"><?= count($users) ?> Total</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">Manage accounts, upgrade plans (Trial, Pro, Enterprise), and perform 1-click user impersonation.</p>
                </div>

                <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                    <!-- Search Filter Form -->
                    <form method="GET" action="<?= site_url('admin#users') ?>" class="flex items-center gap-1.5">
                        <input type="text" name="user_search" value="<?= esc($searchQuery) ?>" placeholder="Search name or email..."
                               class="bg-slate-950 border border-slate-700 text-slate-200 rounded-xl px-3 py-1.5 text-xs placeholder-slate-500 focus:outline-none focus:border-indigo-500 w-44 sm:w-56 font-mono">
                        <button type="submit" class="px-2.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl text-xs font-semibold transition-colors">Search</button>
                        <?php if ($searchQuery !== ''): ?>
                            <a href="<?= site_url('admin#users') ?>" class="text-xs text-rose-400 hover:underline px-1">Reset</a>
                        <?php endif; ?>
                    </form>

                    <!-- Add User Toggle Modal Button -->
                    <button type="button" onclick="document.getElementById('add-user-modal').classList.toggle('hidden')" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-bold transition-all shadow-soft-xs flex items-center gap-1">
                        <span>+ Add User</span>
                    </button>
                </div>
            </div>

            <!-- Add User Inline Form (Collapsible) -->
            <div id="add-user-modal" class="hidden my-4 p-4 rounded-2xl bg-slate-950 border border-indigo-900/60 shadow-inner">
                <form action="<?= site_url('admin/user/create') ?>" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 items-end">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-400 mb-1">Full Name</label>
                        <input type="text" name="name" required placeholder="Nitin Mandle" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-400 mb-1">Email Address</label>
                        <input type="email" name="email" required placeholder="nitin@company.com" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-white font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-400 mb-1">Password</label>
                        <input type="password" name="password" required value="password123" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-1.5 text-xs text-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-400 mb-1">Plan &amp; Role</label>
                        <select name="plan_type" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-2 py-1.5 text-xs text-white font-mono">
                            <option value="trial">15-Day Free Trial</option>
                            <option value="pro" selected>Pro ($29/mo)</option>
                            <option value="enterprise">Enterprise ($99/mo)</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 py-1.5 px-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition-all">Save User</button>
                        <button type="button" onclick="document.getElementById('add-user-modal').classList.add('hidden')" class="py-1.5 px-3 bg-slate-800 text-slate-400 rounded-xl text-xs font-semibold">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Users Table -->
            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-800 bg-slate-950/60 font-mono">
                        <tr>
                            <th class="py-3 px-3">User</th>
                            <th class="py-3 px-3">Plan Status</th>
                            <th class="py-3 px-3">Role</th>
                            <th class="py-3 px-3">Sites</th>
                            <th class="py-3 px-3">Registered</th>
                            <th class="py-3 px-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="py-6 text-center text-slate-500">No users match your search criteria.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="py-3 px-3">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-indigo-900/60 border border-indigo-700/50 flex items-center justify-center text-indigo-300 font-bold text-xs uppercase">
                                                <?= esc(substr($u['name'], 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="font-bold text-white"><?= esc($u['name']) ?></div>
                                                <div class="text-[11px] text-slate-400 font-mono"><?= esc($u['email']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3">
                                        <!-- Dynamic Plan Change Dropdown Form -->
                                        <form action="<?= site_url('admin/user/update-plan') ?>" method="POST" class="inline-flex items-center gap-1.5">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                            <input type="hidden" name="role" value="<?= esc($u['role'] ?? 'user') ?>">
                                            <?php 
                                                $pt = strtolower($u['plan_type'] ?? 'trial');
                                                $badgeColor = match($pt) {
                                                    'enterprise' => 'bg-purple-950 text-purple-300 border-purple-700',
                                                    'pro', 'agency' => 'bg-emerald-950 text-emerald-300 border-emerald-700',
                                                    'expired' => 'bg-rose-950 text-rose-300 border-rose-700',
                                                    default => 'bg-amber-950 text-amber-300 border-amber-700',
                                                };
                                            ?>
                                            <select name="plan_type" onchange="this.form.submit()" class="text-[11px] font-mono font-semibold rounded-lg px-2 py-1 border bg-slate-950 <?= $badgeColor ?> focus:outline-none cursor-pointer">
                                                <option value="trial" <?= $pt === 'trial' ? 'selected' : '' ?>>15D TRIAL</option>
                                                <option value="pro" <?= $pt === 'pro' ? 'selected' : '' ?>>PRO ($29)</option>
                                                <option value="enterprise" <?= $pt === 'enterprise' ? 'selected' : '' ?>>ENTERPRISE ($99)</option>
                                                <option value="expired" <?= $pt === 'expired' ? 'selected' : '' ?>>EXPIRED</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="py-3 px-3">
                                        <form action="<?= site_url('admin/user/update-plan') ?>" method="POST" class="inline-flex items-center gap-1">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                            <input type="hidden" name="plan_type" value="<?= esc($u['plan_type']) ?>">
                                            <select name="role" onchange="this.form.submit()" class="text-[10px] font-mono rounded px-1.5 py-0.5 border bg-slate-950 <?= ($u['role'] ?? 'user') === 'admin' ? 'border-indigo-500 text-indigo-300 font-bold' : 'border-slate-700 text-slate-400' ?>">
                                                <option value="user" <?= ($u['role'] ?? 'user') === 'user' ? 'selected' : '' ?>>USER</option>
                                                <option value="admin" <?= ($u['role'] ?? 'user') === 'admin' ? 'selected' : '' ?>>ADMIN</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="py-3 px-3 font-mono">
                                        <span class="px-2 py-0.5 rounded bg-slate-800 text-slate-300 text-[11px]">
                                            <?= $siteCounts[$u['id']] ?? 0 ?>
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 text-[11px] text-slate-400 font-mono">
                                        <?= date('M d, Y', strtotime($u['created_at'] ?? 'now')) ?>
                                    </td>
                                    <td class="py-3 px-3 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- 1-Click Impersonate Button -->
                                            <a href="<?= site_url('admin/user/impersonate/' . $u['id']) ?>" title="Login As this user" class="px-2.5 py-1 bg-indigo-950/80 hover:bg-indigo-900 border border-indigo-700/60 text-indigo-300 rounded-lg text-[11px] font-semibold transition-colors flex items-center gap-1">
                                                <span>⚡ View Dashboard</span>
                                            </a>

                                            <!-- Delete User Button (not allowed for Master Admin) -->
                                            <?php if ($u['email'] !== 'admin@siteops.io'): ?>
                                                <form action="<?= site_url('admin/user/delete/' . $u['id']) ?>" method="POST" onsubmit="return confirm('Permanently delete <?= esc($u['email']) ?> and all their sites?');">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1 rounded-lg text-slate-500 hover:text-rose-400 hover:bg-rose-950/50 transition-colors" title="Delete User">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- SECTION: Dynamic Sites & Module Management -->
        <section id="sites" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>🌐 Dynamic Sites &amp; Module Toggles</span>
                        <span class="text-xs font-mono px-2 py-0.5 rounded-full bg-indigo-950 text-indigo-300 border border-indigo-700/60 font-semibold"><?= count($sites) ?> Sites</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">Directly toggle WCAG Accessibility, Social Proof, AI SEO &amp; Stripe Dunning for any customer domain in real-time.</p>
                </div>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-800 bg-slate-950/60 font-mono">
                        <tr>
                            <th class="py-3 px-3">Domain</th>
                            <th class="py-3 px-3">Site Key</th>
                            <th class="py-3 px-3">Owner</th>
                            <th class="py-3 px-3 text-center">Accessibility</th>
                            <th class="py-3 px-3 text-center">Reviews</th>
                            <th class="py-3 px-3 text-center">SEO / GEO</th>
                            <th class="py-3 px-3 text-center">Dunning</th>
                            <th class="py-3 px-3 text-right">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        <?php if (empty($sites)): ?>
                            <tr>
                                <td colspan="8" class="py-6 text-center text-slate-500">No domains have been registered yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($sites as $s): ?>
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="py-3 px-3 font-semibold text-white">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                            <span><?= esc($s['domain']) ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 font-mono text-[11px] text-indigo-400">
                                        <?= esc($s['site_key']) ?>
                                    </td>
                                    <td class="py-3 px-3 text-[11px] text-slate-400 font-mono">
                                        <?= esc($s['owner_email'] ?? 'Unknown') ?>
                                    </td>
                                    
                                    <!-- Dynamic Module Toggles -->
                                    <td class="py-3 px-3 text-center">
                                        <form action="<?= site_url('admin/site/toggle-module') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="site_id" value="<?= $s['id'] ?>">
                                            <input type="hidden" name="module" value="accessibility">
                                            <button type="submit" class="px-2 py-0.5 rounded text-[10px] font-bold font-mono transition-colors <?= (int)$s['module_accessibility'] === 1 ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-500' ?>">
                                                <?= (int)$s['module_accessibility'] === 1 ? 'ON' : 'OFF' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <form action="<?= site_url('admin/site/toggle-module') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="site_id" value="<?= $s['id'] ?>">
                                            <input type="hidden" name="module" value="reviews">
                                            <button type="submit" class="px-2 py-0.5 rounded text-[10px] font-bold font-mono transition-colors <?= (int)$s['module_reviews'] === 1 ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-500' ?>">
                                                <?= (int)$s['module_reviews'] === 1 ? 'ON' : 'OFF' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <form action="<?= site_url('admin/site/toggle-module') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="site_id" value="<?= $s['id'] ?>">
                                            <input type="hidden" name="module" value="seo">
                                            <button type="submit" class="px-2 py-0.5 rounded text-[10px] font-bold font-mono transition-colors <?= (int)$s['module_seo'] === 1 ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-500' ?>">
                                                <?= (int)$s['module_seo'] === 1 ? 'ON' : 'OFF' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <form action="<?= site_url('admin/site/toggle-module') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="site_id" value="<?= $s['id'] ?>">
                                            <input type="hidden" name="module" value="dunning">
                                            <button type="submit" class="px-2 py-0.5 rounded text-[10px] font-bold font-mono transition-colors <?= (int)$s['module_dunning'] === 1 ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-500' ?>">
                                                <?= (int)$s['module_dunning'] === 1 ? 'ON' : 'OFF' ?>
                                            </button>
                                        </form>
                                    </td>

                                    <td class="py-3 px-3 text-right">
                                        <form action="<?= site_url('admin/site/delete/' . $s['id']) ?>" method="POST" onsubmit="return confirm('Delete <?= esc($s['domain']) ?>?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-1 text-slate-500 hover:text-rose-400 hover:bg-rose-950/50 rounded transition-colors" title="Delete Domain">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- SECTION: Dynamic Customer Reviews Moderation -->
        <section id="reviews" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>★ Global Review Moderation</span>
                        <span class="text-xs font-mono px-2 py-0.5 rounded-full bg-amber-950 text-amber-300 border border-amber-700/60 font-semibold"><?= count($reviews) ?> Reviews</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">Approve, mute, or remove testimonials across all registered customer sites.</p>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <?php if (empty($reviews)): ?>
                    <div class="col-span-full py-6 text-center text-slate-500 text-xs">No reviews have been created yet.</div>
                <?php else: ?>
                    <?php foreach ($reviews as $rev): ?>
                        <div class="bg-slate-950 border <?= (int)$rev['is_active'] === 1 ? 'border-slate-800' : 'border-rose-900/50 opacity-75' ?> rounded-2xl p-4 flex flex-col justify-between gap-3">
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-2">
                                    <div class="flex items-center gap-1 text-amber-400 text-xs">
                                        <?php for ($i=0; $i<(int)$rev['rating']; $i++): ?>★<?php endfor; ?>
                                    </div>
                                    <span class="text-[10px] font-mono uppercase px-2 py-0.5 rounded bg-slate-800 text-slate-300 font-bold"><?= esc($rev['source']) ?></span>
                                </div>
                                <p class="text-xs text-slate-300 italic line-clamp-3">"<?= esc($rev['review_text']) ?>"</p>
                            </div>

                            <div class="pt-3 border-t border-slate-900 flex items-center justify-between gap-2">
                                <div>
                                    <div class="text-xs font-bold text-white"><?= esc($rev['reviewer_name']) ?></div>
                                    <div class="text-[10px] text-slate-400"><?= esc($rev['role_or_company'] ?? '') ?> &bull; <span class="text-indigo-400 font-mono"><?= esc($rev['domain'] ?? 'Domain') ?></span></div>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <a href="<?= site_url('admin/review/toggle/' . $rev['id']) ?>" class="px-2 py-1 rounded-lg text-[10px] font-bold font-mono transition-colors <?= (int)$rev['is_active'] === 1 ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-400' ?>">
                                        <?= (int)$rev['is_active'] === 1 ? 'ACTIVE' : 'MUTED' ?>
                                    </a>
                                    <form action="<?= site_url('admin/review/delete/' . $rev['id']) ?>" method="POST" onsubmit="return confirm('Delete review?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1 text-slate-500 hover:text-rose-400 rounded transition-colors">&times;</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- SECTION: Live Diagnostic & Security Scanner Console -->
        <section id="scanner" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md">
            <div class="pb-5 border-b border-slate-800">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span>🛡️ Live Master Diagnostic &amp; Security Scanner</span>
                    <span class="text-xs font-mono px-2 py-0.5 rounded-full bg-emerald-950 text-emerald-300 border border-emerald-700/60 font-semibold">Real-Time</span>
                </h2>
                <p class="text-xs text-slate-400 mt-1">Run an instant comprehensive audit on any target website: Cyber Security, Malware/Threats, SEO &amp; Keywords, and Code Bugs.</p>
            </div>

            <!-- Scanner Form -->
            <form action="<?= site_url('admin/system/quick-scan') ?>" method="POST" class="mt-4 flex flex-col sm:flex-row gap-2.5">
                <?= csrf_field() ?>
                <div class="relative flex-1">
                    <input type="text" name="url" value="<?= esc(session()->getFlashdata('scan_url') ?? 'https://stripe.com') ?>" placeholder="Enter any URL (e.g. https://example.com)..." required
                           class="w-full bg-slate-950 border border-slate-700 text-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm font-mono placeholder-slate-500 focus:outline-none focus:border-indigo-500">
                </div>
                <button type="submit" class="py-2.5 px-6 rounded-xl text-xs sm:text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-500 transition-colors flex items-center justify-center gap-2 shrink-0">
                    <span>⚡ Run Master Diagnostic</span>
                </button>
            </form>

            <!-- Results View if Flash Result Exists -->
            <?php if (session()->getFlashdata('scan_result')): ?>
                <?php $res = session()->getFlashdata('scan_result'); ?>
                <div class="mt-5 p-4 rounded-2xl bg-slate-950 border border-slate-800">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800 text-xs">
                        <span class="font-bold text-white font-mono"><?= esc(session()->getFlashdata('scan_url')) ?></span>
                        <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 font-mono font-bold text-[10px]">ANALYSIS SUCCESS</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-3">
                        <div class="bg-slate-900 p-3 rounded-xl border border-slate-800">
                            <span class="text-[10px] text-slate-400 uppercase font-mono block">Security Score</span>
                            <span class="text-xl font-bold font-mono text-emerald-400"><?= $res['security']['score'] ?? 95 ?> / 100</span>
                        </div>
                        <div class="bg-slate-900 p-3 rounded-xl border border-slate-800">
                            <span class="text-[10px] text-slate-400 uppercase font-mono block">SEO Score</span>
                            <span class="text-xl font-bold font-mono text-indigo-400"><?= $res['seo']['score'] ?? 88 ?> / 100</span>
                        </div>
                        <div class="bg-slate-900 p-3 rounded-xl border border-slate-800">
                            <span class="text-[10px] text-slate-400 uppercase font-mono block">Detected Threats</span>
                            <span class="text-xl font-bold font-mono text-emerald-400"><?= count($res['security']['threats'] ?? []) ?> Detected</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <!-- SECTION: Telemetry & Platform Specifications -->
        <section id="telemetry" class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-soft-md">
            <div class="pb-4 border-b border-slate-800">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <span>⚙️ Server &amp; Environment Telemetry</span>
                </h2>
            </div>

            <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 text-xs font-mono">
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">PHP Engine</span>
                    <span class="text-white font-bold"><?= esc($telemetry['php_version']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">Framework</span>
                    <span class="text-white font-bold">CodeIgniter <?= esc($telemetry['ci_version']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">Database Driver</span>
                    <span class="text-white font-bold"><?= esc($telemetry['db_driver']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">Memory Peak</span>
                    <span class="text-white font-bold"><?= esc($telemetry['memory_peak']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">Operating System</span>
                    <span class="text-white font-bold"><?= esc($telemetry['os']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 text-[10px] uppercase block">Environment</span>
                    <span class="text-white font-bold"><?= esc($telemetry['environment']) ?></span>
                </div>
                <div class="bg-slate-950 p-3 rounded-xl border border-slate-800 col-span-2">
                    <span class="text-slate-500 text-[10px] uppercase block">Server Timestamp</span>
                    <span class="text-white font-bold"><?= esc($telemetry['server_time']) ?></span>
                </div>
            </div>
        </section>

    </main>

    <!-- Admin Footer -->
    <footer class="border-t border-slate-900 bg-slate-950/80 py-4 mt-12 text-center text-xs text-slate-500 font-mono">
        <span>SiteOps Master Control Plane &bull; Real-Time Visitor Logs &bull; Domain-Wise Telemetry &bull; Search &amp; Scan Queries</span>
    </footer>

</body>
</html>
