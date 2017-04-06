<?php
/**
 * Getting started template
 */

?>

<div id="getting_started" class="alpha-store-tab-pane active">

	<div class="alpha-store-tab-pane-center">

		<h1 class="alpha-store-welcome-title"><?php printf( esc_html__( 'Welcome to %s!', 'alpha-store' ), 'Alpha Store' ); ?></h1>

		<p><?php esc_html_e( 'Our elegant and professional WooCommerce theme, which turns your Wordpress to awesome eCommerce site.','alpha-store'); ?></p>
		<p><?php printf( esc_html__( 'We want to make sure you have the best experience using %1s and that is why we gathered here all the necessary informations for you. We hope you will enjoy using %2s, as much as we enjoy creating great products.', 'alpha-store' ), 'Alpha Store', 'Alpha Store' ); ?>

	</div>

	<hr />

	<div class="alpha-store-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'alpha-store' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'alpha-store' ); ?></p>
    <p><?php esc_html_e( 'This theme uses Kirki toolkit plugin to customize theme. This plugin adds advanced features to the WordPress customizer. Install the plugin before you go to the customizer.', 'alpha-store' ); ?></p>
		<p>
      <?php if ( is_plugin_active( 'kirki/kirki.php' ) ) { ?>
				<span class="alpha-store-w-activated button"><?php esc_html_e( 'Kirki is already activated', 'alpha-store' ); ?></span>
			<?php	} else { ?>
				<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kirki' ), 'install-plugin_kirki' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Kirki Toolkit', 'alpha-store' ); ?></a>
		  <?php	} ?>
      <a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'alpha-store' ); ?></a>
    </p>

	</div>

	<hr />

	<div class="alpha-store-tab-pane-center">

		<h1><?php esc_html_e( 'FAQ', 'alpha-store' ); ?></h1>

	</div>
  <div class="alpha-store-video-tutorial">
    <div class="alpha-store-tab-pane-half alpha-store-tab-pane-first-half">
  		<h4><?php esc_html_e( 'Theme Setup - step by step', 'alpha-store' ); ?></h4>
      <p><?php esc_html_e( 'You can check our video tutorial how to setup the theme. This may help you to understand how the theme works and check if you miss something when you create your website.', 'alpha-store' ); ?></p>
  	  <p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/homepage-setup-alpha-store/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'alpha-store' ); ?></a></p>
    </div>
    <div class="alpha-store-tab-pane-half video">
      <p class="youtube">
			<a href="<?php echo esc_url( 'https://www.youtube.com/watch?v=eb8PrCVajiM' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Video tutorial on YouTube', 'alpha-store' ); ?></a>
  		</p>
    </div>
  </div>
  
	<div class="alpha-store-tab-pane-half alpha-store-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create unique homepage', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'In the below documentation you will find an easy way to build an unique homepage design.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/homepage-setup-alpha-store/#homepage-content' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'alpha-store' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'Dummy products', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'alpha-store' ); ?></a></p>
    
	</div>

	<div class="alpha-store-tab-pane-half">

		<h4><?php esc_html_e( 'Using Shortcodes', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'Shortcodes allow you to create Buy Now buttons, insert products into pages, display related products or featured products, and more.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/using-shortcodes/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'alpha-store' ); ?></a></p>

		<hr />
    
    <h4><?php esc_html_e( 'Create a child theme', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/how-to-create-a-child-theme/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', 'alpha-store' ); ?></a></p>
		
	</div>

	<div class="alpha-store-clear"></div>

	<hr />

	<div class="alpha-store-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'alpha-store' ); ?></h1>
		<p><?php printf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.', 'alpha-store' ), 'Alpha Store' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://demo.themes4wp.com/documentation/category/alpha-store/' ); ?>" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'alpha-store' ); ?></a></p>

	</div>

	<hr />

	<div class="alpha-store-tab-pane-center">
		<h1><?php esc_html_e( 'Recommended plugins', 'alpha-store' ); ?></h1>
	</div>

	<div class="alpha-store-tab-pane-half alpha-store-tab-pane-first-half">
		<!-- Kirki Toolkit -->
		<h4><?php esc_html_e( 'Kirki Toolkit', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'This theme uses Kirki toolkit plugin to customize theme. This plugin adds advanced features to the WordPress customizer. Install the plugin before you go to the customizer.', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'kirki/kirki.php' ) ) { ?>
			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kirki' ), 'install-plugin_kirki' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Kirki Toolkit', 'alpha-store' ); ?></a></p>
		<?php }	?>
    
		<hr />
    
		<!-- WooCommerce -->
		<h4><?php esc_html_e( 'WooCommerce', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'WooCommerce is a free eCommerce plugin that allows you to sell anything, beautifully. ', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'alpha-store' ); ?></a></p>
		<?php } ?>
    
		<hr />
    
    <!-- CMB2 -->
		<h4><?php esc_html_e( 'CMB2', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'Homepage template options.', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'cmb2/init.php' ) ) { ?>
			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php }	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=cmb2' ), 'install-plugin_cmb2' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install CMB2', 'alpha-store' ); ?></a></p>
		<?php } ?>
    
		<hr />
    
		<!-- YITH WooCommerce Wishlist -->
		<h4><?php esc_html_e( 'YITH WooCommerce Wishlist', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'Offer to your visitors a chance to add the products of your woocommerce store to a wishlist page', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) { ?>
				<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php } else { ?>
      <p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-wishlist' ), 'install-plugin_yith-woocommerce-wishlist' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Wishlist', 'alpha-store' ); ?></a></p>
  	<?php } ?>
    
		<hr />
    
	</div>

	<div class="alpha-store-tab-pane-half">
  
		<!-- YITH WooCommerce Compare -->
		<h4><?php esc_html_e( 'YITH WooCommerce Compare', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'YITH WooCommerce Compare plugin is an extension of WooCommerce plugin that allow your users to compare some products of your shop.', 'alpha-store' ); ?></p>
 		<?php if ( is_plugin_active( 'yith-woocommerce-compare/init.php' ) ) { ?>
 			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
    <?php } else { ?> 
 			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-compare' ), 'install-plugin_yith-woocommerce-compare' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Compare', 'alpha-store' ); ?></a></p>
 		<?php }	?>
    
		<hr />
    
		<!-- YITH WooCommerce Quick View -->
		<h4><?php esc_html_e( 'YITH WooCommerce Quick View', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'This plugin adds the possibility to have a quick preview of the products right from product list.', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) { ?>
			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php	}	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=yith-woocommerce-quick-view' ), 'install-plugin_yith-woocommerce-quick-view' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install YITH WooCommerce Quick View', 'alpha-store' ); ?></a></p>
		<?php	} ?>
    
		<hr />
    
		<!-- WooCommerce Shortcodes -->
		<h4><?php esc_html_e( 'WooCommerce Shortcodes', 'alpha-store' ); ?></h4>
		<p><?php esc_html_e( 'This plugin provides a TinyMCE dropdown button for you use all WooCommerce shortcodes.', 'alpha-store' ); ?></p>
		<?php if ( is_plugin_active( 'woocommerce-shortcodes/woocommerce-shortcodes.php' ) ) { ?>
			<p><span class="alpha-store-w-activated button"><?php esc_html_e( 'Already activated', 'alpha-store' ); ?></span></p>
		<?php	}	else { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce-shortcodes' ), 'install-plugin_woocommerce-shortcodes' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce Shortcodes', 'alpha-store' ); ?></a></p>
		<?php	} ?>
    
		<hr />

	</div>

	<div class="alpha-store-clear"></div>

</div>
