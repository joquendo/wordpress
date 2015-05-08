/**
 * Handles toggling the navigation search button and 
 * accessibility for the search form.
 */
( function() {
	var nav = document.getElementById( 'site-navigation' ),
	menuButton,
	topicsButton,
	issuesButton,
	searchButton,
	topicsMenu,
	issuesMenu,
	searchForm,
	topicsSliderOpen = false,
	issuesSliderOpen = false,
	searchSliderOpen = false;

	if ( ! nav ) {
		return;
	}

	menuButton   = nav.getElementsByTagName( 'button' )[0];
	topicsButton = nav.getElementsByTagName( 'button' )[1];
	issuesButton = nav.getElementsByTagName( 'button' )[2];
	searchButton = nav.getElementsByTagName( 'button' )[3];

	topicsMenu   = ( nav.getElementsByTagName( 'ul' )[0] ) ? nav.getElementsByTagName( 'ul' )[0].parentElement : null;
	issuesMenu	 = ( document.getElementById( 'menu-issues' ) ) ? document.getElementById( 'menu-issues' ).parentElement : null;
	searchForm   = document.getElementById( 'search-form' ); 

	if ( ! menuButton && ! topicsButton && ! searchButton && ! searchButton ) {
		return;
	}

	if ( ! issuesMenu ) {
		issuesButton.style.display = 'none';
		topicsMenu.style.right = '100px';
	}


	/* Set toggled styles on navigation buttons and menus */
	/* Slider animation--toggleSlider(this); */
	/* Toggle classes without animation--toggleClasses(this); */
	menuButton.onclick = function() {
		toggleSlider(this);
		toggleClasses(this);
		
	};
	topicsButton.onclick = function() {
		toggleSlider(this);
		toggleClasses(this);
	};
	issuesButton.onclick = function(e) {
		toggleSlider(this);
		toggleClasses(this);
	};
	searchButton.onclick = function(e) {
		toggleSlider(this);
		toggleClasses(this);
	};

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
	};

	function toggleClasses(buttonElement) {

		// Menu (mobile) or topics (full) button selected
		if ( -1 !== buttonElement.className.indexOf('menu-menu') || -1 !== buttonElement.className.indexOf('menu-topics') ) {
			
			if ( -1 !== buttonElement.className.indexOf( 'toggled-on' ) ) { // if toggled on
				menuButton.className = menuButton.className.replace( ' toggled-on', '' );
				topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
				topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		    } else { 
		        menuButton.className += ' toggled-on';
		  		topicsButton.className += ' toggled-on';
				topicsMenu.className += ' toggled-on';
		    }

		}

		// Issues button selected
		if ( -1 !== buttonElement.className.indexOf('menu-issues') ) {

			if ( -1 !== buttonElement.className.indexOf( 'toggled-on' ) ) {
				issuesButton.className = issuesButton.className.replace( ' toggled-on', '' );
				issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
			} else {
				issuesButton.className += ' toggled-on';
				issuesMenu.className += ' toggled-on';
			}

		}

		// Search button selected
		if ( -1 !== buttonElement.className.indexOf('menu-search') ) {

			if ( -1 !== buttonElement.className.indexOf( 'toggled-on' ) ) {
				searchButton.className = searchButton.className.replace( ' toggled-on', '' );
				searchForm.className = searchForm.className.replace( ' toggled-on', '' );
			} else {
				searchButton.className += ' toggled-on';
				searchForm.className += ' toggled-on';
			}

		}

		resetToggle(buttonElement);
	};

	function resetToggle(buttonElement) {

		if ( -1 !== buttonElement.className.indexOf('menu-menu') || -1 !== buttonElement.className.indexOf('menu-topics') ) {
			issuesButton.className = issuesButton.className.replace( ' toggled-on', '' );
			if ( issuesMenu ) issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
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
			if ( issuesMenu ) issuesMenu.className = issuesMenu.className.replace( ' toggled-on', '' );
			topicsButton.className = topicsButton.className.replace( ' toggled-on', '' );
			topicsMenu.className = topicsMenu.className.replace( ' toggled-on', '' );
		}
		
	};

	function toggleIssuesSlider() {
		jQuery('.menu-issues-container').slideToggle( {
			start : function () {
				//refresh width
				slider.slick('slickSetOption','slidesToShow',5,true);	
			},
			
			complete : function () {
				issuesSliderOpen = !issuesSliderOpen; /* toggle between true/false */
			}
		});
	}

	function toggleTopicsSlider() {
		jQuery(topicsMenu).slideToggle(300,
			function() {
		        topicsSliderOpen = !topicsSliderOpen; /* toggle between true/false */
		});
	}

	function toggleSearchSlider() {
		jQuery('#search-form-container').slideToggle(
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

var slider;
jQuery(document).ready(function(){
  slider = jQuery('#menu-issues').slick({
  	infinite		: false,
  	slidesToShow	: 5,
  	draggable		: false
  });
});