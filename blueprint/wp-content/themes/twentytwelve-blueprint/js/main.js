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
	topicsMenu   = nav.getElementsByTagName( 'ul' )[0].parentElement;
	issuesMenu	 = document.getElementById( 'menu-issues' ).parentElement; // Show/hide container element
	searchForm   = document.getElementById( 'searchform' ); 

	if ( ! menuButton && ! topicsButton && ! searchButton && ! searchButton ) {
		return;
	}

	// Hide button if search form is missing.
	if ( ! searchForm ) {
		searchButton.style.display = 'none';
	}

	/* Set toggled styles on navigation buttons and menus */
	menuButton.onclick = function(e) {

		toggleSlider(this);

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
		
		toggleSlider(this);

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

		toggleSlider(this);

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

		toggleSlider(this);

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

	var topicsSliderOpen = false;
	var issuesSliderOpen = false;
	var searchSliderOpen = false;

	/* Animation effect on button click */
	function toggleSlider(button) {
		if ( -1 !== button.className.indexOf('menu-issues') ) {
			if (topicsSliderOpen) toggleTopicsSlider();
			if (searchSliderOpen) toggleSearchSlider();
			toggleIssuesSlider();
		} else if ( -1 !== button.className.indexOf('menu-topics') ) {
			if (issuesSliderOpen) toggleIssuesSlider();
			if (searchSliderOpen) toggleSearchSlider();
			toggleTopicsSlider();
		} else if ( -1 !== button.className.indexOf('menu-search') ) {
			if (topicsSliderOpen) toggleTopicsSlider();
			if (issuesSliderOpen) toggleIssuesSlider();
			toggleSearchSlider();
		} else if (-1 !== button.className.indexOf('menu-menu') ) {
			if (issuesSliderOpen) toggleIssuesSlider();
			if (searchSliderOpen) toggleSearchSlider();
			toggleTopicsSlider();
		}
	}

	function toggleIssuesSlider() {
		jQuery('.menu-issues-container').slideToggle(
			function() {
	        	issuesSliderOpen = !issuesSliderOpen; /* toggle between true/false */
		});
	}

	function toggleTopicsSlider() {
		jQuery('.main-navigation .menu-topics-container').slideToggle(
			function() {
		        topicsSliderOpen = !topicsSliderOpen; /* toggle between true/false */
		});
	}

	function toggleSearchSlider() {
		jQuery('#searchform').slideToggle(
			function() {
	        	searchSliderOpen = !searchSliderOpen; /* toggle between true/false */
		});
	}

	/* Hover effect on issue dropdown menu */
	jQuery(issuesMenu).find('div.menu-item').hover(
		function() {
			jQuery('div.hover', this).css('display', 'inline-block');
		},
		function() {
			jQuery('div.hover', this).css('display', 'none');
		}
	);

	/* Rollover effect on category tags */
	jQuery('.entry-meta a').hover(
		function() {
			jQuery(this).addClass('hover');
		}, function() {
			jQuery(this).removeClass('hover');
		}
	);

} )();