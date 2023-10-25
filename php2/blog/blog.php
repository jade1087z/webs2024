<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // 데이터 불러오기
    $blogSql = "SELECT * FROM blog WHERE blogDelete = 1 ORDER BY blogId DESC";
    $blogInfo = $connect -> query($blogSql);

?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>
    <?php include "../include/head.php"?>
</head>
<body class="gray">
    <?php include "../include/skip.php"?>
    <?php include "../include/header.php"?>
    

    
<!-- //header -->

    <main id="main" role="main">
        <div class="intro__innerblogStyle bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/gold.jpg, ../assets/img/gold@2.jpg, ../assets/img/gold@3.jpg" alt="">
            </div>
            <div class="intro__text">
                <h3>최신 정보</h3>
                <p>개발에 필요한 지식을 한눈에!<br>웹 개발과 관련된 최신 정보를 한 눈에 볼 수 있습니다.</p>
            </div>
        </div>
        <div class="blog__layout container">
            <div class="blog__contents">
                <section class="blog__card card__wrap">
                    <div class="card__inner column3">

<?php foreach($blogInfo as $blog){ ?>
     
    <div class="card">
        <figure class="card__img">
            <a href="blogView.php?blogId=<?=$blog['blogId']?>">
                <img src="../assets/blog/<?=$blog['blogImgFile']?>" alt="<?=$blog['blogTitle']?>">
            </a>
        </figure>
        <div class="card__text">
            <h3>
                <a href="blogView.php?blogId=<?=$blog['blogId']?>">
                    <?=$blog['blogTitle']?>
                </a>
            </h3>
            <p>
                <?=substr($blog['blogContents'], 0, 100)?>
            </p>
        </div>
    </div>
<?php } ?>


                    </div>
                </section>
                <section class="card__wrap">card__wrap</section>
                <section class="card__pages">card__pages</section>
                <section class="card__relate">card__relate</section>
                <section class="card__view">card__view</section>
                <section class="card__write">card__write</section>
            </div>
            <div class="blog__aside">
                <article class="blog__intro"></article>
                <article class="blog__category"></article>
                <article class="blog__popular"></article>
                <article class="blog__comment"></article>

            </div>

        </div>
    </main>
<!-- //main -->

    
    <?php include "../include/footer.php" ?>
<!-- //footer -->
</body>
</html>