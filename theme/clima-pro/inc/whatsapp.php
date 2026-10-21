<?php
/**
 * WhatsApp: generación de links, botón por producto y shortcode.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

/**
 * Arma un link wa.me con el mensaje codificado.
 *
 * @param string $message Mensaje prellenado.
 * @return string
 */
function clima_pro_wa_url( $message = '' ) {
	$number = preg_replace( '/\D+/', '', clima_pro_opt( 'clima_whatsapp_number' ) );
	$url    = 'https://wa.me/' . $number;
	if ( '' !== $message ) {
		$url .= '?text=' . rawurlencode( $message );
	}
	return $url;
}

/**
 * Mensaje para un producto: "Hola, me interesa el producto: X - Precio: $ Y".
 *
 * @param WC_Product|int $product Producto.
 * @return string
 */
function clima_pro_product_message( $product ) {
	if ( ! is_object( $product ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product );
	}
	if ( ! $product ) {
		return 'Hola, quiero hacer una consulta.';
	}
	$price = $product->get_price();
	$price = ( '' !== $price && null !== $price )
		? html_entity_decode( wp_strip_all_tags( wc_price( wc_get_price_to_display( $product ) ) ), ENT_QUOTES, 'UTF-8' )
		: 'a consultar';
	return sprintf( 'Hola, me interesa el producto: %s - Precio: %s', $product->get_name(), $price );
}

/** Ícono de WhatsApp en SVG inline. */
function clima_pro_wa_icon() {
	return '<svg class="icon-wa" viewBox="0 0 32 32" width="20" height="20" aria-hidden="true" focusable="false"><path fill="currentColor" d="M16 3C9 3 3.3 8.7 3.3 15.7c0 2.2.6 4.4 1.7 6.3L3 29l7.2-1.9c1.8 1 3.8 1.5 5.8 1.5 7 0 12.7-5.7 12.7-12.7S23 3 16 3zm0 23.2c-1.9 0-3.7-.5-5.3-1.5l-.4-.2-4.3 1.1 1.1-4.2-.3-.4a10.5 10.5 0 1 1 9.2 5.2zm5.8-7.9c-.3-.2-1.9-.9-2.2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.4-.5-2.6-1.6-1-.9-1.6-1.9-1.8-2.2-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.4.3-.6.1-.2 0-.4 0-.6l-1-2.4c-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.8s1.2 3.2 1.4 3.5c.2.2 2.4 3.6 5.7 5 .8.4 1.4.6 1.9.7.8.3 1.5.2 2.1.1.6-.1 1.9-.8 2.2-1.5.3-.7.3-1.4.2-1.5-.1-.2-.3-.3-.7-.4z"/></svg>';
}

/**
 * HTML del botón de WhatsApp.
 *
 * @param string $message Mensaje.
 * @param string $label   Texto del botón.
 * @param string $class   Clases extra.
 * @return string
 */
function clima_pro_wa_button( $message, $label = 'Consultar por WhatsApp', $class = '' ) {
	return sprintf(
		'<a class="btn btn-wa %1$s" href="%2$s" target="_blank" rel="noopener nofollow">%3$s<span>%4$s</span></a>',
		esc_attr( $class ),
		esc_url( clima_pro_wa_url( $message ) ),
		clima_pro_wa_icon(),
		esc_html( $label )
	);
}

/**
 * Shortcode [clima_whatsapp_button]
 * Atributos: product_id, message, label, class.
 * Ej: [clima_whatsapp_button product_id="123"] o [clima_whatsapp_button message="Hola, quiero un presupuesto" label="Pedir presupuesto"]
 */
add_shortcode( 'clima_whatsapp_button', function ( $atts ) {
	$atts = shortcode_atts( array( 'product_id' => 0, 'message' => '', 'label' => 'Consultar por WhatsApp', 'class' => '' ), $atts, 'clima_whatsapp_button' );
	$message = $atts['message'];
	if ( '' === $message ) {
		$pid = absint( $atts['product_id'] );
		if ( ! $pid && function_exists( 'is_product' ) && is_product() ) {
			$pid = get_the_ID();
		}
		$message = ( $pid && function_exists( 'wc_get_product' ) ) ? clima_pro_product_message( $pid ) : 'Hola, quiero hacer una consulta.';
	}
	return clima_pro_wa_button( $message, $atts['label'], $atts['class'] );
} );

/** Botón flotante de WhatsApp con pulso. */
add_action( 'wp_footer', function () {
	printf(
		'<a class="wa-float" href="%s" target="_blank" rel="noopener nofollow" aria-label="%s">%s</a>',
		esc_url( clima_pro_wa_url( 'Hola, quiero hacer una consulta.' ) ),
		esc_attr__( 'Escribinos por WhatsApp', 'clima-pro' ),
		clima_pro_wa_icon() // phpcs:ignore
	);
} );
