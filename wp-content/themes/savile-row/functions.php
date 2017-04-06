<?php
/**
 * savilerow functions and definitions
 *
 * @package savilerow
 * @since savilerow 0.1
 */

 /**
  * Assign the SavileRow version to a var
  */
 $savile_row_theme 		= wp_get_theme( 'savile-row' );
 $savilerow_version 	= $savile_row_theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since savilerow 0.1
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'savilerow_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since savilerow 0.1
 */
function savilerow_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Include Suggested plugins tool // TGM Activation
	 */
	 require( get_template_directory() . '/inc/class-tgm-plugin-activation.php');

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on savilerow, use a find and replace
	 * to change 'savile-row' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'savile-row', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Adds support for Woocommerce
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu', 'savile-row' ),
		'secondary'	=> __( 'Secondary Menu', 'savile-row'),
		'footer'	=> __( 'Footer Menu', 'savile-row'),
	) );

	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size( 'onefifty', 150, 150, false);
	add_image_size( 'one-three', 100, 300, true);
	add_image_size( 'savile-row-featured', 1140, 380, true );
	add_image_size( 'savile-row-recent', 700, 400, true );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	// Display Title in theme
	add_theme_support( 'title-tag' );

	// link a custom stylesheet file to the TinyMCE visual editor
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans' );
	add_editor_style( array('style.css', 'css/editor-style.css', $font_url) );

}
endif; // savilerow_setup
add_action( 'after_setup_theme', 'savilerow_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since savilerow 0.1
 */
function savilerow_register_custom_background() {

	$args = array(
		'default-color' => 'EEE',
	);

	$args = apply_filters( 'savilerow_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}

}
add_action( 'after_setup_theme', 'savilerow_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since savilerow 0.1
 */
function savilerow_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'savile-row' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'WooCommerce Sidebar', 'savile-row' ),
		'id'            => 'woocommerce',
    'description'   => __('Will be shown on Woocommerce pages', 'savile-row'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar(array(
		'name'          => __( 'Footer', 'savile-row' ),
		'id'            => 'footer',
		'description'   => __('Widget area for column one in the footer', 'savile-row'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

}
add_action( 'widgets_init', 'savilerow_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function savilerow_scripts() {


  wp_enqueue_style( 'google-base-fonts', '//fonts.googleapis.com/css?family=Oswald:400,300|Oxygen', '', '', 'all' );

	wp_enqueue_style( 'style', get_stylesheet_uri(), '', false, 'all' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '', '3.3.5');

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', '4.3.0');

	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.min.css', '', '1.0');

    wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider.css', '', '2.0');



	wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', '', '0.7.0', true);

	wp_enqueue_script( 'jquery-small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '1.0', false );

	wp_enqueue_script( 'jquery-customSelect', get_template_directory_uri() . '/js/jquery.customSelect.min.js', array( 'jquery' ), '0.5.1', true);

	wp_enqueue_script( 'jquery-inview', get_template_directory_uri() . '/js/Inview.js', array('jquery'), '1.0', true);

	wp_enqueue_script( 'jquery-animate-js', get_template_directory_uri() . '/js/animate.js', array('jquery-inview'), '1.0', true);

	wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);

	wp_enqueue_script('jquery-flexslider-init', get_template_directory_uri().'/js/flexslider-init.js', array('jquery-flexslider'), '1.0', true);

	wp_enqueue_script( 'savilerow-script', get_template_directory_uri() . '/js/savilerow.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

	if ( is_singular() && wp_attachment_is_image() ) {

		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '0.2' );

	}

}
add_action( 'wp_enqueue_scripts', 'savilerow_scripts' );


// Masonry
include get_template_directory() . '/inc/masonry.php';

/**
 * Implement excerpt for homepage slider
 */
function get_slider_excerpt(){

	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 150);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;

}

function savilerow_excerpt_more( $more ) {
	return ' <p class="more-link"><a class="mybutton" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'savile-row' ) . '</a></p>';
}
add_filter( 'excerpt_more', 'savilerow_excerpt_more' );


// Theme Options
include( 'functions/customizer_controller.php' );
include( 'functions/customizer_settings.php' );
include( 'functions/customizer_styles.php' );


/**
 * Implement excerpt for homepage thumbnails
 */
function content( $limit ) {

  $content = explode( ' ', get_the_content(), $limit );

  if ( count($content)>=$limit ) {

    array_pop($content);

    $content = implode( " ",$content ).'...';

  } else {

    $content = implode( " ",$content );
  }

  $content = preg_replace( '/\[.+\]/','', $content );
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );

  return $content;

}

/**
 * Breadcrumbs
 *
 * This functions displays page breadcrumbs
 */
function savilerow_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = __('Home','savile-row'); // text for the 'Home' link
	$text['category'] = __('Archive by Category "%s"','savile-row'); // text for a category page
	$text['search']   = __('Search Results for "%s" Query','savile-row'); // text for a search results page
	$text['tag']      = __('Posts Tagged "%s"','savile-row'); // text for a tag page
	$text['author']   = __('Articles Posted by %s','savile-row'); // text for an author page
	$text['404']      = __('Error 404','savile-row'); // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' <span class="seperator">/</span> '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page', 'savile-row') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} // end savilerow_breadcrumbs()


/**
 * Custom "more" link format
 */

function modify_read_more_link() {
	return '<p class="more-link"><a href="' . get_permalink() . '" class="mybutton">Read More</a></p>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


require get_template_directory() . '/inc/admin/custom-header.php';

require get_template_directory() . '/inc/extras.php';


if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}

/**
 * /////////// WooCommerce /////////////////////
 */

/*  Query WooCommerce activation */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/*  Get woocommerce custom theme code */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';

  function savilerow_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'savile-row'); ?>">
      <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'savile-row'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
      <i class="fa fa-shopping-cart"></i>
    </a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;

  }
  add_filter('add_to_cart_fragments', 'savilerow_header_add_to_cart_fragment');

}

/*  Get woocommerce custom theme code */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
}

/**
 * Pro Link
 */
 function savilerow_get_pro_link( $content ) {
	return esc_url( 'http://www.templateexpress.com/savilerow-pro-theme' );
}


/**
 * This function ties into the TGM Plugin Activation Class and recommends plugins to the user.
 */
add_action( 'tgmpa_register', 'savilerow_tgmpa_register' );

function savilerow_tgmpa_register() {
	$plugins = array(

		array(
			'name'      			=> 'WooCommerce',
			'slug'      			=> 'woocommerce',
			'required'  			=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/woocommerce/'
		),
		array(
			'name' 					=> 'Homepage Control',
			'slug'					=> 'homepage-control',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> 'https://wordpress.org/plugins/homepage-control/'
		)

	);

	$plugins = apply_filters( 'savilerow_tgmpa_plugins', $plugins );

	tgmpa( $plugins );
}

/**
 * Define WooCommerce image sizes
 */
function savilerow_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
  $catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '350',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
}
add_action( 'after_switch_theme', 'savilerow_woocommerce_image_dimensions', 1 );
