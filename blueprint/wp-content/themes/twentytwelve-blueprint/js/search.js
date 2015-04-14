jQuery(document).ready(function ($) {
	$('#submit-search-query').click(function() {
		var q = encodeURI( $('#search-query').val() );
		//SEND THE QUERY TO GOOGLE AND LOAD IN EXISTING WINDOW
		window.location.href = "https://www.google.com/#q="+q+"+site:blueprint.ucla.edu";
	});
});