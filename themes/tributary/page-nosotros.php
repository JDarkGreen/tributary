<?php /* Template Name: Página Nosotros Plantilla */ ?>

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
<main class="">
	
	<!-- Primera Seccion de descripcion -->
	<section class="pageNosotros__description">
		<div class="container">
			<div class="row">

				<!-- Carousel Nosotros -->
				<div class="col-xs-12 col-md-6">

					<!-- Contenedor de Galería [ SERVICIOS ] -->
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
							//Eliminar numeros negativos
							$remove_array   = array(-1);
							$input_ids_img  = array_diff( $input_ids_img , $remove_array ); 

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
							</article> <!-- /.item-nosotros -->

						<?php endif; endforeach; ?>
					</div> <!-- /.section__single_gallery -->

					<!-- Flechas de Carousel Ocultar en mobile -->
					<div class="text-xs-center relative hidden-xs-down">
						<!-- Flecha Izquierda -->
						<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselNosotros-prev" data-slider="carousel-nosotros">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</a>							
						<!-- Flecha Derecha -->
						<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselNosotros-next" data-slider="carousel-nosotros">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</a>
					</div> <!-- /.text-xs-center relative -->

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
				<div class="col-xs-12 col-md-6">
					<?php if( isset($theme_mod['text_mision']) && !empty($theme_mod['text_mision']) ) : ?>
						<div class="row">
							<!-- Imagen -->
							<div class="col-xs-12 col-md-4">
								<figure class="">
									<?php  
										$imagen_mision = isset($theme_mod['image_mision']) && !empty($theme_mod['image_mision']) ? $theme_mod['image_mision'] : IMAGES . '/nosotros/imagen_mision.jpg';
									?>
									<img src="<?= $imagen_mision; ?>" alt="tributary-mision-agencia-pecuarias" class="img-fluid" />
								</figure> <!-- /. -->

								<!-- Separación en mobile --> <p class="hidden-sm-up"></p>
							</div> <!-- /.col-xs-4 -->
							<!-- Texto -->
							<div class="col-xs-12 col-md-8">
								<!-- Titulo --> <h3 class="pageSectionCommon__title text-uppercase"> <?php _e( "misión", LANG ); ?></h3>
								<!-- Texto -->
								<?= apply_filters('the_content' , $theme_mod['text_mision'] ); ?>
							</div> <!-- /.col-xs-8 -->

							<!-- Separación en mobile --> <p class="hidden-sm-up"></p>
							
						</div> <!-- /.row -->
					<?php endif; ?>
				</div> <!-- /.col-xs-6 -->		

				<!-- VISIÓN -->
				<div class="col-xs-12 col-md-6">
					<?php if( isset($theme_mod['text_vision']) && !empty($theme_mod['text_vision']) ) : ?>
						<div class="row">
							<!-- Imagen -->
							<div class="col-xs-12 col-md-4">
								<figure class="">
									<?php  
										$imagen_vision = isset($theme_mod['image_vision']) && !empty($theme_mod['image_vision']) ? $theme_mod['image_vision'] : IMAGES . '/nosotros/imagen_vision.jpg';
									?>
									<img src="<?= $imagen_vision; ?>" alt="tributary-vision-agencia-pecuarias" class="img-fluid" />		
								</figure> <!-- /. -->
								
								<!-- Separación en mobile --> <p class="hidden-sm-up"></p>
							</div> <!-- /.col-xs-4 -->
							<!-- Texto -->
							<div class="col-xs-12 col-md-8">
								<!-- Titulo --> <h3 class="pageSectionCommon__title text-uppercase"> <?php _e( "visión", LANG ); ?></h3>
								<!-- Texto -->
								<?= apply_filters('the_content' , $theme_mod['text_vision'] ); ?>
							</div> <!-- /.col-xs-8 -->
							
						</div> <!-- /.row -->
					<?php endif; ?>
				</div> <!-- /.col-xs-6 -->

			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.pageNosotros__aptitudes -->

</main> <!-- /.pageWrapper -->


<!-- Footer -->
<?php get_footer(); ?>