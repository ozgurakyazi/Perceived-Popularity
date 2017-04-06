<div class="header-line-search col-md-7"> 
    <div class="top-infobox text-left">
		<?php if ( get_theme_mod( 'infobox-text', '' ) != '' ) {
			echo get_theme_mod( 'infobox-text' );
		} ?> 
    </div>              
    <div class="header-search-form">
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<select class="col-sm-4 col-xs-12" name="product_cat">
				<option value=""><?php echo esc_attr( __( 'All Categories', 'alpha-store' ) ); ?></option> 
				<?php
				$categories = get_categories( 'taxonomy=product_cat' );
				foreach ( $categories as $category ) {
					$option = '<option value="' . $category->category_nicename . '">';
					$option .= $category->cat_name;
					$option .= ' (' . $category->category_count . ')';
					$option .= '</option>';
					echo $option;
				}
				?>
			</select>
			<input type="hidden" name="post_type" value="product" />
			<input class="col-sm-8 col-xs-12" name="s" type="text" placeholder="<?php esc_attr_e( 'Search for products', 'alpha-store' ); ?>"/>
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
    </div>
</div>