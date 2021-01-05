<?php


get_header(); 

global $post;
?>

<section class="productsDetail contGeneral">
    <div class="productsDetail_img">
        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
        <?php foreach($image as $img){ ?> 
        <img src="<?php echo $img ?>" alt="">
        <?php } ?>
    </div>
    <div class="productsDetail_name">
        <h1><?php echo $post->post_title; ?></h1>
    </div>
    <div class="productsDetail_content">
        <?php echo the_content(); ?>
    </div>
    <div class="productsDetail_nutritional">
        <div>

        </div>
    </div>
    <div class="productsDetail_buy">
        <a href="<?php $key = "link_comprar_producto"; echo get_post_meta($post->ID, $key, true); ?>">COMPRAR</a>
    </div>
</section>

<section class="productsFeatured">
    <div class="productsFeatured_tit">
        <h2>PRODUCTOS DESTACADOS</h2>
    </div>
    <div class="productsFeatured_list">
    <?php
    $args = array(
        'post_type' => 'productos',
        'post_status' => 'publish',
        'posts_per_page' => '25'
    );
    $result = new WP_Query($args);
    if ($result->have_posts()) :
        $i = 0; ?>
        <?php while ($result->have_posts()) : $result->the_post(); ?>

            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
            <div class="productsFeatured_list_el">
                <div class="productsFeatured_list_el_img">
                    <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo $image[0]; ?>" alt="">
                    </a>
                </div>
            </div>
            
        <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata(); ?>
    </div>
</section>

<?php
get_footer();
