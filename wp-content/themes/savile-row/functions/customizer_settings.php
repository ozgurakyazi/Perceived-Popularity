<?php
/**
 * Customizer - Add Custom Styling
 */
function savilerow_customizer_style()
{
	wp_enqueue_style('savilerow-customizer', get_template_directory_uri() . '/functions/css/customizer.css');
}
add_action('customize_controls_print_styles', 'savilerow_customizer_style');

/**
 * Customizer - Live Preview
 */
function savilerow_customizer_live_preview() {
	wp_enqueue_script(
		'savilerow-theme-customizer',
		get_template_directory_uri() . '/js/theme-customizer.js',
		array( 'customize-preview' ),
		rand(),
		true
	);
}
add_action( 'customize_preview_init', 'savilerow_customizer_live_preview' );

/**
 * Customizer - Panels, Sections, Settings & Controls
 */
function savilerow_register_theme_customizer( $wp_customize ) {

	//  List Arrays
	$list_social_channels = array( // 1
		'twitter'			=> __( 'Twitter url', 'savile-row' ),
		'facebook'			=> __( 'Facebook url', 'savile-row' ),
		'googleplus'		=> __( 'Google + url', 'savile-row' ),
	);

	$list_featured_text_boxes = array(
		array('one', __('One', 'savile-row'), __('Featured Box One', 'savile-row')),
		array('two', __('Two', 'savile-row'), __('Featured Box Two', 'savile-row')),
		array('three', __('Three', 'savile-row'), __('Featured Box Three', 'savile-row')),
	);

	$list_partners_text_boxes = array(
		array('one', __('One', 'savile-row'), __('Partners logo 1', 'savile-row')),
		array('two', __('Two', 'savile-row'), __('Partners logo 2', 'savile-row')),
		array('three', __('Three', 'savile-row'), __('Partners logo 3', 'savile-row')),
		array('four', __('Four', 'savile-row'), __('Partners logo 4', 'savile-row')),
		array('five', __('Five', 'savile-row'), __('Partners logo 5', 'savile-row')),
		array('six', __('Six', 'savile-row'), __('Partners logo 6', 'savile-row')),
	);

	$list_header_elements = array(
		'savilerow_hide_top_nav'		=> __( 'Hide Top Bar Navigation', 'savile-row' ),
		'savilerow_hide_search'		=> __( 'Hide Search', 'savile-row' ),
	);

	$list_layout_types = array(
		'blog'			=> __( 'Blog/Archive', 'savile-row'),
		'search'		=> __( 'Search Results', 'savile-row'),

	);


	if ( is_woocommerce_activated() ) {
		$list_single_layout_types = array(
			'page'			=> __( 'Page', 'savile-row'),
			'single'		=> __( 'Full Post', 'savile-row'),
			'404'			=> __( '404 Page', 'savile-row'),
			'product'		=> __( 'Product Pages', 'savile-row'),
		);
	}else{
		$list_single_layout_types = array(
			'page'			=> __( 'Page', 'savile-row'),
			'single'		=> __( 'Full Post', 'savile-row'),
			'404'			=> __( '404 Page', 'savile-row'),
		);
	}

	$list_header_layouts = array(
		'default'			=> __('Default', 'savile-row'),
		'alternate1'	=> __('Alternate 1', 'savile-row'),
		'alternate2'	=> __('Alternate 2', 'savile-row'),
		'alternate3'	=> __('Alternate 3', 'savile-row'),
	);


	/*
	* //////////////////// Pro Panel ////////////////////////////
	*/
		$wp_customize->add_section( 'savilerow_pro', array(
			'title' => __( 'Upgrade to Pro', 'savile-row' ),
			'priority' => 1
		) );

		$wp_customize->add_setting(
			'savilerow_pro', // IDs can have nested array keys
			array(
				'default' => false,
				'type' => 'savilerow_pro',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_TE_Control(
				$wp_customize,
				'savilerow_pro',
				array(
					'content'  => sprintf(
						__( '<strong>Premium support</strong>, more Customizer options, typography adjustments, and more! %s.', 'savile-row' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( savilerow_get_pro_link( 'customizer' ) ),
							__( 'Upgrade to Pro', 'savile-row' )
						)
					),
					'section' => 'savilerow_pro',
				)
			)
		);
	/*
	* //////////////////// END Pro Panel ////////////////////////////
	*/



	/*
	* //////////////////// Panels ////////////////////////////
	*/

	$priority = 10;

	if(method_exists('WP_Customize_Manager', 'add_panel')){

		$wp_customize->add_panel('savilerow_header_panel', array(
			'title'		=> __('Site Settings', 'savile-row'),
			'priority'	=> $priority++,
		));

		$wp_customize->add_panel('savilerow_layout_panel', array(
			'title'		=> __('Customize Layout', 'savile-row'),
			'priority'	=> $priority++,
		));

		$wp_customize->add_panel('savilerow_homepage_panel', array(
			'title'		=> __('Homepage Settings', 'savile-row'),
			'priority'	=> $priority++,
		));

	}

	/*
	* //////////////////// Sections ////////////////////////////
	*/

	$priority = 2;

	$wp_customize->add_section( 'savilerow_header_section', array(
		'title'							=>	__('Header Section', 'savile-row'),
		'description'				=> __('Options for controlling the header section', 'savile-row'),
		'panel'							=> 'savilerow_layout_panel',
		'priority'					=> $priority++,
	));

	foreach ($list_layout_types as $key => $value){

		$wp_customize->add_section( 'savilerow_'.$key.'_layout' , array(
			'title'       		=> $value,
			'description' 		=> __( 'Customize the layout of this template', 'savile-row' ),
			'panel'						=> 'savilerow_layout_panel',
			'priority'				=> $priority++,
		) );

	}

	foreach ($list_single_layout_types as $key => $value){

		$wp_customize->add_section( 'savilerow_'.$key.'_layout' , array(
			'title'       		=> $value,
			'description' 		=> __( 'Customize the layout of this template', 'savile-row' ),
			'panel'				=> 'savilerow_layout_panel',
			'priority'			=> $priority++,
		) );

	}

	$wp_customize->add_section( 'savilerow_logo_section' , array(
		'title'       		=> __( 'Site Logo', 'savile-row' ),
		'description' 		=> __( 'Upload a logo to replace the default site name and description in the header', 'savile-row' ),
		'panel'				=> 'savilerow_header_panel',
		'priority'			=> $priority++,
	) );

	$wp_customize->add_section( 'savilerow_social_section', array(
		'title'				=> __('Social Media Accounts', 'savile-row'),
		'description' 		=> __( 'Setup your social media accounts here.', 'savile-row' ),
		'panel'				=> 'savilerow_header_panel',
		'priority'			=> $priority++,
	));

	$wp_customize->add_section( 'footer_settings', array(
	    'title'       		=> __( 'Footer Settings', 'savile-row' ),
	    'description' 		=> __( "Change/hide content in the footer.", 'savile-row' ),
	    'panel'				=> 'savilerow_header_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'homepage_hide_elements', array(
	    'title'       		=> __( 'Hide &amp; Show Sections', 'savile-row' ),
	    'description' 		=> __( 'Show and Hide elements on the custom homepage template', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'homepage_hero', array(
	    'title'       		=> __( 'Hero Settings', 'savile-row' ),
	    'description' 		=> __( 'Control the Hero element of the homepage', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'homepage_slider', array(
	    'title'       		=> __( 'Flexslider Settings', 'savile-row' ),
	    'description' 		=> __( 'Control the homepage slider', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

    $wp_customize->add_section( 'service_section_settings', array(
	    'title'       		=> __( 'Featured Section', 'savile-row' ),
	    'description' 		=> __( 'Change the title and control the display of the featured section.', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));


	$arraycount = count($list_featured_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {
		$wp_customize->add_section( 'featured_section_' . $list_featured_text_boxes[$row][0], array(
			    'title' 			=> $list_featured_text_boxes[$row][2],
			    'description' 		=> __( 'This is a settings section to change the custom homepage featured boxes.', 'savile-row' ),
			    'panel'				=> 'savilerow_homepage_panel',
			    'priority' 			=> $priority++,
	        )
	    );
	}

    $wp_customize->add_section( 'featured_section_top', array(
	    'title'       		=> __( 'Promotional Bar', 'savile-row' ),
	    'description' 		=> __( 'Create a eye catching "call to action"', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$wp_customize->add_section( 'recent_posts_section_settings', array(
	    'title'       		=> __( 'Recent Posts', 'savile-row' ),
	    'description' 		=> __( 'Change the title of this section.', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

    $wp_customize->add_section( 'partners_section_settings', array(
	    'title'       		=> __( 'Partners Settings', 'savile-row' ),
	    'description' 		=> __( 'Change the title or this section.', 'savile-row' ),
	    'panel'				=> 'savilerow_homepage_panel',
	    'priority'			=> $priority++,
    ));

	$arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {
	 	$wp_customize->add_section( 'logo_section_' . $list_partners_text_boxes[$row][0], array(
		    'title' 			=> $list_partners_text_boxes[$row][2],
		    'description' 		=> __( 'This is a settings section to change the Custom Homepage Partners logo 1.', 'savile-row' ),
		    'panel'				=> 'savilerow_homepage_panel',
		    'priority'		 	=> $priority++,
	        )
	    );
	}

	/*
	* //////////////////// Settings ////////////////////////////
	*/

	$wp_customize->add_setting('savilerow_transform_titletagline', array(
		'default'			=> false,
		'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'header_background_color', array(
			'default'        	=> '#fff',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_color',
		)
	);

	$wp_customize->add_setting( 'main_highlight_color', array(
			'default'        	=> '#0a4d6d',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_color',
		)
	);

	$wp_customize->add_setting( 'savilerow_title_color', array(
			'default'        	=> '#0a4d6d',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_color',
		)
	);

	$wp_customize->add_setting( 'savilerow_tagline_color', array(
			'default'        	=> '#0a4d6d',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_color',
		)
	);

	$wp_customize->add_setting('savilerow_header_layout', array(
		'default'			=> 'default',
		'sanitize_callback'	=> 'savilerow_sanitize_text',
	));

	foreach ($list_header_elements as $key => $value){

		$wp_customize->add_setting($key, array(
			'default'			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
		));

	}

	foreach ($list_layout_types as $key => $value){

		$wp_customize->add_setting('savilerow_'.$key.'_layout', array(
			'default'			=> 'rightSidebar',
			'sanitize_callback'	=> 'savilerow_sanitize_text',
		));

	}
	foreach ($list_single_layout_types as $key => $value){

		$wp_customize->add_setting('savilerow_'.$key.'_single_layout', array(
			'default'			=> 'rightSidebar',
			'sanitize_callback'	=> 'savilerow_sanitize_text',
		));

	}

	$wp_customize->add_setting('show_helpful_links', array(
		'default'			=> false,
		'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	foreach ($list_social_channels as $key => $value) {

		$wp_customize->add_setting( $key, array(
			'sanitize_callback' => 'savilerow_sanitize_url',
		));

	}

	$wp_customize->add_setting( 'savilerow_logo', array(
			'sanitize_callback' => 'savilerow_sanitize_url',
		)
	);

	$wp_customize->add_setting( 'homepage_hero_show', array(
			'default' 			=> false,
			'sanitize_callback' => 'savilerow_sanitize_checkbox',
		)
	);
	$wp_customize->add_setting( 'homepage_flexslider_show', array(
			'default' 			=> false,
			'sanitize_callback' => 'savilerow_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting( 'savilerow_hero_image', array(
			'sanitize_callback' => 'savilerow_sanitize_url',
		)
	);
	$wp_customize->add_setting( 'savilerow_hero_title', array(
			'default'			=> __('A Touch of Class', 'savile-row'),
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);
	$wp_customize->add_setting( 'savilerow_hero_tagline', array(
			'default'			=> __('Enjoy free shipping on all orders', 'savile-row'),
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);
	$wp_customize->add_setting( 'savilerow_hero_button_text', array(
			'default'			=> __('SHOP NOW', 'savile-row'),
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);
	$wp_customize->add_setting( 'savilerow_hero_url', array(
			'default'			=> __('http://', 'savile-row'),
			'sanitize_callback' => 'savilerow_sanitize_url',
		)
	);

	$wp_customize->add_setting( 'homepage_slider_cat', array(
			'default'			=> 'savile-row-featured',
			'sanitize_callback'	=> 'savilerow_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'homepage_slider_slide_no', array(
	        'default'     		=> '3',
			'sanitize_callback'	=> 'savilerow_sanitize_integer',
    	)
	);

	$wp_customize->add_setting( 'homepage_slider_fullwidth', array(
	        'default'     			=> false,
					'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
    	)
	);
	$wp_customize->add_setting( 'homepage_slider_hide_text', array(
					'default'     			=> false,
					'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
			)
	);
	$wp_customize->add_setting( 'homepage_slider_hide_caption', array(
					'default'     			=> false,
					'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
			)
	);

	$wp_customize->add_setting( 'homepage_promotional_bool', array(
			'default' 			=> false,
			'sanitize_callback' => 'savilerow_sanitize_checkbox',
		)
	);

	$wp_customize->add_setting( 'featured_textbox', array(
			'default' 			=> __( 'Promotional Bar', 'savile-row' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);

	$wp_customize->add_setting( 'featured_button_txt', array(
			'sanitize_callback' => 'savilerow_sanitize_text',
			'transport'			=> 'postMessage',
			'default'			=> 'Find Out More',
		)
	);

	$wp_customize->add_setting( 'featured_button_url', array(
			'default'			=> __( 'http://', 'savile-row' ),
			'sanitize_callback' => 'savilerow_sanitize_url',
		)
	);

	$wp_customize->add_setting('homepage_service_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_service_title', array(
			'default'			=> __( 'Featured Section', 'savile-row' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'featured-page-' . $count, array(
			'sanitize_callback' => 'absint'
		) );
	}

	$wp_customize->add_setting('homepage_recent_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_recent_title', array(
			'default'			=> __( 'Recent Posts', 'savile-row' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);
	$wp_customize->add_setting( 'recent_posts_category', array(
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);

	$wp_customize->add_setting('homepage_partners_bool', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	$wp_customize->add_setting( 'homepage_partners_title', array(
			'default'			=> __( 'Partners', 'savile-row' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);

	$arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_setting( 'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload', array(
			'sanitize_callback' => 'savilerow_sanitize_url',
		));

		$wp_customize->add_setting( 'logo_' . $list_partners_text_boxes[$row][0] . '_url', array(
	        'default' 			=> __( 'http://', 'savile-row' ),
			'sanitize_callback' => 'savilerow_sanitize_url',
	    ));

	}

	$wp_customize->add_setting( 'copyright_text', array(
			'default'			=> __( 'Made by Template Express', 'savile-row' ),
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'savilerow_sanitize_text',
		)
	);

	$wp_customize->add_setting('hide_copyright', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	$wp_customize->add_setting('hide_footer_widgets', array(
			'default' 			=> false,
			'sanitize_callback'	=> 'savilerow_sanitize_checkbox',
	));

	/*
	* //////////////////// Controls ////////////////////////////
	*/

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'savilerow_transform_titletagline_control',
			array(
				'label'      => __('Change Title/Tagline to uppercase', 'savile-row'),
				'section'    => 'title_tagline',
				'settings'   => 'savilerow_transform_titletagline',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color_control',
			array(
				'label'      => __('Header Background Color', 'savile-row'),
				'section'    => 'colors',
				'settings'   => 'header_background_color',
				'priority'	 => 1,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_highlight_color_control',
			array(
				'label'      => __('Main Highlight Color', 'savile-row'),
				'section'    => 'colors',
				'settings'   => 'main_highlight_color',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'savilerow_title_color_control',
			array(
				'label'      => __('Site Title Color', 'savile-row'),
				'section'    => 'colors',
				'settings'   => 'savilerow_title_color',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'savilerow_description_color_control',
			array(
				'label'      => __('Site Tagline Color', 'savile-row'),
				'section'    => 'colors',
				'settings'   => 'savilerow_tagline_color',
				'priority'	 => $priority++,
			)
		)
	);


	foreach ($list_header_elements as $key => $value) {
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$key.'_control',
				array(
					'label'      => $value,
					'section'    => 'savilerow_header_section',
					'settings'   => $key,
					'type'		 => 'checkbox',
					'priority'	 => $priority++,
				)
			)
		);
	}

	$wp_customize->add_control(
		'savilerow_header_layout_control',
		array(
			'label'    		=> __( 'Choose your layout', 'savile-row' ),
			'section'  		=> 'savilerow_header_section',
			'settings' 		=> 'savilerow_header_layout',
			'description'	=> __('Alternate 1 header requires Secondary Custom Menu to be set in order to view social media settings.', 'savile-row'),
			'priority'	 	=> $priority++,
			'type'     		=> 'radio',
			'choices'  		=> array(
				'default'  => __('Default Header', 'savile-row'),
				'alternate1' 	=> __('Alternate 1', 'savile-row'),
				'alternate2' 		=> __('Alternate 2', 'savile-row'),
			),
		)
	);


	foreach ($list_layout_types as $key => $value){

		$wp_customize->add_control(
			'savilerow_'.$key.'_layout_control',
			array(
				'label'    => __( 'Choose your layout', 'savile-row' ),
				'section'  => 'savilerow_'.$key.'_layout',
				'settings' => 'savilerow_'.$key.'_layout',
				'type'     => 'radio',
				'choices'  => array(
					'rightSidebar'  => __('Right Sidebar', 'savile-row'),
					'leftSidebar' 	=> __('Left Sidebar', 'savile-row'),
					'noSidebar' 	=> __('No Sidebar', 'savile-row'),
					'two-col' 		=> __('Two Column', 'savile-row'),
					'three-col' 	=> __('Three Column', 'savile-row'),
					'four-col' 		=> __('Four Column', 'savile-row'),
				),
			)
		);

	}

	foreach ($list_single_layout_types as $key => $value){

		$wp_customize->add_control(
			'savilerow_'.$key.'_single_layout_control',
			array(
				'label'    => __( 'Choose your layout', 'savile-row' ),
				'section'  => 'savilerow_'.$key.'_layout',
				'settings' => 'savilerow_'.$key.'_single_layout',
				'type'     => 'radio',
				'choices'  => array(
					'rightSidebar'  => __('Right Sidebar', 'savile-row'),
					'leftSidebar' 	=> __('Left Sidebar', 'savile-row'),
					'noSidebar' 	=> __('No Sidebar', 'savile-row'),
				),
			)
		);

	}

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_helpful_links_control',
			array(
				'label'      => __('Show Helpful links', 'savile-row'),
				'section'    => 'savilerow_404_layout',
				'settings'   => 'show_helpful_links',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);

	foreach ($list_social_channels as $key => $value) {

		$wp_customize->add_control( $key, array(
			'label'   => $value,
			'section' => 'savilerow_social_section',
			'type'    => 'url',
		) );

	}

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'savilerow_logo', array(
				'label'    => __( 'Logo', 'savile-row' ),
				'section'  => 'savilerow_logo_section',
				'settings' => 'savilerow_logo',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_hero_show_control',
			array(
				'label'      => __('Show Hero', 'savile-row'),
				'section'    => 'homepage_hide_elements',
				'settings'   => 'homepage_hero_show',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_flexslider_show_control',
			array(
				'label'      => __('Show FlexSlider', 'savile-row'),
				'section'    => 'homepage_hide_elements',
				'settings'   => 'homepage_flexslider_show',
				'type'		 => 'checkbox',
				'priority'	 => $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_services_section_control',
			array(
				'label'      	=> __('Hide Featured Section', 'savile-row'),
				'section'    	=> 'homepage_hide_elements',
				'settings'   	=> 'homepage_service_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'featured_hide_bar',
			array(
				'label'      	=> __('Hide Promotional Bar', 'savile-row'),
				'section'    	=> 'homepage_hide_elements',
				'settings'   	=> 'homepage_promotional_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_recent_section_control',
			array(
				'label'      	=> __('Hide Recent Posts Section', 'savile-row'),
				'section'    	=> 'homepage_hide_elements',
				'settings'   	=> 'homepage_recent_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_partners_section_control',
			array(
				'label'      	=> __('Hide Partners Section', 'savile-row'),
				'section'    	=> 'homepage_hide_elements',
				'settings'   	=> 'homepage_partners_bool',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);


	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'savilerow_hero_image_control', array(
				'label'    		=> __( 'Hero Image', 'savile-row' ),
				'section'  		=> 'homepage_hero',
				'settings' 		=> 'savilerow_hero_image',
				'priority'	 	=> $priority++,
			)
		)
	);
	$wp_customize->add_control( 'savilerow_hero_title_control', array(
			'label' 		=> __( 'Hero Title Text', 'savile-row' ),
			'section' 		=> 'homepage_hero',
			'settings'		=> 'savilerow_hero_title',
			'priority'	 	=> $priority++,
		)
	);
	$wp_customize->add_control( 'savilerow_hero_tagline_control', array(
			'label'    	=> __( 'Hero Tagline', 'savile-row' ),
			'section' 		=> 'homepage_hero',
			'settings'		=> 'savilerow_hero_tagline',
			'priority'	 	=> $priority++,
		)
	);

	$wp_customize->add_control( 'savilerow_hero_button_text_control', array(
			'label'    	=> __( 'Hero Button Text', 'savile-row' ),
			'section' 		=> 'homepage_hero',
			'settings'		=> 'savilerow_hero_button_text',
			'priority'	 	=> $priority++,
		)
	);
	$wp_customize->add_control( 'savilerow_hero_url_control', array(
			'label' 	=> __( 'Hero URL link', 'savile-row' ),
			'section' 		=> 'homepage_hero',
			'settings'		=> 'savilerow_hero_url',
			'priority'	 	=> $priority++,
		)
	);


	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'homepage_slider_cat_control',
			array(
				'label'    		=> __('Select Featured Category', 'savile-row'),
				'section'  		=> 'homepage_slider',
				'settings'		=> 'homepage_slider_cat',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new Customize_Number_Control(
			$wp_customize,
			'homepage_slider_slide_no_control',
			array(
				'label'      => __('Amount of slides to display', 'savile-row'),
				'section'    => 'homepage_slider',
				'settings'   => 'homepage_slider_slide_no',
				'type'		 => 'number',
				'priority'	 => $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_slider_fullwidth_control',
			array(
				'label'      	=> __('Make full width', 'savile-row'),
				'section'    	=> 'homepage_slider',
				'settings'   	=> 'homepage_slider_fullwidth',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_slider_hide_text_control',
			array(
				'label'      	=> __('Hide title and teaser', 'savile-row'),
				'section'    	=> 'homepage_slider',
				'settings'   	=> 'homepage_slider_hide_text',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'homepage_slider_hide_caption_control',
			array(
				'label'      	=> __('Hide just the teaser text', 'savile-row'),
				'section'    	=> 'homepage_slider',
				'settings'   	=> 'homepage_slider_hide_caption',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);



	$wp_customize->add_control( 'featured_textbox', array(
		    'label'    		=> __( 'Title Message', 'savile-row' ),
		    'section' 		=> 'featured_section_top',
		    'settings'  	=> 'featured_textbox',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'featured_button_txt_control', array(
		    'label'    	=> __( 'Button Text', 'savile-row' ),
		    'section' 	=> 'featured_section_top',
		    'settings'	=> 'featured_button_txt',
		    'priority'	 	=> $priority++,
	    )
	);

	$wp_customize->add_control( 'featured_button_url', array(
			'label'    	=> __( 'Button Link', 'savile-row' ),
			'section' 	=> 'featured_section_top',
			'priority'	 	=> $priority++,
		)
	);



	$wp_customize->add_control( 'service_section_title_control', array(
        'label'   		=> __('Change Title', 'savile-row'),
        'section' 		=> 'service_section_settings',
        'settings'   	=> 'homepage_service_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    for ( $count = 1; $count <= 3; $count++ ) {
			
			$boxNumber = __( 'Box ', 'savile-row') . $count;
			$wp_customize->add_control( 'featured-page-' . $count, array(
				'label'    		=> $boxNumber,
				'section'  		=> 'service_section_settings',
				'type'     		=> 'dropdown-pages',
				'priority'	 	=> $priority++,
			) );

		}

	$wp_customize->add_control( 'recent_section_title_control', array(
        'label'   		=> __('Change Title', 'savile-row'),
        'section' 		=> 'recent_posts_section_settings',
        'settings'   	=> 'homepage_recent_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'recent_posts_category_control',
			array(
				'label'    		=> __('Select Category', 'savile-row'),
				'section'  		=> 'recent_posts_section_settings',
				'settings'		=> 'recent_posts_category',
				'priority'	 	=> $priority++,
			)
		)
	);

	$wp_customize->add_control( 'partners_section_title_control', array(
        'label'   		=> __('Change Title', 'savile-row'),
        'section' 		=> 'partners_section_settings',
        'settings'   	=> 'homepage_partners_title',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );


    $arraycount = count($list_partners_text_boxes);
	for ($row = 0; $row <  $arraycount; $row++) {

		$wp_customize->add_control(
		    new WP_Customize_Upload_Control(
		        $wp_customize,
		        'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload',
		        array(
		            'label' 		=> __( 'Client logo File Upload', 'savile-row' ),
		            'section' 		=> 'logo_section_' . $list_partners_text_boxes[$row][0],
		            'settings' 		=> 'logo-' . $list_partners_text_boxes[$row][0] . '-file-upload',
		            'priority'	 	=> $priority++,
		        )
		    )
		);

		$wp_customize->add_control( 'logo_' . $list_partners_text_boxes[$row][0] . '_url', array(
				'label'    		=> __( 'Client logo url', 'savile-row' ),
				'section' 		=> 'logo_section_' . $list_partners_text_boxes[$row][0],
				'priority'	 	=> $priority++,
		));

	}

	$wp_customize->add_control( 'copyright_text_control', array(
        'label'   		=> __( "Change Copyright Text", 'savile-row'),
        'section' 		=> 'footer_settings',
        'settings'   	=> 'copyright_text',
        'type'   		=> 'text',
        'priority'	 	=> $priority++,
    ) );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_copyright_control',
			array(
				'label'      	=> __('Hide Copyright Bar', 'savile-row'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_copyright',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'hide_footer_widgets_control',
			array(
				'label'      	=> __('Hide Footer Widgets', 'savile-row'),
				'section'    	=> 'footer_settings',
				'settings'   	=> 'hide_footer_widgets',
				'type'		 	=> 'checkbox',
				'priority'	 	=> $priority++,
			)
		)
	);

	/*
	* //////////////////// Overrides ////////////////////////////
	*/

	$wp_customize->get_section( 'title_tagline' )->panel 			= 'savilerow_header_panel';
	$wp_customize->get_section( 'title_tagline' )->priority 		= 1;
	$wp_customize->get_section( 'header_image' )->panel 			= 'savilerow_header_panel';
	$wp_customize->get_section( 'header_image' )->priority 			= 4;
	$wp_customize->get_section( 'colors' )->panel 					= 'savilerow_header_panel';
	$wp_customize->get_section( 'colors' )->priority 				= 99;

	$wp_customize->get_setting( 'background_color' )->default = '#F5F5F5';

	$wp_customize->get_section('background_image')->panel 			= 'savilerow_header_panel';
	$wp_customize->get_section( 'background_image' )->priority 		= 4;

	// Show instant changes for site title and description in the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport        		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 		= 'postMessage';

	// Remove pre-existing controls
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'customize_register', 'savilerow_register_theme_customizer' );


/**
 *  ////////////// SANITIZATION //////////////////////
 */

// Sanitize Text
function savilerow_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize Textarea
function savilerow_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}
// Sanitize Checkbox
function savilerow_sanitize_checkbox( $input ) {
	if( $input ):
		$output = '1';
	else:
		$output = false;
	endif;
	return $output;
}
// Sanitize Numbers
function savilerow_sanitize_integer( $input ) {
	$value = (int) $input; // Force the value into integer type.
    return ( 0 < $input ) ? $input : null;
}
function savilerow_sanitize_float( $input ) {
	return floatval( $input );
}

// Sanitize Uploads
function savilerow_sanitize_url($input){
	return esc_url_raw($input);
}

// Sanitize Colors
function savilerow_sanitize_color($input){
	return maybe_hash_hex_color($input);
}
