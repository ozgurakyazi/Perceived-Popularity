<?php

if ( get_option( 'show_on_front' ) == 'page' ) { // Display static front page if is set.

	include( get_page_template() );

} elseif ( class_exists( 'WooCommerce' ) && get_theme_mod( 'demo_front_page', 1 ) == 1 && !is_child_theme() ) { // Display demo homepage only if WooCommerce plugin is activated and demo enabled via customizer.

	get_header();

	get_template_part( 'template-parts/template-part', 'head' );

	?>

	<!-- start content container --> 
	<?php if ( get_theme_mod( 'front_page_demo_carousel', 1 ) == 1 ) { ?>
		</div> 
		<div class="top-area container-fluid">
			<div id="carousel-home" class="flexslider woocommerce loading-hide">
				<ul class="slides products">
					<?php
					$i = 1;
					$loop = new WP_Query( array(
						'post_type'		 => 'product',
						'posts_per_page' => 10,
						'orderby'		 => 'rand',
					) );
					while ( $loop->have_posts() ): $loop->the_post();
						global $product;
						?> 
						<li class="carousel-item c-item-<?php echo $i; ?> id-<?php echo get_the_ID(); ?>"> 
							<div class="flex-img">                    	           
								<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
								<div class="top-carousel-img">  
									<?php
									if ( has_post_thumbnail( $loop->post->ID ) ) {
										echo get_the_post_thumbnail( $loop->post->ID, 'alpha-store-carousel' );
									} else {
										echo '<img src="' . get_template_directory_uri() . '/img/carousel-img.png" alt="Placeholder" width="270px" height="' . absint( get_theme_mod( 'carousel-height', 423 ) ) . 'px" />';
									}
									?>
								</div>

								<div class="top-carousel-heading">
									<div class="top-carousel-title">
										<?php the_title(); ?>
									</div>
									<div class="price">
										<?php echo $product->get_price_html(); ?>
									</div>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>
								<div class="carousel-heading-hover">
									<div class="top-carousel-title-hover"><a href="<?php echo get_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
									<div class="top-carousel-excerpt">
										<?php
										$excerpt = strip_tags( get_the_excerpt() );
										echo $excerpt;
										?>
									</div>
									<div class="price-hover">
										<?php echo $product->get_price_html(); ?>
									</div>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>                                                                                  
							</div> 
						</li>      
						<?php
					$i++;
					endwhile;
					wp_reset_postdata();
					?>  
				</ul> 
			</div>   
		</div>
		<div class="container rsrc-container" role="main"> 
	<?php } ?>	
		<div class="row rsrc-content"> 	
			<?php if ( ! is_active_sidebar( 'alpha-store-home-sidebar' ) ) : ?>
				<aside id="sidebar-secondary" class="col-md-3 rsrc-left" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
					<?php
						the_widget( 'WC_Widget_Product_Search', 'title=Search', 'before_title=<h3 class="widget-title">&after_title=</h3>' );
						the_widget( 'WC_Widget_Product_Categories', 'title=Categories', 'before_title=<h3 class="widget-title">&after_title=</h3>' );
					?>
				</aside>
			<?php else : ?>
				<aside id="sidebar-secondary" class="col-md-3 rsrc-left" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
					<?php dynamic_sidebar( 'alpha-store-home-sidebar' ); ?>
				</aside>
			<?php endif; ?>
			<div class="col-md-9 rsrc-main">                                   
				<div <?php post_class( 'rsrc-post-content' ); ?>>                                                      
					<div class="entry-content">
						<?php
						$loop = new WP_Query( array(
							'post_type'	 => 'product',
						) );
						if ( $loop->have_posts() ) :
							if ( get_theme_mod( 'front_page_demo_style', 'style-one' ) == 'style-one' ) {
								get_template_part( 'template-parts/demo-layout', 'one' );
							} else { 
								get_template_part( 'template-parts/demo-layout', 'two' );	
							}
						else : ?>
							<p class="text-center">	
								<?php esc_html_e( 'No products found', 'alpha-store' ); ?>
							</p>
						<?php endif; ?>
					</div>                                                       
				</div>        
			</div>
		</div>
		<!-- end content container -->
		<?php get_footer(); ?>

		<?php
	} else { // Display blog posts.
		include( get_home_template() );
	}
