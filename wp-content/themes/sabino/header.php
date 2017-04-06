<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sabino
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site <?php echo sanitize_html_class( get_theme_mod( 'sabino-slider-type' ) ); ?> <?php echo ( get_theme_mod( 'sabino-content-layout' ) == 'sabino-content-layout-blocks' ) ? sanitize_html_class( 'content-layout-blocks' ) : sanitize_html_class( 'content-layout-joined' ); ?> <?php echo ( get_theme_mod( 'sabino-content-break-widgets' ) ) ? sanitize_html_class( 'content-broken-widgets' ) : sanitize_html_class( 'content-joined-widgets' ); ?> <?php echo ( get_theme_mod( 'sabino-remove-page-titles' ) ) ? sanitize_html_class( 'no-page-titles' ) : ''; ?>">

	<?php if ( get_theme_mod( 'sabino-header-layout' ) == 'sabino-header-layout-two' ) : ?>
		
		<?php get_template_part( '/templates/header/header-layout-two' ); ?>
		
	<?php else : ?>
		
		<?php get_template_part( '/templates/header/header-layout-one' ); ?>
		
	<?php endif; ?>
	
	<?php if ( is_front_page() ) : ?>
	    
	    <?php get_template_part( '/templates/slider/homepage-slider' ); ?>
	    
	<?php endif; ?>

	<div class="site-container site-container-main <?php echo ( ! is_active_sidebar( 'sidebar-1' ) ) ? sanitize_html_class( 'content-no-sidebar' ) : sanitize_html_class( 'content-has-sidebar' ); ?>">
