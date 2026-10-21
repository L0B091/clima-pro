<?php
/**
 * Página no encontrada.
 *
 * @package ClimaPro
 */
get_header(); ?>
<section class="page-hero"><div class="container"><h1>Página no encontrada</h1><p>La página que buscás no existe o se movió.</p></div></section>
<div class="container section"><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a></div>
<?php get_footer();
