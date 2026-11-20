/**
 * SiteOps Universal Engine (<15KB)
 * Pure Vanilla JS | Isolated Shadow DOM
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

    fetch(`${base}/api/config/${encodeURIComponent(k)}`, {
        method: 'GET',
        headers: { 'Accept': 'application/json' },
        mode: 'cors'
    })
    .then(r => r.ok ? r.json() : null)
    .then(cfg => {
        if (!cfg || cfg.status !== 'success' || !cfg.modules) return;
        if (cfg.modules.accessibility) {
            initA11y();
            initAltFix();
        }
        if (cfg.modules.reviews && Array.isArray(cfg.reviews) && cfg.reviews.length > 0) {
            initReviews(cfg.reviews);
        }
    })
    .catch(() => {});

    function initAltFix() {
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
                img.alt = alt || ('Visual ' + (i + 1));
                img.dataset.siteopsFixed = '1';
            });
        };
        document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', fix) : fix();
    }

    function initA11y() {
        const host = document.createElement('div');
        host.id = 'siteops-a11y-root';
        document.body.appendChild(host);
        const shadow = host.attachShadow({ mode: 'open' });

        const style = document.createElement('style');
        style.textContent = `
            :host{all:initial;font-family:-apple-system,BlinkMacSystemFont,sans-serif;font-size:13px;color:#f1f5f9}
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
            .trig{position:fixed;bottom:20px;left:20px;width:46px;height:46px;border-radius:50%;background:#4f46e5;color:#fff;border:none;box-shadow:0 8px 20px rgba(79,70,229,.5);cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:2147483640;transition:transform .2s}
            .trig:hover{transform:scale(1.08)}
            .trig svg{width:22px;height:22px;fill:#fff}
            .pan{position:fixed;bottom:76px;left:20px;width:290px;background:#0f172a;border:1px solid #1e293b;border-radius:16px;box-shadow:0 20px 40px rgba(0,0,0,.6);padding:16px;z-index:2147483640;display:none;flex-direction:column;gap:12px;backdrop-filter:blur(10px)}
            .pan.open{display:flex}
            .hdr{display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #1e293b;padding-bottom:8px}
            .ttl{font-size:13px;font-weight:700;color:#fff}
            .bdg{font-size:9px;background:#10b98126;color:#34d399;padding:2px 5px;border-radius:4px;border:1px solid #10b98140}
            .cls{background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer}
            .cls:hover{color:#fff}
            .row{background:#131d31;border:1px solid #1e293b;border-radius:10px;padding:8px 10px;display:flex;align-items:center;justify-content:space-between;font-size:11px}
            .grp{display:flex;gap:4px}
            .sbtn{background:#1e293b;border:1px solid #334155;color:#fff;font-size:11px;font-weight:700;border-radius:5px;padding:3px 8px;cursor:pointer}
            .sbtn:hover{background:#334155}
            .grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}
            .tbtn{background:#1e293b;border:1px solid #334155;color:#cbd5e1;border-radius:10px;padding:8px 4px;font-size:11px;font-weight:600;cursor:pointer;display:flex;flex-direction:column;align-items:center;gap:4px}
            .tbtn:hover{background:#273549;color:#fff}
            .tbtn.on{background:#4f46e5;color:#fff;border-color:#6366f1}
            .icon{font-size:14px;line-height:1}
            .rbtn{background:#f43f5e1a;border:1px solid #f43f5e4d;color:#fda4af;font-size:11px;font-weight:700;border-radius:8px;padding:7px;cursor:pointer;text-align:center}
            .rbtn:hover{background:#f43f5e33;color:#fff}
            .ftr{font-size:9px;color:#64748b;text-align:center}
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

    function initReviews(revs) {
        if (!revs || !revs.length) return;

        const host = document.createElement('div');
        host.id = 'siteops-reviews-root';
        document.body.appendChild(host);
        const shadow = host.attachShadow({ mode: 'open' });

        const style = document.createElement('style');
        style.textContent = `
            :host{all:initial;font-family:-apple-system,BlinkMacSystemFont,sans-serif;font-size:12px;color:#f1f5f9}
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
            .crd{position:fixed;bottom:20px;right:20px;width:300px;background:#0f172a;border:1px solid #1e293b;border-radius:14px;box-shadow:0 15px 35px rgba(0,0,0,.5);padding:12px;z-index:2147483630;display:flex;gap:10px;opacity:0;transform:translateY(25px);transition:all .3s ease;pointer-events:none;backdrop-filter:blur(10px);overflow:hidden}
            .crd.on{opacity:1;transform:translateY(0);pointer-events:auto}
            .bar{position:absolute;top:0;left:0;bottom:0;width:3px;background:linear-gradient(180deg,#f59e0b,#10b981)}
            .av{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#6366f1);color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
            .bd{flex:1;min-width:0}
            .hd{display:flex;align-items:center;justify-content:space-between}
            .nm{font-size:12px;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
            .x{background:none;border:none;color:#64748b;font-size:16px;cursor:pointer;padding:0 2px;line-height:1}
            .x:hover{color:#fff}
            .rl{font-size:10px;color:#94a3b8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
            .st{display:flex;align-items:center;gap:4px;margin:2px 0 4px}
            .star{color:#fbbf24;font-size:10px}
            .tag{font-size:8px;font-weight:700;text-transform:uppercase;background:#10b98126;color:#34d399;border:1px solid #10b98140;padding:1px 4px;border-radius:3px}
            .qt{font-size:11px;color:#cbd5e1;line-height:1.35;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
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
            tmr = setInterval(cycle, 8000);
        }, 2000);
    }
})();
