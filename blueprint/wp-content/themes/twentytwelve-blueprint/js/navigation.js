/**
 * Handles toggling the navigation search button for small screens and
 * accessibility for the search form.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), searchButton, searchForm;
	if ( ! nav ) {
		return;
	}
	topicsButton = nav.getElementsByTagName( 'button' )[1];
	searchButton = nav.getElementsByTagName( 'button' )[3];
	topicsMenu   = nav.getElementsByTagName( 'ul' )[0];
	searchForm   = nav.getElementsByTagName( 'form' )[0].parentElement;
	if ( ! topicsButton && ! searchButton ) {
		return;
	}

	// Hide button if search form is missing.
	if ( ! searchForm ) {
		searchButton.style.display = 'none';
		return;
	}

	topicsButton.onclick = function() {
		if ( -1 !== topicsMenu.className.indexOf( 'toggled-on' ) ) {
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		} else {
			topicsButton.className += ' toggled-on';
			topicsMenu.className += ' toggled-on';
		}

		if( -1 !== searchForm.className.indexOf( 'toggled-on' ) ) {
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		}
	};

	searchButton.onclick = function() {
		if ( -1 === searchForm.className.indexOf( 'searchform' ) ) {
			searchForm.className = 'searchform';
		}

		if ( -1 !== searchForm.className.indexOf( 'toggled-on' ) ) {
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		} else {
			searchButton.className += ' toggled-on';
			searchForm.className += ' toggled-on';
		}

		if( -1 !== topicsMenu.className.indexOf( 'toggled-on' ) ) {
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		}
	};
} )();