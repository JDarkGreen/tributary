<?php  

/* archivo que contiene los sidebar del tema en cuestion */

/***********************************************************************************************/
/* Agregando nuevos SIDEBARS y secciones para widgets */
/***********************************************************************************************/	

if (function_exists('register_sidebar') ) {
	register_sidebar(
		array(
			'name'          => __('Header Lenguaje Sidebar', LANG ),
			'id'            => 'header-language',
			'description'   => __('Sidebar colocar widgets de lenguaje', LANG ),
			'before_widget' => '<div class="sidebar-widget-header">',
			'after_widget'  => '</div> <!-- end sidebar-widget-header -->',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		)
	);	
	//+SIDEBAR BARRA LATERAL DERECHA 
	register_sidebar(
		array(
			'name'          => __('Barra Lateral Publicidad y Otros - Sidebar', LANG ),
			'id'            => 'sidebar-publicidad-hotel',
			'description'   => __('Barra Lateral Publicidad: Contiene anuncios y otros', LANG ),
			'before_widget' => '<div class="sidebar-widget-publicity">',
			'after_widget'  => '</div> <!-- end sidebar-widget-publicity -->',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		)
	);	
}






?>