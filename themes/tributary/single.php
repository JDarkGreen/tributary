<?php /* Pagina Single */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Get Header -->
<?php get_header(); ?>

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

				<article class="pageWrapper__article item-preview-post">

					<!-- Titulo --> <h3 class="titleDescriptionSection"><?php _e( $post->post_title , LANG ); ?></h3>

					<!-- Imagen -->
					<figure>
						<?php if( has_post_thumbnail( $post->ID ) ) : ?>
							<?= get_the_post_thumbnail( $post->ID , 'full' , array('class'=>'img-fluid imgNotBlur') ); ?>
						<?php endif; ?>
					</figure> <!-- /. -->

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

				</article> <!-- /. -->

			</main> <!-- /.col-xs-12 -->
			<!-- Sidebar  Ocultar en mobile -->
			<aside class="col-md-4 hidden-xs-down">
				
				<!-- Sección de Categorías -->
				<section class="sectionLinks__sidebar">
					<!-- Titulo --> <h2 class="text-capitalize"><?php _e( "Categorías" , LANG ); ?></h2>

					<?php foreach( $categorias as $categoria ) : ?>
						<a href="<?= get_term_link( $categoria ); ?>" class="link-to-item <?= $first_cat->term_id == $categoria->term_id ? 'active' : '' ?>"><?php _e( $categoria->name , LANG  ); ?></a>
					<?php endforeach; ?>

				</section> <!-- /.sectionLinks__sidebar -->
				
				<!-- Sidebar Activo -->
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

</main> <!-- /.pageWrapper -->

<!-- Get Footer -->
<?php get_footer(); ?>