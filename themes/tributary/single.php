<?php /* Pagina Single */ 

	get_header(); 
	$options   = get_option('theme_custom_settings'); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>
<!-- Incluir Banner de Pagina -->
<?php
	global $post;
	$page         = get_page_by_path('blog');  //buscamos el objeto de acuerdo a la página
	$banner       = $page;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Global -->
<main class="pageWrapper pageBlog">
	
	<div class="container">
		<div class="row">

			<!-- Articulo Principal -->
			<main class="col-xs-12 col-md-8">

				<?php 
					/* Extraer todas las categorías padre */  
					$categorias = get_categories( array(
						'orderby' => 'name' , 'parent' => 0,
					) );
				?>

				<article class="pageBlog__article item-preview-post">

					<!-- Titulo --> <h3 class="text-uppercase"><?php _e( $post->post_title , LANG ); ?></h3>

					<!-- Imagen -->
					<figure>
						<?php if( has_post_thumbnail( $post->ID ) ) : ?>
							<?= get_the_post_thumbnail( $post->ID , 'full' , array('class'=>'img-fluid imgNotBlur') ); ?>
						<?php endif; ?>
					</figure> <!-- /. -->
					
					<!-- Separación -->
					<p class="clearfix"></p><p class="clearfix"></p>

					<!-- Contenido -->
					<div class="text-justify">
						<?php 
							if( !empty( $post->post_content ) ) : 
							echo _e( apply_filters('the_content' , $post->post_content ) , LANG );
							endif;
						?>
					</div> <!-- /.text-justify -->

					<!-- Enviar Permalink -->
					<?php $the_link_share = get_permalink( $post->ID ); ?>

					<!-- Sección Compartir en Redes Sociales -->
					<?php include( locate_template("partials/section-share-type-post.php") ); ?>

				</article> <!-- /.pageBlog__article -->

			</main> <!-- /.col-xs-12 -->
			<!-- Sidebar  Ocultar en mobile -->
			<aside class="col-md-4 hidden-xs-down">
				
				<!-- Incluir plantilla -->
				<?php include( locate_template("partials/sidebar-categories.php") ); ?>
				
				<!-- Separacion  -->		
				<p class="clearfix"></p>
				<p class="clearfix"></p>
				
				<!-- Sección Facebook -->
				<?php
					if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ) :
				?>
					<section class="container__facebook">
						
						<!-- Titulo  --> <h2 class="titleSidebar"> <?php _e( "Facebook" , LANG ); ?></h2>

						<!-- Content -->
						<div id="fb-root" class=""></div>

						<!-- Script -->
						<script>(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>

						<div class="fb-page" data-href="<?= $theme_mod['red_social_fb']; ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-height="500" data-hide-cover="false" data-show-facepile="true">
						</div> <!-- /. fb-page-->
					</section> <!-- /.container__facebook -->
				<?php else: ?>
					<p class="text-xs-center">Opcion no habilitada temporalmente</p>
				<?php endif; ?>				

			</aside> <!-- /.col-md-4 hidden-xs-down -->

		</div> <!-- /.row -->
	</div> <!-- /.container -->

</main> <!-- /.pageWrapper -->

<!-- Get Footer -->
<?php get_footer(); ?>