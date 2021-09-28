/* eslint-disable camelcase */
//====================================
// ADD ALL JS PLUGINS
//====================================
import * as slider from "../partials/sliders";
import * as animation from "../partials/animeJS";
import  "../partials/menu";
import '../partials/rAF';
import '../partials/ResizeSensor';
import StickySidebar from "sticky-sidebar";



//run codes after dom is loaded
jQuery( document ).ready( function () {
	//initial carousels
	slider.offSales_carousel();
	slider.simple_carousel();
	slider.single_carousel();
	slider.newProducts_carousel();
	slider.brands_carousel();
	slider.carousel('.carousel');
	slider.products_carousel();

	// document.querySelectorAll( '.products' ).forEach( ( product ) => {
	// 	slider.carousel( product );
	// } );

	//other functions
	cart();

	accordionCollapseHandle();
	accordionProductsHandle();

	toggle_tabs();

	smooth_scroll();

	show_rest();

	archive_category_menu();

	selectingBank();

	animation.button_effect();

	resHeader();

	toggle_filters();

	toggle_sorting();

	share_modal();

	copy_to_clipboard();

	scroll_top();

	singleProductGap();

	scrollHighlight();

	contentTable();

	inputGenerator('.prdctfltr_search .prdctfltr_checkboxes label');


	if (window.innerWidth > 1024) {

		if(document.getElementById('filters-sidebar')) {
			var sidebar = new StickySidebar('#filters-sidebar', {
				containerSelector: '#main-content',
				innerWrapperSelector: '.sidebar__inner',
				topSpacing: 40,
				bottomSpacing: 40,
				resizeSensor: true
			});
		}

		if(document.querySelector('.fs-big-sidebar__inner')) {

			const bigSidebarInnerHeight = document.querySelector('.fs-big-sidebar__inner').clientHeight ;
			const smallSidebarInnerHeight = document.querySelector('.fs-small-sidebar__inner').clientHeight ;

			if(bigSidebarInnerHeight === smallSidebarInnerHeight) {
				return null;
			} else if(bigSidebarInnerHeight > smallSidebarInnerHeight ) {
				document.querySelector('.fs-checkout-container').classList.add('is_ltr_sidebar');
				var smallSidebar = new StickySidebar('#fs-small-sidebar', {
					containerSelector: '#fs-checkout-container',
					innerWrapperSelector: '.fs-small-sidebar__inner',
					topSpacing: 40,
					bottomSpacing: 40,
					resizeSensor: true
				});
			} else {
				var bigSidebar = new StickySidebar('#fs-big-sidebar', {
					containerSelector: '#fs-checkout-container',
					innerWrapperSelector: '.fs-big-sidebar__inner',
					topSpacing: 40,
					bottomSpacing: 40,
					resizeSensor: true
				});
			}
		}


	}


});




function cart ()
{
	let content_el ;

	jQuery( document ).on( 'click', function ( e ) {
		if(e.target.id === 'cart') {
			e.preventDefault();
			content_el = document.querySelector('.mini-cart-content')
			document.querySelector('.mini-cart-content').classList.add('active');
		}
	} );

	jQuery( '#cart-2' ).on( 'click', function ( e ) {
		e.preventDefault();
		content_el.classList.add('active');
	} );

	document.addEventListener( 'click', function (e) {
		if(e.target.id === "cart_overlay") {
			content_el.classList.remove('active');
		}
	} );

	jQuery( '#cart_close' ).on( 'click', function () {
		content_el.classList.remove('active');
	} );
}

function accordionCollapseHandle ()
{
	const accordion_toggler = document.querySelectorAll( '.accordion-head' );

	accordion_toggler.forEach( ( accordion ) =>
	{
		const accordion_body = accordion.nextElementSibling;

		if ( accordion.classList.contains( 'active' ) )
			accordion_body.style.maxHeight = accordion_body.scrollHeight + 'px';

		accordion.addEventListener( 'click', function ()
		{
			this.classList.toggle( 'active' );
			this.parentElement.classList.toggle( 'active' );
			if ( this.parentElement.classList.contains( 'faq' ) )
			{
				this.querySelector( '.accordion-icon' ).classList.toggle( 'icon-plus' );
				this.querySelector( '.accordion-icon' ).classList.toggle( 'icon-minus' );
			}
			accordion_body.classList.toggle( 'active' );

			if ( this.classList.contains( 'active' ) )
				accordion_body.style.maxHeight = accordion_body.scrollHeight + 'px';
			else
				accordion_body.style.maxHeight = 0;
		} );
	} );
}

