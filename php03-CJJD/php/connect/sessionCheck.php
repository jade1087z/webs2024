<?php
    if(!isset($_SESSION['myMemberID'])){
        echo "<script>alert('로그인을 해주세요.');</script>"; 
        echo '<script>window.location.href = "../login/login.php";</script>';
    }; 
?>
