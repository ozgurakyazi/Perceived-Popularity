<?php
/*
Plugin Name: Poll, Survey, Quiz & Form by OpinionStage
Plugin URI: http://www.opinionstage.com
Description: Add a highly engaging poll, survey, quiz or form to your site. Easily add a poll, survey, quiz or form to any post/page or to your site sidebar.
Version: 17.6.0
Author: OpinionStage.com
Author URI: http://www.opinionstage.com
Text Domain: social-polls-by-opinionstage
*/

/* --- Static initializer for Wordpress hooks --- */

define('OPINIONSTAGE_SERVER_BASE', "www.opinionstage.com"); /* Don't include the protocol, added dynamically */
define('OPINIONSTAGE_WIDGET_VERSION', '17.6.0');
define('OPINIONSTAGE_WIDGET_PLUGIN_NAME', 'Poll, Survey, Quiz & Form by OpinionStage');
define('OPINIONSTAGE_WIDGET_API_KEY', 'wp35e8');
define('OPINIONSTAGE_OPTIONS_KEY', 'opinionstage_widget');
define('OPINIONSTAGE_POLL_SHORTCODE', 'socialpoll');
define('OPINIONSTAGE_WIDGET_SHORTCODE', 'os-widget');
define('OPINIONSTAGE_FEED_SHORTCODE', 'os-section');
define('OPINIONSTAGE_PLACEMENT_SHORTCODE', 'osplacement');
define('OPINIONSTAGE_WIDGET_UNIQUE_ID', 'social-polls-by-opinionstage');
define('OPINIONSTAGE_WIDGET_UNIQUE_LOCATION', __FILE__);
define('OPINIONSTAGE_WIDGET_MENU_NAME', 'Poll, Survey, Quiz & Form');
define('OPINIONSTAGE_LOGIN_PATH', OPINIONSTAGE_SERVER_BASE."/integrations/wordpress/new");
define('OPINIONSTAGE_API_PATH', OPINIONSTAGE_SERVER_BASE."/api/v1"); 

require_once(WP_PLUGIN_DIR."/".OPINIONSTAGE_WIDGET_UNIQUE_ID."/opinionstage-utility-functions.php");
require_once(WP_PLUGIN_DIR."/".OPINIONSTAGE_WIDGET_UNIQUE_ID."/opinionstage-functions.php");
require_once(WP_PLUGIN_DIR."/".OPINIONSTAGE_WIDGET_UNIQUE_ID."/opinionstage-ajax-functions.php");
require_once(WP_PLUGIN_DIR."/".OPINIONSTAGE_WIDGET_UNIQUE_ID."/opinionstage-article-placement-functions.php");
require_once(WP_PLUGIN_DIR."/".OPINIONSTAGE_WIDGET_UNIQUE_ID."/opinionstage-widget.php");

/* --- Static initializer for Wordpress hooks --- */

// Check if OpinionStage plugin already installed.
if (opinionstage_check_plugin_available('opinionstage_popup')) {
	add_action('admin_notices', 'opinionstage_other_plugin_installed_warning');
} else {
	add_shortcode(OPINIONSTAGE_POLL_SHORTCODE, 'opinionstage_add_poll_or_set');
	add_shortcode(OPINIONSTAGE_WIDGET_SHORTCODE, 'opinionstage_add_widget');
	add_shortcode(OPINIONSTAGE_FEED_SHORTCODE, 'opinionstage_add_feed');
	add_shortcode(OPINIONSTAGE_PLACEMENT_SHORTCODE, 'opinionstage_add_placement');

	add_action('plugins_loaded', 'opinionstage_init');

	// Side menu
	add_action('admin_menu', 'opinionstage_poll_menu');
	add_action('admin_enqueue_scripts', 'opinionstage_load_scripts');

	// Add fly-out to header
	add_action('wp_head', 'opinionstage_add_flyout');
}
?>