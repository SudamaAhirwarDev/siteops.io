<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="space-y-8">

    <!-- Header & Domain Selector -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest bg-indigo-50 px-2.5 py-0.5 rounded-full border border-indigo-100">
                    Module 03
                </span>
                <span class="text-xs font-bold text-slate-500">Generative Engine Optimization (GEO)</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">AI SEO &amp; GEO Page Auditor</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Test any URL for technical SEO and LLM citation readiness across ChatGPT Search, Perplexity AI, and Google Gemini.
            </p>
        </div>

        <!-- Site Switcher Dropdown -->
        <div class="flex items-center gap-2">
            <label for="site-select" class="text-xs text-slate-600 font-semibold">Active Domain:</label>
            <select id="site-select" onchange="window.location.href='<?= site_url('modules/seo/') ?>' + this.value"
                    class="bg-white border border-slate-300 text-slate-900 text-xs rounded-xl px-3 py-2 font-mono shadow-soft-xs focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
                <?php foreach ($sites as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $selected_site['id'] ? 'selected' : '' ?>>
                        <?= esc($s['domain']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Audit URL Input Bar -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm relative">
        <?php 
            $isTrialCapped = isset($trial_status) && $trial_status['plan_type'] === 'trial' && $trial_status['used_today'] >= $trial_status['limit'];
            $isTrialExpired = isset($trial_status) && $trial_status['is_expired'];
            $isBlocked = $isTrialCapped || $isTrialExpired;
        ?>

        <?php if ($isTrialExpired): ?>
            <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-rose-600 text-lg">🔒</span>
                    <div>
                        <h4 class="text-xs font-bold text-rose-900">15-Day Free Trial Expired</h4>
                        <p class="text-[11px] text-rose-700">Upgrade to Pro ($39/mo) to unlock unlimited AI SEO &amp; GEO crawler tasks.</p>
                    </div>
                </div>
                <a href="<?= site_url('dashboard') ?>" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-500 transition-colors whitespace-nowrap shadow-soft-xs">
                    Upgrade to Pro &rarr;
                </a>
            </div>
        <?php elseif ($isTrialCapped): ?>
            <div class="mb-5 p-4 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-amber-600 text-lg">⚠️</span>
                    <div>
                        <h4 class="text-xs font-bold text-amber-900">Daily Quota Reached (5/5 Free Tasks Used Today)</h4>
                        <p class="text-[11px] text-amber-700">Your daily quota resets at midnight, or upgrade to Pro for unlimited instant runs.</p>
                    </div>
                </div>
                <a href="<?= site_url('dashboard') ?>" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-amber-600 hover:bg-amber-500 transition-colors whitespace-nowrap shadow-soft-xs">
                    Unlock Unlimited Tasks &rarr;
                </a>
            </div>
        <?php endif; ?>

        <h2 class="text-base font-bold text-slate-900 mb-1 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            Audit Any Webpage URL
        </h2>
        <p class="text-xs text-slate-500 mb-4">
            Our PHP scraper crawls the live DOM, validates meta structures, heading hierarchy, content depth, and generates actionable fixes.
        </p>

        <form action="<?= site_url('modules/seo/analyze') ?>" method="POST" id="audit-form" class="flex flex-col sm:flex-row gap-3">
            <?= csrf_field() ?>
            <input type="hidden" name="site_id" value="<?= esc($selected_site['id']) ?>">

            <div class="relative flex-1">
                <input type="url" id="page_url_input" name="page_url" 
                       value="<?= old('page_url', 'https://' . $selected_site['domain']) ?>" required
                       <?= $isBlocked ? 'disabled' : '' ?>
                       placeholder="https://yourdomain.com/blog/article-slug"
                       class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-4 py-2.5 text-xs sm:text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 font-mono transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>">
            </div>

            <?php if ($isBlocked): ?>
                <button type="button" disabled class="px-6 py-2.5 rounded-xl text-xs font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed flex items-center justify-center gap-2 whitespace-nowrap">
                    <span><?= $isTrialExpired ? '🔒 Trial Expired' : '🛑 Daily Limit Reached (5/5)' ?></span>
                </button>
            <?php else: ?>
                <button type="submit" id="btn-submit-audit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                    <span id="btn-audit-text">&#9889; Run Live AI &amp; SEO Audit</span>
                    <span id="btn-audit-spinner" class="hidden animate-spin">&#9696;</span>
                </button>
            <?php endif; ?>
        </form>

        <div class="mt-3 flex items-center gap-3 text-[11px] text-slate-400">
            <span>Quick test:</span>
            <button type="button" onclick="document.getElementById('page_url_input').value='https://news.ycombinator.com'" class="text-indigo-600 font-semibold hover:underline">Hacker News</button>
            <span>&bull;</span>
            <button type="button" onclick="document.getElementById('page_url_input').value='https://en.wikipedia.org/wiki/Search_engine_optimization'" class="text-indigo-600 font-semibold hover:underline">Wikipedia SEO</button>
        </div>
    </div>

    <!-- Active Audit Report (If Available) -->
    <?php if ($latestAudit): ?>
        <?php 
            $fixes = json_decode($latestAudit['recommendations_json'] ?? '[]', true) ?: [];
            $seoScore = (int) $latestAudit['seo_score'];
            $geoScore = (int) $latestAudit['geo_ai_score'];
        ?>
        <div class="space-y-6">
            <!-- Score Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Score 1: Technical SEO -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Technical SEO Score</span>
                            <span class="text-[10px] px-2.5 py-0.5 rounded-full font-bold uppercase <?= $seoScore >= 80 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($seoScore >= 50 ? 'bg-amber-50 text-amber-800 border border-amber-200' : 'bg-rose-50 text-rose-800 border border-rose-200') ?>">
                                <?= $seoScore >= 80 ? 'Optimal' : ($seoScore >= 50 ? 'Needs Work' : 'Critical') ?>
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Evaluates title, meta description, heading structure, canonicals &amp; alt tags.</p>
                        <p class="text-xs text-slate-400 mt-3 font-mono">Audited: <?= date('M d, Y H:i', strtotime($latestAudit['audited_at'])) ?></p>
                    </div>

                    <div class="w-22 h-22 sm:w-24 sm:h-24 rounded-full border-4 <?= $seoScore >= 80 ? 'border-emerald-500 bg-emerald-50/40 text-emerald-700' : ($seoScore >= 50 ? 'border-amber-500 bg-amber-50/40 text-amber-700' : 'border-rose-500 bg-rose-50/40 text-rose-700') ?> flex flex-col items-center justify-center shrink-0 shadow-soft-xs">
                        <span class="text-2xl font-black font-mono"><?= $seoScore ?></span>
                        <span class="text-[9px] uppercase font-bold text-slate-400">/ 100</span>
                    </div>
                </div>

                <!-- Score 2: Generative Engine Optimization (GEO) -->
                <div class="bg-white border border-indigo-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm flex items-center justify-between relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-50/70 rounded-full blur-2xl pointer-events-none"></div>

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-700">AI Search Readiness (GEO)</span>
                            <span class="text-[10px] px-2.5 py-0.5 rounded-full font-bold uppercase <?= $geoScore >= 80 ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : ($geoScore >= 50 ? 'bg-amber-50 text-amber-800 border border-amber-200' : 'bg-rose-50 text-rose-800 border border-rose-200') ?>">
                                <?= $geoScore >= 80 ? 'LLM Citable' : 'Low Visibility' ?>
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Perplexity AI, ChatGPT Search, Claude &amp; Gemini entity extraction index.</p>
                        <p class="text-[11px] text-slate-400 mt-3 font-mono truncate max-w-xs">URL: <?= esc($latestAudit['page_url']) ?></p>
                    </div>

                    <div class="w-22 h-22 sm:w-24 sm:h-24 rounded-full border-4 <?= $geoScore >= 80 ? 'border-indigo-600 bg-indigo-50/50 text-indigo-700' : 'border-amber-500 bg-amber-50/40 text-amber-700' ?> flex flex-col items-center justify-center shrink-0 shadow-soft-xs">
                        <span class="text-2xl font-black font-mono"><?= $geoScore ?></span>
                        <span class="text-[9px] uppercase font-bold text-slate-400">/ 100</span>
                    </div>
                </div>
            </div>

            <!-- Actionable Recommendations Checklist -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                        Actionable Diagnostic Checklist (<?= count($fixes) ?> Items Detected)
                    </h3>
                    <span class="text-xs text-slate-400">Live Scraper Output</span>
                </div>

                <div class="space-y-3">
                    <?php foreach ($fixes as $fix): ?>
                        <?php 
                            $severity = $fix['severity'] ?? 'pass';
                            $badgeColor = ($severity === 'pass') 
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                                : (($severity === 'warning') ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-rose-50 text-rose-800 border-rose-200');
                            $icon = ($severity === 'pass') ? '&#10003;' : (($severity === 'warning') ? '&#9888;' : '&#10005;');
                        ?>
                        <div class="p-4 rounded-2xl bg-slate-50/60 border border-slate-200/80 flex items-start gap-3 hover:bg-slate-50 transition-colors">
                            <span class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-bold shrink-0 border <?= $badgeColor ?>">
                                <?= $icon ?>
                            </span>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="text-xs font-bold text-slate-900"><?= esc($fix['title'] ?? '') ?></h4>
                                    <span class="text-[9px] uppercase font-bold px-2 py-0.5 rounded-full border <?= $badgeColor ?>">
                                        <?= esc($severity) ?>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                                    <?= esc($fix['description'] ?? '') ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Recent Audits Table -->
    <?php if (!empty($recent_audits)): ?>
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-4">
                Recent Audit History on <?= esc($selected_site['domain']) ?>
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="text-[11px] uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-2">
                        <tr>
                            <th class="py-2.5">Target URL</th>
                            <th class="py-2.5">SEO Score</th>
                            <th class="py-2.5">GEO AI Score</th>
                            <th class="py-2.5">Audited Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <?php foreach ($recent_audits as $audit): ?>
                            <tr>
                                <td class="py-3 font-mono text-indigo-600 font-medium truncate max-w-xs">
                                    <?= esc($audit['page_url']) ?>
                                </td>
                                <td class="py-3">
                                    <span class="font-mono font-bold <?= $audit['seo_score'] >= 80 ? 'text-emerald-600' : 'text-amber-600' ?>">
                                        <?= esc($audit['seo_score']) ?>/100
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="font-mono font-bold text-indigo-600">
                                        <?= esc($audit['geo_ai_score']) ?>/100
                                    </span>
                                </td>
                                <td class="py-3 text-slate-400 font-mono">
                                    <?= date('M d, Y H:i', strtotime($audit['audited_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</div>

<script>
    document.getElementById('audit-form').addEventListener('submit', function() {
        document.getElementById('btn-audit-text').innerText = 'Crawling & Analyzing...';
        document.getElementById('btn-audit-spinner').classList.remove('hidden');
        document.getElementById('btn-submit-audit').disabled = true;
    });
</script>
<?= $this->endSection() ?>
