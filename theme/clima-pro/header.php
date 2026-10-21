<?php
/**
 * Encabezado: barra azul con logo, buscador de productos y WhatsApp + menú de 5 secciones.
 *
 * @package ClimaPro
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0b2d5c">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Saltar al contenido</a>
<header class="site-header">
	<div class="header-top">
		<div class="container header-top__inner">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Clima Pro - Inicio">
				<?php if ( has_custom_logo() ) : ?>
					<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'brand__img', 'loading' => 'eager' ) ); ?>
				<?php else : ?>
					<img class="brand__img" src="<?php echo clima_pro_img( 'logo-clima-pro.svg' ); ?>" alt="Clima Pro" width="220" height="56">
				<?php endif; ?>
				<span class="brand__tagline"><?php echo esc_html( clima_pro_opt( 'clima_tagline' ) ); ?></span>
			</a>
			<form class="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="hs">Buscar productos</label>
				<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="none" stroke="currentColor" stroke-width="2" d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15zm5.5-2 5 5"/></svg>
				<input id="hs" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Buscar insumos, herramientas, electrodomésticos…">
				<input type="hidden" name="post_type" value="product">
				<button type="submit" class="btn btn-accent">Buscar</button>
			</form>
			<a class="header-wa" href="<?php echo esc_url( clima_pro_wa_url( 'Hola, quiero hacer una consulta.' ) ); ?>" target="_blank" rel="noopener">
				<span class="header-wa__icon"><?php echo clima_pro_wa_icon(); // phpcs:ignore ?></span>
				<span><strong>WhatsApp</strong><small><?php echo esc_html( clima_pro_opt( 'clima_whatsapp_label' ) ); ?></small></span>
			</a>
			<button class="nav-toggle" aria-controls="primary-nav" aria-expanded="false"><span></span><span></span><span></span><span class="screen-reader-text">Menú</span></button>
		</div>
	</div>
	<nav id="primary-nav" class="main-nav" aria-label="Principal">
		<div class="container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'depth'          => 1,
				'fallback_cb'    => 'clima_pro_fallback_menu',
			) );
			?>
		</div>
	</nav>
</header>
<main id="main" class="site-main">
