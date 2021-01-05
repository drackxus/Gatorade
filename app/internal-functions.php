<?php
/***
 * @Descripcion: internal-functions.php
 * Contiene las diferentes funciones internas para el funcionamiento de wordpress
 * Opciones de wordpress por defecto
 *
 *
***/

/*
|-------------------------------------------------------------------------------
| Function to add default support
|-------------------------------------------------------------------------------
*/

	function WoowSetup(){

		// Add default posts and comments RSS feed links to <head>.
		// add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images
		add_theme_support( 'post-thumbnails' );

		// This theme uses excerpt in pages
		add_post_type_support( 'page', 'excerpt' );

		// Register top menu
		register_nav_menu( 'Top', 'Top Menu' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

	}

	add_action( 'after_setup_theme', 'WoowSetup' );

/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Front-end
|-------------------------------------------------------------------------------
*/

	function FrontScripts (){

		wp_register_script( 'ajax-woow', JSURL.'ajax-woow.js', array(), '1.0.2', true );
		wp_localize_script( 'ajax-woow', 'MyAjax', array( 'url' => admin_url( 'admin-ajax.php' ), 'urlHome' => home_url(), 'urlJs' => JSURL ) );
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('ajax-woow');

	}

	add_action( 'wp_enqueue_scripts', 'FrontScripts' );

/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Back-end
|-------------------------------------------------------------------------------
*/

	function BackScripts() {

	    wp_register_script('js-woow-admin', JSURL . 'jswoow.admin.js', array(), '1.0.0', true);
	    wp_localize_script('js-woow-admin', 'MyAjax', array('url' => admin_url('admin-ajax.php'), 'urlHome' => home_url(), 'urlJs' => JSURL));

	    wp_enqueue_script('js-woow-admin');
	}

	add_action('admin_enqueue_scripts', 'BackScripts');

/*
|-------------------------------------------------------------------------------
| Function to create automatically pages
|-------------------------------------------------------------------------------
*/

	function CreatePages(){

		// Pages
		$arrNewPage[] = array([
					'post_title' => 'Home'
				,	'post_name' => 'home'
				,	'post_status' => 'publish'
				,	'post_type' => 'page'
				,	'page_template' => 'page-home.php'
			],
			[
				'post_title' => 'Perfil'
				,	'post_name' => 'perfil'
				,	'post_status' => 'publish'
				,	'post_type' => 'page'
				,	'page_template' => 'page-profile.php'
			]);

		// Loop to create pages
		foreach ( $arrNewPage as $page ) {

			$pageExisit = get_page_by_title( $page[ 'post_title' ] );

			// Check if page exist
			if( is_null( $pageExisit ) ){
				// Create a new page
				wp_insert_post( $page );

			}

		}
	}

	add_action( 'after_switch_theme', 'CreatePages' );



?>
