<?php
/**
 * The Template for displaying all single posts.
 *
 * @package savilerow
 * @since savilerow 1.0
 */

get_header();

$isWoocommerce = false;
if ( is_woocommerce_activated() ) {
	if( ! is_checkout() || ! is_cart() ){
			$isWoocommerce = true;
	}
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if( ! $isWoocommerce ): ?>
		<div class="entry-meta meta-single">

			<?php savilerow_posted_on_single(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><span class="fa fa-comments"></span><?php comments_popup_link( __( '0 comments', 'savile-row' ), __( '1 Comment', 'savile-row' ), __( '% Comments', 'savile-row' ) ); ?></span>
			<?php endif; ?>

		</div><!-- .entry-meta -->
	<?php endif; ?>

     <div class="blog-image">
		<?php
			if ( has_post_thumbnail() ) {
				$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'savile-row-featured' );
				echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
			}
		?>
    </div>

	<div class="entry-content">
		<?php the_content(); ?>

		<?php edit_post_link( __( 'Edit', 'savile-row' ), '<p><span class="edit-link"><span class="fa fa-pencil"></span> ', '</span></p>' ); ?>

		<?php if( ! $isWoocommerce ){
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'savile-row' ), 'after' => '</div>' ) );
					}
		?>
	</div><!-- .entry-content -->

	<?php if( ! $isWoocommerce ): ?>

		<footer>
			<?php

				$categories_list = get_the_category_list( __( ', ', 'savile-row' ) );
				$tags_list = get_the_tag_list( '', __( ', ', 'savile-row' ) );

				if( $categories_list || $tags_list ):
			?>
				<div class="single-footer-box">
					<div class="row">
						<div class="col-md-6">
							<?php
								if ( $categories_list && savilerow_categorized_blog() ) :
							?>
								<span class="cat-links">
									<span class="fa fa-folder-open"></span>
									<?php printf( __( '&nbsp;%1$s', 'savile-row' ), $categories_list ); ?>
								</span>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<?php
								if ( $tags_list ) :
							?>
								<span class="tag-links alignright">
									<span class="fa fa-tags"></span>
									<?php printf( __( '&nbsp;%1$s', 'savile-row' ), $tags_list ); ?>
								</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
				endif;
			?>

				<div class="single-footer-box">
		            <?php get_template_part('inc/author-bio'); ?>
				</div>

		</footer>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
