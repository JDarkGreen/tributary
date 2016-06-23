<?php  

/* archivo muestra o contiene lois menus del tema en cuestion */

function register_my_menus(){
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu', LANG ),
		)
	);
}
add_action('init', 'register_my_menus');


?>