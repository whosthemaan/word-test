( function( api ) {
	api.sectionConstructor['bigwigs-upsell'] = api.Section.extend( {
		attachEvents: function () {},

		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
