<div class="pre-header">
	<div class="container">
		<?php
			$altHeader = ( get_theme_mod('savilerow_header_layout') === 'alternate1' ? true : false );

			function contacts_setup(){

				$altHeader = ( get_theme_mod('savilerow_header_layout') === 'alternate1' ? true : false );
				$addLink = "";
				$pullClass = "";
				if ( ! is_woocommerce_activated()) {
					$pullClass = "pull-right";
				}
				if( $altHeader ){

						if ( get_theme_mod( 'twitter' ) ) {
							$addLink .= '<li class="' . $pullClass . '"><a class="nav-social-btn twitter-icon" title="Twitter" href="' . esc_url( get_theme_mod( 'twitter' ) ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
						}
						if ( get_theme_mod( 'facebook' ) ){
							$addLink .= '<li class="' . $pullClass . '"><a class="nav-social-btn facebook-icon" title="Facebook" href="' . esc_url( get_theme_mod( 'facebook' ) ) . '" target="_blank"><i class="fa fa-facebook-square"></i></a></li>';
						}
						if ( get_theme_mod( 'googleplus' ) ){
							$addLink .= '<li class="' . $pullClass . '"><a class="nav-social-btn google-icon" title="Google+" href="' . esc_url( get_theme_mod( 'googleplus' ) ) . '" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>';
						}
				}

				return $addLink;

			}

			function secondary_nav_setup(){
				$wrap  = '<ul id="%1$s" class="%2$s">';
				$wrap .= '%3$s';
				$wrap .= contacts_setup();
				$wrap .= '</ul>';
				return $wrap;
			}

			if ( is_woocommerce_activated()) {
				$containerClass = 'header-links col-sm-9';
			}else{
				$containerClass = 'header-links';
			}

			$navSetup = array(
				'theme_location' 		=> 'secondary',
				'container_class' 	=> $containerClass,
				'items_wrap' 				=> secondary_nav_setup(),
			);

			if ( has_nav_menu( 'secondary' ) ) {

				wp_nav_menu( $navSetup );

				if ( is_woocommerce_activated()) {
					echo '<div class="col-sm-3"><ul class="top-bar-mini-cart">';
					do_action( 'savilerow_header_cart' );
					echo '</ul></div>';
				}

			}

		?>
	</div>
</div>
