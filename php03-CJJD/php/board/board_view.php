<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_GET['boardId'])) {
    $boardId = $_GET['boardId'];
} else {
    Header("Location: board.php");
}

if (isset($_SESSION['myMemberId'])) {
    $myMemberId = $_SESSION['myMemberId'];
    $memberSql = "SELECT * FROM drinkMember WHERE myMemberId = $myMemberId";
    $memberResult = $connect->query($memberSql);
    $memberInfo = $memberResult->fetch_array(MYSQLI_ASSOC);

    if ($memberInfo['youNick']) {
        $youNick = $memberInfo['youNick'];
    }
} else {
    $myMemberId = '익명';
}
// 로그인을 한 경우에만 쿼리문을 통해 닉네임 값을 찾음  
// 해당 아이디의 닉네임 값과 멤버아이디 값은 이후 
/// --> 보드의 수정 삭제
/// --> 댓글의 수정 삭제에 영향을 줌 




if (isset($_GET['page'])) {
    $page = (int) $_GET['page']; // 'page'는 url에서의 page를 의미한다
} else {
    $page = 1;
}


// 보드 딜리트가 0인 값에 강제로 접근할 떄 
$zeroSql = "SELECT * FROM drinkBoard WHERE boardId = $boardId";
$zeroResult = $connect->query($zeroSql);
$zeroInfo = $zeroResult->fetch_array(MYSQLI_ASSOC);
if ($zeroInfo['boardDelete'] == 0) {
    echo "<script>alert('삭제된 게시글입니다.')</script>";
    echo "<script>window.history.back()</script>";
}


// 좋아요한 유저인지 체크
$sql = "SELECT * FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND boardId = '{$boardId}'";
$result = $connect->query($sql);
$count = $result->num_rows;
$isLiked = $result->num_rows > 0 ? 'like' : 'dislike';

// 조회수 추가
$updateViewSql = "UPDATE drinkBoard SET boardView = boardView +1 WHERE boardId = '$boardId'";
$connect->query($updateViewSql);

// 게시글 정보 가져오기

$boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardId = '$boardId'";
$boardResult = $connect->query($boardSql);
$boardInfo = $boardResult->fetch_array(MYSQLI_ASSOC);

// 보드 딜리트가 0인 값에 강제로 접근할 떄 
$zeroSql = "SELECT count(boardId) FROM drinkBoard WHERE boardCategory = '자유게시판'";
$zeroResult = $connect->query($zeroSql);
$zeroInfo = $zeroResult->fetch_array(MYSQLI_ASSOC);
if ($zeroInfo['boardDelete'] === 0) {
    echo "<script>alert('해당 게시글은 삭제되었습니다.'); location.href='board.php';</script>";
    exit;
}

// 댓글 딜리트 값1의 갯수
$commentCountSql = "SELECT count(commentId) FROM drinkComment WHERE commentCategory = '자유게시판' AND commentDelete = 1 AND boardId = '$boardId'";
$commentCountResult = $connect->query($commentCountSql);
$commentCountInfo = $commentCountResult->num_rows;

$boardLike = $boardInfo['boardLike'];
$memberId = $boardInfo['myMemberId'];


// 전체 보드 데이터 가져오기
$viewNum = 5;
$viewLimit = ($viewNum * $page) - $viewNum;
$totalBoard = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
$infoResult = $connect->query($totalBoard);
$totalBoardInfo = $infoResult->fetch_array(MYSQLI_ASSOC);


// 페이지 부분 st

// 보드페이지네이션
$sql = "SELECT count(boardId) FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판'";
$result = $connect->query($sql);
$boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
$boardTotalCount = $boardTotalCount['count(boardId)'];

// 현재 보드아이디의 페이지 위치 
$sql = "SELECT COUNT(boardId) FROM drinkBoard WHERE boardId > {$boardId} AND boardDelete = 1 AND boardCategory = '자유게시판'";
$result = $connect->query($sql);
$count = $result->fetch_array(MYSQLI_ASSOC);
$count = $count['COUNT(boardId)'];
// 페이지 번호를 계산합니다.
$pageNumber = ceil(($count + 1) / $viewNum);


// 이전글 가져오기 
$prevboardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' AND boardId < '$boardId' ORDER BY boardId DESC LIMIT 1";
$prevboardSqlResult = $connect->query($prevboardSql);
$preboardInfo = $prevboardSqlResult->fetch_array(MYSQLI_ASSOC);

