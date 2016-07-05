<?php
/**
 * @package   resmushit
 * @author    Charles Bourgeaux <charles.bourgeaux@maecia.com>
 * @author    Tedj Ferhati <tedj.ferhati@maecia.com>
 * @license   GPL-2.0+
 * @link      http://www.resmush.it
 * @copyright 2016 Resmush.it
 *
 * @wordpress-plugin
 * Plugin Name:       reSmush.it Image Optimizer
 * Plugin URI:        http://www.resmush.it
 * Description:       Image Optimization API. Provides image size optimization
 * Version:           0.1.1
 * Timestamp:         2016.05.13
 * Author:            Maecia
 * Author URI:        https://www.maecia.com
 * Author:            Charles Bourgeaux
 * Author:            Tedj Ferhati
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


require('resmushit.inc.php'); 




/**
* 
* Registering settings on plugin installation
*
* @param none
* @return none
*/
function resmushit_activate() {
	if ( is_super_admin() ) {
		if(!get_option('resmushit_qlty'))
			update_option( 'resmushit_qlty', RESMUSHIT_DEFAULT_QLTY );
		if(!get_option('resmushit_on_upload'))
			update_option( 'resmushit_on_upload', '1' );
		if(!get_option('resmushit_statistics'))
			update_option( 'resmushit_statistics', '1' );
		if(!get_option('resmushit_total_optimized'))
			update_option( 'resmushit_total_optimized', '0' );
	}
}
register_activation_hook( __FILE__, 'resmushit_activate' );





/**
* 
* Call resmush.it optimization for attachments
*
* @param attachment object
* @param boolean preserve original file
* @return attachment object
*/
function resmushit_process_images($attachments, $force_keep_original = TRUE) {
	global $attachment_id;
	$cumulated_original_sizes = 0;
	$cumulated_optimized_sizes = 0;


	$basepath = dirname(get_attached_file( $attachment_id )) . '/';
	$basefile = basename($attachments[ 'file' ]);

	$statistics[] = reSmushit::optimize($basepath . $basefile, $force_keep_original );

	foreach($attachments['sizes'] as $image_style)
		$statistics[] = reSmushit::optimize($basepath . $image_style['file'], FALSE );
	
	$count = 0;
	foreach($statistics as $stat){
		if($stat && !isset($stat->error)){
			$cumulated_original_sizes += $stat->src_size;
			$cumulated_optimized_sizes += $stat->dest_size;
			$count++;
		}
	}

	$optimizations_successful_count = get_option('resmushit_total_optimized');
	update_option( 'resmushit_total_optimized', $optimizations_successful_count + $count );

	update_post_meta($attachment_id,'resmushed_quality', resmushit::getPictureQuality());
	if(get_option('resmushit_statistics')){
		update_post_meta($attachment_id,'resmushed_cumulated_original_sizes', $cumulated_original_sizes);
		update_post_meta($attachment_id,'resmushed_cumulated_optimized_sizes', $cumulated_optimized_sizes);
	}
	return $attachments;
}
//Automatically optimize images if option is checked
if(get_option('resmushit_on_upload'))
	add_filter('wp_generate_attachment_metadata', 'resmushit_process_images');   
 




/**
* 
* Make current attachment available
*
* @param attachment object
* @return attachment object
*/
function resmushit_get_meta_id($result){
	global $attachment_id;
	$attachment_id = $result;
}
//Automatically retrieve image attachment ID if option is checked
if(get_option('resmushit_on_upload'))
	add_filter('add_attachment', 'resmushit_get_meta_id');





/**
* 
* add Ajax action to fetch all unsmushed pictures
*
* @param none
* @return json object
*/
function resmushit_bulk_get_images() {
	echo reSmushit::getNonOptimizedPictures();
	die();
}	
add_action( 'wp_ajax_resmushit_bulk_get_images', 'resmushit_bulk_get_images' );	





/**
* 
* add Ajax action to optimize a picture according to attachment ID
*
* @param none
* @return boolean
*/	
function resmushit_bulk_process_image() {
	global $attachment_id;


	$attachment_id = $_POST['data']['ID'];

	$basepath = dirname(get_attached_file( $attachment_id )) . '/';
	$basefile = basename(get_attached_file( $attachment_id ));
	$fileInfo = pathinfo(get_attached_file( $attachment_id ));

	$originalFile = $basepath . $fileInfo['filename'] . '-unsmushed.' . $fileInfo['extension'];
	rlog('Bulk optimization launched for file : ' . get_attached_file( $attachment_id ));
	
	if(file_exists($originalFile))
		copy($originalFile, get_attached_file( $attachment_id ));
		
	//Regenerate thumbnails
	wp_generate_attachment_metadata($attachment_id, get_attached_file( $attachment_id ));
	die();
}
add_action( 'wp_ajax_resmushit_bulk_process_image', 'resmushit_bulk_process_image' );





/**
* 
* add Ajax action to update statistics
*
* @param none
* @return json object
*/
function resmushit_update_statistics() {
	$output = reSmushit::getStatistics();
	$output['total_saved_size_formatted'] = reSmushitUI::sizeFormat($output['total_saved_size']);
	echo json_encode($output);
	die();
}
add_action( 'wp_ajax_resmushit_update_statistics', 'resmushit_update_statistics' );	