<?php

global $current_user;
wp_get_current_user();
if ( is_user_logged_in() ) { 
  ?>
  <div class='msgAlert' style='display:flex;opacity:1;'><p>Opps. Parece que ya estas logueado <?php wp_loginout(home_url()); ?></p></div> 
  <?php
  $logueado = true;
} 
else { 
  $logueado = false;
} 

?>