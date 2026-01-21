(function($) {
	'use strict';

	var UaTabBlocks = function($scope, $) {
		var $tabsContainer = $scope.find('[data-tabs--blocks]');

		if ($tabsContainer.length === 0) {
			return;
		}

		var $indicator = $tabsContainer.find('.orivo-tabs--blocks__indicator');
		var $btns = $tabsContainer.find('.orivo-tabs--blocks__tab');
		var $panels = $tabsContainer.find('.orivo-tabs--blocks__panel');

		function moveIndicator($btn) {
			var btnOffset = $btn.position();

			$indicator.css({
				'width': $btn.outerWidth(),
				'height': $btn.outerHeight(),
				'transform': 'translate(' + btnOffset.left + 'px, ' + btnOffset.top + 'px)'
			});
		}

		$btns.on('click', function(e) {
			e.preventDefault();

			var $clickedBtn = $(this);

			// Remove active from all
			$btns.removeClass('is-active');
			$panels.removeClass('is-active');
			$indicator.removeClass('is-active');

			// Add active to clicked
			$clickedBtn.addClass('is-active');
			$indicator.addClass('is-active');

			var tabId = $clickedBtn.data('tab');
			$('#' + tabId).addClass('is-active');

			moveIndicator($clickedBtn);
		});

		// Hover effect for indicator
		$btns.on('mouseenter', function() {
			$indicator.addClass('is-hover');
		}).on('mouseleave', function() {
			$indicator.removeClass('is-hover');
		});

		// Initialize
		var $activeBtn = $btns.filter('.is-active');
		if ($activeBtn.length > 0) {
			setTimeout(function() {
				moveIndicator($activeBtn);
				$indicator.addClass('is-active');
			}, 10);
		}

		$(window).on('resize', function() {
			var $currentActive = $btns.filter('.is-active');
			if ($currentActive.length > 0) {
				moveIndicator($currentActive);
			}
		});
	};

	$(window).on('elementor/frontend/init', function() {
		// Try both underscore and hyphen versions
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/ua_tab.default',
			UaTabBlocks
		);
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/ua-tab.default',
			UaTabBlocks
		);
	});

})(jQuery);
