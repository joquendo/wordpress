jQuery(document).ready(function ($) {
	
	//set a default
	$('#secondary').css({'position':'relative'});
	
	//Adjust sidebar height
	var pheight = $('#primary').height();
	var sheight = $('#secondary').height();
	
	if(pheight > sheight)
		$('#secondary').css({'position':'absolute'});
	
});