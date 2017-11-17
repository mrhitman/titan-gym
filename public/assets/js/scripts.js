$(window).ready(function() {
    var now = new Date();

    $("#year").html(now.getFullYear());

    $(".fancybox").fancybox();

    $('.navbar-items').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 950,
        scrollThreshold: 0.2,
        filter: '',
        easing: 'swing',
        begin: function () {
        },
        end: function () {
        },
        scrollChange: function ($currentListItem) {
        }
    });

    $('.flexslider').flexslider({
        animation: "slide",
        easing: "swing",
        direction: "horizontal",
        animationLoop: true,
        smoothHeight: false,
        startAt: 0,
        slideshow: true,
        slideshowSpeed: 4000,
        animationSpeed: 600,
        initDelay: 0,
        randomize: true,
        controlNav: true,
        directionNav: false,
    });
});