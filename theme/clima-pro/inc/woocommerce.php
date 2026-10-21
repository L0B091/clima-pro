<?php
/**
 * Ajustes de WooCommerce para un catálogo de miles de productos.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

// Quitar los wrappers por defecto; usamos los del theme (woocommerce.php).
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// El título ya se muestra en la cabecera de la página.
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Productos por página (configurable en Personalizar > WooCommerce > Catálogo de productos).
add_filter( 'loop_shop_per_page', function () {
	return (int) get_theme_mod( 'clima_products_per_page', 24 );
}, 20 );
add_filter( 'loop_shop_columns', function () {
	return 4;
} );

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_setting( 'clima_products_per_page', array( 'default' => 24, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'clima_products_per_page', array(
		'label'   => 'Productos por página',
		'section' => 'clima_pro_whatsapp',
		'type'    => 'number',
	) );
} );

// Productos relacionados: 4.
add_filter( 'woocommerce_output_related_products_args', function ( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
} );

// Buscador del encabezado limitado a productos.
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() && isset( $_GET['post_type'] ) && 'product' === $_GET['post_type'] ) { // phpcs:ignore
		$q->set( 'post_type', 'product' );
	}
} );

// Filtro por precio liviano (?min_price=&max_price= ya lo soporta WooCommerce) + subcategorías en la parte superior.
add_action( 'woocommerce_before_shop_loop', 'clima_pro_subcategory_chips', 5 );
/**
 * Chips de subcategorías de la categoría actual (o principales en la tienda).
 */
function clima_pro_subcategory_chips() {
	$parent = 0;
	if ( is_product_category() ) {
		$parent = get_queried_object_id();
	}
	$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => $parent, 'hide_empty' => false ) );
	if ( is_wp_error( $terms ) || ! $terms ) {
		return;
	}
	echo '<nav class="subcat-chips" aria-label="Subcategorías">';
	foreach ( $terms as $t ) {
		if ( 'uncategorized' === $t->slug || 'sin-categorizar' === $t->slug ) {
			continue;
		}
		printf( '<a class="chip" href="%s">%s <small>%d</small></a>', esc_url( get_term_link( $t ) ), esc_html( $t->name ), (int) $t->count );
	}
	echo '</nav>';
}

/**
 * Filtros de la barra lateral cuando no hay widgets cargados:
 * árbol de categorías + rango de precio por GET (sin AJAX).
 */
function clima_pro_fallback_filters() {
	echo '<section class="widget"><h3 class="widget-title">Categorías</h3><ul class="cat-tree">';
	wp_list_categories( array( 'taxonomy' => 'product_cat', 'title_li' => '', 'show_count' => true, 'hide_empty' => false, 'exclude' => get_option( 'default_product_cat' ) ) );
	echo '</ul></section>';
	$min = isset( $_GET['min_price'] ) ? absint( $_GET['min_price'] ) : ''; // phpcs:ignore
	$max = isset( $_GET['max_price'] ) ? absint( $_GET['max_price'] ) : ''; // phpcs:ignore
	?>
	<section class="widget"><h3 class="widget-title">Precio</h3>
		<form class="price-filter" method="get">
			<label><span>Desde $</span><input type="number" name="min_price" min="0" value="<?php echo esc_attr( $min ); ?>" inputmode="numeric"></label>
			<label><span>Hasta $</span><input type="number" name="max_price" min="0" value="<?php echo esc_attr( $max ); ?>" inputmode="numeric"></label>
			<?php
			foreach ( array( 'orderby', 's', 'post_type' ) as $keep ) {
				if ( isset( $_GET[ $keep ] ) ) { // phpcs:ignore
					printf( '<input type="hidden" name="%s" value="%s">', esc_attr( $keep ), esc_attr( sanitize_text_field( wp_unslash( $_GET[ $keep ] ) ) ) ); // phpcs:ignore
				}
			}
			?>
			<button class="btn btn-primary btn-block" type="submit">Filtrar</button>
		</form>
	</section>
	<?php
}

// Imágenes de producto con lazy loading y decodificación asíncrona.
add_filter( 'wp_get_attachment_image_attributes', function ( $attr ) {
	$attr['decoding'] = 'async';
	if ( empty( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}
	return $attr;
} );

// Placeholder propio de Clima Pro.
add_filter( 'woocommerce_placeholder_img_src', function () {
	return CLIMA_PRO_URI . '/assets/img/placeholder.svg';
} );

// Etiqueta "En stock" en las tarjetas.
add_action( 'woocommerce_before_shop_loop_item_title', function () {
	global $product;
	if ( $product && $product->is_in_stock() ) {
		echo '<span class="badge-stock">En stock</span>';
	}
}, 9 );

// Breadcrumb en español.
add_filter( 'woocommerce_breadcrumb_defaults', function ( $d ) {
	$d['home']      = 'Inicio';
	$d['delimiter'] = ' <span aria-hidden="true">›</span> ';
	return $d;
} );

/**
 * Si un producto no tiene imagen, mostramos una ilustración según su categoría principal.
 */
add_filter( 'woocommerce_product_get_image', function ( $html, $product, $size, $attr, $placeholder ) {
	if ( $product->get_image_id() ) {
		return $html;
	}
	$map = array(
		'compresores' => 'compresor', 'piezas-mecanicas' => 'compresor', 'cables' => 'cables', 'electronica' => 'termostato',
		'afines-a-climatizacion' => 'cobre', 'manometros' => 'manometro', 'bombas-de-vacio' => 'bomba', 'recuperadores' => 'bomba',
		'herramientas-de-mano' => 'manometro', 'linea-blanca' => 'heladera', 'linea-comercial' => 'exhibidora',
	);
	$img = 'placeholder';
	foreach ( (array) $product->get_category_ids() as $cid ) {
		$t = get_term( $cid, 'product_cat' );
		if ( $t && ! is_wp_error( $t ) && isset( $map[ $t->slug ] ) ) {
			$img = 'products/' . $map[ $t->slug ];
			break;
		}
	}
	return sprintf( '<img src="%s" alt="%s" width="400" height="400" loading="lazy" decoding="async" class="wp-post-image">', clima_pro_img( $img . '.svg' ), esc_attr( $product->get_name() ) );
}, 10, 5 );

// Ficha de producto sin imagen: usar la misma ilustración por categoría.
add_filter( 'woocommerce_single_product_image_thumbnail_html', function ( $html ) {
	global $product;
	if ( $product && ! $product->get_image_id() ) {
		return '<div class="woocommerce-product-gallery__image">' . $product->get_image( 'woocommerce_single' ) . '</div>';
	}
	return $html;
} );
