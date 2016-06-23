<?php /* Template Name: Página Nosotros Hotel Plantilla */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Sección Descripción  -->
<section class="pageNosotros__description">
	<div class="container">
		<div class="row">
			<!-- Sección de Información -->
			<div class="col-xs-12 col-md-6">
				<!-- Titulo -->
				<h2 class="titleDescriptionSection titleDescriptionSection--red text-uppercase"><?php _e("paracas sunset hotel"); ?></h2>
				<!-- Texto --> 
				<div class="text-justify">
					<?php if( !empty( $post->post_content ) ) : echo apply_filters('the_content' , $post->post_content ); else: echo "<p>" . __("Actualizando Contenido" , LANG ) . "</p>"; endif; ?>
				</div>
			</div> <!-- /.col-xs-12 col-md-6 -->
			<div class="col-xs-12 col-md-6">
				<!-- Imagen Destacada -->
				<?php if( has_post_thumbnail( $post->ID ) ) :  ?>
					<figure><?= get_the_post_thumbnail( $post->ID , 'full' , array("class"=>'img-fluid') ); ?></figure>
				<?php else: echo "<p>" . __("Actualizando Contenido" , LANG ) . "</p>"; endif; ?>
			</div> <!-- /.col-xs-12 col-md-6 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.pageNosotros__description -->

<!-- Imagen De Bienvenidas -->
<figure class="pageNosotros__welcome relative">
	<img src="<?= IMAGES; ?>/img_background/welcome-paracas.jpg" alt="sunset-paracas-lima-reserva" class="img-fluid" />
	<!-- Texto de bienvenida --> <h2 class="text-capitalize container-flex align-content"><?php _e( "Bievenidos", LANG ); ?></h2>
</figure> <!-- /.pageNosotros__welcome -->

<!-- Incluir Banner de Servicios -->
<?php include( locate_template("partials/banner-services.php") ); ?>

<!-- Sección Beneficios -->
<section class="pageInicio__benefits">
	<div class="container">
		<!-- Titulo de Sección --> <h2 class="titleDescriptionSection text-uppercase text-xs-center">
		<span><?php _e('beneficios del hotel' , LANG ); ?></span></h2>

		<!-- Incluir Sección Beneficios de Hotel -->
		<?php include(locate_template("partials/section-hotel-benefits.php") ); ?>

	</div> <!-- /.container -->	
</section> <!-- /.pageInicio__benefits -->

<!-- Carousel Habitaciones -->
<section class="pageNosotros__rooms">
	<div class="container">

		<!-- Contenedor DE GALERÍA -->
		<div class="relative">
			<?php  
				/*
				*  Wrapper o Contenedor
				*  Attributos disponible 
				* data-items , data-items-responsive , data-margins , data-dots
				*/
			?>
			<div id="carousel-rooms" class="section__rooms_gallery js-carousel-gallery" data-items="1" data-items-responsive="1" data-margins="5" data-dots="true" >
				<!-- Obtener todas las habitaciones -->
				<?php  
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'habitacion',
						'posts_per_page' => 7,
					); 
					$rooms = get_posts( $args );
					foreach( $rooms as $room ) : 
				?> <!-- Artículo -->
					<article class="item-room relative">
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<!-- Titulo --> <h2 class="text-uppercase text-xs-center text-md-left"><?php _e( $room->post_title , LANG ); ?></h2>
								<!-- Extracto -->
								<div class="text-justify">
									<?php if( !empty($room->post_content) ) :
										echo apply_filters('the_content' , __(wp_trim_words( $room->post_content , 30 , '' ) , LANG ) ); 
										else: 
									?> 
									<p> <?php _e("Estamos actualizando este contenido esperamos su compresión, gracias por su preferencia, estamos a su servicio en todo momento." , LANG ); ?> </p>
									<?php endif; ?>	
								</div>
								<!-- Botones ver más y reservar -->
								<div class="item-room__buttons">
									
									<!-- Conseguir pagina contacto -->
									<?php $page_contact = get_page_by_path("contacto"); ?>
									<a href="<?= get_permalink( $page_contact->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--white text-uppercase"><?php _e('reservar ahora' , LANG ); ?></a>

									<a href="<?= get_permalink( $room->ID ); ?>" class="btnCommon__show-more btnCommon__show-more--white text-uppercase"><?php _e('ver más' , LANG ); ?></a>
								</div> <!-- /.item-room__buttons -->	
 							</div> <!-- /.col-xs-12 col-md-7 -->
							<div class="col-xs-12 col-md-6">
								<!-- Imagen -->
								<figure>
									<?php if( has_post_thumbnail( $room->ID ) ) : 
										echo get_the_post_thumbnail( $room->ID , 'full' , array('class'=>'img-fluid imgNotBlur') );
										endif;
									?>
								</figure>
							</div> <!-- /.col-xs-12 col-md-5 -->
						</div> <!-- /.row -->
					</article> <!-- /.item-tour -->

				<?php endforeach; ?>
			</div> <!-- /.section__rooms_gallery -->

			<!-- Flechas  -->
			<!-- Izquierda -->
			<a href="#" id="" class="js-carousel-prev arrow__common-slider arrow__common-slider--prev" data-slider="carousel-rooms">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>	
			<!-- Derecha -->
			<a href="#" id="" class="js-carousel-next arrow__common-slider arrow__common-slider--next" data-slider="carousel-rooms">
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
			</a>

		</div> <!-- /.relative -->	

	</div> <!-- /.container -->
</section> <!-- /.pageNosotros__rooms -->

<!-- Footer -->
<?php get_footer(); ?>