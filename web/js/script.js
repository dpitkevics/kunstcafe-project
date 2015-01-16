$(function () {
    // hide #back-top first
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    $(".image-block").hover(function () {
        $(this).find(".overlay").stop();
        $(this).find(".overlay").fadeIn();
    }, function () {
        $(this).find(".overlay").stop();
        $(this).find(".overlay").fadeOut();
    });

    var controller = $.superscrollorama({
        triggerAtCenter: false,
        playoutAnimations: true
    });

    controller.addTween(250, TweenMax.to($("#main-banner-text"), 1, {css:{top:"55rem"}}));
    controller.addTween(800, TweenMax.to($("#main-banner-text"), .5, {css:{opacity:0}}));

    $(window).resize(function () {
        positionAllInMiddleElements();
        controller.triggerCheckAnim();
    });

    $(".scroll-fade-in").each (function () {
        var offsetTop = $(this).offset().top;
        controller.addTween(offsetTop - ($(window).height() / 2), TweenMax.from($(this), 0.5, {css:{opacity:0, "margin-top":"50px"}}));
    });

    $(".artist-row").on("click", function () {
        window.location = $(this).data("href");
    });
});

$(window).on("load", function () {
    positionAllInMiddleElements();
});

function positionAllInMiddleElements()
{
    $(".in-middle").each(function () {
        if (typeof($(this).data('vertical'))==='undefined' && typeof($(this).data('horizontal'))==='undefined') {
            $(this).animate({
                'top': ($(this).parent().height() / 2) - ($(this).height() / 2),
                'left': ($(this).parent().width() / 2) - ($(this).width() / 2)
            });
        } else {
            if (typeof($(this).data('vertical'))!=='undefined') {
                $(this).animate({
                    'top': ($(this).parent().height() / 2) - ($(this).height() / 2)
                });
            }

            if (typeof($(this).data('horizontal'))!=='undefined') {
                $(this).animate({
                    'left': ($(this).parent().width() / 2) - ($(this).width() / 2)
                });
            }
        }
    });
}