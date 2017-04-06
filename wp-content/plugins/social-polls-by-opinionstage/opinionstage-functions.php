<?php
/* --- Wordpress Hooks Implementations --- */

/**
 * Initialize the plugin 
 */
function opinionstage_init() {
	opinionstage_initialize_data();
	register_uninstall_hook(OPINIONSTAGE_WIDGET_UNIQUE_LOCATION, 'opinionstage_uninstall');
}

/**
 * Initialiaze the data options
 */
function opinionstage_initialize_data() {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	$os_options['version'] = OPINIONSTAGE_WIDGET_VERSION;
	
	// For backward compatibility
	if (!isset($os_options['sidebar_placement_active'])) {
		$os_options['sidebar_placement_active'] = 'false';
	}
	
	update_option(OPINIONSTAGE_OPTIONS_KEY, $os_options);
}

/**
 * Remove the plugin data
 */
function opinionstage_uninstall() {
    delete_option(OPINIONSTAGE_OPTIONS_KEY);
}

/**
 * Sidebar menu
 */
function opinionstage_poll_menu() {
	if (function_exists('add_menu_page')) {
		add_menu_page(__(OPINIONSTAGE_WIDGET_MENU_NAME, OPINIONSTAGE_WIDGET_UNIQUE_ID), __(OPINIONSTAGE_WIDGET_MENU_NAME, OPINIONSTAGE_WIDGET_MENU_NAME), 'edit_posts', OPINIONSTAGE_WIDGET_UNIQUE_LOCATION, 'opinionstage_add_poll_page', 
			plugins_url(OPINIONSTAGE_WIDGET_UNIQUE_ID.'/images/os.png'), '25.234323221');
		add_submenu_page(null, __('', OPINIONSTAGE_WIDGET_MENU_NAME), __('', OPINIONSTAGE_WIDGET_MENU_NAME), 'edit_posts', OPINIONSTAGE_WIDGET_UNIQUE_ID.'/opinionstage-callback.php');
	}
}

/**
 * Check if the requested plugin is already available
 */
function opinionstage_check_plugin_available($plugin_key) {
	$other_widget = (array) get_option($plugin_key); // Check the key of the other plugin

	// Check if OpinionStage plugin already installed.
	return (isset($other_widget['uid']) || 
		    isset($other_widget['email']));
}
/** 
 * Notify about other OpinionStage plugin already available
 */ 
function opinionstage_other_plugin_installed_warning() {
	echo "<div id='opinionstage-warning' class='error'><p><B>".__("Opinion Stage Plugin is already installed")."</B>".__(', please remove "<B>Popup for Interactive Content by Opinion Stage</B>" and use the available "<B>Poll & Quiz tools by Opinion Stage</B>" plugin')."</p></div>";
}

/**
 * Instructions page for adding a poll 
 */
