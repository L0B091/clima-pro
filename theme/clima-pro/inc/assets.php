<?php
/**
 * Encolado de estilos y scripts (livianos, sin jQuery propio).
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'clima-pro-main', CLIMA_PRO_URI . '/assets/css/main.css', array(), CLIMA_PRO_VERSION );
	wp_enqueue_script( 'clima-pro-main', CLIMA_PRO_URI . '/assets/js/main.js', array(), CLIMA_PRO_VERSION, true );
	// Estilos de bloques que no usamos.
	if ( ! is_singular( 'post' ) ) {
		wp_dequeue_style( 'wc-blocks-style' );
	}
}, 20 );

/** Precarga de la fuente del sistema: no usamos fuentes externas (más rápido). */
add_filter( 'wp_resource_hints', function ( $urls ) {
	return $urls;
}, 10 );

/** Favicon de Clima Pro si no se cargó un ícono del sitio. */
add_action( 'wp_head', function () {
	if ( ! has_site_icon() ) {
		echo '<link rel="icon" href="' . esc_url( CLIMA_PRO_URI . '/assets/img/favicon.svg' ) . '" type="image/svg+xml">' . "\n";
	}
} );
