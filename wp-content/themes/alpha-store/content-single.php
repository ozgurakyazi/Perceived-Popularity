<!-- start content container -->
<div class="row rsrc-content">    
	<?php //left sidebar ?>    
	<?php get_sidebar( 'left' ); ?>    
	<article class="col-md-<?php alpha_store_main_content_width(); ?> rsrc-main" itemscope itemtype="http://schema.org/BlogPosting">
		<link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>         
				<?php alpha_store_breadcrumb(); ?>         
				<?php if ( has_post_thumbnail() ) : ?>                                
					<div class="single-thumbnail" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
						<?php the_post_thumbnail( 'full', array( 'itemprop' => 'Url' ) ); ?>
						<?php
						$sizes	 = get_post_thumbnail_id( $post->ID );
						$img	 = wp_get_attachment_image_src( $sizes, 'full' );
						$width	 = $img[1];
						$height	 = $img[2];
						?>
						<meta itemprop="width" content="<?php echo absint( $width ); ?> " />
						<meta itemprop="height" content="<?php echo absint( $height ); ?> " />
					</div>
					<div class="clear">
					</div>                            
				<?php endif; ?>          
				<div <?php post_class( 'rsrc-post-content' ); ?>>                            
					<header>                              
						<h1 class="entry-title page-header" itemprop="headline">
							<?php the_title(); ?>
						</h1>                              
						<?php get_template_part( 'template-parts/template-part', 'postmeta' ); ?>                            
					</header>                            
					<div class="entry-content" itemprop="articleBody">                              
						<?php the_content(); ?>                            
					</div>                               
					<?php wp_link_pages(); ?>
					<?php get_template_part( 'template-parts/template-part', 'posttags' ); ?>
					<div class="post-navigation row">
						<div class="post-previous col-md-6"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( 'Previous:', 'alpha-store' ) . '</span> %title' ); ?></div>
						<div class="post-next col-md-6"><?php next_post_link( '%link', '<span class="meta-nav">' . __( 'Next:', 'alpha-store' ) . '</span> %title' ); ?></div>
					</div> 
					<?php get_template_part( 'template-parts/template-part', 'related' ); ?>                             
					<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>                             
					<?php comments_template(); ?>                         
				</div>        
			<?php endwhile; ?>        
		<?php else: ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article>    
	<?php //get the right sidebar ?>    
	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->