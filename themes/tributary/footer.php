
<!-- Extraer opciones  -->
<?php $theme_mod = get_theme_mod('theme_custom_settings'); ?>
	
	<!-- Footer -->
	<footer class="mainFooter">

		<!-- Seccion de Informacion  -->
		<section class="mainFooter__information">
			<div class="container">
				<div class="row">
					<!-- Item Footer -->
					<div class="col-xs-12 col-md-4">
						<div class="mainFooter__item">
							<!-- Logo -->
							<h1 class="">
								<a href="<?= site_url() ?>">
									<img src="<?= IMAGES ?>/logo.png" alt="tributary" class="img-fluid center-block" />
								</a>
							</h1> <!-- /.lgoo -->
							<!-- Titulo -->
							<p class="text-uppercase text-xs-center">www.tributaryperu.com</p>
						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->

					<!-- Item Footer -->
					<div class="col-xs-12 col-md-4">
						<div class="mainFooter__item">
							<!-- Titulo -->
							<h2 class="mainFooter__subtitle text-uppercase text-xs-center"><?php _e('contáctanos' , LANG ); ?></h2>

							<!-- Contenido Lista Datos -->
							<ul class="mainFooter__list-data">

								<!-- Ubicación -->
								<?php if( isset($theme_mod['contact_address']) && !empty($theme_mod['contact_address']) ) : ?>
									<li> <!-- Icono --> <i class="fa fa-map-marker" aria-hidden="true"></i>
									<?= $theme_mod['contact_address']; ?> 
									</li>
								<?php endif; ?>

								<!-- Telefono -->
								<?php if( isset($theme_mod['contact_tel']) && !empty($theme_mod['contact_tel']) ) : ?>
									<li> <!-- Icono --> <i class="fa fa-mobile" aria-hidden="true"></i>
									<?php 
										$numeros = $theme_mod['contact_tel'];
										$numeros = explode( "," , $numeros );
										foreach( $numeros as $numero => $value ) : 
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

							</ul> <!-- /.mainFooter__list-data -->

						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->

					<!-- Item Footer -->
					<div class="col-xs-12 col-md-3">
						<div class="mainFooter__item text-xs-center">
							<!-- Titulo -->
							<h2 class="mainFooter__subtitle text-uppercase"><?php _e('encuéntranos' , LANG ); ?></h2>
							
							<!-- Redes Sociales -->
							<ul class="social-links">
								<!-- Facebook -->
								<?php if( isset($theme_mod['red_social_fb']) && !empty($theme_mod['red_social_fb']) ) : ?>
									<li><a href="<?= $theme_mod['red_social_fb']; ?>">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a></li>
								<?php endif; ?>
								<!-- Twitter -->
								<?php if( isset($theme_mod['red_social_twitter']) && !empty($theme_mod['red_social_twitter']) ): ?>
									<li><a href="<?= $theme_mod['red_social_twitter']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
								<?php endif; ?>
								<!-- Youtube -->
								<?php if( isset($theme_mod['red_social_ytube']) && !empty($theme_mod['red_social_ytube']) ) : ?>
									<li><a href="<?= $theme_mod['red_social_ytube']; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
								<?php endif; ?>
							</ul> <!-- /.social-links -->
						</div> <!-- /.mainFooter__item -->
					</div> <!-- /.col-xs-12 col-md-3 -->
				</div> <!-- /.row -->
			</div> <!-- /.container -->
		</section> <!-- /.mainFooter__information -->

		<!-- Seccion de Desarrollo -->
		<section class="mainFooter__develop">
			<div class="container">
				<p class="pull-xs-right"> &copy; <?= date("Y"); ?> TributaryPeru. Derechos reservados Design by <a href="#">INGENIOART</a></p>
			</div> <!-- /.container -->
		</section> <!-- /.mainFooter__develop -->


	</footer><!-- /.mainFooter -->

	</div> <!-- /#sb-slidebar -->

	<?php wp_footer(); ?>

	<script> var url = "<?= THEMEROOT ?>"; </script>
</body>
</html>

