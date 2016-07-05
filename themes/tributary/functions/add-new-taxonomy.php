<?php  

//Archivo que agrega nuevas taxonomias al tema

//create a custom taxonomy
add_action( 'init', 'create_category_taxonomy', 0 );

function create_category_taxonomy() {

/* categorias servicio */
  $labels = array(
    'name'             => __( 'Categoría Servicio'),
    'singular_name'    => __( 'Categoría Servicio'),
    'search_items'     => __( 'Buscar Categoría Servicio'),
    'all_items'        => __( 'Todas Categorías del Servicio' ),
    'parent_item'      => __( 'Categoría padre del Servicio' ),
    'parent_item_colon'=> __( 'Categoría padre:' ),
    'edit_item'        => __( 'Editar categoría de Servicio' ), 
    'update_item'      => __( 'Actualizar categoría de Servicio' ),
    'add_new_item'     => __( 'Agregar nueva categoría de Servicio' ),
    'new_item_name'    => __( 'Nuevo nombre categoría de Servicio' ),
    'menu_name'        => __( 'Categoria Servicio' ),
  ); 

// Now register the taxonomy
  register_taxonomy('servicio_category',array('servicio'), array(
    'hierarchical'     => true,
    'labels'           => $labels,
    'show_ui'          => true,
    'show_admin_column'=> true,
    'query_var'        => true,
    'rewrite'          => array( 'slug' => 'servicio-category' ),
  ));

/* categorias clientes 
  $labels2 = array(
    'name'             => __( 'Categoría Cliente'),
    'singular_name'    => __( 'Categoría Cliente'),
    'search_items'     => __( 'Buscar Categoría Cliente'),
    'all_items'        => __( 'Todas Categorías del Cliente' ),
    'parent_item'      => __( 'Categoría padre del Cliente' ),
    'parent_item_colon'=> __( 'Categoría padre:' ),
    'edit_item'        => __( 'Editar categoría de Cliente' ), 
    'update_item'      => __( 'Actualizar categoría de Cliente' ),
    'add_new_item'     => __( 'Agregar nueva categoría de Cliente' ),
    'new_item_name'    => __( 'Nuevo nombre categoría de Cliente' ),
    'menu_name'        => __( 'Categoria Cliente' ),
  ); 

// Now register the taxonomy
  register_taxonomy('cliente_category',array('cliente'), array(
    'hierarchical'     => true,
    'labels'           => $labels2,
    'show_ui'          => true,
    'show_admin_column'=> true,
    'query_var'        => true,
    'rewrite'          => array( 'slug' => 'cliente-category' ),
  )); */

  /* categorias Imagenes */
  $labels3 = array(
    'name'             => __( 'Categoría Imagen'),
    'singular_name'    => __( 'Categoría Imagen'),
    'search_items'     => __( 'Buscar Categoría Imagen'),
    'all_items'        => __( 'Todas Categorías de la Imagen' ),
    'parent_item'      => __( 'Categoría padre de la Imagen' ),
    'parent_item_colon'=> __( 'Categoría padre:' ),
    'edit_item'        => __( 'Editar categoría de la Imagen' ), 
    'update_item'      => __( 'Actualizar categoría de la Imagen' ),
    'add_new_item'     => __( 'Agregar nueva categoría de la Imagen' ),
    'new_item_name'    => __( 'Nuevo nombre categoría de la Imagen' ),
    'menu_name'        => __( 'Categoria Imagen' ),
  ); 

  // Now register the taxonomy
  register_taxonomy('image_category',array('galery-images'), array(
    'hierarchical'     => true,
    'labels'           => $labels3,
    'show_ui'          => true,
    'show_admin_column'=> true,
    'query_var'        => true,
    'rewrite'          => array( 'slug' => 'image-category' ),
  ));   

  /* categorias promoción */
  $labels4 = array(
    'name'             => __( 'Categoría Promoción'),
    'singular_name'    => __( 'Categoría Promoción'),
    'search_items'     => __( 'Buscar Categoría Promoción'),
    'all_items'        => __( 'Todas Categorías de la Promoción' ),
    'parent_item'      => __( 'Categoría padre de la Promoción' ),
    'parent_item_colon'=> __( 'Categoría padre:' ),
    'edit_item'        => __( 'Editar categoría de la Promoción' ), 
    'update_item'      => __( 'Actualizar categoría de la Promoción' ),
    'add_new_item'     => __( 'Agregar nueva categoría de la Promoción' ),
    'new_item_name'    => __( 'Nuevo nombre categoría de la Promoción' ),
    'menu_name'        => __( 'Categoria Promoción' ),
  ); 

  // Now register the taxonomy
  register_taxonomy('promotion_category',array('promocion'), array(
    'hierarchical'     => true,
    'labels'           => $labels4,
    'show_ui'          => true,
    'show_admin_column'=> true,
    'query_var'        => true,
    'rewrite'          => array( 'slug' => 'promotion-category' ),
  ));  


}


?>