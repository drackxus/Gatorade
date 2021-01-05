<?php

 /* CREAR POST TYPE PROMOCIONES */

/*
* Creating a function to create our CPT
*/
 
function custom_post_type_promociones() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Promociones', 'Post Type General Name'),
            'singular_name'       => _x( 'Promocion', 'Post Type Singular Name'),
            'menu_name'           => __( 'Promociones'),
            'parent_item_colon'   => __( 'Parent Promocion'),
            'all_items'           => __( 'Todas'),
            'view_item'           => __( 'Ver Promocion'),
            'add_new_item'        => __( 'Añadir nueva Promocion'),
            'add_new'             => __( 'Añadir nueva'),
            'edit_item'           => __( 'Editar Promocion'),
            'update_item'         => __( 'Actualizar Promocion'),
            'search_items'        => __( 'Buscar Promocion'),
            'not_found'           => __( 'No hay promociones'),
            'not_found_in_trash'  => __( 'No hay promociones en la papelera'),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'promociones'),
            'description'         => __( 'Promociones'),
            'menu_icon'           => 'dashicons-tag',
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
            'menu_position'       => 4.0,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => false,
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'eventos', $args );


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
  register_taxonomy('categoriasPromociones',array('promociones'), array(
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
 
  register_taxonomy('etiquetasPromociones','promociones',array(
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
     
    add_action( 'init', 'custom_post_type_promociones', 0 );





