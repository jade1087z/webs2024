let swiper = new Swiper(".alcohol_list .swiper", {
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
});

// 화면 크기에 따라 slidesPerView를 반환하는 함수
function getSlidesPerView() {
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
}

// 화면 크기에 따라 슬라이드 방향을 반환하는 함수
function getDirection() {
  let windowWidth = window.innerWidth;
  let direction = windowWidth <= 0 ? "vertical" : "horizontal";
  return direction;
}
