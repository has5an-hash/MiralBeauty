<?php
/* Template Name: ویدیوهای میرال */
get_header();
$videos = array_values( array_filter( mirall_instagram_works(), function ( $work ) { return 'video' === $work['type']; } ) );
?>
<main id="main">
	<section class="inner-hero" style="--inner-bg:url('<?php echo mirall_asset( 'makeup.jpg' ); ?>')"><div><span class="eyebrow">MIRALL REELS</span><h1>ویدیوهای نمونه‌کار</h1><p>لحظه‌های واقعی کار میرال را در ریل‌های عمومی صفحه رسمی ببین.</p></div></section>
	<section class="inner-content"><div class="section-heading compact"><span class="eyebrow">۱۲ ریل</span><h2>نتیجه‌ها را <em>در حرکت ببین</em></h2><p>همه ویدیوها لوکال روی خود سایت پخش می‌شوند؛ نیازی به اینستاگرام نیست.</p></div><div class="video-grid video-archive"><?php foreach ( $videos as $video ) : ?><article class="video-card local-video-card"><div class="video-frame" data-title="<?php echo esc_attr( $video['title'] ); ?>">
	<?php if ( ! empty( $video['video_file'] ) ) : ?>
		<video class="local-reel" preload="metadata" playsinline <?php echo $video['poster'] ? 'poster="' . esc_url( $video['poster'] ) . '"' : ''; ?> src="<?php echo esc_url( $video['video_file'] ); ?>"></video>
		<button type="button" class="play-mark video-toggle" aria-label="پخش ویدیوی <?php echo esc_attr( $video['title'] ); ?>">▶</button>
	<?php else : ?>
		<a href="<?php echo esc_url( $video['url'] ); ?>" target="_blank" rel="noopener"><img loading="lazy" src="<?php echo esc_url( $video['image'] ); ?>" alt="<?php echo esc_attr( $video['title'] ); ?>"><span class="play-mark">▶</span></a>
	<?php endif; ?>
	</div><div><small><?php echo esc_html( $video['label'] ); ?></small><h3><?php echo esc_html( $video['title'] ); ?></h3><p>پخش لوکال از سرور سایت + لینک ریل اصلی.</p><div class="video-actions"><?php if ( ! empty( $video['video_file'] ) ) : ?><button type="button" class="button button-small video-toggle">پخش ویدیو ▶</button><?php endif; ?><a class="text-button" href="<?php echo esc_url( $video['url'] ); ?>" target="_blank" rel="noopener">ریل اصلی ↗</a></div></div></article><?php endforeach; ?></div></section>
	<section class="inner-content"><div class="page-cta visual-cta" style="--cta-bg:url('<?php echo mirall_asset( 'balayage-warm.jpg' ); ?>')"><div><span class="eyebrow">MIRALL BEAUTY</span><h2>این سبک را می‌پسندی؟</h2><p>لینک ویدیو را هنگام رزرو برای مشاوره همراه داشته باش.</p></div><button class="button open-booking">رزرو مشاوره</button></div></section>
</main>
<?php get_footer(); ?>
