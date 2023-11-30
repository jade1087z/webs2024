document.addEventListener("DOMContentLoaded", () => {
  let didScroll = false; // 스크롤 발생 여부
  let lastScrollTop = 0; // 마지막 스크롤 위치
  const delta = 5; // 스크롤 간격
  const navbarHeight = document.querySelector(".topLogo");

  // 스크롤 이벤트를 감지하고 didScroll 값을 true로 설정
  window.addEventListener("scroll", () => {
    didScroll = true;
  });

  // 주기적으로 스크롤 여부를 확인하고 처리하는 함수
  setInterval(() => {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  // 스크롤 이벤트에 따라 헤더 동작을 처리하는 함수
  function hasScrolled() {
    const st = window.scrollY; // 현재 스크롤 위치
    const nowHeight = window.innerHeight; // 현재 뷰포트 높이
    const documentHeight = Math.max(
      document.documentElement.scrollHeight,
      document.body.scrollHeight
    ); // 문서 전체 높이

    // 스크롤 간격이 작을 때는 동작하지 않음
    if (Math.abs(lastScrollTop - st) <= delta) return (didScroll = true);

    // 아래로 스크롤하고 스크롤 위치가 헤더 높이보다 클 때
    if (st > lastScrollTop && st > navbarHeight.offsetHeight) {
      navbarHeight.classList.remove("nav-down");
      navbarHeight.classList.add("nav-up");
    } else {
      // 위로 스크롤하거나 문서 끝까지 스크롤하면 헤더를 숨김
      if (st + nowHeight < documentHeight) {
        navbarHeight.classList.remove("nav-up");
        navbarHeight.classList.add("nav-down");
      }
    }

    lastScrollTop = st; // 마지막 스크롤 위치 업데이트
  }
});
