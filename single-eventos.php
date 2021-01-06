<?php


get_header(); 

global $post;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento especifico</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .content-center {
            text-align: center;
        }
        .content-left {
            text-align: left;
        }
        .img {
            padding-top: 2rem;
            padding-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        .label {
            color: white;
            height: 75px;
            margin: auto;
            width: 220px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: x-large;
            padding-top: 2rem;
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
        .text-small {
            color: gray;
            font-size: smaller;
            font-family: Arial, Helvetica, sans-serif;
        }
        .text-medium {
            color: #faf6f3;
            font-size: large;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            padding-top: 0.5rem;
        }
        .text-title {
            color: white;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;
        }
        .div-title {
            padding-top: 1rem;
        }
        .text-small-center {
            color: gray;
            height: 50px;
            margin: auto;
            width: 320px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: small;
        }
        .img-background {
            background-image: url(./img/fondo.jpg);
            background-size: auto auto;
            height: 150px;
        }
        .div-close {
            text-align: right;
            padding-right: 1.5rem;
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
        .icon-sport {
            text-align: center;
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
        .time-box {
            appearance: none;
            background-color: white;
            border-radius: 3px;
            height: 50px;
            width: 50px;
        }
        .time-box-div {
            display: inline-flex;
            text-align: center !important;
            padding-top: 2rem;
        }
        .text-time-div {
            display: inline-flex;
            text-align: center !important;
            color: #faf6f3;
            font-size: 11px;
            width: 183px;
            padding-bottom: 1rem;
        }
        .text-time {
            margin-left: 3rem;
            margin-right: 2.2rem;
        }
        .photo-circle {
            appearance: none;
            background-color: white;
            border-radius: 30px;
            height: 60px;
            width: 60px;
        }
        .photo-circle-div {
            display: inline-flex;
            text-align: center !important;
            padding-top: 1rem;
        }
        .photo-circle-center {
            margin-left: 2rem;
            margin-right: 2rem;
        }
        .img-bottom-div {
            display: inline-flex;
            position: relative;
            padding-top: 1rem;
            margin-bottom: 3.5rem;
            height: auto;
            max-width: 100%;
            position: relative;
        }
        .img-bottom {
            height: auto;
            max-width: 100%;
            position: relative;
        }
        .img-bottom-div .button-left {
            position: absolute;
            left: 1em;
            bottom: -1em;
        }
        .img-bottom-div .button-right {
            position: absolute;
            right: 1em;
            bottom: -1em;
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

    </style>
</head>
<body style="background-color: black;">
    <div class="img-background row">
        <div class="content-left col-6">
            <img class="img" src="./img/gatorade-small-logo.png" alt="">
            <button class="button-menu"></button>
        </div>
        <div class="div-close col-6">
            <button class="button-close"></button>
        </div>
        <div class="icon-sport">
            <img src="./img/iconoFutbol.png" alt="">
        </div>
    </div>
    <div class="content-center">
        <div class="label">
            <span><strong><?php echo $post->post_title; ?></strong></span>
        </div>
        <div class="text-small-center">
            <span><?php echo the_content(); ?></span>
        </div>
        <div class="label">
            <span><strong>FALTAN:</strong></span>
        </div>
        <div class="time-box-div">
            <div class="time-box col-4">
                
            </div>
            <div class="text-medium">
                <span><strong>:</strong></span>
            </div>
            <div class="time-box col-4">
                
            </div>
            <div class="text-medium">
                <span><strong>:</strong></span>
            </div>
            <div class="time-box col-4">
                
            </div>
        </div>
        <div></div>
        <div class="text-time-div">
            <div>
                <span><strong>DÍAS</strong></span>
            </div>
            <div class="text-time">
                <span><strong>HORAS</strong></span>
            </div>
            <div >
                <span><strong>MINUTOS</strong></span>
            </div>
        </div>
        <div class="text-small-center">
            <span>Descripción del evento.</span>
        </div>
        <div class="div-title">
            <span class="text-title">INSCRITOS AL EVENTO</span>
        </div>
        <div class="photo-circle-div">
            <div class="photo-circle col-4">

            </div>
            <div class="photo-circle-center photo-circle col-4">
                
            </div>
            <div class="photo-circle col-4">
                
            </div>
        </div>
        <div class="div-title">
            <span class="text-title">EVENTOS ANTERIORES</span>
        </div>
        <div class="img-bottom-div">
        <?php
    $args = array(
        'post_type' => 'eventos',
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
        <div></div>
    </div>
    
</body>
</html>

<?php
get_footer();
