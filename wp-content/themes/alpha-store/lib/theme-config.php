<?php

/**
 * Kirki Advanced Customizer
 * 
 * @package alpha-store
 */
// Early exit if Kirki is not installed.
if ( !class_exists( 'Kirki' ) ) {
	return;
}
load_theme_textdomain( 'alpha-store', get_template_directory().'/languages' );

/* Register Kirki config */
Kirki::add_config( 'alpha_store_settings', array(
	'capability'	 => 'edit_theme_options',
	'option_type'	 => 'theme_mod',
) );

/**
 * Add sections
 */
if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' && !is_child_theme() ) {
	Kirki::add_section( 'alpha_store_woo_demo_section', array(
		'title'		 => __( 'WooCommerce Homepage Demo', 'alpha-store' ),
		'priority'	 => 10,
	) );
}

Kirki::add_section( 'alpha_store_layout_section', array(
	'title'			 => __( 'Main styling', 'alpha-store' ),
	'priority'		 => 10,
) );

Kirki::add_section( 'alpha_store_sidebar_section', array(
	'title'			 => __( 'Sidebars', 'alpha-store' ),
	'priority'		 => 10,
	'description'	 => __( 'Sidebar layouts.', 'alpha-store' ),
) );

Kirki::add_section( 'alpha_store_top_bar_section', array(
	'title'		 => __( 'Top Bar', 'alpha-store' ),
	'priority'	 => 10,
) );

Kirki::add_section( 'alpha_store_search_bar_section', array(
	'title'			 => __( 'Search Bar', 'alpha-store' ),
	'priority'		 => 10,
) );

if ( class_exists( 'WooCommerce' ) ) {
	Kirki::add_section( 'alpha_store_woo_section', array(
		'title'		 => __( 'WooCommerce', 'alpha-store' ),
		'priority'	 => 10,
	) );
}

Kirki::add_section( 'alpha_store_links_section', array(
	'title'		 => __( 'Theme Important Links', 'alpha-store' ),
	'priority'	 => 190,
) );

