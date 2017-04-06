<?php
/**
 * Welcome screen who are woo template
 */
?>
<hr />
<div id="who" class="feature-section col three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">

	<div class="col-1">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/TE-logo.png'; ?>" alt="<?php _e( 'The Woo Team', 'savile-row' ); ?>" class="image-50" width="220" />
		<h4><?php _e( 'Who are Template Express?', 'savile-row' ); ?></h4>
		<p><?php _e( 'Template Express are a small team of passionate WordPress enthusists who love producing themes that people are excited to use.', 'savile-row' ); ?></p>
		<p><?php echo sprintf( esc_html__('%sVisit Template Express%s', 'savile-row'), '<a href="http://www.templateexpress.com" class="button">', '</a>'); ?></p>
	</div>

	<div class="col-2">
		<h4><?php _e( 'Can\'t find a feature?', 'savile-row' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Please send any suggestions to our support email address %sSupport@templateexpress.com%s. We always want to improve our themes and your ideas help us achieve that.', 'savile-row' ), '<a href="mailto:support@templateexpress.com">', '</a>' ); ?></p>

	</div>

	<div class="col-3 last-feature">
		<h4><?php _e( 'Are you enjoying Savile Row?', 'savile-row' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Why not leave a review on %sWordPress.org%s? We\'d really appreciate it! :-)', 'savile-row' ), '<a href="https://wordpress.org/themes/savilerow">', '</a>' ); ?></p>
	</div>
	
</div>