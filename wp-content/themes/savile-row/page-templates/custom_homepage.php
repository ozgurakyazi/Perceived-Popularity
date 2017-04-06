<?php
/*
 * Template Name: Custom Homepage
 * Description: A home page with featured slider and widgets.
 *
 * @package savilerow
 * @since savilerow 1.0
 */

get_header(); ?>

  <div id="primary_home" class="content-area">
  	<div id="content" class="fullwidth_home" role="main">

      <?php 
      
        // HERO SECTION

        if( get_theme_mod('homepage_hero_show') ){
          echo savilerow_hero_section();
        } 

      ?>


      <?php 

      // FLEXSLIDER SECTION

      if( get_theme_mod('homepage_flexslider_show') ): ?>

        <?php echo savilerow_flexslider_section(); ?>

      <?php endif; ?>


      <?php 

        // FEATURED SECTION

        if(! get_theme_mod('homepage_service_bool')) {

          echo savilerow_featured_section();

        }

      ?>

      <?php 

        // PROMOTIONAL BAR

        if(! get_theme_mod('homepage_promotional_bool')){

          echo savilerow_promobar_section();

        } 

      ?>


      <?php

        // RECENT POSTS

        if(! get_theme_mod('homepage_recent_bool')){

          echo savilerow_recent_posts_section();

        }

      ?>


      <?php 

        // PARTNERS SECTION

        if(! get_theme_mod('homepage_partners_bool')){

          echo savilerow_partners_section();

        }

      ?>

<?php get_footer(); ?>
