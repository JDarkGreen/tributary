<?php /* Archivo crea campos personalizados para las taxonomías */ 

function theme_taxonomy_custom_fields($tag) {  
   // Compruebe para el meta taxonomía existente para el término que está editando 
	$t_id      = $tag->term_id; // Obtener el ID del término que está editando
	$term_meta = get_option( "taxonomy_term_$t_id" ); // Hacer el cheque 

    #var_dump($term_meta);
    $input_img = $term_meta["theme_tax_img_$t_id"];
?>  
  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="term_meta[theme_tax_img_<?= $t_id; ?>]"><?php _e('Agregar Imagen Destacada'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[theme_tax_img_<?= $t_id; ?>]" id="term_meta[theme_tax_img_<?= $t_id; ?>]" size="25" style="width:60%;" value="<?= !empty($input_img) ? $input_img : ""; ?>">

        <!-- Mostrar Imagen -->
        <?php
            $url = getimagesize($input_img );
            if( is_array( $url ) ) : 
        ?>
            <br/><br/>
            <img src="<?= $input_img; ?>" alt="image-taxonomy" style="width:250px;height:150px;" />
        <?php else: ?>
            <p> Archivo no Encontrado Elija nueva ruta </p>
        <?php endif ?>

        <br/><br/>
        <button class="js-add-img-tax button button-primary" data-input="term_meta[theme_tax_img_<?= $t_id; ?>]" >
            <?php _e( 'Agregar Imagen' , LANG ); ?>
        </button> 

        <p class="description"><?php _e('Subir una imagen destacada medida: 980x659'); ?></p>  
    </td>  
</tr>  

<?php  
}  

// Una función de devolución de llamada para salvar nuestro campo de la taxonomía extra (s)  
function save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
}  

// Agregue los campos de la taxonomía , utilizando nuestra función de devolución de llamada
add_action( 'servicio_category_edit_form_fields', 'theme_taxonomy_custom_fields', 10, 2 );  
  
// Guarde los cambios realizados en la taxonomía , utilizando nuestra función de devolución de llamada 
add_action( 'edited_servicio_category', 'save_taxonomy_custom_fields', 10, 2 );  