<?php
/**
 * Functions for users wanting to upgrade to premium
 *
 * @package Sabino
 */

/**
 * Display the upgrade to Premium page & load styles.
 */
function sabino_premium_admin_menu() {
    global $sabino_upgrade_page;
    $sabino_upgrade_page = add_theme_page( __( 'About Sabino', 'sabino' ), '<span class="premium-link">' . __( 'About Sabino', 'sabino' ) . '</span>', 'edit_theme_options', 'theme_info', 'sabino_render_upgrade_page' );
}
add_action( 'admin_menu', 'sabino_premium_admin_menu' );

/**
 * Enqueue admin stylesheet only on upgrade page.
 */
function sabino_load_upgrade_page_scripts() {
    global $pagenow;
	if ( $pagenow == 'themes.php' ) {
		wp_enqueue_style( 'sabino-upgrade-css', get_template_directory_uri() . '/upgrade/css/upgrade-admin.css' );
	    wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), SABINO_THEME_VERSION, true );
	    wp_enqueue_script( 'sabino-upgrade-js', get_template_directory_uri() . '/upgrade/js/upgrade-custom.js', array( 'jquery' ), SABINO_THEME_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'sabino_load_upgrade_page_scripts' );

/**
 * Render the premium page to download premium upgrade plugin
 */
function sabino_render_upgrade_page() {
	get_template_part( 'upgrade/tpl/upgrade-page' );
}
