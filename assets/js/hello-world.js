( function( $ ) {

	var clicked = true;
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetHelloWorldHandler = function( $scope, $ ) {
		$('.uael-accordion-content').attr('style', 'display:none');
		$('.uael-accordion-title').click(function(){
			 console.log('hi');
		    $(this).next('.uael-accordion-content').slideToggle('slow','swing',
		    	function(){
			    		if( $(this).prev().hasClass('uael-title-active') ){
							$(this).prev().removeClass('uael-title-active');
			    		}
			    		else{
			    			$(this).prev().addClass('uael-title-active');
			    		}
		    	    }	
		    	);
		  });
	}
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/hello-world.default', WidgetHelloWorldHandler );
		
	} );
} )( jQuery );
