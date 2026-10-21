<?php
/**
 * Configuración en un clic (Apariencia > Clima Pro).
 * Crea categorías, páginas, menú, portada y productos de muestra. Es idempotente:
 * se puede ejecutar varias veces sin duplicar nada.
 *
 * @package ClimaPro
 */
defined( 'ABSPATH' ) || exit;

/** Estructura de categorías y subcategorías. */
function clima_pro_category_tree() {
	return array(
		'insumos'           => array( 'Insumos', 'Compresores, piezas mecánicas, cables, electrónica y afines a climatización.', array(
			'compresores'              => 'Compresores',
			'piezas-mecanicas'         => 'Piezas mecánicas',
			'cables'                   => 'Cables',
			'electronica'              => 'Electrónica',
			'afines-a-climatizacion'   => 'Afines a climatización',
		) ),
		'herramientas'      => array( 'Herramientas', 'Herramientas afines a climatización.', array(
			'manometros'         => 'Manómetros',
			'bombas-de-vacio'    => 'Bombas de vacío',
			'recuperadores'      => 'Recuperadores',
			'herramientas-de-mano' => 'Herramientas de mano',
		) ),
		'electrodomesticos' => array( 'Electrodomésticos', 'Electrodomésticos nuevos de línea blanca y comercial.', array(
			'linea-blanca'    => 'Línea blanca',
			'linea-comercial' => 'Línea comercial',
		) ),
	);
}

/** Productos de muestra (mismos que sample-data/productos-muestra.csv). */
function clima_pro_sample_products() {
	return array(
		array( 'CP-INS-001', 'Compresor 1/4 HP R134a', 142500, 'compresores', 'Compresor hermético para heladeras familiares, gas R134a, 220 V.' ),
		array( 'CP-INS-002', 'Caño de cobre 1/4" (rollo 15 m)', 68900, 'afines-a-climatizacion', 'Caño de cobre recocido para refrigeración y aire acondicionado.' ),
		array( 'CP-INS-003', 'Termostato digital STC-1000', 32500, 'electronica', 'Controlador de temperatura digital con sensor NTC, 220 V.' ),
		array( 'CP-INS-004', 'Cable tipo taller 3x1,5 mm (rollo 10 m)', 21900, 'cables', 'Cable flexible para conexión de equipos.' ),
		array( 'CP-HER-001', 'Manómetro de 2 vías R410a', 92300, 'manometros', 'Juego de manómetros con mangueras para R410a, R32 y R22.' ),
		array( 'CP-HER-002', 'Bomba de vacío 2 etapas 1/4 HP', 215000, 'bombas-de-vacio', 'Bomba de vacío doble etapa, 5 CFM.' ),
		array( 'CP-ELE-001', 'Heladera con freezer 340 L', 865000, 'linea-blanca', 'Heladera no frost con freezer superior, eficiencia A.' ),
		array( 'CP-ELE-002', 'Exhibidora vertical 1 puerta 400 L', 1290000, 'linea-comercial', 'Exhibidora de bebidas con puerta de vidrio y luz LED.' ),
		array( 'CP-ELE-003', 'Lavarropas automático carga frontal 8 kg', 745000, 'linea-blanca', 'Lavarropas automático de carga frontal, 1200 rpm, 8 kg.' ),
		array( 'CP-ELE-004', 'Aire acondicionado split frío/calor 3000 frigorías', 980000, 'linea-blanca', 'Equipo split inverter frío/calor, gas R410a, con kit de instalación.' ),
		array( 'CP-INS-005', 'Placa electrónica universal para split', 58900, 'electronica', 'Placa de control universal para equipos split, con control remoto.' ),
	);
}

/** Foto (assets/img/products/*.jpg) de cada producto de muestra por SKU. */
function clima_pro_sample_images() {
	return array(
		'CP-INS-001' => 'compresor', 'CP-INS-002' => 'cobre', 'CP-INS-003' => 'termostato', 'CP-INS-004' => 'cables',
		'CP-INS-005' => 'placa', 'CP-HER-001' => 'manometro', 'CP-HER-002' => 'bomba', 'CP-ELE-001' => 'heladera',
		'CP-ELE-002' => 'exhibidora', 'CP-ELE-003' => 'lavarropas', 'CP-ELE-004' => 'split',
	);
}

/** Foto de cada categoría por slug. */
function clima_pro_category_images() {
	return array(
		'insumos' => 'compresor', 'compresores' => 'compresor', 'piezas-mecanicas' => 'compresor', 'cables' => 'cables',
		'electronica' => 'placa', 'afines-a-climatizacion' => 'cobre', 'herramientas' => 'manometro', 'manometros' => 'manometro',
		'bombas-de-vacio' => 'bomba', 'recuperadores' => 'bomba', 'herramientas-de-mano' => 'manometro',
		'electrodomesticos' => 'heladera', 'linea-blanca' => 'lavarropas', 'linea-comercial' => 'exhibidora',
	);
}

/**
 * Importa una foto del theme a la Biblioteca de medios (una sola vez) y devuelve su ID.
 *
 * @param string $name Nombre del archivo en assets/img/products sin extensión.
 * @return int
 */
