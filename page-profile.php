<?php

/**
 * Template Name: Profile
 *
 * @package WordPress
 */

get_header();

?>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
  .content-center {
    padding-top: 4.5rem;
  }

  .content-left {
    text-align: left;
  }

  .img {
    padding-top: 2rem;
    padding-bottom: 1.5rem;
    padding-left: 0rem;
  }

  .label {
    color: white;
    height: 70px;
    margin-left: auto;
    margin-right: auto;
    width: 134px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: large;
    padding-top: 1rem;
  }

  .button {
    text-align: center;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f2973f;
    border-radius: 17px;
    width: 120px;
    height: 27px;
    border: none;
    font-weight: bold;
    font-size: large;
  }

  .text-small-center {
    color: rgb(216, 195, 195);
    height: 120px;
    margin-left: auto;
    margin-right: auto;
    width: 320px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: small;
    margin-bottom: 4.5rem;
  }

  .img-bottom-div {
    display: inline-flex;
    position: relative;
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
    left: 8em;
    bottom: -3em;
  }

  .img-bottom-div .button-right {
    position: absolute;
    right: -5em;
    bottom: -3em;
  }

  .button-left {
    background-color: transparent;
    background-image: url('<?php echo IMGURL ?>/pefil/cross.png');
    height: 40px;
    width: 40px;
    border: none;
    background-repeat: no-repeat;
  }

  .button-right {
    background-color: transparent;
    background-image: url('<?php echo IMGURL ?>/pefil/cross.png');
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
    z-index: 2;
  }

  .title {
    color: rgb(177, 169, 169);
    height: 50px;
    margin-left: auto;
    margin-right: auto;
    width: 100%
    font-family: Arial, Helvetica, sans-serif;
    font-size: x-large;
    display: flex;
    justify-content: center;
}

  .subtitle {
    color: white;
    height: 40px;
    margin-left: auto;
    margin-right: auto;
    width: 320px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: medium;
    text-align: center;
  }

  .footer {
    position: fixed;
    overflow: hidden;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 2;
  }

  .photo-circle-div {
    display: inline-flex;
    text-align: center !important;
    height: 100px;
  }

  photo-circle-div {
    display: flex;
    margin-bottom: 17px;
}

  .img-first {
    padding-top: 5.5rem;
    padding-bottom: 4rem;
  }

  .div-buttons {
    display: inline flex;
    text-align: center;
  }

  .title-left {
    text-align: left;
    color: white;
    height: 50px;
    padding-top: 0.4rem;
    margin-left: auto;
    margin-right: auto;
    width: 320px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: large;
  }

  .images-div {
    text-align: center;
    display: flex;
    width: 381px;
    height: 172px;
    margin-left: auto;
    margin-right: auto;
  }

  .images1 {
    height: 172px;
    width: 124px;
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    background-image: url('<?php echo IMGURL ?>/pefil/gatorade1.jpg');
  }

  .images2 {
    height: 172px;
    width: 124px;
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    background-image: url('<?php echo IMGURL ?>/pefil/gatorade2.jpg');
  }

  .images3 {
    height: 172px;
    width: 124px;
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    background-image: url('<?php echo IMGURL ?>/pefil/gatorade3.jpg');
  }

  .button-share-div {
    text-align: right;
  }

  .button-share {
    appearance: none;
    background-image: url('<?php echo IMGURL ?>/pefil/share-button.png');
    height: 24px;
    width: 42px;
    border-radius: 15px;
    background-repeat: no-repeat;
    background-position: center;
  }

  .button-share-img4-div {
    text-align: right;
    flex-grow: 1;
    flex-basis: 0;
    padding-top: 3rem;
  }

  .images4 {
    text-align: center;
    height: 85px;
    width: 300px;
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    background-image: url('<?php echo IMGURL ?>/pefil/balon-futbol.png');
    border-radius: 17px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 3.5rem;
  }

  .text-insig {
    text-align: left;
    font-size: x-large;
    font-weight: bold;
    flex-grow: 1;
    flex-basis: 0;
    width: 160px;
    padding-left: 0.5rem;
  }

  .row-header {
    display: flex;
  }
</style>





<style>
    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
<?php
  global $post;

  $current = get_the_ID($post->ID);
  $cargs = array(
      'child_of'      => 0,
      'orderby'       => 'name',
      'order'         => 'ASC',
      'hide_empty'    => 1,
      //'taxonomy'      => 'categoriasEventos', //change this to any taxonomy
  );
      // List posts by the terms for a custom taxonomy of any post type  
      
      $post_ids = array(109, 119);
      $post_types = array('tarjetas', 'eventos');

      $argsFav = array(
        'post__in' => $post_ids,
        'orderby' => 'post__in',
        'post_type' => $post_types,
        'post_status' => 'publish',
        
      );
      $posts = get_posts($argsFav);
      // var_dump($posts);
?>
  
<div class="content-center">
  <div></div>
  <div class="title">
    <span><strong>PERFIL</strong></span>
  </div>
  <div class="photo-circle-div">
  </div>
  <div class="photo-circle-div">
    <div class="photo-circle-center col-4">
    </div>
  </div>
</div>
<div class="subtitle">
  <span><strong>SANTIAGO PEREZ</strong></span>
</div>
<div class="div-buttons">
  <button class="button">MEXICO</button>
  <button class="button">FÚTBOL</button>
</div>
<div class="title-left">
  <span><strong>FAVORITOS</strong></span>
</div>
<!-- Slider -->
<?php 
    //$favorites = get_user_meta($current_user->ID, 'favorite_post_id', true);
    //$favs = explode(',',$favorites);
    //var_dump($posts);
     foreach($posts as $p) : 
      echo $p->ID;
      // var_dump($p);
?>    
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
           <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($p->ID), 'single-post-thumbnail'); ?>
          <div>          
          
            <div class="button-share-div">
              <button class="button-share"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    <!-- Slider -->


<div class="title-left">
  <span><strong>EVENTOS</strong></span>
</div>
<!-- Slider -->
<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Slider -->
<div class="title-left">
  <span><strong>INSIGNIAS</strong></span>
</div>

<!-- Slider -->
<div class="swiper-container-insignias">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <div>
        <img src="<?php echo IMGURL ?>perfil/gatorade1.jpg" alt="">
        <div class="button-share-div">
          <button class="button-share"></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Slider -->

<div class="images4 row-header">
  <div class="text-insig">
    <span>LOCO X EL FÚTBOL</span>
  </div>
  <div class="button-share-img4-div">
    <button class="button-share"></button>
  </div>
</div>
<footer class="footer">
  <div class="img-bottom-div">
    <button class="button-right"></button>
  </div>
</footer>
</div>


<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

 <!-- Initialize Swiper -->
 <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 10,
    });

    var swiper2 = new Swiper('.swiper-container-insignias', {
      slidesPerView: 1,
      spaceBetween: 10,
    });
  </script>

<?php
get_footer();
?>