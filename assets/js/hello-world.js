( function( $ ) {

	var clicked = true;
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetHelloWorldHandler = function( $scope, $ ) {

		// var scope_id = $scope.data( 'id' );
		var uael_faq_answer = $('.uael-faq-accordion > .uael-accordion-content').hide();
		var layout = $scope.find( '.uael-faq-container' );
		var faq_layout = layout.data('attribute');
				if( ! $('.uael-faq-container').hasClass('elementor-grid')){
			
			$('.uael-accordion-content').attr('style', 'display:none');
		}
			$('.uael-accordion-title').click(function(){

				if('toggle' == faq_layout){

					$(this).next('.uael-accordion-content').slideToggle('fast','swing',
						function(){
							if( $(this).prev().hasClass('uael-title-active') ){

								$(this).prev().removeClass('uael-title-active');
								$(this).prev().find(".uael-accordion-icon").children('.uael-accordion-icon-opened').hide();
								$(this).prev().find(".uael-accordion-icon").children('.uael-accordion-icon-closed').show();
							}
							else{

								$(this).prev().addClass('uael-title-active');
								$(this).prev().find(".uael-accordion-icon").children('.uael-accordion-icon-opened').show();
								$(this).prev().find(".uael-accordion-icon").children('.uael-accordion-icon-closed').hide();

							}
						}	
					);

				}
				else if('accordion' == faq_layout){
						
					    uael_faq_answer.slideUp();
					    $(this).next('.uael-accordion-content').slideDown();
					    return false;
				}

			});
		
	}
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/hello-world.default', WidgetHelloWorldHandler );
		
	} );
} )( jQuery );
