<?php /* Taxonomy Template de Imágenes de Galería */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	$current_term = get_queried_object(); //Objeto actual 
	$page         = get_page_by_path('galeria');  //buscamos el objeto de acuerdo a la página galeria
	$banner       = $page;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Seccion General -->
<section class="pageWrapper">
	
	<div class="container">
		<div class="row">

			<!-- Articulo Principal -->
			<main class="col-xs-12 col-md-8">

				<?php  
					/* Obtenemos todos los terminos de la taxonomia de imagen */
					$args = array(
						'taxonomy'   => 'image_category',
						'hide_empty' => false,
					);
					$cats_imagenes = get_terms( $args ); #var_dump($cats_imagenes);

					/* Vamos a obtener todos las imágenes de la galería segun el termino */
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'galery-images',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'image_category',
								'field'    => 'slug',
								'terms'    => $current_term->slug,
							),
						),
					);
					$images = get_posts( $args );
				?>

				<article class="pageWrapper__article">

					<!-- Titulo --> <h2 class="titleDescriptionSection"><?php _e( $current_term->name , LANG ); ?></h2>

					<!-- Galería de Imágenes -->
					<section class="pageGallery__content">
						<div class="row">
							<?php foreach( $images as $image ) :  ?>
								<!-- Artículo -->
								<?php 
									if( has_post_thumbnail( $image->ID ) ) : 
									//Url Imagen Destacada 
									$url_feat_img = wp_get_attachment_url( get_post_thumbnail_id( $image->ID ) );
								?>
									<article class="item-gallery col-xs-4">
										<!-- Link Abre Imagen Fancybox -->
										<a href="<?= $url_feat_img; ?>" class="gallery-fancybox" rel="group" title="<?php _e( $image->post_title , LANG ); ?>">
											<!-- Imagen --> <figure>
												<?= get_the_post_thumbnail( $image->ID , 'full' , array('class'=>'img-fluid imgNotBlur') ); ?>
											</figure> <!-- /.figure -->
										</a> <!-- /.link  -->
									</article> <!-- /.item-gallery -->
								<?php endif; ?>
							<?php endforeach; ?>
						</div> <!-- /.row -->
					</section> <!-- /. pageGallery__content-->
			
				</article> <!-- /. -->

			</main> <!-- /.col-xs-12 -->

			<!-- Sidebar  Ocultar en mobile -->
			<aside class="col-md-4 hidden-xs-down">
				
				<!-- Sección de Categorias de Imagen  -->
				<section class="sectionLinks__sidebar">
					<!-- Extraemos todos las categorias de imagen que se encuentra en la variable $cats_imagenes -->
					<?php
						foreach( $cats_imagenes as $cat_imagen ) : 	
					?>
						<a href="<?= get_term_link( $cat_imagen->slug , 'image_category' ); ?>" class="link-to-item <?= $current_term->term_id == $cat_imagen->term_id ? 'active' : '' ?>"><?php _e( $cat_imagen->name , LANG  ); ?></a>
					<?php endforeach; ?>
				</section> <!-- /.sectionLinks__sidebar -->


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

				<!-- Separador --> <p></p>			

			</aside> <!-- /.col-md-4 hidden-xs-down -->

		</div> <!-- /.row -->
	</div> <!-- /.container -->

</section> <!-- /.pageRooms -->

<!-- Footer -->
<?php get_footer(); ?>