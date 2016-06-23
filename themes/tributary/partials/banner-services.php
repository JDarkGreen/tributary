<?php /*Obtener página de Servicios*/ 
	$page_servicios = get_page_by_path('contacto'); 
?>

<!-- Sección Común banner Servicios -->
<section class="sectionCommon__banner__services text-xs-center">
	<div class="container">
		<div class="container-flex align-content">
			<!-- Titulo -->
			<h2 class=""><?php _e('Disfruta en Paracas Sunset Hotel las maravillas de Paracas - Ica' , LANG ); ?></h2>
			<!-- Botón -->
			<a href="<?= get_permalink( $page_servicios->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--rojo text-uppercase"><?php _e('reservar' , LANG ); ?></a>
		</div> <!-- /.container-flex align-content -->
	</div> <!-- /.container -->
</section> <!-- /.sectionCommon__banner__services -->