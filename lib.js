var wishlist = wishlist || {};

wishlist.Main = function() {

	var init = function() {
		$( 'h1' ).click( homepageDisplay );
		$( '#wishlist-selection li' ).click( toggleWishlistDisplay )

		loadInitialPage();
	},

	loadInitialPage = function() {
		if ( '' === window.location.hash
			|| 0 === $( window.location.hash ).length ) {
			return;
		}

		$( '.wishlist' ).hide();
		$( '#home ' ).hide();
		$( window.location.hash ).show();

		var wishlistId = window.location.hash.replace(
			/^#wishlist\-(.*)$/g, "$1"
			);
		if ( '' !== wishlistId ) {
			$( '#wishlist-selection li' ).removeClass( 'selected' );
			$( 'li[data-id=' + wishlistId + ']', '#wishlist-selection' ).addClass( 'selected' );
		}
	}

	homepageDisplay = function( event ) {
		$( '.wishlist' ).hide();
		$( '#wishlist-selection li' ).removeClass( 'selected' );
		$( '#home ' ).show();

		history.replaceState( {}, "", '/' );
	},

	toggleWishlistDisplay = function( event ) {
		$( '#home' ).hide();
		
		$( '.wishlist' ).hide();
		$( '#wishlist-' + $(this).attr('data-id') ).show();
		
		$( '#wishlist-selection li' ).removeClass( 'selected' );
		$( this ).addClass( 'selected' );

		history.pushState( {}, "", '#wishlist-' + $(this).attr('data-id') );
	}

	return {
		init: init
	}

}();
