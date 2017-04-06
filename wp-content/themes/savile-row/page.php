<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package savilerow
 * @since savilerow 1.0
 */

get_header(); ?>

<?php

	$mainWidth = 'col-sm-8';
	$noSidebar = false;
	$rightSidebar = true;
	$layoutSelection = get_theme_mod('savilerow_page_single_layout');

	if( $layoutSelection == 'noSidebar'){
		$mainWidth = 'col-1-1';
		$noSidebar = true;
	} elseif ( $layoutSelection == 'leftSidebar') {
		$rightSidebar = false;
	}

	$isWoocommerce = false;
	if ( is_woocommerce_activated() && ( is_checkout() || is_cart() ) ) {
			$isWoocommerce = true;
	}

?>

<header class="entry-header">
  <div class="container">
  	<div class="row page-header">
  		<div class="col-sm-6">
				<h1 class="page-title"><?php the_title(); ?></h1>
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
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

						<?php if( ! $isWoocommerce ): savilerow_content_nav( 'nav-below' ); endif; ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
						?>

					<?php endwhile; // end of the loop. ?>
		   		</div>

				<?php if( $noSidebar === false) : ?>

					<div class="sidebar col-sm-4 <?php if( $rightSidebar === false ) : ?>sidebar-left col-sm-pull-8 <?php endif; ?>">
						<?php
								if( $isWoocommerce ){
									if( is_active_sidebar( 'woocommerce' ) ){
										get_sidebar( 'woocommerce' );
									}else{
										get_sidebar();
									}
								}else{
									get_sidebar();
								}
						?>
					</div>

				<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>
