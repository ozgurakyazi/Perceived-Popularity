<?php
/**
 * Contribute
 */
?>

<div id="contribute" class="alpha-store-tab-pane">

	<h1><?php esc_html_e( 'How can I contribute?', 'alpha-store' ); ?></h1>

	<hr/>

	<div class="alpha-store-tab-pane-half alpha-store-tab-pane-first-half">

		<p><strong><?php esc_html_e( 'Found a bug? Want to contribute with a fix?','alpha-store'); ?></strong></p>

		<p><?php esc_html_e( 'Contact form is the place to go!','alpha-store' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'http://themes4wp.com/contact/' ); ?>" class="contribute-button button button-primary"><?php printf( esc_html__( '%s contact form', 'alpha-store' ), 'Alpha Store' ); ?></a>
		</p>

		<hr>

	</div>
	<div class="alpha-store-tab-pane-half">

		<p><strong><?php printf( esc_html__( 'Are you a polyglot? Want to translate %s into your own language?', 'alpha-store' ), 'Alpha Store' ); ?></strong></p>

		<p><?php esc_html_e( 'Get involved at WordPress.org.', 'alpha-store' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/alpha-store/' ); ?>" class="translate-button button button-primary"><?php printf( esc_html__( 'Translate %s', 'alpha-store' ), 'Alpha Store' ); ?></a>
		</p>

	</div>

	<div>

		<h4><?php printf( esc_html__( 'Are you enjoying %s?', 'alpha-store' ), 'Alpha Store' ); ?></h4>

		<p class="review-link"><?php printf( esc_html__( 'Rate our theme on %s. We\'d really appreciate it!', 'alpha-store' ), '<a href="https://wordpress.org/support/view/theme-reviews/alpha-store?filter=5">' . esc_html( 'WordPress.org', 'alpha-store' ) . '</a>' ); ?></p>

		<p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>

	</div>

</div>
