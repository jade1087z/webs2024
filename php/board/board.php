<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    $sql = "SELECT count(boardID) FROM board"; 
    $result = $connect -> query($sql);
    
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <!-- CSS -->
    <?php include "../include/head.php"?>
</head>
<body class="gray">
    <?php include "../include/skip.php"?>
    <?php include "../include/header.php"?>

    <main id="main" role="main">
        <div class="intro__inner bmStyle flexStyle container">
            <div class="intro__img small">
                <img srcset="../assets/img/intro02.jpg, ../assets/img/intro02@2.jpg, ../assets/img/intro02@3.jpg" alt="">
            </div>
            <div class="intro__text">
                <h2>게시판</h2>
                <p>웹디자이너, 웹 퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. 
                관련된 문의 사항은 여기서 확인하세요!
                </p>
            </div>
        </div>
        <section class="board__inner container">   
            <div class="board__search">
                <div class="left">
                    *총 <em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right">
                    <!-- 데이터 넘겨주기 -->
                    <form action="boardSearch.html" name="boardSearch" method="post">
                        <fieldset>
                            <legend class="blind">게시판 검색 영역</legend>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!">
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <button type="submit">검색</button>
                            <a href="boardWrite.php">글쓰기</a>
                        </fieldset>
                    </form>
                </div> 
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%;">
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 7%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>

<?php 

    if(isset($_GET['page'])){
        $page = (int) $_GET['page']; // 'page'는 url에서의 page를 의미한다
    } else {
        $page = 1;
    }
    

    // 데이터를 10개씩 쪼개서 넣는 과정
    
    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;
    // 1 ~ 10 LIMIT 0, 10 
    // 11 ~ 20 LIMIT 10, 10  => 10개씩 커짐 => viewNum에 1을 곱해줌 그리고 10을 빼줌 
    // 21 ~ 30 LIMIT 20, 10 
    // for($page; $page<$count; $page++){

    // }

    $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regtime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) ORDER BY boardID DESC LIMIT {$viewLimit}, ${viewNum}";
    $result = $connect -> query($sql);

    if($result) {
        $count = $result -> num_rows;

        if($count > 0) {
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);
                
                
                echo "<tr>";
                echo "<td>".$info['boardID']."</td>";
                echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('y-m-d'), $info['regTime']."</td>";
                echo "<td>".$info['boardView']."</td>";
                echo "</tr>";
            }
        }  else {
            echo "<tr><td colspan='S'>게시글이 없습니다.</td></tr>";
            } 
    }   else {
        echo "<script>alert('관리자에게 문의')</script>";
    }
?>
                    </tbody>
                </table> 
            </div>
            <!-- board_table end-->

            <div class="board__pages">
                <ul>
<?php
    // 총 페이지 갯수 체크
    $boardTotalCount = ceil($boardTotalCount/$viewNum);

    // 
    $pageView = 5;
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    $prevPage = ($page > 1) ? $page - 1 : 1;
    $nextPage = ($page >= $boardTotalCount) ? $boardTotalCount : $page + 1; 
    
    // 처음 페이지 초기화 / 마지막 페이지 초기화
    if($startPage < 1) $startPage = 1;
    if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

    echo "<li class='first'><a href='board.php?page=1'>처음으로</a></li>";
    echo "<li class='prev'><a href='board.php?page={$prevPage}'>이전</a></li>";
    // page 뿌리기
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) {
            $active = "active";            
        }
        echo "<li class='$active'><a href='board.php?page={$i}'>$i</a></li>";
    }
    echo "<li class='next'><a href='board.php?page={$nextPage}'>다음</a></li>";
    echo "<li class='last'><a href='board.php?page={$boardTotalCount}'>마지막으로</a></li>";


?>
                  
                </ul>
            </div>
            <!-- board_pages end -->

        </section>
    </main>
    <!-- main -->
    
    <footer id="footer" role="contentinfo">
        <div class="footer_inner container btStyle">
            <div>Copyright 2023 kiwowki</div>
            <div>blog by kang's</div>
        </div>
        
    </footer>
    <!-- footer -->
</body>
</html>