( function ( $ )
{

	$( '.icon-selector' ).on( 'click', 'i', function(e)
	{
		e.preventDefault();
		var $el = $( this ),
			icon = $el.data( 'icon' );
		$el.closest( 'div' ).prev( 'input.icon-data' ).val( icon ).siblings( '.icon-preview' ).children( 'i' ).attr( 'class', icon );
		$el.addClass( 'selected' ).siblings( '.selected' ).removeClass( 'selected' );
	} );

	$( '.clear-icon-selected' ).on( 'click', function ( e )
	{
		e.preventDefault();
		var current = $( this );
		current.siblings( 'i' ).removeClass().parent().siblings( 'input.icon-data' ).val('');
	} )

	$( '.icon-search' ).on( 'keyup', function()
	{
		var search = $( this ).val(),
			$icons = $( this ).siblings( '.icon-selector' ).children();

		if ( !search ) {
			$icons.show();
			return;
		}

		$icons.hide().filter( function() {
			return $( this ).data( 'icon' ).indexOf( search ) >= 0;
		} ).show();
	} );
} )( jQuery );
