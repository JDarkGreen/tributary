<?php 
/* Parcial que incluye la plantilla 
	de articulos destacados y el facebook en caso de tenerlo
*/ ?>

<!-- /**************************************************************/ -->
<!-- /*++++++++++++++++ MISCELANEO +++++++++++++++++++++++++++++++*/ -->
<!-- /**************************************************************/ -->

<section class="pageInicio__miscelaneo">
	
	<section class="container">
		<div class="row">

			<!-- Seccion de Articulos -->
			<section class="sectionPage__articles col-xs-12 col-sm-8">

				<!-- Titulo -->
				<h2 class="PageCommon__subtitle text-uppercase"><?php _e('Artículos', LANG ); ?></h2>

				<?php  
					//Obtener todos los posts
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'post_type'      => 'post',
						'posts_per_page' => 6,
					);

					$ultimos_posts = get_posts( $args ); #var_dump($ultimos_posts);
				?>
				<div id="carousel-articles">
					<ul>
					<?php foreach( $ultimos_posts as $u_post ) : ?>
						<li>
						<article class="sectionPage__articles__item">
							<!-- Imagen -->
							<figure class="pull-xs-left">
								<?php $image = get_the_post_thumbnail( $u_post->ID , array(210,96) ); echo $image; ?>
							</figure><!-- /figure -->
							<!-- Texto -->
							<h3 class="sectionPage__articles__item__title">
								<?php _e( $u_post->post_title , LANG ); ?></h3>
							<!-- Extracto 30 palabras -->
							<p class="sectionPage__articles__item__excerpt text-justify">
								<?php _e( wp_trim_words( $u_post->post_content , 30 , '' ) , LANG ); ?>
								<a href="<?= $u_post->guid ?>">Leer más <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a>
							</p>
						</article><!-- /.sectionPage__articles__item -->

						<!-- Limpiar float --> <div class="clearfix"></div>
					<?php endforeach; ?>
						</li>
					</ul>
				</div><!-- /#bxslider-carousel-articles -->
			</section><!-- /.sectionPage__articles -->

			<!-- Seccion widget facebook - Ocultar en version mobile -->
			<section class="sectionHomeFacebook col-xs-12 col-sm-4 text-xs-center">
			
				<!-- Titulo -->
				<h2 class="PageCommon__subtitle text-uppercase text-xs-left"><?php _e('Facebook', LANG ); ?></h2>

				<?php $link_facebook = $options['red_social_fb']; 
					if( !empty($link_facebook) ) :
				?>

					<div id="fb-root"></div> <!-- /fb root -->

					<!-- Script -->
					<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>

					<div class="fb-page" data-href="<?= $link_facebook ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-height="375" data-hide-cover="false" data-show-facepile="true">
						<div class="fb-xfbml-parse-ignore">
							<blockquote cite="<?= $link_facebook ?>">
								<a href="<?= $link_facebook ?>"><?php bloginfo('name'); ?></a>
							</blockquote>
						</div> <!-- /.fb-xfbml-parse-ignore -->
					</div> <!-- /.fb-page -->
				<?php endif; ?>
			</section>  <!-- /.sectionHomeFacebook -->
		
		</div> <!-- /.row -->
	</section> <!-- /.container -->

</section> <!-- /.pageInicio__miscelaneo -->