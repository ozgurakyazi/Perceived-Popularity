<?php
/**
 * Actions required
 */
?>
<?php $counter = 0; ?>
<div id="actions_required" class="alpha-store-tab-pane">
  <h1><?php printf( esc_html__( 'Keep up with %s\'s recommended actions' ,'alpha-store' ), 'Alpha Store' ); ?></h1>
  <!-- NEWS -->
  <hr />  
	<!-- WooCommerce -->
  <?php if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
		<h3><?php esc_html_e( 'WooCommerce is not installed', 'alpha-store' ); ?></h3>
		<p><?php esc_html_e( 'In order to use shop features, you need to install and activate WooCommerce plugin.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'alpha-store' ); ?></a></p>
    <hr />
  <?php 
    $counter++; 
  } ?>
  <!-- Kirki -->
  <?php if ( !is_plugin_active( 'kirki/kirki.php' ) ) { ?>
		<h3><?php esc_html_e( 'Kirki Toolkit is not installed', 'alpha-store' ); ?></h3>
		<p><?php esc_html_e( 'This theme uses Kirki toolkit plugin to customize theme. This plugin adds advanced features to the WordPress customizer. Install the plugin before you go to the customizer.', 'alpha-store' ); ?></p>
		<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kirki' ), 'install-plugin_kirki' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Kirki Toolkit', 'alpha-store' ); ?></a></p>
    <hr />
  <?php 
    $counter++; 
  } ?>
  <!-- Front page -->
  <?php if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' && get_theme_mod( 'demo_front_page', 1 ) == 1 ) { ?>
		<h3><?php esc_html_e( 'Homepage demo is enabled', 'alpha-store' ); ?></h3>
		<p><?php esc_html_e( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. Then please go to Customize -> WooCommerce Homepage Demo and turn off the demo.', 'alpha-store' ); ?></p>
		<a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'alpha-store' ); ?></a>
    <hr />
  <?php
    $counter++; 
  } elseif ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' ) { ?>
    <h3><?php esc_html_e( 'Switch "Front page displays" to "A static page" ', 'alpha-store' ); ?></h3>
		<div class="two-three"><?php esc_html_e( 'If you want to create unique shop homepage, create the new page first, set the template "Homepage", add your own content and save the page. Then please go to Customize -> Static Front Page and switch "Front page displays" to "A static page" and select the page you created before.', 'alpha-store' ); ?>
      <p><a href="<?php echo wp_customize_url(); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'alpha-store' ); ?></a></p>
    </div>
    <div class="one-three">
      <a href="<?php echo get_template_directory_uri(); ?>/lib/welcome/img/alpha-store-front-page.jpg" target="_blank">
  			<img src="<?php echo get_template_directory_uri(); ?>/lib/welcome/img/alpha-store-front-page.jpg" width="225" height="152" />
  		</a>
    </div>
  <?php 
    $counter++; 
  } else { ?>
  <?php } ?>
  <?php	if( $counter == '0' ) { ?>
		<p><?php esc_html_e( 'Hooray! There are no recommended actions for you right now.', 'alpha-store' ); ?></p>
	<?php }	?>
  <div id="counter-count" data-counter="<?php echo absint($counter) ?>"></div>
</div>
