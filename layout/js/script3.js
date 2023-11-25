$(function () {
    let currentIndex = 0;
    $(".sliderWrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;
        $(".sliderWrap").animate(
            { marginTop: -350 * currentIndex + "px" },
            600
        );

        if (currentIndex == 3) {
            setTimeout(() => {
                $(".sliderWrap").animate({ marginTop: 0 }, 0);
                currentIndex = 0;
            }, 700);
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
