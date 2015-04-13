jQuery(document).ready(function ($) {
	
	/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		CONTACT FORM
	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	var textInputs = $('input[type="email"]');
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
				$(this).prev().hide();
			} else {
				$(this).prev().show();
			}
		});

		// On blur
		$(this).blur(function() {
			$(this).prev().removeClass('focus');

			// If field has value
			if ( $(this).val() ) {
				$(this).prev().hide();
			} else {
				$(this).prev().show();
			}
		});

		// On keydown
		$(this).keydown(function() {
			$(this).prev().hide();
		});
	});
	
});