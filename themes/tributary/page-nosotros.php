<?php /* Template Name: Página Nosotros Plantilla */ ?>

<!-- Header -->
<?php get_header(); $theme_mod = get_theme_mod('theme_custom_settings'); ?>  

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	
	<!-- Primera Seccion de descripcion -->
	<section class="pageNosotros__description">
		<div class="container">
			<div class="row">

				<!-- Carousel Nosotros -->
				<div class="col-xs-12 col-md-6">

					<!-- Contenedor de Galería [ SERVICIOS ] -->
					<section class="relative">
						<!-- Wrapper para sliders -->
						<?php  
							/*
							*  Attributos disponibles 
							* data-items = number , data-items-responsive = number_mobile ,
							* data-margins = margin_in_pixels , data-dots = true or false 
							*data autoplay = true or false
							*/
						?>

						<div id="carousel-nosotros" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="true">
							<!-- Obtener todas las habitaciones -->
							<?php  
								$input_ids_img  = get_post_meta($post->ID, 'imageurls_'.$post->ID , true);
								//convertir en arreglo
								$input_ids_img  = explode(',', $input_ids_img ); 

								//Hacer loop por cada item de arreglo
								foreach ( $input_ids_img as $item_img ) : 
									//Si es diferente de null o tiene elementos
									if( !empty($item_img) ) : 
									//Conseguir todos los datos de este item
									$item = get_post( $item_img  ); 
							?> <!-- Artículo -->
								<article class="item-nosotros relative">
									<!-- Imagen -->
									<figure><img src="<?= $item->guid; ?>" alt="<?= $item->post_title; ?>" class="img-fluid" /></figure>
								</article> <!-- /.item-tour -->

							<?php endif; endforeach; ?>
						</div> <!-- /.section__rooms_gallery -->

					</section> <!-- /.relative -->

				</div> <!-- /.col-xs-12 col-md-6 -->
				
				<!-- Información -->
				<div class="col-xs-12 col-md-6">
					<section class="text-xs-center">

						<!-- Titulo de Sección -->
						<h2 class="pageSectionCommon__title text-uppercase">
							<?php _e( "quienes somos" , LANG ); ?>
						</h2> <!-- /.pageSectionCommon__title -->

						<!-- Contenido 1 Descripcion -->
						<div class="pageNosotros__content"> 
							<?= apply_filters('the_content' , $post->post_content ); ?>
						</div> <!-- /.text-justify -->

					</section> <!-- /section -->
				</div> <!-- /.col-xs-12 col-md-6 -->
				
			</div> <!-- /.row -->

		</div> <!-- /.container -->
	</section> <!-- /.pageNosotros__description -->	

	<!-- Sefunda Sección Aptitudes -->
	<section class="pageNosotros__aptitudes">
		<div class="container">
			<div class="row">
				
				<!-- MISIÓN -->
				<div class="col-xs-6">
					<?php if( isset($theme_mod['text_mision']) && !empty($theme_mod['text_mision']) ) : ?>
						<div class="row">
							<!-- Imagen -->
							<div class="col-xs-3">
								<figure class="">
									
								</figure> <!-- /. -->
							</div> <!-- /.col-xs-3 -->
							<!-- Texto -->
							<div class="col-xs-9">
								<!-- Titulo --> <h3 class="text-uppercase"> <?php _e( "misión", LANG ); ?></h3>
								<!-- Texto -->
								<?= apply_filters('the_content' , $theme_mod['text_mision'] ); ?>
							</div> <!-- /.col-xs-9 -->
							
						</div> <!-- /.row -->
					<?php endif; ?>
				</div> <!-- /.col-xs-6 -->		

				<!-- VISIÓN -->
				<div class="col-xs-6">
					<?php if( isset($theme_mod['text_vision']) && !empty($theme_mod['text_vision']) ) : ?>
						<div class="row">
							<!-- Imagen -->
							<div class="col-xs-3">
								<figure class="">
									
								</figure> <!-- /. -->
							</div> <!-- /.col-xs-3 -->
							<!-- Texto -->
							<div class="col-xs-9">
								<!-- Titulo --> <h3 class="text-uppercase"> <?php _e( "visión", LANG ); ?></h3>
								<!-- Texto -->
								<?= apply_filters('the_content' , $theme_mod['text_vision'] ); ?>
							</div> <!-- /.col-xs-9 -->
							
						</div> <!-- /.row -->
					<?php endif; ?>
				</div> <!-- /.col-xs-6 -->

			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.pageNosotros__aptitudes -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>