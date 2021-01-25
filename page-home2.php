<?php

/**
 * Template Name: Home 2
 *
 * @package WordPress
 */

get_header();

?>

<!-- Fullpage -->
<link rel="stylesheet" href="https://rawgit.com/alvarotrigo/fullPage.js/master/dist/fullpage.css" />


<?php

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
<div id="fullpage">
    <!-- TARJETAS -->



    <?php
    $taxonomy = 'categoriasTarjetas';
    $etiqueta = 'etiquetasTarjetas';
    $termId = 'Prueba';

    $args = array(
        'post_type' => 'tarjetas',
        'post_status' => 'publish',
        'posts_per_page' => '10',
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
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                <!-- <div class="slide favoritos">
                    <div class="contenido center_flex">
                        <div class="contenido_tarjeta_compartir">
                            <h1>Guardar en favoritos</h1>
                            <br>
                        </div>
                    </div>
                </div> -->
                <div class="slide active">
                    <!-- Cover page -->
                    <div>

                        <!-- Page 4 (Rabbit): 3 layers (fill (video) + vertical + vertical) -->
                        <div id="page4">
                            <div>
                                <video autoplay muted loop width="720"  height="1280" poster="assets/rabbit.jpg">
                                    <source src="<?php echo get_post_meta($post->ID, 'video_loop', true); ?>" type="video/mp4">
                                </video>
                            </div>
                            <div>
                                <h1><?php the_title(); ?></h1>
                                <div id="favorites" >
                                    <input type="hidden" id="postId" value="<?php 
                                        if ($post->ID){
                                            echo $post->ID;
                                        }?>" >    
                                    <input type="hidden" id="userId" value="<?php 
                                    if ($current_user->ID){
                                        echo $current_user->ID;
                                    }?>" >    
                                    <img class="favorite-button" src="<?php echo IMGURL ?>estrella.png" alt="">
                                </div>
                            </div>
                            </div>

                        
                    </div>



                    <!-- <div class="contenido" style="background-image: url('<?php if ($image[0]) {
                                                                                    echo $image[0];
                                                                                } ?>');">
                        
                    <video loop muted controls="false" data-autoplay id="myVideo" preload="metadata">
                        <source src="<?php echo get_post_meta($post->ID, 'video_loop', true); ?>#t=0.1" type="video/mp4">
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
                    </div> -->
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




</div>



<?php
get_footer();
?>