<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package savilerow
 * @since savilerow 1.0
 */

if ( ! function_exists( 'savilerow_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since savilerow 1.0
 */
function savilerow_content_nav( $nav_id ) {

	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
		<nav id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">

			<h1 class="assistive-text"><?php _e( 'Post navigation', 'savile-row' ); ?></h1>


			<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( 'Next', 'Next post link', 'savile-row' ) . '</span>' ); ?>
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( 'Prev', 'Previous post link', 'savile-row' ) . '</span>' ); ?>

		</nav>

	<?php
}
endif; // savilerow_content_nav

if ( ! function_exists( 'savilerow_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since savilerow 1.0
 */
function savilerow_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'savile-row' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'savile-row' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<?php

				// var_dump($comment);
				$userId = $comment->user_id;

				$alternateImg = get_the_author_meta( 'alternate_image', $userId );

				// var_dump($alternateImg);

				// var_dump(get_avatar( $comment, 120 ));

				if($alternateImg){
					echo '<img class="avatar avatar-120 photo" src="'.$alternateImg.'" alt="'.$comment->comment_author.' profile photo" width="120" height="120"/>';
				}else{
					echo get_avatar( $comment, 120 );
				}
			?>
			<header>
				<div class="comment-author vcard">
					<?php printf( __( '%s', 'savile-row' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s', 'savile-row' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '&nbsp;<span class="fa fa-pencil"></span> Edit', 'savile-row' ), ' ' );
					?>
				</div>
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span><!-- .reply -->
			</header>

			<footer>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'savile-row' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

			</footer>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for savilerow_comment()

if ( ! function_exists( 'savilerow_posted_on' ) ) :
/**
 * Prints HTML with meta in savilerow for the current post-date/time and author.
 *
 * @since savilerow 1.0
 */
function savilerow_posted_on() {
	printf( __( ' <span class="pub-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span><span class="byline"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'savile-row' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'savile-row' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

if ( ! function_exists( 'savilerow_posted_on_single' ) ) :
/**
 * Prints HTML with meta in savilerow for the current post-date/time and author.
 *
 * @since savilerow 1.0
 */
function savilerow_posted_on_single() {
	printf( __( ' <span class="pub-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span><span class="byline"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'savile-row' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'savile-row' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since savilerow 1.0
 */
function savilerow_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so savilerow_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so savilerow_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in savilerow_categorized_blog
 *
 * @since savilerow 1.0
 */
function savilerow_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'savilerow_category_transient_flusher' );
add_action( 'save_post', 'savilerow_category_transient_flusher' );


if ( ! function_exists( 'savilerow_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return  void
	 */
	function savilerow_homepage_content() {
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'page' );

		endwhile; // end of the loop.
	}
}

if ( ! function_exists( 'savilerow_product_categories' ) ) {
	/**
	 * Display Product Categories
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return void
	 */
	function savilerow_product_categories( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'savilerow_product_categories_args', array(
				'limit' 			=> 3,
				'columns' 			=> 3,
				'child_categories' 	=> 0,
				'orderby' 			=> 'name',
				'title'				=> __( 'Product Categories', 'savile-row' ),
				) );

			echo '<section class="container product-section savilerow-product-section savilerow-product-categories">';

				do_action( 'savilerow_homepage_before_product_categories' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				echo do_shortcode_func( 'product_categories',
					array(
						'number' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						'orderby'	=> esc_attr( $args['orderby'] ),
						'parent'	=> esc_attr( $args['child_categories'] ),
						) );

				do_action( 'savilerow_homepage_after_product_categories' );

			echo '</section>';

		}
	}
}
if ( ! function_exists( 'savilerow_recent_products' ) ) {
	/**
	 * Display Recent Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return void
	 */
	function savilerow_recent_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'savilerow_recent_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'Recent Products', 'savile-row' ),
				) );

			echo '<section class="container product-section savilerow-product-section savilerow-recent-products">';

				do_action( 'savilerow_homepage_before_recent_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				echo do_shortcode_func( 'recent_products',
					array(
						'per_page' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						) );

				do_action( 'savilerow_homepage_after_recent_products' );

			echo '</section>';
		}
	}
}

if ( ! function_exists( 'savilerow_featured_products' ) ) {
	/**
	 * Display Featured Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return void
	 */
	function savilerow_featured_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'savilerow_featured_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'orderby'			=> 'date',
				'order'				=> 'desc',
				'title'				=> __( 'Featured Products', 'savile-row' ),
				) );

			echo '<section class="container product-section savilerow-product-section savilerow-featured-products">';

				do_action( 'savilerow_homepage_before_featured_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				echo do_shortcode_func( 'featured_products',
					array(
						'per_page' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						'orderby'	=> esc_attr( $args['orderby'] ),
						'order'		=> esc_attr( $args['order'] ),
						) );

				do_action( 'savilerow_homepage_after_featured_products' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'savilerow_popular_products' ) ) {
	/**
	 * Display Popular Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return void
	 */
	function savilerow_popular_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'savilerow_popular_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'Top Rated Products', 'savile-row' ),
				) );

			echo '<section class="container product-section savilerow-product-section savilerow-popular-products">';

				do_action( 'savilerow_homepage_before_popular_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				echo do_shortcode_func( 'top_rated_products',
					array(
						'per_page' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						) );

				do_action( 'savilerow_homepage_after_popular_products' );

			echo '</section>';

		}
	}
}

