/**
 * Avideas Event Styling — Main JavaScript
 * @version 1.0.0
 */

(function () {
  'use strict';

  /* ============================================================
     UTILITIES
  ============================================================ */
  function qs(sel, ctx) { return (ctx || document).querySelector(sel); }
  function qsa(sel, ctx) { return Array.from((ctx || document).querySelectorAll(sel)); }
  function on(el, ev, fn, opts) { el && el.addEventListener(ev, fn, opts || false); }
  function addClass(el, cls) { el && el.classList.add(cls); }
  function removeClass(el, cls) { el && el.classList.remove(cls); }
  function toggleClass(el, cls) { el && el.classList.toggle(cls); }
  function hasClass(el, cls) { return el && el.classList.contains(cls); }

  /* ============================================================
     STICKY HEADER
  ============================================================ */
  (function initStickyHeader() {
    var header = qs('#site-header');
    if (!header) return;

    var threshold = 80;
    var heroSection = qs('#hero');

    function updateHeader() {
      if (window.scrollY > threshold) {
        addClass(header, 'site-header--scrolled');
        removeClass(header, 'site-header--transparent');
      } else {
        if (heroSection) {
          addClass(header, 'site-header--transparent');
          removeClass(header, 'site-header--scrolled');
        }
      }
    }

    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();
  })();

  /* ============================================================
     HERO ANIMATIONS
  ============================================================ */
  (function initHero() {
    var hero = qs('.hero');
    if (!hero) return;

    // Trigger Ken Burns on load
    window.addEventListener('load', function () {
      addClass(hero, 'is-loaded');
    });
  })();

  /* ============================================================
     MOBILE MENU TOGGLE
  ============================================================ */
  (function initMobileMenu() {
    var toggle = qs('.nav-toggle');
    var menu   = qs('#mobile-menu');
    if (!toggle || !menu) return;

    function openMenu() {
      addClass(toggle, 'is-active');
      addClass(menu, 'is-open');
      toggle.setAttribute('aria-expanded', 'true');
      menu.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      removeClass(toggle, 'is-active');
      removeClass(menu, 'is-open');
      toggle.setAttribute('aria-expanded', 'false');
      menu.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    on(toggle, 'click', function () {
      hasClass(menu, 'is-open') ? closeMenu() : openMenu();
    });

    // Close on escape
    on(document, 'keydown', function (e) {
      if (e.key === 'Escape' && hasClass(menu, 'is-open')) closeMenu();
    });

    // Close when link clicked
    qsa('.mobile-menu__link', menu).forEach(function (link) {
      on(link, 'click', closeMenu);
    });
  })();

  /* ============================================================
     SCROLL REVEAL
  ============================================================ */
  (function initReveal() {
    var items = qsa('.reveal, .reveal-stagger');
    if (!items.length || !('IntersectionObserver' in window)) {
      // Fallback: show everything
      items.forEach(function (el) { addClass(el, 'is-visible'); });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          addClass(entry.target, 'is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    items.forEach(function (el) { observer.observe(el); });
  })();

  /* ============================================================
     TESTIMONIAL SLIDER
  ============================================================ */
  (function initTestimonialSlider() {
    var slider = qs('#testimonial-slider');
    if (!slider) return;

    var track  = qs('#testimonial-track', slider);
    var navEl  = qs('#testimonial-nav');
    var cards  = qsa('.testimonial-card', track);
    if (!cards.length) return;

    var current   = 0;
    var total     = cards.length;
    var autoTimer = null;
    var dots      = [];

    // Build dots
    cards.forEach(function (_, i) {
      var dot = document.createElement('button');
      dot.className = 'testimonial-dot' + (i === 0 ? ' is-active' : '');
      dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
      dot.setAttribute('role', 'tab');
      dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
      on(dot, 'click', function () { goTo(i); });
      if (navEl) navEl.appendChild(dot);
      dots.push(dot);
    });

    function goTo(index) {
      current = (index + total) % total;
      track.style.transform = 'translateX(-' + (current * 100) + '%)';
      dots.forEach(function (d, i) {
        toggleClass(d, 'is-active'); // reset first
        d.classList.toggle('is-active', i === current);
        d.setAttribute('aria-selected', i === current ? 'true' : 'false');
      });
    }

    function startAuto() {
      autoTimer = setInterval(function () { goTo(current + 1); }, 5000);
    }

    function stopAuto() { clearInterval(autoTimer); }

    startAuto();
    on(slider, 'mouseenter', stopAuto);
    on(slider, 'mouseleave', startAuto);

    // Touch/swipe support
    var startX = 0;
    on(track, 'touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
    on(track, 'touchend', function (e) {
      var diff = startX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 40) goTo(current + (diff > 0 ? 1 : -1));
    });
  })();

  /* ============================================================
     LIGHTBOX
  ============================================================ */
  (function initLightbox() {
    var overlay = qs('#lightbox-overlay');
    var img     = qs('#lightbox-img', overlay);
    var close   = qs('.lightbox-close', overlay);
    if (!overlay || !img) return;

    function open(src, alt) {
      img.src = src;
      img.alt = alt || '';
      addClass(overlay, 'is-open');
      overlay.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      close && close.focus();
    }

    function closeLightbox() {
      removeClass(overlay, 'is-open');
      overlay.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      img.src = '';
    }

    // Click triggers
    qsa('[data-lightbox]').forEach(function (item) {
      on(item, 'click', function () {
        var src = item.dataset.src || (item.querySelector('img') ? item.querySelector('img').src : '');
        var alt = item.dataset.alt || (item.querySelector('img') ? item.querySelector('img').alt : '');
        open(src, alt);
      });
    });

    on(close, 'click', closeLightbox);
    on(overlay, 'click', function (e) { if (e.target === overlay) closeLightbox(); });
    on(document, 'keydown', function (e) {
      if (e.key === 'Escape' && hasClass(overlay, 'is-open')) closeLightbox();
    });
  })();

  /* ============================================================
     GALLERY FILTER
  ============================================================ */
  (function initGalleryFilter() {
    var filterBtns = qsa('.filter-btn');
    var galleryGrid = qs('#gallery-grid');
    if (!filterBtns.length || !galleryGrid) return;

    var items = qsa('.gallery-grid__item', galleryGrid);

    filterBtns.forEach(function (btn) {
      on(btn, 'click', function () {
        var filter = btn.dataset.filter;

        // Update button states
        filterBtns.forEach(function (b) {
          removeClass(b, 'is-active');
          b.setAttribute('aria-pressed', 'false');
        });
        addClass(btn, 'is-active');
        btn.setAttribute('aria-pressed', 'true');

        // Filter items
        items.forEach(function (item) {
          var cats = (item.dataset.category || '').split(' ');
          var show = filter === 'all' || cats.indexOf(filter) !== -1;
          item.style.display = show ? '' : 'none';
        });
      });
    });
  })();

  /* ============================================================
     AJAX ENQUIRY FORM
  ============================================================ */
  (function initEnquiryForm() {
    var forms = qsa('#enquiry-form, #contact-form');

    forms.forEach(function (form) {
      var responseEl = form.querySelector('[id$="-response"]') || qs('#form-response', form) || qs('#contact-response', form);
      var submitBtn  = form.querySelector('[type="submit"]');

      on(form, 'submit', function (e) {
        e.preventDefault();

        // Simple client-side validation
        var name  = form.querySelector('[name="name"]');
        var email = form.querySelector('[name="email"]');
        if (!name || !name.value.trim()) {
          showResponse(responseEl, 'error', 'Please enter your name.');
          name && name.focus();
          return;
        }
        if (!email || !isValidEmail(email.value)) {
          showResponse(responseEl, 'error', 'Please enter a valid email address.');
          email && email.focus();
          return;
        }

        // Set loading state
        setLoading(submitBtn, true);

        var data = new FormData(form);
        data.append('action', 'avideas_enquiry');

        var nonce = form.querySelector('[name="nonce"]');
        if (nonce) data.set('nonce', nonce.value);

        fetch(
          (window.avideasData && window.avideasData.ajaxUrl) || '/wp-admin/admin-ajax.php',
          { method: 'POST', body: data }
        )
        .then(function (r) { return r.json(); })
        .then(function (json) {
          if (json.success) {
            showResponse(responseEl, 'success', json.data.message || 'Thank you! We\'ll be in touch soon.');
            form.reset();
          } else {
            showResponse(responseEl, 'error', (json.data && json.data.message) || 'Something went wrong. Please try again.');
          }
        })
        .catch(function () {
          showResponse(responseEl, 'error', 'Network error. Please call us directly.');
        })
        .finally(function () { setLoading(submitBtn, false); });
      });
    });

    function showResponse(el, type, msg) {
      if (!el) return;
      el.style.display = 'block';
      el.textContent = msg;
      el.style.padding = '1rem';
      el.style.borderRadius = '6px';
      el.style.marginTop = '1rem';
      el.style.fontSize = '0.9rem';
      if (type === 'success') {
        el.style.background = '#d4edda';
        el.style.color = '#155724';
        el.style.border = '1px solid #c3e6cb';
      } else {
        el.style.background = '#f8d7da';
        el.style.color = '#721c24';
        el.style.border = '1px solid #f5c6cb';
      }
    }

    function setLoading(btn, state) {
      if (!btn) return;
      var textEl    = btn.querySelector('.btn-text');
      var loadingEl = btn.querySelector('.btn-loading');
      btn.disabled  = state;
      if (textEl)    textEl.style.display = state ? 'none' : '';
      if (loadingEl) loadingEl.style.display = state ? 'inline-flex' : 'none';
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
  })();

  /* ============================================================
     SMOOTH SCROLL for anchor links
  ============================================================ */
  (function initSmoothScroll() {
    qsa('a[href^="#"]').forEach(function (link) {
      on(link, 'click', function (e) {
        var target = qs(link.getAttribute('href'));
        if (target) {
          e.preventDefault();
          var offset = 90; // header height
          var top = target.getBoundingClientRect().top + window.scrollY - offset;
          window.scrollTo({ top: top, behavior: 'smooth' });
        }
      });
    });
  })();

  /* ============================================================
     HEADER NAV — add scroll class on page that has no hero
  ============================================================ */
  (function initNoHeroHeader() {
    if (!qs('.hero')) {
      var header = qs('#site-header');
      if (header) {
        removeClass(header, 'site-header--transparent');
        addClass(header, 'site-header--scrolled');
      }
    }
  })();

  /* ============================================================
     ADD SPIN KEYFRAMES (for loading button)
  ============================================================ */
  var style = document.createElement('style');
  style.textContent = '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
  document.head.appendChild(style);

})();
