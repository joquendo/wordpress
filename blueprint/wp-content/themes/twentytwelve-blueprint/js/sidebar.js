jQuery(document).ready(function ($) {
	
	//Adjust sidebar height
	var pheight = $('#primary').height();
	var sheight = $('#secondary').height();
	
	if(pheight < sheight)
		$('#secondary').css({'position':'relative'});
	
});