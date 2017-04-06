<?php get_header(); ?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>

<!-- start content container -->
<div class="row rsrc-content">

	<?php //left sidebar ?>
	<?php get_sidebar( 'left' ); ?>

	<div class="col-md-<?php alpha_store_main_content_width(); ?> rsrc-main">
		<div class="error-template text-center">
			<h1><?php esc_html_e( 'Oops!', 'alpha-store' ); ?></h1>
			<h2><?php esc_html_e( '404 Not Found', 'alpha-store' ); ?></h2>
			<div class="error-details">
				<p> <?php esc_html_e( 'Sorry, an error has occured, Requested page not found!', 'alpha-store' ); ?></p> 
			</div>
			<p>                                      
				<a class="btn btn-primary btn-md outline" href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                    <span class="fa fa-home"></span><?php esc_html_e( ' Take Me Home', 'alpha-store' ); ?> 
				</a>                                  
			</p> 
		</div>
	</div>

	<?php //get the right sidebar ?>
	<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>