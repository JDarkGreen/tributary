<?php  

//Archivo crea nuevas columnas en el panel de administracion de wp

function add_thumbnail_columns( $columns ) {
    $columns = array(
		'cb'             => '<input type="checkbox" />',
		'featured_thumb' => 'Thumbnail',
		'title'          => 'Title',
		'author'         => 'Author',
		'categories'     => 'Categories',
		'tags'           => 'Tags',
		'comments'       => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
		'date'           => 'Date'
    );
    return $columns;
}

function add_thumbnail_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_thumb':
        echo '<a href="' . get_edit_post_link() . '">';
        echo get_the_post_thumbnail( $post_id , array('80','80') );
        echo '</a>';
        break;
    }
}

if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'add_thumbnail_columns_data', 10, 2 );
    add_filter( 'manage_pages_columns' , 'add_thumbnail_columns' );
    add_action( 'manage_pages_custom_column' , 'add_thumbnail_columns_data', 10, 2 );
}


?>