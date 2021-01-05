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

<?php echo apply_shortcodes('[miniorange_social_login shape="longbuttonwithtext" theme="default" space="8" width="180" height="35" color="000000"]') ?>
<?php
get_footer();
?>