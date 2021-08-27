<? 
	session_start();
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>회원가입</title>
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/member_form.css">
    <link rel="stylesheet" href="../css/common.css">
	
    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script src="../js/index_scroll.js"></script>
    <script src="../js/family.js"></script>
    <script src="./js/check.js"></script>
	
	<script>
	$(document).ready(function() {
 
        //id 중복검사
        $("#id").on('keyup',function() {    // id입력 상자에 id값 입력시
            
            var id = $('#id').val(); //a
            $.ajax({
                type: "POST",
                url: "check_id.php",
                data: {id:id},
                cache: false,
                success: function(data)
                {
                    $("#loadtext").html(data);
                },error: function(data){
                    alert('data')
                }
            });
        });

        //nick 중복검사		 
        $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
            var nick = $('#nick').val();

            $.ajax({
                type: "POST",
                url: "check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data)
                {
                    $("#loadtext2").html(data);
                }
            });
        });
    });
    </script>
	<script>

    function check_input()
    {
        if (!document.member_form.id.value)
        {
            alert("아이디를 입력하세요");
            document.member_form.id.focus();
            return;
        }

        if (!document.member_form.pass.value)
        {
            alert("비밀번호를 입력하세요");    
            document.member_form.pass.focus();
            return;
        }

        if (!document.member_form.pass_confirm.value)
        {
            alert("비밀번호확인을 입력하세요");    
            document.member_form.pass_confirm.focus();
            return;
        }

        if (!document.member_form.name.value)
        {
            alert("이름을 입력하세요");    
            document.member_form.name.focus();
            return;
        }

        if (!document.member_form.nick.value)
        {
            alert("닉네임을 입력하세요");    
            document.member_form.nick.focus();
            return;
        }


        if (!document.member_form.hp2.value || !document.member_form.hp3.value )
        {
            alert("휴대폰 번호를 입력하세요");    
            document.member_form.nick.focus();
            return;
        }

        if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
        {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return;
        }

        document.member_form.submit(); 
	    // insert.php 로 변수 전송
    }

    function reset_form()
    {   
        $("#loadtext").html('');
        $("#loadtext2").html('');
        document.member_form.id.value = "";
        document.member_form.pass.value = "";
        document.member_form.pass_confirm.value = "";
        document.member_form.name.value = "";
        document.member_form.nick.value = "";
        document.member_form.hp1.value = "010";
        document.member_form.hp2.value = "";
        document.member_form.hp3.value = "";
        document.member_form.email1.value = "";
        document.member_form.email2.value = "";
        
        document.member_form.id.focus();

        return;
    }
