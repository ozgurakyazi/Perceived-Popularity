<?php
/**
 * Main function for creating the poll html representation.
 * Transforms the shortcode parameters to the desired iframe call.
 *
 * Syntax as follows:
 * shortcode name - OPINIONSTAGE_POLL_SHORTCODE
 *
 * Arguments:
 * @param  id - Id of the poll
 *
 */
function opinionstage_add_poll_or_set($atts) {
	extract(shortcode_atts(array('id' => 0, 'type' => 'poll', 'width' => ''), $atts));
	if(!is_feed()) {
		$id = intval($id);
		return opinionstage_create_poll_embed_code($id, $type, $width);
	} else {
		return __('Note: There is a poll embedded within this post, please visit the site to participate in this post\'s poll.', OPINIONSTAGE_WIDGET_UNIQUE_ID);
	}
}

/**
 * Main function for creating the widget html representation.
 * Transforms the shortcode parameters to the desired iframe call.
 *
 * Syntax as follows:
 * shortcode name - OPINIONSTAGE_WIDGET_SHORTCODE
 *
 * Arguments:
 * @param  path - Path of the widget
 *
 */
function opinionstage_add_widget($atts) {
	extract(shortcode_atts(array('path' => 0, 'comments' => 'true', 'sharing' => 'true', 'recommendations' => 'false', 'width' => ''), $atts));

	if(!is_feed()) {		
		return opinionstage_create_widget_embed_code($path, $comments, $sharing, $recommendations, $width);
	} else {
		return __('Note: There is a widget embedded within this post, please visit the site to participate in this post\'s widget.', OPINIONSTAGE_WIDGET_UNIQUE_ID);
	}
}


/**
 * Main function for creating the feed html representation.
 * Transforms the shortcode parameters to the desired embed code.
 *
 * Syntax as follows:
 * shortcode name - OPINIONSTAGE_FEED_SHORTCODE
 *
 * Arguments:
 * @param kind - Feed kind - top / mine
 *
 */
function opinionstage_add_feed($atts) {
	extract(shortcode_atts(array('kind' => 'top'), $atts));

	if(!is_feed()) {		
		return opinionstage_create_feed_embed_code($kind);
	} else {
		return __('Note: There is a quiz section embedded within this post, please visit the site to view this post\'s quiz section.', OPINIONSTAGE_WIDGET_UNIQUE_ID);
	}
}
/**
 * Main function for creating the placement html representation.
 * Transforms the shortcode parameters to the desired code.
 *
 * Syntax as follows:
 * shortcode name - OPINIONSTAGE_PLACEMENT_SHORTCODE
 *
 * Arguments:
 * @param  id - Id of the placement
 *
 */
function opinionstage_add_placement($atts) {
	extract(shortcode_atts(array('id' => 0), $atts));
	if(!is_feed()) {
		$id = intval($id);
		return opinionstage_create_placement_embed_code($id);
	} 
}
/**
 * Create the The iframe HTML Tag according to the given parameters.
 * Either get the embed code or embeds it directly in case 
 *
 * Arguments:
 * @param  id - Id of the poll
 */
function opinionstage_create_poll_embed_code($id, $type, $width) {
    
    // Only present if id is available 
    if (isset($id) && !empty($id)) {        		
		// Load embed code from the cache if possible
		$is_homepage = is_home();
		$transient_name = 'embed_code' . $id . '_' . $type . '_' . ($is_homepage ? "1" : "0") .'_' . $width;
		$code = get_transient($transient_name);
		if ( false === $code || '' === $code ) {
			if ($type == 'set') {
				$embed_code_url = "http://".OPINIONSTAGE_API_PATH."/sets/" . $id . "/code.json";			
			} else {
				$embed_code_url = "http://".OPINIONSTAGE_API_PATH."/polls/" . $id . "/code.json?width=".$width;
			}
			
			if ($is_homepage) {
				$embed_code_url .= "?h=1";
			}
		
			extract(opinionstage_get_contents($embed_code_url));
			$data = json_decode($raw_data);
			if ($success) {
				$code = $data->{'code'};			
				// Set the embed code to be cached for an hour
				set_transient($transient_name, $code, 3600);
			}
		}
    }
	return $code;
}
/**
 * Create the The iframe HTML Tag according to the given parameters.
 * Either get the embed code or embeds it directly in case 
 *
 * Arguments:
 * @param  path - Path of the widget
 */
