<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Sabino
 */
?>
		<div class="clearboth"></div>
	</div><!-- #content -->
	
	<?php if ( get_theme_mod( 'sabino-footer-layout' ) == 'sabino-footer-layout-standard' ) : ?>

	    <?php get_template_part( '/templates/footer/footer-standard' ); ?>
	    
	<?php elseif ( get_theme_mod( 'sabino-footer-layout' ) == 'sabino-footer-layout-none' ) : ?>

	    <?php get_template_part( '/templates/footer/footer-none' ); ?>
	    
	<?php else : ?>
		
		<?php get_template_part( '/templates/footer/footer-social' ); ?>
	    
	<?php endif; ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
