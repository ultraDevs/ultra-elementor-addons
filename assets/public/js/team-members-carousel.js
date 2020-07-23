var uaTeamMembersCarousel = function($scope, $) {
    // Tesimonial
    var slides = $('.ua-tm-carousel').data('slides');
    var autoplay = $('.ua-tm-carousel').data('autoplay');
    var autoplay_speed = $('.ua-tm-carousel').data('autoplay-speed');
    //console.log(responsive);
    $('.ua-tm-carousel-c').slick({
        dots: true,
        infinite: true,
        autoplay: autoplay,
        autoplaySpeed: autoplay_speed,
        draggable: true,
        /* speed: 300, */
        prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="eicon-angle-left"></i></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="eicon-angle-right"></i></button>',
        slidesToShow: slides,
        slidesToScroll: slides,
        responsive: [
            /* {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        }, */
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
};

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ua-team-members-carousel.default",
        uaTeamMembersCarousel
    );
});