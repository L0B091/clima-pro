<?php
/**
 * Portada de Clima Pro (sigue el diseño de referencia).
 *
 * @package ClimaPro
 */
get_header();
?>
<section class="hero">
	<div class="hero__bg" aria-hidden="true"><img src="<?php echo clima_pro_img( 'hero.svg' ); ?>" alt="" width="1440" height="560" fetchpriority="high"></div>
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
		array( 'Insumos', 'Compresores, piezas, cables, electrónica', clima_pro_cat_url( 'insumos' ), 'cat-insumos.svg' ),
		array( 'Servicios', 'Instalación y reparación', clima_pro_page_url( 'servicios' ), 'cat-servicios.svg' ),
		array( 'Herramientas', 'Manómetros, bombas, recuperadores', clima_pro_cat_url( 'herramientas' ), 'cat-herramientas.svg' ),
		array( 'Electrodomésticos', 'Línea blanca y comercial', clima_pro_cat_url( 'electrodomesticos' ), 'cat-electrodomesticos.svg' ),
		array( 'Contacto', 'Escribinos o visitanos', clima_pro_page_url( 'contacto' ), 'cat-contacto.svg' ),
	);
	foreach ( $cards as $i => $c ) :
		?>
		<a class="cat-card reveal" style="--d:<?php echo (int) $i; ?>" href="<?php echo esc_url( $c[2] ); ?>">
			<img src="<?php echo clima_pro_img( $c[3] ); ?>" alt="" width="200" height="140" loading="lazy">
			<strong><?php echo esc_html( $c[0] ); ?></strong>
			<span><?php echo esc_html( $c[1] ); ?> <b aria-hidden="true">→</b></span>
		</a>
	<?php endforeach; ?>
</section>

<section class="container promos">
	<div class="promo promo--dark reveal">
		<img src="<?php echo clima_pro_img( 'banner-servicio.svg' ); ?>" alt="" width="320" height="260" loading="lazy">
		<div>
			<p class="eyebrow">Servicio técnico</p>
			<h2>Tu equipo en buenas manos</h2>
			<p>Instalación y reparación de aires acondicionados, heladeras familiares y comerciales y lavarropas automáticos.</p>
			<?php echo clima_pro_wa_button( 'Hola, quiero pedir un presupuesto de servicio técnico.', 'Pedir presupuesto', 'btn-accent' ); // phpcs:ignore ?>
		</div>
	</div>
	<div class="promo promo--light reveal">
		<img src="<?php echo clima_pro_img( 'banner-insumos.svg' ); ?>" alt="" width="320" height="260" loading="lazy">
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
