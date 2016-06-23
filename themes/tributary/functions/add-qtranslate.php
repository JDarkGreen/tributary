<?php  /* Archivo que permite el cambio de idioma gracias al plugin qtranslate */

//$locale = qtrans_getLanguage();
$locale = qtranxf_getLanguage();

#var_dump($locale); exit;

//Cambiar el Idioma a Ingles
if ($locale == "en" ) 
{
	#var_dump( dirname( dirname(__FILE__) ) . "/languages/en_US.mo" ); exit;
	#load_textdomain( LANG , realpath( dirname(__FILE__) . "../../" ) . "/languages/en_US.mo"  );
	load_textdomain( LANG , dirname( dirname(__FILE__) ) . "/languages/en_US.mo"  );
}

?>