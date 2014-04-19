var wishlist = wishlist || {};

wishlist.Main = function() {

	var init = function() {
		$( 'h1' ).click( homepageDisplay );
		$( '#wishlist-selection li' ).click( toggleWishlistDisplay )

		loadInitialPage();

		initActionTriggers();
		initMenuFixing();
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
			_resetNavSelectionState(
				$( 'li[data-id=' + wishlistId + ']', '#wishlist-selection' )
				);
			$( 'html, body' ).animate({
					scrollTop: $( '#wishlist-selection' ).offset().top
				});
		}
	},

	initActionTriggers = function() {
		$('.wishlist .claim').click(triggerClaimItem);
	}

	initMenuFixing = function() {
		var menu = $('#wishlist-selection');
		var menuPosition = $( menu ).offset().top;

		$( window ).scroll( function() {
			if ( $( window ).scrollTop() >= menuPosition ) {
				if ( !menu.hasClass( 'fixed' ) )
					menu.addClass( 'fixed' );
			} else {
				if ( menu.hasClass( 'fixed' ) )
					menu.removeClass( 'fixed' );
			}
		});
	},

	triggerClaimItem = function( event ) {
		event.preventDefault();

		var parentContainer = $(event.target).closest('article');

		$.post(
			"/actions.php",
			{
				'action': 'claim',
				'id': parentContainer.attr('id').replace(/item\-/g, '')
			},
			function() {
				$(parentContainer).closest('li').fadeOut(
					400,
					function() {
						$(this).remove();
					})
			}
			);
	},

	homepageDisplay = function( event ) {
		_hideSections( false, true );
		_resetNavSelectionState();
		$( '#home ' ).show();

		history.replaceState( {}, "", '/' );
	},

	toggleWishlistDisplay = function( event ) {
		_hideSections( true, true );
		$( '#wishlist-' + $(this).attr('data-id') ).show();
		_resetNavSelectionState( this );

		history.pushState( {}, "", '#wishlist-' + $(this).attr('data-id') );
	},

	_hideSections = function( home, wishlists ) {
		if ( home )
			$( '#home ' ).hide();

		if ( wishlists )
			$( '.wishlist' ).hide();
	},

	_resetNavSelectionState = function( selectedItem ) {
		$( '#wishlist-selection li' ).removeClass( 'selected' );

		if ( undefined !== selectedItem )
			$( selectedItem ).addClass( 'selected' );
	}

	return {
		init: init
	}

}();
