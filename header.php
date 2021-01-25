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
<html <?php language_attributes(); ?> data-wf-domain="ddks-blank-site-95aee2.webflow.io"
  data-wf-page="6005e026c2e3b5ed12e0671a"
  data-wf-site="6005e026c2e3b59c35e06719"
  data-wf-status="1">

<head>
  <?php
  wp_head();
  ?>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta class="des">
  <meta name="description" content="<?php echo get_bloginfo('description', 'display'); ?>">
  <meta name="title" content="<?php echo wp_title('|', true, 'left'); ?>">
  <meta name="language" content="Español">
  <meta name="googlebot" content="INDEX, FOLLOW">

  <link
      href="https://uploads-ssl.webflow.com/6005e026c2e3b59c35e06719/css/ddks-blank-site-95aee2.webflow.d2cb66e28.css"
      rel="stylesheet"
      type="text/css"
    />
    <script
      src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"
      type="text/javascript"
    ></script>
    <script type="text/javascript">
      WebFont.load({
        google: { families: ["Oswald:200,300,400,500,600,700"] },
      });
    </script>
    <!--[if lt IE 9
      ]><script
        src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"
        type="text/javascript"
      ></script
    ><![endif]-->
    <script type="text/javascript">
      !(function (o, c) {
        var n = c.documentElement,
          t = " w-mod-";
        (n.className += t + "js"),
          ("ontouchstart" in o ||
            (o.DocumentTouch && c instanceof DocumentTouch)) &&
            (n.className += t + "touch");
      })(window, document);
    </script>





  <link rel="stylesheet" href="<?php echo CSSURL ?>style.css?v=<?php echo VCACHE ?>">
  <link rel="stylesheet" href="<?php echo CSSURL ?>admin-colors.css?v=<?php echo VCACHE ?>">
  <!-- Responsive Style Site -->
  <!-- <link rel="stylesheet" href="<?php echo CSSURL ?>style-responsive.css?v=<?php echo VCACHE ?>"> -->
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
  <header>
  <?php get_template_part( 'template-parts/navigation/navigation' ); ?>
  <?php get_template_part( 'template-parts/side_buttons/side_buttons' ); ?>
  </header>
  <div class="content">