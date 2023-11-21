<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    // 보드 아이디 
    if(isset($_GET['boardId'])){
        $boardId = $_GET['boardId'];
    } else {
        Header("Location: board.php");
    }

    // 멤버 아이디
    if(isset($_SESSION['myMemberID'])){
        $myMemberID = $_SESSION['myMemberID'];
    } else {
        Header("Location: ../main/main.php");
    }

    // 내 정보 가져오기
    $memberSql = "SELECT * FROM drinkMember WHERE myMemberID = '$myMemberID'";
    $memberResult = $connect -> query($memberSql);
    $memberInfo = $memberResult -> fetch_array(MYSQLI_ASSOC);

    // 조회수 추가
    $updateViewSql = "UPDATE drinkboard SET boardView = boardView +1 WHERE boardId = '$boardId'";
    $connect -> query($updateViewSql);

    // 블로그 정보 가져오기
    $boardSql = "SELECT * FROM drinkboard WHERE boardId = '$boardId'";
    $boardResult = $connect -> query($boardSql);
    $boardInfo = $boardResult -> fetch_array(MYSQLI_ASSOC);

    // 이전글 가져오기 
    $prevboardSql = "SELECT * FROM drinkboard WHERE boardId < '$boardId' ORDER BY boardId DESC LIMIT 1";
    $prevboardSqlResult = $connect -> query($prevboardSql);
    $preboardInfo = $prevboardSqlResult -> fetch_array(MYSQLI_ASSOC);

    // 다음글 가져오기 
    $nextboardSql = "SELECT * FROM drinkboard WHERE boardId > '$boardId' ORDER BY boardId ASC LIMIT 1";
    $nextboardSqlResult = $connect -> query($nextboardSql);
    $nextboardInfo = $nextboardSqlResult -> fetch_array(MYSQLI_ASSOC);

    // 댓글 정보 가져오기 
    $reviewSql = "SELECT * FROM drinkreview WHERE boardId = '$boardId' AND reviewDelete = '1' ORDER BY reviewId ASC";
    $reviewResult = $connect -> query($reviewSql);
    $reviewInfo = $reviewResult -> fetch_array(MYSQLI_ASSOC);

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

                    <h4><a href="/">인기 게시글</a><span>HOT</span></h4>

                    <div class="view_wrap">
                        <div class="view_top">
                            <h5><?=$boardInfo['boardTitle']?></h5>
                        </div>

                        <div class="view_box">
                            <div class="user_info not_user">
                                <div class="user_info_box">
                                    <p><em><?=$boardInfo['boardAuthor']?>님의 </em>게시글 더보기 ></p>
                                </div>
                            </div>
                            <div class="view_info">
                                <div class="info_list">
                                    <i class="fa-solid fa-heart"></i>
                                    <div class="view_num">추천수: <em><?=$boardInfo['boardLike']?></em></div>
                                    <div class="view_num">조회수: <em><?=$boardInfo['boardView']?></em></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="board_desc">
                        <div class="board_detail">
                            <em class="scrollStyle">
                                <?=$boardInfo['boardContents']?>
                            </em>

                        </div>
                    </div>
                    <div class="comment_summary">
                        <div class="button_list">
                            <button class="delete"><a href="#">삭제하기</a></button>
                            <button class="modify"><a href="#">수정하기</a></button>
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
                    <h4>후기 <span>0</span>개</h4>
                        <ul class="review_wrap">
                    <?php 
if($reviewResult->num_rows == 0) { ?>
    <li>
        <div class="review_text">
            <strong class="textCut"></strong>
            <p>댓글이 아무것도 없습니다.</p>
        </div>
    </li>

<?php } else {  
    foreach($reviewResult as $review) { ?>   

        <li>
            <div class="review_text count">
                <strong class="textCut"><?=$review['reviewName']?></strong>
                <p><?=$review['reviewMsg']?></p>
                <a href="#" class="delete" data-review-id="<?=$review['reviewId']?>">삭제</a>
                <a href="#" class="modify" data-review-id="<?=$review['reviewId']?>">수정</a>
            </div>
        </li>

    <?php } // foreach 닫음
} // else 닫음?>
                     </ul> 
                </div>

                
                <div class="boxStyle roundCorner shaDow">
                    <h4>후기 작성하기</h4>
                    <div class="review_add">
                        <textarea  type="text" class="scrollStyle" name="review_write" id="review_write"
                            placeholder="내 입맛에 어땠는지 의견을 나눠요."></textarea>
                        <button type="button" id="reviewWriteBtn">작성하기</button>
                    </div>
                </div>

                <div class="boxStyle roundCorner shaDow">
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

    <div id="popupDelete" class="none">
        <div class="review__delete ">
            <h4>댓글 삭제</h4>
            <label for="reviewDeletePass" class="blind">비밀번호</label>
            <input type="password" id="reviewDeletePass" name="reviewDeletePass" placeholder="비밀번호">
            <p>*계정 비밀번호를 입력해주세요!</p>
            <div class="btn2">
                <button id="reviewDeleteCancle">취소</button>
                <button id="reviewDeleteButton">삭제</button>
            </div> 
        </div>
    </div>

    <div id="popupModify" class="none">
        <div class="review__modify ">
            <h4>댓글 수정</h4>            
            <label for="reviewModifyPass" class="blind">비밀번호</label>
            <textarea name="reviewModifyMsg" id="reviewModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
            <input type="password" id="reviewModifyPass" name="reviewModifyPass" placeholder="비밀번호">
            <p>*계정 비밀번호를 입력해주세요!</p>
            <div class="btn2">
                <button id="reviewModifyCancle">취소</button>
                <button id="reviewModifyButton">수정</button>
            </div> 
        </div>
    </div>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/ko.js"></script>

