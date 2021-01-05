<?php

/***
 * @Descripcion: custom-functions.php
 * Contiene las diferentes funciones utiles para presonalizacion de wordpress
 * Opciones de wordpress presonalizadas
 *
 *
 ***/


/* CREAR POST TYPE TARJETAS*/



/*
* Creating a function to create our CPT
*/

function custom_post_type()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Tarjetas', 'Post Type General Name'),
        'singular_name'       => _x('Tarjeta', 'Post Type Singular Name'),
        'menu_name'           => __('Tarjetas'),
        'parent_item_colon'   => __('Parent Tarjeta'),
        'all_items'           => __('Todas'),
        'view_item'           => __('Ver Tarjeta'),
        'add_new_item'        => __('Añadir nueva Tarjeta'),
        'add_new'             => __('Añadir nueva'),
        'edit_item'           => __('Editar Tarjeta'),
        'update_item'         => __('Actualizar Tarjeta'),
        'search_items'        => __('Buscar Tarjeta'),
        'not_found'           => __('No hay tarjetas'),
        'not_found_in_trash'  => __('No hay tarjetas en la papelera'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('tarjetas'),
        'description'         => __('Tarjetas'),
        'menu_icon'           => 'dashicons-excerpt-view',
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array(),
        /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4.0,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => false

    );

    // Registering your Custom Post Type
    register_post_type('tarjetas', $args);


    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI

    $labels = array(
        'name' => _x('Categorias', 'taxonomy general name'),
        'singular_name' => _x('Categoria', 'taxonomy singular name'),
        'search_items' =>  __('Buscar Categorias'),
        'all_items' => __('Categorias'),
        'parent_item' => __('Parent Categoria'),
        'parent_item_colon' => __('Parent Categoria:'),
        'edit_item' => __('Editar Categoria'),
        'update_item' => __('Actualizar Categoria'),
        'add_new_item' => __('Añadir nueva Categoria'),
        'new_item_name' => __('Nombre nueva categoria'),
        'menu_name' => __('Categorias'),
    );

    // Now register the taxonomy
    register_taxonomy('categoriasTarjetas', array('tarjetas'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categorias'),
    ));




    // Labels part for the GUI

    $labels = array(
        'name' => _x('Etiquetas', 'taxonomy general name'),
        'singular_name' => _x('Etiqueta', 'taxonomy singular name'),
        'search_items' =>  __('Buscar Etiquetas'),
        'popular_items' => __('Etiquetas populares'),
        'all_items' => __('Todas las Etiquetas'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Editar Etiqueta'),
        'update_item' => __('Actualizar Etiqueta'),
        'add_new_item' => __('Añadir nueva Etiqueta'),
        'new_item_name' => __('Nombre nueva etiqueta'),
        'separate_items_with_commas' => __('Separa las etiquetas con coma'),
        'add_or_remove_items' => __('Añadir o remover etiquetas'),
        'choose_from_most_used' => __('Elije desde las etiquetas mas usadas'),
        'menu_name' => __('Etiquetas'),
    );

    // Now register the non-hierarchical taxonomy like tag

    register_taxonomy('etiquetasTarjetas', 'tarjetas', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'etiquetas'),
    ));
}

/* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */

add_action('init', 'custom_post_type', 0);






/* CREAR METABOX URL VIDEO PARA LAS TARJETAS */

function metabox_video( $post_type, $post ) {
    add_meta_box(
        'aw-meta-box',
        __( 'Video loop' ),
        'render_video_meta_box',
        array('tarjetas'), //post types here
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'metabox_video', 10, 2 );
 
function render_video_meta_box($post) {
    $image = get_post_meta($post->ID, 'video_loop', true);
    ?>
    <table style="width: 100%;">
        <tr>            
            <td><input type="text" name="video_loop" id="video_loop" value="<?php echo $image; ?>" style="width: 100%;"/></td>
        </tr>
        <tr>
            <td><a href="#" class="aw_upload_image_button button button-secondary"><?php _e('Seleccionar video'); ?></a></td>
        </tr>
    </table>
    <?php
}

function aw_include_script() {
 
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
  
    wp_enqueue_script( 'awscript', get_stylesheet_directory_uri() . '/assets/js/tarjetas/subir_video.js', array('jquery'), null, false );
}
add_action( 'admin_enqueue_scripts', 'aw_include_script' );

function video_save_postdata($post_id)
{
    if (array_key_exists('video_loop', $_POST)) {
        update_post_meta(
            $post_id,
            'video_loop',
            $_POST['video_loop']
        );
    }
}
add_action('save_post', 'video_save_postdata');





/* CREAR METABOX URL VIDEO COMPLETPO PARA LAS TARJETAS */

function link_video_completo_metabox()
{
    add_meta_box('link_video_completo_completo', 'Link video full', 'link_video_completo_callback', 'tarjetas', 'side', 'high');
}
add_action('add_meta_boxes', 'link_video_completo_metabox');

function link_video_completo_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['link_video_completo']) ? esc_attr($values['link_video_completo'][0]) : '';
?>
    <p>
        <label for="url_video_completo">URL</label>
        <input type="text" name="url_video_completo" id="url_video_completo" value="<?php echo esc_html($link); ?>" />
    </p>
<?php
}

add_action('save_post', 'link_video_completo_save');


function link_video_completo_save($post_id)
{
    // Ignoramos los auto guardados.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Si no está el nonce declarado antes o no podemos verificarlo no seguimos.
    // if ( ! isset( $_POST['bf_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['bf_metabox_nonce'], 'l_metabox_nonce' ) ) {
    //     return;
    // }

    // Si el usuario actual no puede editar entradas no debería estar aquí.
    if (!current_user_can('edit_post')) {
        return;
    }

    // AHORA es cuando podemos guardar la información.

    // Nos aseguramos de que hay información que guardar.
    if (isset($_POST['url_video_completo'])) {
        update_post_meta($post_id, 'link_video_completo', $_POST['url_video_completo']);
        // update_post_meta( $post_id, 'link_video_completo', wp_kses( $_POST['url_video_completo'], $allowed ) );
    }
}














?>