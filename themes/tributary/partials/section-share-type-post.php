<?php /* Archivo que permite compartir un typo de post segun el link que proveenga */ ?>
<?php if( isset( $the_link_share ) && !empty( $the_link_share) ) : ?>

<section class="sectionCommon__social-links">
	<ul class="text-uppercase">
		<li> <?php _e("compartir en:"); ?></li>
		<!-- Facebook -->
		<li class="fb"><a href="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $the_link_share; ?>' , '_blank' , 'width=400 , height=500' ); void(0);"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		<!-- Twitter -->
		<li class="tw"><a href="javascript:window.open('https://twitter.com/intent/tweet?text=<?= '!Hola! este artículo me pareció interesante: ' . $the_link_share . ' !Visítalo!' ; ?>' , '_blank' , 'width=400 , height=500' ); void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a>	</li>				<!-- Google Plus -->
		<li class="gplus"><a href="javascript:window.open('https://plus.google.com/share?url=<?= $the_link_share; ?>' , '_blank' , 'width=400 , height=500' ); void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a>	</li>
	</ul> <!-- /.text-uppercase -->
</section> <!-- /.sectionCommon__social-links -->

<?php endif; ?>