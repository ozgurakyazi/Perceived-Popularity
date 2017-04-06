<?php
////////////////////////////////////////////////////////////////////
// Settig Theme-options
////////////////////////////////////////////////////////////////////
include_once( trailingslashit( get_template_directory() ) . 'lib/plugin-activation.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/theme-config.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/metaboxes.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/include-kirki.php' );
require_once( trailingslashit( get_template_directory() ) . 'lib/customize-pro/class-customize.php' );

add_action( 'after_setup_theme', 'alpha_store_setup' );

if ( !function_exists( 'alpha_store_setup' ) ) :

	function alpha_store_setup() {
		// Theme lang
		load_theme_textdomain( 'alpha-store', get_template_directory() . '/languages' );

		// Add Title Tag Support
		add_theme_support( 'title-tag' );

		// Register Menus
		register_nav_menus(
		array(
			'main_menu'	 => __( 'Main Menu', 'alpha-store' ),
			'top_menu'	 => __( 'Top Menu', 'alpha-store' ),
		)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'alpha-store-single', 688, 325, true );
		add_image_size( 'alpha-store-carousel', 270, absint( get_theme_mod( 'carousel-height', 423 ) ), true );
		add_image_size( 'alpha-store-category', 600, 600, true );
		add_image_size( 'alpha-store-widget', 60, 60, true );

		// Add Custom logo Support
		add_theme_support( 'custom-logo', array(
			'height'		 => 100,
			'width'			 => 400,
			'flex-height'	 => true,
			'flex-width'	 => true,
		) );

		// Add Custom Background Support
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );
	}

endif;

////////////////////////////////////////////////////////////////////
// Display a admin notices
////////////////////////////////////////////////////////////////////
add_action( 'admin_notices', 'alpha_store_admin_notice' );

function alpha_store_admin_notice() {
	global $current_user;
	$user_id = $current_user->ID;
	/* Check that the user hasn't already clicked to ignore the message */
	if ( !get_user_meta( $user_id, 'alpha_store_ignore_notice' ) ) {
		echo '<div class="updated notice-info point-notice" style="position:relative;"><p>';
		printf( __( 'Like Alpha Store theme? You will <strong>LOVE Alpha Store PRO</strong>! ', 'alpha-store' ) . '<a href="' . esc_url( 'http://themes4wp.com/product/alpha-store-pro/' ) . '" target="_blank">' . __( 'Click here for all the exciting features.', 'alpha-store' ) . '</a><a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?alpha_store_notice_ignore=0' );
		echo "</p></div>";
	}
}

add_action( 'admin_init', 'alpha_store_notice_ignore' );

function alpha_store_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET[ 'alpha_store_notice_ignore' ] ) && '0' == $_GET[ 'alpha_store_notice_ignore' ] ) {
		add_user_meta( $user_id, 'alpha_store_ignore_notice', 'true', true );
	}
}

////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
function alpha_store_theme_stylesheets() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.4', 'all' );
	wp_enqueue_style( 'alpha-store-stylesheet', get_stylesheet_uri(), array(), '1.2.7', 'all' );
	// load Font Awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '2.6.3' );
}

add_action( 'wp_enqueue_scripts', 'alpha_store_theme_stylesheets' );

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
function alpha_store_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.3.4' );
	wp_enqueue_script( 'alpha-store-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.0.2' );
	wp_localize_script( 'alpha-store-theme-js', 'objectL10n', array(
		'compare'	 => esc_html__( 'Compare Product', 'alpha-store' ),
		'qview'		 => esc_html__( 'Quick View', 'alpha-store' ),
	) );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.6.3' );
}

add_action( 'wp_enqueue_scripts', 'alpha_store_theme_js' );

////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

