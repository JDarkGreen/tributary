<?php  
	// The Query
	$args = array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_status'    => 'publish',
		'post_type'      => 'slider-home',
		'posts_per_page' => -1,
	);

	$the_query = new WP_Query( $args );

	//Control Loop
	$i = $j = 0;

	// The Loop
	if ( $the_query->have_posts() ) : 

?>

<!-- Contenedor Con Posicion relativa -->
<section class="relative">
	
	<!-- Contenedor de bannner   -->
	<section id="carousel-home" class="pageInicio__slider carousel slide" data-ride="carousel">
		
		<!-- Indicadores o dots  -->
		<?php /*
		<ol class="carousel-indicators">
		<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
	  	<li data-target="#carousel-home" data-slide-to="<?= $j ?>" class="<?= $j == 0 ? 'active' : '' ?>"></li>
		<?php $j++; endwhile; wp_reset_postdata(); ?>
	  	</ol> <!-- /.carousel-indicators -->

	  	*/ ?>

		<!-- Wrapper for Carousel -->
		<div class="carousel-inner" role="listbox">

			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
			
			<!-- Obtener Imagen Destacada o en su defect oobtener un place image -->
			<?php  
				$feat_image = "";
				if( has_post_thumbnail() ) : 
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
				else: 
					$feat_image = "https://placeimg.com/1920/721/any";
				endif;
			?>

		    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>" style='background-image: url("<?= $feat_image; ?>")'>
				
				<!-- Imagen -->
				<!--img src="<?= $feat_image; ?>" alt="" class="img-fluid hidden-xs-down"-->

		    	<!-- Caption o Información -->
					<div class="carousel-caption text-xs-left">
	    			<!-- Título -->
	    			<?php 
	    				//$title    = explode(" ", get_the_title() );
	    				//$title1   = array_slice( $title , 0 , 2 ) ;
	    				//$title2   = array_slice( $title , 2 ) ;
	    			?>
	    			<h3 class="text-uppercase"><?= get_the_title(); ?></h3> 
	    			<!-- Separación en Desktop --> <br class="hidden-xs-down" />

	    			<!-- Botón de Contacto -->
	    			<a href="#" class="btnCommon__show-more text-uppercase"><?php _e( "contáctanos" , LANG ); ?></a>

	    			<!-- Subtitulo o párrafo  -->
	    			<!--p class="text-uppercase"><?= get_the_content(); ?></p-->


	  			</div>	<!-- /.carousel-caption -->    

		    </div> <!-- /.arousel-item -->
	  	<?php $i++; endwhile; wp_reset_postdata(); ?>

	  </div> <!-- /.carousel-inner -->

	</section> <!-- /.carousel-home -->

	
	<!-- Seccion de Flechas de Carousel -->
	<a href="#" id="arrowSliderHome--prev" class="js-btn-carousel-home arrowSliderHome arrow__common-slider arrowSliderHome--prev">
		<i class="fa fa-chevron-left" aria-hidden="true"></i>
	</a>	

	<a href="#" id="arrowSliderHome--next" class="js-btn-carousel-home arrowSliderHome arrow__common-slider arrowSliderHome--next">
		<i class="fa fa-chevron-right" aria-hidden="true"></i>
	</a>	

	<!-- Imagen Posterior Lobo -->
	<!--div class="pageInicio__slider__image">
		<img src="<?= IMAGES ?>/img_background/vector_paracas_sunset_lima_peru.png" alt="paracas-sunset-reserva-lima-peru" class="img-fluid" />
	</div> <!-- /.pageInicio__slider__image -->
	
</section>



<?php endif; wp_reset_postdata(); ?>

