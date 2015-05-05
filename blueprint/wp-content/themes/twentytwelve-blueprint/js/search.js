jQuery(document).ready(function ($) {
	/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		SEARCH BOX
		SELECTING SPECIFICALLY FOR SEARCH BOX IN HEADER
	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	var textInputs = $('#search-query');
	var textLabels = textInputs.prev('label');

	textLabels.addClass('float');


	// Fade on focus, hide on keydown
	textInputs.each(function() {
		// If field has value
		if ( $(this).val() ) {
			$(this).prev('label').hide();
		} else {
			$(this).prev('label').show();
		}

		// On focus
		$(this).focus(function() {
			$(this).prev().addClass('focus');

			// If field has value
			if ( $(this).val() ) {
				$(this).prev('label').hide();
			} else {
				$(this).prev('label').show();
			}
		});

		// On blur
		$(this).blur(function() {
			$(this).prev().removeClass('focus');

			// If field has value
			if ( $(this).val() ) {
				$(this).prev('label').hide();
			} else {
				$(this).prev('label').show();
			}
		});

		// On keydown
		$(this).keydown(function() {
			$(this).prev('label').hide();
		});
	});

	/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		SEARCH BOX
		SEND THE URL ENCODED QUERY TO GOOGLE WITH SITE:BLUEPRINT.UCLA.EDU
	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	$('#submit-search-query').click(function() {  //GO BUTTON CLICKED
		var q = encodeURI( $('#search-query').val() );
		//SEND THE QUERY TO GOOGLE AND LOAD IN EXISTING WINDOW
		window.location.href = "https://www.google.com/#q="+q+"+site:blueprint.ucla.edu";
	});
	$('#search-form').keydown(function(e) { //ENTER/RETURN KEYBOARD BUTTON PUSHED
	    if (e.keyCode == 13) {
		    e.preventDefault();
		    var q = encodeURI( $('#search-query').val() );
			//SEND THE QUERY TO GOOGLE AND LOAD IN EXISTING WINDOW
			window.location.href = "https://www.google.com/#q="+q+"+site:blueprint.ucla.edu";
		}
	});
});