function accordionProductsHandle()
{
	const accordion_toggler = document.querySelectorAll( '.pf-help-title' );

	if ( !accordion_toggler ) return;
	accordion_toggler.forEach( ( accordion ) =>
	{

		const next_sibling_class = accordion.nextElementSibling.classList ;
		const parent_class = accordion.parentElement.classList;

		if ( parent_class.contains('prdctfltr_rng_price') || parent_class.contains('prdctfltr_search') ) return;

		let prev_accordion_body;
		let accordion_body;

		if (next_sibling_class.contains('prdctfltr_search_terms') ) {
			accordion_body = accordion.nextElementSibling.nextElementSibling;
			prev_accordion_body = accordion.nextElementSibling;
		} else {
			accordion_body = accordion.nextElementSibling;
		}


		 if ( accordion.classList.contains( 'active' ) ) {
			if(prev_accordion_body)  prev_accordion_body.style.maxHeight = prev_accordion_body.scrollHeight + 'px';

			accordion_body.style.maxHeight = accordion_body.scrollHeight + 5 + 'px';
		}


		accordion.addEventListener( 'click', function ()
		{
			this.classList.toggle( 'active' );
			this.parentElement.classList.toggle( 'active' );
			accordion_body.classList.toggle( 'active' );

			 if ( this.classList.contains( 'active' ) ) {
				 if(prev_accordion_body)  prev_accordion_body.style.maxHeight = prev_accordion_body.scrollHeight + 'px';
				accordion_body.style.maxHeight = accordion_body.scrollHeight + 5  + 'px';
			} else {
				 if(prev_accordion_body)  prev_accordion_body.style.maxHeight = 0;
				accordion_body.style.maxHeight = 0;
			}

		} );
	} );
}


function toggle_tabs ()
{
	const des_tab_items = document.querySelectorAll( '.c-tabs li' );

	// const des_tab = document.querySelector( '.c-tabs' );

	des_tab_items.forEach( ( tab ) =>
	{
		tab.addEventListener( 'click', function ( e )
		{
			e.preventDefault();
			this.closest( '.c-tabs' ).querySelectorAll( 'li' ).forEach( function ( item ) {
				item.classList.remove( 'active' );
			} );
			this.classList.add( 'active' );

			this.closest( '.content-wrapper' ).querySelectorAll( '.c-tab-content' ).forEach( function ( content )
			{
				content.classList.remove( 'active' );
				if ( content.dataset.id === tab.id )
					content.classList.add( 'active' );
			} );
		} );
	} );
}

function smooth_scroll ()
{
	const links = document.querySelectorAll( '.c-tab-menu li a' );

	links.forEach( ( link ) =>
	{
		link.addEventListener( 'click', function ( e )
		{
			e.preventDefault();

			links.forEach( ( item ) => {
				item.parentElement.classList.remove( 'active' );
			} );

			this.parentElement.classList.add( 'active' );

			const articleId = gettingLink( this ).join( '' );

			let offset;

			if ( link.parentElement.parentElement.classList.contains( 'faq' ) ) {
				if (1024 > window.innerWidth){
					offset = findPos(document.getElementById(articleId)) - 30;
				}
				else {
					offset = findPos(document.getElementById(articleId)) - 20;
				}

			}
			else
				offset = findPos( document.getElementById( articleId ) );

			window.scroll( 0, offset );

		} );
	} );
}

function scrollHighlight(){
	const contentEls = document.querySelectorAll('.c-content-wrapper .content');
	const linkEls = document.querySelectorAll( '.c-tab-menu li a' );
	window.addEventListener('scroll' , mainH)

	function mainH() {

		contentEls.forEach(content => {

			const contentPos = findPos(content) - 50;
			if (content.nextElementSibling) {
				const nextElPos = findPos(content.nextElementSibling) - 50;
				if ( contentPos < window.scrollY && nextElPos > window.scrollY) {
					linkEls.forEach(link => {
						if( link.dataset.id === content.id) {
							link.parentElement.classList.add("active")
						}else {
							link.parentElement.classList.remove("active")
						}
					})
				} else {
					content.classList.remove("active");
				}
			} else {
				if ( contentPos < window.scrollY) {
					linkEls.forEach(link => {
						if( link.dataset.id === content.id) {
							link.parentElement.classList.add("active")
						}else {
							link.parentElement.classList.remove("active")
						}
					})
				} else {
					content.classList.remove("active");
				}
			}

		})
	}


}
function findPos ( obj )
{
	let curtop = 0;

	if ( obj.offsetParent )
	{
		do {
			curtop += obj.offsetTop;
		} while ( obj === obj.offsetParent );

		return [ curtop ];
	}
}

function gettingLink ( link )
{
	const hash = link.href.split( '/' );
	const hash_splited = hash[hash.length - 1];
	let removehashtag = hash_splited.split( '' );
	removehashtag.shift();
	return removehashtag;
}

