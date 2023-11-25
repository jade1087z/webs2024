<aside id="side_wrap">
    <div class="search_box side_box roundCorner shaDow">
        <input type="text" placeholder="취중진담 통합 검색">
        <button><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>

    <div class="right">
        <?php if(isset($_SESSION['myMemberID'])){ ?>
            <div class="info_box side_box roundCorner shaDow">
                <div class="login_info">
                    <img src="../assets/img/img500.jpg" alt="유저 이미지">
                    <p><?=$_SESSION['youName']?>님 어서오세요.</p>
                    <ul>
                        <li><a href="../login/logout.php">로그아웃</a></li>
                        <li><a href="../mypage/mypage.php">마이페이지</a></li>
                    </ul>
                </div>
                <button class="sideBtn"><a href="../board/board_write.php">새 글쓰기</a></button>
            </div> 
        <?php } else { ?>
            <div class="info_box side_box roundCorner shaDow">
                <div class="login_info not_login">
                    <p><i class="fa-solid fa-icons"></i> <br> 회원가입하고 <br> 더 많은 기능을 누리세요</p>
                    <ul>
                        <li><a href="../join/join.php">회원가입</a></li>
                        <li><a href="../findMember/findpass.php">회원정보 찾기</a></li>
                    </ul>
                </div>
                <button class="sideBtn" onclick="location.href='../login/login.php'">로그인</button>
            </div>
        <?php } ?>
    </div>
</aside>