function opinionstage_create_widget_embed_code($path, $comments, $sharing, $recommendations, $width) {
    
    // Only present if path is available 
    if (isset($path) && !empty($path)) {        		
		// Load embed code from the cache if possible
		$transient_name = 'embed_code' . $path . '.' . $comments . '.' . $sharing . $recommendations . $width;
		$code = get_transient($transient_name);
		if ( false === $code || '' === $code ) {
			$embed_code_url = "http://".OPINIONSTAGE_API_PATH."/widgets" . $path . "/code.json?comments=".$comments."&sharing=".$sharing."&recommendations=".$recommendations."&width=".$width;
			
			extract(opinionstage_get_contents($embed_code_url));
			$data = json_decode($raw_data);
			if ($success) {
				$code = $data->{'code'};			
				// Set the embed code to be cached for an hour
				set_transient($transient_name, $code, 3600);
			}
		}
    }
	return $code;
}

/**
 * Create the The HTML code Tag according to the given parameters.
 *
 * Arguments:
 * @param  kind - Kind of feed to embed (top content / my content)
 */
function opinionstage_create_feed_embed_code($kind) {
    
	// Load embed code from the cache if possible
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	$email = '';
	if ($kind == 'my' && !empty($os_options["email"])) {	
		$email = $os_options["email"];
		$transient_name = 'embed_code_feed_my';
	} else {
		$transient_name = 'embed_code_feed_top';
	}
	
	$code = get_transient($transient_name);

	if ( false === $code || '' === $code ) {
		$embed_code_url = "http://".OPINIONSTAGE_API_PATH."/feed/code.json?email=".$email;
		
		extract(opinionstage_get_contents($embed_code_url));
		$data = json_decode($raw_data);
		if ($success) {
			$code = $data->{'code'};			
			// Set the embed code to be cached for an hour
			set_transient($transient_name, $code, 3600);
		}
	}
	return $code;
}
/**
 * Returns the embed code of a placement by fetching it from Opinion Stage api
 */
function opinionstage_create_placement_embed_code($id) {
    
    // Only present if id is available 
    if (isset($id) && !empty($id)) {        		
		// Load embed code from the cache if possible
		$is_homepage = is_home();
		$transient_name = 'embed_code' . $id . '_' . 'placement';
		$code = get_transient($transient_name);
		if ( false === $code || '' === $code ) {
			$embed_code_url = "http://".OPINIONSTAGE_API_PATH."/placements/" . $id . "/code.json";
			extract(opinionstage_get_contents($embed_code_url));
			$data = json_decode($raw_data);
			if ($success) {
				$code = $data->{'code'};			
				// Set the embed code to be cached for an hour
				set_transient($transient_name, $code, 3600);
			}
		}
    }
	return $code;
}
/**
 * Utility function to create a link with the correct host and all the required information.
 */
function opinionstage_create_link($caption, $page, $params = "", $css_class = '') {
	$params_prefix = empty($params) ? "" : "&";	
	$link = "http://".OPINIONSTAGE_SERVER_BASE."/".$page."?" . "o=".OPINIONSTAGE_WIDGET_API_KEY.$params_prefix.$params;
	return "<a href=\"".$link."\" target='_blank' class=\"".$css_class."\">".$caption."</a>";
}

/**
 * CSS file loading
 */
function opinionstage_add_stylesheet() {
	// Respects SSL, Style.css is relative to the current file
	wp_register_style( 'opinionstage-style', plugins_url('opinionstage-style-common.css', __FILE__) );
	wp_register_style( 'opinionstage-font-style', plugins_url('opinionstage-font.css', __FILE__) );
	wp_enqueue_style( 'opinionstage-style' );
	wp_enqueue_style( 'opinionstage-font-style' );
}
/**
 * Generates a link for editing the flyout placement on Opinion Stage site
 */
function opinionstage_flyout_edit_url($tab) {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {	
		return 'http://'.OPINIONSTAGE_SERVER_BASE.'/registrations/new';
	}	
	return 'http://'.OPINIONSTAGE_SERVER_BASE.'/containers/'.$os_options['fly_id'].'/edit?selected_tab='.$tab;
}


