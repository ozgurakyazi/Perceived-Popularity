<?php

/**

 * This template generates links to social media icons once set in the theme options.

 *

 * @package savilerow

 */
?>
<div class="social-links">
	<ul class="social-media">
		<?php if ( get_theme_mod( 'twitter' ) ) : ?>
			<li><a class="nav-social-btn twitter-icon" title="Twitter" href="<?php echo esc_url( get_theme_mod( 'twitter' ) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'facebook' ) ) : ?>
			<li><a class="nav-social-btn facebook-icon" title="Facebook" href="<?php echo esc_url( get_theme_mod( 'facebook' ) ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'googleplus' ) ) : ?>
			<li><a class="nav-social-btn google-icon" title="Google+" href="<?php echo esc_url( get_theme_mod( 'googleplus' ) ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
		<?php endif; ?>

		<?php if ( is_woocommerce_activated() && get_theme_mod('savilerow_header_layout') == 'alternate2') : ?>
			<?php do_action( 'savilerow_header_cart' ); ?>
		<?php endif; ?>
		<?php if(! get_theme_mod('savilerow_hide_search')): ?>
			<li class="search-toggle"><a href="#search-container" class="search-icon-toggle"><i class="fa fa-search"></i><span class="screen-reader-text">Search</span></a></li>
		<?php endif; ?>

	</ul><!-- #social-icons-->
</div>
