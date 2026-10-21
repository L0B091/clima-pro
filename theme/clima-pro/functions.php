<?php
/**
 * Clima Pro - functions.php
 * Carga los módulos del theme. Cada archivo de inc/ tiene una responsabilidad.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

define( 'CLIMA_PRO_VERSION', '1.0.0' );
define( 'CLIMA_PRO_DIR', get_template_directory() );
define( 'CLIMA_PRO_URI', get_template_directory_uri() );

require CLIMA_PRO_DIR . '/inc/theme-setup.php';   // Soportes, menús, sidebars.
require CLIMA_PRO_DIR . '/inc/assets.php';        // CSS / JS.
require CLIMA_PRO_DIR . '/inc/customizer.php';    // WhatsApp, contacto, redes.
require CLIMA_PRO_DIR . '/inc/whatsapp.php';      // Links, botón y shortcode.
require CLIMA_PRO_DIR . '/inc/template-tags.php'; // Helpers de plantillas e íconos.
require CLIMA_PRO_DIR . '/inc/one-click-setup.php'; // Configuración en un clic.

if ( class_exists( 'WooCommerce' ) ) {
	require CLIMA_PRO_DIR . '/inc/catalog-mode.php'; // Sin carrito ni checkout.
	require CLIMA_PRO_DIR . '/inc/woocommerce.php';  // Ajustes de tienda/escala.
}
