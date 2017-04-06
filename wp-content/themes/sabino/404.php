<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Sabino
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				
				<div>
					<i class="fa fa-ban"></i>
				</div>
				
				<header class="page-header">
					<h3 class="page-title"><?php echo wp_kses_post( get_theme_mod( 'sabino-website-error-head', __( 'Oops! <span>404</span>', 'sabino' ) ) ); ?></h3>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>
                        <?php echo wp_kses_post( get_theme_mod( 'sabino-website-error-msg', __( 'It looks like that page does not exist. <br />Return home or try a search', 'sabino' ) ) ); ?>
					</p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
