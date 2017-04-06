jQuery(document).ready(function() {

  var counter = jQuery('#counter-count').data('counter');
  if ( counter != '0')  {  
    jQuery('li.alpha-store-w-red-tab a').append('<span class="alpha-store-actions-count">' + counter + '</span>');
  } else {
    jQuery('.alpha-store-tab').removeClass( 'alpha-store-w-red-tab' );
  }
	/* Tabs in welcome page */
	function alpha_store_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".alpha-store-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var alpha_store_actions_anchor = location.hash;

	if( (typeof alpha_store_actions_anchor !== 'undefined') && (alpha_store_actions_anchor != '') ) {
		alpha_store_welcome_page_tabs('a[href="'+ alpha_store_actions_anchor +'"]');
	}

    jQuery(".alpha-store-nav-tabs a").click(function(event) {
        event.preventDefault();
		alpha_store_welcome_page_tabs(this);
    });

 /* Tab Content height matches admin menu height for scrolling purpouses */
		$tab = jQuery('.alpha-store-tab-content > div');
		$admin_menu_height = jQuery('#adminmenu').height();
    if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
  {
		$newheight = $admin_menu_height - 180;
		$tab.css('min-height',$newheight);
  }
});
