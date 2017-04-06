<?php
/**
 * Template Name: Full Width
 *
 */
get_header(); ?>

	<div id="primary" class="content-area content-area-full">
		<main id="main" class="site-main" role="main">
			
			<?php if ( !get_theme_mod( 'sabino-remove-page-titles' ) ) : ?>
				<?php get_template_part( '/templates/titlebar' ); ?>
			<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'templates/contents/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>