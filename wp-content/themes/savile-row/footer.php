<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package savilerow
 * @since savilerow 1.0
 */
?>

</div><!-- #main .site-main -->

<footer id="colophon" class="site-footer">

	<?php if(! get_theme_mod('hide_footer_widgets')): ?>
		<div class="container">
			<div class="row">
				<div id="footer-widgets" class="col-12">
					<?php if ( is_active_sidebar( 'footer' ) && dynamic_sidebar('footer') ); ?>
				</div>
			</div>
		</div><!-- .container -->
	<?php endif; ?>

	<?php if(! get_theme_mod('hide_copyright')): ?>
		<div class="sub-footer">
		  <div class="site-info container">
					<div class="row">
			        <div class="col-sm-6 <?php if(is_rtl()): ?>pull-right<?php endif; ?>">
				        	<?php if(get_theme_mod('copyright_text')):

											$allowedTags = array(
			                  'a' => array(
			                      'href' => array(),
			                      'title' => array()
			                  ),
			                  'em' => array(),
			                  'strong' => array(),
				              );
				              $copyright = wp_kses(get_theme_mod('copyright_text'), $allowedTags);
				        		?>
					           <p><?php echo $copyright; ?></p>

					        <?php else: ?>

										<a href="<?php $my_theme = wp_get_theme(); echo $my_theme->get( 'ThemeURI' ); ?>">
					          <?php _e('Savile Row free ecommerce Wordpress Theme','savile-row'); ?></a>
					          <?php echo __( 'Powered By WordPress ', 'savile-row' ); ?>

					        <?php endif; ?>
					    </div>
					    <div class="col-sm-6">
				        	<?php
				        		$args = array(
				        			'theme_location' 	=> 'footer',
				        			'container_class' 	=> 'footer-nav',
				        		);

										if ( has_nav_menu( 'footer' ) ) {
						       		wp_nav_menu( $args );
										}
				        	?>
				      </div>
				  </div>
			</div>
		</div><!-- .sub-footer -->
	<?php endif; ?>

</footer><!-- #colophon .site-footer -->

<a href="#top" id="smoothup"><span class="fa fa-chevron-up"></span></a>

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
