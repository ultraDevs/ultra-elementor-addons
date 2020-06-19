var UaAccordion = function($scope, $) {
    var $accordion = $scope.find('.ua-accordion');
    var $accordion_header = $scope.find('.ua-accordion-header');
    var $accordion_icon = $($accordion_header).find('i');
    var $accordion_item = $scope.find('.ua-accordion__item');
    var $accordion_content = $scope.find('.ua-accordion-body__contents');
    var $speed = $($accordion).data('speed');

    var $activeClass = 'ua-a-active';

    $($accordion_header).on("click", function() {
        if ($(this).hasClass($activeClass)) {
            $(this).removeClass($activeClass);
            $(this)
                .siblings($accordion_content)
                .slideUp($speed);
            $($accordion_icon)
                .removeClass("fa-minus")
                .addClass("fa-plus");
        } else {
            $($accordion_icon)
                .removeClass("fa-minus")
                .addClass("fa-plus");
            $(this)
                .find("i")
                .removeClass("fa-plus")
                .addClass("fa-minus");
            $($accordion_header).removeClass($activeClass);
            $(this).addClass($activeClass);
            $($accordion_content).slideUp($speed);
            $(this)
                .siblings($accordion_content)
                .slideDown($speed);
        }
    });

}

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ua-accordion.default",
        UaAccordion
    );
});