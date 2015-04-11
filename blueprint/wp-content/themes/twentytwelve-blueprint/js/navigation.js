/**
 * Handles toggling the navigation search button for small screens and
 * accessibility for the search form.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ), searchButton, searchForm;
	if ( ! nav ) {
		return;
	}
	menuButton   = nav.getElementsByTagName( 'button' )[0];
	topicsButton = nav.getElementsByTagName( 'button' )[1];
	issuesButton = nav.getElementsByTagName( 'button' )[2];
	searchButton = nav.getElementsByTagName( 'button' )[3];
	topicsMenu   = nav.getElementsByTagName( 'ul' )[0].parentElement; // parentElement to select container
	issuesMenu	 = nav.getElementsByTagName( 'ul' )[1].parentElement;
	searchForm   = nav.getElementsByTagName( 'form' )[0].parentElement; 

	if ( ! menuButton && ! topicsButton && ! searchButton && ! searchButton ) {
		return;
	}

	// Hide button if search form is missing.
	if ( ! searchForm ) {
		searchButton.style.display = 'none';
		return;
	}

	menuButton.onclick = function(e) {
		if ( -1 !== topicsMenu.className.indexOf( 'toggled-on' ) ) {
			menuButton.className = menuButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		} else {
			menuButton.className += ' toggled-on';
			topicsMenu.className += ' toggled-on';
		}

		resetToggle(e.currentTarget);
	};

	topicsButton.onclick = function(e) {
		if ( -1 !== topicsMenu.className.indexOf( 'toggled-on' ) ) {
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		} else {
			topicsButton.className += ' toggled-on';
			topicsMenu.className += ' toggled-on';
		}

		resetToggle(e.currentTarget);
	};

	issuesButton.onclick = function(e) {
		if ( -1 !== issuesMenu.className.indexOf( 'toggled-on' ) ) {
			issuesButton.className = issuesButton.className.replace( ' toggled-on', '' );
			issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
		} else {
			issuesButton.className += ' toggled-on';
			issuesMenu.className += ' toggled-on';
		}

		resetToggle(e.currentTarget);
	};

	searchButton.onclick = function(e) {
		if ( -1 !== searchForm.className.indexOf( 'toggled-on' ) ) {
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		} else {
			searchButton.className += ' toggled-on';
			searchForm.className += ' toggled-on';
		}

		resetToggle(e.currentTarget);
	};

	function resetToggle(buttonElement) {
		console.log(buttonElement);
		if ( -1 !== buttonElement.className.indexOf('menu-menu') ) {
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		} else if ( -1 !== buttonElement.className.indexOf('menu-topics') ) {
			issuesButton.className = issuesButton.className.replace( ' toggled-on', '' );
			issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		} else if ( -1 !== buttonElement.className.indexOf('menu-issues') ) {
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
			searchButton.className = searchButton.className.replace( ' toggled-on', '' );
			searchForm.className = searchForm.className.replace( ' toggled-on', '' );
		} else if ( -1 !== buttonElement.className.indexOf('menu-search') ) {
			menuButton.className = menuButton.className.replace( ' toggled-on', '' );
			issuesButton.className = issuesButton.className.replace( ' toggled-on', '' );
			issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		}
	};

} )();