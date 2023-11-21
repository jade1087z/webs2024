<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

function updateImgBoard($connect, $boardId, $boardTitle, $boardContents, $boardImgFile, $boardImgSize)
{
    $sql = "UPDATE drinkBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}', boardImgFile = '{$boardImgFile}', boardImgSize = '{$boardImgSize}' WHERE boardId = '{$boardId}'";
    $result = $connect->query($sql);
    return $result;
}
function noneUpdateImgBoard($connect, $boardId, $boardTitle, $boardContents)
{
    $sql = "UPDATE drinkBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}'  WHERE boardId = '{$boardId}'";
    $result = $connect->query($sql);
    return $result;
}
