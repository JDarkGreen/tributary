<?php /* Template Name: Página Blog Plantilla */ ?>

<!-- Header -->
<?php get_header(); $theme_mod = get_theme_mod('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - o -Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo a la página
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	<div class="container">
		
		<!-- Seccion de Contenido -->
		<section class="pageServicios__content">
			<div class="row">
				
				<!-- Contenido -->
				<div class="col-xs-12 col-md-8">
					<section class="">
						<?php 

							/* Extraer todas las categorías padre */  
							$categorias = get_categories( array(
								'orderby' => 'name' , 'parent' => 0,
							) );

							/* Extraer la primera categoría */
							$first_cat = $categorias[0];

							/* Vamos a obtener todos los paquetes de tour y seleccionaremos el primero*/
							$args = array(
								'order'          => 'DESC',
								'orderby'        => 'date',
								'post_status'    => 'publish',
								'post_type'      => 'post',
								'posts_per_page' => -1,
								'category_name'  => $first_cat->slug,
							);
							$total_items = get_posts( $args );

							/* numero de post con esta taxonomia */
							$number_articulos = count( $total_items ); 

							/* número de cuantos post quieres presentar por pagina */
							$post_per_page  = 3;

							/* Si el número de post es mayor a la cantidad por presentar entonces
							* se hace un carousel */
							if ( $number_articulos > $post_per_page ) : 

								/* Wrapper for slider */
	
								/*
								*  Attributos disponibles 
								* data-items = number , data-items-responsive = number_mobile ,
								* data-margins = margin_in_pixels , data-dots = true or false
								* if data-autoplay false then not autoplay else true ;
								*/
							?>

							<div id="carousel-blog" class="section__single_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="false" data-autoplay="false" >

								<?php  
									/* división para saber el número total de paginación */
									$number_items = floor( $number_articulos / $post_per_page );

									$repeat_items = 1 +  $number_items; 

									/* repeticiones */
									for( $i = 0 ; $i < $repeat_items ; $i++ ){ 
								?>  <!-- Seccion que contendrá los articulos o por la taxonomia categoria de proyecto por el numero de pagina seteado -->

									<section class="pagePreview_post">
										<?php 
											/* argumentos y articulos */
											$args2 = array(
												'order'          => 'DESC',
												'orderby'        => 'date',
												'post_status'    => 'publish',
												'post_type'      => 'post',
												'posts_per_page' => $post_per_page,
												'offset'         => $i * $post_per_page,
												'category_name'  => $first_cat->slug,
											);
											/* articulos */
											$articulos = get_posts( $args2 );
											foreach( $articulos as $articulo ) :
										?> <!--  Articulo -->
											<article class="articles-item">
												<!-- Imagen -->
												<figure class="pull-md-left">
													<a href="<?= get_permalink( $articulo->ID ); ?>">
													<?php 
														$image = get_the_post_thumbnail( $articulo->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
														if( !empty($image) ) : echo $image;
														else:
													?>
														<img src="http://lorempixel.com/980/549/sports" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
													<?php endif; ?>
													</a>
												</figure><!-- /figure -->

												<!-- Texto -->
												<h3 class="articles-item-title text-uppercase">
												<?php _e( $articulo->post_title , LANG ); ?></h3>
												<!-- Extracto 30 palabras -->
												<p class="articles-item-excerpt text-justify">
												<?php _e( wp_trim_words( $articulo->post_content , 30 , ' ' ) , LANG ); ?>
													<!-- leer más -->
													<a class="read-more" href="<?= get_permalink( $articulo->ID ); ?>">Leer más </a>
												</p>
												<!-- Limpiar float --> <div class="clearfix"></div>
											</article><!-- /.sectionPage__articles__item -->
										<?php endforeach; ?>
									</section> <!-- /.pagePreview_post -->		

								<?php } /* end for */?>

							</div> <!-- /. fin de contenedor para slider -->

							<!-- Flechas de Carousel -->
							<div class="containerArrowBlog relative">
								<!-- Flecha Izquierda --> 
								<a href="#" id="" class="arrow__common-slider js-carousel-prev arrowCarouselBlog-prev" data-slider="carousel-blog">
									<i class="fa fa-chevron-left" aria-hidden="true"></i>
								</a>								
								<!-- Flecha Derecha --> 
								<a href="#" id="" class="arrow__common-slider js-carousel-next arrowCarouselBlog-next" data-slider="carousel-blog">
									<i class="fa fa-chevron-right" aria-hidden="true"></i>
								</a>
							</div> <!-- /. -->
						
						<!-- Sino hacer una seccion simple -->
						<?php else: ?>
							
							<section class="pagePreview_post">
								<?php 
									/* argumentos y articulos */
									$args2 = array(
										'order'          => 'DESC',
										'orderby'        => 'date',
										'post_status'    => 'publish',
										'post_type'      => 'post',
										'posts_per_page' => -1,
										'category_name'  => $first_cat->slug,
									);
									/* articulos */
									$articulos = get_posts( $args2 );
									foreach( $articulos as $articulo ) :
								?> <!--  Articulo -->
									<article class="articles-item">
										<!-- Imagen -->
										<figure class="pull-md-left">
											<a href="<?= get_permalink( $articulo->ID ); ?>">
												<?php 
													$image = get_the_post_thumbnail( $articulo->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
													if( !empty($image) ) : echo $image;
													else:
												?>
													<img src="http://lorempixel.com/980/549/sports" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
												<?php endif; ?>
											</a> <!-- /end of link -->
										</figure><!-- /figure -->
										<!-- Texto -->
										<h3 class="articles-item-title text-uppercase">
										<?php _e( $articulo->post_title , LANG ); ?></h3>
										<!-- Extracto 30 palabras -->
										<p class="articles-item-excerpt text-justify">
										<?php _e( wp_trim_words( $articulo->post_content , 30 , ' ' ) , LANG ); ?>
											<!-- leer más -->
											<a class="read-more" href="<?= get_permalink( $articulo->ID ); ?>">Leer más </a>
										</p>
										<!-- Limpiar float --> <div class="clearfix"></div>
									</article><!-- /.sectionPage__articles__item -->
								<?php endforeach; ?>
							</section> <!-- /.pagePreview_post -->		

						<?php endif; /* Fin de condicional */ ?> 	



					</section> <!-- /.section -->
				</div> <!-- /.col-xs-12 col-md-8 -->
				
				<!-- Aside de Categoria -->
				<div class="col-xs-4 hidden-xs-down">
					<!-- Incluir plantilla -->
					<?php include( locate_template("partials/sidebar-categories.php") ); ?>
				</div> <!-- /.col-xs-4 -->

			</div> <!-- /.row -->
		</section> <!-- /.pageNosotros__description -->	

	</div> <!-- /.container -->
</main> <!-- /.pageWrapper -->


<div class="container">
<?php 
/*
* Incluir template servicios
*/ 
include( locate_template("partials/banner-services.php") );
?>	
</div> <!-- /.container -->


<!-- Footer -->
<?php get_footer(); ?>