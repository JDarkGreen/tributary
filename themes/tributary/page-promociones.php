<?php /* Template Name: Página Promociones Plantilla */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Seccion General -->
<section class="pagePromotions">
	
	<div class="container">
		<div class="row">

			<!-- Articulo Principal -->
			<main class="col-xs-12 col-md-8">
				<article class="pagePromotions__article">

					<!-- Titulo --> <h2 class="titleDescriptionSection text-uppercase"><?php _e("mira nuestras promociones", LANG ); ?></h2>

					<!-- Obtener todas las promociones disponibles -->
					<section class="pagePromotions__container">
						<?php  
							//Argumentos de los posts
							$args = array(
								'order'          => 'DESC',
								'orderby'        => 'date',
								'post_status'    => 'publish',
								'post_type'      => 'promocion',
								'posts_per_page' => -1,
							);
							$promotions = get_posts( $args );
							if( !empty( $promotions) ) : 
						?> 

					<!-- Items de Artículos -->
					<div class="row">
						<?php $i = 0; foreach( $promotions as $promotion ) : ?>

							<article class="item-preview-post col-xs-6">

								<!-- Imagen Destacada --> <figure> 
								<?php if( has_post_thumbnail( $promotion->ID ) ) : 
									echo get_the_post_thumbnail( $promotion->ID , 'full' , array('class' => 'img-fluid imgNotBlur' ) ); 
									else :
								?>
									<img src="<?= IMAGES ?>/update_image.jpg" alt="paracas-sunset-hotel-peru" class="img-fluid" />
								<?php endif; ?>
								</figure> <!-- /.fin imagen -->

								<!-- Titulo --> <h2 class="text-uppercase"><?php _e( $promotion->post_title , LANG ); ?></h2>
								<!-- Extracto --> <div class="text-justify"> <?= apply_filters('the_content' , wp_trim_words( $promotion->post_content , 30 , '...' ) ); ?></div>

								<!-- Seccion compartir y botón -->
								<div class="">
									<!-- Botón  --> <a href="<?= get_permalink( $promotion->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--rojo text-uppercase pull-right"> <?php _e( 'ver más' , LANG  );  ?> </a>
								</div> <!-- /. -->

								<!-- Limpiar floats --> <div class="clearfix"></div>

								<!-- Enviar Permalink -->
								<?php $the_link_share = get_permalink( $promotion->ID ); ?>

								<!-- Sección Compartir en Redes Sociales -->
								<?php include( locate_template("partials/section-share-type-post.php") ); ?>

							</article> <!-- /.item-preview-post -->

							<!-- Linea Separadora -->
							<?php if( $i % 2 != 0 ) : ?>
								<!-- Limpiar floats --> <div class="clearfix"></div>
								<div id="separator-line"></div>
							<?php endif; ?>

						<?php $i++; endforeach; ?>
					</div> <!-- /.row -->	

					<?php endif; ?>

					</section> <!-- /.pagePromotions__container -->			

				</article> <!-- /. -->
			</main> <!-- /.col-xs-12 -->

			<!-- Sidebar  Ocultar en mobile -->
			<aside class="col-md-4 hidden-xs-down">

				<!-- Sección de Categorias de Imagen  -->
				<section class="sectionLinks__sidebar">
					<!-- Extraemos todos las categorias de promocion  -->
					<?php foreach( $promotions as $promotion ) : ?>
						<a href="<?= get_permalink( $promotion->ID ); ?>" class="link-to-item"><?php _e( $promotion->post_title , LANG  ); ?></a>
					<?php endforeach; ?>
				</section> <!-- /.sectionLinks__sidebar -->

				<!-- Sidebar de Publicidad -->
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