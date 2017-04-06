<footer class="site-footer">
	
	<div class="site-footer-icons">
        <div class="site-container">
            
            <?php
			if( get_theme_mod( 'sabino-social-email' ) ) :
			    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'sabino-social-email' ), 1 ) ) . '" title="' . esc_attr__( 'Send Us an Email', 'sabino' ) . '" class="footer-social-icon footer-social-email"><i class="fa fa-envelope-o"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-skype' ) ) :
			    echo '<a href="skype:' . esc_html( get_theme_mod( 'sabino-social-skype' ) ) . '?userinfo" title="' . esc_attr__( 'Contact Us on Skype', 'sabino' ) . '" class="footer-social-icon footer-social-skype"><i class="fa fa-skype"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-facebook' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-facebook' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Facebook', 'sabino' ) . '" class="footer-social-icon footer-social-facebook"><i class="fa fa-facebook"></i></a>';
			endif;
			
			if( get_theme_mod( 'sabino-social-twitter' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-twitter' ) ) . '" target="_blank" title="' . esc_attr__( 'Follow Us on Twitter', 'sabino' ) . '" class="footer-social-icon footer-social-twitter"><i class="fa fa-twitter"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-google-plus' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-google-plus' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Google Plus', 'sabino' ) . '" class="footer-social-icon footer-social-gplus"><i class="fa fa-google-plus"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-linkedin' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-linkedin' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on LinkedIn', 'sabino' ) . '" class="footer-social-icon footer-social-linkedin"><i class="fa fa-linkedin"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-tumblr' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-tumblr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Tumblr', 'sabino' ) . '" class="footer-social-icon footer-social-tumblr"><i class="fa fa-tumblr"></i></a>';
			endif;

			if( get_theme_mod( 'sabino-social-flickr' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-flickr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Flickr', 'sabino' ) . '" class="footer-social-icon footer-social-flickr"><i class="fa fa-flickr"></i></a>';
			endif; ?>
			
        	<div class="site-footer-ad">
        		<i class="fa fa-map-marker"></i> <?php echo wp_kses_post( get_theme_mod( 'sabino-website-site-add', __( 'Built in sunny Cape Town, South Africa', 'sabino' ) ) ) ?>
        	</div>
        	
        	<div class="site-footer-copy">
            	<?php printf( __( 'Theme: %1$s by %2$s', 'sabino' ), __( 'Sabino', 'sabino' ), __( '<a href="https://kairaweb.com/">Kaira</a>', 'sabino' ) ); ?>
            </div>
            
            <div class="clearboth"></div>
        </div>
    </div>
    
    <div class="site-footer-bottom-bar">

		<div class="site-container">
			
	        <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'depth'  => 1 ) ); ?>
	            
	    </div>
		
	    <div class="clearboth"></div>
	</div>
    
</footer>
