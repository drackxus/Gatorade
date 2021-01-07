<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Nampa Basico
 * @since Nampa Basico 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top: 0px !important;">

<head>
  <?php
  wp_head();
  ?>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta class="des">
  <meta name="description" content="<?php echo get_bloginfo('description', 'display'); ?>">
  <meta name="title" content="<?php echo wp_title('|', true, 'left'); ?>">
  <meta name="language" content="Español">
  <meta name="googlebot" content="INDEX, FOLLOW">
  <!-- General Css Styles -->
  <!-- <link rel="stylesheet" href="<?php echo CSSURL ?>pure-min.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo CSSURL ?>grids-responsive-min.css"> -->
  <!-- Style Site -->
  <link rel="stylesheet" href="<?php echo CSSURL ?>style.css?v=<?php echo VCACHE ?>">
  <link rel="stylesheet" href="<?php echo CSSURL ?>admin-colors.css?v=<?php echo VCACHE ?>">
  <!-- Responsive Style Site -->
  <!-- <link rel="stylesheet" href="<?php echo CSSURL ?>style-responsive.css?v=<?php echo VCACHE ?>"> -->
  <!-- Responsive Style Site -->
  <!-- <link rel="stylesheet" href="<?php echo CSSURL ?>icomoon/style.css"> -->
  <!-- Fuentes -->
  <link rel="stylesheet" href="<?php echo CSSURL ?>fuentes.css?v=<?php echo VCACHE ?>">

  <title>
    <?php
    // Add the page or post name.
    wp_title('|', true, 'left');
    ?>
  </title>
</head>

<body>
 
  <div class="msgAlert">
    <p>Tu registro ha sido exitoso, verifica tu buzon de mensajes para establecer tu contraseña<br>Seras redirigido automaticamente<br><a href="<?php echo home_url(); ?>">Ir a la pagina principal</a></p>
  </div>
  <div id="loader">
    <img src="<?php echo IMGURL ?>loader.gif" alt="">
  </div>
  <div id="infinite">
    <img src="<?php echo IMGURL ?>infinite.gif" alt="">
  </div>
  <!--======= Seccion Header =======-->
  <header class="header">
  <?php get_template_part( 'template-parts/navigation/navigation' ); ?>
  </header>