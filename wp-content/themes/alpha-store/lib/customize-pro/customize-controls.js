( function( api ) {

	// Extends our custom "alpha-store" section.
	api.sectionConstructor['alpha-store'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
