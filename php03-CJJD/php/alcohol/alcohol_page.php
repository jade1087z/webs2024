<?php
include "../connect/connect.php";
include "../connect/session.php";

// 세션에서 로그인 정보 가져오기
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


// 댓글 딜리트 값1의 갯수
$commentCountSql = "SELECT count(commentId) FROM drinkComment WHERE commentCategory = '자유게시판' AND commentDelete = 1 AND boardId = '$boardId'";
$commentCountResult = $connect->query($commentCountSql);
$commentCountInfo = $commentCountResult->num_rows;

$acLike = $acInfo['acLike'];
$memberId = $acInfo['myMemberId'];

// 댓글 불러오기 
$commentSql = "SELECT * FROM drinkComment WHERE commentDelete = 1 AND commentCategory = '술리뷰' AND acId = '$acId'";
$commentResult = $connect->query($commentSql);
$commentInfo = $commentResult->fetch_array(MYSQLI_ASSOC);


// 좋아요한 유저인지 체크
$sql = "SELECT * FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND acId = '{$acId}'";
$result = $connect->query($sql);
$count = $result->num_rows;
$isLiked = $result->num_rows > 0 ? 'like' : 'dislike';

// echo "정보 : " . $youNick;
// echo "술 정보 : " . $acInfo['acId'];
// echo "댓글 정보 : " . $commentInfo['commentMsg'];

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <?php include "../include/head.php"; ?>
    <!-- css -->
    <link href="../assets/css/alcohol.css" rel="stylesheet" />
    <link href="../assets/css/popup.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php include "../include/header.php"; ?>
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
                                <?= $acInfo['acComment'] ?>
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
                            placeholder="내 입맛에 어땠는지 의견을 나눠요."></textarea>
                        <button type="button" id="commentWriteBtn">작성하기</button>
                    </div>
                </div>
            </section>
            <!-- main_contents end -->

            <?php include "../include/aside.php"; ?>
            <!-- side_box end -->
            <?php include "../popup/comment_popup.php" ?>
            <!-- popup end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

        //  버튼 값 클릭시 추천하기
        const likeBtn = document.querySelector("#acLikeBtn");
        likeBtn.addEventListener("click", () => {
            if ('<?= $myMemberId ?>' != '익명') {
                $.ajax({
                    url: 'alcohol_like.php',
                    type: 'POST',
                    data: {
                        "myMemberId": <?= $myMemberId ?>,
                        "acId": <?= $acId ?>,
                        "acLike": <?= $acLike ?>,
                        "commentCategory": '술리뷰',
                    },
                    dataType: 'json', // 응답을 JSON으로 파싱
                    success: function (data) {
                        console.log(data);
                        if (data.error) {
                            alert(data.error);
                        } else {
                            location.reload();
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                alert("로그인을 해주세요!!");
            }

        });


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
                        url: "../comment/commentWalcohol.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "myMemberId": <?= $myMemberId ?>,
                            "acId": <?= $acId ?>,
                            "youNick": '<?= $youNick ?>',
                            "commentCategory": '술리뷰',
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
                }
            } else {
                alert("로그인한 회원만 댓글을 작성할 수 있습니다!");
            }
        }
        );

        // 댓글 수정
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
                            "acId": <?= $acId ?>,
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
                                "acId": <?= $acId ?>,
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
        });

    </script>
</body>

</html>