</script>
</head>
<body>
	<div class="wrap">
        <div id="skipNav">
            <a href="#content">본문바로가기</a>
            <a href="#gnb">네비게이션바로가기</a>
        </div>
        <!-- Header Start -->
        <header id="headerArea">              
            <!-- logo Start -->
            <h1 class="logo">
                <a href="../index.html">롯데알미늄</a>
            </h1>
            <!-- logo End -->
            <a href="#" class="menu_btn menu_off">메뉴버튼</a>
        </header>
        <!-- Header End -->
        <!-- Navi Start -->
        <span class="gnb_left"></span>
        <nav id="gnb">
            <h2 class="hidden">글로벌네비게이션영역</h2>
            <div class="gnb_top">
                <?
                    if(!$userid)
                    {
                ?>
                    <a href="../login/login_form.php" class="login">로그인</a>
                    <a href="./member/member_check.html" class="join">회원가입</a>
                <?
                    }
                    else
                    {
                ?>
                    <a href="#" class="wellcome"><?=$usernick?><span>님 환영합니다.</span></a>
                    <a href="../login/logout.php" class="logout">로그아웃</a>
                    <a href="#" class="change_info">정보수정</a>
                <?
                    }
                ?>
            </div>
            <ul class="gnb_menu">
                <li class="dropmenu_1 menu">
                    <h3><a href="#">company</a></h3>
                    <ul class="depth_menu">
                        <li><a href="../sub/sub1_1.html">기업개요</a></li>
                        <li><a href="../sub/sub1_2.html">비전</a></li>
                        <li><a href="../sub/sub1_3.html">경영철학</a></li>
                    </ul>
                </li>
                <li class="dropmenu_2 menu">
                    <h3><a href="#">business</a></h3>
                    <ul class="depth_menu">
                        <li><a href="../sub/sub2_1.html">인쇄&#47;포장</a></li>
                        <li><a href="../sub/sub2_2.html">전기&#47;전자</a></li>
                        <li><a href="../sub/sub2_3.html">산업자재</a></li>
                        <li><a href="../sub/sub2_4.html">판지소재</a></li>
                    </ul>
                </li>
                <li class="dropmenu_3 menu">
                    <h3><a href="#">careers</a></h3>
                    <ul class="depth_menu">
                        <li><a href="../sub/sub3_1.html">인재상</a></li>
                        <li><a href="../sub/sub3_2.html">채용절차</a></li>
                        <li><a href="../sub/sub3_3.html">복리후생</a></li>
                    </ul>
                </li>
                <li class="dropmenu_4 menu">
                    <h3><a href="#">promotional</a></h3>
                    <ul class="depth_menu">
                        <li><a href="../sub/sub4_1.html">롯데SNS</a></li>
                        <li><a href="../sub/sub4_2.html">공모전</a></li>
                    </ul>
                </li>
            </ul>
            <div class="gnb_bottom">
                <a href="../sub/faq.html" class="g_faq"><span>F A Q</span></a>
                <a href="../sub/the_way.html" class="g_way"><span>오시는길</span></a>
            </div>
        </nav>
        <!-- Navi End -->
        <article id="content">
            <h2 class="hidden">회원가입</h2>
            <form  name="member_form" method="post" action="insert.php">
                <span>* 은 필수 항목입니다.</span>
                <table>
                <caption class="hidden">회원가입</caption>
                <tr>
                    <th scope="col"><label class="hidden" for="id">아이디&nbsp;</label><span>*</span></th>
                    <td>
                <?
                    if(!$userid){
                ?>
                    <input type="text" name="id" id="id" placeholder="아이디" required>
                    <span id="loadtext"></span>
                <?
                    }else{
                ?>
                    
                <?= $row[id] ?>
                        
                <?
                    }
                ?> 
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label class="hidden" for="pass">비밀번호&nbsp;</label><span>*</span></th>
                    <td>
                        <input type="password" name="pass" id="pass" placeholder="비밀번호" required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label class="hidden" for="pass_confirm">비밀번호확인&nbsp;</label><span>*</span></th>
                    <td>
                        <input type="password" name="pass_confirm" id="pass_confirm" placeholder="비밀번호확인" required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label class="hidden" for="name">이름&nbsp;</label><span>*</span></th>
                    <td>
                        <input type="text" name="name" id="name" placeholder="이름" required> 
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label class="hidden" for="nick">닉네임&nbsp;</label><span>*</span></th>
                    <td>
                        <input type="text" name="nick" id="nick" placeholder="닉네임" required>
                        <span id="loadtext2"></span>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><span class="hidden">휴대폰&nbsp;</span><span>*</span></th>
                    <td>
                        <label class="hidden" for="hp1">전화번호앞3자리</label>
                        <select class="hp" name="hp1" id="hp1"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                        <option value='016'>016</option>
                        <option value='017'>017</option>
                        <option value='018'>018</option>
                        <option value='019'>019</option>
                        </select>  - 
                        <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2" placeholder="앞4자리" required> - 
                        <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3" placeholder="뒤4자리" required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><span class="hidden">이메일&nbsp;</span><span>*</span></th>
                    <td>
                        <label class="hidden" for="email1">이메일아이디</label>
                        <input type="text" id="email1" name="email1" placeholder="이메일아이디" required> @ 
                        <label class="hidden" for="email2">이메일주소</label>
                        <input type="text" name="email2" id="email2" placeholder="이메일주소" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="#" onclick="check_input()">가입하기</a>&nbsp;&nbsp;
                        <a href="#" onclick="reset_form()">취소하기</a>
                    </td>
                </tr>
            </table>
        </form>
        
        </article>
        <!-- Footer Start -->
        <footer id="footerArea">
            <a href="#" class="topMove">top</a>
            <!-- footer_top Start -->
            <ul class="footer_top">
                <li>
                    <a href="#">개인정보처리방침</a>
                </li>
                <li>
                    <a href="#">이용약관</a>
                </li>
                <li>
                    <a href="#">PC버전 보러가기</a>
                </li>                
            </ul>
            <!-- footer_top End -->
            <!-- footer_logo Start -->
            <img src="../images/footer_logo.png" alt="푸터로고" class="footer_logo">
            <!-- footer_logo End-->
            <div class="family">
                <a href="#" class="fa_title">Family Site<span></span></a>
                <ul class="fam_list">
                    <li><a title="롯데그룹홈페이지 새창에서 열기" target="blank" href="http://www.lotte.co.kr/main.do">롯데그룹</a></li>
                    <li><a title="롯데백화점홈페이지 새창에서 열기" target="blank" href="https://www.lotteshopping.com/">롯데백화점</a></li>
                    <li><a title="롯데홈쇼핑홈페이지 새창에서 열기" target="blank" href="http://www.lotteimall.com/main/viewMain.lotte?dpml_no=1">롯데홈쇼핑</a></li>
                    <li><a title="롯데제과홈페이지 새창에서 열기" target="blank" href="https://www.lotteconf.co.kr/">롯데제과</a></li>
                    <li><a title="롯데푸드홈페이지 새창에서 열기" target="blank" href="http://www.lottefoods.co.kr/">롯데푸드</a></li>
                    <li><a title="롯데기공홈페이지 새창에서 열기" target="blank" href="http://www.lottelem.co.kr/">롯데기공</a></li>
                    <li><a title="롯데면세점홈페이지 새창에서 열기" target="blank" href="https://kor.lottedfs.com/kr/shopmain/exhibition/main?dispShopNo=10034877">롯데면세점</a></li>
                </ul>
            </div>
            <!-- footer_bottom Start -->
            <div class="footer_bottom">
                <address>
                    A. 서울특별시 동작구 보라매로 5길 51
                </address>
                <p>
                    &copy; LOTTE ALLUMINIUM CO., LTD.<br>ALL RIGHT RESERVED
                </p>
            </div>
            <ul class="sns">
                <li class="instar"><a title="롯데인스타그램 새창에서 열기" target="blank" href="https://www.instagram.com/happylotteworld/">인스타그램</a></li>
                <li class="facebook"><a title="롯데페이스북 새창에서 열기" target="blank" href="https://www.facebook.com/lotte/?ref=nf&hc_ref=ARSbTxlUW38dRIboL5M0kgb40KDZVLCrozT_kxPef_m_ktFTQUojOTZuHBEf39fLPYw">페이스북</a></li>
                <li class="blog"><a title="롯데트위터 새창에서 열기" target="blank" href="https://twitter.com/lotte_ent?ref_src=twsrc%5Etfw%7Ctwcamp%5Eembeddedtimeline%7Ctwterm%5Eprofile%3Alotte_ent%7Ctwgr%5EeyJ0ZndfZXhwZXJpbWVudHNfY29va2llX2V4cGlyYXRpb24iOnsiYnVja2V0IjoxMjA5NjAwLCJ2ZXJzaW9uIjpudWxsfSwidGZ3X2hvcml6b25fdHdlZXRfZW1iZWRfOTU1NSI6eyJidWNrZXQiOiJodGUiLCJ2ZXJzaW9uIjpudWxsfSwidGZ3X3R3ZWV0X2VtYmVkX2NsaWNrYWJpbGl0eV8xMjEwMiI6eyJidWNrZXQiOiJjb250cm9sIiwidmVyc2lvbiI6bnVsbH19&ref_url=http%3A%2F%2Fmrkjhha.cafe24.com%2Fsub4%2Fsub4_3.html">블로그</a></li>
            </ul>
            <!-- footer_bottom End -->
        </footer>
        <!-- Footer End -->
    </div>
</body>
</html>