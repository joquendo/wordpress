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
	
	/*--------------------------------------------------------
	definition: Initialize Events
	--------------------------------------------------------*/
	init: function () {
		
		//Store Dom Elements
		var $window   = jQuery(window);
		
		//Initialize Resize Events
		Infographic.initResize();
		
		//if the window is desktop Initialize the Open Event
		if( $window.width() > 600 ) {
			Infographic.initOpen();
		}
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Set Size and Position of lightbox
	--------------------------------------------------------*/
	setSizePosition: function () {
		Infographic.setImageHeight();
		Infographic.setPosition();
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Set Lightbox Positioning to be the center
	            height
	--------------------------------------------------------*/
	setPosition: function () {
		
		var $container = jQuery('.infographic-container');
		var height     = $container.height();
		$container.css({marginTop: '-'+(height/2)+'px'});
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Set Image Lightbox Height
	--------------------------------------------------------*/
	setImageHeight: function() {
		
		//Store Dom Elements
		var $container = jQuery('.infographic-container');
		var $window    = jQuery(window);
		var $image     = jQuery('.infographic-container .image img');
		
		//reset image styles
		$image.attr('style','');
		$container.attr('style','');
		
		//Make Three Passes to Adjust the Height to the correct height value
		for(var i=0; i<3; i++) {
		
			//resize image if taller than window
			var difference =  $container.height() - $window.height();
			
			//set 0 minimum
			if(difference < 0) difference = 0;
	
			//set new image height
			$image.css({
				maxHeight: ($image.height()-difference)+'px'
			});
			
			//adjust container to fit new image height
			$container.css({
				maxWidth: $image.width()+'px'
			});
		}
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Set Lightbox View
	--------------------------------------------------------*/
	generateView: function() {
		
		var html = '';
		
		html += '<div class="infographic-lightbox">';
		html += '  <div class="infographic-background"></div>';
		
		html += '  <div class="infographic-container">';
		
		html += '    <span class="image"><img src="http://loc.blueprint.luskin.ucla.edu/wp-content/uploads/2015/04/infographic.jpg" /></span>';
		
		html += '    <div class="close-container"><span class="icon-close"></span></div>';
		
		html += '    <span class="title">FPO Infographic Title: Crime, Organized</span>';
		
		html += '    <span class="issue-info">Spring 2016</span>';
		
		html += '  </div>';
		html += '</div>';
		
		return html;
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: On Resize of Browser
	--------------------------------------------------------*/
	initResize: function () {
		
		//Store Dom Elements
		var $window   = jQuery(window);
		
		//Attach a Resize Event
		$window.resize( function() {
			
			//Still resizing so clear the timer
			clearTimeout(this.resizeTimer);
			
			//Set resize timeout
			this.resizeTimer = setTimeout(function() {
				
				//if the window is desktop
				if( $window.width() > 600 ) {
					
					//open lightbox and set the size position
					Infographic.destroyOpen();
					Infographic.initOpen();
					Infographic.setSizePosition();
					
				//else the window is mobile
				} else {
					
					//Save Close Dom Element
					var $close = jQuery('.infographic-background, .infographic-container .icon-close');
					
					//close click event and disable the lightbox
					$close.trigger('click');
					Infographic.destroyOpen();
				}
			}, 250);
		});
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Bind a Click Event to Open the Lightbox
	--------------------------------------------------------*/
	initOpen: function () {
		
		//Store Dom Elements
		var $widget   = jQuery('.lightbox-open');
		var $body     = jQuery('body');
		
		//Bind a click event to any element with the class lightbox-open
		$widget.bind('click', function() {
		
			//generate the html markup
			var html = Infographic.generateView();
			$body.append(html);
			
			//Store the New Lightbox DOM
			var $lightbox = jQuery('.infographic-lightbox');
		
			//if the image in the lightbox is done
			$lightbox.imagesLoaded().done( function(instance) {
				
				//display lightbox
				$lightbox.css({display: 'block'});
				Infographic.setSizePosition();
				Infographic.initClose();
			});
		});
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Unbind the click event for the infographic 
	            widget
	--------------------------------------------------------*/
	destroyOpen: function() {
		
		var $widget   = jQuery('.lightbox-open');
		$widget.unbind('click');
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Bind a Click Event to Close the Lightbox
	--------------------------------------------------------*/
	initClose: function () {
		
		//Store Dom Elements
		var $closeEl  = jQuery('.infographic-background, .infographic-container .icon-close');
		var $lightbox = jQuery('.infographic-lightbox');
		
		//Bind Click Event to Close Elements
		$closeEl.bind('click', function() {
			
			$lightbox.css({display: 'none'});
			$lightbox.remove();
			$closeEl.unbind('click');
		});
	}
};