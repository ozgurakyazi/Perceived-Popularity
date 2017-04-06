<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to savilerow_comment() which is
 * located in the functions.php file.
 *
 * @package savilerow
 * @since savilerow 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title">
			<?php
				printf( _n( 'One Comment', 'Comments (%1$s)', get_comments_number(), 'savile-row' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

			<nav id="comment-nav-above" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'savile-row' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'savile-row' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'savile-row' ) ); ?></div>
			</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->

		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use savilerow_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define savilerow_comment() and that will be used instead.
				 * See savilerow_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'savilerow_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

			<nav id="comment-nav-below" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'savile-row' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'savile-row' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'savile-row' ) ); ?></div>
			</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->

		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'savile-row' ); ?></p>
	<?php endif; ?>

	<?php

		$fields =  array(
		  'author' =>
		    '<div class="row"><div class="comment-form-author col-md-4">
		    	<label class="sr-only sr-only-focusable" for="author">' . __( 'Name', 'savile-row' ) . '</label>
		    	<input id="author" name="author" placeholder="' . __( 'Name (Required)', 'savile-row') . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" /></div>',

		  'email' =>
		    '<div class="comment-form-email col-md-4">
		    	<label class="sr-only sr-only-focusable" for="email">' . __( 'Email', 'savile-row' ) . '</label>
		    	<input id="email" name="email" placeholder="' . __( 'Email (Required)', 'savile-row' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div>',

		  'url' =>
		    '<div class="comment-form-url col-md-4">
		    	<label class="sr-only sr-only-focusable" for="url">' . __( 'Website', 'savile-row' ) . '</label>
		    	<input id="url" name="url" type="text" placeholder="' . __( 'URL', 'savile-row' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',

		);

		$args = array(
			'title_reply'			=> __('Leave a comment', 'savile-row'),
			'comment_notes_before' 	=> false,
			'comment_notes_after'	=> false,
		  	 'comment_field' 		=>
		    	'<div class="row"><div class="comment-form-comment col-md-12">
		    	<label class="sr-only sr-only-focusable" for="comment">' . __( 'Comment', 'savile-row' ) . '</label>
		    	<textarea id="comment" name="comment" placeholder="' . __( 'Your message', 'savile-row' ) . '" cols="45" rows="8" aria-required="true"></textarea></div></div>',
			'fields' 				=> apply_filters( 'comment_form_default_fields', $fields ),
		);

		comment_form($args);
	?>

</div><!-- #comments .comments-area -->
