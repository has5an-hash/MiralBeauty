<?php get_header(); ?>
<main id="main">
	<section class="inner-hero" style="--inner-bg:url('<?php echo mirall_asset( 'balayage-warm.jpg' ); ?>')"><div><span class="eyebrow">BEAUTY JOURNAL</span><h1>زیبایی‌نامهٔ میرال</h1><p>راهنماهای کاربردی برای انتخاب آگاهانه‌تر و مراقبت بهتر از نتیجهٔ خدمات زیبایی.</p></div></section>
	<section class="inner-content posts-page"><?php $post_index = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>><a class="post-cover" href="<?php the_permalink(); ?>"><img loading="lazy" src="<?php echo esc_url( mirall_journal_image( get_the_ID(), $post_index ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"></a><div><time><?php echo esc_html( get_the_date() ); ?></time><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?><a class="text-button" href="<?php the_permalink(); ?>">مطالعه مطلب ←</a></div></article><?php $post_index++; endwhile; else : ?><p>برای انتخاب مراقبت مناسب، با میرال در تماس باش.</p><?php endif; ?></section>
	<div class="inner-content"><?php the_posts_pagination(); ?></div>
</main>
<?php get_footer(); ?>
