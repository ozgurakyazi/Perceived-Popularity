<?php
/**
 * Sabino functions and definitions
 *
 * @package Sabino
 */

define( 'SABINO_THEME_VERSION' , '1.1.00' );

// Get help / Premium Page
require get_template_directory() . '/upgrade/upgrade.php';

// Load WP included scripts
require get_template_directory() . '/includes/inc/template-tags.php';
require get_template_directory() . '/includes/inc/extras.php';
require get_template_directory() . '/includes/inc/jetpack.php';

// Load Customizer Library scripts
require get_template_directory() . '/customizer/customizer-options.php';
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';
require get_template_directory() . '/customizer/styles.php';
require get_template_directory() . '/customizer/mods.php';

// Load TGM plugin class
require_once get_template_directory() . '/includes/inc/class-tgm-plugin-activation.php';
// Add customizer Upgrade class
require_once( get_template_directory() . '/includes/sabino-pro/class-customize.php' );

if ( ! function_exists( 'sabino_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sabino_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sabino, use a find and replace
	 * to change 'sabino' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sabino', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary Menu', 'sabino' ),
		'secondary-menu' => esc_html__( 'Header Secondary Menu', 'sabino' ),
        'footer-bar' => esc_html__( 'Footer Bar Menu', 'sabino' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	
	// The custom logo is used for the logo
	add_theme_support( 'custom-logo', array(
		'height'      => 280,
		'width'       => 145,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sabino_custom_background_args', array(
		'default-color'      => 'F9F9F9',
		'default-image'      => get_template_directory_uri() . '/images/demo/sabino-background-image.jpg',
		'default-size'       => 'cover',
		'default-attachment' => 'fixed'
	) ) );
	
	add_theme_support( 'woocommerce' );
}
endif; // sabino_setup
add_action( 'after_setup_theme', 'sabino_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sabino_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sabino' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar(array(
		'name' => __( 'Sabino Footer Standard', 'sabino' ),
		'id' => 'sabino-site-footer-standard',
        'description' => __( 'The footer will divide into however many widgets are placed here.', 'sabino' )
	));
}
add_action( 'widgets_init', 'sabino_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sabino_scripts() {
	wp_enqueue_style( 'sabino-font-default', '//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800|Open+Sans:300,300i,400,400i,600,600i,700,700i', array(), SABINO_THEME_VERSION );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/includes/font-awesome/css/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'sabino-style', get_stylesheet_uri(), array(), SABINO_THEME_VERSION );
	
	if ( sabino_is_woocommerce_activated() ) :
		wp_enqueue_style( 'sabino-woocommerce-style', get_template_directory_uri().'/templates/css/woocommerce.css', array(), SABINO_THEME_VERSION );
	endif;
	
	wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", array('jquery'), SABINO_THEME_VERSION, true );
	wp_enqueue_script( 'sabino-custom-js', get_template_directory_uri() . "/js/custom.js", array('jquery'), SABINO_THEME_VERSION, true );
	
	wp_enqueue_script( 'sabino-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), SABINO_THEME_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sabino_scripts' );

/**
 * Add pingback to header
 */
function sabino_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'sabino_pingback_header' );

/**
 * To maintain backwards compatibility with older versions of WordPress
 */
function sabino_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * Add theme stying to the theme content editor
 */
function sabino_add_editor_styles() {
    add_editor_style( 'style-theme-editor.css' );
}
add_action( 'admin_init', 'sabino_add_editor_styles' );

/**
 * Enqueue admin styling.
 */
function sabino_load_admin_script() {
    wp_enqueue_style( 'sabino-admin-css', get_template_directory_uri() . '/upgrade/css/admin-css.css' );
}
add_action( 'admin_enqueue_scripts', 'sabino_load_admin_script' );

/**
 * Enqueue sabino custom customizer styling.
 */
