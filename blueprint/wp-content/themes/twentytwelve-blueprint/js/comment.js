//on page load
jQuery(document).ready(function ($) {
		
	//store comment form dom
	var $comment = 	$('#commentform input[type="text"], #commentform textarea');
	
	//clear label
	$comment.each(function() {
		
		if( $(this).val() !== '' )
			$(this).prev('label').css({'display':'none'})
	});
		
	//Comment Label
	$comment.bind('focus', function() {
		$(this).prev('label').css({'display':'none'})
	});
	
	$comment.bind('blur', function() {
		
		if($(this).val() === '')
			$(this).prev('label').css({'display':'block'})
	});	
	
	
	//Validate for empty form field
	$('#commentform').bind('submit', function() {
		
		var blank = true;
		
		//check if fields are blank
		$comment.each(function () {
			
			if( $(this).val() !== '')
				blank = false;
		});
		
		//if blank show error
		if(blank) {

			if( $('#commentform .error').length === 0 )
				$(this).append('<span class="error">Please type a comment.</span>');
			return false;
			
		//submit the form
		} else {
			$(this).find('.error').remove();
			return true;
		}
	});
});