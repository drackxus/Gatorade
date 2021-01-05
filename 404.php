<?php
/**
 * The template for displaying 404 pages (not found)
  *
 *
 * @package WordPress
 */

get_header(); ?>
	<div class="woowContent1600 pure-g div_mail div_light" style="padding-top: 1em; margin-bottom: 1em">
		<div class="pure-u-1" style="padding-top: 4em; padding-bottom: 4em">
			<div style="text-align: center; font-size: 2em;">
				- oops! - <br>
				ERROR
				<div style="margin: 3%">
					<img style="width:50%" src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/404.jpg">
				</div>
			</div>
			
			<div class="email_notice">
				<div class="linea-content-404">
					<span class="linea-content-gris"></span>
					<span class="icon-engranaje"></span>
					<span class="linea-content-gris"></span>
				</div>
				<p style="text-align:center;margin-bottom:1em">La página que estas buscando no se puede encontrar, sin embargo puedes continuar navegando</p>
				<a style="width:100%;text-align:center;display:block;" href="<?php echo home_url(); ?>" class="am-button-defect">Ir al Home</a>
			</div>
			
		</div>
    </div>
<?php get_footer(); ?>
