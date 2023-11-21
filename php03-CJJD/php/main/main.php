<?php
include "../connect/connect.php";
include "../connect/session.php";

//술 정보 가져오기 (좋아요+댓글) 많은 아이템을 조회순으로 보여줌
$acTopList = "SELECT *, (acLike + acComment) AS like_comment_total
              FROM drinkList
              ORDER BY like_comment_total DESC, acView DESC
              LIMIT 10;";
$acRank = $connect->query($acTopList);
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

    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/index.css" rel="stylesheet" />

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

                <?php include "../alcohol/acRank.php"; ?>
                <!-- ranking_list -->

                <div class="best_list boxStyle roundCorner shaDow">
                    <h4>인기 게시글 <span>HOT</span></h4>
                    <ul class="board_w100">
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">술 땡기는 금요일~ 곱창에 소주 땡기네요.</div>
                                    <div class="board_author textCut">안주킬러</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">오늘 오전에 음주운전 교통사고 보셨나요? 다들 조심하세요ㅠㅠ!</div>
                                    <div class="board_author textCut">헤롱이</div>
                                    <div class="board_date">10.31</div>
                                    <div class="board_view"> <span>29</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">김과장 개열받네ㅋㅋ</div>
                                    <div class="board_author textCut">하하루</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">다들 주사 뭐임? 나는 했던 말 계속하는거임. 다들 주사 뭐임?</div>
                                    <div class="board_author textCut">혼술의 묘미</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>19</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">소주 가격 오른거 실화임?</div>
                                    <div class="board_author textCut">술부심</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="best_list boxStyle roundCorner shaDow">
                    <h4>최신 게시글 <span>NEW</span></h4>
                    <ul class="board_w100">
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">술 땡기는 금요일~ 곱창에 소주 땡기네요.</div>
                                    <div class="board_author textCut">안주킬러</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">오늘 오전에 음주운전 교통사고 보셨나요? 다들 조심하세요ㅠㅠ!</div>
                                    <div class="board_author textCut">헤롱이</div>
                                    <div class="board_date">10.31</div>
                                    <div class="board_view"> <span>29</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">김과장 개열받네ㅋㅋ</div>
                                    <div class="board_author textCut">하하루</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">다들 주사 뭐임? 나는 했던 말 계속하는거임. 다들 주사 뭐임?</div>
                                    <div class="board_author textCut">혼술의 묘미</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>19</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">소주 가격 오른거 실화임?</div>
                                    <div class="board_author textCut">술부심</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="best_list boxStyle roundCorner shaDow">
                    <h4>추천 게시글 <span>Pick!</span></h4>
                    <ul class="board_w100">
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">술 땡기는 금요일~ 곱창에 소주 땡기네요.</div>
                                    <div class="board_author textCut">안주킬러</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">오늘 오전에 음주운전 교통사고 보셨나요? 다들 조심하세요ㅠㅠ!</div>
                                    <div class="board_author textCut">헤롱이</div>
                                    <div class="board_date">10.31</div>
                                    <div class="board_view"> <span>29</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">김과장 개열받네ㅋㅋ</div>
                                    <div class="board_author textCut">하하루</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">다들 주사 뭐임? 나는 했던 말 계속하는거임. 다들 주사 뭐임?</div>
                                    <div class="board_author textCut">혼술의 묘미</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>19</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="board_view.html">
                                <div class="board_info">
                                    <div class="board_title textCut">소주 가격 오른거 실화임?</div>
                                    <div class="board_author textCut">술부심</div>
                                    <div class="board_date">11.01</div>
                                    <div class="board_view"> <span>999</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- header end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>
</body>

</html>