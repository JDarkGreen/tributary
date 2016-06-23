<?php /* Archivo contiene la seccion beneficios de Hotel */ ?>
<div class="clearfix"></div>

<!-- BENEFICIOS DE HOTEL -->
<section class="pageInicio__benefits__content">
	<div class="row">
		<?php if ( is_active_sidebar( 'sidebar-benefits-hotel' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-benefits-hotel' ); ?>
		<?php else: __("Actualizando contenido" , LANG ) ; endif; ?>
	</div> <!-- /.row -->
</section>