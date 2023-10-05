<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $boardView = 1;
    $regTime = time();
    $memberID = $_SESSION['memberID'];

    // echo $boardTitle, $boardContents, $memberID;

    // 세션을 통해 사용자가 로그인이 되어 있는지 확인한 후 작성이 되어야 함 

    
    // if($boardTitle == "" || $boardContents == ""){ // 글 제목, 내용이 없으면 등록안되게끔 
    //     echo "<script>alert('데이터가 없습니다.')</script>";
    //     echo "<script>window.location.href = 'board.php'</script>";
    // } else {
        
    // }

    if(!isset($_SESSION['memberID'])){ // 세션 아이디가 없으면 해당 코드 실행 isset -> session
        echo "<script>alert('로그인 후에 게시글을 작성할 수 있습니다.')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        if(empty($boardTitle) || empty($boardContents)){ // 데이터 여부 체크 
            echo "<script>alert('데이터가 없습니다.')</script>";
            echo "<script>window.location.href = 'board.php'</script>";
        } else {
            $boardTitle = $connect -> real_escape_string($boardTitle);
            $boardContents = $connect -> real_escape_string($boardContents);
            
            $sql = "INSERT INTO board(memberID, boardTitle, boardContents, boardView, regTime) VALUES ('$memberID', '$boardTitle', '$boardContents', '$boardView', '$regTime')";
            $connect -> query($sql);
    
            echo "<script>alert('게시글이 작성되었습니다.')</script>";
            echo "<script>window.location.href = 'board.php'</script>";
            // Header('Location: board.php'); 먼저 읽어버려서 안됨 
        }
    }
    
?>