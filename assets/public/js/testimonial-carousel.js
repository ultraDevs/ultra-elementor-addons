var uaTestimonial = function($scope, $) {
    // Tesimonial
    var desktop = $('.ua-testimonial-carousel').data('desktop');
    var mobile = $('.ua-testimonial-carousel').data('mobile');
    var tablet = $('.ua-testimonial-carousel').data('tablet');
    //console.log(responsive);
    $('.ua-testimonial-c').owlCarousel({
        loop: true,
        margin: 0,
        center: true,
        autoplay: true,
        autoplayTimeout: 2000,
        smartSpeed: 450,
        dots: true,
        nav: true,
        navText: ["<i class='eicon-angle-left'></i>", "<i class='eicon-angle-right'></i>"],
        responsive: {
            0: {
                items: +mobile
            },
            544: {
                items: +mobile
            },
            768: {
                items: +tablet
            },
            1200: {
                items: +desktop
            }
        }
    });
}

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ua-testimonial-carousel.default",
        uaTestimonial
    );
});