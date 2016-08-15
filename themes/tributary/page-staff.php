<?php /* Template Name: Página Staff Plantilla */ ?>

<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>  

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	
	<!-- Contenedor -->
	<section class="pageStaff">
		<div class="container">
			
			<!-- Extraemos todos los miembros del staff -->
			<?php  
				$args = array(
					'order'          => 'ASC',
					'orderby'        => 'menu_order',
					'post_status'    => 'publish',
					'post_type'      => 'miembro',
					'posts_per_page' => -1,
				);
				$miembros = get_posts( $args );
				if( !empty($miembros) ) :

				/* Seteamos una variable de control para agregar las filas
				* con la clase .row donde sea necesario
				*/ 
				$control = 0;
			?>
			<?php
				foreach( $miembros as $miembro ) :

				/* después de dos items agregar una fila */
				if( $control % 2 == 0 ) :
			?> 
				<div class="row">
			<?php endif; ?>

				<!-- Articulo o Item de Miembro de staff -->
				<div class="col-xs-12 col-md-6">

					<article class="articleItemStaff">
						<div class="row">
							<!-- Imagen -->
							<div class="col-xs-12 col-md-4">
								<figure>
									<?php 
									if( has_post_thumbnail( $miembro->ID ) ) : 
									echo get_the_post_thumbnail( $miembro->ID , 'full' , array('class'=>'img-fluid imgNotBlur center-block') );
									endif; 
									?>
								</figure> 

								<!-- Separación en mobile --> <p class="hidden-sm-up"></p>

							</div> <!-- /.col-xs-4 -->
							<!-- Texto o contenido -->
							<div class="col-xs-12 col-md-8 text-xs-center text-md-left">
								<!-- Titulo o Nombre --> <h2 class="pageSectionCommon__title text-uppercase"><?php _e( $miembro->post_title , LANG ); ?></h2>
									<!-- Texto -->
								<div class="">
									<?= apply_filters('the_content' , $miembro->post_content ); ?>
								</div> <!-- /.text-xs-justify -->
							</div> <!-- /.col-xs-8 -->
						</div> <!-- /.row -->
					</article> <!-- /.articleItemStaff -->
					
				</div> <!-- /.col-xs-6 -->
			
			<!-- Cerrar fila -->
			<?php if( $control % 2 != 0 ) : ?>
				</div> <!-- /.row -->
			<?php endif; ?>

			<?php $control++; endforeach; endif; ?>
			
		</div> <!-- /.container -->
	</section> <!-- /.pageStaff -->	

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>