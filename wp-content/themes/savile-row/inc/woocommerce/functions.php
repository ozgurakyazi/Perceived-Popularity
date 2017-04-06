<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package savilerow
 */
if(! function_exists( 'savilerow_wc_products_per_page' ) ){

	function savilerow_wc_products_per_page() {
		global $wp_rewrite;     // Added $wp_rewrite
		// global $sidebar_position;

		$number = 9;

		$protocol = is_ssl() ? 'https://' : 'http://';
		$host = $_SERVER["HTTP_HOST"];
		$request_uri = $_SERVER["REQUEST_URI"];
		$query_string = $_SERVER["QUERY_STRING"];

		$pagination_base = $wp_rewrite->pagination_base;            // Get pagination slug
		$paged = get_query_var( 'paged', 1 );                       // Get current page number (0 if on 1st page)
		$needle = '';

		$current_per_page = $number;                                    // Start with default products per page
		if(isset($_GET['products_per_page'])) {
			$current_per_page = absint($_GET['products_per_page']);     // Adjust if needed
		}

		if(absint($paged)>0) {
			$needle = $pagination_base . "/" . $paged;              // Construct the string we're searching for
			$request_uri = str_replace($needle, '', $request_uri);  // Remove the pagination stuff
			$request_uri = str_replace('//', '/', $request_uri);    // Make sure we do not leave double slashes in uri
		}

		$url = '';
		$after_url = '';
		if (empty($query_string)) {
			$url = $protocol . $host . $request_uri . '?products_per_page=';
		} elseif (strpos($query_string, 'products_per_page') === false) {
			$url = $protocol . $host . $request_uri . '&products_per_page=';
		} else {
			$parts = explode('products_per_page=' . $_GET['products_per_page'], $request_uri);

			$url = $protocol . $host . $parts[0] . 'products_per_page=';
			$after_url = $parts[1];
		}

		// Show or hide certain choices
		$url = esc_url($url);
		$number = intval( $number );
		$after_url = esc_attr( $after_url );
		$double = $number * 2;
		$quadruple = $number * 4;
		echo '<p class="savilerow-products-per-page">';
		echo'<span>' . __('View', 'savile-row') . ': </span>';
		if($current_per_page != $number)
			echo '<a href="' . $url . $number . $after_url . '">' . $number . '</a> / ';
		if($current_per_page != $double)
			echo '<a href="' . $url . $double . $after_url . '">' . $double . '</a> / ';
		if($current_per_page != $quadruple)
			echo '<a href="' . $url . $quadruple . $after_url . '">' . $quadruple . '</a> / ';
		echo '<a href="' . $url . 'all' . $after_url . '">' . __('All', 'savile-row') . '</a>';
		echo '</p>';
	}


}

if(! function_exists( 'savilerow_wc_second_product_image' ) ){
	function savilerow_wc_second_product_image() {
		// global $product, $mpcth_options;
		global $product;

		// Check for second image
		$product_gallery = $product->get_gallery_attachment_ids();

		// $disable_hover_slide = get_field('mpc_disable_hover_slide');
		// $custom_hover_image = get_field('mpc_custom_hover_image');
		$display_second_image = false;
		$extraClassName = "";

		if (! empty($product_gallery))
			$display_second_image = true;

		if ( $display_second_image ) {

				$thumbs = $product->get_gallery_attachment_ids();

				if (! empty($thumbs)) {
					$attr = array('class' => "attachment-shop_catalog savilerow-second-thumbnail");

					echo wp_get_attachment_image($thumbs[0], 'shop_catalog', false, $attr);
				}
		}
	}
}

if(! function_exists( 'savilerow_products_per_page' ) ){
	function savilerow_products_per_page() {

		$number = 9;

		if (! empty($_GET['products_per_page']))
			if (is_numeric($_GET['products_per_page']))
				$number = (int)$_GET['products_per_page'];
			elseif ($_GET['products_per_page'] == 'all')
				$number = -1;

		return $number;
	}
}
