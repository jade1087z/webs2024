<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>취중진담</title>

    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">

    <!-- favicon -->
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/index.css" rel="stylesheet" />
    <link href="../assets/css/alcohol.css" rel="stylesheet" />

    <!-- js -->
    <script src="../assets/js/scrollEvent.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- PC HEADER 840 < window -->
        <?php include "../include/header.php"; ?>

        <!-- M HEADER 840 > window -->
        <?php include "../include/logo.php"; ?>

        <?php include "../include/headerbottom.php"; ?>
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">
                <!-- <div class="alcohol_search">
                    <input class="inputReset boxStyle roundCorner shaDow" type="text" name="alcohol_search" id="alcohol_search" placeholder="술 이름을 입력하세요.">
                    <label for="alcohol_search"><i class="fa-solid fa-magnifying-glass"></i></label>
                </div> -->
                <!-- alcohol_search -->

                <div class="ranking_list boxStyle roundCorner shaDow">
                    <h4>이번주 인기 주류 <span>TOP10</span></h4>
                    <div class="alcohol_list">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <span class="rankedIn">1</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (1).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span class="rankedIn">2</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (2).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span class="rankedIn">3</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (3).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>4</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (4).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>5</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (5).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>6</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (1).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>7</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (2).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>8</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (3).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>9</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (4).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>10</span>
                                    <a href="alcohol_page.html">
                                        <img src="../assets/img/card (5).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ranking_list -->


                <div class="alcohol_select">
                    <ul>
                        <li class="all"><a href="#">전체</a></li>
                        <li class="soju"><a href="#">소주</a></li>
                        <li class="beer"><a href="#">맥주</a></li>
                        <li class="sake"><a href="#">사케</a></li>
                        <li class="wisky"><a href="#">위스키</a></li>
                        <li class="mag"><a href="#">막걸리</a></li>
                    </ul>
                </div>
                <!-- alcohol_select -->

                
                <div class="alcohol_item">
                    <ul class="ac_wrap">
                        <!-- 술 리스트 영역 -->
                    </ul>
                </div>
                <!-- alcohol_item -->

            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>

    <script>
        // 페이지가 로드 된 후 실행
        document.addEventListener('DOMContentLoaded', function () {

            // .ac_wrap을 변수에 저장
            const ac_wrap = document.querySelector(".ac_wrap");
            const acItem = document.querySelectorAll('.alcohol_select li');


            // 클릭한 주종 인덱스를 변수에 저장
            let clickIndex = 0;


            acItem.forEach((item, index) => {
                item.addEventListener('click', function () {
                    
                    // 클릭한 클래스 이름을 변수에 저장
                    clickClass = item.className;
                    clickIndex = index;

                    // 클릭한 li에 .active
                    acItem.forEach((li) => {
                        li.classList.remove('active');
                    });
                    item.classList.add('active');

                    // 클릭한 클래스 이름을 가지고 함수 실행
                    getJsonByClass(clickClass);
                });
                return clickIndex;
            });

            // JSON 파일을 가져오는 함수
            const getJsonByClass = (className) => {
                const jsonPaths = {
                    "all": "../json/all.json",
                    "soju": "../json/soju.json",
                    "beer": "../json/beer.json",
                    "sake": "../json/sake.json",
                    "wisky": "../json/wisky.json",
                    "mag": "../json/mag.json"
                };

                // 지정된 클래스 이름에 해당하는 JSON 파일 경로 가져오기
                jsonPath = jsonPaths[className];

                // JSON 데이터 가져오기
                if (jsonPath) {
                    fetch(jsonPath)
                        .then(res => res.json())
                        .then(data => {
                            // JSON 데이터를 받은 후, 업데이트 함수 호출
                            updataAc(data, clickIndex);
                        })
                        .catch(error => {
                            console.error("JSON 데이터를 불러오지 못했습니다.", error);
                        });
                } else {
                    console.error("유효하지 않은 클래스 이름입니다.");
                }
            };


            


            // 문제 출력
            const updataAc = (acInfo, clickIndex) => {

                const acArray = [];

                // JSON 데이터 acArray에 배열로 저장
                acInfo.forEach((ac, number) => {

                    acArray.push(`
                        <li class="boxStyle roundCorner shaDow">
                            <a id="${clickIndex}-${number}" href="#">
                                <div class="item_img">
                                    <img src="${ac.img}" alt="alcohol">
                                </div>
                                <div class="item_info">
                                    <h4>${ac.name}</h4>
                                    <p>${ac.company}</p>
                                </div>
                                <div class="item_summary">
                                    <ul>
                                        <li class="summary_good"><i class="fa-regular fa-thumbs-up"></i> <span>${ac.like}</span></li>
                                        <li class="summary_comment"><i class="fa-solid fa-comment"></i> <span>${ac.view}</span></li>
                                        <li class="summary_abv"><i class="fa-solid fa-wine-glass"></i> <span>${ac.alcohol}</span></li>
                                    </ul>
                                </div>
                            </a>
                        </li> 
                    `);
                });

                // ac_wrap 안에 데이터 배열 넣어줌
                ac_wrap.innerHTML = acArray.join("");

            }

        
        
            // 술 목록의 기본값
            getJsonByClass('all');
            document.querySelector(".alcohol_select .all").classList.add('active');
        
        
        });
    </script>
</body>

</html>