// 다음글 가져오기 
$nextboardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' AND boardId > '$boardId' ORDER BY boardId ASC LIMIT 1";
$nextboardSqlResult = $connect->query($nextboardSql);
$nextboardInfo = $nextboardSqlResult->fetch_array(MYSQLI_ASSOC);

// 페이지 부분 end

// 댓글 불러오기 
$commentSql = "SELECT * FROM drinkComment WHERE commentDelete = 1 AND commentCategory = '자유게시판' AND boardId = '$boardId'";
$commentResult = $connect->query($commentSql);
$commentInfo = $commentResult->fetch_array(MYSQLI_ASSOC);


// 보드 테이블들 레그타임 포매팅
$boardRegTime = date('Y.m.d', $boardInfo['regTime']);
$totalBoardRegTime = date('Y.m.d', $totalBoardInfo['regTime']);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../include/head.php" ?>
    <link href="../assets/css/board.css" rel="stylesheet">
    <link href="../assets/css/popup.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include "../include/header.php" ?>
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">
                <div class="board_view boxStyle roundCorner shaDow">

                    <h4><a href="board.php">자유게시판</a></h4>

                    <div class="view_wrap">
                        <div class="view_top">
                            <h5>
                                <?= $boardInfo['boardTitle'] ?>
                            </h5>
                        </div>

                        <div class="view_box">
                            <div class="user_info not_user">
                                <div class="user_info_box">
                                    <a href="board_member_info.php?boardId=<?= $boardId ?>">
                                        <p><em>
                                                <?= $boardInfo['boardAuthor'] ?>
                                            </em>님의 게시글 더보기 ></p>
                                    </a>
                                </div>
                            </div>
                            <div class="view_info">
                                <div class="info_list">
                                    <div class="view_num boardRegtime"><em style="color: black;">
                                            <?= $boardRegTime ?>
                                        </em></div>
                                    <i class="fa-solid fa-heart <?= $isLiked ?> >"></i>
                                    <!-- 삼항 연산자로 값이 1이상인 경우 true로 색깔이 입혀짐  -->
                                    <div class="view_num boardLike">추천수: <em>
                                            <?= $boardInfo['boardLike'] ?>
                                        </em></div>
                                    <div class="view_num">조회수: <em>
                                            <?= $boardInfo['boardView'] ?>
                                        </em></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="board_desc">
                        <div class="board_detail">
                            <div class="board_desc_img">
                                <!-- if문으로 이미지 안나오게 하기 -->
                                <?php if ($boardInfo['boardImgFile']) { ?>
                                    <img src="../assets/DBIMG/<?= $boardInfo['boardImgFile'] ?>"
                                        alt="<?= $boardInfo['boaldTitle'] ?>">
                                <?php } ?>

                            </div>
                            <em class="scrollStyle">
                                <?= $boardInfo['boardContents'] ?>
                            </em>

                        </div>
                    </div>
                    <div class="comment_summary">
                        <div class="button_list">
                            <button class="delete"
                                onclick="confirmBoard('삭제', 'delete','<?= $_GET['boardId'] ?>')">삭제하기</button>
                            <button class="modify"
                                onclick="confirmBoard('수정', 'modify','<?= $_GET['boardId'] ?>')">수정하기</button>
                            <button class="good">추천하기</button>
                        </div>
                    </div>
                </div>


                <?php if ($commentResult->num_rows == 0) { ?>
                    <div class="boxStyle roundCorner shaDow">
                        <h4>후기 <span>0</span></h4>
                        <ul class="review_wrap">
                            <li>
                                <div class="review_text">
                                    <span>아직 작성 된 후기가 없습니다.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <div class="boxStyle roundCorner shaDow" id="view_comment">
                        <h4>후기 <span id="commentCount">
                                <?= $commentCountInfo ?>
                            </span></h4>
                        <ul class="review_wrap">
                            <?php foreach ($commentResult as $comment) { ?>
                                <li>
                                    <div class="review_text">
                                        <strong class="textCut">
                                            <?= $comment['commentName'] ?>
                                        </strong>
                                        <p>
                                            <?= $comment['commentMsg'] ?>
                                        </p>
                                        <a href="#" class="modify" data-commentid="<?= $comment['commentId'] ?>"
                                            data-memberid="<?= $comment['myMemberId'] ?>">수정</a>
                                        <a href="#" class="delete" data-commentid="<?= $comment['commentId'] ?>"
                                            data-memberid="<?= $comment['myMemberId'] ?>">삭제</a>
                                        <!-- 찾기 -->
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                <?php } ?>

                <div class="boxStyle roundCorner shaDow">
                    <h4>후기 작성하기</h4>
                    <div class="review_add">
                        <textarea class="scrollStyle" name="review_write" id="review_write"
                            placeholder="자유롭게 의견을 나눠보세요."></textarea>
                        <button type="button" id="commentWriteBtn">작성하기</button>
                    </div>
                </div>

                <div class="boxStyle roundCorner shaDow">
                    <ul class="board_w100">
                        <!--전체 보드페이지의 아이디 값과 현재 보드 뷰 페이지의 보드아이디 값을 비교한다. -->
                        <?php foreach ($infoResult as $board) { ?>
                            <?php $thisId = $boardId === $board['boardId'] ? 'this' : '';
                            // 현재 보드아이디의 페이지 위치 
                            $sql = "SELECT COUNT(boardId) FROM drinkBoard WHERE boardId > {$board['boardId']} AND boardDelete = 1 AND boardCategory = '자유게시판'";
                            $result = $connect->query($sql);
                            $count = $result->fetch_array(MYSQLI_ASSOC);
                            $count = $count['COUNT(boardId)'];
                            $pageNumber = ceil(($count + 1) / $viewNum);
                            ?>
                            <li class="<?= $thisId ?>">
                                <a href=" board_view.php?boardId=<?= $board['boardId'] ?>&page=<?= $pageNumber ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut">
                                            <?= $board['boardTitle'] ?>
                                        </div>
                                        <div class="board_author textCut">
                                            <?= $board['boardAuthor'] ?>
                                        </div>
                                        <div class="board_date">
                                            <?= $totalBoardRegTime ?>
                                        </div>
                                        <div class="board_view"><span>
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

                                // 페이지네이션 범위 설정
                                $pageView = 5;

                                // 특정 아이디가 있는 페이지를 중심으로 페이지네이션 범위 계산
                                $startPage = max(1, $page - floor($pageView / 2));
                                $endPage = min($startPage + $pageView - 1, $boardTotalCount);

                                // 시작 페이지와 끝 페이지가 페이지네이션 범위를 벗어나지 않도록 조정
                                if ($startPage < 1)
                                    $startPage = 1;
                                if ($endPage >= $boardTotalCount)
                                    $endPage = $boardTotalCount;
                                if ($endPage - $startPage + 1 < $pageView) {
                                    $startPage = max(1, $endPage - $pageView + 1);
                                }

                                // 이전 페이지와 다음 페이지 계산
                                $prevPage = ($page > 1) ? $page - 1 : 1;
                                $nextPage = ($page >= $boardTotalCount) ? $boardTotalCount : $page + 1;

                                echo "<li class='prev'><a href='board_view.php?boardId={$boardId}&page={$prevPage}'>&lt;</a></li>";
                                // page 뿌리기
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = "";
                                    if ($i == $page) {
                                        $active = "active";
                                    }
                                    echo "<li class='$active'><a href='board_view.php?boardId={$boardId}&page={$i}'>$i</a></li>";
                                }
                                echo "<li class='next'><a href='board_view.php?boardId={$boardId}&page={$nextPage}'>&gt;</a></li>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- main_contents end -->

            <!-- side_box end -->
            <?php include "../include/aside.php" ?>
            <!-- popup end -->
            <?php include "../popup/comment_popup.php" ?>
        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- 좋아요 기능 구현 단계 -->
<script>
    const likeBtn = document.querySelector(".good");
    const heart = document.querySelector(".info_list i");
    const button = [likeBtn, heart];
    //  버튼 값 클릭시 이벤트 좋아요 혹은 싫어요 
    button.forEach(btn => {
        btn.addEventListener("click", () => {
            if ('<?= $myMemberId ?>' != '익명') {

                $.ajax({
                    url: 'board_like.php',
                    type: 'POST',
                    data: {
                        "myMemberId": <?= $myMemberId ?>,
                        "boardId": <?= $boardId ?>,
                        "commentId": commentId,
                        "boardLike": <?= $boardLike ?>,
                    },
                    dataType: 'json', // 응답을 JSON으로 파싱
                    success: function (data) {
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
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                alert("로그인을 해주세요!!");
            }

        });
    });


    // 들어오는 action 값에 따른 수정 삭제
    function confirmBoard(action, url, boardId) {
        if ('<?= $myMemberId ?>' != '익명') {
            if (confirm(action + '하시겠습니까?')) {
                if (<?= $memberId ?> === <?= $myMemberId ?>) {
                    window.location.href = 'board_' + url + '.php?boardId=' + boardId;
                } else {
                    alert(action + " 권한이 없습니다.");
                }
            }
        } else {
            alert("로그인한 회원만 게시글을 " + action + "할 수 있습니다!");
        }
    }

    // boardId 값과 memberId의 값이 같으면 window location
</script>

<!-- 댓글 쓰기 관련 기능 -->
<script>
    let commentId = '';
    let commentMemberId = '';
    const aModify = document.querySelectorAll('.review_text a');
    aModify.forEach(a => {
        a.addEventListener('click', (e) => {
            e.preventDefault();
        })
    })

    //댓글 쓰기 버튼
    $("#commentWriteBtn").click(function () {
        if ('<?= $myMemberId ?>' != '익명') {
            if ($("#review_write").val() == "") {
                alert("댓글을 작성해주세요.");
                $("#review_write").focus();
            } else {
                $.ajax({
                    url: "../comment/commentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "myMemberId": <?= $myMemberId ?>,
                        "boardId": <?= $boardId ?>,
                        "youNick": '<?= $youNick ?>',
                        "commentCategory": '자유게시판',
                        "commentMsg": $("#review_write").val(),
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.error) {
                            alert(data.error);
                        } else {
                            location.reload();
                        }
                    },
                    error: function (request, status, error) {
                        console.log(request);
                        console.log(status);
                        console.log(error);
                    }
                })
            };
        } else {
            alert("로그인한 회원만 댓글을 작성할 수 있습니다!");
        }
    });

    $(".review_text > .modify").click(function (e) {
        if ('<?= $myMemberId ?>' != '익명') {

            if (confirm('정말 수정하시겠습니까?')) {
                $("#popupModify").removeClass("none");
                commentId = $(this).data("commentid"); // 아이디 값 받아오기
                commentMemberId = $(this).data("memberid");

                console.log(commentMemberId);
                console.log(commentId);

                let commentMsg = $(this).closest(".review_text").find("p").text(); // msg 저장하기
                $("#commentModifyMsg").val(commentMsg); // 변경 값 저장 

                if (commentMemberId != <?= $myMemberId ?>) {
                    alert('수정 권한이없습니다.');
                    $("#popupModify").addClass("none");
                } // 세션의 멤버 -> 로그인한 아이디와 댓글의 주인을 비교
            }

            $("#commentModifyCancel").click(function () {
                if (confirm('수정을 취소하시겠습니까?')) {
                    $("#popupModify").addClass("none");
                };
            });

            $("#commentModifyButton").click(function () {
                $.ajax({
                    url: "../comment/commentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "myMemberId": commentMemberId,
                        "boardId": <?= $boardId ?>,
                        "commentId": commentId,
                        "commentMsg": $("#commentModifyMsg").val(),
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.error) {
                            alert(data.error);
                        } else {
                            alert("수정을 완료했습니다.");
                            location.reload();
                        }
                    },
                    error: function (request, status, error) {
                        console.log(request);
                        console.log(status);
                        console.log(error);
                    }
                });
            });
        } else {
            alert("로그인한 회원만 수정하실 수 있습니다.");
        }
    });
    //  수정 끝

    // 삭제 시작
    $(".review_text > .delete").click(function (e) {
        if ('<?= $myMemberId ?>' != '익명') {
            if (confirm('정말 삭제하시겠습니까?')) {
                commentId = $(this).data("commentid"); // 아이디 값 받아오기
                commentMemberId = $(this).data("memberid");
                console.log(commentId)
                console.log(commentMemberId)
                if (commentMemberId == <?= $myMemberId ?>) {
                    $.ajax({
                        url: "../comment/commentDelete.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "myMemberId": commentMemberId,
                            "boardId": <?= $boardId ?>,
                            "commentId": commentId,
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.error) {
                                alert(data.error);
                            } else {
                                alert("삭제를 완료했습니다.");
                                location.reload();
                            }
                        },
                        error: function (request, status, error) {
                            console.log(request);
                            console.log(status);
                            console.log(error);
                        }
                    });
                    // 세션의 멤버 -> 로그인한 아이디와 댓글의 주인을 비교 수정 과정과 동일
                    // ajax 통신 후 데이터 처리
                } else {
                    alert('본인의 글만 삭제할 수 있습니다.');
                }
            }
        } else {
            alert('삭제 권한이 없습니다.');
        };
    })
</script>

</html>