<script>
    const likeBtn = document.querySelector(".good");
    const heart = document.querySelector(".info_list i");

    // 댓글 갯수 구하기 
    const commentCount = document.querySelectorAll(".count");
    const commentNum = document.querySelector(".alcohol_review h4 span");

    commentNum.textContent = commentCount.length; 

    likeBtn.addEventListener("click", () => {
        heart.classList.add("like");
    });
</script>


<script>
    // 댓글 쓰기 버튼
    $("#reviewWriteBtn").click(function(){
        if($("#review_write").val() == ""){
            alert("댓글을 작성해주세요!");
            $("#review_write").focus();
        } else {
            alert($("#review_write").val())
            $.ajax({
                url: "review_writeSave.php",
                method: "POST",
                dataType: "json",
                data: {
                    "boardId": <?=$boardId?>,
                    "myMemberID": <?=$myMemberID?>,
                    "memberPass": "<?=$memberInfo['youPass']?>",
                    "name": "<?=$memberInfo['youName']?>",
                    "msg": $("#review_write").val()
                },
                success: function(data){
                    console.log(data);
                    location.reload();
                },
                error: function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            })
        }
    });

    // 댓글 삭제 버튼
    $(".review_text .delete").click(function(e){
        e.preventDefault();
        $("#popupDelete").removeClass("none");
        reviewId = $(this).data("review-id");
    });

    // 댓글 취소 버튼 --> 취소
    $("#reviewDeleteCancle").click(function(e){
        $("#popupDelete").addClass("none");
    })

    // 댓글 삭제 버튼 --> 삭제 버튼
    $("#reviewDeleteButton").click(function(){
        if($("#reviewDeletePass").val() == ""){
            alert("댓글 삭제 시 비밀번호를 작성해주세요!");
            $("#reviewDeleteButton").focus();
        } else {
            $.ajax({
                url: "review_deleteSave.php",
                method: "POST",
                dataType: "json",
                data: {
                    "reviewPass": $("#reviewDeletePass").val(),
                    "reviewId": reviewId,
                },
                success: function(data){
                    console.log(data);
                    if(data.result == "bad"){
                        alert("비밀번호가 일치하지 않습니다.");
                    } else {
                        alert("댓글이 삭제되었습니다.");
                    }
                    location.reload();
                },
                error: function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            })
        }
    });

    // 댓글 수정 버튼
    $(".review_text .modify ").click(function(e){
        e.preventDefault();
        $("#popupModify").removeClass("none");
        reviewId = $(this).data("review-id");
        
        let reviewMsg = $(this).closest(".review__modify").find("p").text();
        $("#reviewModifyMsg").val(reviewMsg)
    });

    // 댓글 취소 버튼 --> 취소
    $("#reviewModifyCancle").click(function(e){
        $("#popupModify").addClass("none");
    })

    // 댓글 수정 버튼 --> 수정 버튼
    $("#reviewModifyButton").click(function(){
        if($("#reviewModifyPass").val() == ""){
            alert("댓글 작성시 비밀번호를 작성해주세요!");
            $("#reviewModifyPass").focus();
        } else {
            $.ajax({
                url: "review_ModifySave.php",
                method: "POST",
                dataType: "json",
                data: {
                    "reviewMsg": $("#reviewModifyMsg").val(),
                    "reviewPass": $("#reviewModifyPass").val(),
                    "reviewId": reviewId,
                },
                success: function(data){
                    console.log(data);
                    if(data.result == "bad"){
                        alert("비밀번호가 일치하지 않습니다.");
                    } else {
                        alert("댓글이 수정되었습니다.");
                    }
                    location.reload();
                },
                error: function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            })
        }
    });

</script>


</html>