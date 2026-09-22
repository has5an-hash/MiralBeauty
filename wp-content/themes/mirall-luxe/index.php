<?php
get_header();
?>
	<main id="main" class="section">
	<?php if ( have_posts() ) : ?>
		<div class="journal-grid">
		<?php $post_index = 0; while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>><a class="journal-cover" href="<?php the_permalink(); ?>"><img loading="lazy" src="<?php echo esc_url( mirall_journal_image( get_the_ID(), $post_index ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"></a><div><span><?php echo esc_html( get_the_date() ); ?></span><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></div></article>
		<?php $post_index++; endwhile; ?>
		<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?><p>مطلبی پیدا نشد.</p><?php endif; ?>
</main>
<?php get_footer(); ?>
