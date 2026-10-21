<?php
/**
 * Franja de beneficios + pie azul.
 *
 * @package ClimaPro
 */
?>
</main>
<section class="benefits" aria-label="Beneficios">
	<div class="container benefits__grid">
		<div class="benefit reveal"><?php echo clima_pro_icon( 'truck' ); // phpcs:ignore ?><div><strong>Envíos a todo el país</strong><span>Coordinamos la entrega por WhatsApp</span></div></div>
		<div class="benefit reveal"><?php echo clima_pro_icon( 'shield' ); // phpcs:ignore ?><div><strong>Productos garantizados</strong><span>Originales y con garantía</span></div></div>
		<div class="benefit reveal"><?php echo clima_pro_icon( 'tools' ); // phpcs:ignore ?><div><strong>Técnicos especializados</strong><span>Instalación y reparación</span></div></div>
		<div class="benefit reveal"><?php echo clima_pro_icon( 'headset' ); // phpcs:ignore ?><div><strong>Atención personalizada</strong><span>Te asesoramos sin compromiso</span></div></div>
	</div>
</section>
<footer class="site-footer">
	<div class="container footer__inner">
		<div class="footer__brand">
			<img src="<?php echo clima_pro_img( 'logo-clima-pro.svg' ); ?>" alt="Clima Pro" width="180" height="46" loading="lazy">
			<p><?php echo esc_html( clima_pro_opt( 'clima_tagline' ) ); ?></p>
		</div>
		<nav class="footer__nav" aria-label="Pie">
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'depth' => 1, 'fallback_cb' => 'clima_pro_fallback_menu' ) ); ?>
		</nav>
		<div class="footer__social">
			<?php
			foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube' ) as $k => $label ) {
				$u = clima_pro_opt( 'clima_' . $k );
				printf( '<a href="%s" aria-label="%s" %s>%s</a>', esc_url( $u ? $u : '#' ), esc_attr( $label ), $u ? 'target="_blank" rel="noopener"' : '', clima_pro_icon( $k ) ); // phpcs:ignore
			}
			?>
			<a class="header-wa" href="<?php echo esc_url( clima_pro_wa_url( 'Hola, quiero hacer una consulta.' ) ); ?>" target="_blank" rel="noopener">
				<span class="header-wa__icon"><?php echo clima_pro_wa_icon(); // phpcs:ignore ?></span>
				<span><strong>WhatsApp</strong><small><?php echo esc_html( clima_pro_opt( 'clima_whatsapp_label' ) ); ?></small></span>
			</a>
		</div>
	</div>
	<p class="footer__copy">© <?php echo esc_html( gmdate( 'Y' ) ); ?> Clima Pro. Todos los derechos reservados.</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
