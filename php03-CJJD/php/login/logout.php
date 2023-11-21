<?php
    include "../connect/session.php";

    unset($_SESSION['myMemberID']);
    unset($_SESSION['youEmail']);
    unset($_SESSION['youName']);

    Header("Location: ../main/main.php");
?>