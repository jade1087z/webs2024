<?php
<<<<<<< HEAD
include "../connect/connect.php";
include "../connect/session.php";

$sql = "SELECT count(boardId) FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판'";
$result = $connect->query($sql);

$boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
$boardTotalCount = $boardTotalCount['count(boardId)'];



//  echo $boardTotalCount;  전체 개수 13개 

if (isset($_GET['page'])) {
    $page = (int) $_GET['page']; // 'page'는 url에서의 page를 의미한다
} else {
    $page = 1;
}
$viewNum = 10;
$viewLimit = ($viewNum * $page) - $viewNum;
$boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
$boardInfo = $connect->query($boardSql);
$infoResult = $boardInfo->fetch_array(MYSQLI_ASSOC);





// 레그타임 포매터
$today = date("Y.m.d", );

$boardRegTime = date('Y.m.d', $infoResult['regTime']);
=======
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $boardsql = "SELECT * FROM drinkboard WHERE boardDelete = 1 AND boardCategory = '커뮤니티' ORDER BY boardId DESC";
    $boardInfo = $connect -> query($boardsql);
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
?>

<!DOCTYPE html>
<html lang="ko">

<head>
<<<<<<< HEAD
    <!-- 공통 css -->
    <?php include "../include/head.php" ?>
    <!-- board js -->
    <!-- <script src="../assets/js/selectOption.js"></script> -->
    <link href="../assets/css/board.css" rel="stylesheet">
=======
    <?php
    include "../include/head.php";
    ?>
    
    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">
    
    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- css -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/index.css" rel="stylesheet" />
    <link href="../assets/css/selectOption.css" rel="stylesheet" />
    <link href="../assets/css/board.css" rel="stylesheet">

    <!-- js -->
    <script src="../assets/js/selectOption.js"></script>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
</head>

<body>
    <div id="wrapper">
        <!-- PC HEADER 840 < window -->
<<<<<<< HEAD
        <?php include "../include/header.php" ?>
=======
        <?php include "../include/header.php"; ?>

        <!-- M HEADER 840 > window -->
        <?php include "../include/logo.php"; ?>

        <?php include "../include/headerbottom.php"; ?>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">

                <div class="best_list boxStyle roundCorner shaDow">
<<<<<<< HEAD
                    <h4>자유 게시판</h4>

                    <ul class="board_w100">
                        <?php foreach ($boardInfo as $board) { ?>
                            <li>
                                <a href="board_view.php?boardId=<?= $board['boardId'] ?>"
                                    data-boardId="<?= $board['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut">
                                            <?= $board['boardTitle'] ?>
                                        </div>
                                        <div class="board_author textCut">
                                            <?= $board['boardAuthor'] ?>
                                        </div>
                                        <div class="board_date">
                                            <?= $boardRegTime ?>
                                        </div>
                                        <div class="board_view"> <span>
                                                <?= $board['boardView'] ?>
                                            </span></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
=======
                    <h4>인기 게시글 <span>HOT</span></h4>
                    <ul class="board_w100">
<?php foreach($boardInfo as $board){ ?>
    <li>
        <a href="board_view.php?boardId=<?=$board['boardId']?>">
            <div class="board_title">
                <p><?=$board['boardTitle']?></p>
            </div>
            <div class="board_reaction">
                <p>조회수 <span><?=$board['boardView']?></span></p>
                <p>댓글 <span><?=$board['boardComment']?></span></p>
            </div>
        </a>
    </li>
<?php } ?>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                    </ul>

                    <div class="board_page_option">
                        <div class="board_pages">
                            <ul class="pages_list">
<<<<<<< HEAD
                                <?php
                                // 총 페이지 갯수 체크
                                $boardTotalCount = ceil($boardTotalCount / $viewNum);

                                // 
                                $pageView = 5;
                                $startPage = $page - $pageView;
                                $endPage = $page + $pageView;

                                $prevPage = ($page > 1) ? $page - 1 : 1;
                                $nextPage = ($page >= $boardTotalCount) ? $boardTotalCount : $page + 1;

                                // 처음 페이지 초기화 / 마지막 페이지 초기화
                                if ($startPage < 1)
                                    $startPage = 1;
                                if ($endPage >= $boardTotalCount)
                                    $endPage = $boardTotalCount;

                                echo "<li class='prev'><a href='board.php?page={$prevPage}'>&lt;</a></li>";
                                // page 뿌리기
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = "";
                                    if ($i == $page) {
                                        $active = "active";
                                    }
                                    echo "<li class='$active'><a href='board.php?page={$i}'>$i</a></li>";
                                }
                                echo "<li class='next'><a href='board.php?page={$nextPage}'>&gt;</a></li>";
                                ?>
                            </ul>
                        </div>
                    </div>

