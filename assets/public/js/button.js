(function( $ ) {
	'use strict';

	/**
	 * Button Widget
	 */
	var ButtonWidget = function( $scope, $ ) {
		// Button Widget JS functionality
		var $button = $scope.find('.orivo-btn-blocks');
		
		$button.on('hover', function() {
			$(this).addClass('active');
		});
	};

	// jQuery ready event
	$(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/ua-button.default', ButtonWidget);
	});

})( jQuery );
