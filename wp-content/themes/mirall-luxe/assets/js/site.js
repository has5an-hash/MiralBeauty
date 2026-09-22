(() => {
  'use strict';
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => [...c.querySelectorAll(s)];

  const navWrap = $('.nav-wrap');
  const header = $('header.site-header') || navWrap?.parentElement;
  if (header) new ResizeObserver(() => document.documentElement.style.setProperty('--header-height', `${header.getBoundingClientRect().bottom}px`)).observe(header);
  $$('.inner-hero').forEach(section => {
    const bg = section.style.getPropertyValue('--inner-bg');
    const url = bg.match(/url\(['"]?(.*?)['"]?\)/)?.[1];
    if (url && !$('.inner-art',section)) { const img = document.createElement('img');img.src=url;img.alt='نمونه‌کار میرال';img.className='inner-art';section.append(img); }
  });
  const brand = $('.brand');
  let dock = $('.mascot-dock');
  let mascot = $('#mascot');
  if (!dock && navWrap) {
    dock = document.createElement('div');
    dock.className = 'mascot-dock';
    dock.setAttribute('aria-label', 'جایگاه کاراکتر میرال');
    navWrap.insertBefore(dock, brand || $('.menu-toggle'));
  }
  if (!mascot && dock) {
    dock.innerHTML = '<button class="mascot" id="mascot" type="button" aria-label="لوگوی آینه‌ای میرال؛ باز کردن رزرو"><span class="mascot-frame"><img src="assets/images/mirall-mirror-logo-v3.png" alt="لوگوی آینه‌ای میرال"><i class="glass-glint" aria-hidden="true"></i></span><span>برای رزرو آماده‌ای؟</span></button>';
    mascot = $('#mascot');
  } else if (mascot && dock && mascot.parentElement !== dock) {
    dock.append(mascot);
  }
  if (mascot?.querySelector('img') && !mascot.querySelector('img').src.includes('mirall-mirror-logo-v3')) {
    mascot.querySelector('img').src = mascot.querySelector('img').src.replace('mirall-mirror-mascot-v2.png', 'mirall-mirror-logo-v3.png').replace('mirall-mirror-mascot.png', 'mirall-mirror-logo-v3.png');
  }
  if (mascot && !mascot.querySelector('.mascot-frame') && mascot.querySelector('img')) {
    const img = mascot.querySelector('img');
    const frame = document.createElement('span');
    frame.className = 'mascot-frame';
    img.replaceWith(frame);
    frame.append(img);
    frame.insertAdjacentHTML('beforeend', '<i class="glass-glint" aria-hidden="true"></i>');
  }
  if (navWrap && brand && dock && !$('.brand-cluster')) {
    const cluster = document.createElement('div'); cluster.className = 'brand-cluster'; navWrap.insertBefore(cluster, brand); cluster.append(dock, brand);
  }

  if (!$('#support-panel') && document.body.dataset.preview !== 'no-support') {
    document.body.insertAdjacentHTML('beforeend', '<button class="support-launch" aria-expanded="false" aria-controls="support-panel"><span class="online-dot"></span><b>ارتباط با پشتیبانی</b><em>◇</em></button><aside class="support-panel" id="support-panel" aria-hidden="true"><header><span class="chat-mascot-host" aria-hidden="true"></span><div><span class="online-dot"></span><strong>پشتیبانی میرال</strong><small>پیامتان را برای مجموعه بگذارید</small></div><button class="close-support" aria-label="بستن">×</button></header><div class="support-body"><p class="agent-message">سلام! برای رزرو، مشاوره یا پیگیری نوبت چطور می‌توانیم کمک کنیم؟</p><div class="quick-links"><a href="tel:+982122003932">تماس</a><a href="https://wa.me/989125707416" target="_blank" rel="noopener">واتس‌اپ</a><a href="https://www.instagram.com/mirall_beauty_center/" target="_blank" rel="noopener">اینستاگرام</a></div><form id="support-form"><label>نام<input required name="name"></label><label>شماره تماس<input required name="phone" inputmode="tel"></label><label>پیام<textarea required name="message" rows="3"></textarea></label><button class="button" type="submit">ثبت پیام</button><small class="form-note">در پیش‌نمایش، پیام روی سرور ذخیره نمی‌شود.</small></form></div></aside>');
  }

  const menuButton = $('.menu-toggle');
  const nav = $('#main-nav');
  menuButton?.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    menuButton.setAttribute('aria-expanded', String(open));
  });
  const megaParent = $('.has-mega');
  $('.mega-trigger')?.addEventListener('click', () => {
    const open = megaParent.classList.toggle('open');
    $('.mega-trigger').setAttribute('aria-expanded', String(open));
  });
  $$('#main-nav a').forEach(a => a.addEventListener('click', () => {
    nav.classList.remove('open');
    menuButton?.setAttribute('aria-expanded', 'false');
  }));

  const slides = $$('.hero-slide');
  const dots = $('.slider-dots');
  let current = 0;
  let timer;
  slides.forEach((_, i) => {
    const dot = document.createElement('button');
    dot.setAttribute('aria-label', `رفتن به اسلاید ${i + 1}`);
    dot.addEventListener('click', () => showSlide(i));
    dots?.append(dot);
  });
  const showSlide = index => {
    current = (index + slides.length) % slides.length;
    slides.forEach((s, i) => s.classList.toggle('active', i === current));
    $$('.slider-dots button').forEach((d, i) => d.classList.toggle('active', i === current));
    clearInterval(timer);
    timer = setInterval(() => showSlide(current + 1), 6500);
  };
  $$('.slider-controls > button').forEach(btn => btn.addEventListener('click', () => showSlide(current + (btn.dataset.dir === 'next' ? 1 : -1))));
  if (slides.length) showSlide(0);

  const observer = new IntersectionObserver(entries => entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
  }), { threshold: .12 });
  $$('.reveal').forEach((el, i) => {
    el.style.transitionDelay = `${Math.min(i % 4, 3) * 90}ms`;
    observer.observe(el);
  });
  $$('.service-card, .video-card, .journal-grid article, .portfolio-item, .steps > div, .review-grid blockquote').forEach((el, i) => {
    if (!el.classList.contains('reveal')) el.classList.add('reveal');
    el.style.transitionDelay = `${Math.min(i % 4, 3) * 110}ms`;
    observer.observe(el);
  });

  /* Local reels: click to play/pause, hover for muted preview */
  const stopReel = frame => {
    const v = $('video.local-reel', frame);
    if (!v) return;
    v.pause();
    frame.classList.remove('is-playing');
    $$('.video-toggle', frame.closest('.video-card') || frame).forEach(b => {
      if (b.tagName === 'BUTTON') b.textContent = b.classList.contains('play-mark') ? '▶' : 'پخش ویدیو ▶';
    });
  };
  $$('.video-frame').forEach(frame => {
    const video = $('video.local-reel', frame);
    if (!video) return;
    const card = frame.closest('.video-card') || frame.parentElement;
    const toggles = $$('.video-toggle', card);
    const play = (withSound = true) => {
      $$('.video-frame.is-playing').forEach(f => { if (f !== frame) stopReel(f); });
      video.muted = !withSound;
      video.loop = true;
      video.play().catch(() => {});
      frame.classList.add('is-playing');
      toggles.forEach(b => {
        if (b.tagName === 'BUTTON') b.textContent = b.classList.contains('play-mark') ? '❚❚' : 'توقف ❚❚';
      });
    };
    toggles.forEach(b => b.addEventListener('click', e => {
      e.preventDefault();
      frame.classList.contains('is-playing') && !video.muted ? stopReel(frame) : play(true);
    }));
    video.addEventListener('click', () => {
      if (video.paused) play(true);
      else if (video.muted) { video.muted = false; }
      else stopReel(frame);
    });
    let hoverTimer;
    frame.addEventListener('mouseenter', () => {
      if (frame.classList.contains('is-playing')) return;
      hoverTimer = setTimeout(() => { video.muted = true; video.loop = true; video.play().catch(() => {}); frame.classList.add('is-preview'); }, 350);
    });
    frame.addEventListener('mouseleave', () => {
      clearTimeout(hoverTimer);
      if (frame.classList.contains('is-preview') && !frame.classList.contains('is-playing')) { video.pause(); video.currentTime = 0; }
      frame.classList.remove('is-preview');
    });
  });

  const filters = $$('.filter-bar button');
  const works = $$('.portfolio-item');
  filters.forEach(btn => btn.addEventListener('click', () => {
    filters.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    works.forEach(item => item.hidden = btn.dataset.filter !== 'all' && item.dataset.cat !== btn.dataset.filter);
  }));

  const lightbox = $('#lightbox');
  works.forEach(item => $('.portfolio-image-button', item)?.addEventListener('click', () => {
    $('img', lightbox).src = $('img', item).src;
    $('img', lightbox).alt = $('img', item).alt;
    $('strong', lightbox).textContent = item.dataset.title;
    lightbox.showModal();
  }));
  $('#lightbox > button')?.addEventListener('click', () => lightbox.close());

  const comparison = $('.comparison');
  $('.comparison input')?.addEventListener('input', e => comparison.style.setProperty('--position', `${e.target.value}%`));

  const journalAssets = ['journal-color.svg', 'journal-care.svg', 'journal-makeup.svg'];
  $$('.journal-grid article').forEach((article, index) => {
    const image = $('img', article);
    if (!image || !/\/assets\/(?:light-ombre|balayage-warm|makeup)\.jpg(?:\?.*)?$/.test(image.src)) return;
    const title = article.textContent || '';
    const asset = title.includes('میکاپ') || title.includes('مراسم') ? journalAssets[2] : title.includes('مراقبت') || title.includes('مو') ? journalAssets[1] : journalAssets[index % journalAssets.length];
    image.src = image.src.replace(/[^/]+(?:\?.*)?$/, asset);
  });

  const mapUrl = `https://www.google.com/maps?q=${encodeURIComponent('مجتمع تجاری داریوش، فرشته، تهران')}&output=embed&z=16`;
  $$('.map-card').forEach(card => {
    if (card.parentElement?.querySelector('.contact-map')) return;
    const iframe = document.createElement('iframe');
    iframe.className = 'contact-map';
    iframe.src = mapUrl;
    iframe.title = 'نقشه مجتمع تجاری داریوش، فرشته';
    iframe.loading = 'lazy';
    iframe.allowFullscreen = true;
    iframe.referrerPolicy = 'no-referrer-when-downgrade';
    $('.map-pin', card)?.replaceChildren(document.createTextNode('⌖'));
    const visual = card.closest('.contact-visual');
    if (visual) {
      const image = [...visual.children].find(child => child.tagName === 'IMG');
      image?.remove();
      visual.prepend(iframe);
      card.classList.add('map-card-overlay');
    } else if (card.closest('.contact')) {
      const shell = document.createElement('div');
      shell.className = 'contact-map-shell';
      card.replaceWith(shell);
      shell.append(iframe, card);
      card.classList.add('map-card-overlay');
    }
  });

  const support = $('#support-panel');
  const chatHost = $('.chat-mascot-host');
  const reducedMotion = matchMedia('(prefers-reduced-motion: reduce)');
  const flight = document.createElement('div');
  flight.className = 'mirror-flight';
  flight.setAttribute('popover', 'manual');
  document.body.append(flight);
  let flightAnimation, flightVersion = 0;
  const animateMascotMove = async destination => {
    if (!mascot || !destination || mascot.parentElement === destination) return;
    const version = ++flightVersion;
    const before = mascot.getBoundingClientRect();
    flightAnimation?.cancel();
    const target = destination.getBoundingClientRect();
    const width = matchMedia('(max-width:720px)').matches ? 54 : 72;
    const height = matchMedia('(max-width:720px)').matches ? 78 : 92;
    if (!target.width || !target.height) return;
    const left = target.left + (target.width - width) / 2;
    const top = target.top + (target.height - height) / 2;
    mascot.classList.add('travelling');
    flight.append(mascot);
    Object.assign(flight.style, {left:`${before.left}px`,top:`${before.top}px`,width:`${width}px`,height:`${height}px`});
    if (flight.showPopover && !flight.matches(':popover-open')) flight.showPopover();
    flight.hidden = false;
    const dx = left - before.left, dy = top - before.top;
    flightAnimation = flight.animate([
      {transform:'translate3d(0,0,0) rotate(0)'},
      {transform:`translate3d(${dx * .5}px,${dy * .5 - 18}px,0) rotate(${dx < 0 ? -2 : 2}deg)`,offset:.5},
      {transform:`translate3d(${dx}px,${dy}px,0) rotate(0)`}
    ], {duration:reducedMotion.matches ? 0 : 1250,easing:'cubic-bezier(.45,0,.2,1)',fill:'forwards'});
    try { await flightAnimation.finished; } catch { return; }
    if (version !== flightVersion) return;
    destination.append(mascot);
    mascot.classList.remove('travelling');
    flightAnimation.cancel();
    if (flight.hidePopover && flight.matches(':popover-open')) flight.hidePopover();
    flight.hidden = true;
  };
  let supportVersion = 0;
  const toggleSupport = async force => {
    if (!support) return;
    const open = typeof force === 'boolean' ? force : !support.classList.contains('open');
    const version = ++supportVersion;
    if (!open) {
      support.classList.remove('open');
      support.setAttribute('aria-hidden', 'true');
      $('.support-launch')?.setAttribute('aria-expanded', 'false');
      await new Promise(resolve => setTimeout(resolve, 280));
      if (version !== supportVersion) return;
      await animateMascotMove(booking?.open ? bookingHost : dock);
      return;
    }
    if (version !== supportVersion) return;
    support.classList.add('open');
    support.setAttribute('aria-hidden', 'false');
    $('.support-launch')?.setAttribute('aria-expanded', 'true');
    setTimeout(() => { if (version === supportVersion && support.classList.contains('open')) animateMascotMove(chatHost); }, 260);
  };
  $('.support-launch')?.addEventListener('click', () => toggleSupport());
  $('.close-support')?.addEventListener('click', () => toggleSupport(false));
  $('#support-form')?.addEventListener('submit', e => {
    if (e.currentTarget.classList.contains('mirall-support-form')) return;
    e.preventDefault();
    $('.form-note').textContent = 'پیامتان ثبت شد؛ پذیرش میرال در اولین فرصت با شما تماس می‌گیرد.';
    $('.form-note').style.color = '#258759';
  });

  const booking = $('#booking-dialog');
  const bookingHost = $('.booking-mascot-host', booking || document);
  const bookingForm = $('#booking-form');
  let step = 1;
  const syncStep = () => {
    if (!booking) return;
    $$('.booking-step', booking).forEach(s => s.classList.toggle('active', Number(s.dataset.step) === step));
    $$('.booking-progress span', booking).forEach((s, i) => s.classList.toggle('active', i < step));
    $('.prev-step', booking).disabled = step === 1;
    $('.next-step', booking).hidden = step === 4;
    $('.submit-booking', booking).hidden = step !== 4;
  };
  const validateStep = () => {
    if (!booking) return false;
    const active = $(`.booking-step[data-step="${step}"]`, booking);
    const fields = $$('input,select,textarea', active);
    for (const field of fields) if (!field.checkValidity()) { field.reportValidity(); return false; }
    return true;
  };
  const openBooking = service => {
    if (!booking || !bookingForm) {
      const target = MirallTheme?.bookingUrl || '/booking/';
      window.location.href = service ? `${target}?service=${encodeURIComponent(service)}` : target;
      return;
    }
    bookingForm.hidden = false;
    $('.booking-success', booking).hidden = true;
    step = 1;
    syncStep();
    if (service) {
      const escaped = CSS.escape(service);
      const radio = $(`input[name="service"][value="${escaped}"]`, booking) ||
        $(`input[name="service_id"][value="${escaped}"], input[name="service_id"][data-label="${escaped}"]`, booking);
      if (radio) radio.checked = true;
    }
    booking.showModal();
    document.body.classList.add('booking-open');
    setTimeout(() => animateMascotMove(bookingHost || dock), 90);
  };
  $$('.open-booking').forEach(btn => btn.addEventListener('click', () => openBooking(btn.dataset.service)));
  let closingBooking = false;
  const closeBooking = async () => {
    if (closingBooking) return;
    closingBooking = true;
    await animateMascotMove(support?.classList.contains('open') ? chatHost : dock);
    booking?.close(); document.body.classList.remove('booking-open');
    closingBooking = false;
  };
  booking?.addEventListener('cancel', e => { e.preventDefault(); closeBooking(); });
  booking?.querySelector('.dialog-close')?.addEventListener('click', closeBooking);
  booking?.querySelector('.next-step')?.addEventListener('click', () => { if (validateStep()) { step++; syncStep(); } });
  booking?.querySelector('.prev-step')?.addEventListener('click', () => { step = Math.max(1, step - 1); syncStep(); });
  bookingForm?.addEventListener('submit', e => {
    if (bookingForm.classList.contains('mirall-live-form')) return;
    e.preventDefault();
    if (!validateStep()) return;
    bookingForm.hidden = true;
    $('.booking-success', booking).hidden = false;
  });
  booking?.querySelector('.close-success')?.addEventListener('click', closeBooking);
  booking?.addEventListener('close', () => { document.body.classList.remove('booking-open'); if (!support?.classList.contains('open')) animateMascotMove(dock); });

  if (booking?.hasAttribute('open')) {
    document.body.classList.add('booking-open');
    const requested = new URLSearchParams(window.location.search).get('service');
    if (requested) {
      const numeric = Number(requested);
      const radio = booking.querySelector(`input[name="service_id"][value="${Number.isFinite(numeric) ? numeric : ''}"]`);
      if (radio) radio.checked = true;
    }
  }

  mascot?.addEventListener('click', () => {
    if (support?.classList.contains('open')) {
      mascot.classList.remove('peek');
      requestAnimationFrame(() => mascot.classList.add('peek'));
      return;
    }
    openBooking();
  });
  [booking, lightbox].forEach(dialog => dialog?.addEventListener('click', e => {
    const rect = dialog.getBoundingClientRect();
    if (e.clientX < rect.left || e.clientX > rect.right || e.clientY < rect.top || e.clientY > rect.bottom) { if (dialog === booking) closeBooking(); else dialog.close(); }
  }));
})();
