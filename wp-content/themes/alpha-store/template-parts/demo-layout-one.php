<h2 class="text-center clear demo-categories">
  <?php esc_html_e( 'Our categories', 'alpha-store' ); ?>
</h2>
<hr />								
<?php echo do_shortcode( '[product_categories number="4" parent="0"]' ); ?>  								
<h2 class="text-center clear demo-products">
  <?php esc_html_e( 'Recent products', 'alpha-store' ); ?>
</h2>
<hr />								
<?php echo do_shortcode( '[recent_products per_page="8" columns="4"]' ); ?>