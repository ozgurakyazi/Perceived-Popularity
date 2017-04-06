<?php
  /* Show top bar by default */
  if(get_theme_mod('savilerow_hide_top_nav') === false){
    get_template_part( 'inc/pre-header' );
  }

  // Show header image if exists
  if(get_header_image()){
    echo '<header id="masthead" class="site-header header-background-image" style="background-image:url(' . get_header_image() . '); background-color:' . esc_attr(get_theme_mod('header_background_color')) . ';">';
  }else{
    echo '<header id="masthead" class="site-header" style="background-color:' . esc_attr(get_theme_mod('header_background_color')) . ';">';
  }

?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12 alternate1">
        <?php if ( get_theme_mod( 'savilerow_logo' ) ) : ?>

          <div class="identity site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'savilerow_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
          </div>

        <?php else : ?>

          <div class="identity site-introduction">
            <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          </div>

        <?php endif; ?>
      </div>
    </div>
  </div>

  <nav class="site-navigation main-navigation alternate1">
    <div class="container">
      <div class="row">

        <div class="col-sm-12">
          <span class="nav-toggle assistive-text"><a href="#" title="<?php _e('Navigation Toggle', 'savile-row'); ?>"><?php _e( 'Menu', 'savile-row' ); ?></a></span>

          <div class="assistive-text skip-link">
            <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'savile-row' ); ?>"><?php _e( 'Skip to content', 'savile-row' ); ?></a>
          </div>

          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

        </div>

      </div>
    </div>
  </nav>

</header>
