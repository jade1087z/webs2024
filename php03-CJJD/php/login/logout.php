<?php
<<<<<<< HEAD
include "../connect/session.php";

unset($_SESSION['myMemberId']);
unset($_SESSION['youEmail']);
unset($_SESSION['youName']);

Header("Location: ../main/main.php");
=======
    include "../connect/session.php";

    unset($_SESSION['myMemberID']);
    unset($_SESSION['youEmail']);
    unset($_SESSION['youName']);

    Header("Location: ../main/main.php");
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
?>