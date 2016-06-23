<?php 
/***********************************************************************************************/
/* Widget que muestra una Imagen en barra lateral  */
/***********************************************************************************************/

	class Theme_ad_image extends WP_Widget {
	
		public function __construct() {
			parent::__construct(
				'theme_ad_image_w',
				'Personalizar Widget: Solo Imagen',
				array('description' => __('Muestra una Imagen', LANG ) )
			); 
		}
		
		public function form($instance) {
			$defaults = array(
				'title'    => __('Imagen', LANG ),
				'ad_link'  => '',
				'ad_img'   => 'http://qwalgrande.com/Publi.jpg',
			);
			
			$instance = wp_parse_args( (array)$instance , $defaults );
			
			?>
			<!-- EL título -->
			<p>
				<label for="<?= $this->get_field_id('title') ?>"><?php _e('Title:', LANG ); ?></label>
				<input type="text" class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" value="<?= esc_attr($instance['title']); ?>" />
			</p>			

			<!-- EL Link -->
			<p>
				<label for="<?= $this->get_field_id('ad_link') ?>"><?php _e('Link adjunto: Seleccione y luego Guarde', LANG ); ?></label>

				<!-- Obtenemos todos los post o una página -->
				<select id="<?= $this->get_field_id('ad_link'); ?>" name="<?= $this->get_field_name('ad_link'); ?>"  value="<?= esc_attr($instance['ad_link']); ?>" style="width:100%">

					<option value="null"> <?php _e("No Link" , LANG ); ?> </option>
					<?php 
						$args = array(
							'order'          => 'ASC',
							'orderby'        => 'title',
							'post_status'    => 'publish',
							'post_type'      => array( 'post', 'page' ),
							'posts_per_page' => -1,
						);
						$all_post = get_posts( $args );
						foreach( $all_post as $item ) :
					?>
						<option value="<?= get_permalink( $item->ID ); ?>" <?php selected( get_permalink( $item->ID ) , esc_attr($instance['ad_link']) ); ?> ><?= _e( $item->post_title , LANG ); ?></option>
					<?php endforeach; ?>
				</select>

				<!-- Ruta--> 
				<div class="description"> <?= _e( "La ruta actual es: ", LANG ) . !empty( $instance['ad_link1'] ) ? esc_attr($instance['ad_link1']) : esc_attr($instance['ad_link']) ?></div>
			</p>

			<!-- El ícono o la imagen -->
			<p>
				<label for="<?= $this->get_field_id('ad_img') ?>"><?php _e('Imagen A Colocar', LANG ); ?></label>
				<input type="text" class="widefat" id="<?= $this->get_field_id('ad_img'); ?>" name="<?= $this->get_field_name('ad_img'); ?>" value="<?= $instance['ad_img']; ?>" />

				<!-- Imagen -->
				<?php if( !empty( $instance['ad_img'] ) ) : ?>
					<a href="#" class="upload-img-btn-widget" style="display:inline-block; margin: 10px auto;">
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
			$instance['title']   = strip_tags($new_instance['title']);
			
			//El link
			$instance['ad_link']  = $new_instance['ad_link'] ;
			
			// La imagen
			$instance['ad_img']  = $new_instance['ad_img'];

			return $instance;
		}
		
		public function widget($args, $instance) {
			extract($args);
			
			// Get the title and prepare it for display
			//$the_title  = $instance['title']; //var_dump($the_title);
			
			// Get the link
			$ad_link  = $instance['ad_link'];			

			// Get the image
			$ad_img  = $instance['ad_img'];
			
			echo $before_widget;
		?>
			<article class="articlePublicity">
				<?php if( $ad_link !== "null"  ) : ?>
				<a href="<?= $ad_link ?>">
					<!-- Imagen --> 
					<figure class=""><img src="<?= $ad_img ?>" alt="" class="img-fluid" /> </figure>
				</a>
				<?php else: ?>
					<!-- Imagen --> 
					<figure class=""><img src="<?= $ad_img ?>" alt="" class="img-fluid" /> </figure>
				<?php endif; ?>
			</article>	<!-- /.articlePublicity -->

		<?php
			
			echo $after_widget;
			
		}
	}
	flush_rewrite_rules();
	register_widget('Theme_ad_image');

?>