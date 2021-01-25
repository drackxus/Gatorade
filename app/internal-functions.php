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

function WoowSetup()
{

	// Add default posts and comments RSS feed links to <head>.
	// add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images
	add_theme_support('post-thumbnails');

	// This theme uses excerpt in pages
	add_post_type_support('page', 'excerpt');

	// Register top menu
	register_nav_menu('Top', 'Top Menu');

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
}

add_action('after_setup_theme', 'WoowSetup');

/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Front-end
|-------------------------------------------------------------------------------
*/

function FrontScripts()
{

	wp_register_script('ajax-woow', JSURL . 'ajax-woow.js', array(), '1.0.2', true);
	wp_localize_script('ajax-woow', 'MyAjax', array('url' => admin_url('admin-ajax.php'), 'urlHome' => home_url(), 'urlJs' => JSURL));

	wp_enqueue_script('jquery');
	wp_enqueue_script('ajax-woow');
}

add_action('wp_enqueue_scripts', 'FrontScripts');

/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Back-end
|-------------------------------------------------------------------------------
*/

function BackScripts()
{

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

function CreatePages()
{

	// Pages
	$arrNewPage[] = array(
		[
			'post_title' => 'Home',	'post_name' => 'home',	'post_status' => 'publish',	'post_type' => 'page',	'page_template' => 'page-home.php'
		],
		[
			'post_title' => 'Perfil',	'post_name' => 'perfil',	'post_status' => 'publish',	'post_type' => 'page',	'page_template' => 'page-profile.php'
		]
	);

	// Loop to create pages
	foreach ($arrNewPage as $page) {

		$pageExisit = get_page_by_title($page['post_title']);

		// Check if page exist
		if (is_null($pageExisit)) {
			// Create a new page
			wp_insert_post($page);
		}
	}
}

add_action('after_switch_theme', 'CreatePages');



/*
|-------------------------------------------------------------------------------
| Customize wordpress
|-------------------------------------------------------------------------------
*/


/* Change wordpress logo */
function wp_debranding_change_login_page_logo()
{
?>
	<style type="text/css">
		.login h1 a {
			background-image: url('<?php echo IMGURL ?>/Gatorade-Logo.png');
			background-size: cover;
			margin: 0 auto;

			/* Set to your image dimensions */
			height: 150px;
			width: 150px;
		}
	</style>
<?php
}
add_action('login_head', 'wp_debranding_change_login_page_logo');




/** Remove wordpress logo **/
function wp_debranding_remove_wp_logo()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'wp_debranding_remove_wp_logo');





/** Add a custom Welcome Dashboard Panel **/
function my_welcome_panel()
{

	$tarjetas = wp_count_posts('tarjetas');
	$eventos = wp_count_posts('eventos');
	$productos = wp_count_posts('productos');
	$retos = wp_count_posts('retos');
	$publicidades = wp_count_posts('publicidades');

?>


	<div id="welcome-panel" class="welcome-panel" style="border: none;">

		<div class="welcome-panel-content">
			<h2>¡Bienvenido a Gatorade!</h2>
			<p class="about-description">Hemos recopilado algunos enlaces para que puedas comenzar:</p>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<h3>Primeros pasos</h3>
					<ul>
						<li><a href="post-new.php?post=type=tarjetas" class="welcome-icon welcome-edit-page">Crea tu primera Tarjeta</a></li>
						<li><a href="post-new.php?post=type=eventos" class="welcome-icon welcome-edit-page">Crea tu primer Evento</a></li>
						<li><a href="post-new.php?post=type=productos" class="welcome-icon welcome-edit-page">Crea tu primer Producto</a></li>
						<li><a href="post-new.php?post=type=retos" class="welcome-icon welcome-edit-page">Crea tu primer Reto</a></li>
						<li><a href="post-new.php?post=type=publicidades" class="welcome-icon welcome-edit-page">Crea tu primera Publicidad</a></li>
					</ul>
				</div>
				<div class="welcome-panel-column">
					<h3>Estadisticas</h3>
					<ul>
						<li><a href="edit.php?post=type=tarjetas" class="welcome-icon welcome-widgets">Tarjetas: <?php if ($tarjetas) {
																														echo $tarjetas->publish;
																													} ?></a></li>
						<li><a href="edit.php?post=type=eventos" class="welcome-icon welcome-widgets">Eventos: <?php if ($eventos) {
																													echo $eventos->publish;
																												} ?></a></li>
						<li><a href="edit.php?post=type=productos" class="welcome-icon welcome-widgets">Productos: <?php if ($productos) {
																														echo $productos->publish;
																													} ?></a></li>
						<li><a href="edit.php?post=type=retos" class="welcome-icon welcome-widgets">Retos: <?php if ($retos) {
																												echo $retos->publish;
																											} ?></a></li>
						<li><a href="edit.php?post=type=publicidades" class="welcome-icon welcome-widgets">Publicidad: <?php if ($publicidades) {
																															echo $publicidades->publish;
																														} ?></a></li>
					</ul>
				</div>
				<div class="welcome-panel-column">
					<h3></h3>
					<img src="<?php echo IMGURL; ?>Gatorade-Logo.png" style="width:100%;" alt="">
				</div>
			</div>
		</div>
	</div>

<?php
}

remove_action('welcome_panel', 'wp_welcome_panel');
add_action('welcome_panel', 'my_welcome_panel');


/** Reorder menu **/

function re_order_menu()
{

	if (current_user_can('editor')) {
		global $menu;
		// print_r($menu[2]);

		// ------- Put away items 
		$dashboard = $menu[2];
		$separator1 = $menu[4];
		$posts = $menu[5];
		$media = $menu[10];
		$links = $menu[15];
		$pages = $menu[20];
		$comments = $menu[25];
		$separator2 = $menu[59];
		$appearance = $menu[60];
		$plugins = $menu[65];
		$users = $menu[70];
		$tools = $menu[75];
		$settings = $menu[80];
		$separator3 = $menu[99];

		// -------- Reset menu  
		// unset($menu[2]);
		// unset($menu[4]);
		unset($menu[5]);
		unset($menu[10]);
		unset($menu[15]);
		unset($menu[20]);
		unset($menu[25]);
		// unset($menu[59]);
		unset($menu[60]);
		unset($menu[65]);
		// unset($menu[70]);
		unset($menu[75]);
		// unset($menu[80]);
		// unset($menu[99]);



		ksort($menu);
	}

	if (current_user_can('administrator')) {
	}
}
add_action('admin_menu', 're_order_menu');



//Eliminar la opcion para que el usuario no pueda cambiar los colores del administrador
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

//Establecer el color por defecto del administrador
function gat_admin_color_scheme()
{
	//Get the theme directory
	$theme_dir = get_template_directory_uri();

	//gat
	wp_admin_css_color(
		'gat',
		__('gat'),
		$theme_dir . '/assets/css/gat.css',
		array('#2b2a2c', '#fff', '#fa5001', '#fa5001')
	);
}
add_action('admin_init', 'gat_admin_color_scheme');

add_filter('get_user_option_admin_color', function ($color_scheme) {

	$color_scheme = 'gat';

	return $color_scheme;
}, 5);

?>