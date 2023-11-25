<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE drinkboard (";
    $sql .= "boardId int(10) unsigned auto_increment,";
    $sql .= "memberId int(10) unsigned NOT NULL,";
    $sql .= "boardCategory varchar(10) NOT NULL,";
    $sql .= "boardTitle varchar(255) NOT NULL,";
    $sql .= "boardContents longtext NOT NULL,";
    $sql .= "boardAuthor varchar(10) NOT NULL,";
    $sql .= "boardRegTime int(40) NOT NULL,";
    $sql .= "boardView int(100) NOT NULL,";
    $sql .= "boardLike int(100) NOT NULL,";
    $sql .= "boardComment int(100) NOT NULL,";
    $sql .= "boardImgFile varchar(100) DEFAULT NULL,";
    $sql .= "boardImgSize varchar(100) DEFAULT NULL,";
    $sql .= "boardDelete int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (boardId)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>