function clima_pro_theme_attachment( $name ) {
	$map = get_option( 'clima_pro_media', array() );
	if ( ! empty( $map[ $name ] ) && get_post( $map[ $name ] ) ) {
		return (int) $map[ $name ];
	}
	$src = CLIMA_PRO_DIR . '/assets/img/products/' . $name . '.jpg';
	if ( ! file_exists( $src ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$tmp = wp_tempnam( $name . '.jpg' );
	copy( $src, $tmp );
	$id = media_handle_sideload( array( 'name' => 'clima-pro-' . $name . '.jpg', 'tmp_name' => $tmp ), 0, 'Clima Pro - ' . $name );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore
		return 0;
	}
	$map[ $name ] = $id;
	update_option( 'clima_pro_media', $map, false );
	return (int) $id;
}

/**
 * Ejecuta la configuración.
 *
 * @param bool $with_samples Crear productos de muestra.
 * @return array Log de acciones.
 */
function clima_pro_run_setup( $with_samples = false ) {
	$log = array();

	// 1) Categorías.
	if ( taxonomy_exists( 'product_cat' ) ) {
		foreach ( clima_pro_category_tree() as $slug => $cat ) {
			$parent = term_exists( $slug, 'product_cat' );
			if ( ! $parent ) {
				$parent = wp_insert_term( $cat[0], 'product_cat', array( 'slug' => $slug, 'description' => $cat[1] ) );
				$log[]  = 'Categoría creada: ' . $cat[0];
			}
			if ( is_wp_error( $parent ) ) {
				continue;
			}
			$pid = (int) $parent['term_id'];
			foreach ( $cat[2] as $sslug => $sname ) {
				if ( ! term_exists( $sslug, 'product_cat' ) ) {
					wp_insert_term( $sname, 'product_cat', array( 'slug' => $sslug, 'parent' => $pid ) );
					$log[] = 'Subcategoría creada: ' . $sname;
				}
			}
		}
	} else {
		$log[] = 'WooCommerce no está activo: no se crearon categorías.';
	}

	// 1b) Foto de cada categoría (solo si todavía no tiene una).
	if ( taxonomy_exists( 'product_cat' ) ) {
		foreach ( clima_pro_category_images() as $slug => $img ) {
			$t = get_term_by( 'slug', $slug, 'product_cat' );
			if ( $t && ! get_term_meta( $t->term_id, 'thumbnail_id', true ) ) {
				$aid = clima_pro_theme_attachment( $img );
				if ( $aid ) {
					update_term_meta( $t->term_id, 'thumbnail_id', $aid );
				}
			}
		}
		$log[] = 'Fotos de categorías asignadas.';
	}

	// 2) Páginas.
	$pages = array(
		'inicio'    => array( 'Inicio', '' ),
		'servicios' => array( 'Servicios', 'page-templates/template-servicios.php' ),
		'contacto'  => array( 'Contacto', 'page-templates/template-contacto.php' ),
	);
	$ids = array();
	foreach ( $pages as $slug => $p ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$id    = wp_insert_post( array( 'post_title' => $p[0], 'post_name' => $slug, 'post_type' => 'page', 'post_status' => 'publish' ) );
			$log[] = 'Página creada: ' . $p[0];
		} else {
			$id = $page->ID;
		}
		if ( $p[1] ) {
			update_post_meta( $id, '_wp_page_template', $p[1] );
		}
		$ids[ $slug ] = $id;
	}

	// 3) Portada estática.
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $ids['inicio'] );

	// 4) Menú principal con exactamente 5 ítems.
	$menu_name = 'Menú principal Clima Pro';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? $menu->term_id : wp_create_nav_menu( $menu_name );
	if ( ! is_wp_error( $menu_id ) ) {
		foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
			wp_delete_post( $item->ID, true ); // Rearmar limpio = idempotente.
		}
		$order = 1;
		$add_tax = function ( $slug ) use ( $menu_id, &$order ) {
			$t = get_term_by( 'slug', $slug, 'product_cat' );
			if ( $t ) {
				wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-object-id' => $t->term_id, 'menu-item-object' => 'product_cat', 'menu-item-type' => 'taxonomy', 'menu-item-status' => 'publish', 'menu-item-position' => $order++ ) );
			}
		};
		$add_page = function ( $id ) use ( $menu_id, &$order ) {
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-object-id' => $id, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-position' => $order++ ) );
		};
		$add_tax( 'insumos' );
		$add_page( $ids['servicios'] );
		$add_tax( 'herramientas' );
		$add_tax( 'electrodomesticos' );
		$add_page( $ids['contacto'] );
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		$locations['footer']  = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
		$log[] = 'Menú principal armado con 5 secciones.';
	}

	// 5) WooCommerce: catálogo.
	if ( class_exists( 'WooCommerce' ) ) {
		update_option( 'woocommerce_enable_ajax_add_to_cart', 'no' );
		update_option( 'woocommerce_cart_redirect_after_add', 'no' );
		update_option( 'woocommerce_enable_reviews', 'no' );
		update_option( 'woocommerce_currency', get_option( 'woocommerce_currency', 'ARS' ) ? get_option( 'woocommerce_currency' ) : 'ARS' );
		update_option( 'woocommerce_price_thousand_sep', '.' );
		update_option( 'woocommerce_price_decimal_sep', ',' );
		update_option( 'woocommerce_price_num_decimals', '0' );
	}

	// 6) Productos de muestra.
	if ( $with_samples && class_exists( 'WC_Product_Simple' ) ) {
		foreach ( clima_pro_sample_products() as $sp ) {
			$existing = wc_get_product_id_by_sku( $sp[0] );
			if ( $existing ) {
				// Ya existe: solo completar la foto si le falta.
				$imgs = clima_pro_sample_images();
				$ep   = wc_get_product( $existing );
				if ( $ep && ! $ep->get_image_id() && isset( $imgs[ $sp[0] ] ) ) {
					$ep->set_image_id( clima_pro_theme_attachment( $imgs[ $sp[0] ] ) );
					$ep->save();
				}
				continue;
			}
			$t = get_term_by( 'slug', $sp[3], 'product_cat' );
			$p = new WC_Product_Simple();
			$p->set_name( $sp[1] );
			$p->set_sku( $sp[0] );
			$p->set_regular_price( (string) $sp[2] );
			$p->set_description( $sp[4] );
			$p->set_short_description( $sp[4] );
			$p->set_featured( true );
			$p->set_stock_status( 'instock' );
			$imgs = clima_pro_sample_images();
			if ( isset( $imgs[ $sp[0] ] ) ) {
				$p->set_image_id( clima_pro_theme_attachment( $imgs[ $sp[0] ] ) );
			}
			if ( $t ) {
				$p->set_category_ids( array( $t->term_id ) );
			}
			$p->save();
			$log[] = 'Producto de muestra creado: ' . $sp[1];
		}
	}

	// 7) Primera vez: vaciar los widgets de ejemplo de WordPress que caen en "Filtros de la tienda"
	// (así se usan los filtros propios por categoría y precio).
	if ( ! get_option( 'clima_pro_setup_done' ) ) {
		$sw = get_option( 'sidebars_widgets', array() );
		if ( ! empty( $sw['shop-sidebar'] ) ) {
			$sw['wp_inactive_widgets'] = array_merge( isset( $sw['wp_inactive_widgets'] ) ? (array) $sw['wp_inactive_widgets'] : array(), (array) $sw['shop-sidebar'] );
			$sw['shop-sidebar']        = array();
			update_option( 'sidebars_widgets', $sw );
			$log[] = 'Widgets de ejemplo movidos a inactivos.';
		}
	}

	flush_rewrite_rules();
	update_option( 'clima_pro_setup_done', time() );
	return $log;
}

