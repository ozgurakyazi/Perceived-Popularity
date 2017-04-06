<?php
/**
 * Welcome screen intro template
 */
?>
<?php
$savilerow = wp_get_theme( 'savile-row' );

?>
<div class="col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
	<div class="col-1">
		<h1 style="margin-right: 0;"><?php echo '<strong>Savile Row</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $savilerow['Version'] ) . '</sup>'; ?></h1>

		<p style="font-size: 1.2em;"><?php _e( 'Excellent! You\'ve activated Savile Row, we hope you enjoy the theme.', 'savile-row' ); ?></p>
		<p><?php _e( 'Savile Row integrates well with WooCommerce core and has a flexible design we think you will love.', 'savile-row'); ?>
		</p><?php _e( 'If you would like to see any features added or want to report bug with this theme, send us an email at <a href="mailto:support@templateexpress.com">support@templateexpress.com</a>.', 'savile-row' ); ?>
	</div>

	<div class="col-2 last-feature">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="savilerow" class="image-50" width="440" />
	</div>
</div>