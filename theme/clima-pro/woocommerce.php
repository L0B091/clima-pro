<?php
/**
 * Contenedor de todas las vistas de WooCommerce (tienda, categorías, ficha).
 *
 * @package ClimaPro
 */
get_header();
$is_archive = is_shop() || is_product_taxonomy() || is_search();
?>
<?php if ( $is_archive ) : ?>
<section class="page-hero page-hero--shop">
	<div class="container">
		<?php woocommerce_breadcrumb(); ?>
		<h1><?php woocommerce_page_title(); ?></h1>
		<?php if ( is_product_category() && term_description() ) : ?><div class="page-hero__desc"><?php echo wp_kses_post( term_description() ); ?></div><?php endif; ?>
	</div>
</section>
<div class="container section shop-layout">
	<aside class="shop-sidebar" aria-label="Filtros">
		<button class="btn btn-outline filters-toggle" aria-expanded="false" aria-controls="shop-filters">Filtros</button>
		<div id="shop-filters" class="shop-filters">
			<?php
			if ( is_active_sidebar( 'shop-sidebar' ) ) {
				dynamic_sidebar( 'shop-sidebar' );
			} else {
				clima_pro_fallback_filters();
			}
			?>
		</div>
	</aside>
	<div class="shop-content">
		<?php woocommerce_content(); ?>
	</div>
</div>
<?php else : ?>
<div class="container section single-wrap">
	<?php woocommerce_breadcrumb(); ?>
	<?php woocommerce_content(); ?>
</div>
<?php endif; ?>
<?php get_footer();
