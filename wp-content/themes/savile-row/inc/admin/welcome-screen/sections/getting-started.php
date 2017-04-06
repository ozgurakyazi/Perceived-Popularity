<?php
/**
 * Welcome screen getting started template
 */
?>
<?php
// get theme customizer url
$url 	= admin_url() . 'customize.php?';
$url 	.= '&return=' . urlencode( admin_url() . 'themes.php?page=savilerow-welcome' );
$url 	.= '&savilerow-customizer=true';
?>
<div id="getting_started" class="col two-col panel" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<h2><?php _e( 'Savile Row works for you', 'savile-row' ); ?> <div class="dashicons dashicons-admin-tools"></div></h2>
	<p><?php _e( 'We\'ve made Savile Row simple and enjoyable to configure. Below are some common theme-setup tasks:', 'savile-row' ); ?></p>

	<div class="col-1">
		<!-- WOOCOMMERCE -->
		<?php if ( ! is_woocommerce_activated() ) { ?>
			<h4><?php _e( 'Install WooCommerce <span class="dashicons dashicons-cart"></span>' ,'savile-row' ); ?></h4>
			<p><?php _e( 'Although Savile Row works fine as a standard WordPress theme, its really built to excel with WooCommerce. Install WooCommerce and start selling your products today.', 'savile-row' ); ?></p>

			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php _e( 'Install WooCommerce', 'savile-row' ); ?></a></p>
		<?php } else{ ?>
			<h4><?php _e( 'Using WooCommerce <span class="dashicons dashicons-cart"></span>' ,'savile-row' ); ?></h4>
			<p><?php echo sprintf( esc_html('%sView WooCommerce Documentation%s', 'savile-row' ), '<a href="http://docs.woothemes.com/documentation/plugins/woocommerce/" class="button">', '</a>');?></p>
		<?php } ?>

		<!-- MENUS -->
		<h4><?php _e( 'Configure menu locations <span class="dashicons dashicons-menu"></span>' ,'savile-row' ); ?></h4>
		<p><?php _e( 'Savile Row includes three menu locations for primary, secondary and footer navigation. The primary navigation is perfect for your key pages like the shop and product categories. The secondary navigation is suited to pages that don\'t merit primary standing but are higher priority than those in the footer navigation. The footer navigation is better suited to lower traffic pages such as terms and conditions.', 'savile-row' ); ?></p>
		<p><a href="<?php echo esc_url( self_admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php _e( 'Configure menus', 'savile-row' ); ?></a></p>

		<!-- CUSTOMIZER -->
		<h4><?php _e( 'Hundreds of options available <span class="dashicons dashicons-admin-generic"></span>' ,'savile-row' ); ?></h4>
		<p><?php _e( 'Using the WordPress Customizer you can change Savile Row\'s appearance to match your brand and create a unique look.', 'savile-row' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>" class="button"><?php _e( 'Open the Customizer', 'savile-row' ); ?></a></p>

	</div>

	<div class="col-2 last-feature">
	
		<!-- HOMEPAGE -->
		<h4><?php _e( 'Configure homepage template <span class="dashicons dashicons-admin-home"></span>', 'savile-row' ); ?></h4>
		<p><?php _e( 'Savile Row includes two homepage templates, one that displays features from your Woocommerce store and another designed for non Woocommerce use.', 'savile-row' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'To set these up you will need to create a new page and assign either the "Custom Homepage" or "Woocommerce Homepage" template to it. You can then set that as a static homepage in the %sReading%s settings.', 'savile-row' ), '<a href="' . esc_url( self_admin_url( 'options-reading.php' ) ) . '">', '</a>' ); ?></p>
		<p><?php echo sprintf( esc_html__( 'Once you set up the Woocommerce Homepage you can toggle and re-order the homepage components using the %sHomepage Control%s plugin.', 'savile-row' ), '<a href="https://wordpress.org/plugins/homepage-control/">', '</a>' ); ?></p>

		<?php if ( ! class_exists( 'Homepage_Control' ) ) { ?>
			<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=homepage-control' ), 'install-plugin_homepage-control' ) ); ?>" class="button button-primary"><?php _e( 'Install Homepage Control', 'savile-row' ); ?></a></p>
		<?php } ?>
		
		<!-- DOCUMENTATION -->
		<h4><?php _e( 'View documentation <span class="dashicons dashicons-welcome-learn-more"></span>', 'savile-row' ); ?></h4>
		<p><?php _e( 'You can read detailed information on Savile Rows features and how to develop on top of it in the documentation.', 'savile-row' ); ?></p>
		<p><?php echo sprintf( esc_html('%sView documentation%s', 'savile-row'), '<a href="http://www.templateexpress.com/savilerow/documentation" class="button">', '</a>'); ?></p>
		
	</div>
</div>
