<?php
/**
 * Masonry code for this theme.
 *
 * @package savilerow
 */

if( is_page_template('category-grooming.php') || (get_theme_mod('savilerow_homepage_column') != 'one-col' && ! function_exists('savilerow_masonry_scripts')))
{
    function savilerow_masonry_scripts()
    {
        wp_enqueue_script('masonry');
        wp_enqueue_script('jquery-imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('masonry'), '', false);
        wp_enqueue_script('savilerow-masonry', get_template_directory_uri() . '/js/masonry_init.js', array('masonry', 'jquery-imagesLoaded'), '', true);
    }
    add_action('wp_enqueue_scripts', 'savilerow_masonry_scripts');
}