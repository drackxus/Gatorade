<?php

/**
 * Template Name: Prueba
 *
 * @package WordPress
 */

get_header();

?>

<!-- Fullpage -->
<link rel="stylesheet" href="https://rawgit.com/alvarotrigo/fullPage.js/master/dist/fullpage.css" />

<style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }
        
        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
        
        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
        
        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
        
        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
        
        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
    </style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
        amp-story {
            font-family: 'Oswald', sans-serif;
            color: #fff;
        }
        
        amp-story-page {
            background-color: #000;
        }
        
        h1 {
            font-weight: bold;
            font-size: 2.875em;
            font-weight: normal;
            line-height: 1.174;
        }
        
        p {
            font-weight: normal;
            font-size: 1.3em;
            line-height: 1.5em;
            color: #fff;
        }
        
        q {
            font-weight: 300;
            font-size: 1.1em;
        }
        
        amp-story-grid-layer.bottom {
            align-content: end;
        }
        
        amp-story-grid-layer.noedge {
            padding: 0px;
        }
        
        amp-story-grid-layer.center-text {
            align-content: center;
        }
        
        .wrapper {
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 50% 50%;
        }
        
        .banner-text {
            text-align: center;
            background-color: #000;
            line-height: 2em;
        }
    </style>

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
                <div class="slide active">

                    <!-- Cove
                    r page -->
                    <amp-story standalone supports-landscape title="Joy of Pets" publisher="AMP tutorials" publisher-logo-src="assets/AMP-Brand-White-Icon.svg" poster-portrait-src="assets/cover.jpg">
                    


                        <!-- Page 4 (Rabbit): 3 layers (fill (video) + vertical + vertical) -->
                        <amp-story-page id="page4">
                            <amp-story-grid-layer template="fill">
                                <amp-video autoplay loop width="720" height="1280" poster="assets/rabbit.jpg" layout="responsive">
                                    <source src="<?php echo get_post_meta($post->ID, 'video_loop', true); ?>" type="video/mp4">
                                </amp-video>
                            </amp-story-grid-layer>
                            <amp-story-grid-layer template="vertical">
                                <h1 animate-in="pulse" animate-in-delay="0.3s" animate-in-duration="0.5s"><?php the_title(); ?></h1>
                            </amp-story-grid-layer>
                            <amp-story-grid-layer template="vertical" class="bottom">
                                <p animate-in="rotate-in-right" animate-in-delay="0.5s" animate-in-duration="0.5s">Rabbits can learn to follow simple voice commands and come when called by name, and are curious and playful.</p>
                            </amp-story-grid-layer>
                        </amp-story-page>

                        

                        <!-- Bookend -->
                        <amp-story-bookend src="bookend.json" layout="nodisplay"></amp-story-bookend>
                    </amp-story>

                    


                </div>
                <?php endwhile; ?>
                        <?php endif;
                        wp_reset_postdata(); ?>
            </div>
        
    <!-- TARJETAS -->




</div>



<?php
get_footer();
?>