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

<div id="fullpage">

    <?php
    $args = array(
        'post_type' => 'tarjetas',
        'post_status' => 'publish',
        'posts_per_page' => '2'
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) :
        while ($result->have_posts()) : $result->the_post();
    ?>
            <div class="section">
                <div class="slide">
                    <div class="card">
                        <div class="card_content">
                            <?php
                                if (get_post_meta($post->ID, 'video_loop', true)) {
                            ?>
                                <video autoplay muted loop poster="<?php echo get_post_meta($post->ID, 'poster', true); ?>" class="video_bg">
                                    <source src="<?php echo get_post_meta($post->ID, 'video_loop', true); ?>" type="video/mp4">
                                </video>
                            <?php 
                            } else {
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                                $image_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                                $image_title = get_the_title(get_post_thumbnail_id($post->ID));
                            ?>   
                            <img src="<?php echo $image[0] ?>" alt="<?php echo $image_alt ?>" class="img_bg" title="<?php echo $image_title ?>">
                            <?php
                            }
                            ?>
                            <div class="card_tit">
                                <h1 class="card_tit_txt">
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="card">
                    <div class="card_detail_content">
                       <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>

<?php
get_footer();
?>