<?php
/**
 * Configuración base del theme.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'clima-pro', CLIMA_PRO_DIR . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 220, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'responsive-embeds' );
	// WooCommerce.
	add_theme_support( 'woocommerce', array( 'thumbnail_image_width' => 400, 'single_image_width' => 700 ) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( 'Menú principal', 'clima-pro' ),
		'footer'  => __( 'Menú del pie', 'clima-pro' ),
	) );
} );

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Filtros de la tienda', 'clima-pro' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'Filtros por categoría y precio en las páginas de productos.', 'clima-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
} );

/** Ancho de contenido. */
$GLOBALS['content_width'] = 1240;
