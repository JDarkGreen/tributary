<?php /* Single Name: Single Servicios Plantilla */ ?>

<!-- Header -->
<?php get_header(); $theme_mod = get_theme_mod('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - o -Pagina 

	/* Conseguimos la pagina de servicios */
	$page = get_page_by_path("servicios");
	$banner = $page;  // Seteamos la variable banner de acuerdo a la página
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	<div class="container">
		
		<!-- Seccion de Contenido -->
		<section class="pageServicios__content">
			<div class="row">

				<div class="col-xs-12 col-md-4">
					<!-- Sidebar de Servicios -->
					<aside class="sidebarCommon">
						<!-- Titulo de Sidebar --> <h2 class="titleSidebar"> <?php _e( "Servicios" , LANG ); ?></h2>

						<?php //Obtener los nombres y enlaces de los servicios 
							$args = array(
								'order'          => 'ASC',
								'orderby'        => 'menu_order',
								'post_status'    => 'publish',
								'post_type'      => 'servicio',
								'posts_per_page' => -1,
							);
							$services = get_posts( $args );
							if( !empty($services) ) : foreach( $services as $service ) :
						?> <!-- Botones -->
						<a href="<?= get_permalink($service->ID); ?>" class="<?= $post->ID === $service->ID ? 'active' : '' ?>"><?php _e( $service->post_title , LANG ); ?>
							<!-- Icon  -->
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</a>
						<?php endforeach; endif; ?>						
					</aside> <!-- /.sidebarServices -->

					<!-- Separación en mobile --> 
					<br class="hidden-sm-up" />

				</div> <!-- /.col-xs-4 -->

				<div class="col-xs-12 col-md-8">
					<section>

						<!-- Titulo  --> <h2 class="pageSectionCommon__title text-uppercase text-xs-left"> <span class="relative"> <?php _e( $post->post_title . " :" , LANG ); ?> </span> </h2>

						<!-- Separador --> 
						<p class="clearfix"></p>
						<p class="clearfix"></p>

						<!-- Imagen -->
						<figure class="singleService__image">
							<?php if( has_post_thumbnail( $post->ID ) ) : 
								echo get_the_post_thumbnail( $post->ID , 'full' , array('class'=>'img-fluid') );
								endif;
							?>
						</figure> <!-- /.singleService__image -->

						<!-- Separacion  --> <br>

						<!-- Contenido  -->
						<?php 
							if( !empty($post->post_content) ) : 
							echo apply_filters('the_content' , $post->post_content);
							else: 
							echo apply_filters('the_content' , "Actualizando Contenido" );
							endif;
						?>

					</section> <!-- /.section -->
				</div> <!-- /.col-xs-8 -->
				
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