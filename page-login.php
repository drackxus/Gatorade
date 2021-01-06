<?php

/**
 * Template Name: Login
 *
 * @package WordPress
 */

get_header();

if ( is_user_logged_in() ) {
  $current_user = wp_get_current_user();
  wp_redirect(home_url());

} else {
    $args = array(
        'echo' => true,
        'redirect' => home_url(),
        'form_id' => 'loginform',
        'label_remember' => __( 'Recuperar contraseña' ),
        'label_log_in' => __( 'Ingresar' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'Recuerdame',
        'id_submit' => 'wp-submit',
        'placeholder_username' => __( 'Your username...' ),
	    'placeholder_password' => __( 'Your password...' ),
        'remember' => true,
        'value_username' => '',
        'value_remember' => false
      );
  wp_login_form( $args );
}

?>
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
            width: 300px;
            height: 35px;
            border: none;
            font-weight: bold;
            font-size: large;
        }
        .text-small-center {
            color: rgb(216, 195, 195);
            height: 35px;
            margin-left: auto;
            margin-right: auto;
            width: 220px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
            margin-bottom: 1.5rem;
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
            height: 70px;
            margin-left: auto;
            margin-right: auto;
            width: 180px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: xx-large;
        }
        .subtitle {
            color: white;
            height: 40px;
            margin-left: auto;
            margin-right: auto;
            width: 180px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: large;
            text-align: center;
            margin-top: 6rem;
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
        .button1 {
            background-color: transparent;
            background-image: url('./img/iconoFutbol.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .button2 {
            background-color: transparent;
            background-image: url('./img/iconoBaloncesto.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .button3 {
            background-color: transparent;
            background-image: url('./img/iconoF-americano.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .button4 {
            background-color: transparent;
            background-image: url('./img/iconoNatacion.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .button5 {
            background-color: transparent;
            background-image: url('./img/iconoRunning.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .button6 {
            background-color: transparent;
            background-image: url('./img/iconoBeisbol.png');
            height: 110px;
            width: 110px;
            border: none;
            background-repeat: no-repeat;
            margin-right: 1rem;
            margin-left: 1rem;
        }
        .titles-button {
            display: flex;
            color: white;
            height: 40px;
            margin-left: auto;
            margin-right: auto;
            width: 275px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: large;
            margin-bottom: 1rem;
        }
        .text-button-left {
            padding-right: 3rem;
            padding-left: 1.8rem;
        }
        .text-button3 {
            font-size: medium !important;
            padding-right: 2rem;
            padding-left: 1rem;
        }
        .text-button4 {
            padding-right: 2rem;
            padding-left: 1rem;
        }
        .text-button5 {
            padding-right: 4.1rem;
            padding-left: 1.5rem;
        }
        .titles-button5 {
            text-align: center;
            color: white;
            height: 40px;
            margin-left: auto;
            margin-right: auto;
            width: 275px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: large;
        }
        .div-button-registry {
            padding-top: 2.5rem;
            padding-bottom: 0.5rem;
        }
        .div-bottom {
            background-color: rgb(136, 135, 134);
            height: 200px;
            padding-top: 1rem;
        }
        .a-div {
            text-align: center;
            color: white;
            font-size: medium;
            font-weight: bold; 
            margin-left: auto;
            margin-right: auto; 
            padding-bottom: 1.5rem;
            width: 220PX;
        }
        a {
            color: white;
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
        .input-text {
            text-align: center;
            border-radius: 17px;
            width: 300px;
            height: 35px;
            border: none;
            font-size: medium;
        }
        .div-text {
            padding-top: 0.5rem;
            margin-left: auto;
            margin-right: auto;
        }
        .photo-circle-div {
            height: 100px;
            margin-top: 6rem;
            margin-bottom: 1rem;
        }
        .photo-circle-center {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            appearance: none;
            background-position: center;
            background-image: url('./img/iconoFavorito.png');
            border-radius: 50px;
            height: 110px;
            width: 110px;
            background-repeat: no-repeat;
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

<?php echo apply_shortcodes('[miniorange_social_login shape="longbuttonwithtext" theme="default" space="8" width="180" height="35" color="000000"]') ?>
<?php
get_footer();
?>