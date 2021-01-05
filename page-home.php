<?php

/**
 * Template Name: Home
 *
 * @package WordPress
 */

get_header();

?>

<!-- Fullpage -->
<link rel="stylesheet" href="https://rawgit.com/alvarotrigo/fullPage.js/master/dist/fullpage.css" />

<!-- <div class="pais">
    <div>
        <h2>Bienvenido</h2>
        <br>
        <h3>Vemos que te estas intentado conectar desde <span class="country"></span></h3>
        <br>
        <button class="seguir">Seguir con <span class="country"></span></button>
    </div>
    <hr>
    <div>
        <h2>Elegir otro país</h2>
        <br>
        <ul>
            <li><a href="/mx">Mexico</a></li>
            <li><a href="#">Mexico</a></li>
            <li><a href="#">Mexico</a></li>
            <li><a href="#">Mexico</a></li>
        </ul>
    </div>
</div> -->
<?php
global $current_user;
wp_get_current_user();
// if ( is_user_logged_in() ) { 
//   echo 'Username: ' . $current_user->user_login . "\n"; echo 'User display name: ' . $current_user->display_name . "\n"; 
// } 
// else { 
//   echo 'Aun no tienes una cuenta';
//   echo '<br><br>';
//   wp_loginout(); 
// } 


$cat =   get_user_meta($current_user->ID, 'interesCategoria', false);
$eti =   get_user_meta($current_user->ID, 'interesEtiqueta', false);
if ($cat) {
    $catF = explode(',', $cat[0]);
}

if ($eti) {
    $etiF = explode(',', $eti[0]);
}


// var_dump($cat);
// var_dump($eti);
?>
<button>
    Add section
</button>
<div id="fullpage">
    <!-- TARJETAS -->



    <?php
    $taxonomy = 'categoriasTarjetas';
    $etiqueta = 'etiquetasTarjetas';
    $termId = 'Prueba';

    $args = array(
        'post_type' => 'tarjetas',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        /*'tax_query' => array(
      'relation' => 'OR',
      array(
        'taxonomy' => $taxonomy,
        'field' => 'slug',
        'terms' => $catF // You can pass more then one term id like array(32, 65)
      ),
      array(
        'taxonomy' => $etiqueta,
        'field' => 'slug',
        'terms' => $etiF // You can pass more then one term id like array(32, 65)
      )
    )*/
    );
    $result = new WP_Query($args);
    // var_dump($result);
    if ($result->have_posts()) :
        $i = 0; ?>
        <?php while ($result->have_posts()) : $result->the_post(); ?>

            <div class="section">
                <!-- <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                <div class="slide favoritos">
                    <div class="contenido center_flex">
                        <div class="contenido_tarjeta_compartir">
                            <h1>Guardar en favoritos</h1>
                            <br>
                        </div>
                    </div>
                </div> -->
                <div class="slide active">
                    <div class="contenido" style="background-image: url('<?php if ($image[0]) { echo $image[0]; } ?>');">
                        <video muted loop <?php if ($i == 0) { $i = 1; ?> autoplay <?php } ?> id="myVideo">
                            <source data-src="<?php $key = "link_video"; echo get_post_meta($post->ID, $key, true); ?>" type="video/mp4">
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
                <!-- <div class="slide">
                    <div class="contenido">
                        <div class="contenido_tarjeta_interna ">
                            <?php if ($image[0]) { ?>
                                <img src="<?php echo $image[0]; ?>" style="width: 100%; height: auto" alt="" />
                            <?php } ?>
                            <h1><?php the_title(); ?></h1>
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                </div> -->
            </div>
        <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata(); ?>
    <!-- TARJETAS -->



    <!-- PUBLICIDAD -->
    <?php
    $args = array(
        'post_type' =>
        'publicidad', 'orderby' => 'ID', 'post_status' => 'publish', 'order' => 'DESC',
        'posts_per_page' => 1
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) :
        $i = 0; ?>
        <?php while ($result->have_posts()) : $result->the_post(); ?>

            <div class="section">
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                <div class="slide active">
                    <div class="contenido" style="background-image: url('<?php echo $image[0]; ?>');">
                        <video muted loop <?php if ($i == 0) { $i = 1; ?> autoplay <?php } ?> id="myVideo">
                            <source data-src="<?php $key = "link_video"; echo get_post_meta($post->ID, $key, true); ?>" type="video/mp4">
                        </video>
                        <div class="overlay"></div>
                        <div>
                            <h1 style="position: absolute; z-index: 99; font-size. 30px; color:  rgb(250, 80, 1);"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata(); ?>
    <!-- PUBLICIDAD -->
</div>



<?php
get_footer();
?>