require_once(trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php');

////////////////////////////////////////////////////////////////////
// Register Widgets
////////////////////////////////////////////////////////////////////

add_action( 'widgets_init', 'alpha_store_widgets_init' );

function alpha_store_widgets_init() {
	register_sidebar(
	array(
		'name'			 => __( 'Right Sidebar', 'alpha-store' ),
		'id'			 => 'alpha-store-right-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Left Sidebar', 'alpha-store' ),
		'id'			 => 'alpha-store-left-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
	register_sidebar(
	array(
		'name'			 => __( 'Homepage Sidebar', 'alpha-store' ),
		'id'			 => 'alpha-store-home-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
	register_sidebar(
	array(
		'name'			 => __( 'Footer Section', 'alpha-store' ),
		'id'			 => 'alpha-store-footer-area',
		'description'	 => __( 'Content Footer Section', 'alpha-store' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-' . absint( get_theme_mod( 'footer-sidebar-size', 3 ) ) . '">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
}

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'alpha_store_main_content_width_hook', 'alpha_store_main_content_width_columns' );

function alpha_store_main_content_width_columns() {

	$columns = '12';

	if ( get_theme_mod( 'rigth-sidebar-check', 1 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'right-sidebar-size', 3 ) );
	}

	if ( get_theme_mod( 'left-sidebar-check', 0 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'left-sidebar-size', 3 ) );
	}

	echo $columns;
}

function alpha_store_main_content_width() {
	do_action( 'alpha_store_main_content_width_hook' );
}

////////////////////////////////////////////////////////////////////
// Theme Info page
////////////////////////////////////////////////////////////////////

if ( is_admin() && !is_child_theme() ) {
	require_once( trailingslashit( get_template_directory() ) . 'lib/welcome/welcome-screen.php' );
}

////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

function alpha_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alpha_store_content_width', 800 );
}
add_action( 'after_setup_theme', 'alpha_store_content_width', 0 );

////////////////////////////////////////////////////////////////////
// Schema.org microdata
////////////////////////////////////////////////////////////////////
function alpha_store_tag_schema() {
	$schema = 'http://schema.org/';

	// Is single post

	if ( is_single() ) {
		$type = 'WebPage';
	}
	// Is author page
	elseif ( is_author() ) {
		$type = 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope itemtype="' . $schema . $type . '"';
}

if ( !function_exists( 'alpha_store_breadcrumb' ) ) :

////////////////////////////////////////////////////////////////////
// Breadcrumbs
////////////////////////////////////////////////////////////////////
	function alpha_store_breadcrumb() {
		global $post, $wp_query;

		// schema link

		$schema_link = 'http://data-vocabulary.org/Breadcrumb';
		$home		 = esc_html__( 'Home', 'alpha-store' );
		$delimiter	 = ' &raquo; ';
		$homeLink	 = home_url();
		if ( is_home() || is_front_page() ) {

			// no need for breadcrumbs in homepage
		} else {
			echo '<div id="breadcrumbs" >';
			echo '<div class="breadcrumbs-inner text-right">';

			// main breadcrumbs lead to homepage

			echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $homeLink ) . '">' . '<i class="fa fa-home"></i><span itemprop="title">' . $home . '</span>' . '</a></span>' . $delimiter . ' ';

			// if blog page exists

			if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . '<span itemprop="title">' . esc_html__( 'Blog', 'alpha-store' ) . '</span></a></span>' . $delimiter . ' ';
			}

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$category_link = get_category_link( $thisCat->parent );
					echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . get_cat_name( $thisCat->parent ) . '</span>' . '</a></span>' . $delimiter . ' ';
				}

				$category_id	 = get_cat_ID( single_cat_title( '', false ) );
				$category_link	 = get_category_link( $category_id );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type	 = get_post_type_object( get_post_type() );
					$link		 = get_post_type_archive_link( get_post_type() );
					if ( $link ) {
						printf( '<span><a href="%s">%s</a></span>', esc_url( $link ), $post_type->labels->name );
						echo ' ' . $delimiter . ' ';
					}
					echo get_the_title();
				} else {
					$category = get_the_category();
					if ( $category ) {
						foreach ( $category as $cat ) {
							echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . '<span itemprop="title">' . $cat->name . '</span>' . '</a></span>' . $delimiter . ' ';
						}
					}

					echo get_the_title();
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $post_type->labels->singular_name;
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $parent ) ) . '">' . '<span itemprop="title">' . $parent->post_title . '</span>' . '</a></span>';
				echo ' ' . $delimiter . ' ' . get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . get_the_title() . '</span>' . '</a></span>';
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id	 = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page			 = get_page( $parent_id );
					$breadcrumbs[]	 = '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $page->ID ) ) . '">' . '<span itemprop="title">' . get_the_title( $page->ID ) . '</span>' . '</a></span>';
					$parent_id		 = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[ $i ];
					if ( $i != count( $breadcrumbs ) - 1 )
						echo ' ' . $delimiter . ' ';
				}

				echo $delimiter . '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . the_title_attribute( 'echo=0' ) . '</span>' . '</a></span>';
			}
			elseif ( is_tag() ) {
				$tag_id = get_term_by( 'name', single_cat_title( '', false ), 'post_tag' );
				if ( $tag_id ) {
					$tag_link = get_tag_link( $tag_id->term_id );
				}

				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $tag_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_author_posts_url( $userdata->ID ) ) . '">' . '<span itemprop="title">' . $userdata->display_name . '</span>' . '</a></span>';
			} elseif ( is_404() ) {
				echo esc_html__( 'Error 404', 'alpha-store' );
			} elseif ( is_search() ) {
				echo esc_html__( 'Search results for', 'alpha-store' ) . ' ' . get_search_query();
			} elseif ( is_day() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'd' ) . '</span>' . '</a></span>';
			} elseif ( is_month() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>';
			} elseif ( is_year() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>';
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ' (';
				echo esc_html__( 'Page', 'alpha-store' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ')';
			}

			echo '</div></div>';
		}
	}

