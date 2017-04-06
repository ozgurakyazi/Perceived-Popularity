<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Sabino
 */

function customizer_library_sabino_options() {
	
	$primary_color = '#13C76D';
	$secondary_color = '#05934c';
	
	$body_font_color = '#3C3C3C';
	$heading_font_color = '#000000';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
    
    
    // Site Layout Options
    $section = 'title_tagline';
    
    $options['sabino-logo-max-size'] = array(
        'id' => 'sabino-logo-max-size',
        'label'   => __( 'Logo Max Width', 'sabino' ),
        'section' => $section,
        'type'    => 'number'
    );
    
    $panel = 'sabino-panel-settings';
    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Theme Settings', 'sabino' ),
        'priority' => '30'
    );
    
    $section = 'sabino-panel-settings-section-website'; // -------------------------- Website Layout Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Layout', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-set-container-width'] = array(
        'id' => 'sabino-set-container-width',
        'label'   => __( 'Site Container Width', 'sabino' ),
        'section' => $section,
        'type'    => 'range',
        'input_attrs' => array(
            'min'   => 982,
            'max'   => 1340,
            'step'  => 2,
        ),
        'default' => 1240
    );
    $choices = array(
        'sabino-content-layout-joined' => __( 'Content Joined Layout', 'sabino' ),
        'sabino-content-layout-blocks' => __( 'Content Blocks Layout', 'sabino' )
    );
    $options['sabino-content-layout'] = array(
        'id' => 'sabino-content-layout',
        'label'   => __( 'Site Content Layout', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'sabino-content-layout-joined'
    );
    $options['sabino-content-break-widgets'] = array(
        'id' => 'sabino-content-break-widgets',
        'label'   => __( 'break up the sidebar widgets', 'sabino' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    $options['sabino-remove-page-titles'] = array(
        'id' => 'sabino-remove-page-titles',
        'label'   => __( 'Remove Page Titles', 'sabino' ),
        'section' => $section,
        'type'    => 'checkbox',
        'default' => 0,
    );
    
    $options['sabino-unote-layout'] = array(
        'id' => 'sabino-unote-layout',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Adjust Sidebar width<br />- Break Content Area & Widget area into blocks<br />- Break widgets into separate blocks', 'sabino' )
    );
    // ------------------------------------------------------------------------------ Website Layout Settings
    
    
    $section = 'sabino-panel-settings-section-header'; // ---------------------------- Header Layout Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $choices = array(
        'sabino-header-layout-one' => __( 'Header Layout One', 'sabino' ),
        'sabino-header-layout-two' => __( 'Header Layout Two', 'sabino' )
    );
    $options['sabino-header-layout'] = array(
        'id' => 'sabino-header-layout',
        'label'   => __( 'Header Layout', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'sabino-header-layout-one'
    );
    $options['sabino-unote-header'] = array(
        'id' => 'sabino-unote-header',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Change Header Two to a Centered Layout<br />- Remove Phone Number<br />- Remove Social Icons<br />- Remove Search<br />- Remove WooCommerce Cart', 'sabino' )
    );
    // ------------------------------------------------------------------------------- Header Layout Settings
    
    $section = 'sabino-panel-settings-section-slider'; // ---------------------------- Slider Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Home Page Slider', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $choices = array(
        'sabino-slider-default' => __( 'Default Slider', 'sabino' ),
        'sabino-meta-slider' => __( 'Meta Slider', 'sabino' ),
        'sabino-no-slider' => __( 'None', 'sabino' )
    );
    $options['sabino-slider-type'] = array(
        'id' => 'sabino-slider-type',
        'label'   => __( 'Choose a Slider', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'sabino-no-slider'
    );
    $options['sabino-slider-cats'] = array(
        'id' => 'sabino-slider-cats',
        'label'   => __( 'Slider Categories', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)<br /><br />Get the ID at <b>Posts -> Categories</b>.<br /><br />Or <a href="https://kairaweb.com/documentation/setting-up-the-default-slider/" target="_blank"><b>See more instructions here</b></a>', 'sabino' )
    );
    $options['sabino-meta-slider-shortcode'] = array(
        'id' => 'sabino-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by the slider plugin', 'sabino' )
    );
    $choices = array(
        'sabino-slider-size-small' => __( 'Small Slider', 'sabino' ),
        'sabino-slider-size-medium' => __( 'Medium Slider', 'sabino' ),
        'sabino-slider-size-large' => __( 'Large Slider', 'sabino' )
    );
    $options['sabino-slider-size'] = array(
        'id' => 'sabino-slider-size',
        'label'   => __( 'Slider Size', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'sabino-slider-size-medium'
    );
    $options['sabino-unote-slider'] = array(
        'id' => 'sabino-unote-slider',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Make Slider Full Width<br />- Select Slider scroll effect<br />- Change Slider scroll duration<br />- Link slide to post<br />- Remove Slider titles<br />- Stop auto scroll', 'sabino' )
    );
    
    // ------------------------------------------------------------------------------- Slider Settings
    
    
    $section = 'sabino-panel-settings-section-blog'; // -------------------------------- Blog Layout Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $choices = array(
        'blog-left-layout' => __( 'Left Layout', 'sabino' ),
        'blog-right-layout' => __( 'Right Layout', 'sabino' ),
        'blog-alt-layout' => __( 'Alternate Layout', 'sabino' ),
        'blog-top-layout' => __( 'Top Layout', 'sabino' )
    );
    $options['sabino-set-blog-layout'] = array(
        'id' => 'sabino-set-blog-layout',
        'label'   => __( 'Blog Posts Layout', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'blog-left-layout'
    );
    $options['sabino-blog-cats'] = array(
        'id' => 'sabino-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'sabino' )
    );
    
    $options['sabino-unote-blog-list'] = array(
        'id' => 'sabino-unote-blog-list',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Set Blog List/Archive/Single pages to Left Sidebar<br />- Set Blog List/Archive/Single pages to Full Width<br /><br />- Set WooCommerce Shop/Archive/Single pages to Left Sidebar<br />- Set WooCommerce Shop/Archive/Single pages to Full Width', 'sabino' )
    );
    // --------------------------------------------------------------------------------- Blog Layout Settings
    
    $section = 'sabino-panel-settings-section-footer'; // ---------------------------- Footer Layout Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $choices = array(
        'sabino-footer-layout-standard' => __( 'Standard Layout', 'sabino' ),
        'sabino-footer-layout-social' => __( 'Social Layout', 'sabino' ),
        'sabino-footer-layout-none' => __( 'None', 'sabino' )
    );
    $options['sabino-footer-layout'] = array(
        'id' => 'sabino-footer-layout',
        'label'   => __( 'Footer Layout', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'sabino-footer-layout-social'
    );
    
    $options['sabino-unote-footer'] = array(
        'id' => 'sabino-unote-footer',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Offers an advanced custom footer layout - Set custom columns (Widget) and customize the column widths<br />- Remove Footer bottom bar', 'sabino' )
    );
    // ------------------------------------------------------------------------------- Footer Layout Settings
    
    
    $panel = 'sabino-panel-text';
    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Theme Text', 'sabino' ),
        'priority' => '30'
    );
    
    $section = 'sabino-panel-text-section-header'; // ---------------------------------- Header Text Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-custom-phicon'] = array(
        'id' => 'sabino-custom-phicon',
        'label'   => __( 'Custom Icon', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Change the phone icon by entering another<br /><a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> class here<br />Eg: "fa-map-marker"', 'sabino' ),
    );
    $options['sabino-website-head-txt-sm'] = array(
        'id' => 'sabino-website-head-txt-sm',
        'label'   => __( 'Smaller Text', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Give us a call:', 'sabino' )
    );
    $options['sabino-website-head-txt-lg'] = array(
        'id' => 'sabino-website-head-txt-lg',
        'label'   => __( 'Larger Text', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( '082 444 YEAH', 'sabino' )
    );
    // --------------------------------------------------------------------------------- Header Text Settings
    
    $section = 'sabino-panel-text-section-navigation'; // -------------------------- Navigation Text Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Navigation', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-header-menu-text'] = array(
        'id' => 'sabino-header-menu-text',
        'label'   => __( 'Menu Button Text', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'MENU',
        'description' => __( 'This is the text for the mobile menu button', 'sabino' )
    );
    // ----------------------------------------------------------------------------- Navigation Text Settings
    
    $section = 'sabino-panel-text-section-footer'; // ---------------------------------- Footer Text Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-website-site-add'] = array(
        'id' => 'sabino-website-site-add',
        'label'   => __( 'Footer Address', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Cape Town, South Africa', 'sabino' )
    );
    
    $options['sabino-unote-footer-text'] = array(
        'id' => 'sabino-unote-footer-text',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Change attribution text to your own copyright text', 'sabino' )
    );
    // --------------------------------------------------------------------------------- Footer Text Settings
    
    $section = 'sabino-panel-text-section-error'; // -------------------------------- Error 404 Text Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Error 404', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-website-error-head'] = array(
        'id' => 'sabino-website-error-head',
        'label'   => __( '404 Error Page Heading', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'sabino'),
        'description' => __( 'Enter the heading for the 404 Error page', 'sabino' )
    );
    $options['sabino-website-error-msg'] = array(
        'id' => 'sabino-website-error-msg',
        'label'   => __( 'Error 404 Message', 'sabino' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'sabino'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'sabino' )
    );
    // ------------------------------------------------------------------------------ Error 404 Text Settings
    
    $section = 'sabino-panel-text-section-noresults'; // --------------------------- No Results Text Settings
    $sections[] = array(
        'id' => $section,
        'title' => __( 'No Results', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-website-nosearch-head'] = array(
        'id' => 'sabino-website-nosearch-head',
        'label'   => __( 'No Search Results Heading', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Nothing Found', 'sabino'),
        'description' => __( 'Enter the heading when no search results are found', 'sabino' )
    );
    $options['sabino-website-nosearch-msg'] = array(
        'id' => 'sabino-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'sabino' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sabino'),
        'description' => __( 'Enter the default text for when no search results are found', 'sabino' )
    );
    // ----------------------------------------------------------------------------- No Results Text Settings
    
    
    $panel = 'sabino-panel-font';
    $panels[] = array(
        'id' => $panel,
        'title' => __( 'Theme Fonts', 'sabino' ),
        'priority' => '30'
    );
    
    $section = 'sabino-panel-font-section-default'; // ------------------------------- Default Font Settings
    $font_choices = customizer_library_get_font_choices();
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Default', 'sabino' ),
        'priority' => '30',
        'panel' => $panel
    );
    
    $options['sabino-body-font'] = array(
        'id' => 'sabino-body-font',
        'label'   => __( 'Body Font', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['sabino-body-font-color'] = array(
        'id' => 'sabino-body-font-color',
        'label'   => __( 'Body Font Color', 'sabino' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );

    $options['sabino-heading-font'] = array(
        'id' => 'sabino-heading-font',
        'label'   => __( 'Heading Font', 'sabino' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Dosis'
    );
    $options['sabino-heading-font-color'] = array(
        'id' => 'sabino-heading-font-color',
        'label'   => __( 'Heading Font Color', 'sabino' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    $options['sabino-unote-fonts'] = array(
        'id' => 'sabino-unote-fonts',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Set Site Title & Tagline custom fonts<br />- Set Site Title & Tagline custom font sizes<br />- Set Spacing between Title & Tagline', 'sabino' )
    );
    // ------------------------------------------------------------------------------- Default Font Settings
    
    
	// Colors
	$section = 'colors';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'sabino' ),
		'priority' => '80'
	);

	$options['sabino-primary-color'] = array(
		'id' => 'sabino-primary-color',
		'label'   => __( 'Primary Color', 'sabino' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	$options['sabino-secondary-color'] = array(
		'id' => 'sabino-secondary-color',
		'label'   => __( 'Secondary Color', 'sabino' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);

	
	// Social Settings
    $section = 'sabino-social-section';
    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'sabino' ),
        'priority' => '80'
    );
    
    $options['sabino-social-email'] = array(
        'id' => 'sabino-social-email',
        'label'   => __( 'Email Address', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-skype'] = array(
        'id' => 'sabino-social-skype',
        'label'   => __( 'Skype Name', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-facebook'] = array(
        'id' => 'sabino-social-facebook',
        'label'   => __( 'Facebook', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-twitter'] = array(
        'id' => 'sabino-social-twitter',
        'label'   => __( 'Twitter', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-google-plus'] = array(
        'id' => 'sabino-social-google-plus',
        'label'   => __( 'Google Plus', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-linkedin'] = array(
        'id' => 'sabino-social-linkedin',
        'label'   => __( 'LinkedIn', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-tumblr'] = array(
        'id' => 'sabino-social-tumblr',
        'label'   => __( 'Tumblr', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
    $options['sabino-social-flickr'] = array(
        'id' => 'sabino-social-flickr',
        'label'   => __( 'Flickr', 'sabino' ),
        'section' => $section,
        'type'    => 'text',
    );
	
    $options['sabino-unote-social'] = array(
        'id' => 'sabino-unote-social',
        'section' => $section,
        'type'    => 'upsell',
        'description' => __( '<b>Premium Extra Features:</b><br />- Over 20 different social profile links available<br />- Setting to add any required custom social icon<br />- Or let us know which links you need and we\'ll add it!', 'sabino' )
    );
    

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_sabino_options' );
