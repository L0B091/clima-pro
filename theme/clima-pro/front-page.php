<?php
/**
 * Portada de Clima Pro (sigue el diseño de referencia).
 *
 * @package ClimaPro
 */
get_header();
?>
<section class="hero">
	<div class="hero__bg" aria-hidden="true"><img src="<?php echo clima_pro_img( 'hero.webp' ); ?>" alt="Técnico de Clima Pro revisando un aire acondicionado con manómetros" width="1024" height="576" fetchpriority="high"></div>
	<div class="container hero__inner">
		<div class="hero__content reveal">
			<p class="eyebrow">Tu aliado en climatización</p>
			<h1>Servicio técnico <span>e insumos de calidad</span></h1>
			<p class="hero__lead">Insumos, herramientas y electrodomésticos nuevos. Instalación y reparación de aires acondicionados, heladeras y lavarropas.</p>
			<ul class="trust">
				<li><?php echo clima_pro_icon( 'shield' ); // phpcs:ignore ?>Técnicos<br>especializados</li>
				<li><?php echo clima_pro_icon( 'truck' ); // phpcs:ignore ?>Atención rápida<br>y confiable</li>
				<li><?php echo clima_pro_icon( 'check' ); // phpcs:ignore ?>Productos originales<br>y garantizados</li>
			</ul>
			<?php echo clima_pro_wa_button( 'Hola, quiero hacer una consulta.', 'Consultar por WhatsApp', 'btn-accent btn-lg' ); // phpcs:ignore ?>
		</div>
		<aside class="hero__side reveal">
			<h2>Más que repuestos, <span>soluciones</span></h2>
			<ul>
				<li><a href="<?php echo esc_url( clima_pro_cat_url( 'insumos' ) ); ?>"><?php echo clima_pro_icon( 'snowflake' ); // phpcs:ignore ?>Insumos</a></li>
				<li><a href="<?php echo esc_url( clima_pro_page_url( 'servicios' ) ); ?>"><?php echo clima_pro_icon( 'tools' ); // phpcs:ignore ?>Servicios</a></li>
				<li><a href="<?php echo esc_url( clima_pro_cat_url( 'herramientas' ) ); ?>"><?php echo clima_pro_icon( 'gauge' ); // phpcs:ignore ?>Herramientas</a></li>
				<li><a href="<?php echo esc_url( clima_pro_cat_url( 'electrodomesticos' ) ); ?>"><?php echo clima_pro_icon( 'fridge' ); // phpcs:ignore ?>Electrodomésticos</a></li>
			</ul>
		</aside>
	</div>
</section>

<section class="container section cat-cards" aria-label="Secciones">
	<?php
	$cards = array(
		array( 'Insumos', 'Compresores, piezas, cables, electrónica', clima_pro_cat_url( 'insumos' ), 'products/compresor.webp' ),
		array( 'Servicios', 'Instalación y reparación', clima_pro_page_url( 'servicios' ), 'products/split.webp' ),
		array( 'Herramientas', 'Manómetros, bombas, recuperadores', clima_pro_cat_url( 'herramientas' ), 'products/manometro.webp' ),
		array( 'Electrodomésticos', 'Línea blanca y comercial', clima_pro_cat_url( 'electrodomesticos' ), 'products/heladera.webp' ),
		array( 'Contacto', 'Escribinos o visitanos', clima_pro_page_url( 'contacto' ), '' ),
	);
	foreach ( $cards as $i => $c ) :
		?>
		<a class="cat-card reveal" style="--d:<?php echo (int) $i; ?>" href="<?php echo esc_url( $c[2] ); ?>">
			<?php if ( $c[3] ) : ?>
				<img src="<?php echo clima_pro_img( $c[3] ); ?>" alt="" width="400" height="400" loading="lazy">
			<?php else : ?>
				<span class="cat-card__wa"><?php echo clima_pro_wa_icon(); // phpcs:ignore ?></span>
			<?php endif; ?>
			<strong><?php echo esc_html( $c[0] ); ?></strong>
			<span><?php echo esc_html( $c[1] ); ?> <b aria-hidden="true">→</b></span>
		</a>
	<?php endforeach; ?>
</section>

<section class="container promos">
	<div class="promo promo--dark reveal">
		<img src="<?php echo clima_pro_img( 'banner-servicio.webp' ); ?>" alt="Técnico reparando una heladera comercial" width="800" height="600" loading="lazy">
		<div>
			<p class="eyebrow">Servicio técnico</p>
			<h2>Tu equipo en buenas manos</h2>
			<p>Instalación y reparación de aires acondicionados, heladeras familiares y comerciales y lavarropas automáticos.</p>
			<?php echo clima_pro_wa_button( 'Hola, quiero pedir un presupuesto de servicio técnico.', 'Pedir presupuesto', 'btn-accent' ); // phpcs:ignore ?>
		</div>
	</div>
	<div class="promo promo--light reveal">
		<img src="<?php echo clima_pro_img( 'banner-insumos.webp' ); ?>" alt="Compresor, caños de cobre, manómetros y bomba de vacío" width="800" height="600" loading="lazy">
		<div>
			<p class="eyebrow">Insumos y herramientas</p>
			<h2>Todo lo que necesitás en un solo lugar</h2>
			<p>Stock de insumos, herramientas y electrodomésticos para profesionales y particulares.</p>
			<a class="btn btn-accent" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '#' ); ?>">Ver catálogo →</a>
		</div>
	</div>
</section>

<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<section class="container section featured">
	<div class="section-head">
		<h2>Productos destacados</h2>
		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Ver todos →</a>
	</div>
	<?php echo do_shortcode( '[products limit="5" columns="5" visibility="featured"]' ); // phpcs:ignore ?>
</section>
<?php endif; ?>

<?php
// Contenido opcional cargado en la página Inicio desde el editor.
while ( have_posts() ) :
	the_post();
	if ( get_the_content() ) {
		echo '<div class="container section entry-content">';
		the_content();
		echo '</div>';
	}
endwhile;
get_footer();
