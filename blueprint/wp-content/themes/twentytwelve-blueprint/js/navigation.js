/**
 * Handles toggling the navigation search button for small screens and
 * accessibility for the search form.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), searchButton, searchForm;
	if ( ! nav ) {
		return;
	}

	searchButton = nav.getElementsByTagName( 'button' )[1];
	searchForm = nav.getElementsByTagName( 'form' )[0];
	if ( ! searchButton ) {
		return;
	}

	// Hide button if search form is missing.
	if ( ! searchForm ) {
		searchButton.style.display = 'none';
		return;
	}

	searchButton.onclick = function() {
		if ( -1 === searchForm.className.indexOf( 'searchform' ) ) {
			searchForm.className = 'searchform';
		}

		if ( -1 !== searchButton.className.indexOf( 'toggled-on' ) ) {
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchform.className = searchform.className.replace( ' toggled-on', '' );
		} else {
			searchButton.className += ' toggled-on';
			searchform.className += ' toggled-on';
		}
	};
} )();