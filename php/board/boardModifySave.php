<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID']; // 43번 사용자 -> 글작성자 
    $boardID = $_GET['boardID'];
    // 수정하기 버튼을 눌렀을 때, 
    echo "boardTitle: " . $boardTitle . "<br>";
    echo "boardContents: " . $boardContents . "<br>";
    echo "memberID: " . $memberID . "<br>";
    echo "boardID: " . $boardID . "<br>";
    $boardTitel = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    // CONNECT를 통해 들어온 문자를 변수에 저장한다.

    $sql = "UPDATE board SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID = {$boardID}";
    $connect -> query($sql);
    if ($connect->query($sql) === TRUE) {
        echo "$boardTitle, $boardContents";
        // echo "<script> window.location.href = 'board.php'; </script>";
    } else {
        echo "오류 발생: " . $connect->error;
    }
?>
<!-- <script> window.location.href = 'board.php'; </script> -->