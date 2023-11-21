<?php
include "../connect/connect.php";

$sql = "CREATE TABLE drinkLikes(";
$sql .= "likeId int(10) unsigned auto_increment,";
$sql .= "myMemberId int(10),";
$sql .= "boardId int(10),";
$sql .= "FOREIGN KEY (myMemberId) REFERENCES drinkMember(myMemberId),";
$sql .= "FOREIGN KEY (boardId) REFERENCES drinkBoard(boardId),";
$sql .= "youLike int(100) DEFAULT NULL,";
$sql .= "regTime int(10) DEFAULT NULL,";
$sql .= "PRIMARY KEY(likeId)";
$sql .= ") charset=utf8;";

$result = $connect->query($sql);

if ($result) {
    echo "Create Tables Complete";
} else {
    echo "Create Tables False";
}
?>

<!-- 
    내가 구현하고 싶은, 해야하는 기능

    유저 상태에서 특정 게시글에 좋아요를 누름 -> 알콜 리뷰 페이지와, 자유게시판에 좋아요 기능을 구현할 예정

    보드 테이블에 좋아요
    유저 테이블이 가진 좋아요 
    좋아요 테이블의 좋아요       /// ===> 

    좋아요를 누른 유저는 같은 글의 좋아요를 누른다면 
    좋아요의 숫자가 감소함 을 반복 

-->