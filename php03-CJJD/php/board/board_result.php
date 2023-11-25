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

$searchWorld = $_GET['search'];
$searchCate = $_GET['optionList'];

$viewNum = 10;
$viewLimit = ($viewNum * $page) - $viewNum;

if ($searchCate == '') {
    $boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND (boardTitle LIKE '%{$searchWorld}%' OR boardContents LIKE '%{$searchWorld}%' OR boardAuthor LIKE '{$searchWorld}') AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
} else {
    if ($searchCate == 'boardContents'){
        $boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardContents LIKE '%{$searchWorld}%' AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
    } else if ($searchCate == 'boardTitle'){
        $boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardTitle LIKE '%{$searchWorld}%' AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
    } else {
        $boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardAuthor LIKE '%{$searchWorld}%' AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum"; 
    }
}
 

$boardInfo = $connect->query($boardSql);
$infoResult = $boardInfo->fetch_array(MYSQLI_ASSOC);
// 1 ~ 10 LIMIT 0, 10 
// 11 ~ 20 LIMIT 10, 10  => 10개씩 커짐 => viewNum에 1을 곱해줌 그리고 10을 빼줌 
// 21 ~ 30 LIMIT 20, 10 
// for($page; $page<$count; $page++){

// }

// 레그타임 포매터
$today = date("Y.m.d",);
$boardRegTime = date('Y.m.d', $infoResult['regTime']);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <!-- 공통 css -->
    <?php include "../include/head.php" ?>

    <link href="../assets/css/board.css" rel="stylesheet">
    <!-- board js -->
    <script src="../assets/js/selectOption.js"></script>
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
                                <a href="board_view.php?boardId=<?= $board['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut"><?= $board['boardTitle'] ?></div>
                                        <div class="board_author textCut"><?= $board['boardAuthor'] ?></div>
                                        <div class="board_date"><?= $boardRegTime ?></div>
                                        <div class="board_view"> <span><?= $board['boardView'] ?></span></div>
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
                                if ($startPage < 1) $startPage = 1;
                                if ($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

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

                    <form action="board_result.php?search=" method="get" name="" class="board_search_form ">
                        <div class="search_form">
                                <select class="optionList" name="optionList">
                                    <option class="optionItem" value="boardContents">게시글</option>
                                    <option class="optionItem" value="boardTitle">제목만</option>
                                    <option class="optionItem" value="boardAuthor">작성자</option>
                                </select>
                                <div class="board_search_option">
                                    <div id="searchCate" class="blind"></div>
                                    <div id="search_input" class="board_search_box ">
                                        <label for="search" class="hidden" style="display: none;">검색창</label>
                                        <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요" autocomplete="off" class="im">
                                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </section>
            <!-- main_contents end -->

            <?php include "../include/aside.php" ?>

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->
</body>

</html>