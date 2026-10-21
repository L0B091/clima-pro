<?php
/**
 * Formulario de búsqueda: siempre busca productos.
 *
 * @package ClimaPro
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="sf-<?php echo esc_attr( wp_unique_id() ); ?>">Buscar productos</label>
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Buscar productos…">
	<input type="hidden" name="post_type" value="product">
	<button class="btn btn-primary" type="submit">Buscar</button>
</form>
