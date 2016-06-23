<?php  

//ARCHIVO QUE MODIFICA OCAMBIA ALGUNOS ESTILOS EN EL PANEL DE ADMINISTRACION O LOGIN 
//DE WORDPRESS

/**************************************************************/
/*----------------------- ESTILOS ----------------------------*/
/**************************************************************/

function my_custom_login_page_css()
{
	wp_enqueue_style( 'login-css', THEMEROOT . "/assets/styles/build/admin/login.css" );
}
add_action('login_head', 'my_custom_login_page_css');

/**************************************************************/
/*----------------------- REDIRECCION LOGO ----------------------------*/
/**************************************************************/

function my_custom_login_url()
{
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_custom_login_url' );

?>