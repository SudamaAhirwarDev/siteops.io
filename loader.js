/**
 * SiteOps Universal Engine (<15KB)
 * Pure Vanilla JS | Isolated Shadow DOM
 * Modules: Accessibility Toolbar, Auto Alt-Tag Fixer, AI SEO Schema, Social Proof Reviews
 */
(function() {
    'use strict';
    if (window.__siteops_loaded) return;
    window.__siteops_loaded = true;

    function getCfg() {
        let s = document.currentScript;
        if (!s) {
            const elms = document.querySelectorAll('script[src*="loader.js"]');
            s = elms[elms.length - 1];
        }
        let k = '', base = '';
        if (s && s.src) {
            try {
                const u = new URL(s.src, window.location.href);
                k = u.searchParams.get('id') || u.searchParams.get('key') || u.searchParams.get('site_key') || '';
                base = u.origin + u.pathname.replace(/\/loader\.js.*$/, '');
            } catch (e) {}
        }
        if (!k && s) k = s.getAttribute('data-site-key') || s.getAttribute('data-id') || '';
        return { k, base };
    }

    const { k, base } = getCfg();
    if (!k) return;

    // Helper: Safely wait for document.body to be fully available
    function domReady(fn) {
        if (document.body && (document.readyState === 'interactive' || document.readyState === 'complete')) {
            fn();
        } else {
            window.addEventListener('DOMContentLoaded', fn, { once: true });
        }
    }

    // Initialize global debug & verification container
    window.__siteops = {
        version: '1.2.0',
        site_key: k,
        connected: true,
        status: 'Initializing',
        fixedImages: 0,
        schemaInjected: false,
        a11yActive: false,
        reviewsActive: false
    };

    fetch(`${base}/api/config/${encodeURIComponent(k)}`, {
        method: 'GET',
        headers: { 'Accept': 'application/json' },
        mode: 'cors'
    })
    .then(r => r.ok ? r.json() : null)
    .then(cfg => {
        if (!cfg || cfg.status !== 'success' || !cfg.modules) return;

        window.__siteops.domain = cfg.domain;
        window.__siteops.modules = cfg.modules;
        window.__siteops.status = 'Active & Protecting';

        domReady(() => {
            // Module 1: Accessibility & Auto Alt-Tag Fixer
            if (cfg.modules.accessibility) {
                initA11y();
                initAltFix();
                window.__siteops.a11yActive = true;
            }

            // Module 2: AI SEO, Schema.org JSON-LD & Link Security
            if (cfg.modules.seo) {
                initSeo(cfg);
            }

            // Module 3: Social Proof Reviews Popups
            if (cfg.modules.reviews && Array.isArray(cfg.reviews) && cfg.reviews.length > 0) {
                initReviews(cfg.reviews);
                window.__siteops.reviewsActive = true;
            }

            // Developer Verification Console Log
            try {
                console.log(
                    '%c⚡ SiteOps Universal Engine Active | ' + (cfg.domain || 'Verified Site') + ' %c[Key: ' + k + ']',
                    'background:#4f46e5;color:#ffffff;font-weight:bold;padding:4px 8px;border-radius:4px;font-size:11px;',
                    'color:#64748b;font-size:11px;'
                );
            } catch (e) {}
        });
    })
    .catch(() => {});

    // ==========================================
    // AUTO ALT-TAG FIXER
    // ==========================================
    function initAltFix() {
        let count = 0;
        const fix = () => {
            document.querySelectorAll('img:not([alt]), img[alt=""]').forEach((img, i) => {
                let alt = img.title || img.dataset.title || '';
                if (!alt && img.src) {
                    try {
                        const f = img.src.split('/').pop().split('?')[0].split('#')[0];
                        const c = f.replace(/\.[^/.]+$/, '').replace(/[-_]\d+x\d+$/i, '').replace(/@\d+x$/i, '').replace(/[-_+]/g, ' ').trim();
                        if (c.length > 1) alt = c.charAt(0).toUpperCase() + c.slice(1);
                    } catch (e) {}
                }
                img.alt = alt || ('Visual Content ' + (i + 1));
                img.dataset.siteopsFixed = '1';
                count++;
            });
            window.__siteops.fixedImages = count;
        };

        fix();
        try {
            const obs = new MutationObserver(() => fix());
            if (document.body) {
                obs.observe(document.body, { childList: true, subtree: true });
            }
        } catch (e) {}
    }

    // ==========================================
    // AI SEO & SCHEMA AUTO-FIXER
    // ==========================================
    function initSeo(cfg) {
        try {
            // 1. Injected Google Schema.org JSON-LD
            if (!document.querySelector('script[type="application/ld+json"]')) {
                const schema = document.createElement('script');
                schema.type = 'application/ld+json';
                schema.id = 'siteops-schema-ld';
                schema.textContent = JSON.stringify({
                    '@context': 'https://schema.org',
                    '@type': 'WebSite',
                    'name': document.title || (cfg && cfg.domain) || window.location.hostname,
                    'url': window.location.origin,
                    'potentialAction': {
                        '@type': 'SearchAction',
                        'target': window.location.origin + '/?s={search_term_string}',
                        'query-input': 'required name=search_term_string'
                    }
                });
                document.head.appendChild(schema);
                window.__siteops.schemaInjected = true;
            }

            // 2. Canonical Tag Auto-Repair
            if (!document.querySelector('link[rel="canonical"]')) {
                const canon = document.createElement('link');
                canon.rel = 'canonical';
                canon.href = window.location.origin + window.location.pathname;
                canon.dataset.siteopsFixed = '1';
                document.head.appendChild(canon);
            }

            // 3. OpenGraph Tags Auto-Repair
            if (!document.querySelector('meta[property="og:title"]')) {
                const m = document.createElement('meta');
                m.setAttribute('property', 'og:title');
                m.content = document.title || 'Site';
                m.dataset.siteopsFixed = '1';
                document.head.appendChild(m);
            }

            // 4. Secure External Links (Rel Noopener)
            document.querySelectorAll('a[target="_blank"]:not([rel*="noopener"])').forEach(a => {
                const r = a.getAttribute('rel') || '';
                a.setAttribute('rel', (r + ' noopener noreferrer').trim());
                a.dataset.siteopsFixed = '1';
            });
        } catch (e) {}
    }

    // ==========================================
    // ACCESSIBILITY TOOLBAR (WCAG / EAA 2025)
    // ==========================================
    function initA11y() {
        if (!document.body || document.getElementById('siteops-a11y-root')) return;

        const host = document.createElement('div');
        host.id = 'siteops-a11y-root';
        document.body.appendChild(host);
        const shadow = host.attachShadow({ mode: 'open' });

        const style = document.createElement('style');
        style.textContent = `
            :host{all:initial;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;font-size:13px;color:#1e293b}
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
            .trig{position:fixed;bottom:24px;left:24px;width:48px;height:48px;border-radius:50%;background:#4f46e5;color:#fff;border:none;box-shadow:0 8px 24px rgba(79,70,229,.4);cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:2147483647;transition:transform .2s,box-shadow .2s}
            .trig:hover{transform:scale(1.08);box-shadow:0 12px 28px rgba(79,70,229,.5)}
            .trig svg{width:24px;height:24px;fill:#fff}
            .pan{position:fixed;bottom:84px;left:24px;width:300px;background:rgba(255,255,255,.98);border:1px solid #e2e8f0;border-radius:20px;box-shadow:0 20px 40px -5px rgba(15,23,42,.2);padding:18px;z-index:2147483647;display:none;flex-direction:column;gap:12px;backdrop-filter:blur(16px)}
            .pan.open{display:flex}
            .hdr{display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f1f5f9;padding-bottom:10px}
            .ttl{font-size:13px;font-weight:700;color:#0f172a}
            .bdg{font-size:9px;background:#ecfdf5;color:#047857;padding:2px 7px;border-radius:99px;border:1px solid #a7f3d0;font-weight:700;margin-left:4px}
            .cls{background:none;border:none;color:#94a3b8;font-size:20px;cursor:pointer;line-height:1}
            .cls:hover{color:#0f172a}
            .row{background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:8px 12px;display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#475569;font-weight:600}
            .grp{display:flex;gap:4px}
            .sbtn{background:#fff;border:1px solid #cbd5e1;color:#1e293b;font-size:11px;font-weight:700;border-radius:6px;padding:4px 9px;cursor:pointer}
            .sbtn:hover{background:#f1f5f9}
            .grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}
            .tbtn{background:#f8fafc;border:1px solid #e2e8f0;color:#334155;border-radius:12px;padding:9px 6px;font-size:11px;font-weight:600;cursor:pointer;display:flex;flex-direction:column;align-items:center;gap:4px;transition:all .15s}
            .tbtn:hover{background:#f1f5f9;color:#0f172a}
            .tbtn.on{background:#4f46e5;color:#fff;border-color:#4338ca}
            .icon{font-size:15px;line-height:1}
            .rbtn{background:#fff1f2;border:1px solid #fecdd3;color:#e11d48;font-size:11px;font-weight:700;border-radius:10px;padding:8px;cursor:pointer;text-align:center}
            .rbtn:hover{background:#ffe4e6}
            .ftr{font-size:9px;color:#94a3b8;text-align:center}
        `;
        shadow.appendChild(style);

        const w = document.createElement('div');
        w.innerHTML = `
            <button class="trig" aria-label="Accessibility Menu" title="Accessibility Tools">
                <svg viewBox="0 0 24 24"><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg>
            </button>
            <div class="pan" role="dialog" aria-label="Accessibility Settings">
                <div class="hdr">
                    <div class="ttl">Accessibility <span class="bdg">EAA 2025</span></div>
                    <button class="cls" aria-label="Close">&times;</button>
                </div>
                <div class="row">
                    <span>Text Size</span>
                    <div class="grp">
                        <button class="sbtn" id="s-dn">A-</button>
                        <button class="sbtn" id="s-nr">100%</button>
                        <button class="sbtn" id="s-up">A+</button>
                    </div>
                </div>
                <div class="grid">
                    <button class="tbtn" id="t-ct">
                        <span class="icon">◑</span>
                        <span>High Contrast</span>
                    </button>
                    <button class="tbtn" id="t-lk">
                        <span class="icon">🔗</span>
                        <span>Highlight Links</span>
                    </button>
                    <button class="tbtn" id="t-mt">
                        <span class="icon">⏸</span>
                        <span>Pause Motion</span>
                    </button>
                    <button class="tbtn" id="t-dx">
                        <span class="icon">Aa</span>
                        <span>Dyslexia Font</span>
                    </button>
                </div>
                <button class="rbtn" id="t-rs">Reset Adjustments</button>
                <div class="ftr">⚡ SiteOps &lt;15KB Compliance Engine</div>
            </div>
        `;
        shadow.appendChild(w);

        const trig = shadow.querySelector('.trig');
        const pan  = shadow.querySelector('.pan');
        const cls  = shadow.querySelector('.cls');
        const bCt  = shadow.querySelector('#t-ct');
        const bLk  = shadow.querySelector('#t-lk');
        const bMt  = shadow.querySelector('#t-mt');
        const bDx  = shadow.querySelector('#t-dx');
        const bRs  = shadow.querySelector('#t-rs');
        const bUp  = shadow.querySelector('#s-up');
        const bDn  = shadow.querySelector('#s-dn');
        const bNr  = shadow.querySelector('#s-nr');

        const toggleP = o => pan.classList.toggle('open', typeof o === 'boolean' ? o : !pan.classList.contains('open'));
        trig.onclick = () => toggleP();
        cls.onclick = () => toggleP(false);

        let hStyle = document.getElementById('so-h-a11y');
        if (!hStyle) {
            hStyle = document.createElement('style');
            hStyle.id = 'so-h-a11y';
            document.head.appendChild(hStyle);
        }

        const st = { ct: false, lk: false, mt: false, dx: false, sc: 100 };

        function update() {
            let css = '';
            if (st.ct) css += 'html{filter:contrast(140%)!important}body{background:#000!important;color:#fff!important}';
            if (st.lk) css += 'a,a *{background:#fef08a!important;color:#000!important;text-decoration:underline!important;outline:2px solid #ca8a04!important}';
            if (st.mt) css += '*,*::before,*::after{animation-play-state:paused!important;transition-duration:.001s!important;scroll-behavior:auto!important}';
            if (st.dx) css += 'body,body *{font-family:Arial,sans-serif!important;letter-spacing:.1em!important;line-height:1.8!important}';
            if (st.sc !== 100) css += `html{font-size:${st.sc}%!important}`;
            hStyle.textContent = css;
        }

        bCt.onclick = () => { st.ct = !st.ct; bCt.classList.toggle('on', st.ct); update(); };
        bLk.onclick = () => { st.lk = !st.lk; bLk.classList.toggle('on', st.lk); update(); };
        bMt.onclick = () => { st.mt = !st.mt; bMt.classList.toggle('on', st.mt); update(); };
        bDx.onclick = () => { st.dx = !st.dx; bDx.classList.toggle('on', st.dx); update(); };

        bUp.onclick = () => { st.sc = Math.min(130, st.sc + 10); bNr.innerText = st.sc + '%'; update(); };
        bDn.onclick = () => { st.sc = Math.max(90, st.sc - 10); bNr.innerText = st.sc + '%'; update(); };
        bNr.onclick = () => { st.sc = 100; bNr.innerText = '100%'; update(); };

        bRs.onclick = () => {
            st.ct = st.lk = st.mt = st.dx = false;
            st.sc = 100;
            [bCt, bLk, bMt, bDx].forEach(b => b.classList.remove('on'));
            bNr.innerText = '100%';
            update();
        };

        window.addEventListener('keydown', e => {
            if (e.key === 'Escape' && pan.classList.contains('open')) toggleP(false);
        });
    }

    // ==========================================
    // SOCIAL PROOF REVIEWS TOAST
    // ==========================================
    function initReviews(revs) {
        if (!document.body || !revs || !revs.length || document.getElementById('siteops-reviews-root')) return;

        const host = document.createElement('div');
        host.id = 'siteops-reviews-root';
        document.body.appendChild(host);
        const shadow = host.attachShadow({ mode: 'open' });

        const style = document.createElement('style');
        style.textContent = `
            :host{all:initial;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;font-size:12px;color:#1e293b}
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
            .crd{position:fixed;bottom:24px;right:24px;width:310px;background:rgba(255,255,255,.98);border:1px solid #e2e8f0;border-radius:18px;box-shadow:0 18px 36px -5px rgba(15,23,42,.18);padding:14px;z-index:2147483640;display:flex;gap:10px;opacity:0;transform:translateY(25px);transition:all .35s ease;pointer-events:none;backdrop-filter:blur(14px);overflow:hidden}
            .crd.on{opacity:1;transform:translateY(0);pointer-events:auto}
            .bar{position:absolute;top:0;left:0;bottom:0;width:3px;background:linear-gradient(180deg,#4f46e5,#10b981)}
            .av{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#4f46e5,#818cf8);color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
            .bd{flex:1;min-width:0}
            .hd{display:flex;align-items:center;justify-content:space-between}
            .nm{font-size:12px;font-weight:700;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
            .x{background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer;padding:0 2px;line-height:1}
            .x:hover{color:#0f172a}
            .rl{font-size:10px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
            .st{display:flex;align-items:center;gap:4px;margin:2px 0 4px}
            .star{color:#f59e0b;font-size:11px}
            .tag{font-size:8px;font-weight:700;text-transform:uppercase;background:#ecfdf5;color:#047857;border:1px solid #a7f3d0;padding:1px 6px;border-radius:99px}
            .qt{font-size:11px;color:#334155;line-height:1.4;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
        `;
        shadow.appendChild(style);

        const card = document.createElement('div');
        card.className = 'crd';
        card.innerHTML = `
            <div class="bar"></div>
            <div class="av" id="r-av">SO</div>
            <div class="bd">
                <div class="hd">
                    <span class="nm" id="r-nm">Customer</span>
                    <button class="x" aria-label="Close Notification">&times;</button>
                </div>
                <div class="rl" id="r-rl">Verified Buyer</div>
                <div class="st">
                    <span class="star" id="r-st">★★★★★</span>
                    <span class="tag" id="r-tg">Verified</span>
                </div>
                <p class="qt" id="r-qt"></p>
            </div>
        `;
        shadow.appendChild(card);

        const elAv = card.querySelector('#r-av');
        const elNm = card.querySelector('#r-nm');
        const elRl = card.querySelector('#r-rl');
        const elSt = card.querySelector('#r-st');
        const elTg = card.querySelector('#r-tg');
        const elQt = card.querySelector('#r-qt');
        const bCls = card.querySelector('.x');

        let idx = 0, paused = false, dis = false, tmr = null;

        function getIn(name) {
            if (!name) return 'SO';
            const p = name.trim().split(/\s+/);
            return p.length >= 2 ? (p[0][0] + p[1][0]).toUpperCase() : p[0].slice(0, 2).toUpperCase();
        }

        function render(r) {
            if (dis) return;
            elAv.innerText = getIn(r.reviewer_name);
            elNm.innerText = r.reviewer_name || 'Verified Buyer';
            elRl.innerText = r.role_or_company || 'Customer';
            const rt = parseInt(r.rating, 10) || 5;
            elSt.innerText = '★'.repeat(rt) + '☆'.repeat(Math.max(0, 5 - rt));
            const s = (r.source || 'Verified').toLowerCase();
            elTg.innerText = s === 'trustpilot' ? 'Trustpilot' : (s === 'google' ? 'Google' : 'Verified');
            elQt.innerText = `"${r.review_text || ''}"`;

            card.classList.add('on');
            setTimeout(() => { if (!paused && !dis) card.classList.remove('on'); }, 6000);
        }

        function cycle() {
            if (paused || dis) return;
            render(revs[idx]);
            idx = (idx + 1) % revs.length;
        }

        card.onmouseenter = () => { paused = true; };
        card.onmouseleave = () => {
            paused = false;
            setTimeout(() => { if (!paused && !dis) card.classList.remove('on'); }, 1800);
        };

        bCls.onclick = e => {
            e.stopPropagation();
            dis = true;
            card.classList.remove('on');
            if (tmr) clearInterval(tmr);
        };

        setTimeout(() => {
            cycle();
            tmr = setInterval(cycle, 9000);
        }, 1500);
    }
})();
