<?php /*Obtener página de Servicios*/ 
	$this_page = get_page_by_path('contactanos'); 
?>

<!-- Sección Común banner Servicios -->
<section class="sectionCommon__banner__services text-xs-center">
	<div class="container">
		<div class="container-flex align-content">
			<!-- Titulo -->
			<h2 class="text-capitalize"><?php _e('Consulte sobre nuestros servicios' , LANG ); ?></h2>
			<!-- Botón -->
			<a href="<?= get_permalink( $this_page->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--transparent text-uppercase"><?php _e('contáctanos' , LANG ); ?></a>
		</div> <!-- /.container-flex align-content -->
	</div> <!-- /.container -->
</section> <!-- /.sectionCommon__banner__services -->