/**
 * Add fields
 */
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'demo_front_page',
	'label'			 => __( 'Enable Demo Homepage?', 'alpha-store' ),
	'description'	 => sprintf( __( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage - Check the %s page for more informations.', 'alpha-store' ), '<a href="' . esc_url( admin_url( 'themes.php?page=alpha-store-welcome' ) ) . '"><strong>' . __( 'Theme info', 'alpha-store' ) . '</strong></a>' ),
	'section'		 => 'alpha_store_woo_demo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'radio-buttonset',
	'settings'			 => 'front_page_demo_style',
	'label'				 => esc_html__( 'Homepage Demo Styles', 'alpha-store' ),
	'description'		 => sprintf( __( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own %s.', 'alpha-store' ), '<a href="' . esc_url( admin_url( 'themes.php?page=alpha-store-welcome' ) ) . '"><strong>' . __( 'custom homepage template', 'alpha-store' ) . '</strong></a>' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'default'			 => 'style-one',
	'priority'			 => 10,
	'choices'			 => array(
		'style-one'	 => __( 'Layout one', 'alpha-store' ),
		'style-two'	 => __( 'Layout two', 'alpha-store' ),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'switch',
	'settings'			 => 'front_page_demo_carousel',
	'label'				 => __( 'Homepage Carousel', 'alpha-store' ),
	'description'		 => esc_html__( 'Enable or disable demo homepage carousel with random products.', 'alpha-store' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'default'			 => 1,
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro_widgets',
	'label'				 => __( 'Homepage Widgets', 'alpha-store' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'description'		 => esc_html__( 'You can set your own widgets. Go to Appearance - Widgets and drag and drop your widgets to "Homepage Sidebar" area.', 'alpha-store' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro',
	'label'				 => __( 'Products', 'alpha-store' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'alpha-store' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_dummy_content',
	'label'				 => __( 'Need Dummy Products?', 'alpha-store' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'description'		 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'alpha-store' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'alpha-store' ) . '</strong></a>' ),
	'priority'			 => 10,
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_pro_features',
	'label'				 => __( 'Need More Features?', 'alpha-store' ),
	'section'			 => 'alpha_store_woo_demo_section',
	'description'		 => '<a href="' . esc_url( 'http://themes4wp.com/product/alpha-store-pro/' ) . '" target="_blank" class="button button-primary">' . sprintf( esc_html__( 'Learn more about %s PRO', 'alpha-store' ), 'Alpha Store' ) . '</a>',
	'priority'			 => 10,
) );

Kirki::add_field( 'alpha_store_settings', array(
	'type'        => 'slider',
	'settings'    => 'carousel-height',
	'label'       => esc_attr__( 'Homepage carousel maximum height of images', 'alpha-store' ),
	'description' => esc_attr__( 'After changing this setting you may need to regenerate your thumbnails.', 'alpha-store' ),
	'section'     => 'alpha_store_layout_section',
	'default'     => 423,
	'choices'     => array(
		'min'  => 150,
		'max'  => 600,
		'step' => 1,
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'        => 'spacing',
	'settings'    => 'logo-spacing',
	'label'       => __( 'Logo Spacing', 'alpha-store' ),
	'section'     => 'alpha_store_layout_section',
	'default'     => array(
		'top'    => '20px',
		'bottom' => '10px',
		'left'   => '0px',
		'right'  => '0px',
	),
	'priority'    => 10,
	'output'	 => array(
		array(
			'element'	 => '.custom-logo-link img',
			'property'	 => 'margin',
		),
	),
) );

Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'rigth-sidebar-check',
	'label'			 => __( 'Right Sidebar', 'alpha-store' ),
	'description'	 => __( 'Enable the Right Sidebar', 'alpha-store' ),
	'section'		 => 'alpha_store_sidebar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );

Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'right-sidebar-size',
	'label'		 => __( 'Right Sidebar Size', 'alpha-store' ),
	'section'	 => 'alpha_store_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );

Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'left-sidebar-check',
	'label'			 => __( 'Left Sidebar', 'alpha-store' ),
	'description'	 => __( 'Enable the Left Sidebar', 'alpha-store' ),
	'section'		 => 'alpha_store_sidebar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );

Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'left-sidebar-size',
	'label'		 => __( 'Left Sidebar Size', 'alpha-store' ),
	'section'	 => 'alpha_store_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'footer-sidebar-size',
	'label'		 => __( 'Footer Widget Area Columns', 'alpha-store' ),
	'section'	 => 'alpha_store_sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'12' => '1',
		'6'	 => '2',
		'4'	 => '3',
		'3'	 => '4',
	),
) );


Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'alpha_store_account',
	'label'			 => __( 'My Account/Login', 'alpha-store' ),
	'description'	 => __( 'Enable or Disable My Account/Login link', 'alpha-store' ),
	'section'		 => 'alpha_store_top_bar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'text',
	'settings'		 => 'alpha_store_my_account_custom_text',
	'label'			 => __( 'My Account text', 'alpha-store' ),
	'description'	 => __( 'Set your custom text for logged in users or leave blank to display default. {first-name} and {last-name} will be replaced with customer first name and last name.', 'alpha-store' ),
	'section'		 => 'alpha_store_top_bar_section',
	'default'		 => '',
	'priority'		 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'alpha_store_account',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'text',
	'settings'		 => 'alpha_store_login_custom_text',
	'label'			 => __( 'Login text', 'alpha-store' ),
	'description'	 => __( 'Set your custom text for login / register link. Leave blank to display default.', 'alpha-store' ),
	'section'		 => 'alpha_store_top_bar_section',
	'default'		 => '',
	'priority'		 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'alpha_store_account',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'alpha_store_socials',
	'label'			 => __( 'Social Icons', 'alpha-store' ),
	'description'	 => __( 'Enable or Disable the social icons', 'alpha-store' ),
	'section'		 => 'alpha_store_top_bar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
$s_social_links = array(
	'twp_social_facebook'	 => __( 'Facebook', 'alpha-store' ),
	'twp_social_twitter'	 => __( 'Twitter', 'alpha-store' ),
	'twp_social_google'		 => __( 'Google-Plus', 'alpha-store' ),
	'twp_social_instagram'	 => __( 'Instagram', 'alpha-store' ),
	'twp_social_pin'		 => __( 'Pinterest', 'alpha-store' ),
	'twp_social_youtube'	 => __( 'YouTube', 'alpha-store' ),
	'twp_social_reddit'		 => __( 'Reddit', 'alpha-store' ),
	'twp_social_linkedin'	 => __( 'LinkedIn', 'alpha-store' ),
	'twp_social_skype'		 => __( 'Skype', 'alpha-store' ),
	'twp_social_vimeo'		 => __( 'Vimeo', 'alpha-store' ),
	'twp_social_flickr'		 => __( 'Flickr', 'alpha-store' ),
	'twp_social_dribble'	 => __( 'Dribbble', 'alpha-store' ),
	'twp_social_envelope-o'	 => __( 'Email', 'alpha-store' ),
	'twp_social_rss'		 => __( 'Rss', 'alpha-store' ),
);

foreach ( $s_social_links as $keys => $values ) {
	Kirki::add_field( 'alpha_store_settings', array(
		'type'			 => 'text',
		'settings'		 => $keys,
		'label'			 => $values,
		'description'	 => sprintf( __( 'Insert your custom link to show the %s icon.', 'alpha-store' ), $values ),
		'help'			 => __( 'Leave blank to hide icon.', 'alpha-store' ),
		'section'		 => 'alpha_store_top_bar_section',
		'default'		 => '',
		'priority'		 => 10,
		'active_callback'	 => array(
			array(
				'setting'	 => 'alpha_store_socials',
				'operator'	 => '==',
				'value'		 => 1,
			),
		),
	) );
}
Kirki::add_field( 'alpha_store_settings', array(
	'type'				 => 'textarea',
	'settings'			 => 'infobox-text',
	'label'				 => __( 'Search bar info text', 'alpha-store' ),
	'help'				 => __( 'You can add custom text', 'alpha-store' ),
	'section'			 => 'alpha_store_search_bar_section',
	'sanitize_callback'	 => 'wp_kses_post',
	'default'			 => '',
	'priority'			 => 10,
	'transport'			 => 'postMessage',
    'js_vars'   => array(
        array(
            'element'  => '.top-infobox',
            'function' => 'html',
            'property' => ''
        ),
    ),
) );

if ( function_exists( 'YITH_WCWL' ) ) {
	Kirki::add_field( 'alpha_store_settings', array(
		'type'			 => 'toggle',
		'settings'		 => 'wishlist-top-icon',
		'label'			 => __( 'Header Wishlist icon', 'alpha-store' ),
		'description'	 => __( 'Enable or disable heart icon with counter in header', 'alpha-store' ),
		'section'		 => 'alpha_store_woo_section',
		'default'		 => 0,
		'priority'		 => 10,
	) );
}
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'woo-breadcrumbs',
	'label'			 => __( 'Breadcrumbs', 'alpha-store' ),
	'description'	 => __( 'Enable or disable breadcrumbs on WooCommerce pages', 'alpha-store' ),
	'section'		 => 'alpha_store_woo_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'cart-top-icon',
	'label'			 => __( 'Header Cart', 'alpha-store' ),
	'description'	 => __( 'Enable or disable header cart', 'alpha-store' ),
	'section'		 => 'alpha_store_woo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'code',
	'settings'	 => 'cart-banner',
	'label'		 => __( 'HTML banner', 'alpha-store' ),
	'section'	 => 'alpha_store_woo_section',
	'choices'	 => array(
		'label'		 => __( 'Banner code', 'alpha-store' ),
		'language'	 => 'html',
		'theme'		 => 'monokai',
	),
	'default'	 => '',
	'priority'	 => 10,
	'active_callback'    => ( function_exists( 'YITH_WCWL' ) ) ? array(
		array(
			'setting'  => 'cart-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'wishlist-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
	) : array(
		array(
			'setting'  => 'cart-top-icon',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_products',
	'label'			 => __( 'Number of products', 'alpha-store' ),
	'description'	 => __( 'Change number of products displayed per page in archive(shop) page.', 'alpha-store' ),
	'section'		 => 'alpha_store_woo_section',
	'default'		 => 24,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 60,
		'step'	 => 1
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_columns',
	'label'			 => __( 'Number of products per row', 'alpha-store' ),
	'description'	 => __( 'Change the number of product columns per row in archive(shop) page.', 'alpha-store' ),
	'section'		 => 'alpha_store_woo_section',
	'default'		 => 4,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 5,
		'step'	 => 1
	),
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_title',
	'label'		 => __( 'Site title color', 'alpha-store' ),
	'help'		 => __( 'Site title text color, if not defined logo.', 'alpha-store' ),
	'section'	 => 'colors',
	'default'	 => '#fff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'h2.site-title a, h1.site-title a',
			'property'	 => 'color',
		),
	),
	'transport'	 => 'auto',
) );
Kirki::add_field( 'alpha_store_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_desc',
	'label'		 => __( 'Site description color', 'alpha-store' ),
	'help'		 => __( 'Site description text color, if not defined logo.', 'alpha-store' ),
	'section'	 => 'colors',
	'default'	 => '#fff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'h2.site-desc, h3.site-desc',
			'property'	 => 'color',
		),
	),
	'transport'	 => 'auto',
) );

