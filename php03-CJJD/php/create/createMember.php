<?php

    include "../connect/connect.php";

    $sql = "create table drinkMember(";
    $sql .= "myMemberID int(10) unsigned auto_increment,";
    $sql .= "youId varchar(20) NOT NULL,";
    $sql .= "youPass varchar(20) NOT NULL,";
    $sql .= "youName varchar(5) NOT NULL,";
    $sql .= "youNick varchar(5) DEFAULT NULL,";
    $sql .= "youEmail varchar(40) DEFAULT NULL,";
    $sql .= "youBirth int(8) NOT NULL,";
    $sql .= "youAddress varchar(80) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY(myMemberID)";
    $sql .= ") charset=utf8;"; 
    
    $result = $connect -> query($sql);

    if($result){
        echo "Create Tables Complete";
    } else {
        echo "Create Tables False";
    }
?>