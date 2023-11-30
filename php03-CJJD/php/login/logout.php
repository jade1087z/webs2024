<?php
include "../connect/session.php";

unset($_SESSION['myMemberId']);
unset($_SESSION['youEmail']);
unset($_SESSION['youName']);

Header("Location: ../main/main.php");
?>