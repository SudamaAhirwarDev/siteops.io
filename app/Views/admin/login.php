<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'Master Control Sign In — SiteOps Admin') ?></title>
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
                        'soft-xs': '0 1px 2px 0 rgba(15, 23, 42, 0.04)',
                        'soft-md': '0 4px 16px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -2px rgba(15, 23, 42, 0.04)',
                        'soft-lg': '0 10px 25px -4px rgba(15, 23, 42, 0.07), 0 4px 10px -3px rgba(15, 23, 42, 0.04)',
                        'glow-indigo': '0 0 35px -5px rgba(99, 102, 241, 0.35)',
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
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col items-center justify-center py-6 px-4 selection:bg-indigo-500 selection:text-white relative">

    <!-- Ambient High-Tech Glow -->
    <div class="fixed -top-40 -left-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-purple-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10 my-auto">
        <!-- Brand Header -->
        <div class="text-center mb-5">
            <a href="<?= site_url('/') ?>" class="inline-flex items-center gap-2.5 group">
                <div class="relative w-10 h-10 transition-transform group-hover:scale-105 shrink-0">
                    <img src="<?= base_url('assets/images/logo-icon.svg') ?>" alt="SiteOps Logo" class="w-full h-full drop-shadow-[0_0_16px_rgba(99,102,241,0.6)]">
                </div>
                <div class="text-left">
                    <span class="text-xl font-extrabold tracking-tight text-white block leading-tight">SiteOps<span class="text-indigo-400">.</span></span>
                    <span class="text-[10px] font-mono uppercase tracking-widest text-indigo-400 font-bold">Master Control Plane</span>
                </div>
            </a>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-950/80 border border-indigo-700/50 text-indigo-300 text-[10px] font-mono uppercase tracking-wider font-semibold mt-3">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Restricted Admin Portal &bull; Level 4 Access</span>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="p-3 rounded-xl bg-rose-950/70 border border-rose-700/60 text-rose-200 text-xs mb-4 shadow-soft-xs flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="p-3 rounded-xl bg-emerald-950/70 border border-emerald-700/60 text-emerald-200 text-xs mb-4 shadow-soft-xs flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
        <?php endif; ?>

        <!-- Login Card -->
        <div class="bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 sm:p-6 shadow-glow-indigo relative">
            <form action="<?= site_url('admin/login') ?>" method="POST" class="space-y-3.5">
                <?= csrf_field() ?>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 mb-1">Administrator Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required autofocus
                           class="w-full bg-slate-950/80 border border-slate-700 text-slate-100 rounded-xl px-3.5 py-2 text-sm placeholder-slate-500 focus:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all font-mono"
                           placeholder="admin@siteops.io">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-semibold text-slate-300">Security Key / Password</label>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-slate-950/80 border border-slate-700 text-slate-100 rounded-xl px-3.5 py-2 text-sm placeholder-slate-500 focus:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                           placeholder="••••••••••••">
                </div>

                <button type="submit" class="w-full mt-2 py-2.5 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-soft-sm transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Authenticate as Administrator</span>
                    <span>&rarr;</span>
                </button>
            </form>
        </div>

        <!-- Navigation Links -->
        <div class="flex items-center justify-between text-xs text-slate-500 mt-4 px-2">
            <a href="<?= site_url('login') ?>" class="hover:text-indigo-400 transition-colors">
                &larr; Standard User Login
            </a>
            <a href="<?= site_url('/') ?>" class="hover:text-indigo-400 transition-colors">
                Public Website
            </a>
        </div>
    </div>
</body>
</html>
