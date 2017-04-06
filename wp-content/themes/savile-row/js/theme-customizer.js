/**

 * Theme Customizer enhancements for a better user experience.

 *

 * Contains handlers to make Theme Customizer preview reload changes asynchronously.

 */



( function( $ ) {

	wp.customize( 'blogname', function( value ) {

		value.bind( function( to ) {

			$( '.site-title a' ).html( to );

		} );

	} );

	wp.customize( 'blogdescription', function( value ) {

		value.bind( function( to ) {

			$( '.site-description' ).html( to );

		} );

	} );


	wp.customize( 'savilerow_transform_titletagline', function( value ) {

		value.bind( function( to ) {

			$( 'h1.site-title a, .site-description' ).css( 'text-transform', 'uppercase' );

		} );

	} );

	wp.customize( 'header_background_color', function( value ) {

		value.bind( function( to ) {

			$( '.site-header' ).css( 'background-color', to );

		} );

	} );

	wp.customize( 'main_highlight_color', function( value ) {

		value.bind( function( to ) {

			$( 'h1.site-title a,.site-description,.main-navigation li:hover > a,.main-navigation li.current-menu-item a, .main-navigation li.current_page_item a, .main-navigation li.current_page_item:hover a,#main-navigation li.current_page_item:hover,.main-navigation li.current-menu-parent:hover > a,.main-navigation li.current-menu-parent ul.sub-menu li.current_page_item.main-navigation ul ul li a:hover,#main-navigation ul ul li a:hover i, .main-navigation li.current-menu-parent ul.sub-menu li.current_page_item a,.main-navigation li.current_page_item a,.main-navigation > li > a, .main-navigation li.current_page_ancestor a,.main-navigation,.main-small-navigation .menu li a,.entry-content a,.nav-previous a,.nav-next a,.nav-links a,.nav-links .current,#TB_closeWindow .tb-close-icon:hover,.comment-author a:hover,.comment-meta a:hover,.logged-in-as a,.reply a,.woocommerce .sidebar .page-title,.breadcrumbs a,.woocommerce .woocommerce-breadcrumb a,.savilerow-products-per-page a,.widget_calendar td a,.sub-footer a.widget_product_categories .current-cat > a,.woocommerce .woocommerce-info:before,.woocommerce ul.products li.product .star-rating,.hero-container .section-title,.featured-section h2,.recent-posts h2,.partners-section h2,.featured-content .overlay h4 a,.sub-footer a,h2.section-title' ).css( 'color', to );

			$('.more-link a,.main-small-navigation li.current_page_item > a, .main-small-navigation li.current-menu-item > a').css('color', '#fff');

			$( '.more-link .mybutton,button,html input[type="button"],input[type="reset"],input[type="submit"],.social-media a,.sm-top,.nav-links .current,.nav-previous a:hover,.nav-next a:hover,.nav-links a:hover,.image-overlay-inner a:hover,.widget_tag_cloud a:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.hero-container .cta a.btn, .promo-bar, .caption_wrap .flex-caption p, .flex-caption .flex-caption-title, .main-small-navigation li.current_page_item > a, .main-small-navigation li.current-menu-item > a' ).css( 'background-color', to );

			$( 'h1.site-title,h1.site-title a,.alternate2 .main-navigation ul ul.nav-previous a,.nav-next a,.nav-links a,.nav-links .current,.nav-links .current,.nav-previous a:hover,.nav-next a:hover,.nav-links a:hover.widget_product_categories li:before,.woocommerce .woocommerce-info,.hero-container .section-title, article.sticky' ).css( 'border-color', to );

			$( '.hero-container .cta a.btn' ).css( 'outline-color', to );

		} );

	} );


	wp.customize( 'savilerow_title_color', function( value ) {

		value.bind( function( to ) {

			$( 'h1.site-title a' ).css( 'color', to );
			$( 'h1.site-title, h1.site-title a' ).css( 'border-color', to );

		} );

	} );

	wp.customize( 'savilerow_tagline_color', function( value ) {

		value.bind( function( to ) {

			$( '.site-description' ).css( 'color', to );

		} );

	} );





	wp.customize( 'telnumber_textbox_header_one', function( value ) {

		value.bind( function( to ) {

			$( '.contact.telnumber' ).html( to );

		} );

	} );

	wp.customize( 'mobile_textbox_header_one', function( value ) {

		value.bind( function( to ) {

			$( '.contact.mobile' ).html( to );

		} );

	} );

	wp.customize( 'email_textbox_header_one', function( value ) {

		value.bind( function( to ) {

			$( '.contact.email' ).html( to );

		} );

	} );

	wp.customize( 'address_textbox_header_one', function( value ) {

		value.bind( function( to ) {

			$( '.contact.address' ).html( to );

		} );

	} );

	wp.customize( 'copyright_text', function( value ) {

		value.bind( function( to ) {

			$( '.site-info p' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox', function( value ) {

		value.bind( function( to ) {

			$( '.promo-bar h2' ).html( to );

		} );

	} );

	wp.customize( 'featured_button_txt', function( value ) {

		value.bind( function( to ) {

			$( '.promo-bar a' ).html( to );

		} );

	} );

	wp.customize( 'homepage_service_title', function( value ) {

		value.bind( function( to ) {

			$( '.featuretext_middle h3' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_header_one', function( value ) {

		value.bind( function( to ) {

			$( '.box-1 .featuretext h4 a' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_header_two', function( value ) {

		value.bind( function( to ) {

			$( '.box-2 .featuretext h4 a' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_header_three', function( value ) {

		value.bind( function( to ) {

			$( '.box-3 .featuretext h4 a' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_text_one', function( value ) {

		value.bind( function( to ) {

			$( '.box-1 .featuretext p' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_text_two', function( value ) {

		value.bind( function( to ) {

			$( '.box-2 .featuretext p' ).html( to );

		} );

	} );

	wp.customize( 'featured_textbox_text_three', function( value ) {

		value.bind( function( to ) {

			$( '.box-3 .featuretext p' ).html( to );

		} );

	} );

	wp.customize( 'homepage_recent_title', function( value ) {

		value.bind( function( to ) {

			$( '.section_thumbnails h3' ).html( to );

		} );

	} );

	wp.customize( 'homepage_partners_title', function( value ) {

		value.bind( function( to ) {

			$( '.client h3' ).html( to );

		} );

	} );

} )( jQuery );
