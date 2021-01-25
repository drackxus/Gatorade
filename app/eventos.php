<?php

/* CREAR POST TYPE EVENTOS*/

/*
* Creating a function to create our CPT
*/

function custom_post_type_eventos()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Eventos', 'Post Type General Name'),
        'singular_name'       => _x('Evento', 'Post Type Singular Name'),
        'menu_name'           => __('Eventos'),
        'parent_item_colon'   => __('Parent Evento'),
        'all_items'           => __('Todos los Eventos'),
        'view_item'           => __('Ver Evento'),
        'add_new_item'        => __('Añadir nuevo Evento'),
        'add_new'             => __('Añadir nuevo', 'eventos'),
        'edit_item'           => __('Editar Evento'),
        'update_item'         => __('Actualizar Evento'),
        'search_items'        => __('Buscar Evento'),
        'not_found'           => __('No hay eventos'),
        'not_found_in_trash'  => __('No hay eventos en la papelera'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('eventos'),
        'description'         => __('Eventos'),
        'menu_icon'           => 'dashicons-megaphone',
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
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type('eventos', $args);


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
    register_taxonomy('categoriasEventos', array('eventos'), array(
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

    register_taxonomy('etiquetasEventos', 'eventos', array(
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

add_action('init', 'custom_post_type_eventos', 0);






/* CREAR METABOX PARA FECHA DE EVENTO */

function fecha_evento_metabox()
{
    add_meta_box('fecha_evento', 'Fecha del evento', 'fecha_evento_callback', 'eventos', 'normal', 'default');
}
add_action('add_meta_boxes', 'fecha_evento_metabox');

function fecha_evento_callback($post)
{
    $values    = get_post_custom($post->ID);
    $fechaE      = isset($values['fecha_evento']) ? esc_attr($values['fecha_evento'][0]) : '';
?>
    <p>
        <label for="evento_fecha"></label>
        <input type="datetime-local" name="evento_fecha" id="evento_fecha" value="<?php echo esc_html($fechaE); ?>" />
    </p>
<?php
}

add_action('save_post', 'fecha_evento_save');


function fecha_evento_save($post_id)
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
    if (isset($_POST['evento_fecha'])) {
        update_post_meta($post_id, 'fecha_evento', $_POST['evento_fecha']);
        // update_post_meta( $post_id, 'fecha_evento', wp_kses( $_POST['evento_fecha'], $allowed ) );
    }
}






/* CREAR METABOX PARA FECHA LIMITE INSCRIPCION */

function fecha_limite_inscripcion_metabox()
{
    add_meta_box('fecha_limite_inscripcion', 'Fecha limite de inscripción', 'fecha_limite_inscripcion_callback', 'eventos', 'normal', 'default');
}
add_action('add_meta_boxes', 'fecha_limite_inscripcion_metabox');

function fecha_limite_inscripcion_callback($post)
{
    $values    = get_post_custom($post->ID);
    $fechaL      = isset($values['fecha_limite_inscripcion']) ? esc_attr($values['fecha_limite_inscripcion'][0]) : '';
?>
    <p>
        <label for="limite_fecha"></label>
        <input type="datetime-local" name="limite_fecha" id="limite_fecha" value="<?php echo esc_html($fechaL); ?>" />
    </p>
<?php
}

add_action('save_post', 'fecha_limite_inscripcion_save');


function fecha_limite_inscripcion_save($post_id)
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
    if (isset($_POST['limite_fecha'])) {
        update_post_meta($post_id, 'fecha_limite_inscripcion', $_POST['limite_fecha']);
        // update_post_meta( $post_id, 'fecha_limite_inscripcion', wp_kses( $_POST['limite_fecha'], $allowed ) );
    }
}





/* CREAR METABOX PARA AFORO */

function aforo_evento_metabox()
{
    add_meta_box('aforo_evento', 'Aforo del evento', 'aforo_evento_callback', 'eventos', 'normal', 'default');
}
add_action('add_meta_boxes', 'aforo_evento_metabox');

function aforo_evento_callback($post)
{
    $values    = get_post_custom($post->ID);
    $aforo      = isset($values['aforo_evento']) ? esc_attr($values['aforo_evento'][0]) : '';
?>
    <p>
        <label for="evento_aforo"></label>
        <input type="number" name="evento_aforo" id="evento_aforo" value="<?php echo esc_html($aforo); ?>" required />
    </p>
<?php
}

add_action('save_post', 'aforo_evento_save');


function aforo_evento_save($post_id)
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
    if (isset($_POST['evento_aforo'])) {
        update_post_meta($post_id, 'aforo_evento', $_POST['evento_aforo']);
        // update_post_meta( $post_id, 'aforo_evento', wp_kses( $_POST['evento_aforo'], $allowed ) );
    }
}


?>