<?php defined( 'ABSPATH' ) || exit; ?>
<footer>
	<div class="footer-inner">
		<div class="footer-brand"><div><strong>Mirall Beauty</strong><small>مرکز زیبایی میرال · فرشته</small><p>زیبایی دقیق، انتخاب آگاهانه و تجربه‌ای آرام در قلب فرشته.</p></div></div>
		<div class="footer-links"><strong>دسترسی سریع</strong><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'items_wrap' => '%3$s', 'fallback_cb' => 'mirall_primary_menu_fallback' ) ); ?></div>
		<div class="footer-contact"><strong>در ارتباط باش</strong><a href="tel:+982122003932">۰۲۱ ۲۲۰۰ ۳۹۳۲</a><a href="tel:+989125707416">۰۹۱۲ ۵۷۰ ۷۴۱۶</a><a href="https://www.instagram.com/mirall_beauty_center/" target="_blank" rel="noopener">اینستاگرام میرال</a></div>
	</div>
	<div class="footer-bottom"><span>تهران، فرشته، مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸</span><span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Mirall Beauty</span></div>
</footer>
<?php if ( shortcode_exists( 'mirall_support' ) ) { echo do_shortcode( '[mirall_support]' ); } ?>
<?php if ( shortcode_exists( 'mirall_booking' ) ) { echo do_shortcode( '[mirall_booking]' ); } ?>
<?php wp_footer(); ?>
</body>
</html>
