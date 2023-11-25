<?php
include "../connect/connect.php";
include "../connect/session.php";


$boardId = $_GET['boardId'];
$boardTitle = $_POST['boardTitle'];
$boardContents = $_POST['boardContents'];
$myMemberId = $_SESSION['myMemberId'];
$boardImgFile = $_GET['boardImgFile'];
$boardCategory = $_POST['boardCategory'];

echo $boardId;

$boardFile = $_FILES['boardFile'];
$boardImgSize = $_FILES['boardFile']['size'];
$boardImgType = $_FILES['boardFile']['type'];
$boardImgName = $_FILES['boardFile']['name'];
$boardImgTmp = $_FILES['boardFile']['tmp_name'];


$regSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardId = {$boardId}";
$regResult = $connect->query($regSql);
$regInfo = $regResult->fetch_array(MYSQLI_ASSOC);
$boardRegTime = $regInfo['regTime'];


// echo $boardId, $boardTitle, $boardContents, $boardPass, $memberID;
// 함수 영역
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
function updateImgBoard($connect, $boardId, $boardCategory, $boardTitle, $boardContents, $boardImgFile, $boardImgSize)
{
    $sql = "UPDATE drinkBoard SET boardCategory = '{$boardCategory}', boardTitle = '{$boardTitle}', boardContents = '{$boardContents}', boardImgFile = '{$boardImgFile}', boardImgSize = '{$boardImgSize}' WHERE boardId = '{$boardId}'";
    $result = $connect->query($sql);
    return $result;
}
function noneUpdateImgBoard($connect, $boardId, $boardCategory, $boardTitle, $boardContents)
{
    $sql = "UPDATE drinkBoard SET boardCategory = '{$boardCategory}', boardTitle = '{$boardTitle}', boardContents = '{$boardContents}'  WHERE boardId = '{$boardId}'";
    $result = $connect->query($sql);
    return $result;
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

// 함수영역



$boardTitle = $connect->real_escape_string($boardTitle);
$boardContents = $connect->real_escape_string($boardContents);


// $sql = "SELECT * FROM drinkBoard WHERE boardId = {$boardId}";
$IdSql = "SELECT * FROM drinkMember WHERE myMemberId = {$myMemberId}";
$IdResult = $connect->query($IdSql);

if ($boardImgType) {
    if (checkImageType($boardImgType)) { // 이미지 타입 및 파일 체크

        $boardImgDir = "../assets/DBIMG/";
        $result = updateImgBoard($connect, $boardId, $boardCategory, $boardTitle, $boardContents, $boardImgName, $boardImgSize);
    } else {
        echo "<script>alert('이미지 파일 형식이 아닙니다.')</script>";
    }
    $result = move_uploaded_file($boardImgTmp, $boardImgDir . $boardImgName);
} else { // 이미지 파일을 첨부하지 않은 경우의 게시글 등록
    echo "<script>alert('이미지 파일을 첨부하지 않았습니다.')</script>";
    $result = noneUpdateImgBoard($connect, $boardId, $boardCategory, $boardTitle, $boardContents);
}

if ($boardImgSize > 10000000) {
    echo "<script>alert('이미지 파일 용량이 1메가 초과했습니다. 사이즈를 줄여주세요')</script>";
}


// 카테고리의 변화가 있는지 확인 
// unlink($boardImgDir . $boardImgFile); 기존 파일을 삭제하는 방법
if ($boardCategory === "자유게시판") {
    echo "<script>alert('게시글 등록 완료!!')</script>";
    echo "<script>window.location.href='board.php';</script>";
} else if ($boardCategory === "마이 다이어리") {
    echo "<script>alert(' " .  date('Y.m.d', $boardRegTime)  . " 다이어리에 일기가 수정되었습니다.')</script>";
    echo "<script>window.location.href='../mypage/mypage.php';</script>";
}
