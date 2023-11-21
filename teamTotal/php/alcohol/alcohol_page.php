<?php
include "../connect/connect.php";
include "../connect/session.php";

// 세션에서 로그인 정보 가져오기
if (isset($_SESSION['youId'])) {
    $youId = $_SESSION['youId'];

    // drinkMember 테이블에서 멤버 정보와 같은 값을 가진 행 선택하기
    $sql = "SELECT * FROM drinkMember WHERE youId = '$youId'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $memberInfo = $result->fetch_assoc();
    } else {
        echo "없음" . $memberInfo;
    }
} else {
    $memberInfo = "";
}

// acId 가져오기
if (isset($_GET['acId'])) {
    $acId = $_GET['acId'];
} else {
    $memberId = 0;
}

//술 정보 가져오기
$acSql = "SELECT * FROM drinkList WHERE acId = '$acId'";
$acResult = $connect->query($acSql);
$acInfo = $acResult->fetch_array(MYSQLI_ASSOC);

// 조회수 추가
$updateViewSql = "UPDATE drinkList SET acView = acView + 1 WHERE acId = '$acId'";
$connect->query($updateViewSql);

// 추천수 추가
$updateLikeSql = "UPDATE drinkList SET acLike = acLike + 1 WHERE acId = '$acId'";
// $connect->query($updateLikeSql); 추천수가 무한으로 올라가는 오류 - 종한님이 한대요

//댓글 정보 가져오기
$commentSql = "SELECT * FROM acListComment WHERE acId = '$acId' AND commentDelete = '1' ORDER BY commentId";
$commentResult = $connect->query($commentSql);
$commentInfo = $commentResult->fetch_array(MYSQLI_ASSOC);

