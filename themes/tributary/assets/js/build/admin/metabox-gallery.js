var j = jQuery.noConflict();

/* 
* Array Unique: eliminar valores duplicados de un array en Javascript
*/


/* Funcion del documento */
(function($){

    /*
    * Comprobamos si existe el contenedor sortable y si es correcto hacemos draggables 
    * Sus Elementos Internos
    */
    if( j("#sortable-ui-container").length ){
        j("#sortable-ui-container").sortable({ 
            containment: "parent", //contenedor padre
            cursor     : "move",  //tipo de cursor
            distance   : 2, //distancia en px para cambiar de item 
            opacity    : 0.5, //opacidad
        });

        /* Evento al actualizar la posicion de los items */
        j("#sortable-ui-container").on("sortupdate" , function( event, ui ) {
            /* Obtenemos actual elemento */
            var current_item = ui.item;
            /* Obtenemos los nuevos ids de cada imagen pero ordenados
            */
            var sortedIDs = j("#sortable-ui-container").sortable( "toArray" , { attribute: "data-id-img"} );
            /* 
            * Conseguimos el id de post a modificar para actualizar el valor del campo oculto 
            * con el arreglo actualizado - finalmente modificamos este campo con el arreglo
            */
            var input_data = j("#imageurls_"+ ui.item.attr('data-id-post') );
            var sortedIDs_tostring = sortedIDs.join(","); //separados por coma
            input_data.val( sortedIDs_tostring ); //cambiar los valores 

        });

    }

    /*
    * Agregar Una Imagen 
    */
    j('#add_image_btn').on('click',function(e) {

        e.preventDefault();

        var post_data = j(this).attr('data-id-post');
        
        frame = wp.media({
            title   : 'Agrega tu título aquí',
            frame   : 'post',
            multiple: true, // set to false if you want only one image
            library : { type : 'image'},
            button  : { text : 'Agregar Imagen' },
        });

        frame.on('close',function(data) {

            var input_data = j("#imageurls_"+post_data);
            var imageArray = input_data.val().split(",");
            images         = frame.state().get('selection');

            //Encontrar contenedor de galería
            var container_img = j("#sortable-ui-container");
            
            images.each(function(image) {
                //imageArray.push(image.attributes.url);
                // want other attributes? Check the available ones with console.log(image.attributes);
                imageArray.push(image.attributes.id); 
                
                //Colocar Imagenes Temporales
                var string_figure = "<figure style='width: 202px; height: 120px; margin: 0 10px 20px; display: inline-block; vertical-align: top; position: relative; float:left;'>";

                string_figure += "<a href='#' style='border-radius: 50%; width: 20px; height: 20px; border: 2px solid red; color: red; position: absolute; top: -10px; right: -8px; text-decoration: none; text-align: center; background: black; font-weight: 700; z-index:999;' class='js-delete-image' data-id-post="+post_data+" data-id-img="+image.attributes.id+">X</a>";
                
                string_figure += "<img src="+image.attributes.url+" alt="+image.attributes.url+" style='width: 100%; height: 100%; margin: 0 auto;' />";

                string_figure += "</figure>";

                container_img.append( string_figure );
            });
 
            // Agregar todas los id de imagen separados por coma al valor oculto
            j("#imageurls_"+post_data).val(imageArray.join(","));

        });
        
        frame.open();
    });


    //Actualizar imagen
    j(".js-update-image").on('click',function(e){
        e.preventDefault(); //arreglar la customizacion

        var this_link = j(this);

        var frame; 
        //id de post
        var data_id_post = this_link.attr('data-id-post');
        //id image
        var data_image   = this_link.attr('data-id-img'); //console.log( data_image );

        // If the media frame already exists, reopen it.
        if ( frame ) { frame.open(); return; }

        // Create a new media frame
        frame = wp.media({
            title   : 'Agrega tu imagen aquí',
            multiple:  false, // set to false if you want only one image
            button  : { text : 'Usa esta Imagen' },
        });

        //al abrir el frame
        frame.on('open', function(){
            var selection = frame.state().get('selection');
            var selected  = data_image; // the id of the image
            if (selected) { selection.add(wp.media.attachment(selected)); }
        });
        //al cerrar el frame
        frame.on('select', function() {
            attachment =  frame.state().get('selection').first().toJSON(); //console.log(attachment );

            //valor de id de imagen actual cambiada o seleccionada
            var current_id_img = attachment.id;
            //actualizar valor de la imagen en el atributo data img
            this_link.attr( 'data-id-img', current_id_img );

            //actualizar nuevos valores en el input oculto de actual post
            var array_valores = j("#imageurls_"+data_id_post).val();
            //buscar id actual eliminarlo y reemplazarlo por la seleccion
            array_valores = array_valores.replace( data_image ,  current_id_img );
            //actualizar
            j("#imageurls_"+data_id_post).val( array_valores ); 

            //mostrar imagen temporal
            this_link.parent('figure').find('img').remove();
            this_link.parent('figure')
            .append("<img src="+attachment.url+" alt="+attachment.name+" class='' style='max-width: 100%; width: 100%; height: 100%; margin: 0 auto;' />");

            /*this_link.append("<img src="+attachment.url+" alt="+attachment.name+" class='' style='max-width: 100%; width: 100%; height: 100%; margin: 0 auto;' />");*/
        });



        frame.open(); 

    });

    //Eliminar una imagen
    j(document).on('click' , ".js-delete-image" , function(e){
        e.preventDefault();

        //id de post
        var data_id_post = j(this).attr('data-id-post');

        //id de imagen 
        var data_id_img  = j(this).attr('data-id-img');
        //console.log(data_id_img);

        //ocultar imagen display none
        j(this).parent('figure').css('display','none');

        var input_data = j("#imageurls_"+data_id_post);
        //var imageArray = input_data.val().split(",");
        var valores_array = input_data.val();

        //buscar y eliminar elemento id de imagen  del arreglo
        valores_array = valores_array.replace( data_id_img , ' ' );
        valores_array = valores_array.replace( ", " , '' );
        
        input_data.val( valores_array );
        /*var i = imageArray.indexOf(data_id_img);
        if(i != -1 ) { 
            imageArray.splice( i , 1); 

            if( imageArray.length == 0 ){
               input_data.val('-1');
            }else{
                input_data.val(imageArray.join(","));
            }
        }*/

        //console.log(imageArray);

    });

    //Eliminar todas las imágenes modo seguro
    j("#remove_all_image_btn").on('click',function(e){
        e.preventDefault();
        //variable input data
        var post_data = j(this).attr('data-id-post');
        //remover todos sus elementos y quedar valor -1
        j("#imageurls_"+post_data).val('-1');

        //Actualizar con botón
        if( j("#publish").length ){ j("#publish").trigger( "click" ); }
    });

})(jQuery)







