jQuery(function($) {

    $('.ua-tabs__content .ua-tabs__item').hide();
    $('.ua-tabs__content .ua-tabs__item:first').show();
    $('.ua-tabs__nav li:first').addClass('tabs__is-active');
    $('.ua-tabs__nav a').click(function(e) {
        window.location.hash = event.currentTarget.hash;
        e.preventDefault();
        $('.ua-tabs__nav li').removeClass('tabs__is-active');
        $(this).parent().addClass('tabs__is-active');
        $('.ua-tabs__content .ua-tabs__item').hide();
        $($(this).attr('href')).show();

        $('#toplevel_page_ultra-addons .wp-submenu').find('a').filter(function(i, a) {
            return event.currentTarget.hash === a.hash;
        }).parent().addClass('current').siblings().removeClass('current');
    });

    //

    $('#toplevel_page_ultra-addons > .wp-submenu a').on('click', function(e) {
        if (!e.currentTarget.hash) {
            return true;
        }
        e.preventDefault();
        window.location.hash = e.currentTarget.hash;
        var $hash = e.currentTarget;

        $('.ua-tabs__nav li').find('a[href="' + window.location.hash + '"]').click();
        $('#toplevel_page_ultra-addons .wp-submenu').find('a').filter(function(i, a) {
            return window.location.hash === a.hash;
        }).parent().addClass('current').siblings().removeClass('current');
    });

    if (window.location.hash) {
        var $hash = window.location.hash;
        $('.ua-tabs__nav li').find('a[href="' + window.location.hash + '"]').click();
        $('#toplevel_page_ultra-addons .wp-submenu').find('a').filter(function(i, a) {
            return window.location.hash === a.hash;
        }).parent().addClass('current').siblings().removeClass('current');
    }
});