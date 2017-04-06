<footer id="colophon" class="site-footer site-footer-none">
	
	<div class="site-footer-bottom-bar">
		
		<div class="site-container">
			
			<div class="site-footer-bottom-bar-left">
			
				<?php printf( __( 'Theme: %1$s by %2$s', 'sabino' ), __( 'Sabino', 'sabino' ), __( '<a href="https://kairaweb.com/">Kaira</a>', 'sabino' ) ); ?>
				
			</div>
                
	        <div class="site-footer-bottom-bar-right">
                
	            <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
                
                <?php get_template_part( '/templates/social-links' ); ?>
                
	        </div>
	        
	    </div>
		
        <div class="clearboth"></div>
	</div>
	
</footer>