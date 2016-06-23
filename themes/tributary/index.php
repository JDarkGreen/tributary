
<!-- Header -->
<?php 
	get_header(); 
	$options = get_option('theme_custom_settings'); 
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
		<!-- Titulo de secciones comunes --> <h2 class="titleCommon__page text-uppercase"> <?php _e( "servicios" , LANG ); ?></h2>
	</div> <!-- /.container -->
</section> <!-- /.pageInicio__services -->


<!-- Footer -->
<?php get_footer(); ?>