// Al activar el theme: configuración base (sin productos de muestra).
add_action( 'after_switch_theme', function () {
	clima_pro_run_setup( false );
} );

// Página Apariencia > Clima Pro.
add_action( 'admin_menu', function () {
	add_theme_page( 'Clima Pro', 'Clima Pro', 'manage_options', 'clima-pro-setup', 'clima_pro_setup_page' );
} );

/** Render de la página de configuración. */
function clima_pro_setup_page() {
	$log = array();
	if ( isset( $_POST['clima_pro_setup'] ) && check_admin_referer( 'clima_pro_setup' ) ) {
		$log = clima_pro_run_setup( ! empty( $_POST['with_samples'] ) );
	}
	?>
	<div class="wrap">
		<h1>Clima Pro · Configuración en un clic</h1>
		<?php if ( ! class_exists( 'WooCommerce' ) ) : ?>
			<div class="notice notice-warning"><p>Instalá y activá <strong>WooCommerce</strong> antes de ejecutar la configuración para que se creen las categorías.</p></div>
		<?php endif; ?>
		<p>Crea (sin duplicar) las categorías y subcategorías, las páginas Servicios y Contacto, la portada, el menú con las 5 secciones y ajusta WooCommerce en modo catálogo.</p>
		<form method="post">
			<?php wp_nonce_field( 'clima_pro_setup' ); ?>
			<p><label><input type="checkbox" name="with_samples" value="1"> Crear también 11 productos de muestra (con fotos)</label></p>
			<p><button class="button button-primary button-hero" name="clima_pro_setup" value="1">Ejecutar configuración</button></p>
		</form>
		<?php if ( $log ) : ?>
			<div class="notice notice-success"><p><strong>¡Listo!</strong></p><ul style="list-style:disc;margin-left:20px">
			<?php foreach ( $log as $l ) { echo '<li>' . esc_html( $l ) . '</li>'; } ?>
			</ul></div>
		<?php endif; ?>
		<h2>Accesos rápidos</h2>
		<p><a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=clima_pro' ) ); ?>">Configurar WhatsApp y contacto</a>
		<a class="button" href="<?php echo esc_url( admin_url( 'edit.php?post_type=product&page=product_importer' ) ); ?>">Importar productos (CSV)</a>
		<a class="button" href="<?php echo esc_url( admin_url( 'edit-tags.php?taxonomy=product_cat&post_type=product' ) ); ?>">Categorías</a></p>
	</div>
	<?php
}
