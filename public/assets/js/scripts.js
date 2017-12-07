$(window).ready(function () {
    $("#year").html((new Date()).getFullYear());

    $(".fancybox").fancybox({});

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

    $("#comment-form").on("submit", function (e) {
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var comment = $("#comment").val();
        $.ajax({
            type: 'POST',
            url: $("#comment-form").attr("action"),
            data: {
                name: name,
                email: email,
                comment: comment,
                published: 1
            },
            success: function (r) {
                if (!r) {
                    return;
                }
                $(".comments").append("<div class=\"row\">\n" +
                    "            <div class=\"offset-lg-1 col-lg-9 comment-box\">\n" +
                    "                <div class=\"header\">\n" +
                    "                    <div class=\"name\"><b>" + r.name + "</b>: " + r.email + "</div>\n" +
                    "                    <div class=\"date\">" + r.date + "</div>\n" +
                    "                </div>\n" +
                    "                <div class=\"comment\">" + r.comment + "</div>\n" +
                    "            </div>\n" +
                    "        </div>");
            }
        });
        $("#name").val('');
        $("#email").val('');
        $("#comment").val('');
    });
});