=======
                                <li class="first"><a href="#">&lt;&lt;</a></li>
                                <li class="prev"><a href="#">&lt;</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li class="next"><a href="#">></a></li>
                                <li class="last"><a href="#">>></a></li>
                            </ul>
                        </div>
                    </div>
                    
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                    <div class="search_form">
                        <div class="selectBox2 "><i class="fa-solid fa-angle-down"></i>
                            <button class="label">게시글</button>
                            <ul class="optionList">
<<<<<<< HEAD
                                <li class="optionItem">게시글</li>
                                <li class="optionItem">제목만</li>
                                <li class="optionItem">작성자</li>
                            </ul>
                        </div>
                        <form action="board_search.php" method="get" name="" class="board_search_form ">
=======
                                <li class="optionItem">제목만</li>
                                <li class="optionItem">작성자</li>
                                <li class="optionItem">grape</li>
                                <li class="optionItem">melon</li>
                            </ul>
                        </div>
                        <form action="/" method="post" name="" class="board_search_form ">
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                            <div class="board_search_option">
                                <div id="search_input" class="board_search_box ">

                                    <label for="search" class="hidden" style="display: none;">검색창</label>
                                    <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요"
                                        autocomplete="off" class="im">
                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </form>
<<<<<<< HEAD
                    </div>
                </div>
=======
                        </di>
                    </div>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158

            </section>
            <!-- main_contents end -->

<<<<<<< HEAD
            <?php include "../include/aside.php" ?>
=======
            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->
<<<<<<< HEAD
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            const label = document.querySelector(".label");
            const options = document.querySelectorAll(".optionItem");
            const icon = document.querySelector(".selectBox2 i");

            let selectedOption = '게시글';

            // 검색 폼에 제출 이벤트 리스너를 추가
            let searchForm = document.querySelector('.board_search_form');
            searchForm.addEventListener('submit', function (e) {
                // 폼 제출을 막음
                e.preventDefault();

                // 검색어를 가져옴
                let searchQuery = document.querySelector('#search').value;

                // 선택된 옵션에 따라 검색 쿼리를 설정
                let finalQuery = '';

                if (selectedOption === '게시글') {
                    finalQuery = `${searchQuery}`;
                } else if (selectedOption === '제목만') {
                    finalQuery = `${searchQuery}`;
                } else if (selectedOption === '작성자') {
                    finalQuery = `${searchQuery}`;
                }

                if (finalQuery != '') {
                    console.log(finalQuery);
                    // finalQuery와 선택한 옵션을 쿼리 파라미터로 추가하여 페이지를 이동
                    window.location.href = `board_search.php?searchOption=${encodeURIComponent(selectedOption)}&searchQuery=${encodeURIComponent(finalQuery)}`;

                } else {
                    alert('검색어를 입력해주세여');
                }

                // finalQuery를 서버에 전송 (여기서는 콘솔에 출력)

            });

            // 클릭한 옵션의 텍스트를 라벨 안에 넣음
            const handleSelect = (item) => {
                label.parentNode.classList.remove("active");
                label.innerHTML = item.textContent;
                selectedOption = item.textContent;
            };
            // 옵션 클릭시 클릭한 옵션을 넘김
            options.forEach((option) => {
                option.addEventListener("click", () => handleSelect(option));
            });

            // 라벨을 클릭시 옵션 목록이 열림/닫힘
            label.addEventListener("click", () => {
                if (label.parentNode.classList.contains("active")) {
                    label.parentNode.classList.remove("active");
                } else {
                    label.parentNode.classList.add("active");
                }
            });
            icon.addEventListener("click", () => {
                if (label.parentNode.classList.contains("active")) {
                    label.parentNode.classList.remove("active");
                } else {
                    label.parentNode.classList.add("active");
                }
            });
        });
    </script>

=======

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
</body>

</html>