<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Sabino
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function sabino_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'sabino_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function sabino_jetpack_setup
add_action( 'after_setup_theme', 'sabino_jetpack_setup' );

function sabino_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'templates/contents/content' );
	}
} // end function sabino_infinite_scroll_render