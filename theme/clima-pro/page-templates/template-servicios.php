<?php
/**
 * Template Name: Servicios
 * Tarjetas de servicios con botón "Pedir presupuesto" por WhatsApp.
 *
 * @package ClimaPro
 */
get_header(); ?>
<section class="page-hero">
	<div class="container">
		<p class="eyebrow">Servicio técnico</p>
		<h1>Servicios</h1>
		<p class="page-hero__desc">Instalación y reparación con técnicos especializados. Pedí tu presupuesto por WhatsApp.</p>
	</div>
</section>
<div class="container section services">
	<?php foreach ( clima_pro_services() as $i => $s ) : ?>
		<article class="service-card reveal" style="--d:<?php echo (int) $i; ?>">
			<div class="service-card__icon"><?php echo clima_pro_icon( $s['icon'] ); // phpcs:ignore ?></div>
			<h2><?php echo esc_html( $s['title'] ); ?></h2>
			<p><?php echo esc_html( $s['desc'] ); ?></p>
			<ul class="service-card__list">
				<?php foreach ( $s['items'] as $it ) : ?><li><?php echo esc_html( $it ); ?></li><?php endforeach; ?>
			</ul>
			<?php echo clima_pro_wa_button( 'Hola, quiero pedir un presupuesto de: ' . $s['title'] . ' (' . implode( ', ', $s['items'] ) . ')', 'Pedir presupuesto', 'btn-block' ); // phpcs:ignore ?>
		</article>
	<?php endforeach; ?>
</div>
<?php
while ( have_posts() ) :
	the_post();
	if ( get_the_content() ) {
		echo '<div class="container section entry-content">';
		the_content();
		echo '</div>';
	}
endwhile;
get_footer();