// 댓글 갯수 가져오기
$commentCount = $commentResult->num_rows;
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
    <link href="../assets/css/alcohol.css" rel="stylesheet" />
    <link href="../assets/css/popup.css" rel="stylesheet" />

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


                <div class="alcohol_info boxStyle roundCorner shaDow">
                    <div class="alcohol_thumbnail"></div>

                    <div class="alcohol_desc">
                        <div class="alcohol_img">
                            <img src="<?= $acInfo['acImgPath'] ?>" alt="<?= $acInfo['acName'] ?>">
                        </div>
                        <div class="alcohol_detail">
                            <h4>
                                <?= $acInfo['acName'] ?>
                            </h4>
                            <p>
                                <?= $acInfo['acCompany'] ?>
                            </p>
                            <em class="scrollStyle">
                                <?= $acInfo['acDesc'] ?>
                            </em>
                            <button id="acLikeBtn" class="good_btn">
                                <i class="fa-regular fa-thumbs-up"></i> 추천합니다.
                            </button>
                        </div>
                    </div>

                </div>
                <div class="item_summary alcohol_summary boxStyle roundCorner shaDow">
                    <ul>
                        <li class="summary_good">
                            <p><i class="fa-regular fa-thumbs-up"></i> 추천수</p><span>
                                <?= $acInfo['acLike'] ?>
                            </span>
                        </li>
                        <li class="summary_comment">
                            <p><i class="fa-solid fa-comment"></i>후기</p><span>
                                <?= $commentCount ?>
                            </span>
                        </li>
                        <li class="summary_abv">
                            <p><i class="fa-solid fa-wine-glass"></i>도수</p><span>
                                <?= $acInfo['acAbv'] ?>
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- 작성된 후기 없음 -->
                <div class="alcohol_review boxStyle roundCorner shaDow">
                    <h4>후기
                        <span>
                            <?= $commentCount ?>
                        </span>
                    </h4>
                    <ul class="review_wrap">
                        <?php
                        if ($commentResult->num_rows == 0) { ?>
                            <li>
                                <div class="review_text">
                                    <span>아직 작성 된 후기가 없습니다.</span>
                                </div>
                            </li>
                            <?php } else {
                            foreach ($commentResult as $comment) { ?>
                                <li>
                                    <div class="review_text">
                                        <strong class="textCut">
                                            <?= $comment['youNick'] ?>
                                        </strong>
                                        <p>
                                            <?= $comment['commentMsg'] ?>
                                        </p>
                                        <a href="#" class="modify" data-comment-id="<?= $comment['commentId'] ?>">수정</a>
                                        <a href="#" class="delete" data-comment-id="<?= $comment['commentId'] ?>">삭제</a>
                                    </div>
                                </li>
                        <?php }
                        }
                        ?>
                </div>

                <div class="boxStyle roundCorner shaDow">
                    <h4>후기 작성하기</h4>
                    <div class="review_add">
                        <textarea class="scrollStyle" name="review_write" id="review_write" placeholder="내 입맛에 어땠는지 의견을 나눠요."></textarea>
                        <button type="button" id="commentWriteBtn">작성하기</button>
                    </div>
                </div>
            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

            <?php include "../popup/popup.php"; ?>
            <!-- popUp-->


        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <script>
        // 버튼 클릭 시 이벤트 처리
        document.getElementById('acLikeBtn').addEventListener('click', function() {

            alert("이 술을 추천했습니다.");

            let acId = this.getAttribute('data-acid');

            // AJAX 요청을 통해 서버에 추천수를 업데이트하는 PHP 스크립트 호출
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'acLikeUpdate.php?acId=' + acId, true);
            xhr.send();

            // 서버에서 응답을 받지 않고 버튼을 여러 번 클릭하는 것을 방지하려면 버튼을 비활성화할 수 있습니다.
            this.disabled = false;

        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        let commentId = "";

        //댓글 쓰기 버튼
        $("#commentWriteBtn").click(function() {
            if ($("#review_write").val() == "") {
                alert("댓글을 작성해주세요.");
                $("#review_write").focus();
            } else {
                $.ajax({
                    url: "acCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "acId": <?= $acId ?>,
                        "youNick": "<?= $memberInfo['youNick'] ?>",
                        "commentMsg": $("#review_write").val(),
                    },
                    success: function(data) {
                        console.log(data);
                        <?php
                        // 댓글 수 업데이트
                        $updateComment = "UPDATE drinkList SET acComment = '$commentCount' WHERE acId = '$acId'";
                        $connect->query($updateComment);
                        ?>
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            };
        });


        // 댓글 삭제 버튼
        $(".review_text .delete").click(function(e) {
            e.preventDefault();
            $("#popupDelete").removeClass("none");
            commentId = $(this).data("comment-id");
            alert(commentId);

        });
        // // 댓글 삭제 버튼 --> 취소 버튼
        $("#commentDeleteCancel").click(function() {
            $("#popupDelete").addClass("none");
        });
        // // 댓글 삭제 버튼 --> 삭제 버튼
        $("#commentDeleteButton").click(function() {
            if ($("#commentDeletePass").val() == "") {
                alert("비밀 번호를 작성해주세요.");
                $("#commentDeletePass").focus();
            } else {
                alert("삭제 실행");
                $.ajax({
                    url: "acCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentPass": $("#commentDeletePass").val(),
                        "commentId": commentId,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.result == "bad") {
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 삭제되었습니다.")
                        }
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });

        // 댓글 수정하기
        $(".review_text .modify").click(function(e) {
            e.preventDefault();
            $("#popupModify").removeClass("none");
            commentId = $(this).data("comment-id");

            let commentMsg = $(this).closest(".review_text").find("p").text();
            $("#commentModifyMsg").val(commentMsg);
        });

        // 댓글 수정 버튼 --> 취소 버튼
        $("#commentModifyCancel").click(function() {
            $("#popupModify").addClass("none");
        });

        // 댓글 수정 버튼 --> 수정 버튼
        $("#commentModifyButton").click(function() {
            if ($("#commentModifyPass").val() == "") {
                alert("비밀 번호를 작성해주세요.");
                $("#commentModifyPass").focus();
            } else {
                $.ajax({
                    url: "acCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentMsg": $("#commentModifyMsg").val(),
                        "commentPass": $("#commentModifyPass").val(),
                        "commentId": commentId,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.result == "bad") {
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 수정되었습니다.")
                        }
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });
    </script>
</body>

</html>