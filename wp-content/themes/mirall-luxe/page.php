<?php get_header(); ?>
<main id="main" class="section"><article><?php while ( have_posts() ) : the_post(); ?><h1><?php the_title(); ?></h1><?php the_content(); ?><?php endwhile; ?></article></main>
<?php get_footer(); ?>