if ( ! function_exists( 'savilerow_on_sale_products' ) ) {
	/**
	 * Display On Sale Products
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 * @return void
	 */
	function savilerow_on_sale_products( $args ) {

		if ( is_woocommerce_activated() ) {

			$args = apply_filters( 'savilerow_on_sale_products_args', array(
				'limit' 			=> 4,
				'columns' 			=> 4,
				'title'				=> __( 'On Sale', 'savile-row' ),
				) );

			echo '<section class="container product-section savilerow-product-section savilerow-on-sale-products">';

				do_action( 'savilerow_homepage_before_on_sale_products' );

				echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

				echo do_shortcode_func( 'sale_products',
					array(
						'per_page' 	=> intval( $args['limit'] ),
						'columns'	=> intval( $args['columns'] ),
						) );

				do_action( 'savilerow_homepage_after_on_sale_products' );

			echo '</section>';

		}
	}
}


if ( ! function_exists( 'savilerow_hero_section' ) ) {
	/**
	 * Display Hero Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	 function savilerow_hero_section() {
		?>
			<section class="hero" style="background-image:url(<?php echo get_theme_mod('savilerow_hero_image'); ?>);">
				<div class="container">
					<div class="hero-container">
						<h1 class="section-title"><?php if(get_theme_mod('savilerow_hero_title')) { echo esc_html(get_theme_mod('savilerow_hero_title')); } else { _e('a touch of class', 'savile-row'); } ?></h1>
						<p><?php if( get_theme_mod('savilerow_hero_tagline') ){ echo esc_html(get_theme_mod('savilerow_hero_tagline')); } else { _e('Enjoy free shipping on all orders', 'savile-row');} ?></p>
						<div class="cta">
							<a class="btn" href="<?php echo esc_attr(get_theme_mod('savilerow_hero_url')); ?>"><?php if( get_theme_mod('savilerow_hero_button_text') ){ echo esc_html(get_theme_mod('savilerow_hero_button_text')); } else { _e('Shop Now', 'savile-row'); }  ?></a>
						</div>
					</div>
				</div>
			</section>
		<?php
	 }
}


if ( ! function_exists( 'savilerow_flexslider_section' ) ) {
	/**
	 * Display Flexslider Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	function savilerow_flexslider_section(){

		$fullWidth      =   false;
		$featured_cat   =   get_theme_mod( 'homepage_slider_cat' );
		$number         =   get_theme_mod( 'homepage_slider_slide_no' );
		$fullWidth		=	get_theme_mod( 'homepage_slider_fullwidth' );
		$the_query     =   new WP_Query( array(
			'cat'             => $featured_cat,
			'posts_per_page'  => $number,
			'meta_query'      => array(
				array(
				  'key'           => '_thumbnail_id',
				  'compare'       => 'EXISTS',
				),
			),
		));
		?>
		<?php if(! $fullWidth ): ?>
			<div class="container">
		<?php endif; ?>
			<div class="flex-container <?php if( $fullWidth ): ?>fullWidth<?php endif; ?>">
              <div class="flexslider">
                <ul class="slides">
                  <?php  while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                    <li>
                      <?php the_post_thumbnail( 'savile-row-featured' ); ?>
                      <div class="caption_wrap">
                        <div class="flex-caption">
                          <div class="flex-caption-title">
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                          </div>
                          <p><?php echo esc_html(get_slider_excerpt()); ?> <a href="<?php the_permalink() ?>">...</a></p>
                        </div>
                      </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </div>
            </div>
        <?php if(! $fullWidth ): ?>
			</div>
		<?php endif; ?>
		<?php

	}// end function

}// end if function


if ( ! function_exists( 'savilerow_featured_section' ) ) {
	/**
	 * Display Service Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	function savilerow_featured_section(){
	?>
		<div class="container">
            <div class="row featured-section">

	            <h2 class="animated" data-fx="fadeInUp"><?php if(get_theme_mod('homepage_service_title')){ echo esc_html(get_theme_mod('homepage_service_title')); } else { _e('Featured Section', 'savile-row'); }?></h2>

	            <div class="unity-separator"></div>

				<?php
					// Get pages set in the customizer (if any)
					$pages = array();
					for ( $count = 1; $count <= 5; $count++ ) {
						$mod = get_theme_mod( 'featured-page-' . $count );
						if ( 'page-none-selected' != $mod ) {
							$pages[] = $mod;
						}
					}
					$args = array(
						'posts_per_page' => 5,
						'post_type' => 'page',
						'post__in' => $pages,
						'orderby' => 'post__in'
					);
					$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
							$count = 1;
							while ( $query->have_posts() ) : $query->the_post();
						?>

						
						<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-4 animated box-' . $count ); ?> class="col-sm-4 col-sm-4 box-1 animated" data-fx="fadeInUp">
				            <div class="featured-content">
				            	<?php the_post_thumbnail( 'savile-row-featured' ); ?> 
				            	<div class="overlay">
					                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
					                <?php the_excerpt(); ?>
					              </div>
							</div>
						
						</div><!-- #post-## -->

					<?php
					$count++;
					endwhile;
				else :
					if ( current_user_can( 'customize' ) ) { ?>
						<div class="message">
							<p><?php _e( 'There are no pages available to display.', 'savile-row' ); ?></p>
							<p><?php printf(
								__( 'These pages can be set in the <a href="%s">customizer</a>.', 'savile-row' ),
								admin_url( 'customize.php?autofocus[control]=showcase' )
							); ?>
							</p>
						</div>
					<?php }
				endif;
				?>
          	</div>
        </div><!-- .container -->

	<?php

	}// end function

}// end if function


if ( ! function_exists( 'savilerow_promobar_section' ) ) {
	/**
	 * Display Promotional Bar Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	function savilerow_promobar_section(){

		?>

			<div class="promo-bar">
	          <div class="container">
	            <div class="row">
	              <div class="col-sm-8 col-md-12">
	                <h2 class="animated" data-fx="<?php if(is_rtl()): ?>slideInRight<?php else: ?>slideInLeft<?php endif; ?>"><?php if( get_theme_mod( 'featured_textbox' ) ){ echo esc_html(get_theme_mod( 'featured_textbox' ) ); } else { _e( 'Promotional Bar', 'savile-row' ); } ?></h2>
	              	<a class="btn_block animated" data-fx="<?php if(is_rtl()): ?>slideInLeft<?php else: ?>slideInRight<?php endif; ?>" href="<?php echo esc_url( get_theme_mod( 'featured_button_url' ) ); ?>" ><?php if( get_theme_mod( 'featured_button_txt' ) ){ echo esc_html(get_theme_mod( 'featured_button_txt' )); } else { _e( 'Find out more', 'savile-row' );}  ?></a>
	              </div>
	            </div>
	          </div>
	        </div>

		<?php
	}
}

if ( ! function_exists( 'savilerow_recent_posts_section' ) ) {
	/**
	 * Display Recent Posts Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	function savilerow_recent_posts_section(){

		?>

		<div class="container">
          <div class="recent-posts">

            <h2 class="animated" data-fx="fadeInUp"><?php if(get_theme_mod('homepage_recent_title')){ echo esc_html(get_theme_mod('homepage_recent_title')); } else { _e('Recent Posts', 'savile-row'); }?></h2>

            <?php $the_query = new WP_Query(
              array(
                'showposts'     => 4,
                'post__not_in'  => get_option("sticky_posts"),
                'category__in'  => get_theme_mod('recent_posts_category'),
              ));
            ?>
            <?php $classNumber = 1; ?>
            <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

              <div class="col-sm-6 col-md-3 animated _<?php echo $classNumber; ?>" data-fx="fadeInUp">
                <article class="recent">
                  <div class="view third-effect blog-image">
                    <?php
                      if ( has_post_thumbnail() ) {
                        add_thickbox();
                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'savile-row-recent' );
                        echo '<img alt="post" class="imagerct" src="' . $image_src[0] . '">';
                      }
                    ?>
                    <div class="image-overlay">
                      <div class="image-overlay-inner">
                        <div class="overlay-wrap">
                          <a class="thickbox" href="<?php echo $large_image_url[0]; ?>" title="<?php _e('expand image', 'savile-row'); ?>"><span class="fa fa-arrows"></span></a>
                          <a href="<?php the_permalink(); ?>" title="<?php _e('Full post', 'savile-row'); ?>"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="recent_title">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html(get_slider_excerpt()); ?></div>
                </article>
              </div>
              <?php $classNumber++; ?>
            <?php endwhile; ?>

          </div>
        </div>

	<?php
	}
}

if ( ! function_exists( 'savilerow_partners_section' ) ) {
	/**
	 * Display Partners Section
	 * Hooked into the `homepage` action in the homepage template
	 * @since  0.1
	 */
	function savilerow_partners_section(){

		?>

		  <div class="container">

			  <div class="partners-section">
				<div class="partner">

				  <h2 class="animated" data-fx="fadeInUp"><?php if(get_theme_mod('homepage_partners_title')){ echo esc_html( get_theme_mod( 'homepage_partners_title' ) ); } else { _e('Partners', 'savile-row'); } ?></h2>

				  <?php
					  $list_partners = array( // 1
						'one'       => __( '1', 'savile-row' ),
						'two'       => __( '2', 'savile-row' ),
						'three'     => __( '3', 'savile-row' ),
						'four'      => __( '4', 'savile-row' ),
						'five'      => __( '5', 'savile-row' ),
						'six'       => __( '6', 'savile-row' ),
					  );

					  foreach ($list_partners as $key => $value){
						?>

						  <div class="col-xs-6 col-sm-4 col-md-2 animated _<?php echo esc_attr($value); ?>" data-fx="fadeInUp">
							<div class="partner_recent">
							  <?php if ( get_theme_mod( 'logo-' . esc_attr($key) . '-file-upload' ) ) : ?>
								<a href="<?php echo esc_url( get_theme_mod( 'logo_' .  $key . '_url' ) ); ?>">
								  <img src="<?php echo esc_url( get_theme_mod( 'logo-' . $key . '-file-upload' ) ); ?>"  alt="logo <?php echo esc_attr($key); ?>">
								</a>
							  <?php endif; ?>
							</div>
						  </div>

						<?php
					  }
					?>

				</div>
			  </div>

		  </div>

		<?php
	}// End savilerow_partners_section()

}// End IF savilerow_partners_section()


/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'savilerow_header_cart' ) ) {
	function savilerow_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php savilerow_cart_link(); ?>
			</li>
		</ul>
		<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		<?php
		}
	}
}
/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'savilerow_mini_cart' ) ) {
	function savilerow_mini_cart() {
		if( is_woocommerce_activated() ){
		?>
			<li class="cart-link">
				<?php savilerow_cart_link(); ?>
				<?php
					if ( is_woocommerce_activated() ) {
						the_widget( 'WC_Widget_Cart', 'title=' );
					}
				?>
			</li>
		<?php
		}
	}
}

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'savilerow_cart_link' ) ) {
	function savilerow_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'savile-row' ); ?>">
				<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="amount"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'savile-row' ), WC()->cart->get_cart_contents_count() ) );?></span>
				<i class="fa fa-shopping-cart"></i>
			</a>
		<?php
	}
}