function show_rest ()
{
	const btn = document.querySelector( '#show-rest' );
	const content = document.querySelector( '.intro-content' );
	const overlay = document.querySelector( '.bg-intro-overlay' );
	let flag = false;

	if ( btn )
	{
		btn.addEventListener( 'click', function ()
		{
			overlay.classList.toggle( 'hidden' );

			if ( !this.classList.contains( 'is-active' ) )
			{
				content.style.maxHeight = content.scrollHeight + 'px';
				this.classList.toggle( 'is-active' );
			}
			else
			{
				if ( content.classList.contains( 'c-archive-shop-info' ) )
					content.style.maxHeight = '40rem';
				else
					content.style.maxHeight = '18rem';

				this.classList.remove( 'is-active' );
			}

			flag = !flag;

			if ( flag )
			{
				this.innerHTML = `نمایش کمتر
                <span class="icon-angle-down text-xs transform scale-50 mr-0/5 leading-0/7 h-1 flex items-center transition-transform ease-linear duration-100 transform -rotate-180"></span>`;
			}
			else
			{
				this.innerHTML = `نمایش بیشتر
                <span class="icon-angle-down text-xs transform scale-50 mr-0/5 leading-0/7 h-1 flex items-center transform"></span>`;
			}
		} );
	}
}

function archive_category_menu ()
{
	const item_has_children = document.querySelectorAll( '.item-has-children' );
	const submenus = document.querySelectorAll( '#archive-category .submenu' );

	item_has_children.forEach( item =>
	{
		const submenu = item.nextElementSibling;
		item.addEventListener( 'click', function ( e )
		{
			e.preventDefault();
			this.closest( '.accordion-body' ).style.maxHeight = 'unset';

			if ( !this.classList.contains( 'is-active' ) )
			{
				if ( this.closest( '.submenu' ) )
					this.closest( '.submenu' ).style.maxHeight = 'unset';

				submenu.style.maxHeight = submenu.scrollHeight + 'px';
				this.classList.add( 'is-active' );
			}
			else
			{
				submenu.style.maxHeight = '0px';
				this.classList.remove( 'is-active' );
			}
		} );
	} );
}

function selectingBank ()
{
	document.addEventListener( "click", function ( e )
	{
		if ( e.target.parentElement.classList.contains( "wc_payment_method" ) )
		{
			clearActive();
			e.target.parentElement.classList.add( "active" );
		}
	} )
}

function clearActive ()
{
	const banks = document.querySelectorAll( ".wc_payment_method" );

	if ( banks )
	{
		banks.forEach( bank => {
			bank.classList.remove( "active" );
		} );
	}
}

function resHeader ()
{
	// mobile menu toggle
	const openMenuCtrl = document.querySelector( ".action--open" ),
		closeMenuCtrl = document.querySelector( ".action--close" ),
		mobile_header = document.getElementById( "mobile-header" );

	if ( openMenuCtrl && closeMenuCtrl )
	{
		openMenuCtrl.addEventListener( "click", openMenu );
		closeMenuCtrl.addEventListener( "click", openMenu );

		let menuEl = document.getElementById( "ml-menu" ),
			mlmenu = new MLMenu( menuEl, {
				// breadcrumbsCtrl : true, // show breadcrumbs
				// initialBreadcrumb : 'all', // initial breadcrumb text
				backCtrl : true, // show back button
				// itemsDelayInterval : 60, // delay between each menu item sliding animation
				//onItemClick: loadDummyData, // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
			} );

		function openMenu ()
		{
			openMenuCtrl.classList.toggle( "active" );
			mobile_header.classList.toggle( "active" );
			// classie.add( menuEl, "menu--open" );
			menuEl.classList.toggle( "menu--open" );
			jQuery( "#ml-menu" ).fadeToggle();
			// closeMenuCtrl.focus();
		}

		// simulate grid content loading
		let gridWrapper = document.querySelector( ".content" );
	}
}

function toggle_filters ()
{
	jQuery( '#toggle-filters-open' ).on( 'click', function ( e ) {
		jQuery( '#filters-sidebar' ).fadeToggle();
		document.body.style.position = 'fixed';
		document.body.style.top = `-${window.scrollY}px`;
	} );

	jQuery( '#toggle-filters-close' ).on( 'click', function ( e ) {
		jQuery( '#filters-sidebar' ).fadeToggle();
		const scrollY = document.body.style.top;
		document.body.style.position = '';
		document.body.style.top = '';
		window.scrollTo( 0, parseInt( scrollY || '0' ) * -1 );
	} );

	if ( jQuery( window ).width() < 1023 )
	{
		jQuery( document ).on( 'click', function ( e ) {
			if ( e.target.classList.contains( "wcpf-title-container" ) || e.target.classList.contains( "wcpf-title" ) || e.target.classList.contains( "wcpf-input-checkbox" ) || e.target.classList.contains( "wcpf-input-container" ) )
			{
				console.log( 'hello' );
				jQuery( '#filters-sidebar' ).fadeToggle();
				const scrollY = document.body.style.top;
				document.body.style.position = '';
				document.body.style.top = '';
				window.scrollTo( 0, parseInt( scrollY || '0' ) * -1 );
			}
		} );
	}
}

