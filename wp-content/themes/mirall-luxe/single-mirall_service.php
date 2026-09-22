<?php
get_header();
$service = get_queried_object();
$image = get_the_post_thumbnail_url( $service, 'large' ) ?: mirall_asset( 'light-ombre.jpg' );
$booking_url = add_query_arg( 'service', $service->ID, get_permalink( (int) get_option( 'mirall_booking_page' ) ) ?: home_url( '/booking/' ) );
?>
<main id="main">
	<section class="inner-hero" style="--inner-bg:url('<?php echo esc_url( $image ); ?>')"><div><span class="eyebrow">MIRALL SERVICE</span><h1><?php echo esc_html( get_the_title( $service ) ); ?></h1><p><?php echo esc_html( get_the_excerpt( $service ) ?: 'انتخابی دقیق برای استایل و نیاز زیبایی تو.' ); ?></p></div></section>
	<section class="inner-content service-detail"><div class="service-detail-image"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( get_the_title( $service ) ); ?>"></div><div class="inner-copy"><span class="eyebrow">جزئیات خدمت</span><h2>شروع نتیجه خوب، از <em>مشاوره درست</em></h2><div class="prose"><?php the_content(); ?></div><div class="detail-list"><span>گفت‌وگو درباره سبک دلخواه</span><span>بررسی شرایط و تناژ مناسب</span><span>راهنمای مراقبت پس از خدمت</span></div><a class="button" href="<?php echo esc_url( $booking_url ); ?>">رزرو این خدمت</a></div></section>
	<section class="inner-content"><div class="page-cta visual-cta" style="--cta-bg:url('<?php echo mirall_asset( 'makeup.jpg' ); ?>')"><div><span class="eyebrow">MIRALL BEAUTY</span><h2>برای این انتخاب آماده‌ای؟</h2><p>درخواستت را ثبت کن تا زمان مناسب را با هم هماهنگ کنیم.</p></div><a class="button" href="<?php echo esc_url( $booking_url ); ?>">شروع رزرو</a></div></section>
</main>
<?php get_footer(); ?>