function sabino_load_customizer_script() {
	wp_enqueue_script( 'sabino-customizer-js', get_template_directory_uri() . '/customizer/customizer-library/js/customizer-custom.js', array('jquery'), SABINO_THEME_VERSION, true );
    wp_enqueue_style( 'sabino-customizer-css', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'sabino_load_customizer_script' );

/**
 * Check if WooCommerce exists.
 */
if ( ! function_exists( 'sabino_is_woocommerce_activated' ) ) :
	function sabino_is_woocommerce_activated() {
	    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
endif; // sabino_is_woocommerce_activated

// If WooCommerce exists include ajax cart
if ( sabino_is_woocommerce_activated() ) {
	require get_template_directory() . '/includes/inc/woocommerce-cart.php';
}

/**
 * Add classed to the body tag from settings
 */
function sabino_add_body_class( $classes ) {
	// Blog Pages
	if ( get_theme_mod( 'sabino-blog-leftsidebar' ) ) {
		$classes[] = 'sabino-blog-leftsidebar';
	}
	if ( get_theme_mod( 'sabino-blog-archive-leftsidebar' ) ) {
		$classes[] = 'sabino-blog-archives-leftsidebar';
	}
	if ( get_theme_mod( 'sabino-blog-single-leftsidebar' ) ) {
		$classes[] = 'sabino-blog-single-leftsidebar';
	}
	
	// WooCommerce Pages
	if ( get_theme_mod( 'sabino-woocommerce-shop-leftsidebar' ) ) {
		$classes[] = 'sabino-shop-leftsidebar';
	}
	if ( get_theme_mod( 'sabino-woocommerce-shop-archive-leftsidebar' ) ) {
		$classes[] = 'sabino-shop-archives-leftsidebar';
	}
	if ( get_theme_mod( 'sabino-woocommerce-shop-single-leftsidebar' ) ) {
		$classes[] = 'sabino-shop-single-leftsidebar';
	}
	
	if ( get_theme_mod( 'sabino-woocommerce-shop-fullwidth' ) ) {
		$classes[] = 'sabino-shop-full-width';
	}
	if ( get_theme_mod( 'sabino-woocommerce-shop-archive-fullwidth' ) ) {
		$classes[] = 'sabino-shop-archives-full-width';
	}
	if ( get_theme_mod( 'sabino-woocommerce-shop-single-fullwidth' ) ) {
		$classes[] = 'sabino-shop-single-full-width';
	}
	
	return $classes;
}
add_filter( 'body_class', 'sabino_add_body_class' );

/**
 * If set, add inline style for page featured image
 */
function sabino_page_featured_image_inline_css() {
	wp_enqueue_style( 'sabino-style', get_stylesheet_uri() );
	
    $sabino_page_featured_image = '';
    
    if ( is_home() || is_archive() || is_search() || is_single() ) {
	    if ( sabino_is_woocommerce_activated() ) {
	        if ( is_woocommerce() ) {
	            $shop = get_option( 'woocommerce_shop_page_id' );
	            $sabino_page_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $shop ) );
	        } else {
	        	$page = get_option( 'page_for_posts' );
	        	$sabino_page_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $page ) );
	        }
	    } else {
	        $page = get_option( 'page_for_posts' );
	        $sabino_page_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $page ) );
	    }
	} elseif ( is_page() ) {
	    $page = get_queried_object();
		$sabino_page_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $page->ID ) );
	} else {
		$page_id = get_the_ID();
		$sabino_page_featured_image = wp_get_attachment_url( get_post_thumbnail_id( $page_id ) );
	}
    
    if ( $sabino_page_featured_image ) {
    	$sabino_page_featured_img = htmlspecialchars_decode( 'body { background-image: url(' . $sabino_page_featured_image . ') !important; }' );
    	wp_add_inline_style( 'sabino-style', $sabino_page_featured_img );
    }
}
add_action( 'wp_enqueue_scripts', 'sabino_page_featured_image_inline_css' );

/**
 * Add classes to the blog list for styling.
 */
function sabino_add_post_classes ( $classes ) {
	global $current_class;
	
	if ( is_home() || is_archive() || is_search() ) :
		$sabino_blog_layout = 'blog-left-layout';
		if ( get_theme_mod( 'sabino-set-blog-layout' ) ) {
		    $sabino_blog_layout = get_theme_mod( 'sabino-set-blog-layout' );
		}
		$classes[] = $sabino_blog_layout;
		
		$classes[] = $current_class;
		$current_class = ( $current_class == 'blog-alt-odd' ) ? sanitize_html_class( 'blog-alt-even' ) : sanitize_html_class( 'blog-alt-odd' );
	endif;
	
	return $classes;
}
global $current_class;
$current_class = sanitize_html_class( 'blog-alt-odd' );
add_filter ( 'post_class' , 'sabino_add_post_classes' );

/**
 * Adjust is_home query if sabino-blog-cats is set
 */
function sabino_set_blog_queries( $query ) {
    $blog_query_set = '';
    if ( get_theme_mod( 'sabino-blog-cats' ) ) {
        $blog_query_set = get_theme_mod( 'sabino-blog-cats' );
    }
    
    if ( $blog_query_set ) {
        // do not alter the query on wp-admin pages and only alter it if it's the main query
        if ( !is_admin() && $query->is_main_query() ){
            if ( is_home() ){
                $query->set( 'cat', $blog_query_set );
            }
        }
    }
}
add_action( 'pre_get_posts', 'sabino_set_blog_queries' );

/**
 * Display recommended plugins with the TGM class
 */
function sabino_register_required_plugins() {
	$plugins = array(
		// The recommended WordPress.org plugins.
		array(
			'name'      => __( 'Page Builder', 'sabino' ),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __( 'WooCommerce', 'sabino' ),
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => __( 'Widgets Bundle', 'sabino' ),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __( 'Contact Form 7', 'sabino' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => __( 'Breadcrumb NavXT', 'sabino' ),
			'slug'      => 'breadcrumb-navxt',
			'required'  => false,
		),
		array(
			'name'      => __( 'Meta Slider', 'sabino' ),
			'slug'      => 'ml-slider',
			'required'  => false,
		)
	);
	$config = array(
		'id'           => 'sabino',
		'menu'         => 'tgmpa-install-plugins',
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'sabino_register_required_plugins' );

/**
 * Register a custom Post Categories ID column
 */
function sabino_edit_cat_columns( $sabino_cat_columns ) {
    $sabino_cat_in = array( 'cat_id' => 'Category ID <span class="cat_id_note">For the Default Slider</span>' );
    $sabino_cat_columns = sabino_cat_columns_array_push_after( $sabino_cat_columns, $sabino_cat_in, 0 );
    return $sabino_cat_columns;
}
add_filter( 'manage_edit-category_columns', 'sabino_edit_cat_columns' );

/**
 * Print the ID column
 */
function sabino_cat_custom_columns( $value, $name, $cat_id ) {
    if( 'cat_id' == $name ) 
        echo $cat_id;
}
add_filter( 'manage_category_custom_column', 'sabino_cat_custom_columns', 10, 3 );

/**
 * Insert an element at the beggining of the array
 */
function sabino_cat_columns_array_push_after( $src, $sabino_cat_in, $pos ) {
    if ( is_int( $pos ) ) {
        $R = array_merge( array_slice( $src, 0, $pos + 1 ), $sabino_cat_in, array_slice( $src, $pos + 1 ) );
    } else {
        foreach ( $src as $k => $v ) {
            $R[$k] = $v;
            if ( $k == $pos )
                $R = array_merge( $R, $sabino_cat_in );
        }
    }
    return $R;
}
