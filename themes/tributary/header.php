<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	
	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon and Apple Icons -->
	
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	
	<?php 
		$theme_mod = get_theme_mod('theme_custom_settings');
		global $post;

		//Comprobar si esta desplegada la barra de Navegación
		$admin_bar = is_admin_bar_showing() ? 'mainHeader__active' : '';
	?>

<!-- Header -->

<!-- Contenedor Version Desktop -->
<header class="mainHeader hidden-xs-down relative">

		<!-- Barra de Información -->
		<section class="mainHeader__info">

			<!-- Contenedor -->
			<div class="container">

				<!-- Lista de Redes Sociales -->
				<ul class="social-links social-links--gray pull-xs-left">

					<!-- Facebook -->
					<?php if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ) : ?>
						<li><a target="_blank" href="<?= $theme_mod['red_social_fb']; ?>">
							<!--i class="fa fa-facebook" aria-hidden="true"></i-->
							<i>
								<img src="<?= IMAGES ?>/icon/redes_facebook-_chico_superior.png" alt="redes_facebook-_chico_superior" class="img-fluid" />
							</i>
						</a></li>
					<?php endif; ?>

					<!-- Twitter -->
					<?php if( isset($theme_mod['red_social_twitter']) && !empty($theme_mod['red_social_twitter']) ): ?>
						<li><a target="_blank" href="<?= $theme_mod['red_social_twitter']; ?>">
						<!--i class="fa fa-twitter" aria-hidden="true"></i-->
							<i>
								<img src="<?= IMAGES ?>/icon/redes_twiter_chico_superior.png" alt="redes_facebook-_chico_superior" class="img-fluid" />
							</i>
						</a> </li>
					<?php endif; ?>


					<!-- Youtube -->
					<?php if( isset($theme_mod['red_social_ytube']) && !empty($theme_mod['red_social_ytube']) ) : ?>
						<li><a target="_blank" href="<?= $theme_mod['red_social_ytube']; ?>">
						<!--i class="fa fa-youtube" aria-hidden="true"></i-->
							<i>
								<img src="<?= IMAGES ?>/icon/redes_youtube_chico_superior.png" alt="redes_youtube_chico_superior" class="img-fluid" />
							</i>

						</a> </li>
					<?php endif; ?>


				</ul> <!-- /.social-links -->

				<!-- Seccion  Solo de Informacion  -->
				<div class="mainHeader__info__content container-flex align-content pull-xs-right">
					<!-- Email -->
					<?php if( isset($theme_mod['contact_email']) && !empty($theme_mod['contact_email']) ) :
					?>
					<p> <!-- Icono --> 
						<i class="fa fa-envelope" aria-hidden="true"></i>
						<?= $theme_mod['contact_email']; ?>
					</p>
					<?php endif; ?>

					<!-- Teléfonos -->
					<?php 
						if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) :
						$numeros = $theme_mod['contact_tel']; 
						$numeros = explode(",", $numeros ); /* Obtener el primero numero */
					?>
						<p>
							<!-- Icono -->
							<i class="fa fa-phone" aria-hidden="true"></i>
							<?= $numeros[0] ?>
						</p>
					<?php endif; ?>
				</div> <!-- /.mainHeader__info__content -->	

			</div> <!-- /.container -->

		</section> <!-- /.mainHeader__info container-flex -->

		<!-- SEGUNDA PARTE LOGO Y NAGEGACION PRINCIPAL -->
		<div class="container">

			<div class="row">
				<div class="col-xs-5">
					<!-- Logo Principal -->
					<h1 class="logo">
						<a href="<?= site_url() ?>">
							<img src="<?= IMAGES ?>/logo.png" alt="tributario-contabilidad-auditoría-tributación-asesoría-laboral-financiera-administrativo-peru" class="img-fluid center-block" />
						</a>
					</h1> <!-- /.lgoo -->
				</div> <!-- /.col-xs-5 -->
				<div class="col-xs-7">
					<!-- Seccion Slogan -->
					<h2 class="mainHeader__slogan text-xs-right"><?php _e( "Contabilidad & Soluciones Empresariales" , LANG ); ?></h2>
					<!-- Navegacion Principal -->
					<nav class="mainNavigation">
						<?php wp_nav_menu(
							array(
								'menu_class'     => 'main-menu text-center',
								'theme_location' => 'main-menu'
							));
						?>			
					</nav> <!-- /.mainNavigation -->
				</div> <!-- /.col-xs-7 -->
			</div> <!-- /.row -->

		</div> <!-- /.container -->

</header> <!-- /.mainHeader  -->

<!-- Contenedor Version Mobile -->
<header class="mainHeader container-flex align-content hidden-sm-up sb-slide">

	<!-- Icono Izquierda -->
	<div id="toggle-left-nav" class="icon-header"> 
		<i class="fa fa-bars" aria-hidden="true"></i> 
	</div> <!-- /.icon-header -->	

	<!-- Logo Principal -->
	<h1 class="logo">
		<a href="<?= site_url() ?>">
			<?php if( !empty($theme_mod['logo']) ) : ?>
				<img src="<?= $theme_mod['logo'] ?>" alt="<?= "-logo-" . bloginfo('name') ?>" class="img-fluid center-block" />
			<?php else: ?>
				<img src="<?= IMAGES ?>/logo.png" alt="<?= "-logo-" . bloginfo('name') ?>" class="img-fluid center-block" />
			<?php endif; ?>
		</a>
	</h1> <!-- /.lgoo -->

	<!-- Icono Izquierda -->
	<div id="toggle-right-nav" class="icon-header"> 
		<i class="fa fa-bars" aria-hidden="true"></i> 
	</div> <!-- /.icon-header -->
	
</header> <!-- /.container-flex align-content hidden-sm-up -->


<!-- Contenedor Izquierda Version Mobile -->
<aside class="sb-slidebar sb-left sb-style-push">
	<!-- Navegación Principal -->
	<nav class="mainNavigation">
		<?php wp_nav_menu(
			array(
				'menu_class'     => 'main-menu text-center',
				'theme_location' => 'main-menu'
			));
		?>						
	</nav> <!-- /.mainNav -->  
</aside> <!-- /.sb-slidebar sb-left sb-style-push -->

<!-- Contenedor Derecha Version Mobile -->
<section class="sb-slidebar sb-right sb-style-push">
	<?php  
		/* Extraer todas las categorías padre */  
		$categorias = get_categories( array(
			'orderby' => 'name' , 'parent' => 0,
		) );
		
		/*Incluir plantilla de categorias */
		include( locate_template("partials/sidebar-categories.php") ); 
	?>
</section> <!-- /.sb-slidebar sb-right sb-style-push -->


<!-- Flecha Indicador hacia arriba -->
<a href="#" id="arrow-up-page"><i class="fa fa-angle-up" aria-hidden="true"></i></a>

<!-- Contenedor version mobile libreria sliderbar js -->
<div id="sb-site" class="">








