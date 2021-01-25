
<?php
/* CREAR POST TYPE RETOS*/

/*
* Creating a function to create our CPT
*/
 
function custom_post_type_retos() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Retos', 'Post Type General Name'),
            'singular_name'       => _x( 'Reto', 'Post Type Singular Name'),
            'menu_name'           => __( 'Retos'),
            'parent_item_colon'   => __( 'Parent Reto'),
            'all_items'           => __( 'Todos'),
            'view_item'           => __( 'Ver Reto'),
            'add_new_item'        => __( 'Añadir nuevo Reto'),
            'add_new'             => __( 'Añadir nuevo'),
            'edit_item'           => __( 'Editar Reto'),
            'update_item'         => __( 'Actualizar Reto'),
            'search_items'        => __( 'Buscar Reto'),
            'not_found'           => __( 'No hay retos'),
            'not_found_in_trash'  => __( 'No hay retos en la papelera'),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'retos'),
            'description'         => __( 'Retos'),
            'menu_icon'           => 'dashicons-awards',
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
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
            'menu_position'       => 4.3,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => false,
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'retos', $args );


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
  register_taxonomy('categoriasRetos',array('retos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categorias' ),
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
 
  register_taxonomy('etiquetasRetos','retos',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'etiquetas' ),
  ));



     
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type_retos', 0 );


  
  
/* CREAR METABOX DURACIÓN RETO */

function duracion_reto_metabox()
{
    add_meta_box('duracion_reto_completo', 'Duración del reto', 'duracion_reto_callback', 'retos', 'side', 'high');
}
add_action('add_meta_boxes', 'duracion_reto_metabox');

function duracion_reto_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['duracion_reto']) ? esc_attr($values['duracion_reto'][0]) : '';
?>
    <p>
        <!-- <label for="reto_duracion">URL</label> -->
        <input type="number" name="reto_duracion" id="reto_duracion" value="<?php echo esc_html($link); ?>" placeholder="Tiempo en minutos" />
    </p>
<?php
}

add_action('save_post', 'duracion_reto_save');


function duracion_reto_save($post_id)
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
    if (isset($_POST['reto_duracion'])) {
        update_post_meta($post_id, 'duracion_reto', $_POST['reto_duracion']);
        // update_post_meta( $post_id, 'duracion_reto', wp_kses( $_POST['reto_duracion'], $allowed ) );
    }
}





/* CREAR METABOX RANKING */

function ranking_metabox()
{
    add_meta_box('ranking_completo', 'Ranking', 'ranking_callback', 'retos', 'side', 'high');
}
add_action('add_meta_boxes', 'ranking_metabox');

function ranking_callback($post)
{
    $values    = get_post_custom($post->ID);
    $link      = isset($values['ranking']) ? esc_attr($values['ranking'][0]) : '';
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

add_action('save_post', 'ranking_save');


function ranking_save($post_id)
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
    if (isset($_POST['ranking'])) {
        update_post_meta($post_id, 'ranking', $_POST['ranking']);
        // update_post_meta( $post_id, 'duracion_reto', wp_kses( $_POST['ranking'], $allowed ) );
    }
}







/* CREAR METABOX PREMIO */


add_action( 'add_meta_boxes', 'premio_entregado_meta_box_add' );
function premio_entregado_meta_box_add()
{	
	// Add new meta box
	add_meta_box( 'premio_entregado_metabox', 'Premio entregado', 'render_premio_entregado_meta_box', 'retos', 'normal', 'default' );
}

function render_premio_entregado_meta_box()
{
	global $post;
	// Get saved meta data
	$premio_entregado_meta_content = get_post_meta($post->ID, 'premio_entregado', TRUE); 
	if (!$premio_entregado_meta_content) $premio_entregado_meta_content = '';
	wp_nonce_field( 'premio_entregado'.$post->ID, 'premio_entregado_nonce');
	// Render editor meta box
	wp_editor( $premio_entregado_meta_content, 'premio_entregado', array('textarea_rows' => '5'));
}

add_action( 'save_post', 'premio_entregado_meta_box_save' );

function premio_entregado_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	 
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['premio_entregado_nonce'] ) || !wp_verify_nonce( $_POST['premio_entregado_nonce'], 'premio_entregado'.$post_id ) ) return;
	 
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	
	// Make sure our data is set before trying to save it
	if( isset( $_POST['premio_entregado'] ) )
		$result = update_post_meta( $post_id, 'premio_entregado', $_POST['premio_entregado'] );
}