jQuery(document).ready(function ($) {
	
	//set a default
	$('#secondary').css({'position':'relative'});
	
	//Adjust sidebar height
	var pheight = $('#primary').height();
	var sheight = $('#secondary').height();
	
	if(pheight > sheight)
		$('#secondary').css({'position':'absolute'});
		
		
		
		
		
	//Infographic Lightbox Start
	Infographic.init();
});






/*------------------------------------------------------------
Description: Functionality for the Infographics
------------------------------------------------------------*/
var Infographic = {
	
	resizeTimer:null,
	
	//Initialize
	init: function () {
		
		jQuery('.infographic-container').imagesLoaded().done( function(instance) {
			Infographic.setImageHeight();
			Infographic.setPosition();
			Infographic.initResize();
			Infographic.initOpen();
		});
	},
	
	
	
	
	//Set Lightbox top Position
	setPosition: function () {
		
		var $container = jQuery('.infographic-container');
		var height = $container.height();
		$container.css({marginTop: '-'+(height/2)+'px'});
	},
	
	
	
	
	//Set Image Lightbox Height
	setImageHeight: function() {
		
		var $container = jQuery('.infographic-container');
		var $window    = jQuery(window);
		var $image     = jQuery('.infographic-container .image img');
		
		//reset image
		$image.attr('style','');
		$container.attr('style','');
		
		for(var i=0; i<3; i++) {
		
			//resize image if taller than window
			var difference =  $container.height() - $window.height();
			
			//set 0 minimum
			if(difference < 0) difference = 0;
	
			//set image size
			$image.css({
				maxHeight: ($image.height()-difference)+'px'
			});
			
			$container.css({
				maxWidth: $image.width()+'px'
			});
		}
	},
	
	
	
	
	//On Resize of Browser
	initResize: function () {
		
		var $window = jQuery(window);
		
		$window.resize( function() {
			
			clearTimeout(this.resizeTimer);
			this.resizeTimer = setTimeout(function() {
				
				if($window.width() > 600) {
					Infographic.setImageHeight();
					Infographic.setPosition();
				}
			}, 250);
		});
	},
	
	
	
	
	
	//Bind a Click Event to Open the Lightbox
	initOpen: function () {
		
		var $widget   = jQuery('.widget.infographic');
		var $lightbox = jQuery('.infographic-lightbox');
		
		$widget.bind('click', function() {
		
			$lightbox.css({display: 'block'});
			Infographic.setImageHeight();
			Infographic.setPosition();
			Infographic.initClose();
		});
	},
	
	
	
	
	
	//Bind a Click Event to Close the Lightbox
	initClose: function () {
		
		var $close    = jQuery('.infographic-background, .infographic-container .icon-close');
		var $lightbox = jQuery('.infographic-lightbox');
		
		$close.bind('click', function() {
			
			$lightbox.css({display: 'none'});
			$close.unbind('click');
		});
	}
};