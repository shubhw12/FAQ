( function( $ ) {

	var clicked = true;
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetHelloWorldHandler = function( $scope, $ ) {
		jQuery('.uael-accordion-content').attr('style', 'display:none');
		jQuery('.uael-accordion-title').click(function(){
			console.log('hi');
			console.log(clicked);
			if(clicked){
				jQuery(this).next('.uael-accordion-content').attr('style', 'display:none');
				jQuery(this).removeClass('uael-title-active')
				clicked = false;
			}
			else if( clicked === false){
				jQuery(this).next('.uael-accordion-content').attr('style', 'display:block');
				jQuery(this).addClass('uael-title-active');
				clicked = true;
			}

			
			
		    // jQuery(this).next('.uael-accordion-content').toggle('slow','swing',
		    // 	function(){jQuery(this).addClass('uael-title-active');},	
		    // 	function(){jQuery(this).removeClass('uael-title-active');}	
		    // 	);
		    
		  });
	}
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/hello-world.default', WidgetHelloWorldHandler );
		
	} );
} )( jQuery );
