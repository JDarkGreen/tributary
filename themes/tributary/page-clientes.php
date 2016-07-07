<?php /* Template Name: Página Clientes Plantilla */ ?>

<!-- Header -->
<?php get_header(); $theme_mod = get_theme_mod('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - o -Pagina 

	/* Conseguimos la pagina de servicios */
	$banner = $post;  // Seteamos la variable banner de acuerdo a la página
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	<div class="container">
		
		<!-- Seccion de Contenido -->
		<section class="pageClientes__content">
			<div class="row">

				<?php //Obtener los sectores o categorias de los clientes
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'cliente',
						'posts_per_page' => -1,
					);
					$sectores = get_posts( $args );

					/* Comprobar que existan los sectores y entonces hacer el recorrido */
					if( !empty($sectores) ) : foreach( $sectores as $sector ) : 
				?> <!-- Articulo  -->
					<div class="col-xs-12 col-md-4">
						<article class="itemCliente">
							<!-- Imagen -->
							<figure>
								<?php  
									$image_feat = wp_get_attachment_url( get_post_thumbnail_id( $sector->ID ) );
									if( !empty($image_feat) ) :
								?> <!-- Fancybox -->
								<a href="<?= $image_feat; ?>" class="gallery-fancybox" >
									<img src="<?= $image_feat; ?>" alt="sector-<?= $sector->post_title; ?>" class="img-fluid imgNotBlur" />
								</a> <!-- /. -->
								<?php endif; ?>
							</figure> <!-- /.figure -->

							<!-- Titulo -->
							<h2 class="pageSectionCommon__title text-uppercase"><?php _e( $sector->post_title , LANG ); ?></h2>

							<!-- Limpiar floats --> <div class="clearfix"></div>

							<!-- Contenido o Lista de cliente -->
							<div class="itemCliente__content">
								<?php 
									if( !empty($sector->post_content) ) : 
									echo apply_filters('the_content', $sector->post_content );
									else: 
								?> <p> <?php _e("Actualizando Lista" , LANG  ); ?></p>
								<?php endif; ?>
							</div> <!-- /. -->

						</article> <!-- /.itemCliente -->

						<!-- Separación en mobile --> <br class="hidden-sm-up" />
					</div> <!-- /.col-xs-12 col-md-4 -->
				<?php endforeach; endif;  ?>

			</div> <!-- /.row -->
		</section> <!-- /.pageClientes__content -->	

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