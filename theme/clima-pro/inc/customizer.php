<?php
/**
 * Opciones del Personalizador: Apariencia > Personalizar > Clima Pro.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

/**
 * Valores por defecto de las opciones.
 */
function clima_pro_defaults() {
	return array(
		'clima_whatsapp_number' => '5491100000000',
		'clima_whatsapp_label'  => 'Consultas y presupuestos',
		'clima_phone'           => '+54 9 11 0000-0000',
		'clima_email'           => 'contacto@climapro.com.ar',
		'clima_address'         => 'Buenos Aires, Argentina',
		'clima_hours'           => 'Lunes a viernes de 8 a 18 h · Sábados de 9 a 13 h',
		'clima_map_embed'       => '',
		'clima_facebook'        => '',
		'clima_instagram'       => '',
		'clima_youtube'         => '',
		'clima_tagline'         => 'Insumos, herramientas y servicio técnico',
	);
}

/**
 * Lee una opción del theme con su valor por defecto.
 *
 * @param string $key Clave.
 * @return string
 */
function clima_pro_opt( $key ) {
	$d = clima_pro_defaults();
	return get_theme_mod( $key, isset( $d[ $key ] ) ? $d[ $key ] : '' );
}

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_panel( 'clima_pro', array( 'title' => 'Clima Pro', 'priority' => 30 ) );

	$sections = array(
		'clima_pro_whatsapp' => 'WhatsApp',
		'clima_pro_contact'  => 'Datos de contacto',
		'clima_pro_social'   => 'Redes sociales',
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( $id, array( 'title' => $title, 'panel' => 'clima_pro' ) );
	}

	$fields = array(
		'clima_whatsapp_number' => array( 'clima_pro_whatsapp', 'Número de WhatsApp (formato internacional, solo números, ej: 5491123456789)', 'text' ),
		'clima_whatsapp_label'  => array( 'clima_pro_whatsapp', 'Texto bajo "WhatsApp" en el encabezado', 'text' ),
		'clima_tagline'         => array( 'clima_pro_contact', 'Bajada de la marca (debajo del logo)', 'text' ),
		'clima_phone'           => array( 'clima_pro_contact', 'Teléfono', 'text' ),
		'clima_email'           => array( 'clima_pro_contact', 'Email', 'email' ),
		'clima_address'         => array( 'clima_pro_contact', 'Dirección', 'text' ),
		'clima_hours'           => array( 'clima_pro_contact', 'Horarios de atención', 'text' ),
		'clima_map_embed'       => array( 'clima_pro_contact', 'URL del mapa (Google Maps > Compartir > Insertar mapa > copiar solo el src)', 'url' ),
		'clima_facebook'        => array( 'clima_pro_social', 'Facebook (URL)', 'url' ),
		'clima_instagram'       => array( 'clima_pro_social', 'Instagram (URL)', 'url' ),
		'clima_youtube'         => array( 'clima_pro_social', 'YouTube (URL)', 'url' ),
	);
	$defaults = clima_pro_defaults();
	foreach ( $fields as $key => $f ) {
		$sanitize = 'sanitize_text_field';
		if ( 'url' === $f[2] ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'email' === $f[2] ) {
			$sanitize = 'sanitize_email';
		} elseif ( 'clima_whatsapp_number' === $key ) {
			$sanitize = function ( $v ) {
				return preg_replace( '/\D+/', '', (string) $v );
			};
		}
		$wp_customize->add_setting( $key, array( 'default' => $defaults[ $key ], 'sanitize_callback' => $sanitize ) );
		$wp_customize->add_control( $key, array( 'label' => $f[1], 'section' => $f[0], 'type' => $f[2] ) );
	}
} );
