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

		_hideSections( true, true );

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
		_hideSections( false, true );

		$( '#wishlist-selection li' ).removeClass( 'selected' );
		$( '#home ' ).show();

		history.replaceState( {}, "", '/' );
	},

	toggleWishlistDisplay = function( event ) {
		_hideSections( true, true );

		$( '#wishlist-' + $(this).attr('data-id') ).show();
		
		$( '#wishlist-selection li' ).removeClass( 'selected' );
		$( this ).addClass( 'selected' );

		history.pushState( {}, "", '#wishlist-' + $(this).attr('data-id') );
	},

	_hideSections = function( home, wishlists ) {
		if ( home )
			$( '#home ' ).hide();

		if ( wishlists )
			$( '.wishlist' ).hide();
	}

	return {
		init: init
	}

}();
