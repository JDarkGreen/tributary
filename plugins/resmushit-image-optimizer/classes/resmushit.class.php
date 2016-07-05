<?php

 /**
   * ReSmushit
   * 
   * 
   * @package    Resmush.it
   * @subpackage Controller
   * @author     Charles Bourgeaux <contact@resmush.it>
   */
Class reSmushit {

	const MAX_FILESIZE = 2097152;

	/**
	 *
	 * Optimize a picture according to a filepath.
	 *
	 * @param  string $file_path the path to the file on the server
	 * @return bool 	TRUE if the resmush operation worked
	 */
	public static function getPictureQuality() {
		if(get_option( 'resmushit_qlty' ))
			return get_option( 'resmushit_qlty' );
		else
			return RESMUSHIT_QLTY;
	}

	/**
	 *
	 * Optimize a picture according to a filepath.
	 *
	 * @param  string $file_path the path to the file on the server
	 * @return bool 	TRUE if the resmush operation worked
	 */
	public static function optimize($file_path = NULL, $is_original = TRUE) {
		global $wp_version;

		if(filesize($file_path) > self::MAX_FILESIZE)
			return false;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, RESMUSHIT_ENDPOINT);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, RESMUSHIT_TIMEOUT);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Wordpress $wp_version/Resmush.it " . RESMUSHIT_VERSION );

		if (!class_exists('CURLFile')) {
			$arg = array('files' => '@' . $file_path);
		} else {
			$cfile = new CURLFile($file_path);
			$arg = array(
			  'files' => $cfile,
			);
		}

		$arg['qlty'] = self::getPictureQuality();
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arg);

		$data = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($data);
		if($json){
			if (!isset($json->error)) {
				$data = file_get_contents($json->dest);
				if ($data) {
					if($is_original){
						$originalFile = pathinfo($file_path);
						$newPath = $originalFile['dirname'] . '/' . $originalFile['filename'] . '-unsmushed.' . $originalFile['extension'];
			 			copy($file_path, $newPath);
			 		}
				  	file_put_contents($file_path, $data);
					rlog("Picture " . $file_path . " optimized from " . reSmushitUI::sizeFormat($json->src_size) . " to " . reSmushitUI::sizeFormat($json->dest_size));
				  	return $json;
				}
			} else {
				rlog("Webservice returned the following error while optimizing $file_path : Code #" . $json->error . " - " . $json->error_long);
			}
		} else {
			rlog("Cannot establish connection with reSmush.it webservice while optimizing $file_path (timeout of " . RESMUSHIT_TIMEOUT . "sec.)");
		}
		return false;
	}



	/**
      * 
      * Return optimization statistics
      *
      * @param none
      * @return array of statistics
      */
	public static function getStatistics(){
		global $wpdb;
		$output = array();

		$query = $wpdb->prepare( 
			"select
				$wpdb->posts.ID as ID, $wpdb->postmeta.meta_value
				from $wpdb->posts
				inner join $wpdb->postmeta on $wpdb->posts.ID = $wpdb->postmeta.post_id and $wpdb->postmeta.meta_key = %s",
				array('resmushed_cumulated_original_sizes')
		);	
		$original_sizes = $wpdb->get_results($query);
		$total_original_size = 0;
		foreach($original_sizes as $s){
			$total_original_size += $s->meta_value;
		}

		$query = $wpdb->prepare( 
			"select
				$wpdb->posts.ID as ID, $wpdb->postmeta.meta_value
				from $wpdb->posts
				inner join $wpdb->postmeta on $wpdb->posts.ID = $wpdb->postmeta.post_id and $wpdb->postmeta.meta_key = %s",
				array('resmushed_cumulated_optimized_sizes')
		);	
		$optimized_sizes = $wpdb->get_results($query);
		$total_optimized_size = 0;
		foreach($optimized_sizes as $s){
			$total_optimized_size += $s->meta_value;
		}


		$output['total_original_size'] = $total_original_size;
		$output['total_optimized_size'] = $total_optimized_size;
		$output['total_saved_size'] = $total_original_size - $total_optimized_size;
		if($total_original_size == 0)
			$output['percent_reduction'] = 0;
		else
			$output['percent_reduction'] = 100*round(($total_original_size - $total_optimized_size)/$total_original_size,4) . ' %';
		//number of thumbnails + original picture
		$output['files_optimized'] = sizeof($optimized_sizes) * (sizeof(get_intermediate_image_sizes()) + 1);
		$output['total_optimizations'] = get_option('resmushit_total_optimized');
		$output['total_pictures'] = self::getCountAllPictures() * (sizeof(get_intermediate_image_sizes()) + 1);

		return $output;
	}



	/**
      * 
      * Get the count of all pictures
      *
      * @param none
      * @return json of unsmushed pictures attachments ID
      */
	public static function getCountAllPictures(){
		global $wpdb;

		$queryAllPictures = $wpdb->prepare( 
			"select
				Count($wpdb->posts.ID) as count
				from $wpdb->posts
				inner join $wpdb->postmeta on $wpdb->posts.ID = $wpdb->postmeta.post_id and $wpdb->postmeta.meta_key = %s
				where $wpdb->posts.post_type = %s
				and $wpdb->posts.post_mime_type like %s
				and ($wpdb->posts.post_mime_type = 'image/jpeg' OR $wpdb->posts.post_mime_type = 'image/gif' OR $wpdb->posts.post_mime_type = 'image/png')",
				array('_wp_attachment_metadata','attachment', 'image%')
			);
		$data = $wpdb->get_results($queryAllPictures);
		if(isset($data[0]))
			$data = $data[0];

		if(!isset($data->count))
			return 0;
		return $data->count;
	}





	/**
      * 
      * Get a list of non optimized pictures
      *
      * @param none
      * @return json of unsmushed pictures attachments ID
      */
	public static function getNonOptimizedPictures(){
		global $wpdb;
		$tmp = array();
		$unsmushed_images = array();
		$already_optimized_images_array = array();

		$queryAllPictures = $wpdb->prepare( 
			"select
				$wpdb->posts.ID as ID,
				$wpdb->posts.guid as guid,
				$wpdb->postmeta.meta_value as file_meta
				from $wpdb->posts
				inner join $wpdb->postmeta on $wpdb->posts.ID = $wpdb->postmeta.post_id and $wpdb->postmeta.meta_key = %s
				where $wpdb->posts.post_type = %s
				and $wpdb->posts.post_mime_type like %s
				and ($wpdb->posts.post_mime_type = 'image/jpeg' OR $wpdb->posts.post_mime_type = 'image/gif' OR $wpdb->posts.post_mime_type = 'image/png')",
				array('_wp_attachment_metadata','attachment', 'image%')
		);

		$queryAlreadyOptimizedPictures = $wpdb->prepare( 
			"select
				$wpdb->posts.ID as ID
				from $wpdb->posts
				inner join $wpdb->postmeta on $wpdb->posts.ID = $wpdb->postmeta.post_id and $wpdb->postmeta.meta_key = %s
				where $wpdb->postmeta.meta_value = %s",
				array('resmushed_quality', self::getPictureQuality())
		);	
		
		// Get the images in the attachement table
		$all_images = $wpdb->get_results($queryAllPictures);
		$already_optimized_images = $wpdb->get_results($queryAlreadyOptimizedPictures);

		foreach($already_optimized_images as $image)
			$already_optimized_images_array[] = $image->ID;
		

		foreach($all_images as $image){
			if(!in_array($image->ID, $already_optimized_images_array)){
				$tmp = array();
				$tmp['ID'] = $image->ID;
				$tmp['attachment_metadata'] = unserialize($image->file_meta);
				$unsmushed_images[] = $tmp;
			}
				
		}
		return json_encode($unsmushed_images);
	}


	/**
      * 
      * Return the number of non optimized pictures
      *
      * @param none
      * @return number of non optimized pictures to the current quality factor
      */
	public static function getCountNonOptimizedPictures(){
		$data = json_decode(self::getNonOptimizedPictures());
		return sizeof($data) * (sizeof(get_intermediate_image_sizes()) + 1);
	}
}