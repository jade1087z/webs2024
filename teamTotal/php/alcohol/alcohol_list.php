<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'];
} else {
    Header("Location: alcohol.php");
}

$categorySql = "SELECT * FROM drinkList WHERE acDelete = 1 AND acCategory = '$category' ORDER BY acId";
$categoryResult = $connect->query($categorySql);
$categoryInfo = $categoryResult->fetch_array(MYSQLI_ASSOC);
$categoryCount = $categoryResult->num_rows;

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

                <?php include "./acRank.php"; ?>
                <!-- ranking_list -->


                <div class="alcohol_select">
                    <ul>
                        <li class="all"><a href="./alcohol.php">전체</a></li>
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
                        <?php foreach ($categoryResult as $cate) { ?>
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
                                            <li class="summary_good"><i class="fa-regular fa-thumbs-up"></i> <span>
                                                    <?= $cate['acLike'] ?>
                                                </span></li>
                                            <li class="summary_comment"><i class="fa-solid fa-comment"></i> <span>
                                                    <?= $cate['acComment'] ?>
                                            </li>
                                            <li class="summary_abv"><i class="fa-solid fa-wine-glass"></i> <span>
                                                    <?= $cate['acAbv'] ?>
                                                </span></li>
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
        // 페이지가 로드될 때 URL에서 'category' 매개변수의 값을 읽어 현재 카테고리를 결정합니다.
        var currentCategory = '<?php echo isset($_GET['category']) ? $_GET['category'] : "전체"; ?>';

        // 모든 리스트 아이템을 선택합니다.
        var listItems = document.querySelectorAll('.alcohol_select li');

        // 현재 카테고리에 해당하는 리스트 아이템을 찾아 해당 아이템에 .active 클래스를 추가합니다.
        listItems.forEach(function(item) {
            var categoryLink = item.querySelector('a').getAttribute('href');
            if (categoryLink.includes(currentCategory)) {
                item.classList.add('active');
            }
        });

        // 각 리스트 아이템에 클릭 이벤트 리스너를 추가합니다.
        listItems.forEach(function(item) {
            item.addEventListener('click', function() {
                // 클릭한 아이템에 .active 클래스를 추가하고, 다른 아이템에서는 제거합니다.
                listItems.forEach(function(li) {
                    li.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>