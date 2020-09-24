( function($) {
    'use strict';

    $( document ).ready( function() {

		/**
		 * Woocomerce form field compatibility issue
		 */
		$( 'input[type="number"]').addClass( 'form-control form-control-sm' );
		$( '.woocommerce-MyAccount-navigation ul').addClass( 'list-group' );
		$( 'li.woocommerce-MyAccount-navigation-link').addClass( 'list-group-item' );

		$('select[name="orderby"],input[name="account_first_name"],input[name="account_last_name"],input[name="account_display_name"],input[name="account_email"],input[name="coupon_code"],input[type="password"]').each(function(){
			$(this).addClass( 'form-control' );
		});

	});
		
})(jQuery);