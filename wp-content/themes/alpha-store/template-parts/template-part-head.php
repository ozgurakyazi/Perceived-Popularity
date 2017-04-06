<div class="container-fluid rsrc-container-header">
	<?php
	if ( is_front_page() || is_home() || is_404() ) {
		$heading = 'h1';
		$desc	 = 'h2';
	} else {
		$heading = 'h2';
		$desc	 = 'h3';
	}
	?> 
	<div class="top-section row">
		<?php if ( class_exists( 'WooCommerce' ) && get_theme_mod( 'alpha_store_account', 1 ) == 1  || has_nav_menu( 'top_menu' ) || get_theme_mod( 'alpha_store_socials', 0 ) == 1 ) { ?>
			<div class="container">
				<?php // if ( has_nav_menu( 'top_menu' ) ) : ?>
					<div class="top-infobox-menu col-sm-6">
						<div class="rsrc-top-nav" >
							<nav id="site-navigation-top" class="navbar navbar-inverse" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">                       
								<div class="navbar-header row">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-2-collapse">
										<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'alpha-store' ); ?></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<div class="navbar-text visible-xs"><?php esc_html_e( 'Menu', 'alpha-store' ); ?></div>
								</div>   
								<?php
								wp_nav_menu( array(
									'theme_location'	 => 'top_menu',
									'depth'				 => 3,
									'container'			 => 'div',
									'container_class'	 => 'collapse navbar-collapse navbar-2-collapse',
									'menu_class'		 => 'nav navbar-nav',
									'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
									'walker'			 => new wp_bootstrap_navwalker() )
								);
								?>

							</nav>
						</div>
					</div>
				<?php // endif; ?>
				<div class="header-login text-right text-left-xs col-sm-6 no-gutter pull-right"> 
					<?php if ( get_theme_mod( 'alpha_store_account', 1 ) == 1 && class_exists( 'WooCommerce' ) ) { // Login Register  ?>
						<?php if ( is_user_logged_in() ) { ?>
							<?php $login_text = apply_filters('alpha_store_my_account', get_theme_mod( 'alpha_store_my_account_custom_text', '' ) ); if( !empty( $login_text ) ) : ?>
								<a class="login-link logged-in" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'My Account', 'alpha-store' ); ?>"><?php echo wp_kses_post($login_text) ?></a>
							<?php else : ?>
								<a class="login-link logged-in" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'My Account', 'alpha-store' ); ?>"><?php esc_html_e( 'My Account', 'alpha-store' ); ?></a>
							<?php endif; ?>
						<?php } else { ?>
							<?php if( get_theme_mod( 'alpha_store_login_custom_text', '' ) != '' ) : ?>
								<a class="login-link logged-out" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'Login / Register', 'alpha-store' ); ?>"><?php echo wp_kses_post( get_theme_mod( 'alpha_store_login_custom_text', '' ) ); ?></a>
							<?php else : ?>
								<a class="login-link logged-out" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'Login / Register', 'alpha-store' ); ?>"><?php esc_html_e( 'Login / Register', 'alpha-store' ); ?></a>
							<?php endif; ?>
						<?php } ?>
					<?php } ?>
					<?php if ( get_theme_mod( 'alpha_store_socials', 0 ) == 1 ) : ?>
						<?php alpha_store_social_links(); ?>
					<?php endif; ?>  
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="header-section row">
		<div class="container">
			<?php // Site title/logo ?>
			<header id="site-header" class="col-md-4 text-center-sm text-center-xs rsrc-header" itemscope itemtype="http://schema.org/Organization" role="banner"> 
				<?php if (function_exists( 'has_custom_logo' ) && has_custom_logo( ) ) : ?>
					<?php the_custom_logo( ); ?>
				<?php else : ?>
					<div class="rsrc-header-text">
						<<?php echo $heading ?> class="site-title" itemprop="name"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></<?php echo $heading ?>>
						<<?php echo $desc ?> class="site-desc" itemprop="description"><?php bloginfo( 'description' ); ?></<?php echo $desc ?>>
					</div>
				<?php endif; ?>   
			</header>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<div class="header-right col-md-8" >
					<?php get_template_part( 'template-parts/template-part', 'searchbar' ); ?>
					<?php // Shopping Cart ?>
					<?php if ( function_exists( 'alpha_store_header_cart' ) && ( get_theme_mod( 'cart-top-icon', 1 ) == 1 || get_theme_mod( 'wishlist-top-icon', 0 ) == 1 && function_exists( 'YITH_WCWL' ) ) ) {
						alpha_store_header_cart();
					} elseif( get_theme_mod( 'cart-banner', '' ) != '' ) { ?>
						<div class="header-cart text-center col-md-5 no-gutter header-banner">
							<?php echo wp_kses_post( get_theme_mod( 'cart-banner', '' ) ); ?>
						</div>	
					<?php } ?>
					<div class="header-right-triangle" ></div>
				</div>
			<?php endif; ?>
			<?php // if ( has_nav_menu( 'main_menu' ) ) : ?>
				<div class="rsrc-top-menu col-md-12 no-gutter">
					<nav id="site-navigation" class="navbar navbar-inverse" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	                    <div class="navbar-header">
	                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1-collapse">
	                            <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'alpha-store' ); ?></span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                        </button>
							<div class="navbar-text visible-xs"><?php esc_html_e( 'Menu', 'alpha-store' ); ?></div>
	                    </div>
						<?php
						wp_nav_menu( array(
							'theme_location'	 => 'main_menu',
							'depth'				 => 3,
							'container'			 => 'div',
							'container_class'	 => 'collapse navbar-collapse navbar-1-collapse',
							'menu_class'		 => 'nav navbar-nav',
							'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
							'walker'			 => new wp_bootstrap_navwalker() )
						);
						?>
					</nav>
				</div>
			<?php // endif; ?>
		</div> 
	</div>
</div>
<div class="container rsrc-container" role="main">   
