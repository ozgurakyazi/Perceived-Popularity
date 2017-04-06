<?php
	
	/*
	 * Header contact Details
	 */	

	$list_contact_options = array(
		'telnumber'			=> __( 'Telephone Number', 'savile-row'),
		'mobile'			=> __( 'Mobile Number', 'savile-row'),
		'email'				=> __( 'Email Address', 'savile-row'),
		'address'			=> __( 'Address', 'savile-row'),
	);

	echo "<div class='topbar_content_left'>";

	foreach( $list_contact_options as $key => $value){
		if( get_theme_mod( $key . '_textbox_header_one' ) ){
			echo '<div class="contact">' . get_theme_mod( $key . '_textbox_header_one' ) . '</div>';
		}
	}

	echo "</div>";


	
