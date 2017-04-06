<?php
/**
 * Savile Row WooCommerce hooks
 *
 * @package savilerow
 */

 /*
 * HOMEPAGE
 */
add_action( 'homepage', 'savilerow_homepage_content', 		10 );
add_action( 'homepage', 'savilerow_hero_section', 			20 );
add_action( 'homepage', 'savilerow_flexslider_section', 	30 );
add_action( 'homepage', 'savilerow_featured_section', 		40 );
add_action( 'homepage', 'savilerow_promobar_section', 		50 );
add_action( 'homepage', 'savilerow_recent_posts_section', 	60 );
add_action( 'homepage', 'savilerow_partners_section', 		70 );
add_action( 'homepage', 'savilerow_product_categories', 	80 );
add_action( 'homepage', 'savilerow_recent_products',		90 );
add_action( 'homepage', 'savilerow_featured_products',		100 );
add_action( 'homepage', 'savilerow_popular_products',		110 );
add_action( 'homepage', 'savilerow_on_sale_products',		120 );

add_action( 'savilerow_header_cart', 'savilerow_mini_cart', 		10 );

/*
 * Products Page
 */
add_action( 'savilerow_before_shop_loop', 'woocommerce_breadcrumb', 			10 );
add_action( 'savilerow_before_shop_loop', 'woocommerce_result_count', 			20 );
add_action( 'savilerow_before_shop_loop', 'savilerow_wc_products_per_page', 	30 );
add_action( 'savilerow_before_shop_loop', 'woocommerce_catalog_ordering', 		40 );

add_action( 'savilerow_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 	10 );
add_action(	'savilerow_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action(	'savilerow_before_shop_loop_item_title', 'savilerow_wc_second_product_image', 			20 );

add_filter(	'loop_shop_per_page', 'savilerow_products_per_page', 20 );

/*
 * Single Product
 */
add_action(	'savilerow_before_shop_loop_single', 'woocommerce_breadcrumb', 		10 );
