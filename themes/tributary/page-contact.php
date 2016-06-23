<?php /* Template Name: Página Contacto Plantilla */ ?>

<!-- Header -->
<?php get_header(); $options = get_option('theme_custom_settings');  ?>

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Seccion General -->
<section class="pageWrapper">
	
	<div class="container">

		<div class="row">

			<div class="col-xs-6">
	
				<!-- SECCIÓN DE DATOS  -->
				<section class="pageContact__data">
					<!-- Titulo --> <h2 class="titleDescriptionSection text-uppercase"><?php _e( "Datos" , LANG ); ?></h2>

					<!-- Lista de Datos -->
					<ul class="">

						<!-- Telefono -->
						<?php if( isset($options['contact_tel']) && !empty($options['contact_tel']) ) : ?>
							<li>
								<!-- Icono --> <i class="fa fa-mobile" aria-hidden="true"></i> <?php _e( "Reservas: " , LANG ) ?>
								<?php 
									$numeros = $options['contact_tel'];
									$numeros = explode( "," , $numeros );
									foreach( $numeros as $numero => $value ) : 
								?> <p> <?= $value; ?></p> /
								<?php endforeach; ?>

								<!-- Segundo Teléfono de Recepción -->
								<?php if( isset($options['contact_tel_2']) && !empty($options['contact_tel_2']) ) : echo "<br/>" . __("Recepción: " . $options['contact_tel_2'] , LANG ); 
									endif; 
								?>

							</li>
						<?php endif; ?>

						<!-- Email -->
						<?php if( isset($options['contact_email']) && !empty($options['contact_email']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-envelope" aria-hidden="true"></i>
								<p class="featured"> <?= $options['contact_email']; ?> </p>
							</li>
						<?php endif; ?>

						<!-- Ubicación -->
						<?php if( isset($options['contact_address']) && !empty($options['contact_address']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-map-marker" aria-hidden="true"></i>
							<?= $options['contact_address']; ?> 
							</li>
						<?php endif; ?>

					</ul> <!-- /ul -->

				</section> <!-- /. -->

				<!-- SECCIÓN DE REDES SOCIALES  -->
				<section class="pageContact__social">
					<!-- Titulo --> <h2 class="titleDescriptionSection text-uppercase"><?php _e( "redes sociales" , LANG ); ?></h2>

					<!-- Lista de Redes Sociales -->
					<ul class="social-links social-links--red">
						<!-- Facebook -->
						<?php if( isset($options['red_social_fb']) && !empty($options['red_social_fb']) ) : ?>
							<li><a target="_blank" href="<?= $options['red_social_fb']; ?>">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a></li>
						<?php endif; ?>
						<!-- Twitter -->
						<?php if( isset($options['red_social_twitter']) && !empty($options['red_social_twitter']) ): ?>
							<li><a target="_blank" href="<?= $options['red_social_twitter']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
						<?php endif; ?>
						<!-- Youtube -->
						<?php if( isset($options['red_social_ytube']) && !empty($options['red_social_ytube']) ) : ?>
							<li><a target="_blank" href="<?= $options['red_social_ytube']; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
						<?php endif; ?>
					</ul> <!-- /.social-links -->

				</section> <!-- /. -->
				
			</div> <!-- /.col-xs-6 -->

			<div class="col-xs-6">

				<!-- SECCIÓN DE REDES SOCIALES  -->
				<section class="pageContact__formulary">
					<!-- Titulo --> <h2 class="titleDescriptionSection text-uppercase"><?php _e( "formulario" , LANG ); ?></h2>

					<!-- Formulario -->
					<form id="form-contacto" action="" class="pageContacto__form" method="POST">

						<!-- Nombre -->
						<div class="pageContacto__form__group">
							<label for="input_name" class="sr-only"></label>
							<input type="text" name="input_name" placeholder="<?php _e( 'Nombres', LANG ); ?>" required />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Email -->
						<div class="pageContacto__form__group">
							<label for="input_email" class="sr-only"></label>
							<input type="email" name="input_email" placeholder="<?php _e( 'E-mail', LANG ); ?>" data-parsley-trigger="change" required="" data-parsley-type-message="Escribe un email válido"/>
						</div> <!-- /.pageContacto__form__group -->						

						<!-- Teléfono -->
						<div class="pageContacto__form__group">
							<label for="input_phone" class="sr-only"></label>
							<input type="text" id="input_phone" name="input_phone" placeholder="Teléfono" data-parsley-type='digits' data-parsley-type-message="Solo debe contener números" required="" />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Texto -->
						<div class="pageContacto__form__group">
							<label for="input_email" class="sr-only"></label>
							<textarea name="input_consulta" id="" placeholder="<?php _e( 'Su Mensaje', LANG ); ?>" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas más de 20 caracteres" data-parsley-validation-threshold="10"></textarea>
						</div> <!-- /.pageContacto__form__group -->

						<button type="submit" id="send-form" class="btnCommon__show-more btnCommon__show-more--rojo text-uppercase pull-xs-right">
							<?php _e( 'enviar' , LANG ); ?>
						</button> <!-- /.btn__send-form -->

						<!-- Limpiar Floats  --> <div class="clearfix"></div>

					</form> <!-- /.pageContacto__form -->

				</section> <!-- /. -->				

			</div> <!-- /.col-xs-6 -->

		</div> <!-- /.row -->

	</div> <!-- /.container -->

	<!-- Sección de Mapa -->
	<section class="pageContact__map">
		
		<div class="container"> <!-- Titulo --> <h2 class="titleDescriptionSection text-uppercase col-xs-6"><?php _e( "ubicación" , LANG ); ?></h2> </div>
		
		<?php if( isset($options['contact_mapa']) && !empty($options['contact_mapa']) ) : ?>
		<div id="canvas-map"></div>
		<?php else: ?>
			<div class="container"> <?php _e("Actualizando Contenido" , LANG ); ?></div>
		<?php endif; ?>

	</section> <!-- /.pageContact__map -->

</section> <!-- /.pageWrapper -->

<!-- Script Google Mapa -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNMUy9phyQwIbQgX3VujkkoV26-LxjbG0"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Scripts Solo para esta plantilla -->
<?php 
	if( !empty($options['contact_mapa']) ) : 
	$mapa = explode(',', $options['contact_mapa'] ); 

	$zoom_mapa = isset( $options['contact_mapa_zoom'] ) && !empty( $options['contact_mapa_zoom'] ) ? $options['contact_mapa_zoom'] : 16;
?>
	<script type="text/javascript">	

		<?php  
			$lat = $mapa[0];
			$lng = $mapa[1];
		?>

	    var map;
	    var lat = <?= $lat ?>;
	    var lng = <?= $lng ?>;

	    function initialize() {
	      //crear mapa
	      map = new google.maps.Map(document.getElementById('canvas-map'), {
	        center: {lat: lat, lng: lng},
	        zoom  : <?= $zoom_mapa; ?>,
	      });

	      //infowindow
	      var infowindow    = new google.maps.InfoWindow({
	        content: '<?= "Paracas Sunset" ?>'
	      });

	      //icono
	      //var icono = "<?= IMAGES ?>/icon/contacto_icono_mapa.jpg";

	      //crear marcador
	      marker = new google.maps.Marker({
	        map      : map,
	        draggable: false,
	        animation: google.maps.Animation.DROP,
	        position : {lat: lat, lng: lng},
	        title    : "<?php _e(bloginfo('name') , LANG )?>",
	        icon     : "<?= IMAGES . '/icon/icon_map.png' ?>",
	      });
	      //marker.addListener('click', toggleBounce);
	      marker.addListener('click', function() {
	        infowindow.open( map, marker);
	      });
	    }

	    google.maps.event.addDomListener(window, "load", initialize);

	</script>
<?php endif; ?>

<!-- Footer -->
<?php get_footer(); ?>