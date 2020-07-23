var ImageComparison = function($scope, $) {

    var data = $('#ua-image-comparison').data('config');
    // console.log(data);

    $("#ua-image-comparison").twentytwenty(data);
};

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ua-image-comparison.default",
        ImageComparison
    );
});