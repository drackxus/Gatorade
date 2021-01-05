<?php

/**
 * Template Name: Profile
 *
 * @package WordPress
 */

get_header();

?>
<div class="perfil">
  <?php

global $post;
var_dump($post);
if($post->post_title == 'pagina donde se valida'){
    
}

  global $current_user;
  wp_get_current_user();
  if (is_user_logged_in()) {
    // echo 'Username: ' . $current_user->user_login . "\n";
    echo 'User display name: ' . $current_user->user_email . "\n";

    
  ?>
    <h2>Perfil</h2>
    <br>
    <h3>Intereses</h3>
    <br>
    <h4>Categorias</h4>
    <?php
    $categorias = get_terms(array(
      'taxonomy' => 'categoriasTarjetas',
      'hide_empty' => false,
    ));
    ?>
    <form name="interes" id="interes">
      <?php foreach ($categorias as $categoria) { ?>
        <label for="cat">
          <input class="cat" type="checkbox" name="cat" nameCat="<?php echo $categoria->name; ?>" id="cat" value="<?php echo $categoria->term_id; ?>" /> <?php echo $categoria->term_id . ' ' . $categoria->name; ?>
        </label>
        <br>
      <?php } ?>
      <br>
      <br>
      <h4>Etiquetas</h4>
      <?php
      $etiquetas = get_terms(array(
        'taxonomy' => 'etiquetasTarjetas',
        'hide_empty' => false,
      ));
      ?>
      <?php foreach ($etiquetas as $etiqueta) { ?>
        <label for="eti">
          <input class="eti" type="checkbox" name="eti" nameEti="<?php echo $etiqueta->name; ?>" id="eti" value="<?php echo $etiqueta->term_id; ?>" /> <?php echo $etiqueta->term_id . ' ' . $etiqueta->name; ?>
        </label>
        <br>
      <?php } ?>
      <br><br>
      <input type="hidden" name="idUser" id="idUser" value="<?php echo $current_user->ID ?>">
      <button style="background: rgb(250, 80, 1);">Actualizar</button>
    </form>


  <?php
  } else {
    echo 'Aun no tienes una cuenta';
    echo '<br><br>';
    wp_loginout();
  } ?>
  <br>
  <span id="txtMessage" style="color: white; font-size: 12px;"></span>
  <ul>
    <li>

    </li>
  </ul>
</div>

<?php
get_footer();
?>