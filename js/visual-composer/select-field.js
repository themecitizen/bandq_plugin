!( function($) {
	'use strict';

	$( function() {
		var $selectCat = $( '.select-products' ),
			$inputCat = $( '.wpb-input-products' );

		if( ! $( 'body' ).find( $selectCat ).length > 0 )
		{
			return;
		}

		$( 'body' ).find( '.wpb_el_type_select-products' ).each( function( )
		{

			if( $( this ).attr( 'data-param_name' ) != 'category' ) {
				$( this ).find( $selectCat ).attr( 'multiple', 'multiple' );
			}
			$( this ).find( $selectCat ).select2();

			var categories = [],
				mutiValue = $(this).find( $inputCat ).val();

			if( mutiValue.indexOf( ',' ) ) {
				mutiValue = mutiValue.split( ',' );
			}
			if( mutiValue.length > 0 ) {
				for( var i = 0; i < mutiValue.length; i++ ) {
					categories.push( mutiValue[i] );
				}
			}

			$(this).find( $selectCat ).val( categories ).trigger("change");

			$(this).find( $selectCat ).on( 'change', function( e ) {
				$(this).parent().find( $inputCat ).val( $(this).val() );
			} );
		} );
	} );

} )(window.jQuery);
