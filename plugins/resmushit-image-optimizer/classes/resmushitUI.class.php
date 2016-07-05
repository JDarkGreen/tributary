<?php

 /**
   * ReSmushit Admin UI class
   * 
   * 
   * @package    Resmush.it
   * @subpackage UI
   * @author     Charles Bourgeaux <contact@resmush.it>
   */
Class reSmushitUI {

	/**
	 *
	 * Create a new panel
	 *
	 * @param  string 	$title 	Title of the pane
	 * @param  string 	$html 	HTML content
	 * @param  string 	$border Color of the border
	 * @return none
	 */
	public static function fullWidthPanel($title = null, $html = null, $border = null) {
		self::fullWidthPanelWrapper($title, $html, $border);
		echo $html;
		self::fullWidthPanelEndWrapper();
	}




	/**
	 *
	 * Create a new panel wrapper (start)
	 *
	 * @param  string 	$title 	Title of the pane
	 * @param  string 	$html 	HTML content
	 * @param  string 	$border Color of the border
	 * @return none
	 */
	public static function fullWidthPanelWrapper($title = null, $html = null, $border = null) {
		?>
		<div class='rsmt-panel w100 <?php if($border) echo 'brdr-'.$border; ?>'>
			<h2><?php echo $title; ?></h2>
		<?php
	}




	/**
	 *
	 * Create a new panel wrapper (end)
	 *
	 * @param  none
	 * @return none
	 */
	public static function fullWidthPanelEndWrapper() {
		?>
		</div>
		<?php
	}




	/**
	 *
	 * Generate Header panel
	 *
	 * @param  none
	 * @return none
	 */
	public static function headerPanel() {
		$html = "<img src='". RESMUSHIT_BASE_URL . "images/header.jpg' />";
		self::fullWidthPanel($html);
	}





	/**
	 *
	 * Generate Settings panel
	 *
	 * @param  none
	 * @return none
	 */
	public static function settingsPanel() {
		self::fullWidthPanelWrapper('Settings', null, 'orange');
		?>
		<div class="rsmt-settings">
			<form method="post" action="options.php" id="rsmt-options-form">
			    <?php settings_fields( 'resmushit-settings' ); ?>
			    <?php do_settings_sections( 'resmushit-settings' ); ?>
				<table class="form-table">
					<?php self::addSetting("text", "Image quality", "Default value is 92. The quality factor must be between 0 (very week) and 100 (best quality)", "resmushit_qlty") ?>
					<?php self::addSetting("checkbox", "Optimize on upload", "All future images uploaded will be automatically optimized", "resmushit_on_upload") ?>
					<?php self::addSetting("checkbox", "Enable statistics", "Create statistics about optimized pictures", "resmushit_statistics") ?>
					<?php self::addSetting("checkbox", "Enable logs", "Enable file logging (for developers)", "resmushit_logs") ?>
				</table>
			    <?php submit_button(); ?>
			 </form>
		</div>
		<?php self::fullWidthPanelEndWrapper(); 		
	}



	/**
	 *
	 * Generate Bulk panel
	 *
	 * @param  none
	 * @return none
	 */
	public static function bulkPanel() {
		$countNonOptimizedPictures = reSmushit::getCountNonOptimizedPictures();
		self::fullWidthPanelWrapper('Optimize unsmushed pictures', null, 'blue');
		?>

		<div class="rsmt-bulk">
			<div class="non-optimized-wrapper <?php if(!$countNonOptimizedPictures) echo 'disabled' ?>">
				<h3 class="icon_message warning">There is currently <em><?php echo $countNonOptimizedPictures; ?> non optimized pictures</em>.</h3>
				<p>This action will resmush all pictures which have not been optimized to the good Image Quality Rate.</p>
				<p class="submit" id="bulk-resize-examine-button">
					<button class="button-primary" onclick="resmushit_bulk_resize('bulk_resize_image_list');">Optimize all pictures</button>
				</p>
				<div id='bulk_resize_image_list'></div>
			</div>

			<div class="optimized-wrapper <?php if($countNonOptimizedPictures) echo 'disabled' ?>">
				<h3 class="icon_message ok">Congrats ! All your pictures are correctly optimized</h3>
			</div>
		</div>
		<?php self::fullWidthPanelEndWrapper(); 		
	}




	/**
	 *
	 * Generate Statistics panel
	 *
	 * @param  none
	 * @return none
	 */
	public static function statisticsPanel() {
		if(!get_option('resmushit_statistics'))
			return false;
		self::fullWidthPanelWrapper('Statistics', null, 'green');
		?>

		<div class="rsmt-statistics">
			<?php $resmushit_stat = reSmushit::getStatistics();
			if($resmushit_stat['files_optimized'] != 0):
			?>
			<p><strong>Space saved :</strong> <span id="rsmt-statistics-space-saved"><?php echo self::sizeFormat($resmushit_stat['total_saved_size'])?></span></p>
			<p><strong>Total reduction :</strong> <span id="rsmt-statistics-percent-reduction"><?php echo $resmushit_stat['percent_reduction'] ?></span></p>
			<p><strong>Images optimized :</strong> <span id="rsmt-statistics-files-optimized"><?php echo $resmushit_stat['files_optimized'] ?></span>/<span id="rsmt-statistics-total-pictures"><?php echo $resmushit_stat['total_pictures'] ?></span></p>
			<p><strong>Total images optimized :</strong> <span id="rsmt-statistics-total-optimizations"><?php echo $resmushit_stat['total_optimizations'] ?></span></p>
			<?php else: ?>
			<p>No picture has been optimized yet ! Add pictures to your Wordpress Media Library.</p>
			<?php endif; ?>
		</div>
		<?php self::fullWidthPanelEndWrapper(); 		
	}



	/**
	 *
	 * Generate News panel
	 *
	 * @param  none
	 * @return none
	 */
	public static function newsPanel() {
		global $wp_version;
		?>
		<div class="rsmt-news">
		
		<?php
		self::fullWidthPanelWrapper('News', null, 'red');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, RESMUSHIT_NEWSFEED);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		$data_raw = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($data_raw);
		if($data):
			foreach($data as $i=>$news):
				if($i > 1)
					break;
			?>
				<div class="news-item">
					<span class="news-date"><?php echo date('d/m/Y', $news->date) ?></span>
					<div class="news-img">
						<a href="<?php echo $news->link ?>" target="_blank">
							<img src="<?php echo $news->picture ?>" />
						</a>
					</div>
					<h3><a href="<?php echo $news->link ?>" target="_blank"><?php echo $news->title ?></a></h3>
					<div class="news-content">
						<?php echo $news->content ?>
					</div>
				</div>
			
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="social">
			<a class="social-maecia" title="Maecia Agency - Paris France" href="https://www.maecia.com" target="_blank">
				<img src="<?php echo RESMUSHIT_BASE_URL ?>images/maecia.png" />
			</a>
			<a class="social-resmushit" title="Visit resmush.it for more informations" href="https://www.resmush.it" target="_blank">
				<img src="<?php echo RESMUSHIT_BASE_URL ?>images/logo.png" />
			</a>
			<a class="social-twitter" title="Follow reSmush.it on Twitter" href="https://www.twitter.com/resmushit" target="_blank">
				<img src="<?php echo RESMUSHIT_BASE_URL ?>images/twitter.png" />
			</a>
		</div>
		</div>
		<?php self::fullWidthPanelEndWrapper(); 		
	}




	/**
	 *
	 * Helper to generate multiple settings fields
	 *
	 * @param  string $type 	type of the setting
	 * @param  string $name 	displayed name of the setting
	 * @param  string $extra 	additionnal informations about the setting
	 * @param  string $machine_name 	setting machine name
	 * @return none
	 */
	public static function addSetting($type, $name, $extra, $machine_name) {
		echo "<div class='setting-row type-$type'>";
		echo "<label for='$machine_name'>$name<p>$extra</p></label>";
		switch($type){
			case 'text':
				echo "<input type='text' name='$machine_name' id='$machine_name' value='". get_option( $machine_name ) ."'/>";
				break;
			case 'checkbox':
				$additionnal = null;
				if ( 1 == get_option( $machine_name ) ) $additionnal = 'checked="checked"'; 
				echo "<input type='checkbox' name='$machine_name' id='$machine_name' value='1' ".  $additionnal ."/>";
				break;
		}
		echo '</div>';
	}



	/**
	 *
	 * Helper to format size in bytes
	 *
	 * @param  int $bytes filesize in bytes
	 * @return string rendered filesize
	 */
	public static function sizeFormat($bytes) {
	    if ($bytes > 0)
	    {
	        $unit = intval(log($bytes, 1024));
	        $units = array('B', 'KB', 'MB', 'GB');

	        if (array_key_exists($unit, $units) === true)
	        {
	            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
	        }
	    }
	    return $bytes;
	}
}