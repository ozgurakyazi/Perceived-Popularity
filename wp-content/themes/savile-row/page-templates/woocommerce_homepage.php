<?php
/*
 * Template Name: Woocommerce Homepage
 * Description: A home page with woocommerce in mind.
 *
 * @package savilerow
 * @since savilerow 1.0
 */

get_header(); ?>

  <div id="primary_home" class="content-area">
  	<div id="content" class="fullwidth_home" role="main">
      
	  <?php do_action( 'homepage' ); ?>

    </div><!-- .container -->
	</div><!-- .wrap -->

<?php get_footer(); ?>
