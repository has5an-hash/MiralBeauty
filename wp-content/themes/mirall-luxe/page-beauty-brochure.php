<?php
/* Template Name: بروشور زیبایی میرال */
get_header();
$services = get_posts( array( 'post_type' => 'mirall_service', 'numberposts' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>
<main id="main">
	<section class="inner-hero brochure-hero" style="--inner-bg:url('<?php echo mirall_asset( 'balayage-warm.jpg' ); ?>')"><div><span class="eyebrow">MIRALL BEAUTY BROCHURE</span><h1>بروشور زیبایی میرال</h1><p>خدمتت را با آرامش انتخاب کن، درباره‌اش بخوان و مستقیم برای مشاوره و رزرو اقدام کن.</p></div></section>
	<section class="brochure-intro"><div><span class="eyebrow">انتخاب شخصی تو</span><h2>هر خدمت، با توضیحی روشن و <em>مسیر رزرو مستقیم</em></h2></div><p>اگر درباره تناژ، فرم یا سبک مردد هستی، درخواستت را ثبت کن تا پیش از نهایی‌شدن زمان، با تو هماهنگ شود.</p></section>
	<section class="brochure-list" aria-label="فهرست خدمات">
		<nav class="brochure-nav"><a href="#hair-services">مو و رنگ</a><a href="#face-services">میکاپ و ابرو</a><a href="#nail-services">ناخن و مژه</a></nav>
		<div class="service-showcase" id="hair-services">
			<?php foreach ( $services as $index => $service ) : $image = array( 'light-ombre.jpg', 'balayage-warm.jpg', 'makeup.jpg', 'caramel-highlight.jpg' )[ $index % 4 ]; ?>
			<article class="brochure-service" id="service-<?php echo esc_attr( $service->post_name ); ?>"><img loading="lazy" src="<?php echo esc_url( get_the_post_thumbnail_url( $service, 'large' ) ?: mirall_asset( $image ) ); ?>" alt="<?php echo esc_attr( $service->post_title ); ?>"><div><small><?php echo esc_html( $service->post_title ); ?></small><h2><?php echo esc_html( $service->post_title ); ?></h2><p><?php echo esc_html( $service->post_content ); ?></p><div class="service-facts"><span>مشاوره پیش از اجرا</span><span>انتخاب مدل و تناژ</span><span>راهنمای مراقبت</span></div><div class="brochure-actions"><a class="button" href="<?php echo esc_url( add_query_arg( 'service', $service->ID, get_permalink( (int) get_option( 'mirall_booking_page' ) ) ?: home_url( '/booking/' ) ) ); ?>">رزرو نوبت</a><a class="text-button" href="<?php echo esc_url( get_permalink( $service ) ); ?>">جزئیات کامل ←</a></div></div></article>
			<?php endforeach; ?>
		</div>
	</section>
	<section class="inner-content"><div class="page-cta visual-cta" style="--cta-bg:url('<?php echo mirall_asset( 'makeup.jpg' ); ?>')"><div><span class="eyebrow">MIRALL BEAUTY</span><h2>برای انتخابت وقت مشاوره بگیر</h2><p>همین حالا خدمت موردنظرت را انتخاب کن تا مسیر رزرو را شروع کنیم.</p></div><a class="button" href="<?php echo esc_url( get_permalink( (int) get_option( 'mirall_booking_page' ) ) ?: home_url( '/booking/' ) ); ?>">شروع رزرو</a></div></section>
</main>
<?php get_footer(); ?>
