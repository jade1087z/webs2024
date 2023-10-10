<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID']; // 43번 사용자 -> 글작성자 
    $boardID = $_GET['boardID'];
    // 수정하기 버튼을 눌렀을 때, 
    $boardTitel = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    // CONNECT를 통해 들어온 문자를 변수에 저장한다.

    $sql = "UPDATE board SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID = {$boardID}";
    $connect -> query($sql);

    $PASS = "SELECT youPass FROM members WHERE memberID = $memberID"; 
    
    $userPass = $connect -> query($PASS);
    $passData = $userPass->fetch_array(MYSQLI_ASSOC);
    $password = $passData['youPass'];
    $formPass = $_POST['boardPass'];

    if ($connect->query($sql) === TRUE && $password == $formPass) {
        echo "<script>alert('수정이 완료되었습니다.')</script>";
        echo "<script> window.location.href = 'board.php'; </script>";
    } else {
        echo "<script>alert('삭제할 권한이 없습니다.')</script>";
    }

    // 다음 알고리즘은 
    // 첫째 보드 아이디 값을 통해 제목과 내용의 변경사항을 받아와 변경시킨다.
    // 둘째, 폼 태그를 통해 동시에 입력되어 들어오는 비밀번호 값을 받아온다.
    // 쿼리문을 통해 세션 아이디값의 비밀번호를 알아온다.
    // 마지막으로 and 연산을 통해 두 조건을 모두 만족하면 값을 수정한다.
    

    
?>
<!-- <script> window.location.href = 'board.php'; </script> -->