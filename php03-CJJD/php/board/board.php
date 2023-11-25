<?php
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
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <!-- 공통 css -->
    <?php include "../include/head.php" ?>
    <!-- board js -->
    <!-- <script src="../assets/js/selectOption.js"></script> -->
    <link href="../assets/css/board.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- PC HEADER 840 < window -->
        <?php include "../include/header.php" ?>
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">

                <div class="best_list boxStyle roundCorner shaDow">
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
                    </ul>

                    <div class="board_page_option">
                        <div class="board_pages">
                            <ul class="pages_list">
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

                    <div class="search_form">
                        <div class="selectBox2 "><i class="fa-solid fa-angle-down"></i>
                            <button class="label">게시글</button>
                            <ul class="optionList">
                                <li class="optionItem">게시글</li>
                                <li class="optionItem">제목만</li>
                                <li class="optionItem">작성자</li>
                            </ul>
                        </div>
                        <form action="board_search.php" method="get" name="" class="board_search_form ">
                            <div class="board_search_option">
                                <div id="search_input" class="board_search_box ">

                                    <label for="search" class="hidden" style="display: none;">검색창</label>
                                    <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요"
                                        autocomplete="off" class="im">
                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </section>
            <!-- main_contents end -->

            <?php include "../include/aside.php" ?>

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->
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

</body>

</html>