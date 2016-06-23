<?php /* Archivo que contiene el partial de carousel clientes */ ?>

<!-- Seccion Clientes  -->
<section class="pageInicio_clientes">
	<div class="container">
		<!-- Titulo --> <h2 class="pageCommon__title text-xs-center text-uppercase"> <?php _e( 'nuestros clientes' , LANG ) ?></h2>
		<!-- Subtitle --> <h3 class="pageCommon__subtitle text-xs-center"> Les ofrecemos el mejor servicio en todas las áreas de <strong>DISEÑO</strong> y <strong>PROGRAMACIÓN DIGITAL</strong> </h3>		

		<!-- Contenedor relativo -->
		<div class="relative">

			<!-- Wrapper de clientes -->
			<div id="carousel-clientes" class="pageInicio_clientes__gallery">
				<?php /*Extraer los clientes*/ 
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_status'    => 'publish',
						'post_type'      => 'cliente',
						'posts_per_page' => -1,
					);
					$clientes = get_posts( $args );
					foreach( $clientes as $cliente ) :
				?> <!-- Imagen -->
					<figure>
						<?= get_the_post_thumbnail( $cliente->ID,'full',array('class'=>'img-fluid') ); ?>
					</figure> <!-- /figure -->
				<?php endforeach; ?> 
			</div> <!-- /.pageInicio_clientes__gallery -->

			<!-- Flechas de Carousel  -->
			<a href="#" id="arrow__cliente--prev" class="arrow__common-slider arrow__common-slider--prev">
				<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
			</a>

			<a href="#" id="arrow__cliente--next" class="arrow__common-slider arrow__common-slider--next">
				<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
			</a>

		</div> <!-- /.relative -->

	</div> <!-- /.container -->
</section> <!-- /.pageInicio_clientes -->