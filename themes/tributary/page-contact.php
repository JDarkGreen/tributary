<?php /* Template Name: Página Contacto Plantilla */ ?>

<!-- Header -->
<?php 
	get_header(); 
	$theme_mod = get_theme_mod('theme_custom_settings'); 
?>  

<!-- Incluir Banner de Pagina -->
<?php
	global $post; //Objeto actual - Pagina 
	$banner = $post;  // Seteamos la variable banner de acuerdo al post
	include( locate_template("partials/banner-common-pages.php") ); 
?>

<!-- Contenedor Principal -->
<main class="pageWrapper">
	
	<div class="container">
		
		<!-- Primera Fila -->
		<div class="row">

			<!-- SECCIÓN DE DATOS  -->
			<div class="col-xs-12 col-md-6">
	
				<section class="pageContact__data">
					<!-- Titulo --> <h2 class="pageSectionCommon__title text-uppercase text-xs-center text-md-left"><?php _e( "Datos generales" , LANG ); ?></h2> 
					<!-- Separación --> <br/>

					<!-- Lista de Datos -->
					<ul class="pageContact__list-data">

						<!-- Telefono -->
						<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-phone" aria-hidden="true"></i>
							<?php 
								$numeros = $theme_mod['contact_tel'];
								$numeros = explode( "," , $numeros );
								foreach( $numeros as $numero => $value ) : 
							?> <p> <?= $value; ?></p>
							<?php endforeach; ?>
							</li>
						<?php endif; ?>								

						<!-- Celular -->
						<?php if( isset($theme_mod['contact_cel']) && !empty($theme_mod['contact_cel']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-mobile" aria-hidden="true"></i>
							<?php 
								$celulares = $theme_mod['contact_cel'];
								$celulares = explode( "," , $celulares );
								foreach( $celulares as $celular => $value ) : 
							?> <p> <?= $value; ?></p>
							<?php endforeach; ?>
							</li>
						<?php endif; ?>

						<!-- Email -->
						<?php if( isset($theme_mod['contact_email']) && !empty($theme_mod['contact_email']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-envelope" aria-hidden="true"></i>
								<?= $theme_mod['contact_email']; ?>
							</li>
						<?php endif; ?>

						<!-- Dirección -->
						<?php if( isset($theme_mod['contact_address']) && !empty($theme_mod['contact_address']) ) : ?>
							<li> <!-- Icono --> <i class="fa fa-map-marker" aria-hidden="true"></i>
								<?= apply_filters( "the_content" , $theme_mod['contact_address'] ); ?>
							</li>
						<?php endif; ?>

					</ul> <!-- /.mainFooter__list-data -->

				</section> <!-- /. -->

				<!-- Separación en mobile --> <br class="hidden-sm-up" />

			</div> <!-- /.col-xs-12 col-md-6 -->

			<!-- SECCIÓN DE FORMULARIO DE CONTACTO  -->
			<div class="col-xs-12 col-md-6 text-xs-center text-md-left">

				<section class="pageContact__formulary">
					<!-- Titulo --> <h2 class="pageSectionCommon__title text-uppercase"><?php _e( "Nuestro formulario" , LANG ); ?></h2>

					<!-- Separación --> <br/>

					<!-- Formulario -->
					<form id="form-contacto" action="" class="pageContacto__form" method="POST">

						<!-- Nombre -->
						<div class="pageContacto__form__group">
							<label for="input_name" class="sr-only"></label>
							<input type="text" id="input_name" name="input_name" placeholder="<?php _e( 'Nombre(obligatorio)', LANG ); ?>" required />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Email -->
						<div class="pageContacto__form__group">
							<label for="input_email" class="sr-only"></label>
							<input type="email" id="input_email" name="input_email" placeholder="<?php _e( 'E-mail(obligatorio)', LANG ); ?>" data-parsley-trigger="change" required="" data-parsley-type-message="Escribe un email válido"/>
						</div> <!-- /.pageContacto__form__group -->						

						<!-- Teléfono -->
						<div class="pageContacto__form__group">
							<label for="input_phone" class="sr-only"></label>
							<input type="text" id="input_phone" name="input_phone" placeholder="<?php _e( 'Teléfono(obligatorio)', LANG ); ?>" data-parsley-type='digits' data-parsley-type-message="Solo debe contener números" required="" />
						</div> <!-- /.pageContacto__form__group -->

						<!-- Asunto -->
						<!--div class="pageContacto__form__group">
							<label for="input_subject" class="sr-only"></label>
							<input type="text" id="input_subject" name="input_subject" placeholder="<?php _e( 'Asunto', LANG ); ?>" required />
						</div> <! /.pageContacto__form__group -->

						<!-- Mensaje -->
						<div class="pageContacto__form__group">
							<label for="input_consulta" class="sr-only"></label>
							<textarea name="input_consulta" id="input_consulta" placeholder="<?php _e( 'Mensaje', LANG ); ?>" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Necesitas más de 20 caracteres" data-parsley-validation-threshold="10"></textarea>
						</div> <!-- /.pageContacto__form__group -->

						<button type="submit" id="send-form" class="btnCommon__show-more btnCommon__show-more--rojo text-uppercase">
							<?php _e( 'enviar' , LANG ); ?>
						</button> <!-- /.btn__send-form -->

						<!-- Limpiar Floats  --> <div class="clearfix"></div>

					</form> <!-- /.pageContacto__form -->

				</section> <!-- /. -->	

				<!-- Separación en mobile --> 
				<br class="hidden-sm-up" />			
				<br class="hidden-sm-up" />			

			</div> <!-- /.col-xs-12 col-md-6 text-xs-center text-md-left -->


		</div> <!-- /.row -->

		<!-- Separación margenes --> <div id="pageContact__separation"></div>	
		<!-- Limpiar floats --> <div class="clearfix"></div>

		<!-- Otra Fila row -->
		<div class="row">


			<!-- SECCIÓN DE REDES SOCIALES  -->
			<?php /*
			<div class="col-xs-12 col-md-6 text-xs-center text-md-left">

				<section class="pageContact__social">
					<!-- Titulo --> <h2 class="pageSectionCommon__title text-uppercase"><?php _e( "redes sociales" , LANG ); ?></h2>
					<!-- Separación  --> <br/>

					<!-- Lista de Redes Sociales -->
					<ul class="social-links social-links--gray">
						<!-- Facebook -->
						<?php if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ) : ?>
							<li><a target="_blank" href="<?= $theme_mod['red_social_fb']; ?>">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a></li>
						<?php endif; ?>
						<!-- Twitter -->
						<?php if( isset($theme_mod['red_social_twitter']) && !empty($theme_mod['red_social_twitter']) ): ?>
							<li><a target="_blank" href="<?= $theme_mod['red_social_twitter']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
						<?php endif; ?>
						<!-- Youtube -->
						<?php if( isset($theme_mod['red_social_ytube']) && !empty($theme_mod['red_social_ytube']) ) : ?>
							<li><a target="_blank" href="<?= $theme_mod['red_social_ytube']; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
						<?php endif; ?>
					</ul> <!-- /.social-links -->

				</section> <!-- /. -->
				
			</div> <!-- /.col-xs-12 col-md-6 -->
			*/?>

			<!-- SECCION DE MAPA -->
			<div class="col-xs-12">

				<section class="pageContact__map">
					
					<div class="container"> <!-- Titulo --> <h2 class="pageSectionCommon__title text-uppercase col-xs-6"><?php _e( "mapa" , LANG ); ?></h2> </div>

					<!-- Separador --> <br/>
					
					<?php if( isset($theme_mod['contact_mapa']) && !empty($theme_mod['contact_mapa']) ) : ?>
					<div id="canvas-map"></div>
					<?php else: ?>
						<div class="container"> <?php _e("Actualizando Contenido" , LANG ); ?></div>
					<?php endif; ?>

				</section> <!-- /.pageContact__map -->	

			</div> <!-- /.col-xs-12 col-md-6 -->

		</div> <!-- /.row -->

	</div> <!-- /.container -->

</main> <!-- /.pageWrapper -->

<!-- Script Google Mapa -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNMUy9phyQwIbQgX3VujkkoV26-LxjbG0"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Scripts Solo para esta plantilla -->
<?php 
	if( !empty($theme_mod['contact_mapa']) ) : 
	$mapa = explode(',', $theme_mod['contact_mapa'] ); 

	$zoom_mapa = isset( $theme_mod['contact_mapa_zoom'] ) && !empty( $theme_mod['contact_mapa_zoom'] ) ? $theme_mod['contact_mapa_zoom'] : 16;
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
	        content: '<?= "TRIBUTARY S.A.C" ?>'
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
	        //icon     : "<?= IMAGES . '/icon/icon_map.png' ?>",
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