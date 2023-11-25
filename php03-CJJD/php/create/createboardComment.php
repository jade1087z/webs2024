<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE drinkreview (";
    $sql .= "reviewId int(10) unsigned auto_increment,";
    $sql .= "myMemberID int(10) unsigned,";
    $sql .= "boardId int(10) unsigned,";
    $sql .= "reviewName varchar(20) NOT NULL,";
    $sql .= "reviewPass varchar(20) DEFAULT NULL,";
    $sql .= "reviewMsg varchar(225) NOT NULL,";
    $sql .= "reviewDelete int(11) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (reviewId)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>