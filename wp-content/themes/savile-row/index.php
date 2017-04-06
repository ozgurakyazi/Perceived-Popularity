<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package savilerow
 * @since savilerow 1.0
 */

get_header(); ?>


<?php

	$mainWidth = 'col-sm-8';
	$noSidebar = false;
	$rightSidebar = true;
	$grid = false;
	$layoutOption = get_theme_mod('savilerow_blog_layout');

	if( $layoutOption == 'noSidebar' ){
		$mainWidth = 'col-1-1';
		$noSidebar = true;
	} elseif ( $layoutOption == 'leftSidebar' ) {
		$rightSidebar = false;
	} elseif ( $layoutOption == 'two-col' || $layoutOption == 'three-col' || $layoutOption == 'four-col' ){
		$mainWidth = $layoutOption;
		$noSidebar = true;
		$grid = true;
	}

?>


<div class="wrap">
    <div class="container">
      	<div class="row">
						<div id="content" class="site-content <?php echo($mainWidth); ?> <?php if( $noSidebar === false && $rightSidebar === false ) : ?>col-sm-push-4 <?php endif; ?>" role="main">

							<?php if( $grid === true): ?>
								<div id="masonry-loop" class="<?php echo $layoutOption; ?>">
							<?php endif; ?>

							<?php if ( have_posts() ) : ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to overload this in a child theme then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'content', get_post_format() );
									?>

								<?php endwhile; ?>

							<?php else : ?>

								<?php get_template_part( 'no-results', 'index' ); ?>

							<?php endif; ?>

							<?php if( $grid === true): ?>
								</div><!-- #masonry-loop -->
							<?php endif; ?>

							<?php

								// Previous/next page navigation.
								the_posts_pagination( array(
									'mid_size'			 => 2,
									'prev_text'          => __( 'Previous page', 'savile-row' ),
									'next_text'          => __( 'Next page', 'savile-row' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'savile-row' ) . ' </span>',
								) );

							?>

						</div><!-- .site-content -->

						<?php if( $noSidebar === false) : ?>

							<div class="sidebar col-sm-4 <?php if( $noSidebar === false && $rightSidebar === false ) : ?>sidebar-left col-sm-pull-8 <?php endif; ?>">
								<?php get_sidebar(); ?>
							</div>

						<?php endif; ?>

				</div>
		</div>
</div><!-- #wrap -->

<?php get_footer(); ?>
