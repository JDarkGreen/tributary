<?php /* Incluir banner de promocion */ ?>

<!-- Sección Promociones -->
<section class="pageInicio__promocion relative">
	<!-- Extraer Una promocion ramdom -->
	<?php  
		$args = array(
			'orderby'        => 'rand', 
			'post_status'    => 'publish',
			'post_type'      => 'promocion',
			'posts_per_page' => 1,
		);
		$promociones = get_posts( $args );
		$promocion   = $promociones[0];
	?> 
	<!-- Contenido -->
	<div class="content-promocion">
		<!-- Título --> <h2 class=""><?php _e( $promocion->post_title , LANG ); ?></h2>
		<!-- Botón Ver más  --> <a href="#" class="btnCommon__show-more btnCommon__show-more--small"><?php _e('Ver más' , LANG ); ?></a>

		<!-- Separador Solo en mobile --> <p class="hidden-sm-up"></p>
	</div> <!-- /.content-promocion -->

<?php  
	/* Extraer Imagen */
	$image = get_the_post_thumbnail( $promocion->ID ,'full', array('class'=>'img-fluid') );
	if( !empty($image) ) : echo $image; endif;
?>

</section> <!-- /.pageInicio__promocion -->