/**
 * Generates a link for editing the article placement on Opinion Stage site
 */
function opinionstage_article_placement_edit_url($tab) {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {	
		return 'http://'.OPINIONSTAGE_SERVER_BASE.'/registrations/new';
	}	
	return 'http://'.OPINIONSTAGE_SERVER_BASE.'/containers/'.$os_options['article_placement_id'].'/edit?selected_tab='.$tab;
}
/**
 * Generates a link for editing the sidebar placement on Opinion Stage site
 */
function opinionstage_sidebar_placement_edit_url($tab) {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {	
		return 'http://'.OPINIONSTAGE_SERVER_BASE.'/registrations/new';
	}
	return 'http://'.OPINIONSTAGE_SERVER_BASE.'/containers/'.$os_options['sidebar_placement_id'].'/edit?selected_tab='.$tab;
}
/**
 * Generates a link for creating a poll
 */
function opinionstage_create_poll_link($css_class) {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {	
		return opinionstage_create_link(
			'CREATE',   // Text
			'new_poll', // path
			'',         // Args
			$css_class);
	} else {
		return opinionstage_create_link('CREATE', 'new_poll', '', $css_class);
	}	
}
/**
 * Generates a link for creating a trivia quiz
 */
function opinionstage_create_widget_link($w_type, $css_class) {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {	
		return opinionstage_create_link(
			'CREATE',          // Text 
			'widgets/new',     // Path
			'w_type='.$w_type, // Args
			$css_class);
	} else {
		return opinionstage_create_link('CREATE', 'widgets/new', 'w_type='.$w_type, $css_class);
	}	
}
/**
 * Generates a to the callback page used to connect the plugin to the Opinion Stage account
 */
function opinionstage_callback_url() {
	return get_admin_url('', '', 'admin') . 'admin.php?page='.OPINIONSTAGE_WIDGET_UNIQUE_ID.'/opinionstage-callback.php';
}

/**
 * Generates a link to Opinion Stage that requires registration
 */
function opinionstage_logged_in_link($text, $link) {
	return opinionstage_create_link($text, 'registrations/new', 'return_to='.$link);
}
/**
 * Perform an HTTP GET Call to retrieve the data for the required content.
 * 
 * Arguments:
 * @param $url
 * @return array - raw_data and a success flag
 */
function opinionstage_get_contents($url) {
    $response = wp_remote_get($url, array('header' => array('Accept' => 'application/json; charset=utf-8')));

    return opinionstage_parse_response($response);
}

/**
 * Parse the HTTP response and return the data and if was successful or not.
 */
function opinionstage_parse_response($response) {
    $success = false;
    $raw_data = "Unknown error";
    
    if (is_wp_error($response)) {
        $raw_data = $response->get_error_message();
    
    } elseif (!empty($response['response'])) {
        if ($response['response']['code'] != 200) {
            $raw_data = $response['response']['message'];
        } else {
            $success = true;
            $raw_data = $response['body'];
        }
    }
    
    return compact('raw_data', 'success');
}
/**
 * Take the received data and parse it
 * 
 * Returns the newly updated widgets parameters.
*/
function opinionstage_parse_client_data($raw_data) {
	$os_options = array('uid' => $raw_data['uid'], 
						   'email' => $raw_data['email'],
						   'fly_id' => $raw_data['fly_id'],
						   'article_placement_id' => $raw_data['article_placement_id'],
						   'sidebar_placement_id' => $raw_data['sidebar_placement_id'],
						   'version' => OPINIONSTAGE_WIDGET_VERSION,
						   'fly_out_active' => 'false',
						   'article_placement_active' => 'false',
						   'sidebar_placement_active' => 'false',
						   'token' => $raw_data['token']);
	$valid_ids = preg_match("/^[0-9]+$/", $raw_data['fly_id']) && preg_match("/^[0-9]+$/", $raw_data['article_placement_id']) &&  preg_match("/^[0-9]+$/", $raw_data['sidebar_placement_id']);
	if ($valid_ids) {
		update_option(OPINIONSTAGE_OPTIONS_KEY, $os_options);
	} 
}

?>