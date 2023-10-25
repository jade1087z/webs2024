<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // $memberId = $_SESSION['memberId'];
    // $blogAuthor = $_SESSION['youName'];
    $memberId = 1;
    $blogAuthor = "임종한";
    $blogCategory = $_POST['blogCategory'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = nl2br($_POST['blogContents']);


    $blogView = 1;
    $blogLike = 0;
    $blogRegTime = time();
    $blogDelete = 1;

    $blogFile = $_FILES['blogFile'];
    $blogImgSize = $_FILES['blogFile']['size'];
    $blogImgType = $_FILES['blogFile']['type'];
    $blogImgName = $_FILES['blogFile']['name'];
    $blogImgTmp = $_FILES['blogFile']['tmp_name'];
    

    // if($blogImgType) {
    //     $fileTypeExtension = explode("/", $blogImgType); // /를 기준으로 배열을 짜름
    //     $fileType = $fileTypeExtension[0];
    //     $fileExtension = $fileTypeExtension[1];

        
    //     // 이미지 타입 확인
    //     if($fileType === "image") {
    //         if($fileExtension === "jpg" || $fileExtension === "jpeg" || $fileExtension === "png" || $fileExtension === "webp" || $fileExtension === "gif" ) {
    //             $blogImgDir = "../assets/blog/"; // 이미지 저장 경로
    //             $blogImgName = "Img_".time().rand(1, 99999)."."."{$fileExtension}";
    //         } else {
    //             echo "<script>alert('이미지 파일 형식이 아닙니다..)</script>";    
    //         }
            
    //     } else {
    //         echo "<script>alert('이미지 파일이 아닙니다.)</script>";
    //     }
    // }
    if($blogImgType){
        $fileTypeExtension = explode("/", $blogImgType);
        $fileType = $fileTypeExtension[0];  //image
        $fileExtension = $fileTypeExtension[1];  //jpeg

        // 이미지 타입 확인
        if($fileType === "image"){
            if($fileExtension === "jpg" || $fileExtension === "jpeg" || $fileExtension === "png" || $fileExtension === "gif" || $fileExtension === "webp"){
                $blogImgDir = "../assets/blog/";
                $blogImgName = "Img_".time().rand(1, 99999)."."."{$fileExtension}";
                // $sql = "INSERT INTO blog(memberId, blogTitle, blogContents, blogCategory, blogAuthor, blogRegTime, blogView, blogLike, blogImgFile, blogImgSize, blogModTime, blogDelete) VALUES ('$memberId', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogLike', '$blogRegTime', '$blogView', '$blogLike', '$blogFile')";
                $sql = "INSERT INTO blog(memberId, blogTitle, blogContents, blogCategory, blogAuthor, blogRegTime, blogView, blogLike, blogImgFile, blogImgSize, blogDelete) VALUES('$memberId', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogRegTime', '$blogView', '$blogLike', '$blogImgName', '$blogImgSize', '$blogDelete')";
            } else {
                echo "<script>alert('이미지 파일 형식이 아닙니다.')</script>";
            }
            echo "<script>alert('이미지 파일이 맞습니다.')</script>";
        } else {
            echo "<script>alert('이미지 파일이 아닙니다.')</script>";
            // $sql = "INSERT INTO blog(memberId, blogTitle, blogContents, blogCategory, blogAuthor, blogRegTime, blogView, blogLike, blogImgFile, blogImgSize, blogModTime, blogDelete) VALUES ('$memberId', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogLike', '$blogRegTime', 'Img_default.jpg', '$blogView', '$blogLike', '$blogFile')";
            $sql = "INSERT INTO blog(memberId, blogTitle, blogContents, blogCategory, blogAuthor, blogRegTime, blogView, blogLike, blogImgFile, blogImgSize, blogModTime, blogDelete) VALUES ('$memberId', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogLike', '$blogRegTime', 'Img_default.jpg', '$blogView', '$blogLike', '$blogFile')";
        }

        if($blogImgSize > 10000000) {
            echo "<script>alert('이미지 용량이 초과되었습니다..')</script>";
        }
    
        $result = $connect -> query($sql);
        $result = move_uploaded_file($blogImgTmp, $blogImgDir.$blogImgName);

        if($result) {
            echo "<script>alert('저장이 완료되었습니다.')</script>";
            echo "<script>window.location.href='blog.php';</script>";
        }


    }