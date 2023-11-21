$(function () {
    let currentIndex = 0;
    $(".sliderWrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;
        $(".sliderWrap").animate(
            { marginLeft: -100 * currentIndex + "%" },
            300
        );

        if (currentIndex == 3) {
            setTimeout(() => {
                $(".sliderWrap").animate({ marginLeft: 0 }, 0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);

    let currentIndex = 0;
    $(".sliderWrap").append($(".slider").first().cline(true));

    setInterval(() => {
        currentIndex++;
        $(".sliderWrap").animate(
            { marginLeft: -100 * currentIndex + "%" },
            300
        );
        if (currentIndex == 3) {
            setTimeout(() => {
                $(".sliderWrap").animate({ marginLeft: 0 }, 0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);

    $(".nav > ul > li").mouseover(function () {
        $(this).find(".submenu").stop().slideDown();
    });

    $(".nav > ul > li").mouseout(function () {
        $(this).find(".submenu").stop().slideUp();
    });

    $(".popup__btn").click(function () {
        $(".popup__view").show();
    });
    $(".popup__close").click(function () {
        $(".popup__view").hide();
    });
});
