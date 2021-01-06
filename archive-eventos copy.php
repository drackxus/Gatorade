<?php 
get_header()
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
    .content-center {
        text-align: center;
        padding-top: 7rem;
    }
    .content-left {
        text-align: left;
    }
    .img {
        padding-top: 2rem;
        padding-bottom: 1.5rem;
        padding-left: 0rem;
    }
    .button {
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f2973f;
        border-radius: 17px;
        width: 285px;
        height: 35px;
        border: none;
        font-weight: bold;
        font-size: large;
    }
    .div-close {
        text-align: right;
        padding-right: 0rem;
        padding-top: 2rem;
    }
    .button-close {
        background-color: transparent;
        background-image: url('./img/cross.png');
        height: 40px;
        width: 40px;
        border: none;
        background-repeat: no-repeat;
    }
    .button-menu {
        background-color: transparent;
        background-image: url('./img/menu-button.png');
        height: 44px;
        width: 44px;
        border: none;
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        padding-left: 1.5rem;
        background-repeat: no-repeat;
    }
    .img-bottom-div {
        display: flex;
        text-align: center;
    }
    .div-button-left {
        text-align: left;
    }
    .div-button-right {
        text-align: right;
    }
    .button-left {
        background-color: transparent;
        background-image: url('./img/cross.png');
        height: 40px;
        width: 40px;
        border: none;
        background-repeat: no-repeat;
    }
    .button-right {
        background-color: transparent;
        background-image: url('./img/cross.png');
        height: 40px;
        width: 40px;
        border: none;
        background-repeat: no-repeat;
    }
    .header {
        position: fixed;
        overflow: hidden;
        left: 0;
        top: 0;
        right: 0;
    }
    .title {
        color: white;
        height: 50px;
        margin-left: auto;
        margin-right: auto;
        width: 275px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: x-large;
    }
    .footer {
        position: fixed;
        overflow: hidden;
        left: 0;
        bottom: 0;
        right: 0;
    }
    .row-header {
        display: flex;
    }
    .input-text {
        text-align: left;
        border-radius: 17px;
        width: 285px;
        height: 35px;
        border: none;
        font-size: medium;
        border-color: rgb(202, 198, 198);
        border-style: solid;
        background-color: black;
        color: white;
        font-weight: bold;
        background-image: url(img/search_icon-small.png);
        background-repeat: no-repeat;
        background-position: 242px center;;
    }
    .div-text {
        padding-top: 0.1rem;
        padding-bottom: 1rem;
    }
    .images-div {
        text-align: center;
        display: flex;
        width: 280px;
        height: 210px;
        margin-left: auto;
        margin-right: auto;
    }
    .images1 {
        height: 172px;
        width: 124px;
        margin-left: 0.1rem;
        margin-right: 1rem;
        background-image: url('./img/gatorade1.jpg');
    }
    .images2 {
        height: 172px;
        width: 124px;
        margin-left: 1rem;
        margin-right: 0.1rem;
        background-image: url('./img/gatorade2.jpg');
    }
    .button-share-div{
        text-align: right;
        padding-top: 9rem;
    }
    .button-share{
        appearance: none;
        background-image: url('./img/share-button.png');
        height: 24px;
        width: 42px;
        border-radius: 15px;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<section class="products contGeneral">
    <div class="content-center">
        <div class="title">
            <span><strong>EVENTOS</strong></span>
        </div>
        <div class="products_banner">
            <img src="" alt="">
        </div>
        <div class="div-text">
                <input class="input-text" type="text" placeholder="BUSCADOR DE EVENTOS " />
        </div>
        
    <?php
        global $post;

        $current = get_the_ID($post->ID);
        $cargs = array(
            'child_of'      => 0,
            'orderby'       => 'name',
            'order'         => 'ASC',
            'hide_empty'    => 1,
            'taxonomy'      => 'categoriasEventos', //change this to any taxonomy
        );
        foreach (get_categories($cargs) as $tax) :
            // List posts by the terms for a custom taxonomy of any post type   
            $args = array(
                'post_type'         => 'eventos',
                'post_status'       => 'publish',
                'posts_per_page'    => -1,
                'orderby'           => 'title',
                'tax_query' => array(
                    array(
                        'taxonomy'  => 'categoriasEventos',
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
                        <!-- <div class="products_slider_el_buy">
                            <a href="<?php $key = "link_comprar_producto"; echo get_post_meta($p->ID, $key, true); ?>">COMPRAR</a>
                        </div> -->
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php 
            endif;
        endforeach; 
    ?>
    </div>
</section>

<?php
get_footer();