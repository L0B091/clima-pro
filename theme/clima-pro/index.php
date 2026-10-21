<?php
/**
 * Plantilla general (blog, búsquedas no de productos, archivos).
 *
 * @package ClimaPro
 */
get_header(); ?>
<div class="container section">
	<?php if ( have_posts() ) : ?>
		<div class="post-list">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'card reveal' ); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1>No encontramos resultados</h1>
		<p>Probá con otra búsqueda o escribinos por WhatsApp.</p>
	<?php endif; ?>
</div>
<?php get_footer();
