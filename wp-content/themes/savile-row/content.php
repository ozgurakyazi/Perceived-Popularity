<?php
/**
 * @package savilerow
 * @since savilerow 1.0
 */
?>

<?php

	$grid = false;
	$layoutOption = get_theme_mod('savilerow_blog_layout');

	if ( $layoutOption == 'two-col' || $layoutOption == 'three-col' || $layoutOption == 'four-col' ){
		$grid = true;
	}

?>
<?php if($grid): ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('animated'); ?> data-fx="fadeInUp">
<?php else: ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif; ?>


	<?php if( $grid === true): ?>
		<div class="masonry-entry">
	<?php endif; ?>

	<?php
		if ( has_post_thumbnail() ) : ?>
			<div class="blog-image">
				<a href="<?php the_permalink(); ?>">
				<?php
					add_thickbox();
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'savile-row-featured' );
					echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
				?>
				</a>
				<div class="image-overlay">
					<div class="image-overlay-inner">
						<div class="overlay-wrap">
							<a class="thickbox" href="<?php echo $large_image_url[0]; ?>" title="<?php _e('expand image', 'savile-row'); ?>"><span class="fa fa-arrows"></span></a>
							<a href="<?php the_permalink(); ?>" title="<?php _e('Full post', 'savile-row'); ?>"><span class="fa fa-link"></span></a>
						</div>
					</div>
				</div>
			</div>
	<?php
		endif;
	?>
    <?php if( $grid === true): ?>
		<div class="masonry-wrap">
	<?php endif; ?>
	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'savile-row' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">

			<?php savilerow_posted_on(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <span class="comments-link"><span class="fa fa-comments"></span><?php comments_popup_link( __( '0 Comments', 'savile-row' ), __( '1 Comment', 'savile-row' ), __( '% Comments', 'savile-row' ) ); ?></span>
            <?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'savile-row' ), '<span class="edit-link"><span class="fa fa-pencil"></span>', '</span>' ); ?>

		</div>

	</header>

	<?php if ( is_search() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content">
			<?php the_content( __( 'Read More', 'savile-row' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'savile-row' ), 'after' => '</div>' ) ); ?>
		</div>
	<?php endif; ?>

	<?php if( $grid === true): ?>
			</div>
		</div>
	<?php endif; ?>

</article>
