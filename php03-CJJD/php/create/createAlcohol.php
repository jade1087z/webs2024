<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE drinkList (";
    $sql .= "acId int(10) unsigned auto_increment,";
    $sql .= "acCategory varchar(10) NOT NULL,";
    $sql .= "acImgPath varchar(255) NOT NULL,";
    $sql .= "acName varchar(40) NOT NULL,";
    $sql .= "acCompany varchar(20) NOT NULL,";
    $sql .= "acDesc longtext NOT NULL,";
    $sql .= "acView int(100) NOT NULL,";
    $sql .= "acLike int(100) NOT NULL,";
    $sql .= "acComment int(100) NOT NULL,";
    $sql .= "acAbv float NOT NULL,";
    $sql .= "acDelete int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (acId)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>