/**
 * Customizer Custom Functionality
 *
 */
( function( $ ) {
    
    $( window ).load( function() {
        
        // Show / Hide Color selector for slider setting
        var the_slider_select_value = $( '#customize-control-sabino-slider-type select' ).val();
        sabino_customizer_slider_check( the_slider_select_value );
        
        $( '#customize-control-sabino-slider-type select' ).on( 'change', function() {
            var slider_select_value = $( this ).val();
            sabino_customizer_slider_check( slider_select_value );
        } );
        
        function sabino_customizer_slider_check( slider_select_value ) {
            if ( slider_select_value == 'sabino-slider-default' ) {
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-meta-slider-shortcode' ).hide();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-cats' ).show();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-size' ).show();
            } else if ( slider_select_value == 'sabino-meta-slider' ) {
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-cats' ).hide();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-size' ).hide();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-meta-slider-shortcode' ).show();
            } else {
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-cats' ).hide();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-slider-size' ).hide();
                $( '#sub-accordion-section-sabino-panel-settings-section-slider #customize-control-sabino-meta-slider-shortcode' ).hide();
                // $( '#accordion-panel-sabino-panel-colors' ).addClass( 'sabino-remove-section' );
            }
        }
        
        //Show / Hide Color selector for slider setting
        var the_blocks_select_value = $( '#customize-control-sabino-content-layout select' ).val();
        sabino_customizer_blocks_check( the_blocks_select_value );
        
        $( '#customize-control-sabino-content-layout select' ).on( 'change', function() {
            var blocks_select_value = $( this ).val();
            sabino_customizer_blocks_check( blocks_select_value );
        } );
        
        function sabino_customizer_blocks_check( blocks_select_value ) {
            if ( blocks_select_value == 'sabino-content-layout-blocks' ) {
                $( '#sub-accordion-section-sabino-panel-settings-section-website #customize-control-sabino-content-break-widgets' ).show();
            } else {
                $( '#sub-accordion-section-sabino-panel-settings-section-website #customize-control-sabino-content-break-widgets' ).hide();
            }
        }
        
    } );
    
} )( jQuery );