endif;
////////////////////////////////////////////////////////////////////
// Social links
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'alpha_store_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function alpha_store_social_links() {
		$twp_social_links	 = array( 
			'twp_social_facebook'	 => 'facebook',
			'twp_social_twitter'	 => 'twitter', 
			'twp_social_google'		 => 'google-plus',
			'twp_social_instagram'	 => 'instagram',
			'twp_social_pin'		 => 'pinterest',
			'twp_social_youtube'	 => 'youtube',
			'twp_social_reddit'		 => 'reddit',
			'twp_social_linkedin'	 => 'linkedin',
			'twp_social_skype'		 => 'skype',
			'twp_social_vimeo'		 => 'vimeo',
			'twp_social_flickr'		 => 'flickr',
			'twp_social_dribble'	 => 'dribbble',
			'twp_social_envelope-o'	 => 'envelope-o',
			'twp_social_rss'		 => 'rss',
		);
		?>
		<div class="social-links">
			<ul>
				<?php
				$i					 = 0;
				$twp_links_output	 = '';
				foreach ( $twp_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( !empty( $link ) ) {
						$twp_links_output .=
						'<li><a href="' . esc_url( $link ) . '" target="_blank"><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}
					$i++;
				}
				echo $twp_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;

////////////////////////////////////////////////////////////////////
// WooCommerce section
////////////////////////////////////////////////////////////////////
if ( class_exists( 'WooCommerce' ) ) {

////////////////////////////////////////////////////////////////////
// WooCommerce header cart
////////////////////////////////////////////////////////////////////
	if ( !function_exists( 'alpha_store_cart_link' ) ) {

		function alpha_store_cart_link() {
			?>	
			<a class="cart-contents text-right" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'alpha-store' ); ?>">
				<i class="fa fa-shopping-cart"><span class="count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span></i><div class="amount-title"><?php echo esc_html_e( 'Cart ', 'alpha-store' ); ?></div><div class="amount-cart"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div> 
			</a>
			<?php
		}

	}
	if ( !function_exists( 'alpha_store_head_wishlist' ) ) {

		function alpha_store_head_wishlist() {
			if ( function_exists( 'YITH_WCWL' ) ) {
				$wishlist_url = YITH_WCWL()->get_wishlist_url();
				?>
				<div class="top-wishlist text-right <?php if ( get_theme_mod( 'cart-top-icon', 1 ) == 0 ) { echo 'single-wishlist'; } ?>">
					<a href="<?php echo esc_url( $wishlist_url ); ?>" title="<?php esc_attr_e( 'Wishlist', 'alpha-store' ); ?>" data-toggle="tooltip" data-placement="top">
						<div class="fa fa-heart"><div class="count"><span><?php echo absint( yith_wcwl_count_products() ); ?></span></div></div>
					</a>
				</div>
				<?php
			}
		}

	}
	// Header wishlist icon ajax update
	add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'alpha_store_head_wishlist' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'alpha_store_head_wishlist' );

	if ( !function_exists( 'alpha_store_header_cart' ) ) {

		function alpha_store_header_cart() {
			?>
			<div class="header-cart text-right col-md-5 text-center-sm text-center-xs no-gutter">
				<div class="header-cart-block">
					<?php if ( get_theme_mod( 'cart-top-icon', 1 ) == 1 ) { ?>
						<div class="header-cart-inner">
							<?php alpha_store_cart_link(); ?>
							<ul class="site-header-cart menu list-unstyled">
								<li>
									<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
								</li>
							</ul>
						</div>
					<?php } ?>
					<?php
					if ( get_theme_mod( 'wishlist-top-icon', 0 ) != 0 ) {
						alpha_store_head_wishlist();
					}
					?>
				</div>
			</div>
			<?php
		}

	}
	// Ensure cart contents update when products are added to the cart via AJAX
	if ( !function_exists( 'alpha_store_header_add_to_cart_fragment' ) ) {
		add_filter( 'woocommerce_add_to_cart_fragments', 'alpha_store_header_add_to_cart_fragment' );

		function alpha_store_header_add_to_cart_fragment( $fragments ) {
			ob_start();

			alpha_store_cart_link();

			$fragments[ 'a.cart-contents' ] = ob_get_clean();

			return $fragments;
		}

	}
