<?php /* Sidebar Categorias  y artículos relacionados para el Blog */ ?>

<aside class="pageBlog__sidebar">

	<!-- Sección Categorías -->
	<section class="pageBlog__sidebar__categories">
		<!-- Título --> <h2 class="text-uppercase"><strong><?php _e('categorías',LANG); ?></strong></h2>
		<!-- Categorias -->
		<?php 
			$categories = get_terms( 'category', 'orderby=count&hide_empty=0' ); 
			#var_dump($categories);
			foreach( $categories as $cat ) : 
		?> <!-- Item categoría -->
		<div class="item-category">
			<?php 
				$class =  isset($category) && $category->term_id == $cat->term_id ? 'active' : ''; 
			?>
			<a class="<?= $class ?>" href="<?= get_category_link( $cat->term_id ); ?>"><?= $cat->name . " " . "(".$cat->count.")" ; ?></a>
		</div> <!-- /.item-category -->
		<?php endforeach; ?>
	</section> <!-- /.pageBlog__sidebar__categories -->

</aside> <!-- /.pageBlog__sidebar -->