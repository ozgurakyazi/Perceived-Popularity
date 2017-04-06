<?php
/**
 * The template for displaying Search Results pages.
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
	$layoutSelection = get_theme_mod('savilerow_search_layout');

	if( $layoutSelection == 'noSidebar'){
		$mainWidth = 'col-1-1';
		$noSidebar = true;	
	} elseif ( $layoutSelection == 'leftSidebar') {
		$rightSidebar = false;
	} elseif ( $layoutSelection == 'two-col' || $layoutSelection == 'three-col' || $layoutSelection == 'four-col' ){
		$mainWidth = 'col-1-1';
		$noSidebar = true;
		$grid = true;
	}

?>

<header class="entry-header">
    <div class="container">
    	<div class="row page-header">
    		<div class="col-sm-6">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'savile-row' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</div>
			<div class="col-sm-6">
				<div class="breadcrumb-block">
					<?php if (function_exists('savilerow_breadcrumbs')) savilerow_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="wrap">
        <div class="container">
        	<div class="row">
				<div id="content" class="site-content <?php echo($mainWidth); ?> <?php if( $noSidebar === false && $rightSidebar === false ) : ?>col-sm-push-4 <?php endif; ?>" role="main">
					
					<?php if( $grid === true): ?>
						<div id="masonry-loop" class="<?php echo $layoutSelection; ?>">
					<?php endif; ?>

					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', 'search' );
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
						

				</div>
				<?php if( $noSidebar === false) : ?>

					<div class="sidebar col-sm-4 <?php if( $noSidebar === false && $rightSidebar === false ) : ?>sidebar-left col-sm-pull-8 <?php endif; ?>">
						<?php get_sidebar(); ?>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>