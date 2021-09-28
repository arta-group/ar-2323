( function ( $ )
{
// comment form
	var commentForm = $( "form[action$='wp-comments-post.php']" ),
		formActionUrl = commentForm.attr( 'action' );

	$( commentForm ).on( 'submit', function ( e )
	{
		e.preventDefault();

		var comment = $( this ).find( '#comment' ),
			respond = $( '#respond' ),
			errors = [],
			messages = '';

		$( '.comment-errors' ).remove();

		if ( !$.trim( comment.val() ) )
			errors.push( "لطفا متن دیدگاه را وارد کنید" );

		if ( errors.length > 0 )
		{
			messages = '<ul class="comment-errors">';
			errors.forEach( function ( item )
			{
				messages += '<li>' + item + '</li>';
			} );
			messages += '</ul>';
			$( messages ).insertBefore( respond );
		}
		else
		{
			$.ajax( {
				method : 'POST',
				url : formActionUrl,
				data : commentForm.serializeArray(),
				success : function ( response )
				{
					if ( response === 'success' )
						location.reload();
				}
			} );
		}
	} );

	$( "input#reg_username" ).change( function ()
	{
		$( 'input#reg_email' ).val( $( this ).val() + '@artaelectric.ir' );
	} );

	$( "input#reg_username" ).trigger( 'change' );

	$( '.amazing-sales-list .amazing-product' ).each( function ()
	{
		var endDate = $( this ).data( 'amazing-end-date' ),
			year = 0,
			month = 0,
			day = 0,
			hour = 0,
			min = 0;

		if ( endDate )
		{
			var arrayEndDateTime = endDate.split( ' ' ),
				arrayEndDate = arrayEndDateTime[0].split( '-' ),
				arrayEndTime = arrayEndDateTime[1].split( ':' )

			year = parseInt( arrayEndDate[0] );
			month = parseInt( arrayEndDate[1] );
			day = parseInt( arrayEndDate[2] );

			if ( arrayEndTime[0] !== undefined )
				hour = parseInt( arrayEndTime[0] );

			if ( arrayEndTime[1] !== undefined )
				min = parseInt( arrayEndTime[1] );

			simplyCountdown( this, {
				year : year,
				month : month,
				day : day,
				hours : hour,
				minutes : min,
				seconds : 0,
				words : {
					days : 'روز',
					hours : 'ساعت',
					minutes : 'دقیقه',
					seconds : 'ثانیه',
					pluralLetter : 's'
				},
				plural : false,
				inline : false,
				inlineClass : 'amazing-countdown-inline',
				enableUtc : true,
				refresh : 1000,
				sectionClass : 'amazing-section',
				amountClass : 'amazing-amount',
				wordClass : 'amazing-word',
				zeroPad : true,
				countUp : false
			} );
		}
	} );

	// AJAX add to cart button on the Product Page
	$( 'form.cart' ).on( 'submit', function ( e )
	{
		e.preventDefault();

		var form = $( this );
		form.block( { message : null, overlayCSS : { background : '#fff', opacity : 0.6 } } );

		var formData = new FormData( form[0] );
		formData.append( 'add-to-cart', form.find( '[name=add-to-cart]' ).val() );

		$.ajax( {
			url : wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'fs_add_to_cart' ),
			data : formData,
			type : 'POST',
			processData : false,
			contentType : false,
			complete : function ( response )
			{
				response = response.responseJSON;

				if ( !response )
					return;

				if ( response.error && response.product_url )
				{
					window.location = response.product_url;
					return;
				}

				if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' )
				{
					window.location = wc_add_to_cart_params.cart_url;
					return;
				}

				var addToCartButton = form.find( '.single_add_to_cart_button' );

				$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, addToCartButton ] );

				addToCartButton.next( 'a.added_to_cart.wc-forward' ).hide();

				$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

				form.parents( '.site-main' ).find( '.woocommerce-notices-wrapper' ).html( response.fragments.notices_html )

				form.unblock()

				jQuery( '.mini-cart-content' ).addClass( 'active' );

				cart();
			}
		} );
	} );

	$( document ).on( 'added_to_wishlist removed_from_wishlist', function ()
	{
		$.get( yith_wcwl_l10n.ajax_url, {
			action : 'yith_wcwl_update_wishlist_count'
		}, function ( data )
		{
			$( '.wishlist-count' ).html( data.count );
		} );
	} );

	function cart ()
	{
		const content_el = document.querySelector( '.mini-cart-content' );

		jQuery( '#cart' ).on( 'click', function ( e )
		{
			e.preventDefault();
			content_el.classList.add( 'active' );
		} );

		jQuery( '#cart-2' ).on( 'click', function ( e )
		{
			e.preventDefault();
			content_el.classList.add( 'active' );
		} );

		document.addEventListener( 'click', function ( e )
		{
			if ( e.target.id === "cart_overlay" )
			{
				content_el.classList.remove( 'active' );
			}
		} );

		jQuery( '#cart_close' ).on( 'click', function ()
		{
			content_el.classList.remove( 'active' );
		} );
	}

	function yith_compare_counter_sticky ( counter = 0 )
	{
		var counter = counter;

		if ( counter === 0 )
			counter = $( '.yith-woocompare-count' ).text().match( /\d+/ );

		if ( counter <= 0 )
			$( '.yith-woocompare-counter' ).hide();
		else
			$( '.yith-woocompare-counter' ).show();
	}

	yith_compare_counter_sticky();

	$( document ).on( 'yith_woocompare_product_removed', function ()
	{
		yith_compare_counter_sticky();
	} );

	$( document ).on( 'yith_woocompare_product_added', function ()
	{
		// In the YITH compare plugin, update_counter function called after yith_woocompare_product_added trigger
		yith_compare_counter_sticky( 1 );
	} );

	// Make cart qty ajax on input change.
	var cartTimeout ;
	$(document).on('change', 'input.qty', function(){

		cartTimeout !== undefined && clearTimeout( cartTimeout );

		if($(this).val())
		{
			cartTimeout = setTimeout( function ()
			{
				$( "[name='update_cart']" ).trigger( "click" );
			}, 1000 );
		}

	});
}( jQuery ) );
