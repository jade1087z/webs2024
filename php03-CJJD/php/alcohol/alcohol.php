<?php
include "../connect/connect.php";
include "../connect/session.php";

$acSql = "SELECT * FROM drinkList WHERE acDelete = 1 ORDER BY acId";
$acInfo = $connect->query($acSql);

//술 랭킹 가져오기 (좋아요+댓글) 많은 아이템을 조회순으로 보여줌
$acTopList = "SELECT *, (acLike + acComment) AS like_comment_total
              FROM drinkList
              ORDER BY like_comment_total DESC, acView DESC
              LIMIT 10;";
$acRank = $connect->query($acTopList);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <!-- 공통 -->
    <?php include "../include/head.php" ?>

    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- 개별 css -->
    <link href="../assets/css/ranking.css" rel="stylesheet" />
    <link href="../assets/css/alcohol.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php include "../include/header.php"; ?>
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">

                <?php include "../include/acRank.php"; ?>
                <!-- ranking_list -->

                <div class="alcohol_select">
                    <ul>
                        <li class="all active"><a href="./alcohol.php">전체</a></li>
                        <li class="soju"><a href="./alcohol_list.php?category=소주">소주</a></li>
                        <li class="beer"><a href="./alcohol_list.php?category=맥주">맥주</a></li>
                        <li class="sake"><a href="./alcohol_list.php?category=사케">사케</a></li>
                        <li class="wisky"><a href="./alcohol_list.php?category=위스키">위스키</a></li>
                        <li class="mag"><a href="./alcohol_list.php?category=막걸리">막걸리</a></li>
                    </ul>
                </div>
                <!-- alcohol_select -->


                <div class="alcohol_item">
                    <ul class="ac_wrap">
                        <?php foreach ($acInfo as $cate) { ?>
                            <li class="boxStyle roundCorner shaDow">
                                <a id="<?= $cate['acId'] ?>" href="alcohol_page.php?acId=<?= $cate['acId'] ?>">
                                    <div class="item_img">
                                        <img src="<?= $cate['acImgPath'] ?>" alt="<?= $cate['acName'] ?>">
                                    </div>
                                    <div class="item_info">
                                        <h4>
                                            <?= $cate['acName'] ?>
                                        </h4>
                                        <p>
                                            <?= $cate['acCompany'] ?>
                                        </p>
                                    </div>
                                    <div class="item_summary">
                                        <ul>
                                            <li class="summary_good"><i class="fa-regular fa-thumbs-up"></i>
                                                <span>
                                                    <?= $cate['acLike'] ?>
                                                </span>
                                            </li>
                                            <li class="summary_comment"><i class="fa-solid fa-comment"></i>
                                                <span>
                                                    <?= $cate['acComment'] ?>
                                            </li>
                                            <li class="summary_abv"><i class="fa-solid fa-wine-glass"></i>
                                                <span>
                                                    <?= $cate['acAbv'] ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- alcohol_item -->

            </section>
            <!-- main_contents end -->

            <?php include "../include/aside.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>
</body>

</html>