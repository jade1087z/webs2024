$(function () {
    let currentIndex = 0;
    $(".imageWrap").append($(".image").first().clone(true));

    setInterval(() => {
        currentIndex++;
        $(".imageWrap").animate({ marginTop: -400 * currentIndex + "px" }, 600);

        if (currentIndex == 3) {
            setTimeout(() => {
                $(".imageWrap").animate({ marginTop: 0 }, 0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);

    $(".nav > ul > li").mouseover(function () {
        $(this).find(".submenu").stop().slideDown(300);
    });
    $(".nav > ul > li").mouseout(function () {
        $(this).find(".submenu").stop().slideUp(300);
    });

    $(".popup__btn").click(function () {
        $(".popup__view").show();
    });
    $(".popup__close").click(function () {
        $(".popup__view").hide();
    });
});
