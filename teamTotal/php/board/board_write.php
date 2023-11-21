<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>취중진담 게시글-쓰기</title>

    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">

    <!-- favicon -->
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/boardWrite.css" rel="stylesheet">

    <!-- js -->
    <script src="../assets/js/scrollEvent.js"></script>
    <script src="../assets/js/selectOption3.js"></script>

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
                <div class="best_list boxStyle roundCorner shaDow ">
                    <div class="board">
                        <div class="board_form">

                            <form action="board_writeSave.php" method="post" enctype="multipart/form-data">
                                <legend class="blind"></legend>
                                <div class="form_box">
                                    <div class="board_title">
                                        <h2>자유게시판</h2>
                                    </div>
                                    <div class="board_text">
                                        <div class="post">
                                            <div class="selectBox3"><i class="fa-solid fa-angle-down"></i>
                                                <input type="hidden" id="boardCategory" name="boardCategory" value="자유게시판">
                                                <button class="label" onclick="document.getElementById('boardCategory').value = this.textContent;">자유게시판</button>
                                                <ul class="optionList">
                                                    <li class="optionItem">자유게시판</li>
                                                    <li class="optionItem">술 신청하기</li>
                                                    <li class="optionItem">마이 다이어리</li>
                                                </ul>
                                            </div>
                                            <label for="boardFile" class="link">이미지를 업로드 해주세요.!!</label>
                                            <input type="file" id="boardFile" name="boardFile" style="display: none;" accept=".jpg, .jpeg, .png, .gif, .webp" class="link">

                                        </div>
                                        <div class="board_title ">
                                            <label for="boardTitle"></label>
                                            <input type="text" id="boardTitle" name="boardTitle" cols="50" rows="1" class="board_input_title inputStyle" placeholder="제목을 작성해주세요" required>
                                        </div>
                                        <div class="contents_wrap">
                                            <div class="board_contents">
                                                <label for="boardContents"></label>
                                                <textarea id="boardContents" name="boardContents" cols="50" rows="1" class="board_input_contents inputStyle placeholder" placeholder="원하는 술을 신청해주세요"></textarea>
                                            </div>
                                        </div>
                                        <div class="create">
                                            <button type="submit" class="sideBtn mt50">
                                                <h2>CREATE</h2>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

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

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/ko.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#boardContents'), {
                language: 'ko'
            })

            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- write -->
    <script>
        const tt = document.getElementById('boardCategory').value;
        console.log(tt);
    </script>
</body>





</html>