<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Sabino
 */

/**
 * Enqueue Google Fonts Example
 */
function customizer_sabino_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'sabino-body-font', customizer_library_get_default( 'sabino-body-font' ) ),
		get_theme_mod( 'sabino-heading-font', customizer_library_get_default( 'sabino-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'customizer_sabino_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'customizer_sabino_fonts' );
