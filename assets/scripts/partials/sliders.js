import 'slick-carousel/slick/slick.min';

function newProducts_carousel ()
{
	const carousel = jQuery( '.new-product-1' );
	const next_arrow = carousel.parent( '.carousel-container' ).find( '.slick-next-btn' );
	const prev_arrow = carousel.parent( '.carousel-container' ).find( '.slick-prev-btn' );

		carousel.slick( {
			slidesToShow : 4,
			slidesToScroll : 4,
			arrows : true,
			prevArrow : prev_arrow,
			nextArrow : next_arrow,
			dots : false,
			speed : 900,
			rtl : true,
			infinite : false,
			responsive : [
				{
					breakpoint : 1023,
					settings : "unslick"
				}
			]
		} );


}

function products_carousel ()
{
	const carousel = jQuery( '.products-slider' );

	carousel.each( function ()
	{
		const next_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.slick-next-btn' );
		const prev_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.slick-prev-btn' );
			jQuery( this ).slick( {
				slidesToShow:6,
				slidesToScroll:6,
				arrows : true,
				prevArrow : prev_arrow,
				nextArrow : next_arrow,
				dots : false,
				speed : 900,
				rtl : true,
				infinite : false,
				responsive : [
					{
						breakpoint : 1023,
						settings : "unslick"
					}
				]
			} );

	} );
}

function offSales_carousel ()
{
	const carousel = jQuery( '.new-product-2' );
	const next_arrow = carousel.parent( '.carousel-container' ).find( '.slick-next-btn' );
	const prev_arrow = carousel.parent( '.carousel-container' ).find( '.slick-prev-btn' );
	carousel.slick( {
		slidesToShow : 2,
		slidesToScroll : 2,
		arrows : true,
		prevArrow : prev_arrow,
		nextArrow : next_arrow,
		dots : false,
		speed : 900,
		rtl : true,
		infinite : false,
		responsive : [
			{
				breakpoint : 1023,
				settings : "unslick"
			}
		]
	} );
}

function simple_carousel ()
{
	const carousel = jQuery( '.category-carousel' );
	carousel.each( function ()
	{
		const next_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.simple-next' );
		const prev_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.simple-prev' );
		jQuery( this ).slick( {
			variableWidth: true,
			slidesToScroll : 1,
			arrows : true,
			dots : false,
			useTransform: false,
			prevArrow : prev_arrow,
			nextArrow : next_arrow,
			speed : 400,
			rtl : true,
			responsive : [
				{
					breakpoint : 1024,
					settings : "unslick"
				}
			]
		} );
	} );
}

function brands_carousel()
{
	const carousel = jQuery( '.brands-carousel' );
	carousel.each( function ()
	{
		const next_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.simple-next' );
		const prev_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.simple-prev' );
		jQuery( this ).slick( {
			variableWidth: true,
			slidesToScroll : 1,
			useTransform: false,
			arrows : true,
			dots : false,
			prevArrow : prev_arrow,
			nextArrow : next_arrow,
			speed : 400,
			rtl : true,
			responsive : [
				{
					breakpoint : 1024,
					settings : "unslick"
				}
			]
		} );
	} );
}

function single_carousel ()
{
	const carousel = jQuery( '.flex-control-nav' );
	carousel.each( function ()
	{
		const next_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.single-next' );
		const prev_arrow = jQuery( this ).parent( '.carousel-container' ).find( '.single-prev' );
		jQuery( this ).slick( {
			slidesToShow : 4,
			slidesToScroll : 1,
			arrows : true,
			dots : false,
			prevArrow : prev_arrow,
			nextArrow : next_arrow,
			speed : 400,
			rtl : true
		} );
	} );
}

function carousel ( carousel )
{
	if ( '.carousel' !== carousel )
	{
		const next_arrow = jQuery( carousel ).parent( '.carousel-container' ).find( '.slick-next-btn' );
		const prev_arrow = jQuery( carousel ).parent( '.carousel-container' ).find( '.slick-prev-btn' );
		jQuery( carousel ).slick( {
			arrows : true,
			prevArrow : prev_arrow,
			nextArrow : next_arrow,
			autoplay: true,
			autoplaySpeed: 2000,
			fade: true,
			responsive : [
				{
					breakpoint : 1024,
					settings : {
						useTransform: false,
					}
				}
			]
		} );
	}
	else
		jQuery( carousel ).slick( {
			fade: true,
			autoplaySpeed: 3500,
			pauseOnHover: true,
		});
}

export { newProducts_carousel, products_carousel, offSales_carousel, simple_carousel, carousel ,single_carousel , brands_carousel };
