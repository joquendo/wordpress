jQuery(document).ready(function ($) {
	
	/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		CONTACT FORM
		SELECTING SPECIFICALLY FOR FOOTER SUBSCRIBE FORM
	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	var textInputs = $('#colophon input[type="email"]');
	var textLabels = textInputs.closest('p').find('label');

	textLabels.addClass('float');


	// Fade on focus, hide on keydown
	textInputs.each(function() {
		// If field has value
		if ( $(this).val() ) {
			$(this).closest('p').find('label').hide();
		} else {
			$(this).closest('p').find('label').show();
		}

		// On focus
		$(this).focus(function() {
			$(this).prev().addClass('focus');

			// If field has value
			if ( $(this).val() ) {
				$(this).closest('p').find('label').hide();
			} else {
				$(this).closest('p').find('label').show();
			}
		});

		// On blur
		$(this).blur(function() {
			$(this).prev().removeClass('focus');

			// If field has value
			if ( $(this).val() ) {
				$(this).closest('p').find('label').hide();
			} else {
				$(this).closest('p').find('label').show();
			}
		});

		// On keydown
		$(this).keydown(function() {
			$(this).closest('p').find('label').hide();
		});
	});
	
});