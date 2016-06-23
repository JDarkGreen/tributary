<?php /* Single Name: Página Habitaciones */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$page   = get_page_by_path('habitaciones'); #var_dump($page);
	$banner = $page;  // Seteamos la variable banner de acuerdo a la página
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Seccion General -->
<section class="pageRooms">
	
	<div class="container">
		<div class="row">

			<!-- Articulo Principal -->
			<main class="col-xs-12 col-md-8">
				<article class="mainRooms__article">

					<!-- Botoneras -->
					<section class="mainRooms__buttons text-xs-center text-md-left">
						<?php //Obtener los nombres y enlaces de las habitaciones  
							$args = array(
								'order'          => 'ASC',
								'orderby'        => 'menu_order',
								'post_status'    => 'publish',
								'post_type'      => 'habitacion',
								'posts_per_page' => -1,
							);
							$rooms = get_posts( $args );
							if( !empty($rooms) ) : foreach( $rooms as $room ) :
						?> <!-- Botones -->
						<a href="<?= get_permalink($room->ID); ?>" class="<?= $post->ID == $room->ID ? 'active' : '' ?>"><?php _e( $room->post_title , LANG ); ?></a>
						<?php endforeach; endif; ?>
					</section><!-- /. -->

					<!-- Titúlo Principal  --> <h2 class="titleDescriptionSection"><?php _e( $post->post_title , LANG ); ?></h2>

					<!-- Galería de Primer Elemento -->
					<div class="relative">
						<?php  
							/*
							*  Wrapper o Contenedor
							*  Attributos disponible 
							* data-items , data-items-responsive , data-margins , data-dots
							*/
						?>
						<div id="carousel-single-room" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="true" >
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
								<article class="item-room relative">
									<!-- Imagen -->
									<figure><img src="<?= $item->guid; ?>" alt="<?= $item->post_title; ?>" class="img-fluid" /></figure>
								</article> <!-- /.item-tour -->

							<?php endif; endforeach; ?>
						</div> <!-- /.section__rooms_gallery -->

						<!-- Flechas  -->
						
						<!-- Indicadores -->
						<section class="gallery_indicators">
							<?php 
								//variable de control 
								$k = 0;
								foreach ( $input_ids_img as $item_img ) : 
								//Si es diferente de null o tiene elementos
								if( !empty($item_img) ) : 
								//Conseguir todos los datos de este item
								$item = get_post( $item_img  ); 
							?> <a href="#" class="gallery_indicator js-carousel-indicator" data-slider="carousel-single-room" data-to="<?= $k ?>">
								<img src="<?= $item->guid; ?>" alt="<?= $item->post_title; ?>" class="img-fluid" /></figure>
							</a>
							<?php $k++; endif; endforeach; ?>
						</section> <!-- /.gallery_indicators -->


					</div> <!-- /.relative -->	

					<!-- Contenido de Primer Elemento - Texto -->
					<div class="text-justify">
						<?php if( !empty( $post->post_content ) ) : 
							echo apply_filters('the_content', __( $post->post_content , LANG ) );
							else : 
						?>
						<p><?php _e( "Estamos actualizando este contenido gracias por su preferencia." , LANG ); ?></p>
						<?php endif; ?>
					</div> <!-- /.text-justify -->	

					<!-- Sección Beneficios -->
					<section class="pageInicio__benefits">
						<div class="container">
							<!-- Titulo de Sección --> <h2 class="titleDescriptionSection text-uppercase text-xs-center">
							<span><?php _e('beneficios del hotel' , LANG ); ?></span></h2>

							<!-- Incluir Sección Beneficios de Hotel -->
							<?php include(locate_template("partials/section-hotel-benefits.php") ); ?>

						</div> <!-- /.container -->	
					</section> <!-- /.pageInicio__benefits -->				

				</article> <!-- /. -->
			</main> <!-- /.col-xs-12 -->

			<!-- Sidebar  Ocultar en mobile -->
			<aside class="col-md-4 hidden-xs-down">
				<?php if ( is_active_sidebar( 'sidebar-publicidad-hotel' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-publicidad-hotel' ); ?>
				<?php else: __("Actualizando contenido" , LANG ) ; endif; ?>

				<!-- Sección Facebook -->
				<?php
					if( isset($options['red_social_fb']) && !empty($options['red_social_fb']) ) :
				?>
					<section class="container__facebook">
						
						<!-- Titulo -->
						<h2 class="titleWidget text-uppercase"><?php _e( "Facebook", LANG ); ?></h2>			
			
						<!-- Contebn -->
						<div id="fb-root" class=""></div>

						<!-- Script -->
						<script>(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>

						<div class="fb-page" data-href="<?= $options['red_social_fb']; ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-height="500" data-hide-cover="false" data-show-facepile="true">
						</div> <!-- /. fb-page-->
					</section> <!-- /.container__facebook -->
				<?php else: ?>
					<p class="text-xs-center">Opcion no habilitada temporalmente</p>
				<?php endif; ?>				

			</aside> <!-- /.col-md-4 hidden-xs-down -->

		</div> <!-- /.row -->
	</div> <!-- /.container -->

</section> <!-- /.pageRooms -->

<!-- Footer -->
<?php get_footer(); ?>