<?php

/* CREAR POST TYPE EVENTOS*/


/*
* Creating a function to create our CPT
*/

function custom_post_type_productos()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Productos', 'Post Type General Name'),
        'singular_name'       => _x('Producto', 'Post Type Singular Name'),
        'menu_name'           => __('Productos'),
        'parent_item_colon'   => __('Parent Producto'),
        'all_items'           => __('Todos los Productos'),
        'view_item'           => __('Ver Producto'),
        'add_new_item'        => __('Añadir nuevo Producto'),
        'add_new'             => __('Añadir nuevo', 'productos'),
        'edit_item'           => __('Editar Producto'),
        'update_item'         => __('Actualizar Producto'),
        'search_items'        => __('Buscar Producto'),
        'not_found'           => __('No hay productos'),
        'not_found_in_trash'  => __('No hay productos en la papelera'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('productos'),
        'description'         => __('Productos'),
        'menu_icon'           => 'dashicons-cart',
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
        'menu_position'       => 4.1,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => false,

    );

    // Registering your Custom Post Type
    register_post_type('productos', $args);


    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI

    $labels = array(
        'name' => _x('Categorias Productos', 'taxonomy general name'),
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
    register_taxonomy('categoriasProductos', array('productos'), array(
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
        'name' => _x('Etiquetas Productos', 'taxonomy general name'),
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

    register_taxonomy('etiquetasProductos', 'productos', array(
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

add_action('init', 'custom_post_type_productos', 0);




/* CREAR METABOX LINK COMPRAR PRODUCTO */

function link_comprar_producto_metabox()
{
    add_meta_box('link_comprar_producto_completo', 'Link comprar producto', 'link_comprar_producto_callback', 'productos', 'side', 'high');
}
add_action('add_meta_boxes', 'link_comprar_producto_metabox');

function link_comprar_producto_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['link_comprar_producto']) ? esc_attr($values['link_comprar_producto'][0]) : '';
?>
    <p>
        <label for="comprar_producto">URL</label>
        <input type="text" name="comprar_producto" id="comprar_producto" value="<?php echo esc_html($link); ?>" />
    </p>
<?php
}

add_action('save_post', 'link_comprar_producto_save');


function link_comprar_producto_save($post_id)
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
    if (isset($_POST['comprar_producto'])) {
        update_post_meta($post_id, 'link_comprar_producto', $_POST['comprar_producto']);
        // update_post_meta( $post_id, 'link_comprar_producto', wp_kses( $_POST['comprar_producto'], $allowed ) );
    }
}




/* CREAR METABOX PRODUCTO DESTACADO */

function producto_destacado_metabox()
{
    add_meta_box('producto_destacado_completo', 'Producto destacado', 'producto_destacado_callback', 'productos', 'side', 'high');
}
add_action('add_meta_boxes', 'producto_destacado_metabox');

function producto_destacado_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['destacado_producto']) ? esc_attr($values['destacado_producto'][0]) : '';
?>
    <p>
        <label for="destacado_producto">¿Destacado?</label>
        <input type="checkbox" name="destacado_producto" id="destacado_producto" value="esDestacado" <?php if ($link == 'esDestacado') {
                                                                                                            echo 'checked';
                                                                                                        } ?> />
    </p>
<?php
}

add_action('save_post', 'producto_destacado_save');


function producto_destacado_save($post_id)
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
    if (isset($_POST['destacado_producto'])) {
        update_post_meta($post_id, 'destacado_producto', $_POST['destacado_producto']);
        // update_post_meta( $post_id, 'destacado_producto', wp_kses( $_POST['destacado_producto'], $allowed ) );
    }
}




/* CREAR METABOX TABLA NUTRICONAL */


add_action('add_meta_boxes', 'tabla_nutricional_meta_box_add');
function tabla_nutricional_meta_box_add()
{
    // Add new meta box
    add_meta_box('tabla_nutricional_metabox', 'Tabla nutricional', 'render_tabla_nutricional_meta_box', 'productos', 'normal', 'default');
}

function render_tabla_nutricional_meta_box()
{
    global $post;
    // Get saved meta data
    $tabla_nutricional_meta_content = get_post_meta($post->ID, 'tabla_nutricional', TRUE);
    if (!$tabla_nutricional_meta_content) $tabla_nutricional_meta_content = '';
    wp_nonce_field('tabla_nutricional' . $post->ID, 'tabla_nutricional_nonce');
    // Render editor meta box
    wp_editor($tabla_nutricional_meta_content, 'tabla_nutricional', array('textarea_rows' => '5'));
}

add_action('save_post', 'tabla_nutricional_meta_box_save');
function tabla_nutricional_meta_box_save($post_id)
{
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['tabla_nutricional_nonce']) || !wp_verify_nonce($_POST['tabla_nutricional_nonce'], 'tabla_nutricional' . $post_id)) return;

    // if our current user can't edit this post, bail
    if (!current_user_can('edit_post')) return;


    // Make sure our data is set before trying to save it
    if (isset($_POST['tabla_nutricional']))
        $result = update_post_meta($post_id, 'tabla_nutricional', $_POST['tabla_nutricional']);
}

?>