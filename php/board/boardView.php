<?php
    include "../connect/connect.php";
    include "../connect/session.php";

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
                <h2>게시글 보기</h2>
                <p>웹디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. 
                관련된 문의사항은 여기서 확인하세요.
                </p>
            </div>
        </div>
        <section class="board__inner container">   
            <div class="board__view">
                <form action="#" name="#" method="post">
                    <fieldset>
                        <legend class="blind">게시글 보기</legend>
                        <table>
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
<?php
    $boardID = $_GET['boardID'];

    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardID = (boardID)";
    $result = $connect -> query($sql);

    if($result) {
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('y-m-d'), $info['regtime']."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td>".$info['boardContents']."</td></tr>";
    }
?>                   
                            </tbody>          
                        </table>
                        <div class="board__btns">
                            <a href="boardModify.php?boardID=<?=$_GET['boardID']?>" class="btn__style3">수정하기</a>
                            <a href="boardRemove.php?boardID=<?=$_GET['boardID']?>" class="btn__style3" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                            <a href="board.php" class="btn__style3">목록보기</a>
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