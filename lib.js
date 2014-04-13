var wishlist = wishlist || {};

wishlist.Main = function() {

	var init = function() {
		$( 'h1' ).click( homepageDisplay );
		$( '#wishlist-selection li' ).click( toggleWishlistDisplay )
	},

	homepageDisplay = function( event ) {
		$( '.wishlist' ).hide();
		$( '#home ' ).show();
	},

	toggleWishlistDisplay = function( event ) {
		$( '#home' ).hide();
		
		$( '.wishlist' ).hide();
		$( '#wishlist-' + $(this).attr('data-id') ).show();
		
		$( '#wishlist-selection li' ).removeClass( 'selected' );
		$( this ).addClass( 'selected' );
	}

	return {
		init: init
	}

}();
