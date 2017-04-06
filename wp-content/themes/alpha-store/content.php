<article class="archive-article col-md-6" itemscope itemtype="http://schema.org/BlogPosting">
	<link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />
	<div <?php post_class(); ?>>                            
		<?php if ( has_post_thumbnail() ) : ?>                               
			<div class="featured-thumbnail" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
				<?php the_post_thumbnail( 'alpha-store-single', array( 'itemprop' => 'Url' ) ); ?>
				<?php 
				$sizes = get_post_thumbnail_id( $post->ID );
				$img = wp_get_attachment_image_src( $sizes, 'alpha-store-single' );
				$width = $img[1];
				$height = $img[2]; 
				?>
				<meta itemprop="width" content="<?php echo absint( $width ); ?> " />
				<meta itemprop="height" content="<?php echo absint( $height ); ?> " />
			</div>  
		<?php endif; ?>
		<header>
			<h2 class="page-header" itemprop="headline">                                
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>                            
			</h2>
			<?php get_template_part( 'template-parts/template-part', 'postmeta' ); ?>
		</header>  
		<div class="home-header text-center">                                                      
			<div class="entry-summary" itemprop="text">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->                                                                                                                       
			<div class="clear"></div>                                  
			<p>                                      
				<a class="btn btn-primary btn-md outline" href="<?php the_permalink(); ?>" itemprop="interactionCount">
					<?php esc_html_e( 'Read more', 'alpha-store' ); ?> 
				</a>                                  
			</p>                            
		</div>                      
	</div>
	<div class="clear"></div>
</article>