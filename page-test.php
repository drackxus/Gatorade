<?php

/**
 * Template Name: Test
 *
 * @package WordPress
 */

get_header();

?>

<?php 
            global $current_user; wp_get_current_user();
            if ( is_user_logged_in() ) { 
              echo 'Username: ' . $current_user->user_login . "\n"; echo 'User display name: ' . $current_user->display_name . "\n"; 
            } 
            else { 
              echo 'Aun no tienes una cuenta';
              echo '<br><br>';
              wp_loginout(); 
            } 
            
            
          $cat =   get_user_meta( $current_user->ID, 'interesCategoria', false );
          $eti =   get_user_meta( $current_user->ID, 'interesEtiqueta', false );	

          
  
  var_dump($cat);
  var_dump($eti);
  ?>
<div id="fullpage">
  <!-- TARJETAS -->
  

            
  <?php
  $taxonomy = 'categorias';
$termId = 8;

  $args = array(
    'post_type' => 'tarjetas',
    'post_status' => 'publish', 
    'tax_query' => array(
      array(
        'taxonomy' => $taxonomy,
        'field' => 'id',
        'terms' => $termId // You can pass more then one term id like array(32, 65)
      )
  )
  );
  $result = new WP_Query($args);
  if ($result->have_posts()) : 
    $i=0; ?>
    <?php while ($result->have_posts()) : $result->the_post(); ?>

      
              <h1 style="position: absolute; z-index: 99;"><?php the_title(); ?></h1>
             
    <?php endwhile; ?>
  <?php endif;
  wp_reset_postdata(); ?>
<!-- TARJETAS -->



<?php
get_footer();
?>