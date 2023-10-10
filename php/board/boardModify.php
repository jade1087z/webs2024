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
    <title>회원가입 페이지</title>

    <?php include "../include/head.php"?>
</head>
<body class="gray">
    <?php include "../include/skip.php"?>
    <?php include "../include/header.php"?>

    <main id="main" role="main">
        <div class="intro__inner bmStyle flexStyle container">
            <div class="intro__img small">
            <img srcset="../assets/img/intro02.jpg, ../assets/img/intro02@2.jpg, ../assets/img/intro02@3.jpg" alt="">
            </div>
            <div class="intro__text">
                <h2>게시글 수정하기</h2>
                <p>웹디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. 
                게시글을 수정할 수 있습니다.
                </p>
            </div>
        </div>
        <section class="board__inner container">   
            <div class="board__write">
                <form action="boardModifySave.php?boardID=<?= $_GET['boardID']?>" name="boardModifySave.php" method="post">
                    <fieldset>
                        <legend class="blind">게시글 수정하기</legend>
                        
<?php
    $boardId = $_GET['boardID'];
    $sql = "SELECT * FROM board WHERE boardID = {$boardId}";
    $result = $connect -> query($sql);

    if($result) { // 보드 아이디를 불러와 해당 테이블의 제목 내용을 보여준다. 
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        
        echo "<div><label for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='input__style' value='".$info['boardTitle']."'></div>";
        echo "<div><label for='boardContents'>내용</label><textarea id='boardContents' name='boardContents' cols='30' rows=10' class='input__style'>".$info['boardContents']."</textarea></div>";
    }
?>
                      
                        <div class="mt50">
                            <label for="boardPass">비밀번호</div>
                            <input type="password" id="password" name="boardPass" placeholder="글을 수정하려면 로그인 비밀번호를 입력하세요."></div>
                        </div>
                        <div class="board__btns">
                            <a href="board.php" class="btn__style3 mr10">목록보기</a>
                            <button type="submit" class="btn__style3" onclick="confirmAndUpdate()">수정하기</button>
                        </div> 
                    </fieldset>
                </form>
            </div>
            
        </section>
    </main>
    <!-- main -->
    
    <footer id="footer" role="contentinfo">
        <div class="footer_inner container btStyle">
            <div>Copyright 2023 kiwowki</div>
            <div>blog by kang's</div>
        </div>
        
    </footer>
    <!-- footer -->
</body>
</html>