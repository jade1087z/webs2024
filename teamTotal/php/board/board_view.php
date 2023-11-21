<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_GET['boardId'])) {
    $boardId = $_GET['boardId'];
} else {
    Header("Location: board.php");
}

if (isset($_SESSION['youId'])) {
    $youId = $_SESSION['youId'];
}
if (isset($_SESSION['myMemberId'])) {
    $myMemberId = $_SESSION['myMemberId'];
}



// 좋아요한 유저인지 체크
$sql = "SELECT * FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND boardId = '{$boardId}'";
$result = $connect->query($sql);
$isLiked = $result->num_rows > 0 ? 'like' : 'dislike';

// 조회수 추가
$updateViewSql = "UPDATE drinkBoard SET boardView = boardView +1 WHERE boardId = '$boardId'";
$connect->query($updateViewSql);

// 블로그 정보 가져오기
$boardSql = "SELECT * FROM drinkBoard WHERE boardId = '$boardId'";
$boardResult = $connect->query($boardSql);
$boardInfo = $boardResult->fetch_array(MYSQLI_ASSOC);
$boardLike = $boardInfo['boardLike'];
$memberId = $boardInfo['memberId'];
$boardRegTime = date('Y.m.d', $boardInfo['boardRegTime']);


// 이전글 가져오기 
$prevboardSql = "SELECT * FROM drinkBoard WHERE boardId < '$boardId' ORDER BY boardId DESC LIMIT 1";
$prevboardSqlResult = $connect->query($prevboardSql);
$preboardInfo = $prevboardSqlResult->fetch_array(MYSQLI_ASSOC);

