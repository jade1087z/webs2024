let swiper = new Swiper(".alcohol_list .swiper", {
<<<<<<< HEAD
  slidesPerView: 3,
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  direction: getDirection(),
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
      swiper.params.slidesPerView = getSlidesPerView(); // 화면 크기 변경 시 slidesPerView 업데이트
      swiper.update(); // Swiper를 업데이트하여 변경된 설정을 반영
    },
  },
=======
    slidesPerView: 3,
    spaceBetween: 10,
    loop: true,
    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    direction: getDirection(),
    on: {
        resize: function () {
            swiper.changeDirection(getDirection());
            swiper.params.slidesPerView = getSlidesPerView(); // 화면 크기 변경 시 slidesPerView 업데이트
            swiper.update(); // Swiper를 업데이트하여 변경된 설정을 반영
        }
    }
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
});

// 화면 크기에 따라 slidesPerView를 반환하는 함수
function getSlidesPerView() {
<<<<<<< HEAD
  let windowWidth = window.innerWidth;
  let slides;

  if (windowWidth < 600) {
    slides = 2;
  } else if (windowWidth >= 600 && windowWidth < 1200) {
    slides = 3;
  } else if (windowWidth >= 1200 && windowWidth < 1650) {
    slides = 4;
  } else if (windowWidth >= 1650) {
    slides = 5;
  }

  return slides;
=======
    let windowWidth = window.innerWidth;
    let slides;

    if (windowWidth < 600) {
        slides = 2;
    } else if (windowWidth >= 600 && windowWidth < 1200) {
        slides = 3;
    } else if (windowWidth >= 1200 && windowWidth < 1650) {
        slides = 4;
    } else if (windowWidth >= 1650) {
        slides = 5;
    }

    return slides;
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
}

// 화면 크기에 따라 슬라이드 방향을 반환하는 함수
function getDirection() {
<<<<<<< HEAD
  let windowWidth = window.innerWidth;
  let direction = windowWidth <= 0 ? "vertical" : "horizontal";
  return direction;
}
=======
    let windowWidth = window.innerWidth;
    let direction = windowWidth <= 0 ? "vertical" : "horizontal";
    return direction;
}
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
