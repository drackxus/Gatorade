<?php 
get_header(); ?>
<section class="products contGeneral">
    <div class="products_tit">
        <h1>¡RECÁRGATE ONLINE!</h1>
    </div>
    <div class="products_banner">
        <img src="" alt="">
    </div>
    <div class="search">
        <input type="text" name="" id="" placeholder="Buscar">
    </div>
    
<?php
    global $post;

    $current = get_the_ID($post->ID);
    $cargs = array(
        'child_of'      => 0,
        'orderby'       => 'name',
        'order'         => 'ASC',
        'hide_empty'    => 1,
        'taxonomy'      => 'categoriasProductos', //change this to any taxonomy
    );
    foreach (get_categories($cargs) as $tax) :
        // List posts by the terms for a custom taxonomy of any post type   
        $args = array(
            'post_type'         => 'productos',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
            'orderby'           => 'title',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'categoriasProductos',
                    'field'     => 'slug',
                    'terms'     => $tax->slug
                )
            )
        );
        if (get_posts($args)) :
    ?>
   
        <div class="products_slider_div">
            <div class="products_category">
                <h2><?php echo $tax->name; ?></h2>
            </div>

            <div class="products_slider">
                <?php foreach(get_posts($args) as $p) : 
                    // var_dump($p);
                    ?>
                <div class="products_slider_el">
                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'single-post-thumbnail'); ?>
                    <div class="products_slider_el_img">
                        <img src="<?php if($image[0]) { echo $image[0]; } ?>" alt="">
                    </div>
                    <div class="products_slider_el_tit">
                        <h3><?php echo $p->post_title; ?></h3>
                    </div>
                    <div class="products_slider_el_more">
                        <a href="<?php echo $p->guid; ?>">CONOCE MÁS</a>
                    </div>
                    <div class="products_slider_el_buy">
                        <a href="<?php $key = "link_comprar_producto"; echo get_post_meta($p->ID, $key, true); ?>">COMPRAR</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php 
        endif;
    endforeach; 
?>
</section>

<?php
get_footer();