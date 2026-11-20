<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="space-y-8">

    <!-- Header & Domain Selector -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-xs font-bold text-amber-800 uppercase tracking-widest bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                    Module 02
                </span>
                <span class="text-xs font-bold text-slate-500">Social Proof &amp; Reviews</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Review &amp; Testimonial Manager</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Curate verified reviews to broadcast via your site's bottom-corner social proof toaster widget.
            </p>
        </div>

        <!-- Site Switcher Dropdown -->
        <div class="flex items-center gap-2">
            <label for="site-select" class="text-xs text-slate-600 font-semibold">Active Domain:</label>
            <select id="site-select" onchange="window.location.href='<?= site_url('modules/reviews/') ?>' + this.value"
                    class="bg-white border border-slate-300 text-slate-900 text-xs rounded-xl px-3 py-2 font-mono shadow-soft-xs focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
                <?php foreach ($sites as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $selected_site['id'] ? 'selected' : '' ?>>
                        <?= esc($s['domain']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- 2 Columns: Add Form (Left) & Existing Reviews (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Add Review Form (5 cols) -->
        <div class="lg:col-span-5 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm relative">
            <?php 
                $isTrialCapped = isset($trial_status) && $trial_status['plan_type'] === 'trial' && $trial_status['used_today'] >= $trial_status['limit'];
                $isTrialExpired = isset($trial_status) && $trial_status['is_expired'];
                $isBlocked = $isTrialCapped || $isTrialExpired;
            ?>

            <?php if ($isTrialExpired): ?>
                <div class="mb-4 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="text-rose-600">🔒</span>
                        <p class="text-[11px] text-rose-800"><strong>Trial Expired:</strong> Upgrade to Pro for unlimited reviews.</p>
                    </div>
                    <a href="<?= site_url('dashboard') ?>" class="text-[11px] font-bold text-rose-600 hover:underline shrink-0">Upgrade &rarr;</a>
                </div>
            <?php elseif ($isTrialCapped): ?>
                <div class="mb-4 p-3.5 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="text-amber-600">⚠️</span>
                        <p class="text-[11px] text-amber-800"><strong>5/5 Tasks Used Today:</strong> Daily trial quota reached.</p>
                    </div>
                    <a href="<?= site_url('dashboard') ?>" class="text-[11px] font-bold text-amber-700 hover:underline shrink-0">Upgrade &rarr;</a>
                </div>
            <?php endif; ?>

            <h2 class="text-base font-bold text-slate-900 mb-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                Add Customer Testimonial
            </h2>
            <p class="text-xs text-slate-500 mb-5">
                Targeting: <strong class="text-slate-900 font-mono"><?= esc($selected_site['domain']) ?></strong>
            </p>

            <form action="<?= site_url('modules/reviews/create/' . $selected_site['id']) ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div>
                    <label for="reviewer_name" class="block text-xs font-semibold text-slate-700 mb-1">Reviewer Name</label>
                    <input type="text" id="reviewer_name" name="reviewer_name" required placeholder="Marcus Lindqvist"
                           <?= $isBlocked ? 'disabled' : '' ?>
                           class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2 text-xs placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>">
                </div>

                <div>
                    <label for="role_or_company" class="block text-xs font-semibold text-slate-700 mb-1">Role &amp; Company / Location</label>
                    <input type="text" id="role_or_company" name="role_or_company" placeholder="CTO at CloudStack Stockholm"
                           <?= $isBlocked ? 'disabled' : '' ?>
                           class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2 text-xs placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="rating" class="block text-xs font-semibold text-slate-700 mb-1">Star Rating</label>
                        <select id="rating" name="rating" <?= $isBlocked ? 'disabled' : '' ?> class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-2 text-xs font-bold focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>">
                            <option value="5">★★★★★ (5 Stars)</option>
                            <option value="4">★★★★☆ (4 Stars)</option>
                            <option value="3">★★★☆☆ (3 Stars)</option>
                            <option value="2">★★☆☆☆ (2 Stars)</option>
                            <option value="1">★☆☆☆☆ (1 Star)</option>
                        </select>
                    </div>

                    <div>
                        <label for="source" class="block text-xs font-semibold text-slate-700 mb-1">Source Platform</label>
                        <select id="source" name="source" <?= $isBlocked ? 'disabled' : '' ?> class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>">
                            <option value="trustpilot">Trustpilot (Verified)</option>
                            <option value="google">Google Reviews</option>
                            <option value="custom">Direct Customer</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="review_text" class="block text-xs font-semibold text-slate-700 mb-1">Review Quote / Content</label>
                    <textarea id="review_text" name="review_text" rows="3" required placeholder="SiteOps cut our SaaS churn by 18% in the first week and replaced our bloated review plugin..."
                              <?= $isBlocked ? 'disabled' : '' ?>
                              class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2 text-xs placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 leading-relaxed transition-all <?= $isBlocked ? 'opacity-60 cursor-not-allowed' : '' ?>"></textarea>
                </div>

                <?php if ($isBlocked): ?>
                    <button type="button" disabled class="w-full py-2.5 rounded-xl text-xs font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed">
                        <?= $isTrialExpired ? '🔒 Free Trial Expired' : '🛑 Daily Quota Reached (5/5 Tasks)' ?>
                    </button>
                <?php else: ?>
                    <button type="submit" class="w-full py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all">
                        + Publish Review to Widget
                    </button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Reviews List (7 cols) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700">
                    Active Testimonials on <?= esc($selected_site['domain']) ?> (<?= count($reviews) ?>)
                </h2>
                <span class="text-xs text-slate-400">Syncs automatically via CDN embed</span>
            </div>

            <?php if (empty($reviews)): ?>
                <div class="bg-white border border-dashed border-slate-300 rounded-3xl p-10 text-center shadow-soft-xs">
                    <p class="text-xs text-slate-500">No reviews added for this domain yet. Use the form on the left to add your first customer review.</p>
                </div>
            <?php else: ?>
                <?php foreach ($reviews as $rev): ?>
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-soft-xs relative group hover:shadow-soft-sm transition-shadow">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-sm font-bold text-slate-900"><?= esc($rev['reviewer_name']) ?></h3>
                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-full uppercase font-bold <?= $rev['source'] === 'trustpilot' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($rev['source'] === 'google' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-600 border border-slate-200') ?>">
                                        <?= esc($rev['source']) ?>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 mt-0.5"><?= esc($rev['role_or_company'] ?: 'Customer') ?></p>
                            </div>

                            <!-- Rating Stars -->
                            <div class="text-amber-500 text-xs tracking-wider">
                                <?= str_repeat('★', (int) $rev['rating']) ?><?= str_repeat('☆', 5 - (int) $rev['rating']) ?>
                            </div>
                        </div>

                        <!-- Review Text -->
                        <p class="text-xs text-slate-700 mt-3 leading-relaxed bg-slate-50/70 p-3.5 rounded-xl border border-slate-100">
                            "<?= esc($rev['review_text']) ?>"
                        </p>

                        <!-- Actions Footer -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-[11px] text-slate-400">Added <?= date('M d, Y', strtotime($rev['created_at'])) ?></span>

                            <div class="flex items-center gap-3">
                                <!-- Status Toggle -->
                                <a href="<?= site_url('modules/reviews/toggle/' . $rev['id']) ?>" 
                                   class="font-semibold text-xs flex items-center gap-1.5 <?= $rev['is_active'] ? 'text-emerald-600 hover:text-emerald-700' : 'text-slate-400 hover:text-slate-600' ?>">
                                    <span class="w-2 h-2 rounded-full <?= $rev['is_active'] ? 'bg-emerald-500' : 'bg-slate-300' ?>"></span>
                                    <span><?= $rev['is_active'] ? 'Active in Widget' : 'Hidden' ?></span>
                                </a>

                                <!-- Delete Form -->
                                <form action="<?= site_url('modules/reviews/delete/' . $rev['id']) ?>" method="POST" onsubmit="return confirm('Delete this review permanently?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-semibold transition-colors">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

</div>
<?= $this->endSection() ?>
