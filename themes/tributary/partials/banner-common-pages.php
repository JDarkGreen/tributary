
<!-- Si existe el post  -->
<?php if( isset($banner) ) : ?>
	
	<!-- BANNER DE LA PAGINA -->
	<section class="pageCommon__banner relative">
		<!-- Conseguir el banner por defecto -->
		<?php 
			$img_banner = get_post_meta ($banner->ID, 'input_img_banner_'.$banner->ID , true); 
			if( empty($img_banner) || $img_banner == -1 ) {
				$img_banner = "https://placeimg.com/1920/202/any";
			}
		?>
		<figure style='background: url("<?= $img_banner; ?>")'>
			<!--img src="<?= $img_banner ?>" alt="banner-nosotros-empresa-tributary" class="img-fluid hidden-xs-down" /-->
		</figure>

		<!-- Título de la pagina posicion absoluta -->
		<h2 class="pageCommon__banner__title text-uppercase container-flex align-content"> 
			<?php
				if( isset($banner_title) && !empty($banner_title) ){
				 _e(  $banner_title , LANG ); 
				}else{
				 _e(  $banner->post_title , LANG ); 
				}
			?>
		</h2>

	</section> <!-- /.pageCommon__banner -->

<?php endif; ?>