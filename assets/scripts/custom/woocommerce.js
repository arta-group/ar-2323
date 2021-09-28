( function ( $ )
{
	jQuery( document ).on( 'click','.input-quantity .plus', function ( e )
	{
		var input = jQuery( this ).siblings( 'input.qty' ),
			val = parseInt( input.val() ),
			step = input.attr( 'step' );

		step = 'undefined' !== typeof ( step ) ? parseInt( step ) : 1;
		input.val( val + step ).change();
	} );

	jQuery( document ).on( 'click','.input-quantity .minus',
		function ( e )
		{
			let input = jQuery( this ).siblings( 'input.qty' ),
				val = parseInt( input.val() ),
				step = input.attr( 'step' );

			step = 'undefined' !== typeof ( step ) ? parseInt( step ) : 1;
			if ( val > 0 )
				input.val( val - step ).change();
		} );

	jQuery( 'body' ).trigger( 'update_checkout' );

}( jQuery ) );