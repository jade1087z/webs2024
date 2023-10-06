<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
    // 로그인 한 사람만 지우기

    // $boardID = $_GET['boardID'];
    // $query = "SELECT memberID FROM board WHERE boardID = $boardID";
    // $result = $connect -> query($query);
    
    // if($result) {
    //     $row = $result -> fetch_assoc();
    //     $boardMemberID = $row['memberID'];
    //     if ($_SESSION['memberID'] == $boardMemberID) {
    //         // 게시글을 삭제합니다.
    //         $sql = "DELETE FROM board WHERE boardID = $boardID";
    //         if ($connect->query($sql)) {
    //             echo "게시글을 삭제했습니다.";
    //         } else {
    //             echo "게시글 삭제 중 오류 발생: " . $connect->error;
    //         }
    //     } else {
    //         echo "<script>alert('게시글을 삭제할 권한이 없습니다.');</script>";
    //     }
    // } else {
    //     echo "게시글을 찾을 수 없습니다.";
    // }

    $boardID = $_GET['boardID'];
    $memberID = $_SESSION['memberID'];

    
        // 게시글 소유자 확인
        $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
        $result = $connect -> query($sql);

        if($result){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            $boardOwnerID = $info['memberID'];

            // 로그인 memberID 게시글 memberID 일치 여부
            if($memberID == $boardOwnerID){
                $sql = "DELETE FROM board WHERE boardID = {$boardID}";
                $connect -> query($sql);
                echo "<script>alert('게시글이 삭제되었습니다.');</script>";
            } else {
                echo "<script>alert('게시글 소유자만 삭제 할 수 있습니다.');</script>";
            }
        } else {
            echo "<script>alert('관리자에게 문의해주세요!');</script>";
        }
    
    
?>

<script>
    location.href = 'board.php';
</script>    
</body>
</html>

