<?php if ( get_theme_mod( 'left-sidebar-check', 0 ) != 0 ) : ?>
	<aside id="sidebar-secondary" class="col-md-<?php echo get_theme_mod( 'left-sidebar-size', 3 ); ?> rsrc-left" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'alpha-store-left-sidebar' ); ?>
	</aside>
<?php endif; ?>