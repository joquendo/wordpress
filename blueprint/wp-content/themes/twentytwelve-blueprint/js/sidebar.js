//on page load
jQuery(document).ready(function ($) {
			
	//Infographic Lightbox Start
	Infographic.init();
	
	//initialize the lightbox for images
	//$('.header-image-container img').lightboxInit();
	$('article img').lightboxInit();
});





var mobileBreakpoint = 736;

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
		if( $window.width() > mobileBreakpoint ) {
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
	generateView: function(meta) {
		
		var html = '';
		
		html += '<div class="infographic-lightbox">';
		html += '  <div class="infographic-background"></div>';
		
		html += '  <div class="infographic-container">';
		
		html += '    <span class="image"><img src="' + meta.url + '" /></span>';
		
		html += '    <div class="close-container"><span class="icon-close"></span></div>';
		
		html += '    <span class="title">' + meta.title + '</span>';
		
		html += '    <span class="issue-info">' + meta.issue + meta.issue_number + '</span>';
		
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
				if( $window.width() > mobileBreakpoint ) {
					
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
		
		var meta = {
			url: $widget.find('input[name="infographic"]').attr('value'),
			title: $widget.find('input[name="title"]').attr('value'),
			issue: $widget.find('input[name="issue"]').attr('value'),
			issue_number: ', issue #' + $widget.find('input[name="issue_number"]').attr('value')
		};
		
		//initialize the image lightbox
		jQuery('.lightbox-img').lightboxInit();
		
		//Bind a click event to any element with the class lightbox-open
		$widget.bind('click', function() {
			
			Infographic.createLightbox(meta);
			
			return false;
		});
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Create the Lightbox
	--------------------------------------------------------*/
	createLightbox: function(meta) {
		
		var $body = jQuery('body');
		
		//generate the html markup
		var html = Infographic.generateView( meta );
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
	},
	
	
	
	
	
	/*--------------------------------------------------------
	definition: Unbind the click event for the infographic 
	            widget
	--------------------------------------------------------*/
	destroyOpen: function() {
		
		var $widget = jQuery('.lightbox-open, .lightbox-img, .icon-expand');
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





/*------------------------------------------------------------
Description: Extend JQuery to allow the same infographic
             lightbox functionality
------------------------------------------------------------*/
jQuery.fn.extend({
	
	lightboxInit: function() {
		
		//Store Dom Elements
		var $window   = jQuery(window);
		
		return this.each( function() {
			
			//if the dom element is not an image exit
			if( jQuery(this).attr('src') === undefined || jQuery(this).attr('srcset') === undefined )
				return;
			
			//original image
			var srcset = String( jQuery(this).attr('srcset') ).split(',');
			var tmp = String( srcset[srcset.length-1] ).trim().split(' '); 
			var original = tmp[0];
			
			//store important meta values
			var meta = {
				url: original,
				title: '&nbsp;',
				issue: '&nbsp;',
				issue_number: '&nbsp;'
			};
			
			//tag each dom element with lightbox-img
			jQuery(this).addClass('lightbox-img');
			
			//disable link
			jQuery(this).parent('.lightbox-img-container').parent('a').bind('click', function() {
				return false;
			});
			
			//add zoom icon
			if( jQuery(this).parent('.lightbox-img-container').find('.icon-expand').length === 0 )
				jQuery(this).parent('.lightbox-img-container').append('<span class="icon-expand"></span>');
			
			//add align
			if( jQuery(this).parent('.lightbox-img-container').find('.alignleft').length > 0 ) {
				
				jQuery(this).parent('.lightbox-img-container').addClass('alignleft');
			} else if( jQuery(this).parent('.lightbox-img-container').find('.alignright').length > 0 ) {
				
				jQuery(this).parent('.lightbox-img-container').addClass('alignright');
			}
			
			//bind click event to image if it is desktop view
			if( $window.width() > mobileBreakpoint ) {
				
				jQuery(this).bind('click', function() {
				
					Infographic.createLightbox(meta);
					
					return false;
				})
				
				jQuery(this).next('.icon-expand').bind('click', function() {
				
					Infographic.createLightbox(meta);
					
					return false;
				})
			}
			
			
		});
	}
	
});