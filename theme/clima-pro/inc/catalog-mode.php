<?php
/**
 * Modo catálogo: sin carrito, sin checkout, sin pagos.
 * Todos los "Añadir al carrito" se reemplazan por "Consultar por WhatsApp".
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

// Ningún producto es comprable: WooCommerce no muestra formularios de compra.
add_filter( 'woocommerce_is_purchasable', '__return_false', 99 );

// Bucles (tienda, categorías, relacionados): reemplazar el botón.
add_filter( 'woocommerce_loop_add_to_cart_link', function ( $html, $product ) {
	return clima_pro_wa_button( clima_pro_product_message( $product ), 'Consultar por WhatsApp', 'btn-block' );
}, 99, 2 );

// Ficha de producto: quitar el formulario de compra y poner WhatsApp.
add_action( 'wp', function () {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary', function () {
		global $product;
		echo '<div class="single-wa">' . clima_pro_wa_button( clima_pro_product_message( $product ), 'Consultar por WhatsApp', 'btn-lg' ) . '<p class="single-wa__note">Te respondemos por WhatsApp con stock, envío y formas de entrega.</p></div>'; // phpcs:ignore
	}, 30 );
} );

// Redirigir carrito y checkout a la tienda.
add_action( 'template_redirect', function () {
	if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
		wp_safe_redirect( wc_get_page_permalink( 'shop' ) );
		exit;
	}
} );

// Sacar carrito/checkout de los menús.
add_filter( 'wp_nav_menu_objects', function ( $items ) {
	$hide = array_filter( array( wc_get_page_id( 'cart' ), wc_get_page_id( 'checkout' ) ), function ( $id ) {
		return $id > 0;
	} );
	return array_filter( $items, function ( $item ) use ( $hide ) {
		return ! in_array( (int) $item->object_id, $hide, true );
	} );
} );

// Sin mini carrito, fragments ni scripts de carrito (más rápido).
add_action( 'wp_enqueue_scripts', function () {
	wp_dequeue_script( 'wc-cart-fragments' );
	wp_dequeue_script( 'wc-add-to-cart' );
	wp_dequeue_script( 'wc-cart' );
	wp_dequeue_script( 'wc-checkout' );
}, 99 );

// Ocultar avisos de "agregado al carrito" y el texto de "Ver carrito".
add_filter( 'wc_add_to_cart_message_html', '__return_empty_string' );
add_filter( 'woocommerce_widget_cart_is_hidden', '__return_true' );

// Mostrar "Consultar precio" en productos sin precio.
add_filter( 'woocommerce_empty_price_html', function () {
	return '<span class="price price--ask">Consultar precio</span>';
} );
