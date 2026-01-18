(function($) {
    'use strict';

    var UaCounterBlocks = function($scope, $) {
        var $container = $scope.find('.orivo-counter-blocks');

        if ($container.length === 0) {
            return;
        }

        var animateValue = function($countElement, target, duration) {
            var start = 0;
            var increment = target / 100;
            var timer = setInterval(function() {
                start += increment;
                if (start >= target) {
                    start = target;
                    clearInterval(timer);
                }
                $countElement.text(Math.floor(start));
            }, duration / 100);
        };

        var startAnimations = function() {
            var isLayout1 = $container.hasClass('orivo-counter-blocks--layout-1');
            var isLayout2 = $container.hasClass('orivo-counter-blocks--layout-2');
            var isLayout3 = $container.hasClass('orivo-counter-blocks--layout-3');

            // Layout 1 & 3: Number counter
            if (isLayout1 || isLayout3) {
                $container.find('.orivo-counter-blocks__number').each(function() {
                    var $this = $(this);
                    var $countElement = $this.find('.orivo-counter-blocks__count');
                    if ($this.css('display') !== 'none' && $countElement.length) {
                        var target = parseInt($this.data('target')) || 0;
                        animateValue($countElement, target, 2000);
                    }
                });
            }

            // Layout 2: Circular Progress with percentage counter
            if (isLayout2) {
                $container.find('.orivo-counter-blocks__progress').each(function() {
                    var $wrapper = $(this);
                    var percent = parseInt($wrapper.data('percent')) || 100;

                    // Animate circular progress
                    $wrapper.find('.orivo-counter-blocks__circle-progress').each(function() {
                        var $circle = $(this);
                        var circumference = 2 * Math.PI * 70;
                        var offset = circumference - (circumference * percent / 100);

                        setTimeout(function() {
                            $circle.css('stroke-dashoffset', offset);
                        }, 100);
                    });

                    // Animate percentage number
                    $wrapper.find('.orivo-counter-blocks__progress-number .orivo-counter-blocks__count').each(function() {
                        var $countEl = $(this);
                        animateValue($countEl, percent, 1500);
                    });
                });
            }

            // Layout 3: Bar Progress
            if (isLayout3) {
                $container.find('.orivo-counter-blocks__progress').each(function() {
                    var $bar = $(this);
                    var percent = parseInt($bar.data('percent')) || 100;

                    setTimeout(function() {
                        $bar.find('.orivo-counter-blocks__progress-bar').css('width', percent + '%');
                    }, 100);
                });
            }
        };

        // Use Intersection Observer for scroll-triggered animation
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    startAnimations();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe($container[0]);
    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/ua_counter.default',
            UaCounterBlocks
        );
    });

})(jQuery);
