jQuery(document).ready(function ($) {
	//USE GOOGLE CUSTOM SEARCH ENGINE. SEARCH BOX OVERRIDE LOCATED IN FUNCTIONS.PHP
	(function() {
	    var cx = '005851854580044185332:__5ai1guyvi';
	    var gcse = document.createElement('script');
	    gcse.type = 'text/javascript';
	    gcse.async = true;
	    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	        '//www.google.com/cse/cse.js?cx=' + cx;
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(gcse, s);
  	})();
});