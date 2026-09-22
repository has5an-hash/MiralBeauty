<?php
/* Template Name: نمونه‌کارهای میرال */
get_header();
$items = mirall_instagram_works();
?>
<main id="main">
	<section class="inner-hero" style="--inner-bg:url('<?php echo mirall_asset( 'balayage-girly.jpg' ); ?>')"><div><span class="eyebrow">REAL WORKS · INSTAGRAM</span><h1>نمونه‌کارهای میرال</h1><p>پست‌ها و ریل‌های عمومی صفحه رسمی میرال؛ مرتب‌شده برای انتخاب مدل و رزرو.</p></div></section>
	<section class="inner-content"><div class="section-heading compact"><span class="eyebrow">۲۴ پست عمومی</span><h2>بروشور تصویری <em>میرال</em></h2><p>برای دیدن نسخه کامل، کپشن و اطلاعات انتشار، منبع رسمی هر کارت را باز کن.</p></div><div class="filter-bar"><button class="active" data-filter="all">همه</button><button data-filter="hair">رنگ و مو</button><button data-filter="makeup">میکاپ</button></div><div class="portfolio-grid instagram-portfolio-grid">
		<?php foreach ( $items as $index => $item ) : ?><article class="portfolio-item instagram-work-card <?php echo 0 === $index ? 'tall' : ''; ?>" data-cat="<?php echo esc_attr( $item['category'] ); ?>" data-title="<?php echo esc_attr( $item['title'] ); ?>"><button type="button" class="portfolio-image-button" aria-label="نمایش <?php echo esc_attr( $item['title'] ); ?>"><img loading="lazy" src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>، نمونه‌کار میرال"><em class="media-badge"><?php echo 'video' === $item['type'] ? '▶ ریل' : 'تصویر'; ?></em><span><small><?php echo esc_html( $item['label'] ); ?></small><strong><?php echo esc_html( $item['title'] ); ?></strong></span></button><a class="portfolio-source" href="<?php echo esc_url( $item['url'] ); ?>" target="_blank" rel="noopener">دیدن منبع اصلی ↗</a></article><?php endforeach; ?>
	</div><p class="portfolio-source-note">منبع همه کارت‌ها: صفحه عمومی رسمی <a href="https://www.instagram.com/mirall_beauty_center/" target="_blank" rel="noopener">@mirall_beauty_center</a>.</p></section>
	<section class="inner-content"><div class="page-cta visual-cta" style="--cta-bg:url('<?php echo mirall_asset( 'balayage-warm.jpg' ); ?>')"><div><h2>این سبک را دوست داری؟</h2><p>همین مدل را هنگام رزرو انتخاب کن تا کارشناس برای مشاوره با تو هماهنگ شود.</p></div><button class="button open-booking">انتخاب مدل و رزرو</button></div></section>
</main>
<dialog class="lightbox" id="lightbox"><button aria-label="بستن">×</button><img alt=""><strong></strong></dialog>
<?php get_footer(); ?>
