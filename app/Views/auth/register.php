<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Free Account — SiteOps</title>
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'], mono: ['"JetBrains Mono"', 'monospace'] },
                    colors: {
                        brand: { 50: '#eef2ff', 100: '#e0e7ff', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca' },
                    },
                    boxShadow: {
                        'soft-xs': '0 1px 2px 0 rgba(15, 23, 42, 0.04)',
                        'soft-md': '0 4px 16px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -2px rgba(15, 23, 42, 0.04)',
                        'soft-lg': '0 10px 25px -4px rgba(15, 23, 42, 0.07), 0 4px 10px -3px rgba(15, 23, 42, 0.04)',
                    }
                }
            }
        }
    </script>
    <style>
        html, body {
            height: 100%;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col items-center justify-center py-4 sm:py-6 px-4 selection:bg-brand-500 selection:text-white relative">

    <!-- Ambient Calm Glow -->
    <div class="fixed -top-40 -left-40 w-96 h-96 bg-indigo-100/60 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-purple-100/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10 my-auto">
        <!-- Brand Header -->
        <div class="text-center mb-3">
            <a href="<?= site_url('/') ?>" class="inline-flex items-center gap-2 group">
                <div class="relative w-8 h-8 transition-transform group-hover:scale-105 shrink-0">
                    <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_4px_12px_rgba(79,70,229,0.35)]">
                </div>
                <span class="text-xl font-extrabold tracking-tight text-slate-900">SiteOps<span class="text-indigo-600">.</span></span>
            </a>
            <h1 class="text-lg sm:text-xl font-bold text-slate-900 mt-1">Start 15-Day Free Trial</h1>
            <p class="text-xs text-slate-500 mt-0.5">Universal &lt;15KB growth &amp; compliance script</p>
        </div>

        <!-- Errors -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs mb-3 shadow-soft-xs">
                <ul class="list-disc list-inside space-y-0.5">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Register Card -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 sm:p-6 shadow-soft-lg relative">
            <form action="<?= site_url('register') ?>" method="POST" class="space-y-2.5 sm:space-y-3">
                <?= csrf_field() ?>

                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" required autofocus
                           class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-1.5 sm:py-2 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                           placeholder="Sarah Connor">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">Work Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                           class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-1.5 sm:py-2 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                           placeholder="sarah@company.com">
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required minlength="6"
                               class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-1.5 sm:py-2 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                               placeholder="Min 6 chars">
                    </div>

                    <div>
                        <label for="password_confirm" class="block text-xs font-semibold text-slate-700 mb-1">Confirm</label>
                        <input type="password" id="password_confirm" name="password_confirm" required minlength="6"
                               class="w-full bg-slate-50/70 border border-slate-200 text-slate-900 rounded-xl px-3 py-1.5 sm:py-2 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 transition-all"
                               placeholder="Re-enter">
                    </div>
                </div>

                <div class="pt-1">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 shadow-soft-sm transition-all flex items-center justify-center gap-1.5">
                        <span>Create Free Account</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </form>

            <div class="mt-2.5 text-center">
                <span class="text-[11px] text-slate-400">15-Day Free Trial &bull; 5 Tasks/Day &bull; No card required</span>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-slate-500 mt-3">
            Already have an account? 
            <a href="<?= site_url('login') ?>" class="font-bold text-indigo-600 hover:text-indigo-700 underline">Sign in</a>
        </p>
    </div>
</body>
</html>
