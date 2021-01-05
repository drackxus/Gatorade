
<?php
/* CREAR POST TYPE PERFILES */

/*
* Creating a function to create our CPT
*/

function custom_post_type_perfiles()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Perfiles', 'Post Type General Name'),
        'singular_name'       => _x('Perfil', 'Post Type Singular Name'),
        'menu_name'           => __('Perfiles'),
        'parent_item_colon'   => __('Parent Perfil'),
        'all_items'           => __('Todos'),
        'view_item'           => __('Ver Perfil'),
        'add_new_item'        => __('Añadir nuevo Perfil'),
        'add_new'             => __('Añadir nuevo'),
        'edit_item'           => __('Editar Perfil'),
        'update_item'         => __('Actualizar Perfil'),
        'search_items'        => __('Buscar Perfil'),
        'not_found'           => __('No hay perfiles'),
        'not_found_in_trash'  => __('No hay perfiles en la papelera'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('perfiles'),
        'description'         => __('Perfiles'),
        'menu_icon'           => 'dashicons-awards',
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title', 'revisions', 'custom-fields'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array('categoriasTarjetas', 'etiquetasTarjetas'),
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
        'menu_position'       => 4.3,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => false,

    );

    // Registering your Custom Post Type
    register_post_type('perfiles', $args);


    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
}

add_action('init', 'custom_post_type_perfiles', 0);



/* CREAR METABOX USUARIO */

function usuario_metabox()
{
    add_meta_box('usuario_completo', 'Usuario', 'usuario_callback', 'perfiles', 'side', 'high');
}
add_action('add_meta_boxes', 'usuario_metabox');

function usuario_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['usuario']) ? esc_attr($values['usuario'][0]) : '';
?>
    <p>
        <!-- <label for="usuario">Nombre Usuario</label> -->
        <!-- <input type="text" name="usuario" id="usuario" value="<?php echo esc_html($link); ?>" /> -->
        <select name="" id="">
        <?php
        
        $users = get_users();
        foreach($users as $user){
                echo $user->user_nicename;
           
        ?>        
            <option value="<?php echo $user->ID ?>"><?php echo $user->user_nicename ?></option>
        <?php  } ?>
        </select>
    </p>
<?php
}

add_action('save_post', 'usuario_save');


function usuario_save($post_id)
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
    if (isset($_POST['usuario'])) {
        update_post_meta($post_id, 'usuario', $_POST['usuario']);
        // update_post_meta( $post_id, 'usuario', wp_kses( $_POST['usuario'], $allowed ) );
    }
}


/* CREAR METABOX TARJETAS */

function tarjetas_metabox()
{
    add_meta_box('tarjetas_completo', 'Tarjetas', 'tarjetas_callback', 'perfiles', 'side', 'high');
}
add_action('add_meta_boxes', 'tarjetas_metabox');

function tarjetas_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['tarjetas']) ? esc_attr($values['tarjetas'][0]) : '';
?>
    <p>
    <table style="width: 100%;">
        <tr>            
            <td>test</td>
            <td>test</td>
        </tr>
        <tr>            
            <td>test</td>
            <td>test</td>
        </tr>
    </table>
    </p>
<?php
}

add_action('save_post', 'tarjetas_save');


function tarjetas_save($post_id)
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
    if (isset($_POST['tarjetas'])) {
        update_post_meta($post_id, 'tarjetas', $_POST['tarjetas']);
        // update_post_meta( $post_id, 'duracion_reto', wp_kses( $_POST['tarjetas'], $allowed ) );
    }
}



/* CREAR METABOX EVENTOS */

function eventos_metabox()
{
    add_meta_box('eventos_completo', 'Eventos', 'eventos_callback', 'perfiles', 'side', 'high');
}
add_action('add_meta_boxes', 'eventos_metabox');

function eventos_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['eventos']) ? esc_attr($values['eventos'][0]) : '';
?>
    <p>
    <table style="width: 100%;">
        <tr>            
            <td>test</td>
            <td>test</td>
        </tr>
        <tr>            
            <td>test</td>
            <td>test</td>
        </tr>
    </table>
    </p>
<?php
}

add_action('save_post', 'eventos_save');


function eventos_save($post_id)
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
    if (isset($_POST['eventos'])) {
        update_post_meta($post_id, 'eventos', $_POST['eventos']);
        // update_post_meta( $post_id, 'duracion_reto', wp_kses( $_POST['eventos'], $allowed ) );
    }
}