$theme_links = array(
	'documentation'	 => array(
		'link'		 => esc_url_raw( 'http://demo.themes4wp.com/documentation/category/alpha-store/' ),
		'text'		 => __( 'Documentation', 'alpha-store' ),
		'settings'	 => 'theme-docs',
	),
	'demo'			 => array(
		'link'		 => esc_url_raw( 'http://demo.themes4wp.com/alpha-store/' ),
		'text'		 => __( 'View Demo', 'alpha-store' ),
		'settings'	 => 'theme-demo',
	),
	'rating'		 => array(
		'link'		 => esc_url_raw( 'https://wordpress.org/support/view/theme-reviews/alpha-store?filter=5' ),
		'text'		 => __( 'Rate This Theme', 'alpha-store' ),
		'settings'	 => 'theme-rate',
	)
);

foreach ( $theme_links as $theme_link ) {
	Kirki::add_field( 'alpha_store_settings', array(
		'type'		 => 'custom',
		'settings'	 => $theme_link[ 'settings' ],
		'section'	 => 'alpha_store_links_section',
		'default'	 => '<div style="padding: 10px; text-align: center; font-size: 22px; font-weight: bold;"><a target="_blank" href="' . $theme_link[ 'link' ] . '" >' . esc_attr( $theme_link[ 'text' ] ) . ' </a></div>',
		'priority'	 => 10,
	) );
}

function alpha_store_configuration() {

	$config[ 'color_back' ]		 = '#192429';
	$config[ 'color_accent' ]	 = '#00a0d2';
	$config[ 'width' ]			 = '25%';

	return $config;
}

add_filter( 'kirki/config', 'alpha_store_configuration' );

/**
 * Add custom CSS styles
 */
function alpha_store_enqueue_header_css() {

	$columns = get_theme_mod( 'archive_number_columns', 4 );

	if ( $columns == '2' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 48.05%}}';
	} elseif ( $columns == '3' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 30.75%;}}';
	} elseif ( $columns == '5' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 16.95%;}}';
	} else {
		$css = '';
	}
	wp_add_inline_style( 'kirki-styles-alpha_store_settings', $css );
}

add_action( 'wp_enqueue_scripts', 'alpha_store_enqueue_header_css', 9999 );

