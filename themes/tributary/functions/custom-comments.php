<?php /**************************************************************************************/
/* Custom Function for Displaying Comments */
/**************************************************************************************/

function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
	
		<li class="pingback" id="comment-<?php comment_ID(); ?>">

			<article <?php comment_class('clearfix'); ?>>
			
				<header>
				
					<h4><?php _e('Pingback:', LANG ); ?></h4>
					<p><?php edit_comment_link(); ?></p>
					
				</header>
	
				<?php comment_author_link(); ?>
								
			</article>
		
	<?php endif; ?>
	
	<?php if (get_comment_type() == 'comment') : ?>
		<li id="comment-<?php comment_ID(); ?>">
	
			<article <?php comment_class('clearfix'); ?>>
			
				<!-- Imagen Ávatar -->
				<figure class="comment-avatar">
					<?php 
						$avatar_size = 70;
						if ($comment->comment_parent != 0) {
							$avatar_size = 60;
						}
						
						echo get_avatar($comment, $avatar_size);
					?>
				</figure> <!-- /.comment-avatar -->

				<!-- Contenedor de Comentario Contenido -->
				<div class="comment__content">
					<!-- Author del Comentario -->
					<h4><?php comment_author_link(); ?> / <?php comment_date(); ?></h4>

					<?php if ($comment->comment_approved == false ) : ?>
						<p class="awaiting-moderation"><?php _e('Tu comentario está esperando moderación.', LANG ); ?></p>

						<!-- Texto de Comentario -->
						<?php else : comment_text() . "-" . comment_reply_link( array_merge( $args ,  array( 
							'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );  
						?>

					<?php endif; ?>

				</div> <!-- /.comment__content -->
			
			</article>
			
	<?php endif;	
}

/**********************************************************************************/
/* Custom Comment Form */
/**********************************************************************************/

function adaptive_custom_comment_form($defaults) {
	$comment_notes_after = '' .
		'<div class="allowed-tags">' .
		'<p><strong>' . __('Etiquetas permitidas', LANG ) . '</strong></p>' .
		'<code> ' . allowed_tags() . ' </code>' .
		'</div> <!-- end allowed-tags -->';
	
	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = $comment_notes_after;
	$defaults['id_form'] = 'comment-form';
	$defaults['comment_field'] = '<p><textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>';

	return $defaults;
}

add_filter('comment_form_defaults', 'adaptive_custom_comment_form');

function adaptive_custom_comment_fields() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	
	$fields = array(
		'author' => '<p>' . 
						'<label for="author">' . __('Nombre', LANG ) . '' . ($req ? __(' (requerido)', LANG ) : '') . '</label>' .
						'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' .
		            '</p>',
		'email' => '<p>' . 
						'<label for="email">' . __('Email', LANG ) . '' . ($req ? __(' (requerido) (no será publicado )', LANG ) : '') . '</label>' .
						'<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />' .
		            '</p>',
	);

	return $fields;
}

add_filter('comment_form_default_fields', 'adaptive_custom_comment_fields');