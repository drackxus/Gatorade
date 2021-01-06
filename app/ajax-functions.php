<?php

/***
 * @Descripcion: ajax-functions.php
 * Contiene las diferentes funciones de ajax
 *
 * Estas funciones ajax son utilizadoas tanto en el front-end como en el back-end
 *
 *
 ***/

/*
|-------------------------------------------------------------------------------
| Function Ajax registrar usuario
|-------------------------------------------------------------------------------
*/


// Hook para usuarios no logueados
add_action('wp_ajax_nopriv_register', 'register');

// Hook para usuarios logueados
add_action('wp_ajax_register', 'register');

global $current_user;

// Función que procesa la llamada AJAX
function register()
{

	// Check parameters
	$user  = isset($_POST['user']) ? $_POST['user'] : false;
	$email  = isset($_POST['email']) ? $_POST['email'] : false;
	$pais  = isset($_POST['pais']) ? $_POST['pais'] : false;
	$ciudad  = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
	$celular  = isset($_POST['celular']) ? $_POST['celular'] : false;
	$deporte  = isset($_POST['deporte']) ? $_POST['deporte'] : false;

	$user = sanitize_text_field($_POST['user']);
	$email = sanitize_email($_POST['email']);
	$pais = sanitize_text_field($_POST['pais']);
	$ciudad = sanitize_text_field($_POST['ciudad']);
	$celular = sanitize_text_field($_POST['celular']);
	$deporte = sanitize_text_field($_POST['deporte']);
	$terminos = sanitize_text_field($_POST['terminos']);

	if (!$user || !$email || !$pais || !$ciudad || !$celular || !$deporte) {
		echo 'Ha ocurrido un error';
	} else {

		$password = wp_generate_password();

		$userdata = array(
			'user_login' => $user,
			'user_email' => $email,
			'user_pass' => $password
		);

		$user_id = wp_insert_user($userdata);

		//Si todo ha ido bien, agregamos los campos adicionales
		if (!is_wp_error($user_id)) {
			update_user_meta($user_id, 'user_pais', $pais);
			update_user_meta($user_id, 'user_ciudad', $ciudad);
			update_user_meta($user_id, 'user_celular', $celular);
			update_user_meta($user_id, 'user_deporte', $deporte);
			update_user_meta($user_id, 'user_terminos', $terminos);

			wp_new_user_notification($user_id, 'both');

			echo 'Tu registro ha sido exitoso, verifica tu buzon de mensajes para establecer tu contraseña<br>Seras redirigido automaticamente';
		}
	}
}




/*
|-------------------------------------------------------------------------------
| Function Ajax actualizar perfil
|-------------------------------------------------------------------------------
*/


// Hook para usuarios no logueados
add_action('wp_ajax_nopriv_update_profile', 'update_profile');

// Hook para usuarios logueados
add_action('wp_ajax_update_profile', 'update_profile');

global $current_user;

// Función que procesa la llamada AJAX
function update_profile()
{


	// Check parameters
	$datosCat  = isset($_POST['datosCat']) ? $_POST['datosCat'] : false;
	$datosEti  = isset($_POST['datosEti']) ? $_POST['datosEti'] : false;
	$idUser  = isset($_POST['idUser']) ? $_POST['idUser'] : false;

	$datosCatf = implode(",", $datosCat);
	$datosEtif = implode(",", $datosEti);

	if (!$datosCat || !$idUser || !$datosEti) {
		echo 'Ha ocurrido un error';
	} else {
		update_user_meta($idUser, 'interesCategoria', $datosCatf);
		update_user_meta($idUser, 'interesEtiqueta', $datosEtif);
		echo 'Datos actualizados';
	}
}


/*
|-------------------------------------------------------------------------------
| Function Ajax para traer mas tarjetas
|-------------------------------------------------------------------------------
*/

function more_post_ajax()
{
	global $post;
	$offset = $_POST["offset"];
	$ppp = $_POST["ppp"];
	header("Content-Type: text/html");

	$args = array(
		'post_type' => 'tarjetas',
		'posts_per_page' => $ppp,
		// 'cat' => 1,
		'offset' => $offset,
	);

	$loop = new WP_Query($args);
	if ($loop->have_posts()) :

	while ($loop->have_posts()) : $loop->the_post(); ?>
		<div class="section">
			<div class="slide active">
				<div class="contenido" style="background-image: url('<?php if ($image[0]) {
																			echo $image[0];
																		} ?>');">
					<?php echo get_post_meta($post->ID, 'video_loop', true); ?>
					<video muted loop autoplay id="myVideo">
						<source data-src="<?php echo get_post_meta($post->ID, 'video_loop', true); ?>" type="video/mp4">
					</video>
					<div class="overlay"></div>
					<div class="contenido_tarjeta">
						<div class="texto_tarjeta">
							<h1><?php the_title(); ?></h1>
							<p class="texto_naranja"><b>CATEGORIAS:</b>
								<?php
								$cats = get_the_terms($post->ID, 'categoriasTarjetas');
								if ($cats) {
									foreach ($cats as $catt) {
										echo $catt->name . ', ';
									}
								}
								?>
							</p>
							<p class="texto_naranja"><b>ETIQUETAS:</b>
								<?php
								$etis = get_the_terms($post->ID, 'etiquetasTarjetas');
								if ($etis) {
									foreach ($etis as $ett) {
										echo $ett->name . ', ';
									}
								}
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	 <?php 
	 endwhile;  
	 
	endif;
	wp_reset_postdata(); 
	exit;
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
