<?php
include "../connect/connect.php";

// member
$memberSql = "create table drinkMember(";
$memberSql .= "myMemberId int(10) unsigned auto_increment,";
$memberSql .= "youId varchar(20) NOT NULL,";
$memberSql .= "youPass varchar(20) NOT NULL,";
$memberSql .= "youName varchar(5) NOT NULL,";
$memberSql .= "youNick varchar(10) NOT NULL,";
$memberSql .= "youEmail varchar(40) NOT NULL,";
$memberSql .= "youBirth int(8) NOT NULL,";
$memberSql .= "youAddress varchar(80) NOT NULL,";
$memberSql .= "youImgFile varchar(100) DEFAULT NULL,";
$memberSql .= "youImgSize varchar(100) DEFAULT NULL,";
$memberSql .= "memberDelete BOOLEAN DEFAULT 1,";
$memberSql .= "regTime int(20) NOT NULL,";
$memberSql .= "PRIMARY KEY(myMemberID)";
$memberSql .= ") charset=utf8;";

$memberResult = $connect->query($memberSql);


// board
$boardSql = "CREATE TABLE drinkBoard (";
$boardSql .= "boardId int(10) unsigned auto_increment,";
$boardSql .= "myMemberId int(10) unsigned NOT NULL,";
$boardSql .= "boardCategory varchar(10) NOT NULL,";
$boardSql .= "boardTitle varchar(255) NOT NULL,";
$boardSql .= "boardContents longtext NOT NULL,";
$boardSql .= "boardAuthor varchar(10) NOT NULL,";
$boardSql .= "boardView int(100) NOT NULL,";
$boardSql .= "boardLike int(100) NOT NULL,";
$boardSql .= "boardComment int(100) NOT NULL,";
$boardSql .= "boardImgFile varchar(100) DEFAULT NULL,";
$boardSql .= "boardImgSize varchar(100) DEFAULT NULL,";
$boardSql .= "boardDelete BOOLEAN DEFAULT 1,";
$boardSql .= "regTime int(40) NOT NULL,";
$boardSql .= "PRIMARY KEY (boardId)";
$boardSql .= ") charset=utf8";
$connect->query($boardSql);

$alterSql = "ALTER TABLE drinkBoard ADD CONSTRAINT FK_myMemberId FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId) ON DELETE CASCADE";
$connect->query($alterSql);


// drinkLikes 테이블 생성
$likeSql = "CREATE TABLE drinkLikes (";
$likeSql .= "likeId int(10) unsigned auto_increment,";
$likeSql .= "myMemberId int(10) unsigned,";
$likeSql .= "boardId int(10) NOT NULL,";
$likeSql .= "acId int(10) unsigned,"; // NULL을 허용하도록 변경
$likeSql .= "likeCategory varchar(10) NOT NULL,";
$likeSql .= "likeDelete BOOLEAN DEFAULT 1,";
$likeSql .= "regTime int(40) NOT NULL,";
$likeSql .= "PRIMARY KEY (likeId)";
$likeSql .= ") charset=utf8";
$connect->query($likeSql);

// drinkLikes 테이블에 외래키 설정
$likeSql = "ALTER TABLE drinkLikes ADD CONSTRAINT FK_myMemberId FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId) ON DELETE SET NULL, ADD CONSTRAINT FK_acId FOREIGN KEY (acId) REFERENCES drinkList(acId) ON DELETE SET NULL";
$connect->query($likeSql);


// drinkComment 테이블 생성
$commentSql = "CREATE TABLE drinkComment (";
$commentSql .= "commentId int(10) unsigned auto_increment,";
$commentSql .= "myMemberId int(10) unsigned,";
$commentSql .= "boardId int(10) NOT NULL,";
$commentSql .= "acId int(10) unsigned,"; // NULL을 허용하도록 변경
$commentSql .= "commentCategory varchar(10) NOT NULL,";
$commentSql .= "commentName varchar(20) NOT NULL,";
$commentSql .= "commentPass varchar(20) NOT NULL,";
$commentSql .= "commentMsg varchar(225) NOT NULL,";
$commentSql .= "commentDelete BOOLEAN DEFAULT 1,";
$commentSql .= "regTime int(20) NOT NULL,";
$commentSql .= "PRIMARY KEY (commentId)";
$commentSql .= ") charset=utf8";
$connect->query($commentSql);

// drinkComment 테이블에 외래키 설정
$commentSql = "ALTER TABLE drinkComment ADD CONSTRAINT FK_myMemberId FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId) ON DELETE SET NULL, ADD CONSTRAINT FK_acId FOREIGN KEY (acId) REFERENCES drinkList(acId) ON DELETE SET NULL";
$connect->query($commentSql);


// drinkList
$sql = "CREATE TABLE drinkList (";
$sql .= "acId int(10) unsigned auto_increment,";
$sql .= "acCategory varchar(10) NOT NULL,";  // 술 종류 받아오기 
$sql .= "acImgPath varchar(255) NOT NULL,"; // 이미지 받아오기 
$sql .= "acName varchar(40) NOT NULL,"; // 술이름
$sql .= "acCompany varchar(20) NOT NULL,"; // 술 회사 
$sql .= "acDesc longtext NOT NULL,"; // 내용
$sql .= "acView int(100) NOT NULL,"; // 조회수 
$sql .= "acLike int(100) NOT NULL,"; // 추천수 
$sql .= "acComment int(100) NOT NULL,";
$sql .= "acAbv float NOT NULL,";
$sql .= "acDelete BOOLEAN DEFAULT 1,";
$sql .= "PRIMARY KEY (acId)";
$sql .= ") charset=utf8";
$connect->query($sql);

// drinkList 테이블에 외래키 설정
$sql = "ALTER TABLE drinkList ADD CONSTRAINT FK_myMemberId FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId) ON DELETE CASCADE";
$connect->query($sql);

$likeSql = "ALTER TABLE drinkLikes ADD CONSTRAINT FK_myMemberId FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId) ON DELETE CASCADE, ADD CONSTRAINT FK_acId FOREIGN KEY (acId) REFERENCES drinkList(acId) ON DELETE CASCADE";
$connect->query($likeSql);