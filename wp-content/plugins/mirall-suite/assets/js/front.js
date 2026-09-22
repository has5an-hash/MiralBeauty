(() => {
  'use strict';
  if (!window.MirallSuite) return;
  const request = async (action, data = {}) => {
    const body = new URLSearchParams({ action: `mirall_${action}`, nonce: MirallSuite.nonce, ...data });
    const response = await fetch(MirallSuite.ajaxUrl, { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' }, body });
    const json = await response.json().catch(() => ({ success: false, data: { message: 'پاسخ سرور معتبر نبود.' } }));
    if (!response.ok || !json.success) throw new Error(json?.data?.message || 'انجام عملیات ممکن نشد.');
    return json.data;
  };
  const objectFromForm = form => Object.fromEntries(new FormData(form).entries());

  document.querySelector('.mirall-live-form')?.addEventListener('submit', async event => {
    event.preventDefault();
    const form = event.currentTarget;
    const response = form.querySelector('.mirall-form-response');
    const button = form.querySelector('[type="submit"]');
    button.disabled = true; response.textContent = 'در حال ثبت نوبت...';
    try {
      const data = await request('create_booking', objectFromForm(form));
      form.hidden = true;
      const success = form.parentElement.querySelector('.booking-success');
      success.hidden = false;
      success.querySelector('.tracking-output').textContent = `کد پیگیری: ${data.tracking}`;
    } catch (error) { response.textContent = error.message; button.disabled = false; }
  });

  const otp = document.querySelector('.mirall-otp-form');
  otp?.querySelector('[data-action="send-otp"]')?.addEventListener('click', async event => {
    const button = event.currentTarget, mobile = otp.elements.mobile.value, response = otp.querySelector('.mirall-form-response');
    button.disabled = true; response.textContent = 'در حال ارسال کد...';
     try { const data = await request('send_otp', { mobile }); response.textContent = data.message; otp.querySelector('.otp-code').hidden = false; otp.elements.code.focus(); } catch (error) { response.textContent = error.message; } finally { button.disabled = false; }
  });
  otp?.addEventListener('submit', async event => {
    event.preventDefault(); const response = otp.querySelector('.mirall-form-response'); response.textContent = 'در حال ورود...';
    try { const data = await request('verify_otp', objectFromForm(otp)); window.location.href = data.redirect; } catch (error) { response.textContent = error.message; }
  });

  const supportForm = document.querySelector('.mirall-support-form');
  let supportTimer;
  const pollSupport = async (ticket, token) => {
    try {
      const data = await request('support_poll', { ticket, token });
      if (data.reply) {
        const box = document.querySelector('.support-reply');
        box.hidden = false; box.textContent = data.reply;
        window.clearInterval(supportTimer);
      }
    } catch (_) { window.clearInterval(supportTimer); }
  };
  supportForm?.addEventListener('submit', async event => {
    event.preventDefault(); const form = event.currentTarget, note = form.querySelector('.form-note'), button = form.querySelector('button'); button.disabled = true; note.textContent = 'در حال ثبت پیام...';
    try {
      const data = await request('support_ticket', objectFromForm(form)); note.textContent = data.message; form.reset();
      window.localStorage.setItem('mirall_support_thread', JSON.stringify({ ticket: data.ticket, token: data.token }));
      supportTimer = window.setInterval(() => pollSupport(data.ticket, data.token), 10000);
    } catch (error) { note.textContent = error.message; } finally { button.disabled = false; }
  });
  try {
    const thread = JSON.parse(window.localStorage.getItem('mirall_support_thread') || 'null');
    if (thread?.ticket && thread?.token) { pollSupport(thread.ticket, thread.token); supportTimer = window.setInterval(() => pollSupport(thread.ticket, thread.token), 10000); }
  } catch (_) {}

  document.querySelectorAll('.cancel-booking').forEach(button => button.addEventListener('click', async () => {
    if (!window.confirm('این نوبت لغو شود؟')) return;
    button.disabled = true;
    try { await request('cancel_booking', { booking_id: button.dataset.id }); window.location.reload(); } catch (error) { window.alert(error.message); button.disabled = false; }
  }));
})();
