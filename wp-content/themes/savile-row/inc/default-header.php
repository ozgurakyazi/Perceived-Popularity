<?php
  /* Show top bar by default */
  if(get_theme_mod('savilerow_hide_top_nav') === false){
    get_template_part( 'inc/pre-header' );
  }

  // Show header image if exists
  if(get_header_image()){
    echo '<header id="masthead" class="site-header default-header hasImage header-background-image" style="background-image:url(' . get_header_image() . '); background-color:' . esc_attr(get_theme_mod('header_background_color')) . ';">';
  }else{
    echo '<header id="masthead" class="site-header default-header " style="background-color:' . esc_attr(get_theme_mod('header_background_color')) . ';">';
  }
?>
  <div class="container">
    <div class="row">
    <?php is_rtl() ?>
      <div class="col-sm-6 <?php if(is_rtl()): ?>pull-right<?php endif; ?>">
        <?php if ( get_theme_mod( 'savilerow_logo' ) ) : ?>

          <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'savilerow_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
          </div>

        <?php else : ?>

          <div class="site-introduction">
            <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <p class="site-description"><?php bloginfo( 'description' ); ?></p>
          </div>

        <?php endif; ?>
      </div>

      <div class="col-sm-6">
        <?php get_template_part( 'inc/socmed' ); ?>
      </div>
    </div>
  </div>
  <nav class="site-navigation main-navigation">
    <div class="container">
      <div class="row">
        <?php
          $navWidth = "col-sm-9";
          if( get_theme_mod('savilerow_hide_search') == true ){
            $navWidth = "col-sm-12";
          }
        ?>
        <div class="<?php echo $navWidth; ?> <?php if(is_rtl()): ?>pull-right<?php endif; ?>">
          <span class="nav-toggle assistive-text"><a href="#" title="<?php _e('Navigation Toggle', 'savile-row'); ?>"><?php _e( 'Menu', 'savile-row' ); ?></a></span>

          <div class="assistive-text skip-link">
            <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'savile-row' ); ?>"><?php _e( 'Skip to content', 'savile-row' ); ?></a>
          </div>

          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

        </div>

        <?php if( get_theme_mod('savilerow_hide_search') == false ): ?>
          <div class="col-sm-3">

            <form method="get" class="search-form" id="searchForm" action="<?php echo home_url( '/' ); ?>">

              <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" id="searchField" class="search-field" placeholder="Search..." value="" name="s" title="Search for:" />
              </label>

              <input type="submit" class="search-submit" value="Search" />

            </form>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </nav>

</header>
