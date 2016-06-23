<?php 
/***********************************************************************************************/
/* Widget que muestra un icono con su texto USADO en El inicio del tema  */
/***********************************************************************************************/

	class Theme_ad_icon_text extends WP_Widget {
	
		public function __construct() {
			parent::__construct(
				'theme_ad_icon_text_w',
				'Personalizar Widget: Icon y Texto widget',
				array('description' => __('Muestra un icono con su texto', LANG ) )
			); 
		}
		
		public function form($instance) {
			$defaults = array(
				'title'  => __('TextoPruba', LANG ),
				'ad_img' => IMAGES . '/demo/ad-260x120.gif',
			);
			
			$instance = wp_parse_args( (array)$instance , $defaults );
			
			?>
			<!-- EL título -->
			<p>
				<label for="<?= $this->get_field_id('title') ?>"><?php _e('Title:', 'adaptive-framework'); ?></label>
				<input type="text" class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" value="<?= esc_attr($instance['title']); ?>" />
			</p>

			<!-- El ícono o la imagen -->
			<p>
				<label for="<?= $this->get_field_id('ad_img') ?>"><?php _e('La imagen o ícono medidas de 46px X 46px: Para eliminar Imágen solo borre el contenido', LANG ); ?></label>
				<input type="text" class="widefat" id="<?= $this->get_field_id('ad_img'); ?>" name="<?= $this->get_field_name('ad_img'); ?>" value="<?= $instance['ad_img']; ?>" />

				<!-- Imagen -->
				<?php if( !empty( $instance['ad_img'] ) ) : ?>
					<a href="#" class="upload-img-btn-widget" style="display:inline-block; margin: 10px auto; background: black;">
						<img src="<?= $instance['ad_img']; ?>" style="width:150px;height:150px;" />
					</a>
				<?php endif; ?>

				<!-- Cargar Imagen -->
				<a href="#" class="upload-img-btn-widget" style="display:block; margin: 5px;"><?php _e('Cargar Imagen' , LANG ); ?></a>		
			</p>
			
			<?php
		}
		
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			// El título
			$instance['title']  = strip_tags($new_instance['title']);
			
			// La imagen
			$instance['ad_img'] = $new_instance['ad_img'];

			return $instance;
		}
		
		public function widget($args, $instance) {
			extract($args);
			
			// Get the title and prepare it for display
			$the_title  = $instance['title']; //var_dump($the_title);
			
			// Get the ad
			$ad_img = $instance['ad_img'];
			
		?>

			<div class="col-xs-12 col-md-4">
				<article class="articleBenefits"> 
					<!-- Imagen --> <figure class=""><img src="<?= $ad_img ?>" alt="" class="img-fluid" /> </figure>
					<!-- Texto --> <h3 class="text-uppercase"> <?= $the_title; ?> </h3>

				</article>	
			</div> <!-- /col-xs-12 -->

		<?php
			
			
		}
	}
	flush_rewrite_rules();
	register_widget('Theme_ad_icon_text');

?>