<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package savilerow
 * @since savilerow 1.0
 */
get_header(); ?>

<?php 

	$mainWidth = 'col-sm-8';
	$noSidebar = false;
	$rightSidebar = true;
	$layoutSelection = get_theme_mod('savilerow_404_single_layout');

	if( $layoutSelection == 'noSidebar'){
		$mainWidth = 'col-1-1';
		$noSidebar = true;	
	} elseif ( $layoutSelection == 'leftSidebar') {
		$rightSidebar = false;
	}

?>

	<header class="entry-header">
	    <div class="container">
	    	<div class="row page-header">
	    		<div class="col-sm-6">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'savile-row' ); ?></h1>
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
					<h3><?php _e( 'It looks like nothing was found at this location.', 'savile-row' ); ?></h3>
					
					<?php if(get_theme_mod('show_helpful_links')): ?>
						<div id="helpfullinks">
						
							<?php get_search_form(); ?>
							<div class="row">
							<div class="col-md-6">
								<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
							</div>
							<div class="col-md-6">
								<div class="widget">
									<h1 class="widgettitle"><?php _e( 'Most Used Categories', 'savile-row' ); ?></h1>
									<ul>
									<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
									</ul>
								</div><!-- .widget -->
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<?php
									/* translators: %1$s: smilie */
									$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'savile-row' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
								?>
							</div>
							<div class="col-md-6">
								<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
							</div>
							</div>
						</div>
					<?php endif; ?>
					
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