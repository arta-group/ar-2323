import anime from 'animejs/lib/anime.es.js';

function animating_product_card ()
{
	const options_cons = document.querySelectorAll( ".con-element" )

	options_cons.forEach( options_con =>
	{
		const els = options_con.querySelectorAll( ".option" );

		function animateText ( translateY )
		{
			anime.remove( els );
			anime( {
				targets : els,
				translateY : translateY,
				elasticity : 300,
				delay : anime.stagger( 100 )
			} );
		}

		function enterText () { animateText( -100 ) }

		function leaveText () { animateText( 0 ) }

		options_con.addEventListener( 'mouseenter', enterText );
		options_con.addEventListener( 'mouseleave', leaveText );
	} );
}

function animating_product_btn ()
{
	const to_singles = document.querySelectorAll( ".con-element" )
	to_singles.forEach( to_single =>
	{
		const els = to_single.querySelector( ".observe" );

		function animateText ( translateY )
		{
			anime.remove( els );
			anime( {
				targets : els,
				translateY : translateY,
				elasticity : 300,
			} );
		}

		function enterText () { animateText( -60 ) }

		function leaveText () { animateText( 0 ) }

		to_single.addEventListener( 'mouseenter', enterText );
		to_single.addEventListener( 'mouseleave', leaveText );
	} )
}

function button_effect ()
{
	let buttonEls = document.querySelectorAll( '.btn-effect' );

	buttonEls.forEach( btn =>
	{

		function animateButton ( scale, duration, elasticity )
		{
			anime.remove( btn );
			anime( {
				targets : btn,
				scale : scale,
				duration : duration,
				elasticity : elasticity,
			} );
		}

		function enterButton () { animateButton( 1.025, 800, 400 ) }

		function leaveButton () { animateButton( 1.0, 600, 300 ) }

		btn.addEventListener( 'mouseenter', enterButton );
		btn.addEventListener( 'mouseleave', leaveButton );
	} );
}

export { animating_product_card, animating_product_btn, button_effect };