////////////////////////////////////////////////////////////////////
// Change number of products displayed per page
////////////////////////////////////////////////////////////////////  
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . absint( get_theme_mod( 'archive_number_products', 24 ) ) . ';' ), 20 );
////////////////////////////////////////////////////////////////////
// Change number of WooCommerce products per row
////////////////////////////////////////////////////////////////////
	add_filter( 'loop_shop_columns', 'alpha_store_loop_columns' );
	if ( !function_exists( 'alpha_store_loop_columns' ) ) {

		function alpha_store_loop_columns() {
			return absint( get_theme_mod( 'archive_number_columns', 4 ) );
		}

	}

////////////////////////////////////////////////////////////////////
// Archive product wishlist button
////////////////////////////////////////////////////////////////////  
	function alpha_store_wishlist_products() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->id );
			$id				 = $product->id;
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
				<div class="yith-wcwl-add-button show" style="display:block" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Add to Wishlist', 'alpha-store' ); ?>"> <a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist"></a><img src="<?php echo get_template_directory_uri() . '/img/loading.gif'; ?>" class="ajax-loading" alt="loading" width="16" height="16"></div>
				<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback"><?php esc_html_e( 'Added!', 'alpha-store' ); ?></span> <a href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'View Wishlist', 'alpha-store' ); ?></a></div>
				<div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback"><?php esc_html_e( 'The product is already in the wishlist!', 'alpha-store' ); ?></span> <a href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Browse Wishlist', 'alpha-store' ); ?></a></div>
				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>
			</div>
			<?php
		}
	}

	add_action( 'woocommerce_after_shop_loop_item', 'alpha_store_wishlist_products', 20 );
	
	function alpha_store_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' &raquo; ',
				'wrap_before' => '<div id="breadcrumbs" ><div class="breadcrumbs-inner text-right">',
				'wrap_after'  => '</div></div>',
				'before'      => '',
				'after'       => '',
				'home'        => esc_html_x( 'Home', 'woocommerce breadcrumb', 'alpha-store' ),
			);
	}
	
	add_filter( 'woocommerce_breadcrumb_defaults', 'alpha_store_woocommerce_breadcrumbs' );
	
	if( !function_exists('alpha_store_my_account_text') ) :
		function alpha_store_my_account_text( $myaccount ){
			
			$user_info = wp_get_current_user();

			if ( !empty($user_info->first_name ) ) {
				$user_first_name = $user_info->first_name;
			} else {
				$user_first_name = $user_info->billing_first_name;
			}

			if ( !empty( $user_info->last_name ) ) {
				$user_last_name = $user_info->last_name;
			} else {
				$user_last_name = $user_info->billing_last_name;
			}
			
			return str_replace(
				array('{first-name}', '{last-name}'),
				array($user_first_name, $user_last_name),
				$myaccount
			);

		}
		endif;
	add_filter( 'alpha_store_my_account', 'alpha_store_my_account_text' );
}

////////////////////////////////////////////////////////////////////
// WooCommerce end
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
// Excerpt functions
////////////////////////////////////////////////////////////////////
function alpha_store_excerpt_length( $length ) {
	return 25;
}

add_filter( 'excerpt_length', 'alpha_store_excerpt_length', 999 );

function alpha_store_excerpt_more( $more ) {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'alpha_store_excerpt_more' );

////////////////////////////////////////////////////////////////////
// Schema publisher function
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'alpha_store_entry_publisher' ) ) {
	function alpha_store_entry_publisher() {
		$image_id = get_theme_mod( 'custom_logo' );
		$img	 = wp_get_attachment_image_src( $image_id, 'full' );
		// Uncomment your choice below.
		$publisher = 'https://schema.org/Organization';
		//$publisher = 'https://schema.org/Person';
		$publisher_name =  get_bloginfo( 'name', 'display' );
		$logo = $img[0]; 
		$logo_width = $img[1]; 
		$logo_height = $img[2]; 
		
		if ( ! isset( $publisher ) || ! isset( $logo ) || ! isset( $publisher_name ) ) {
			return;
		}
		printf( '<div itemprop="publisher" itemscope itemtype="%s">', esc_url( $publisher ) );
			echo '<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
				printf( '<meta itemprop="url" content="%s">', esc_url( $logo ) );
				printf( '<meta itemprop="width" content="%d">', esc_attr( $logo_width ) );
				printf( '<meta itemprop="height" content="%d">', esc_attr( $logo_height ) );
			echo '</div>';
			printf( '<meta itemprop="name" content="%s">', esc_attr( $publisher_name ) );
		echo '</div>';
	}
}