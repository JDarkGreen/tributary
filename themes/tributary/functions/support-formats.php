<?php  

/* Archivo de pagina solo muestra formatos que soporta el tema */

/***********************************************************************************************/
/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/***********************************************************************************************/
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));

	add_theme_support('post-thumbnails', array('post','page','slider-home','servicio','cliente','featured-links', 'miembro' ) );

	set_post_thumbnail_size(210, 210, true);

	add_image_size('custom-blog-image', 784, 350);

	add_theme_support('automatic-feed-links');

	//Agregar Excerpt a las páginas
	add_post_type_support('page', 'excerpt');

?>