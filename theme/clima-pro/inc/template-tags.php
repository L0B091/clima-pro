<?php
/**
 * Helpers de plantillas: íconos SVG, URLs de secciones.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

/**
 * Devuelve un ícono SVG inline de assets/img/icons.
 *
 * @param string $name Nombre del archivo sin extensión.
 * @return string
 */
function clima_pro_icon( $name ) {
	$file = CLIMA_PRO_DIR . '/assets/img/icons/' . sanitize_file_name( $name ) . '.svg';
	return file_exists( $file ) ? file_get_contents( $file ) : ''; // phpcs:ignore
}

/** URL de imagen del theme. */
function clima_pro_img( $file ) {
	return esc_url( CLIMA_PRO_URI . '/assets/img/' . $file );
}

/**
 * Link a una categoría por slug (con fallback a la tienda).
 *
 * @param string $slug Slug.
 * @return string
 */
function clima_pro_cat_url( $slug ) {
	if ( taxonomy_exists( 'product_cat' ) ) {
		$t = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $t ) {
			return get_term_link( $t );
		}
	}
	return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
}

/** Link a una página por slug. */
function clima_pro_page_url( $slug ) {
	$p = get_page_by_path( $slug );
	return $p ? get_permalink( $p ) : home_url( '/' . $slug . '/' );
}

/** Menú de respaldo con las 5 secciones (si todavía no se ejecutó la configuración). */
function clima_pro_fallback_menu() {
	$items = array(
		'Insumos'           => clima_pro_cat_url( 'insumos' ),
		'Servicios'         => clima_pro_page_url( 'servicios' ),
		'Herramientas'      => clima_pro_cat_url( 'herramientas' ),
		'Electrodomésticos' => clima_pro_cat_url( 'electrodomesticos' ),
		'Contacto'          => clima_pro_page_url( 'contacto' ),
	);
	echo '<ul id="primary-menu" class="menu">';
	foreach ( $items as $label => $url ) {
		printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/** Datos de los servicios (usados en Inicio y en la página Servicios). */
function clima_pro_services() {
	return array(
		array(
			'icon'  => 'snowflake',
			'photo' => 'services/aire.webp',
			'title' => 'Aire acondicionado',
			'desc'  => 'Instalación y reparación de equipos split, ventana y centrales. Carga de gas, limpieza y mantenimiento.',
			'items' => array( 'Instalación', 'Reparación' ),
		),
		array(
			'icon'  => 'fridge',
			'photo' => 'services/heladera.webp',
			'title' => 'Heladera familiar y comercial',
			'desc'  => 'Instalación y reparación de heladeras, freezers, exhibidoras y cámaras.',
			'items' => array( 'Instalación', 'Reparación' ),
		),
		array(
			'icon'  => 'washer',
			'photo' => 'services/lavarropas.webp',
			'title' => 'Lavarropas automático',
			'desc'  => 'Instalación y reparación de lavarropas automáticos de carga frontal y superior.',
			'items' => array( 'Instalación', 'Reparación' ),
		),
		array(
			'icon'  => 'home',
			'photo' => 'services/hogar.webp',
			'title' => 'Hogar',
			'desc'  => 'Soluciones para tu casa o local, con personal de confianza.',
			'items' => array( 'Cerrajería', 'Construcción en general', 'Durlock y pintura', 'Plomería', 'Electricidad' ),
		),
	);
}
