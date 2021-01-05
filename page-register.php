<?php

/**
 * Template Name: Registro
 *
 * @package WordPress
 */

get_header();

get_template_part( 'template-parts/login/login' );

?>
<style>
  .bottom {
    display: none !important;
  }
</style>

<section class="contGeneral">
  <div class="div_close">
    <button class="button_close"></button>
  </div>
  <form name="register" id="register">
    <div class="content_center">
      <div>
        <img class="img_registry" src="<?php echo IMGURL ?>registro/gatorade-logo.png" alt="">
      </div>
      <div class="label">
        <span><strong>¡CONÉCTATE CON EL MUNDO GATORADE!</strong></span>
      </div>
      <div class="div_text">
        <input class="input_text" type="text" placeholder="Nombre" id="user" name="user" value="<?php echo isset($_POST['user']) ? $_POST['user'] : null; ?>" required />
      </div>
      <div></div>
      <div class="div_text">
        <input class="input_text" type="email" placeholder="E-mail (ID Usuario)" id="email" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : null); ?>" required />
      </div>
      <div class="div_text">
        <select class="select_text" id="pais" name="pais" value="<?php echo (isset($_POST['pais']) ? $_POST['pais'] : null); ?>" required>
          <option class="option_center">País</option>
        </select>
      </div>
      <div class="div_text">
        <select class="select_text" id="ciudad" name="ciudad" value="<?php echo (isset($_POST['ciudad']) ? $_POST['ciudad'] : null); ?>" required>
          <option class="option_center">Ciudad</option>
        </select>
      </div>
      <div class="div_text">
        <input class="input_text" type="number" id="celular" name="celular" placeholder="Celular" value="<?php echo (isset($_POST['celular']) ? $_POST['celular'] : null); ?>" required />
      </div>
      <div class="div_text">
        <select class="select_text" id="deporte" name="deporte" value="<?php echo (isset($_POST['deporte']) ? $_POST['deporte'] : null); ?>" required>
          <option class="option_center">Deporte favorito</option>
        </select>
      </div>
      <div class="text_medium_center">
        <input type="checkbox" class="checkbox" id="terminos" name="terminos" value="<?php echo (isset($_POST['terminos']) ? $_POST['terminos'] : null); ?>" required /><span>Acepto los terminos, condiciones y politicas de Gatorade</span>
      </div>
      <div class="div_button_registry">
        <button class="button" type="submit" id="submit" name="submit">CONFIRMAR</button>
      </div>
    </div>
  </form>
  <?php echo apply_shortcodes('[miniorange_social_login shape="longbuttonwithtext" theme="default" space="8" width="180" height="35" color="000000"]') ?>
</section>

<?php
get_footer();
?>