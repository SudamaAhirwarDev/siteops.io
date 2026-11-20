<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="space-y-8">

    <!-- Header & Domain Selector -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-xs font-bold text-emerald-800 uppercase tracking-widest bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                    Module 04
                </span>
                <span class="text-xs font-bold text-slate-500">MRR Protection &amp; Churn Defense</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Stripe Failed Payment Recovery (Dunning)</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Silently intercept failed recurring subscriptions and deploy frictionless card update workflows.
            </p>
        </div>

        <!-- Site Switcher Dropdown -->
        <div class="flex items-center gap-2">
            <label for="site-select" class="text-xs text-slate-600 font-semibold">Active Domain:</label>
            <select id="site-select" onchange="window.location.href='<?= site_url('modules/dunning/') ?>' + this.value"
                    class="bg-white border border-slate-300 text-slate-900 text-xs rounded-xl px-3 py-2 font-mono shadow-soft-xs focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
                <?php foreach ($sites as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $selected_site['id'] ? 'selected' : '' ?>>
                        <?= esc($s['domain']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Recovery Stats Summary -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 sm:p-5 shadow-soft-xs">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Dunning Events</span>
            <p class="text-2xl font-mono font-extrabold text-slate-900 mt-1"><?= esc($stats['total_logs']) ?></p>
        </div>

        <div class="bg-white border border-emerald-200/80 rounded-2xl p-4 sm:p-5 shadow-soft-xs">
            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700">Total Recovered MRR</span>
            <p class="text-2xl font-mono font-extrabold text-emerald-600 mt-1">$<?= number_format($stats['total_recovered'], 2) ?></p>
        </div>

        <div class="bg-white border border-amber-200/80 rounded-2xl p-4 sm:p-5 shadow-soft-xs">
            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Pending At-Risk MRR</span>
            <p class="text-2xl font-mono font-extrabold text-amber-600 mt-1">$<?= number_format($stats['total_pending'], 2) ?></p>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 sm:p-5 shadow-soft-xs">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Recovery Rate</span>
            <p class="text-2xl font-mono font-extrabold text-indigo-600 mt-1"><?= esc($recovery_rate) ?>%</p>
        </div>
    </div>

    <!-- Webhook Setup & Live Simulator Card -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm relative">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Dedicated Stripe Webhook Endpoint
                </h2>
                <p class="text-xs text-slate-500 mt-1 max-w-2xl">
                    Configure this endpoint in your Stripe Dashboard (<code class="bg-slate-100 px-1.5 py-0.5 rounded text-slate-700 font-mono text-[11px]">Developers &gt; Webhooks</code>). Listen to <code class="text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded font-mono text-[11px]">invoice.payment_failed</code> and <code class="text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded font-mono text-[11px]">invoice.paid</code> events.
                </p>
            </div>

            <!-- Instant Test Simulation Trigger -->
            <button onclick="simulateStripeWebhook()" id="btn-simulate" class="px-4 py-2.5 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition-all flex items-center gap-2 shrink-0 shadow-soft-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100 animate-pulse"></span>
                <span>⚡ Simulate Test Stripe Webhook</span>
            </button>
        </div>

        <!-- Copyable Endpoint Bar -->
        <div class="mt-4 p-4 rounded-2xl bg-slate-900 text-slate-200 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-soft-xs">
            <div class="font-mono text-xs text-indigo-300 break-all select-all">
                <?= esc($webhook_url) ?>
            </div>
            <button onclick="copyToClipboard('<?= addslashes($webhook_url) ?>', 'btn-copy-webhook')" id="btn-copy-webhook"
                    class="text-xs bg-indigo-600 hover:bg-indigo-500 text-white px-3.5 py-1.5 rounded-lg transition-colors flex items-center justify-center gap-1.5 whitespace-nowrap font-medium">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                <span>Copy Endpoint URL</span>
            </button>
        </div>

        <div id="simulation-feedback" class="hidden mt-3 p-3.5 rounded-2xl text-xs font-semibold"></div>
    </div>

    <!-- Dunning Logs Table -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-7 shadow-soft-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                Recent Failed Payment Recovery Logs (<?= count($logs) ?>)
            </h3>
            <span class="text-xs text-slate-400 font-mono">Domain: <?= esc($selected_site['domain']) ?></span>
        </div>

        <?php if (empty($logs)): ?>
            <div class="border border-dashed border-slate-300 rounded-2xl p-8 text-center">
                <p class="text-xs text-slate-500">No failed invoice logs recorded yet. Use the "Simulate Test Stripe Webhook" button above to verify.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="text-[11px] uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-2">
                        <tr>
                            <th class="py-2.5">Customer Email</th>
                            <th class="py-2.5">Amount</th>
                            <th class="py-2.5">Currency</th>
                            <th class="py-2.5">Recovery Status</th>
                            <th class="py-2.5">Event Logged</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td class="py-3 font-mono text-slate-900 font-medium">
                                    <?= esc($log['customer_email']) ?>
                                </td>
                                <td class="py-3 font-mono font-bold text-slate-900">
                                    $<?= number_format($log['amount'], 2) ?>
                                </td>
                                <td class="py-3 font-mono text-slate-500">
                                    <?= esc($log['currency']) ?>
                                </td>
                                <td class="py-3">
                                    <?php if ($log['status'] === 'recovered'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Recovered
                                        </span>
                                    <?php elseif ($log['status'] === 'pending'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Email Sent / Pending
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-rose-50 text-rose-700 border border-rose-200">
                                            Failed
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-slate-400 font-mono">
                                    <?= date('M d, Y H:i', strtotime($log['sent_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- Webhook Simulation JS -->
<script>
    function simulateStripeWebhook() {
        const btn = document.getElementById('btn-simulate');
        const feedback = document.getElementById('simulation-feedback');
        btn.disabled = true;
        btn.innerText = 'Sending Simulation...';

        const testPayload = {
            id: 'evt_test_' + Math.random().toString(36).substring(2, 9),
            type: 'invoice.payment_failed',
            data: {
                object: {
                    customer_email: 'billing_' + Math.floor(Math.random() * 900 + 100) + '@saasbuyer.eu',
                    amount_due: 14900,
                    currency: 'usd'
                }
            }
        };

        fetch('<?= esc($webhook_url) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(testPayload)
        })
        .then(res => res.json())
        .then(data => {
            feedback.className = 'mt-3 p-3.5 rounded-2xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 block shadow-soft-xs';
            feedback.innerHTML = '&#10003; Simulated Stripe Webhook Received: Logged payment_failed for ' + (data.amount || 149) + ' ' + (data.currency || 'USD') + '. Reloading page...';
            setTimeout(() => { window.location.reload(); }, 1800);
        })
        .catch(err => {
            console.error(err);
            feedback.className = 'mt-3 p-3.5 rounded-2xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block shadow-soft-xs';
            feedback.innerText = 'Error dispatching webhook simulation: ' + err.message;
            btn.disabled = false;
            btn.innerText = '⚡ Simulate Test Stripe Webhook';
        });
    }
</script>
<?= $this->endSection() ?>
