<?php
/**
 * Páginas comunes.
 *
 * @package ClimaPro
 */
get_header();
while ( have_posts() ) :
	the_post(); ?>
	<section class="page-hero"><div class="container"><h1><?php the_title(); ?></h1></div></section>
	<div class="container section entry-content"><?php the_content(); ?></div>
<?php endwhile;
get_footer();
