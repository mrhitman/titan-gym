$(window).ready(function() {
    $("#year").html((new Date()).getFullYear());

    $(".fancybox").fancybox();

    $('.navbar-items').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 350,
        scrollThreshold: 0.2,
        filter: '',
        easing: 'swing',
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