function opinionstage_add_poll_page() {
	opinionstage_add_stylesheet();
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	if (empty($os_options["uid"])) {
		$first_time = true;
	} else {
		$first_time = false;
	}
	?>
	<script type='text/javascript'>
		jQuery(document).ready(function($) {
		    var callbackURL = "<?php echo opinionstage_callback_url()?>";
			var toggleSettingsAjax = function(currObject, action) {	
				$.post(ajaxurl, {action: action, activate: currObject.is(':checked')}, function(response) { });
			};
			var updatePageLink = function() {
				var page_id = $('select.os-page-select').val();
				var edit_url = "<?php echo admin_url()?>" + 'post.php?post=' + page_id +'&action=edit';
				$("a.os-edit-page").attr("href", edit_url);
			}
			$('#os-start-login').click(function(){
				var emailInput = $('#os-email');
				var email = $(emailInput).val();
				if (email == emailInput.data('watermark')) {
					email = "";
				}
				var new_location = "http://" + "<?php echo OPINIONSTAGE_LOGIN_PATH.'?o='.OPINIONSTAGE_WIDGET_API_KEY.'&callback=' ?>" + encodeURIComponent(callbackURL) + "&email=" + email;
				window.location = new_location;
			});
			
			$('#os-switch-email').click(function(){
				var new_location = "http://" + "<?php echo OPINIONSTAGE_LOGIN_PATH.'?o='.OPINIONSTAGE_WIDGET_API_KEY.'&callback=' ?>" + encodeURIComponent(callbackURL);
				window.location = new_location;
			});
			
			$('#os-email').keypress(function(e){
				if (e.keyCode == 13) {
					$('#os-start-login').click();
				}
			});

			$('#fly-out-switch').change(function(){
				toggleSettingsAjax($(this), "opinionstage_ajax_toggle_flyout");
			});

			$('#article-placement-switch').change(function(){
				toggleSettingsAjax($(this), "opinionstage_ajax_toggle_article_placement");
			});
			
			$('#sidebar-placement-switch').change(function(){
				toggleSettingsAjax($(this), "opinionstage_ajax_toggle_sidebar_placement");
			});
			$("input[name='os-section']").change(function(e){
				if ($('#feed_top_content').is(':checked')) {
					$('#os-section-shortcode').val('[os-section]');
				} else {
					$('#os-section-shortcode').val('[os-section kind="my"]');	
				}				
			});
			$('select.os-page-select').change(function() {
				updatePageLink();
			});
  		    $('#opinionstage-content').on('click', '#os-section-shortcode', function(e) {
				$(this).focus();
				$(this).select();
		    });
			
			updatePageLink();
		});
		
	</script>  
	<div id="opinionstage-content">
		<div id="opinionstage-frame">
			<div class="opinionstage-header-wrapper">				
				<div class="opinionstage-menu-wrapper">
					<div class="opinionstage-logo-wrapper">
						<div class="opinionstage-logo"></div>
					</div>				
				</div>				
				<div class="opinionstage-status-wrapper">
					<div class="opinionstage-status-content">
						<?php if($first_time) {?>
							<div class='opinionstage-status-title'>Connect WordPress with Opinion Stage to enable all features</div>
							<div class="os-icon icon-os-poll-client"></div>
							<input id="os-email" type="text" value="" class="watermark" data-watermark="Enter Your Email"/>
							<a href="javascript:void(0)" class="opinionstage-blue-btn" id="os-start-login">CONNECT</a>
						<?php } else { ?>
							<div class='opinionstage-status-title'><b>You are connected</b> to Opinion Stage with the following email</div>
							<div class="os-icon icon-os-form-success"></div>
							<label class="checked" for="user-email"></label>
							<input id="os-email" type="text" disabled="disabled" value="<?php echo($os_options["email"]) ?>"/>
							<a href="javascript:void(0)" id="os-switch-email" >Switch account</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="opinionstage-dashboard">
				<div class="opinionstage-dashboard-left">
					<div id="opinionstage-section-create" class="opinionstage-dashboard-section">
						<div class="opinionstage-section-header">
							<div class="opinionstage-section-title">Content</div>
							<?php if(!$first_time) {?>
								<a href="<?php echo 'http://'.OPINIONSTAGE_SERVER_BASE.'/dashboard/content'; ?>" target="_blank" class="opinionstage-section-action opinionstage-blue-bordered-btn">VIEW MY CONTENT</a>
							<?php } ?>
						</div>
						<div class="opinionstage-section-content">
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-polls"></div>
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">Poll</div>
									<div class="example">e.g. What's your favorite color?</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_poll_link('opinionstage-blue-btn'); ?>
								</div>																				
							</div>						
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-set"></div>
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">Survey</div>
									<div class="example">e.g. Help us improve our site</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_widget_link('survey', 'opinionstage-blue-btn'); ?>
								</div>																				
							</div>																			
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-trivia"></div>													
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">Trivia Quiz</div>
									<div class="example">e.g. How well do you know dogs?</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_widget_link('quiz', 'opinionstage-blue-btn'); ?>
								</div>																										
							</div>
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-personality"></div>													
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">Outcome Quiz</div>
									<div class="example">e.g. What's your most dominant trait?</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_widget_link('outcome', 'opinionstage-blue-btn'); ?>
								</div>																										
							</div>
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-list"></div>
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">Contact Form</div>
									<div class="example">e.g. Collect email addresses</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_widget_link('contact_form', 'opinionstage-blue-btn'); ?>
								</div>																										
							</div>						
							<div class="opinionstage-section-raw">
								<div class="opinionstage-section-cell opinionstage-icon-cell">
									<div class="os-icon icon-os-reports-list"></div>
								</div>						
								<div class="opinionstage-section-cell opinionstage-description-cell">
									<div class="title">List</div>
									<div class="example">e.g. Top 10 movies of all times</div>
								</div>													
								<div class="opinionstage-section-cell opinionstage-btn-cell">
									<?php echo opinionstage_create_widget_link('list', 'opinionstage-blue-btn'); ?>
								</div>																										
							</div>																				
						</div>						
					</div>				
				</div>			
				<div class="opinionstage-dashboard-right">
					<div id="opinionstage-section-placements" class="opinionstage-dashboard-section <?php echo($first_time ? "opinionstage-disabled-section" : "")?>">
						<div class="opinionstage-section-header">						
							<div class="opinionstage-section-title">Placements</div>
						</div>					
						<div class="opinionstage-section-content-wrapper">
							<div class="opinionstage-section-content">
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell opinionstage-toggle-cell">
										<div class="opinionstage-onoffswitch <?php echo($first_time ? "disabled" : "")?>">
											<input type="checkbox" name="fly-out-switch" class="opinionstage-onoffswitch-checkbox" <?php echo($first_time ? "disabled" : "")?> id="fly-out-switch" <?php echo(!$first_time && $os_options['fly_out_active'] == 'true' ? "checked" : "") ?>>
											<label class="opinionstage-onoffswitch-label" for="fly-out-switch">
												<div class="opinionstage-onoffswitch-inner"></div>
												<div class="opinionstage-onoffswitch-switch"></div>
											</label>
										</div>
									</div>						
									<div class="opinionstage-section-cell opinionstage-description-cell">
										<div class="title">Popup</div>
										<div class="example">Add a content popup to your site</div>
									</div>													
									<div class="opinionstage-section-cell opinionstage-btns-cell">
										<a href="<?php echo opinionstage_flyout_edit_url('content'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-content <?php echo($first_time ? "disabled" : "")?>' target="_blank">EDIT CONTENT</a>
										<a href="<?php echo opinionstage_flyout_edit_url('settings'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-settings <?php echo($first_time ? "disabled" : "")?>' target="_blank">
											<div class="os-icon icon-os-common-settings"></div>													
										</a>
									</div>																				
								</div>							
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell opinionstage-toggle-cell">
										<div class="opinionstage-onoffswitch <?php echo($first_time ? "disabled" : "")?>">
											<input type="checkbox" name="article-placement-switch" class="opinionstage-onoffswitch-checkbox" <?php echo($first_time ? "disabled" : "")?> id="article-placement-switch" <?php echo(!$first_time && $os_options['article_placement_active'] == 'true' ? "checked" : "") ?>>
											  <label class="opinionstage-onoffswitch-label" for="article-placement-switch">
												<div class="opinionstage-onoffswitch-inner"></div>
												<div class="opinionstage-onoffswitch-switch"></div>
											</label>
										</div>								
									</div>						
									<div class="opinionstage-section-cell opinionstage-description-cell">
										<div class="title">Article</div>
										<div class="example">Add a content section to all posts</div>
									</div>													
									<div class="opinionstage-section-cell opinionstage-btns-cell">
										<a href="<?php echo opinionstage_article_placement_edit_url('content'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-content <?php echo($first_time ? "disabled" : "")?>' target="_blank">EDIT CONTENT</a>
										<a href="<?php echo opinionstage_article_placement_edit_url('settings'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-settings <?php echo($first_time ? "disabled" : "")?>' target="_blank">
											<div class="os-icon icon-os-common-settings"></div>													
										</a>										
									</div>																				
								</div>																	
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell opinionstage-toggle-cell">
										<div class="opinionstage-onoffswitch <?php echo($first_time ? "disabled" : "")?>">
											<input type="checkbox" name="sidebar-placement-switch" class="opinionstage-onoffswitch-checkbox" <?php echo($first_time ? "disabled" : "")?> id="sidebar-placement-switch" <?php echo(!$first_time && $os_options['sidebar_placement_active'] == 'true' ? "checked" : "") ?>>
											  <label class="opinionstage-onoffswitch-label" for="sidebar-placement-switch">
												<div class="opinionstage-onoffswitch-inner"></div>
												<div class="opinionstage-onoffswitch-switch"></div>
											</label>
										</div>
									</div>						
									<div class="opinionstage-section-cell opinionstage-description-cell">
										<div class="title">Sidebar Widget</div>
										<div class="example">
											<?php if($first_time) {?>
												Add content to your sidebar
											<?php } else { ?>
												<div class="os-long-text">
													 <a href="<?php echo $url = get_admin_url('', '', 'admin') . 'widgets.php' ?>">Add widget to your sidebar</a>
												</div>											
											<?php } ?>										
										</div>
									</div>													
									<div class="opinionstage-section-cell opinionstage-btns-cell">
										<a href="<?php echo opinionstage_sidebar_placement_edit_url('content'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-content <?php echo($first_time ? "disabled" : "")?>' target="_blank">EDIT CONTENT</a>								
										<a href="<?php echo opinionstage_sidebar_placement_edit_url('settings'); ?>" class='opinionstage-blue-bordered-btn opinionstage-edit-settings <?php echo($first_time ? "disabled" : "")?>' target="_blank">
											<div class="os-icon icon-os-common-settings"></div>													
										</a>										
									</div>																				
								</div>
							</div>
						</div>
					</div>
				</div>				
				<div class="opinionstage-dashboard-left">
					<div id="opinionstage-section-help" class="opinionstage-dashboard-section">
						<div class="opinionstage-section-header">						
							<div class="opinionstage-section-title">Help</div>
						</div>					
						<div class="opinionstage-section-content-wrapper">
							<div class="opinionstage-section-content">
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell">	
										<a href="http://blog.opinionstage.com/how-to-add-interactive-content-on-wordpress/?o=wp35e8" target="_blank">How to use this plugin</a>
									</div>
								</div>
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell">	
										<?php echo opinionstage_create_link('Poll examples', 'showcase'); ?>
									</div>
								</div>
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell">	
										<?php echo opinionstage_create_link('Quiz/Survey examples', 'discover'); ?>
									</div>
								</div>				
								<div class="opinionstage-section-raw">
									<div class="opinionstage-section-cell">	
										<a href="https://opinionstage.zendesk.com/anonymous_requests/new" target="_blank">Contact Us</a>
									</div>
								</div>																				
							</div>
						</div>
					</div>				
				</div>				
			</div>
		</div>
	</div>
	<?php
}

/**
 * Load the js script
 */
function opinionstage_load_scripts() {
	wp_enqueue_script( 'ospolls', plugins_url(OPINIONSTAGE_WIDGET_UNIQUE_ID.'/opinionstage_plugin.js'), array( 'jquery', 'thickbox' ), '3' );
}

/**
 * Add the flyout embed code to the page header
 */
function opinionstage_add_flyout() {
	$os_options = (array) get_option(OPINIONSTAGE_OPTIONS_KEY);
	
	if (!empty($os_options['fly_id']) && $os_options['fly_out_active'] == 'true' && !is_admin() ) {
		// Will be added to the head of the page
		?>
		 <script type="text/javascript">//<![CDATA[
			window.AutoEngageSettings = {
			  id : '<?php echo $os_options['fly_id']; ?>'
			};
			(function(d, s, id){
			var js,
				fjs = d.getElementsByTagName(s)[0],
				p = (('https:' == d.location.protocol) ? 'https://' : 'http://'),
				r = Math.floor(new Date().getTime() / 1000000);
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id; js.async=1;
			js.src = p + '<?php echo OPINIONSTAGE_SERVER_BASE; ?>' + '/assets/autoengage.js?' + r;
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'os-jssdk'));
			
		//]]></script>
		
		<?php
	}
}

?>