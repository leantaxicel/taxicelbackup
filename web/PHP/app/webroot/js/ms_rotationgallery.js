(function( $ ) {
		
	$.fn.ms_rotationgallery = function() {

		source = this;
		var slides = [];
		var curPos = 0;
		var timer_ref = 0;
		var ANIMATION_DUR = 400;
		var AUTO_TIMER = 5000;
		//var gallery_height = ($(window).height()*90)/100;
		var gallery_height = 532;
		//var gallryOuterHeight = $(source).find(".slides").outerHeight(true);
		var gallryOuterHeight = gallery_height;
		var galleryOuterWidth = $(source).find(".slides").outerWidth(true);

		$s_slide = null;
		$next_slide = null;		

		$(source).find(".slides").css( { 
				"position" : "relative",
				"overflow" : "hidden",
				"height" : gallery_height+"px",
			}
		);
		
		var leftPos = 0;
		var imgW = 0;
		var imgH = 0;
		var scale = 0;
		var tp = 0;
		var lft = 0;
		$.each( $(source).find(".slides").children(), function(i,item) {
			imgW = $(item).attr('w');
			imgH = $(item).attr('h');
			//imgW = $(item).width();
			//imgH = $(item).height();
			scale = galleryOuterWidth/imgW;
			if( (scale * imgH) < gallryOuterHeight ) {
				scale = gallryOuterHeight/imgH;
			}
			imgW *= scale;
			imgH *= scale;
			//imgH = gallryOuterHeight;
			//tp = ( gallryOuterHeight-imgH)/2;
			tp = 0;
			lft = ( galleryOuterWidth-imgW )/2;
			
			$(item).css( 
				{ "position" : "absolute",
					"top": tp+"px",
					"left": lft+"px",
					"width": imgW+"px",
					//"height": imgH+"px",
					"display":"none" } );
					
			slides.push( $(item) );
			$s_slide = $(item);
			
		});
		
		// validate if items greater than 1
		if( slides.length > 1 ) {
			//$right_nav.show();
			//$left_nav.show();
		} else {
			return;
		}
		
		$s_slide = $(slides[ curPos ]);
		$s_slide.css( 
				{ "left": "0px" }).show();

		// Click listener for the buttons
	
		timer_ref = setInterval( autoRotate, AUTO_TIMER );
		
		// Methods
		function autoRotate() {
			rightNavigationClickHandler();
		}
		
		/* function leftNavigationClickHandler(e) {
			
			//$left_nav.hide();
			//$right_nav.hide();
			clearInterval( timer_ref );
			if( curPos == 0 ) {
				$next_slide = $(slides[ slides.length-1 ]);
				curPos = slides.length;
			} else  {
				$next_slide = $(slides[ curPos-1 ]);
			}
			$next_slide.show().css( 
					{"left": ($s_slide.outerWidth( true)*-1)+"px"} );
			
			$s_slide.animate({
				left: ( $s_slide.outerWidth( true) )+"px"
			}, ANIMATION_DUR, 'linear' );
			$next_slide.animate({
				left: "0px"
			}, ANIMATION_DUR, 'linear', function() {
				
				curPos--;
				timer_ref = setInterval( autoRotate, AUTO_TIMER );
			//	$left_nav.fadeIn( 700 );
			//	$right_nav.fadeIn( 700 );
				
				// validate whether it can go ahead
				if( curPos <= 0 )
					curPos = 0;	
				$s_slide = $next_slide;				
				
			});
			
		} */
		
		function rightNavigationClickHandler(e) {
			clearInterval( timer_ref );
			
			if( curPos >= slides.length-1 ) {
				$next_slide = $(slides[0]);
				curPos = -1; 
			} else  {
				$next_slide = $(slides[ curPos+1 ]);
			}
			
			$next_slide.show().css( 
					{"left": $s_slide.outerWidth( true)+"px"} );

			$s_slide.animate({
				left: ( $s_slide.outerWidth( true) * -1 )+"px"
			}, ANIMATION_DUR, 'linear' );
			
			
			$next_slide.animate({
				left: "0px"
			}, ANIMATION_DUR, 'linear', function() {
				
				curPos++;
				timer_ref = setInterval( autoRotate, AUTO_TIMER );
				if($(source).find(".imgselect").length>0){
					$($(source).find(".imgselect")).removeClass('active');
					$($(source).find(".imgselect")[curPos]).addClass('active');
				}
				
				// validate whether it can go ahead
				if( curPos >= slides.length )
					curPos = 0;		
				$s_slide = $next_slide;
				
			});
			
		}
		
	}

})( jQuery );