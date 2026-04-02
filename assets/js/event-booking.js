/**
 * Luminar Touch Events — Event Booking Planner
 * Multi-step booking flow: Event → Details → Items → Review + Calendly
 * @version 1.0.0
 */
(function () {
  'use strict';

  var cfg    = window.luminarBooking || {};
  var AJAX   = cfg.ajaxUrl  || '/wp-admin/admin-ajax.php';
  var NONCE  = cfg.nonce    || '';
  var CAL    = cfg.defaultCal || '';
  var SYM    = cfg.currency || '$';

  /* ============================================================
     STATE
  ============================================================ */
  var state = {
    step:        1,
    eventId:     0,
    eventTitle:  '',
    eventCal:    '',
    guests:      0,
    venue:       '',
    eventDate:   '',
    name:        '',
    email:       '',
    phone:       '',
    items:       [],       // all items from server [{id, title, ...}]
    selected:    {},       // { id: true/false }
    submitted:   false,
  };

  /* ============================================================
     HELPERS
  ============================================================ */
  function qs(sel, ctx) { return (ctx || document).querySelector(sel); }
  function qsa(sel, ctx) { return Array.from((ctx || document).querySelectorAll(sel)); }

  function calcItemPrice(item) {
    var g = state.guests || 0;
    switch (item.price_type) {
      case 'per_person': return item.base_price * g;
      case 'per_table':  return item.base_price * Math.ceil(g / (item.guests_per || 10));
      default:           return item.base_price;
    }
  }

  function formatPrice(n) {
    return SYM + n.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  function pricingLabel(item) {
    switch (item.price_type) {
      case 'per_person': return SYM + item.base_price.toFixed(2) + '/person';
      case 'per_table':  return SYM + item.base_price.toFixed(2) + '/table (' + (item.guests_per || 10) + ' pax)';
      default:           return 'Flat ' + SYM + item.base_price.toFixed(2);
    }
  }

  function totalSelected() {
    return state.items.reduce(function (sum, item) {
      if (state.selected[item.id]) sum += calcItemPrice(item);
      return sum;
    }, 0);
  }

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function post(action, data, cb) {
    var body = new URLSearchParams({ action: action, nonce: NONCE });
    Object.keys(data).forEach(function (k) { body.set(k, data[k]); });
    fetch(AJAX, { method: 'POST', body: body, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (r) { return r.json(); })
      .then(cb)
      .catch(function (err) { console.error('[luminar booking]', err); });
  }

  /* ============================================================
     STEP NAVIGATION
  ============================================================ */
  function goTo(step) {
    qsa('.lb-step').forEach(function (el) {
      el.classList.toggle('lb-step--hidden', parseInt(el.dataset.step, 10) !== step);
    });
    qsa('.lb-step-btn').forEach(function (btn) {
      var n = parseInt(btn.dataset.step, 10);
      btn.classList.toggle('lb-step-btn--active', n === step);
      btn.classList.toggle('lb-step-btn--done', n < step);
    });
    var fill = qs('#lbProgressFill');
    if (fill) fill.style.width = (step * 25) + '%';
    state.step = step;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  /* ============================================================
     STEP 1 — LOAD + RENDER EVENTS
  ============================================================ */
  function initStep1() {
    var grid = qs('#lbEventGrid');
    var nextBtn = qs('#lbStep1Next');

    post('luminar_get_events', {}, function (res) {
      if (!res.success || !res.data.length) {
        grid.innerHTML = '<p class="lb-empty">No events found. Please check back soon.</p>';
        return;
      }

      grid.innerHTML = res.data.map(function (ev) {
        var img = ev.image
          ? '<img src="' + escHtml(ev.image) + '" alt="' + escHtml(ev.title) + '" loading="lazy" />'
          : '<div class="lb-event-card__placeholder">' + escHtml(ev.icon) + '</div>';

        return '<div class="lb-event-card" data-id="' + ev.id + '" data-title="' + escHtml(ev.title) + '" data-cal="' + escHtml(ev.calendly || '') + '" role="button" tabindex="0" aria-pressed="false">'
          + '<div class="lb-event-card__img">' + img + '</div>'
          + '<div class="lb-event-card__body">'
          + '<span class="lb-event-card__icon" aria-hidden="true">' + escHtml(ev.icon) + '</span>'
          + '<h3 class="lb-event-card__title">' + escHtml(ev.title) + '</h3>'
          + (ev.desc ? '<p class="lb-event-card__desc">' + escHtml(ev.desc) + '</p>' : '')
          + '</div>'
          + '<div class="lb-event-card__check" aria-hidden="true">✓</div>'
          + '</div>';
      }).join('');

      // Select a card
      qsa('.lb-event-card', grid).forEach(function (card) {
        function selectCard() {
          qsa('.lb-event-card', grid).forEach(function (c) {
            c.classList.remove('lb-event-card--selected');
            c.setAttribute('aria-pressed', 'false');
          });
          card.classList.add('lb-event-card--selected');
          card.setAttribute('aria-pressed', 'true');
          state.eventId    = parseInt(card.dataset.id, 10);
          state.eventTitle = card.dataset.title;
          state.eventCal   = card.dataset.cal;
          nextBtn.disabled = false;
        }
        card.addEventListener('click', selectCard);
        card.addEventListener('keydown', function (e) {
          if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); selectCard(); }
        });
      });
    });

    nextBtn.addEventListener('click', function () {
      if (state.eventId) goTo(2);
    });
  }

  /* ============================================================
     STEP 2 — EVENT DETAILS FORM
  ============================================================ */
  function initStep2() {
    var form = qs('#lbDetailsForm');

    qs('#lbStep2Back').addEventListener('click', function () { goTo(1); });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var guests = parseInt(qs('#lbGuests').value, 10);
      var venue  = qs('#lbVenue').value;
      var date   = qs('#lbEventDate').value;
      var name   = qs('#lbName').value.trim();
      var email  = qs('#lbEmail').value.trim();
      var phone  = qs('#lbPhone').value.trim();

      if (!guests || guests < 1) { qs('#lbGuests').focus(); return; }
      if (!venue)                { qs('#lbVenue').focus();  return; }
      if (!date)                 { qs('#lbEventDate').focus(); return; }
      if (!name)                 { qs('#lbName').focus();   return; }
      if (!email || !email.includes('@')) { qs('#lbEmail').focus(); return; }

      state.guests    = guests;
      state.venue     = venue;
      state.eventDate = date;
      state.name      = name;
      state.email     = email;
      state.phone     = phone;

      goTo(3);
      loadItems();
    });
  }

  /* ============================================================
     STEP 3 — LOAD + RENDER ITEMS
  ============================================================ */
  var itemsLoaded = false;

  function loadItems() {
    if (itemsLoaded) { updateTotals(); return; }

    var wrap = qs('#lbItemsWrap');
    var title = qs('#lbStep3Title');
    if (title) title.textContent = 'Build your ' + state.eventTitle + ' package';

    post('luminar_get_event_items', { event_id: state.eventId }, function (res) {
      if (!res.success || !res.data.length) {
        wrap.innerHTML = '<p class="lb-empty">No items configured for this event yet. Please contact us directly.</p>';
        return;
      }

      state.items = res.data;

      // Pre-select required items
      state.items.forEach(function (item) {
        if (item.required) state.selected[item.id] = true;
      });

      // Group by category
      var catOrder = ['decor', 'furniture', 'catering', 'photography', 'entertainment', 'transport', 'flowers'];
      var catLabels = {
        decor: 'Decoration', furniture: 'Furniture', catering: 'Catering',
        photography: 'Photography', entertainment: 'Entertainment',
        transport: 'Transport', flowers: 'Flowers & Florals'
      };
      var groups = {};
      state.items.forEach(function (item) {
        var cat = item.category || 'decor';
        if (!groups[cat]) groups[cat] = [];
        groups[cat].push(item);
      });

      var html = '';
      catOrder.forEach(function (cat) {
        if (!groups[cat] || !groups[cat].length) return;
        html += '<div class="lb-cat-group">';
        html += '<h3 class="lb-cat-group__title">' + escHtml(catLabels[cat] || cat) + '</h3>';
        html += '<div class="lb-items-grid">';
        groups[cat].forEach(function (item) {
          var price    = calcItemPrice(item);
          var checked  = state.selected[item.id] ? ' checked' : '';
          var disabled = item.required ? ' disabled' : '';
          var reqBadge = item.required ? '<span class="lb-item-badge lb-item-badge--req">Required</span>' : '';
          var imgHtml  = item.image
            ? '<img src="' + escHtml(item.image) + '" alt="' + escHtml(item.title) + '" loading="lazy" />'
            : '<div class="lb-item-card__img-placeholder">📦</div>';

          html += '<label class="lb-item-card' + (item.required ? ' lb-item-card--required' : '') + '" for="item_' + item.id + '">';
          html += '<input class="lb-item-cb" type="checkbox" id="item_' + item.id + '" data-id="' + item.id + '" value="' + item.id + '"' + checked + disabled + ' />';
          html += '<div class="lb-item-card__img">' + imgHtml + '</div>';
          html += '<div class="lb-item-card__body">';
          html += reqBadge;
          html += '<span class="lb-item-card__title">' + escHtml(item.title) + '</span>';
          if (item.desc) html += '<span class="lb-item-card__desc">' + escHtml(item.desc) + '</span>';
          html += '<div class="lb-item-card__pricing">';
          html += '<span class="lb-item-card__unit-price">' + escHtml(pricingLabel(item)) + '</span>';
          html += '<span class="lb-item-card__calc-price" id="item_price_' + item.id + '">' + formatPrice(price) + '</span>';
          html += '</div>';
          html += '</div>';
          html += '<div class="lb-item-card__check-mark" aria-hidden="true">✓</div>';
          html += '</label>';
        });
        html += '</div></div>';
      });

      wrap.innerHTML = html;
      itemsLoaded = true;

      // Checkbox change handler
      qsa('.lb-item-cb', wrap).forEach(function (cb) {
        cb.addEventListener('change', function () {
          state.selected[cb.dataset.id] = cb.checked;
          updateTotals();
        });
      });

      updateTotals();
    });
  }

  function updateTotals() {
    var total     = totalSelected();
    var totalEl   = qs('#lbTotalAmount');
    var totalBar  = qs('#lbTotalBar');
    if (totalEl)  totalEl.textContent = formatPrice(total);
    if (totalBar) totalBar.classList.toggle('lb-total-bar--visible', total > 0);

    // Update individual calculated prices
    state.items.forEach(function (item) {
      var el = qs('#item_price_' + item.id);
      if (el && state.selected[item.id]) {
        el.textContent = formatPrice(calcItemPrice(item));
        el.classList.add('lb-item-card__calc-price--active');
      } else if (el) {
        el.classList.remove('lb-item-card__calc-price--active');
      }
    });
  }

  function initStep3() {
    qs('#lbStep3Back').addEventListener('click', function () { goTo(2); });
    qs('#lbStep3Next').addEventListener('click', function () {
      goTo(4);
      renderReview();
    });
  }

  /* ============================================================
     STEP 4 — REVIEW + SUBMIT + CALENDLY
  ============================================================ */
  function renderReview() {
    var reviewEl = qs('#lbReview');
    var selected = state.items.filter(function (it) { return state.selected[it.id]; });
    var total    = totalSelected();

    var rows = selected.map(function (item) {
      var price = calcItemPrice(item);
      return '<tr>'
        + '<td class="lb-review__item-name">' + escHtml(item.title) + '</td>'
        + '<td class="lb-review__item-price">' + formatPrice(price) + '</td>'
        + '</tr>';
    }).join('');

    reviewEl.innerHTML = ''
      + '<div class="lb-review__meta">'
      + '<div class="lb-review__meta-item"><span>Event</span><strong>' + escHtml(state.eventTitle) + '</strong></div>'
      + '<div class="lb-review__meta-item"><span>Guests</span><strong>' + state.guests + '</strong></div>'
      + '<div class="lb-review__meta-item"><span>Venue</span><strong>' + escHtml(state.venue) + '</strong></div>'
      + '<div class="lb-review__meta-item"><span>Date</span><strong>' + escHtml(state.eventDate) + '</strong></div>'
      + '<div class="lb-review__meta-item"><span>Name</span><strong>' + escHtml(state.name) + '</strong></div>'
      + '<div class="lb-review__meta-item"><span>Email</span><strong>' + escHtml(state.email) + '</strong></div>'
      + '</div>'
      + '<table class="lb-review__table">'
      + '<thead><tr><th>Item</th><th>Price</th></tr></thead>'
      + '<tbody>' + (rows || '<tr><td colspan="2">No items selected</td></tr>') + '</tbody>'
      + '<tfoot><tr><th>Estimated Total</th><th>' + formatPrice(total) + '</th></tr></tfoot>'
      + '</table>'
      + '<p class="lb-review__disclaimer">*Estimate only. Final quote confirmed at your consultation.</p>';
  }

  function initStep4() {
    qs('#lbStep4Back').addEventListener('click', function () { goTo(3); });

    qs('#lbSubmitBtn').addEventListener('click', function () {
      if (state.submitted) return;

      var selected = state.items.filter(function (it) { return state.selected[it.id]; });
      var total    = totalSelected();
      var payload  = selected.map(function (it) {
        return { id: it.id, title: it.title, price: calcItemPrice(it) };
      });

      var btn = qs('#lbSubmitBtn');
      btn.disabled = true;
      btn.textContent = 'Sending…';

      post('luminar_submit_booking', {
        name:           state.name,
        email:          state.email,
        phone:          state.phone,
        event_id:       state.eventId,
        event_title:    state.eventTitle,
        guests:         state.guests,
        venue:          state.venue,
        event_date:     state.eventDate,
        selected_items: JSON.stringify(payload),
        total:          total.toFixed(2),
      }, function (res) {
        var msgEl = qs('#lbSubmitMsg');
        if (res.success) {
          state.submitted = true;
          msgEl.textContent  = res.data.message;
          msgEl.className    = 'lb-msg lb-msg--success';
          msgEl.hidden       = false;
          btn.textContent    = '✓ Enquiry Sent';

          // Show Calendly
          var calWrap = qs('#lbCalendlyWrap');
          var calUrl  = res.data.calendly || state.eventCal || CAL;
          if (calWrap && calUrl) {
            calWrap.hidden = false;
            loadCalendly(calUrl);
          }
          // Hide submit wrap after success
          qs('#lbSubmitWrap').style.marginBottom = '2rem';
        } else {
          msgEl.textContent = res.data.message || 'Something went wrong.';
          msgEl.className   = 'lb-msg lb-msg--error';
          msgEl.hidden      = false;
          btn.disabled      = false;
          btn.textContent   = 'Send Enquiry & Book Consultation';
        }
      });
    });
  }

  /* ============================================================
     CALENDLY
  ============================================================ */
  function loadCalendly(url) {
    // Append prefill params
    var prefill = '?name=' + encodeURIComponent(state.name)
      + '&email=' + encodeURIComponent(state.email)
      + '&a1=' + encodeURIComponent(state.eventTitle + ' — ' + state.guests + ' guests')
      + '&a2=' + encodeURIComponent(state.venue);
    var fullUrl = url + (url.indexOf('?') === -1 ? prefill : prefill.replace('?', '&'));

    var widget = qs('#lbCalendlyWidget');
    if (!widget) return;

    widget.innerHTML = '<div class="calendly-inline-widget" data-url="' + escHtml(fullUrl) + '" style="min-width:320px;height:700px;"></div>';

    if (!qs('script[src*="calendly.com/assets/external/widget.js"]')) {
      var s = document.createElement('script');
      s.src   = 'https://assets.calendly.com/assets/external/widget.js';
      s.async = true;
      document.body.appendChild(s);
    } else if (window.Calendly) {
      window.Calendly.initInlineWidgets();
    }

    widget.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  /* ============================================================
     INIT
  ============================================================ */
  document.addEventListener('DOMContentLoaded', function () {
    if (!qs('.lb-steps')) return;

    initStep1();
    initStep2();
    initStep3();
    initStep4();
    goTo(1);
  });

}());
