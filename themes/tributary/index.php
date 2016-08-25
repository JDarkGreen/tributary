<!-- Header -->
<?php 
	get_header(); 
	$options   = get_option('theme_custom_settings'); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>

<!-- Incluir Slider de Portada -->
<?php include(locate_template('partials/slider-home.php')); ?>

<?php 
/*
* Servicios Seccion
*/ 
?>
<section class="pageInicio__services relative">
	<div class="container">
		<!-- Titulo  --> <h2 class="titleCommon__page text-uppercase"> <span class="relative"> <?php _e( "servicios" , LANG ); ?> </span> </h2>

		<!-- Contenedor de Galería [ SERVICIOS ] -->
		<section class="relative">
			<!-- Wrapper para sliders -->
			<?php  
				/*
				*  Attributos disponibles 
				* data-items = number , data-items-responsive = number_mobile ,
				* data-margins = margin_in_pixels , data-dots = true or false
				*/
			?>
			<div id="carousel-service" class="pageInicio_gal_services js-carousel-gallery" data-items="3" data-items-responsive="1" data-margins="40">
				<!-- Obtener todas las habitaciones -->
				<?php  
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'servicio',
						'posts_per_page' => -1,
					); 
					$services = get_posts( $args );
					foreach( $services as $service ) : 
				?> <!-- Artículo -->
					<article class="item-service text-xs-left">
						<figure>
							<?php if( has_post_thumbnail( $service->ID) ) : ?>
							<?= get_the_post_thumbnail( $service->ID , 'full', array('class'=>'img-fluid') ); ?>
							<?php endif; ?>
						</figure>
						<!-- titulo --> <h3 class="text-uppercase"><?php _e( $service->post_title , LANG ); ?></h3>
						<!-- Extracto --> <div class="item-room__excerpt"> <?= apply_filters( 'the_content' , wp_trim_words( $service->post_content , 20 , '' ) ); ?></div>
						<!-- Botón ver más --> <a href="<?= get_permalink( $service->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--turquesa text-uppercase"><?php _e('ver más' , LANG ); ?></a>
					</article> <!-- /.item-service -->
				<?php endforeach; ?>
			</div> <!-- /.section__rooms_gallery -->

			<!-- Flechas de Galería -->
			<!-- Flecha Izquierda -->
			<a href="#" data-slider="carousel-service" class="js-carousel-prev arrow__common-slider arrowHomeSliderServices-prev">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			</a> <!-- /. -->			
			<!-- Flecha Derecha -->
			<a href="#" data-slider="carousel-service" class="js-carousel-next arrow__common-slider arrowHomeSliderServices-next">
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
			</a> <!-- /. -->


		</section> <!-- /.relative -->

	</div> <!-- /.container -->
</section> <!-- /.pageInicio__services -->

<?php 
/*
* Servicios MISCELANEO
*/ 
?>

<section class="pageInicio__miscelaneo">
	<div class="container">

		<div class="row">
			
			<!-- SECCION DE BLOG  -->
			<div class="col-xs-12 col-md-8">
				<section>
					<!-- Titulo  --> <h2 class="titleCommon__page text-uppercase"> <span class="relative"> <?php _e( "blog" , LANG ); ?> </span> </h2>

					<?php  
						//Obtener todos los 6 posts ultimos
						$args = array(
							'order'          => 'ASC',
							'orderby'        => 'menu_order',
							'post_type'      => 'post',
							'posts_per_page' => 6,
						);
						$ultimos_posts = get_posts( $args ); #var_dump($ultimos_posts);
					?>
					<?php 
					/*
					* data-speed = default 1500 [number]
					* data-items = default 3 [number]
					*/ 
					?>
					<div id="carousel-articles" class="pagePreview_post js-carousel-vertical" data-items="3">
						<?php foreach( $ultimos_posts as $u_post ) : ?>
						<div class="carousel-item">
							<article class="articles-item">
								<!-- Imagen -->
								<figure class="pull-md-left">
								<?php 
									$image = get_the_post_thumbnail( $u_post->ID , 'full' , array('class'=>'img-fluid center-block imgNotBlur') ); 
									if( !empty($image) ) : echo $image;
									else:
								?>
									<img src="http://lorempixel.com/980/549/sports" alt="lorempixel" class="img-fluid center-block imgNotBlur" />
								<?php endif; ?>
								</figure><!-- /figure -->
								<!-- Texto -->
								<h3 class="articles-item-title text-uppercase">
								<?php _e( $u_post->post_title , LANG ); ?></h3>
								<!-- Extracto 30 palabras -->
								<p class="articles-item-excerpt">
								<?php _e( wp_trim_words( $u_post->post_content , 30 , ' ' ) , LANG ); ?>
									<!-- leer más -->
									<a class="read-more" href="<?= get_permalink( $u_post->ID ); ?>">Leer más </a>
								</p>
								<!-- Limpiar float --> <div class="clearfix"></div>
							</article><!-- /.sectionPage__articles__item -->
						</div>
						<?php endforeach; ?>
					</div><!-- /#carousel-articles -->
				</section> <!-- /.section -->
			</div> <!-- /.col-xs-8 -->

			<!-- SECCION DE FACEBOOK -->
			<div class="col-xs-12 col-md-4">
				<section>
					<!-- Titulo  --> <h2 class="titleCommon__page text-uppercase"> <span class="relative"> <?php _e( "facebook" , LANG ); ?> </span> </h2>

					<!-- Contenedor facebook -->
					<?php
						if( isset( $theme_mod['red_social_fb'] ) && !empty( $theme_mod['red_social_fb'] ) ) :
					?>
						<section class="container__facebook">
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

							<div class="fb-page" data-href="<?= $theme_mod['red_social_fb']; ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-height="565" data-hide-cover="false" data-show-facepile="true">
							</div> <!-- /. fb-page-->
						</section> <!-- /.container__facebook -->
					<?php else: ?>
						<p class="text-xs-center">Opcion no habilitada temporalmente</p>
					<?php endif; ?>

				</section>
			</div><!-- /.col-xs-4 -->

		</div> <!-- /.row -->

		<!-- Separación --> <br/>

		<!-- SECCIÓN ENLACES DE INTERÉS -->
		<section class="pageCommon__featured-links">

			<br><br>

			<!-- Titulo  --> 
			<!--h2 class="titleCommon__page text-uppercase"> <span class="relative"> <?php _e( "enlaces de interés" , LANG ); ?> </span> </h2-->

			<!-- Carousel de Enlace De Interés -->
			<div id=".carousel-featured-links" class="section__single_gallery js-carousel-gallery" data-items="5" data-items-responsive="1" data-margins="70" data-dots="true" data-autoplay="true">

				<?php  
					/**
					* Extraer todos los enlaces de interés
					**/
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'featured-links',
						'posts_per_page' => -1,
					);
					$featured_links = get_posts( $args );

					foreach( $featured_links as $featured_link ):
				?>
				<article class="itemFeaturedLink">
					<a href="<?= $featured_link->post_content; ?>" target="_blank">
						<?= get_the_post_thumbnail( $featured_link->ID , 'full' , array('class'=>'img-fluid center-block') ); ?>
					</a>
				</article>
				<?php endforeach; ?>

			</div> <!-- /.carousel-featured-links -->

			
			
		</section> <!--/.pageCommon__featured-links-->

	</div> <!-- /.container -->
</section> <!-- /.pageInicio__miscelaneo -->


<!-- Footer -->
<?php get_footer(); ?>