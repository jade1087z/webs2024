<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <!-- CSS -->
    <?php include "../include/head.php"?>
</head>
<body class="gray">
    <?php include "../include/skip.php"?>
    <!-- //skip -->

    <?php include "../include/header.php"?>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../asset/img/intro02@1x.jpg 1x, ../asset/img/intro02@2x.jpg 2x, ../asset/img/intro02@3x.jpg 3x" alt="인트로 이미지">
            </div>
            <div class="intro__text">
                회원가입을 해주시면 다양한 정보를 자유롭게 볼 수 있습니다.
            </div>
        </div>
        <section class="join__inner">
            <h2>이용약관</h2>
            <div class="join__index mb100">
                <ul>
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
            <div class="join__agree">
                <div class="agree__box">
                    <h3 class="blind">G블로그 이용약관</h3>
                    <div class="scroll mb10 scroll__style">
                        <p>**1. 서비스 제공자 정보**
                            회사 또는 서비스 제공자의 상호, 주소, 연락처 정보를 여기에 기재합니다.
                            
                            **2. 정의**
                            이 이용약관에서 사용하는 용어의 정의를 제공합니다. 
                            
                            **3. 이용약관의 적용**
                            - 본 이용약관은 당사의 서비스 및 웹사이트 이용에 적용됩니다.
                            - 이용자가 당사의 서비스를 이용하는 경우, 본 이용약관의 내용에 동의한 것으로 간주됩니다.
                            
                            **4. 계정 생성 및 관리**
                            - 계정을 생성하기 위한 절차, 계정 정보의 기밀 유지 의무 및 계정 관리에 대한 규정을 설명합니다.
                            
                            **5. 개인정보 보호 및 데이터 수집**
                            - 개인정보 보호 정책에 관한 내용을 기재하고 개인 데이터 수집, 사용 및 보호에 대한 규정을 설명합니다.
                            
                            **6. 서비스 이용 및 게시물 작성**
                            - 서비스 이용 규칙, 게시물 작성에 관한 규정을 제공합니다.
                            - 타인의 권리 존중 및 불법 활동 금지 사항을 설명합니다.
                            
                            **7. 저작권 보호**
                            - 당사 서비스 또는 웹사이트에 게재된 콘텐츠의 저작권 및 지적 재산권에 대한 규정을 기재합니다.
                            
                            **8. 금지 사항**
                            - 서비스 이용 시 금지되는 활동, 스팸, 해킹 시도, 불법 활동에 대한 규정을 제공합니다.
                            
                            **9. 법적 책임 및 면책조항**
                            - 법적 분쟁 시의 책임 및 면책조항, 서비스 중단, 변경에 관한 내용을 설명합니다.
                            
                            **10. 서비스 변경 또는 종료**
                            - 서비스 변경 또는 종료 시의 절차와 이용자에게 알림 방법을 기재합니다.
                            
                            **11. 분쟁 해결 방법**
                            - 분쟁을 해결하기 위한 절차, 중재, 관할법원 등을 설명합니다.
                            
                            **12. 이용약관 변경**
                            - 이용약관 변경 시, 이용자에게 알리는 방법, 변경 내용을 반영하는 방법을 제공합니다.
                            
                            **13. 접근 가능성**
                            - 장애인 및 저시력자를 위한 접근성을 고려한 규정을 포함합니다.
                            
                            **14. 적용법 및 관할법원**
                            - 이용약관이 적용되는 법과 관할법원을 명시합니다.
                            
                            **15. 효력 및 동의**
                            - 이용자가 이용약관에 동의하는 방법과 효력 발생일을 설명합니다.
                            
                            **16. 연락처 정보**
                            - 서비스 제공자의 연락처 정보를 명시합니다.
                            
                            **본 이용약관은 [날짜]에 마지막으로 수정되었습니다.**
                            
                            [회사 또는 서비스 제공자의 이름 및 주소]
                            
                            [연락처 정보]  
                        </p>
                    </div>
                    <div class="check">
                        <label for="agreeCheck1">
                            블로그 이용약관에 동의합니다.
                            <input type="checkbox" name="agreeCheck1" id="agreeCheck1">
                            <span class="indicator"></span>
                        </label>
                    </div>
                </div>
                <div class="agree__box">
                    <h3 class="blind">G블로그 개인정보취급방침</h3>
                    <div class="scroll mb10 scroll__style">
                        <p>**1. 수집하는 개인정보 항목**
                            - 회사는 서비스 제공을 위해 다음과 같은 개인정보 항목을 수집할 수 있습니다:
                                - 기본 정보: 이름, 이메일 주소, 전화번호 등
                                - 서비스 이용 정보: 서비스 이용 기록, 접속 로그, 쿠키, IP 주소 등
                                - 기타 정보: 서비스 이용 시 입력하는 기타 정보
                            
                            **2. 개인정보 수집 및 이용 목적**
                            - 회사는 다음과 같은 목적으로 개인정보를 수집하고 이용합니다:
                                - 서비스 제공, 운영, 유지 및 개선
                                - 고객 지원 및 문의 응답
                                - 보안, 사기 예방 및 기타 법적 의무 이행
                                - 마케팅 및 광고 목적 (사전 동의가 있는 경우)
                            
                            **3. 개인정보의 보유 및 이용기간**
                            - 회사는 개인정보를 수집한 목적이 달성된 후 또는 사용자의 요청에 따라 삭제 또는 파기합니다. 단, 법령에서 정한 경우는 예외로 합니다.
                            
                            **4. 개인정보의 제3자 제공**
                            - 회사는 사용자의 동의 없이 개인정보를 제3자에게 제공하지 않습니다. 단, 다음의 경우에는 예외로 합니다:
                                - 관련 법령에 따른 경우
                                - 서비스 제공 및 운영에 필요한 경우
                                - 사용자의 동의가 있는 경우
                            
                            **5. 개인정보의 파기**
                            - 회사는 개인정보 수집 목적이 달성된 후 또는 이용자의 요청에 따라 개인정보를 안전하게 파기합니다. 
                            
                            **6. 이용자의 권리와 행사**
                            - 이용자는 다음의 권리를 행사할 수 있습니다:
                                - 개인정보 열람, 정정, 삭제, 처리정지 요청
                                - 개인정보 수집 또는 이용 동의 철회
                                - 개인정보의 이전을 요청
                            
                            **7. 개인정보 보호 조치**
                            - 회사는 개인정보를 안전하게 관리하고 보호하기 위한 조치를 취하며, 보안 및 프라이버시를 위한 최선의 노력을 다합니다.
                            
                            **8. 개인정보 보호책임자**
                            - 회사의 개인정보 보호책임자는 다음과 같습니다:
                                - 이름:
                                - 이메일:
                                - 전화번호:
                            
                            **9. 개인정보 보호 정책 변경**
                            - 개인정보 보호 정책이 변경될 경우, 이를 사용자에게 통지하고 동의를 얻을 수 있습니다.
                            
                            **본 개인정보수집 및 이용안내는 [날짜]에 마지막으로 수정되었습니다.**
                        </p>
                    </div>
                    <div class="check">
                        <label for="agreeCheck2">
                            개인정보 수집 및 이용약관에 동의합니다.
                            <input type="checkbox" name="agreeCheck2" id="agreeCheck2">
                            <span class="indicator"></span>
                        </label>
                    </div>
                </div>
                <button id="agreeButton" class="btn__style">동의하기</button>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- //footer -->

    <script>
        document.getElementById("agreeButton").addEventListener("click", () => {
            const agreeCheck1 = document.getElementById("agreeCheck1");
            const agreeCheck2 = document.getElementById("agreeCheck2");

            if(agreeCheck1.checked && agreeCheck2.checked){
                window.location.href = "joinInsert.php";
            } else {
                alert("이용약관 및 개인정보취급방침을 동의해주세요.");
            }
        })
    </script>
</body>
</html>