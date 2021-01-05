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


/*
|---------------------------------------------------------------------------
| Llamada a Class
|---------------------------------------------------------------------------
|
*/

// $fileClass = array( 'class-mail.php', 'class-ZocoMail.php', 'class-uploadImg.php' );

// foreach( $fileClass as $fileName ){
// 	require_once ( CLASSPATH . $fileName );
// }

/*
|---------------------------------------------------------------------------
| Include Libraries
|---------------------------------------------------------------------------
|
| External project dependencies loaded usually using composer.
*/

$libraries = array('autoload');

foreach ($libraries as $filename) {
	require_once(LIBRARIESPATH . $filename . '.php');
}



function re_order_menu()
{

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
	// unset($menu[5]);
	// unset($menu[10]);
	// unset($menu[15]);
	// unset($menu[20]);
	// unset($menu[25]);
	// unset($menu[59]);
	// unset($menu[60]);
	// unset($menu[65]);
	// unset($menu[70]);
	// unset($menu[75]);
	// unset($menu[80]);
	// unset($menu[99]);



	ksort($menu);
}
add_action('admin_menu', 're_order_menu');






//Eliminar la opcion para que el usuario no pueda cambiar los colores del administrador
//remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

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








/**
 * Adds a simple WordPress pointer to Settings menu
 */

function thsp_enqueue_pointer_script_style($hook_suffix)
{

	// Assume pointer shouldn't be shown
	$enqueue_pointer_script_style = false;

	// Get array list of dismissed pointers for current user and convert it to array
	$dismissed_pointers = explode(',', get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));

	// Check if our pointer is not among dismissed ones
	if (!in_array('thsp_settings_pointer', $dismissed_pointers)) {
		$enqueue_pointer_script_style = true;

		// Add footer scripts using callback function
		add_action('admin_print_footer_scripts', 'thsp_pointer_print_scripts');
	}

	// Enqueue pointer CSS and JS files, if needed
	if ($enqueue_pointer_script_style) {
		wp_enqueue_style('wp-pointer');
		wp_enqueue_script('wp-pointer');
	}
}
add_action('admin_enqueue_scripts', 'thsp_enqueue_pointer_script_style');

function thsp_pointer_print_scripts()
{

	$titulo_pointer  = "<h3>Ingresa un  titulo</h3>";
	$titulo_pointer .= "<p>Este sera el titulo que aparecera como nombre de la publicación</p>";
	$titulo_pointer .= '<p><a class="button button-primary button-large">Siguiente</a></p>'; 

	$publish_pointer  = "<h3>Publicar</h3>";
	$publish_pointer .= "<p>Desde aqui podras hacer publicas tus tarjetas</p>";
	$publish_pointer .= '<p><a class="button button-primary button-large">Siguiente</a></p>'; 
	
	
	$pointer_tarjetas  = "<h3>Ingresa un  titulo</h3>";
	$pointer_tarjetas .= "<p>Este sera el titulo que aparecera como nombre de la publicación</p>";
	
	// echo '//' . $_SERVER['REQUEST_URI'];

	// $a = $_SERVER['REQUEST_URI'];

	// if (strpos($a, 'tarjetas') !== false) {
	// 	echo 'si tarjetas';
	// }
	?>

<style>
	/* div#wpcontent::after {
		content: '';
		width: 100vw;
		height: 100vh;
		background: #00000082;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 9999;
	} */
</style>

	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function($) {

			<?php  ?>
			
			
			var yy = {
				content: '<?php echo $titulo_pointer; ?>',
				position: {
					edge: 'top', // arrow direction
					align: 'left' // vertical alignment
				},
				pointerWidth: 250,
				close: function() {
					$.post(ajaxurl, {
						pointer: 'thsp_settings_pointertiii', // pointer ID
						action: 'dismiss-wp-pointer'
					});
				}
			}

			var zz = {
				content: '<?php echo $publish_pointer; ?>',
				position: {
					edge: 'right', // arrow direction
					align: 'left' // vertical alignment
				},
				pointerWidth: 250,
				close: function() {
					$.post(ajaxurl, {
						pointer: 'thsp_settings_pointertiii', // pointer ID
						action: 'dismiss-wp-pointer'
					});
				}
			}


			$('.post-type-tarjetas #title').pointer(yy).pointer('open');
			$('#publish').pointer(zz).pointer('open');

			

			// $('.post-type-tarjetas #publish').pointer(yy).pointer('hide');


			// setTimeout(function() {
			// 	$('.post-type-tarjetas #title').pointer(yy).pointer('close');
			// 	console.log('close');
			// }, 4000);
		});
		//]]>
	</script>

<?php
} ?>



<?php
/* Cambiar logo de wordpress en el login */
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




/* Remover logo de wordpress */
function wp_debranding_remove_wp_logo()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'wp_debranding_remove_wp_logo');





/***************************** 
 *Add a custom Welcome Dashboard Panel
 *****************************/
function my_welcome_panel()
{

	$tarjetas = wp_count_posts('tarjetas');
	$eventos = wp_count_posts('eventos');
	$productos = wp_count_posts('productos');
	$retos = wp_count_posts('retos');
	$publicidades = wp_count_posts('publicidades');

?>


	<div id="welcome-panel" class="welcome-panel" style="
    border: none;
">

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
						<li><a href="edit.php?post=type=tarjetas" class="welcome-icon welcome-widgets">Tarjetas: <?php if($tarjetas){ echo $tarjetas->publish; } ?></a></li>
						<li><a href="edit.php?post=type=eventos" class="welcome-icon welcome-widgets">Eventos: <?php if($eventos){ echo $eventos->publish; } ?></a></li>
						<li><a href="edit.php?post=type=productos" class="welcome-icon welcome-widgets">Productos: <?php if($productos){ echo $productos->publish; } ?></a></li>
						<li><a href="edit.php?post=type=retos" class="welcome-icon welcome-widgets">Retos: <?php if($retos){ echo $retos->publish; } ?></a></li>
						<li><a href="edit.php?post=type=publicidades" class="welcome-icon welcome-widgets">Publicidad: <?php if($publicidades){ echo $publicidades->publish; } ?></a></li>
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
