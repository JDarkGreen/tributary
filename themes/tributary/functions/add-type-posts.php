<?php  

//Archivo que contiene todos los nuevos tipos creados en el tema

function create_post_type(){

	/*|>>>>>>>>>>>>>>>>>>>> BANNERS  <<<<<<<<<<<<<<<<<<<<|*/
	
	$labels = array(
		'name'               => __('Slider Home'),
		'singular_name'      => __('Slider'),
		'add_new'            => __('Nuevo Slider'),
		'add_new_item'       => __('Agregar nuevo Slider Principal'),
		'edit_item'          => __('Editar Slider'),
		'view_item'          => __('Ver Slider'),
		'search_items'       => __('Buscar Slider'),
		'not_found'          => __('Slider no encontrado'),
		'not_found_in_trash' => __('Slider no encontrado en la papelera'),
	);

	$args = array(
		'labels'      => $labels,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => true,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag','banner_category'),
		'menu_icon'   => 'dashicons-nametag',
	);

	/*|>>>>>>>>>>>>>>>>>>>> SERVICIOS  <<<<<<<<<<<<<<<<<<<<|*/
	
	$labels2 = array(
		'name'               => __('Servicios'),
		'singular_name'      => __('Servicio'),
		'add_new'            => __('Nuevo Servicio'),
		'add_new_item'       => __('Agregar nuevo Servicio'),
		'edit_item'          => __('Editar Servicio'),
		'view_item'          => __('Ver Servicio'),
		'search_items'       => __('Buscar Servicios'),
		'not_found'          => __('Servicio no encontrado'),
		'not_found_in_trash' => __('Servicio no encontrado en la papelera'),
	);

	$args2 = array(
		'labels'      => $labels2,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes' ),
		'taxonomies'  => array( 'servicio_category' , 'post_tag' ),
		'menu_icon'   => 'dashicons-exerpt-view',
	);	

	/*|>>>>>>>>>>>>>>>>>>>> CLIENTES  <<<<<<<<<<<<<<<<<<<<|*/
	
	$labels3 = array(
		'name'               => __('Clientes'),
		'singular_name'      => __('Sector o Categoría'),
		'add_new'            => __('Nuevo Sector o Categoría'),
		'add_new_item'       => __('Agregar nuevo Sector o Categoría'),
		'edit_item'          => __('Editar Sector o Categoría'),
		'view_item'          => __('Ver Sector o Categoría'),
		'search_items'       => __('Buscar Sector o Categoría'),
		'not_found'          => __('Sector o Categoría no encontrado'),
		'not_found_in_trash' => __('Sector o Categoría no encontrado en la papelera'),
	);

	$args3 = array(
		'labels'      => $labels3,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-money',
	);	

	
	/*|>>>>>>>>>>>>>>>>>>>> GALERÍA IMAGENES  <<<<<<<<<<<<<<<<<<<<|*/
	
	$labels4 = array(
		'name'               => __('Gal. Imágenes'),
		'singular_name'      => __('Imagen'),
		'add_new'            => __('Nueva Imagen'),
		'add_new_item'       => __('Agregar nueva Imagen'),
		'edit_item'          => __('Editar Imagen'),
		'view_item'          => __('Ver Imagen'),
		'search_items'       => __('Buscar Imagen'),
		'not_found'          => __('Imagen no encontrada'),
		'not_found_in_trash' => __('Imagen no encontrada en la papelera'),
	);

	$args4 = array(
		'labels'      => $labels4,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag'),
		'menu_icon'   => 'dashicons-images-alt2',
	);	

	/*|>>>>>>>>>>>>>>>>>>>> GALERÍA VIDEOS  <<<<<<<<<<<<<<<<<<<<|*/
	
	$labels5 = array(
		'name'               => __('Gal. Videos'),
		'singular_name'      => __('Video'),
		'add_new'            => __('Nuevo Video'),
		'add_new_item'       => __('Agregar nuevo Video'),
		'edit_item'          => __('Editar Video'),
		'view_item'          => __('Ver Video'),
		'search_items'       => __('Buscar Video'),
		'not_found'          => __('Video no encontrado'),
		'not_found_in_trash' => __('Video no encontrado en la papelera'),
	);

	$args5 = array(
		'labels'      => $labels5,
		'has_archive' => true,
		'public'      => true,
		'hierachical' => false,
		'supports'    => array('title','editor','excerpt','custom-fields','thumbnail','page-attributes'),
		'taxonomies'  => array('post-tag','category'),
		'menu_icon'   => 'dashicons-video-alt',
	);

	/*|>>>>>>>>>>>>>>>>>>>> REGISTRAR  <<<<<<<<<<<<<<<<<<<<|*/
	register_post_type( 'slider-home' , $args  );
	register_post_type( 'servicio' , $args2 );
	register_post_type( 'cliente' , $args3 );
	register_post_type( 'galery-images' , $args4 );
	register_post_type( 'galery-videos' , $args5 );

	flush_rewrite_rules();
}

add_action( 'init', 'create_post_type' );



?>