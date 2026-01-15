(function($) {
    'use strict';

    $(document).ready(function() {
        // Button hover effects
        $('.orivo-btn-blocks').on('mouseenter', function() {
            $(this).addClass('ua-btn-hover');
        }).on('mouseleave', function() {
            $(this).removeClass('ua-btn-hover');
        });

        // Button click effects
        $('.orivo-btn-blocks').on('click', function(e) {
            if ($(this).is('a') && $(this).attr('href')) {
                // Allow normal link behavior
                return;
            }
            e.preventDefault();
            $(this).addClass('ua-btn-active');
            setTimeout(function() {
                $(this).removeClass('ua-btn-active');
            }.bind(this), 200);
        });
    });
})(jQuery);