function toggle_sorting() {
	if(window.innerWidth < 1024) {
		jQuery( '#sorting-btn' ).on( 'click', function ( e ) {
			jQuery( '#sorting-container' ).fadeToggle();
			document.body.style.position = 'fixed';
			document.body.style.top = `-${window.scrollY}px`;
		} );

		jQuery( '#sorting-overlay' ).on( 'click', function ( e ) {
			jQuery( '#sorting-container' ).fadeToggle();
			const scrollY = document.body.style.top;
			document.body.style.position = '';
			document.body.style.top = '';
			window.scrollTo(0, parseInt(scrollY || '0') * -1);
		} );

		jQuery( document ).on( 'click', function ( e ) {
			if(e.target.classList.contains("ordering-item")) {
				jQuery( '#sorting-container' ).fadeToggle();
				const scrollY = document.body.style.top;
				document.body.style.position = '';
				document.body.style.top = '';
				window.scrollTo(0, parseInt(scrollY || '0') * -1);
			}
		} );
	}

}

function share_modal() {

	jQuery("#share-btn").on("click" , function(e) {
		e.preventDefault();
		jQuery("#share-modal").toggleClass("scale-0");
		jQuery("#share-modal .share-popup").toggleClass("scale-0");
	});
	jQuery(".modal-bg").on("click" , function() {
		jQuery("#share-modal").toggleClass("scale-0");
		jQuery("#share-modal .share-popup").toggleClass("scale-0");
	});
	jQuery(".close-share").on("click" , function() {
		jQuery("#share-modal").toggleClass("scale-0");
		jQuery("#share-modal .share-popup").toggleClass("scale-0");
	});


}

function copy_to_clipboard() {
	jQuery( '.share-copy' ).on( 'click', function( e ) {
		e.preventDefault();
		const copyText = document.querySelector( '.share-input' );
		copyText.select();
		copyText.setSelectionRange( 0, 99999 ); /* For mobile devices */

		/* Copy the text inside the text field */
		document.execCommand( 'copy' );

		/* Alert the copied text */
		jQuery( '.confirm-alert' ).removeClass( 'hidden' );
	});
}

function scroll_top() {

	document.addEventListener("click" , function(e) {
		document.querySelectorAll(".pagination-con a").forEach(item => {
			if(e.target === item){

				if (!e.target.classList.contains("active")) {

					if(!e.target.classList.contains('disabled')) {
						window.scrollTo({
							top: findPos(document.querySelector(".products")) - 150,
							left: 0,
							behavior: 'smooth'
						});
					}

				}
			}
		});
		document.querySelectorAll(".pagination-con a span").forEach(item => {
			if(e.target === item){
				if(!e.target.parentElement.classList.contains('disabled')) {
					window.scrollTo({
						top: findPos(document.querySelector(".products")) - 150,
						left: 0,
						behavior: 'smooth'
					});
				}
			}
		});
	})

	function findPos ( obj )
	{
		let curtop = 0;

		if ( obj.offsetParent )
		{
			do {
				curtop += obj.offsetTop;
			} while ( obj === obj.offsetParent );

			return [ curtop ];
		}
	}
}

function singleProductGap ()
{
	const el = document.querySelector( '.mt-21' );

	if ( el != null )
	{
		const codeEl = document.querySelector( '.product-code' );
		const listHeight = document.querySelector( '.features-top' ).scrollHeight;

		if ( document.querySelector( '.fs-features-list' ) && window.innerWidth < 1023 )
		{
			el.style.marginTop = listHeight + 50 + 'px';
			codeEl.style.bottom = listHeight + 40 + 'px';
		}
		else
		{
			el.style.marginTop = '7.5rem';
			codeEl.style.bottom = '5rem';
		}
	}
}

//======================================================================
// content table
//======================================================================
function contentTable() {
	const contents = document.querySelectorAll('.mag-single .content-container');

	if(!contents) return;
	contents.forEach(content => {
		const contentBody = content.querySelector('.content-list')

		content.previousElementSibling.addEventListener('click' , function() {
			content.parentElement.classList.toggle('active');
			if(content.parentElement.classList.contains('active')) {
				content.style.maxHeight = contentBody.scrollHeight + 'px';
			} else {
				content.style.maxHeight = 0 ;
			}

		})
	})

}


//======================================================================
// creating input
//======================================================================

function inputGenerator(container) {

	const containerEl =  document.querySelector(container);

	if(!containerEl) return;

	const inputElTemplate = ` <input type="hidden" name="type" value="product" /> `;

	containerEl.insertAdjacentHTML('beforeend' , inputElTemplate);
}

