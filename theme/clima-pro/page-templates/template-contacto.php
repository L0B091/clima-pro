<?php
/**
 * Template Name: Contacto
 * Datos de contacto (sin formulario) configurables en el Personalizador.
 *
 * @package ClimaPro
 */
get_header();
$map = clima_pro_opt( 'clima_map_embed' );
?>
<section class="page-hero">
	<div class="container">
		<p class="eyebrow">Estamos para ayudarte</p>
		<h1>Contacto</h1>
		<p class="page-hero__desc">La forma más rápida de hablar con nosotros es por WhatsApp.</p>
	</div>
</section>
<div class="container section contact">
	<div class="contact__wa reveal">
		<h2>Escribinos por WhatsApp</h2>
		<p>Consultas de productos, presupuestos de servicio técnico y coordinación de entregas.</p>
		<?php echo clima_pro_wa_button( 'Hola, quiero hacer una consulta.', 'Abrir WhatsApp', 'btn-lg' ); // phpcs:ignore ?>
	</div>
	<ul class="contact__list">
		<li class="reveal"><?php echo clima_pro_icon( 'phone' ); // phpcs:ignore ?><div><strong>Teléfono</strong><a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', clima_pro_opt( 'clima_phone' ) ) ); ?>"><?php echo esc_html( clima_pro_opt( 'clima_phone' ) ); ?></a></div></li>
		<li class="reveal"><?php echo clima_pro_icon( 'mail' ); // phpcs:ignore ?><div><strong>Email</strong><a href="mailto:<?php echo esc_attr( antispambot( clima_pro_opt( 'clima_email' ) ) ); ?>"><?php echo esc_html( antispambot( clima_pro_opt( 'clima_email' ) ) ); ?></a></div></li>
		<li class="reveal"><?php echo clima_pro_icon( 'pin' ); // phpcs:ignore ?><div><strong>Dirección</strong><span><?php echo esc_html( clima_pro_opt( 'clima_address' ) ); ?></span></div></li>
		<li class="reveal"><?php echo clima_pro_icon( 'clock' ); // phpcs:ignore ?><div><strong>Horarios</strong><span><?php echo esc_html( clima_pro_opt( 'clima_hours' ) ); ?></span></div></li>
	</ul>
	<?php if ( $map ) : ?>
		<div class="contact__map reveal"><iframe src="<?php echo esc_url( $map ); ?>" title="Mapa de Clima Pro" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
	<?php endif; ?>
</div>
<?php get_footer();