// 다음글 가져오기 
$nextboardSql = "SELECT * FROM drinkBoard WHERE boardId > '$boardId' ORDER BY boardId ASC LIMIT 1";
$nextboardSqlResult = $connect->query($nextboardSql);
$nextboardInfo = $nextboardSqlResult->fetch_array(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>취중진담</title>
    <a href="https://www.flaticon.com/kr/free-icons/" title="심장 아이콘"></a>
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
    <link href="../assets/css/alcohol.css" rel="stylesheet" />
    <link href="../assets/css/board.css" rel="stylesheet" />
    <link href="../assets/css/boardView.css" rel="stylesheet" />

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
                <div class="board_view boxStyle roundCorner shaDow">

                    <h4><a href="board.php">자유<span>게시판</span></a></h4>

                    <div class="view_wrap">
                        <div class="view_top">
                            <h5><?= $boardInfo['boardTitle'] ?></h5>
                        </div>

                        <div class="view_box">
                            <div class="user_info not_user">
                                <div class="user_info_box">
                                    <a href="board_member_info.php?memberId=<?= $memberId ?>">
                                        <p><em><?= $boardInfo['boardAuthor'] ?>님의 </em>게시글 더보기 ></p>
                                    </a>
                                </div>
                            </div>
                            <div class="view_info">
                                <div class="info_list">
                                    <div class="view_num"><?= $boardRegTime ?></div>
                                    <i class="fa-solid fa-heart <?= $isLiked ?>"></i>
                                    <div class="view_num boardLike">추천수: <em><?= $boardInfo['boardLike'] ?></em></div>
                                    <div class="view_num">조회수: <em><?= $boardInfo['boardView'] ?></em></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="board_desc">
                        <div class="board_detail">
                            <div class="board_desc_img">
                                <!-- if문으로 이미지 안나오게 하기 -->
                                <img src="../assets/board/<?= $boardInfo['boardImgFile'] ?>" alt="<?= $boardInfo['boaldTitle'] ?>">

                            </div>
                            <em class="scrollStyle">
                                <?= $boardInfo['boardContents'] ?>

                            </em>

                        </div>
                    </div>
                    <div class="comment_summary">
                        <div class="button_list">
                            <button class="delete" onclick="confirmDelete('<?= $_GET['boardId'] ?>')">삭제하기</button>
                            <button class="modify" onclick="confirmModify('<?= $_GET['boardId'] ?>')">수정하기</button>
                            <button class="good">추천하기</button>
                        </div>
                    </div>
                </div>


                <!-- 작성된 후기 없음 -->
                <!-- <div class="alcohol_review boxStyle roundCorner shaDow">
                    <h4>후기 <span>0</span></h4>
                    <ul class="review_wrap">
                        <li>
                            <div class="review_text">
                                <span>아직 작성 된 후기가 없습니다.</span>                                
                            </div>
                        </li>
                    </ul>
                </div> -->

                <div class="alcohol_review boxStyle roundCorner shaDow" id="view_comment">
                    <h4>후기 <span><?= $boardInfo['boardComment'] ?></span></h4>
                    <ul class="review_wrap">
                        <li>
                            <div class="review_text">
                                <strong class="textCut">안주킬러</strong>
                                <p>피자랑 먹으면 개꿀맛</p>
                                <button>삭제</button>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="boxStyle roundCorner shaDow">
                    <h4>후기 작성하기</h4>
                    <div class="review_add">
                        <textarea class="scrollStyle" name="review_write" id="review_write" placeholder="내 입맛에 어땠는지 의견을 나눠요."></textarea>
                        <button>작성하기</button>
                    </div>
                </div>

                <div class="boxStyle roundCorner shaDow">
                    <ul class="board_w100">
                        <li>
                            <a href="#">
                                <div class="board_title">
                                    <p>제목이 아주 긴 경우 :: 말줄임표__ 술 땡기는 금요일~ 곱창에 소주 땡기네요.술 땡기는 금요일~ 곱창에 소주 땡기네요.술 땡기는
                                        금요일~
                                        곱창에 소주 땡기네요.</p>
                                </div>
                                <div class="board_reaction">
                                    <p>조회수 <span>999</span></p>
                                    <p>댓글 <span>25</span></p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="board_title">
                                    <p>술 땡기는 금요일~ 곱창에 소주 땡기네요.</p>
                                </div>
                                <div class="board_reaction">
                                    <p>조회수 <span>999</span></p>
                                    <p>댓글 <span>25</span></p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="board_title">
                                    <p>술 땡기는 금요일~ 곱창에 소주 땡기네요.</p>
                                </div>
                                <div class="board_reaction">
                                    <p>조회수 <span>999</span></p>
                                    <p>댓글 <span>25</span></p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="board_page_option">
                        <div class="board_pages">
                            <ul class="pages_list">
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
                </div>
            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

</body>

<!-- Your HTML code here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const likeBtn = document.querySelector(".good");
    const heart = document.querySelector(".info_list i");

    likeBtn.addEventListener("click", () => {
        // if (heart.classList.contains("like")) {
        //     heart.classList.remove("like");
        // } else {
        //     heart.classList.add("like");

        // }
        $.ajax({
            url: 'board_like.php',
            type: 'POST',
            data: {
                "myMemberId": <?= $myMemberId ?>,
                "boardId": <?= $boardId ?>,
                "boardLike": <?= $boardLike ?>,
            },
            dataType: 'json', // 응답을 JSON으로 파싱
            success: function(data) {
                if (data.added_success) {
                    heart.classList.add("like");
                    heart.classList.remove("dislike");

                } else if (data.remove_success) {
                    heart.classList.add("dislike");
                    heart.classList.remove("like");
                }
                const boardLikeElement = document.querySelector(".boardLike em");
                boardLikeElement.textContent = data.boardLike;
            },
            error: function(error) {
                console.error('Error:', error);
            }
        })

    });


    function confirmDelete(boardId) {
        if (confirm('정말 삭제하시겠습니까?')) {
            if (<?= $memberId ?> === <?= $myMemberId ?>) {
                window.location.href = 'board_delete.php?boardId=' + boardId;
            } else {
                alert("삭제 권한이 없습니다.");
            }
        }
    }

    function confirmModify(boardId) {
        if (confirm('수정하시겠습니까?')) {
            if (<?= $memberId ?> === <?= $myMemberId ?>) {
                window.location.href = 'board_modify.php?boardId=' + boardId;
            } else {
                alert("수정 권한이 없습니다.");
            }
        }
    }

    // boardId 값과 memberId의 값이 같으면 window location
</script>

</html>