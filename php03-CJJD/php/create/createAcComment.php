<?php
include "../connect/connect.php";

$sql = "CREATE TABLE acListComment (";
$sql .= "commentId int(10) unsigned auto_increment,";
$sql .= "acId int unsigned NOT NULL,";
$sql .= "youNick varchar(5) NOT NULL,";
$sql .= "commentMsg varchar(225) NOT NULL,";
$sql .= "commentDelete int(11) NOT NULL,";
$sql .= "regTime int(20) NOT NULL,";
$sql .= "PRIMARY KEY (CommentId)";
$sql .= ") DEFAULT charset=utf8";

$connect->query($sql);
?>