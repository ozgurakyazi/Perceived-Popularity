<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////

function savilerow_customizer_css() {
?>
  <style>

  	<?php if( get_theme_mod('background_color') ){ ?>
  		.woocommerce div.product .woocommerce-tabs ul.tabs li.active{
  			border-bottom-color: <?php echo esc_html( get_theme_mod('background_color') ); ?>;
  		}

  	<?php } ?>

    <?php if(get_theme_mod('savilerow_transform_titletagline')){ ?>
      h1.site-title a,
      .site-description{
        text-transform: uppercase;
      }
    <?php } ?>

	<?php if(get_theme_mod('main_highlight_color')): ?>

		a:hover,h1.site-title a,.site-description,.main-navigation li:hover > a,.main-navigation li.current-menu-item a, .main-navigation li.current_page_item a, .main-navigation li.current_page_item:hover a,#main-navigation li.current_page_item:hover,.main-navigation li.current-menu-parent:hover > a,.main-navigation li.current-menu-parent ul.sub-menu li.current_page_item,.main-navigation ul ul li a:hover,#main-navigation ul ul li a:hover i, .main-navigation li.current-menu-parent ul.sub-menu li.current_page_item a,.main-navigation li.current_page_item a,.main-navigation > li > a, .main-navigation li.current_page_ancestor a,.main-navigation,.main-small-navigation .menu li a,.entry-content a,.nav-previous a,.nav-next a,.nav-links a,.nav-links .current,#TB_closeWindow .tb-close-icon:hover,.comment-author a:hover,.comment-meta a:hover,.logged-in-as a,.reply a,.woocommerce .sidebar .page-title,.breadcrumbs a,.woocommerce .woocommerce-breadcrumb a,.savilerow-products-per-page a,.widget_calendar td a,.sub-footer a.widget_product_categories .current-cat > a,.woocommerce .woocommerce-info:before,.woocommerce ul.products li.product .star-rating,.hero-container .section-title,.featured-section h2,.recent-posts h2,.partners-section h2,.featured-content .overlay h4 a,.sub-footer a,h2.section-title{
				color: <?php echo esc_html( get_theme_mod('main_highlight_color') ); ?>;
		}

		.more-link a,
		.social-media a:hover,
		.main-small-navigation li.current_page_item > a, 
		.main-small-navigation li.current-menu-item > a, 
		.main-small-navigation li a:hover{
			color: #fff;
		}

		.more-link .mybutton,button,html input[type="button"],input[type="reset"],input[type="submit"],.social-media a,.sm-top,.nav-links .current,.nav-previous a:hover,.nav-next a:hover,.nav-links a:hover,.image-overlay-inner a:hover,.widget_tag_cloud a:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.hero-container .cta a.btn, .promo-bar, .caption_wrap .flex-caption p, .flex-caption .flex-caption-title, .main-small-navigation li.current_page_item > a, .main-small-navigation li.current-menu-item > a, .main-small-navigation li a:hover{
			background-color: <?php echo esc_html( get_theme_mod('main_highlight_color') ); ?>;
		}

		h1.site-title,h1.site-title a,.alternate2 .main-navigation ul ul, .nav-previous a,.nav-next a,.nav-links a,.nav-links .current,.nav-links .current,.nav-previous a:hover,.nav-next a:hover,.nav-links a:hover.widget_product_categories li:before,.woocommerce .woocommerce-info,.hero-container .section-title, article.sticky{
			border-color: <?php echo esc_html( get_theme_mod('main_highlight_color') ); ?>;
		}

		.hero-container .cta a.btn{
			outline-color: <?php echo esc_html( get_theme_mod('main_highlight_color') ); ?>;
		}

	<?php endif; ?>

	<?php if(get_theme_mod('savilerow_title_color')): ?>
		.site-introduction h1.site-title a{
			color: <?php echo esc_html( get_theme_mod('savilerow_title_color') ); ?>;
			border-color: <?php echo esc_html( get_theme_mod('savilerow_title_color') ); ?>;
		}
		.site-introduction h1.site-title{
			border-color: <?php echo esc_html( get_theme_mod('savilerow_title_color') ); ?>;
		}
	<?php endif; ?>

	<?php  if(get_theme_mod('savilerow_tagline_color')): ?>
		.site-introduction .site-description{ color: <?php echo esc_html( get_theme_mod('savilerow_tagline_color') ); ?>; }
	<?php endif; ?>


	<?php if( get_theme_mod('homepage_slider_hide_text') &&  get_theme_mod('homepage_slider_hide_text') == true ): ?>
		.caption_wrap{ display: none; }
	<?php endif; ?>

	<?php if( get_theme_mod('homepage_slider_hide_caption') &&  get_theme_mod('homepage_slider_hide_caption') == true ): ?>
		.flex-caption p{ display: none; }
	<?php endif; ?>

	<?php if( get_theme_mod('header_background_color') ): ?>
		.alternate2 .main-navigation.slide--reset{ background-color: <?php echo esc_html( get_theme_mod('header_background_color') ); ?>; }
	<?php endif; ?>


  </style>
<?php
}
add_action( 'wp_head', 'savilerow_customizer_css' );
