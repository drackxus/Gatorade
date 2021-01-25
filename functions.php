<?php

/**
 * @Descripcion: function.php
 *
 * Funciones especificas para TORUS Tecnologia
 *
 **/

/*
|---------------------------------------------------------------------------
| Definicio de constantes para el manejo de url absolutas
|---------------------------------------------------------------------------
|
*/
// Constante URL del tema
define('WPURL', get_bloginfo('wpurl'));
define('THEMEURL', get_bloginfo('template_url'));
define('BASEPATH', dirname(__FILE__));


// Constante URL CSS
define('CSSURL', THEMEURL . '/assets/css/');

// Constante URL JS
define('JSURL', THEMEURL . '/assets/js/');

// Constante URL IMG
define('IMGURL', THEMEURL . '/assets/images/');

// Constante URL APP
define('APPURL', THEMEURL . '/app/');
define('APPPATH', BASEPATH . '/app/');

// Constante URL APP
define('CLASSURL', APPURL . '/class/');
define('CLASSPATH', APPPATH . '/class/');

// Constante URL Email
define('EMAILURL', THEMEURL . '/assets/email/');
define('EMAILPATH', BASEPATH . '/assets/email/');

// Constante Path Composer
define('LIBRARIESPATH', APPPATH . '/vendor/');


// Developer mode
define('MODDEV', false);

// Constante version CACHE
define('VCACHE', '1.3.1');


/*
|---------------------------------------------------------------------------
| Llamada a funciones
|---------------------------------------------------------------------------
|
*/

$fileFunctions = array('internal-functions.php', 'custom-functions.php', 'tarjetas.php', 'eventos.php', 'productos.php', 'retos.php', 'publicidad.php', 'perfiles.php', 'usuario_registrado.php', 'helpers-functions.php', 'ajax-functions.php');

foreach ($fileFunctions as $fileName) {
	require_once(APPPATH . $fileName);
}



/**
 * Enqueue block JavaScript and CSS for the editor
 */


function myguten_enqueue() {
	wp_enqueue_style('admin-your-css-file-handle-name', 'http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
wp_enqueue_script('admin-toure', 'http://code.jquery.com/jquery-1.10.2.min.js');
wp_enqueue_script('admin-tour', get_template_directory_uri().'/assets/js/dknotus-tour.js');
 wp_enqueue_script('admin-tours', get_template_directory_uri().'/assets/js/tour.js');
}
add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );





