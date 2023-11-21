<?php
include "../connect/connect.php";
include "../connect/session.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

$memberId = $_SESSION['myMemberId'];
$boardAuthor = $_SESSION['youName'];
$boardCategory = $_POST['boardCategory'];

$boardTitle = $_POST['boardTitle'];
$boardContents = $_POST['boardContents'];

$boardView = 0;
$boardLike = 0;
$boardComment = 0;
$boardRegTime = time();
$boardDelete = 1;

$boardFile = $_FILES['boardFile'];
$boardImgSize = $_FILES['boardFile']['size'];
$boardImgType = $_FILES['boardFile']['type'];
$boardImgName = $_FILES['boardFile']['name'];
$boardImgTmp = $_FILES['boardFile']['tmp_name'];

// 함수 영역 
// 이미지 타입 체크 
function checkImageType($boardImgType)
{
    $fileTypeExtension = explode("/", $boardImgType);
    $fileType = $fileTypeExtension[0];  //image
    $fileExtension = $fileTypeExtension[1];  //jpeg
    if ($fileType === "image") {
        if ($fileExtension === "jpg" || $fileExtension === "jpeg" || $fileExtension === "png" || $fileExtension === "gif" || $fileExtension === "webp") { // 파일의 타입 확인  
            $boardImgName = "Img_" . time() . rand(1, 99999) . "." . "{$fileExtension}";
            return  $boardImgName;
        }
    }
    return false;
}
// 데이트 포맷
function today($boardRegTime)
{
    $date = new DateTime('@' . $boardRegTime);
    $year = $date->format('Y');
    $month = $date->format('m');
    $day = $date->format('d');
    $weekday = $date->format('w');
    $weekday_kor = ['일', '월', '화', '수', '목', '금', '토'][$weekday];
    return $year . '년' . $month . '월' . $day . '일' .   $weekday_kor . '요일';
}
function formatDate($boardRegTime)
{
    $date = new DateTime('@' . $boardRegTime);
    $year = $date->format('Y');
    $month = $date->format('m');
    $day = $date->format('d');
    return $year . '.' . $month . '.' . $day;
}

// 인서트 쿼리문 
function insertImgBoard($connect, $memberId, $boardCategory, $boardTitle, $boardContents, $boardAuthor, $boardRegTime, $boardView, $boardLike, $boardComment, $boardImgFile, $boardImgSize, $boardDelete)
{
    $sql = "INSERT INTO drinkBoard(memberId, boardCategory, boardTitle, boardContents, boardAuthor, boardRegTime, boardView, boardLike, boardComment, boardImgFile, boardImgSize, boardDelete) VALUES ('$memberId', '$boardCategory', '$boardTitle', '$boardContents', '$boardAuthor', '$boardRegTime', '$boardView', '$boardLike', '$boardComment', '$boardImgFile', '$boardImgSize', '$boardDelete')";
    $result = $connect->query($sql);
    mysqli_error($connect);
    return $result;
}
function insertNoneImgBoard($connect, $memberId, $boardCategory, $boardTitle, $boardContents, $boardAuthor, $boardRegTime, $boardView, $boardLike, $boardComment, $boardDelete)
{
    $sql = "INSERT INTO drinkBoard(memberId, boardCategory, boardTitle, boardContents, boardAuthor, boardRegTime, boardView, boardLike, boardComment, boardDelete) VALUES ('$memberId', '$boardCategory', '$boardTitle', '$boardContents', '$boardAuthor', '$boardRegTime', '$boardView', '$boardLike', '$boardComment', '$boardDelete')";
    $result = $connect->query($sql);
    mysqli_error($connect);
    return $result;
}

// 함수 영역 끝 



// 실행 쿼리
if ($boardImgType) {
    if (checkImageType($boardImgType)) {
        echo "<script>alert('이미지 파일이 맞습니다.')</script>";
        $boardImgDir = "../assets/board/";
        $result = insertImgBoard($connect, $memberId, $boardCategory, $boardTitle, $boardContents, $boardAuthor, $boardRegTime, $boardView, $boardLike, $boardComment, $boardImgName, $boardImgSize, $boardDelete);
    } else {
        echo "<script>alert('이미지 파일 형식이 아닙니다.')</script>";
    }
    $result = move_uploaded_file($boardImgTmp, $boardImgDir . $boardImgName);
} else { // 이미지 파일을 첨부하지 않은 경우의 게시글 등록
    echo "<script>alert('이미지 파일을 첨부하지 않았습니다.')</script>";
    $result = insertNoneImgBoard($connect, $memberId, $boardCategory, $boardTitle, $boardContents, $boardAuthor, $boardRegTime, $boardView, $boardLike, $boardComment, $boardDelete);
}


if ($boardImgSize > 10000000) {
    echo "<script>alert('이미지 파일 용량이 1메가 초과했습니다. 사이즈를 줄여주세요')</script>";
}


if ($result && $boardCategory === "자유게시판") {
    echo "<script>alert('게시글 등록 완료!!')</script>";
    echo "<script>window.location.href='board.php';</script>";
} else if ($result && $boardCategory === "마이 다이어리") {
    echo "<script>alert(' " . date('Y.m.d', $boardRegTime) . " 다이어리에 일기가 등록되었습니다.')</script>";
    echo "<script>window.location.href='../mypage/mypage.php';</script>";
}
