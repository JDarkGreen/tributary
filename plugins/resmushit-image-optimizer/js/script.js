
/**
 * Bulk Resize admin javascript functions
 */
var bulkCounter = 0;
var bulkTotalimages = 0;
var next_index = 0;


/**
 * Form Validators
 */
jQuery("#rsmt-options-form").submit(function(){
	jQuery("#resmushit_qlty").removeClass('form-error');
	var qlty = jQuery("#resmushit_qlty").val();
	if(!jQuery.isNumeric(qlty) || qlty > 100 || qlty < 0){
		jQuery("#resmushit_qlty").addClass('form-error');
		return false;
	}
});




/** 
 * recursive function for resizing images
 */
function resmushit_bulk_process(bulk, item){	
	jQuery.post(
		ajaxurl, { // (defined by wordpress - points to admin-ajax.php)
			action: 'resmushit_bulk_process_image', 
			data: bulk[item]
		}, 
		function(response) {
			if(!flag_removed){
				jQuery('#bulk_resize_target').remove();
				container.append('<div id="smush_results" style="padding: 20px 5px; overflow: auto;" />');
				var results_target = jQuery('#smush_results'); 
				results_target.html('<div class="bulk--back-progressionbar"><div <div class="resmushit--progress--bar"</div></div>');
				flag_removed = true;
			}

			var results_target = jQuery('#smush_results'); 
			bulkCounter++;
			jQuery('.resmushit--progress--bar').html('<p>'+ Math.round((bulkCounter*100/bulkTotalimages)) +'%</p>');
			jQuery('.resmushit--progress--bar').animate({'width': Math.round((bulkCounter*100/bulkTotalimages))+'%'}, 0);

			if(item < bulk.length)
				resmushit_bulk_process(bulk, item + 1);
			else{
				jQuery('.non-optimized-wrapper').addClass('disabled');
				jQuery('.optimized-wrapper').removeClass('disabled');
				updateStatistics();
			}
		}
	);
}


/** 
 * ajax post to return all images that are candidates for resizing
 * @param string the id of the html element into which results will be appended
 */
function resmushit_bulk_resize(container_id) {
	container = jQuery('#'+container_id);
	container.html('<div id="bulk_resize_target">');
	jQuery('#bulk-resize-examine-button').fadeOut(200);
	var target = jQuery('#bulk_resize_target');

	target.html('<div class="loading--bulk"><span class="loader"></span><br />Examining existing attachments. This may take a few moments...</div>');

	target.animate(
		{ height: [100,'swing'] },
		500, 
		function() {		
			jQuery.post(
				ajaxurl, 
				{ action: 'resmushit_bulk_get_images' }, 
				function(response) {
					var images = JSON.parse(response);			
					if (images.length > 0) {	
						bulkTotalimages = images.length;

						
						flag_removed = false;
						//start treating all pictures
						resmushit_bulk_process(images, 0);
					} else {
						target.html('<div>There are no existing attachments that require Smushing.</div>');
					}
				}
			);
		});
}


/** 
 * ajax post to update statistics
 */
function updateStatistics() {
	jQuery.post(
		ajaxurl, { 
			action: 'resmushit_update_statistics'
		}, 
		function(response) {
			statistics = JSON.parse(response);	
			jQuery('#rsmt-statistics-space-saved').text(statistics.total_saved_size_formatted);
			jQuery('#rsmt-statistics-files-optimized').text(statistics.files_optimized);
			jQuery('#rsmt-statistics-percent-reduction').text(statistics.percent_reduction);
			jQuery('#rsmt-statistics-total-optimizations').text(statistics.total_optimizations);
		}
	);
}