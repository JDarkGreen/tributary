<?php
/**
* 
* Create menu entries and routing
*
* @param none
* @return none
*/
function resmushit_create_menu() {
	if ( is_super_admin() )
		add_media_page( 'reSmush.it', 'reSmush.it', 'manage_options', 'resmushit_options', 'resmushit_settings_page');
}
add_action( 'admin_menu','resmushit_create_menu');





/**
* 
* Declares settings entries
*
* @param none
* @return none
*/
function resmushit_settings_declare() {
	register_setting( 'resmushit-settings', 'resmushit_on_upload' );
	register_setting( 'resmushit-settings', 'resmushit_qlty' );
	register_setting( 'resmushit-settings', 'resmushit_statistics' );
	register_setting( 'resmushit-settings', 'resmushit_logs' );
}
add_action( 'admin_init', 'resmushit_settings_declare' );





/**
* 
* Settings page builder
*
* @param none
* @return none
*/
function resmushit_settings_page() {
	?>
	<div class='rsmt-panels'>	
		<div class="rsmt-cols w66 iln-block">
			<?php reSmushitUI::headerPanel();?>
			<?php reSmushitUI::bulkPanel();?>
			<?php reSmushitUI::statisticsPanel();?>
		</div>
		<div class="rsmt-cols w33 iln-block">
			<?php reSmushitUI::settingsPanel();?>
			<?php reSmushitUI::newsPanel();?>
		</div>
	</div>
	<?php
}



/**
* 
* Assets declaration
*
* @param none
* @return none
*/
function resmushit_register_plugin_assets(){

	wp_register_style( 'resmushit-css', plugins_url( 'css/resmushit.css', __FILE__ ) );
	wp_enqueue_style( 'resmushit-css' );
    wp_enqueue_style( 'prefix-style', esc_url_raw( 'https://fonts.googleapis.com/css?family=Roboto+Slab:700' ), array(), null  );

    wp_register_script( 'resmushit-js', plugins_url( 'js/script.js', __FILE__ ) );
    wp_enqueue_script( 'resmushit-js' );
}
add_action( 'admin_head', 'resmushit_register_plugin_assets' );