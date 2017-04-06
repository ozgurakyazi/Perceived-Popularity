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
	$layoutSelection = get_theme_mod('savilerow_product_single_layout');

	if( $layoutSelection == 'noSidebar'){
		$mainWidth = 'col-1-1';
		$noSidebar = true;
	} elseif ( $layoutSelection == 'leftSidebar') {
		$rightSidebar = false;
	}

?>
<div class="wrap">
	<div class="container">
		<div class="row">
			<div id="content" class="site-content <?php echo($mainWidth); ?> <?php if( $noSidebar === false && $rightSidebar === false ) : ?>col-sm-push-4 <?php endif; ?>" role="main">
				<?php if ( have_posts() ) : ?>

					<?php
						if( is_product() ){
							do_action( 'savilerow_before_shop_loop_single' );
						}else{
							do_action( 'savilerow_before_shop_loop' );
						}
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						//do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								if( is_product() ){
									wc_get_template_part( 'content', 'single-product' );
								}else{
									wc_get_template_part( 'content', 'product' );
								}
							?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

				</div>

			<?php if( $noSidebar === false) : ?>

				<div class="sidebar col-sm-4 <?php if( $rightSidebar === false ) : ?>sidebar-left col-sm-pull-8 <?php endif; ?>">
					<?php
						if( is_active_sidebar( 'woocommerce' ) ){
							get_sidebar( 'woocommerce' );
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
