/**
 * Live contextual for better user experience.
 * Customizer option contextual control functionality
 */

( function( api ) {
    'use strict';

    api.bind( 'ready', function() {

        api( 'blog_layout', function(setting) {
            var SelectValueToControlActiveState;

            /**
             * Update a control's active state according to the blog_layout setting's value.
             *
             * @param {api.Control}
             */
            SelectValueToControlActiveState = function( control ) {
                var visibility = function() {
                    if ( 'grid' === setting.get() ) {
                    // can be added: || 'other-value' === setting.get()
                        control.container.slideDown( 180 );
                    } else {
                        control.container.slideUp( 180 );
                    }
                };

                // Set initial active state.
                visibility();
                //Update activate state whenever the setting is changed.
                setting.bind( visibility );
            };

            // Call SelectValueToControlActiveState on the blog_grid controls when they exist.
            api.control( 'blog_grid', SelectValueToControlActiveState );
        });

    });

}( wp.customize ) );