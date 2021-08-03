<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>로그인</title>
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./css/login_form.css">
	
    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
	<script>
		var family_cnt=0;
		$(document).ready(function() {

			$('.family .fa_title').click(function(e){
				e.preventDefault();
				family_cnt++;
				if(family_cnt>2){family_cnt=1;}
				if(family_cnt==1){
					$('.family .fam_list').show();
					$('.family .fa_title span').addClass('show');
					$('.family').css('border-radius','0 0 4px 4px');
					$('.family .fam_list').mouseleave(function(){
						$(this).hide();
						$('.family').css('border-radius','4px 4px 4px 4px');
						$('.family .fa_title span').removeClass('show');
						family_cnt=0;
					});
				} else if(family_cnt==2){
					$('.family .fam_list').hide();
					$('.family').css('border-radius','4px 4px 4px 4px');
					$('.family .fa_title span').removeClass('show');
				};
				
			});
			//tab키 처리
			$('.family .fa_title').bind('focus', function (e) {  
					e.preventDefault();
					$('.family').css('border-radius','0 0 4px 4px');
					$('.family .fam_list').show();
			});
			$('.family .fa_title li:last').find('a').bind('blur', function (e) {   
					e.preventDefault();
					$('.family').css('border-radius','4px 4px 4px 4px');
					$('.family .fam_list').hide();
			});
		});
	</script>
	<script>
		function submit()
		{

			document.member_form.submit(); 
			// login.php 로 변수 전송
		}

		function reset_form()
		{
			document.member_form.id.value = "";
			document.member_form.pass.value = "";
			document.member_form.id.focus();

			return;
		}
	</script>
</head>

<body>
	<div id="wrap">
		<div id="skipNav">
            <a href="#content">본문 바로가기</a>
            <a href="#gnb">글로벌 네비게이션 바로가기</a>
        </div>
        <!-- Header Start -->
        <header id="headerArea">
            <div class="header_inner">
                <!-- login & Join Start -->
                <div class="top_menu">
                    <ul>
                        <li class="login">
                            <a href="./login_form.php">로그인</a>
                        </li>
                        <li class="join">
                            <a href="../member/member_check.html">회원가입</a>
                        </li>
                    </ul>
                </div>
                <!-- login & Join End -->
                <!-- logo Start -->
                <h1 class="logo">
                    <a href="../index.html">롯데알미늄</a>
                </h1>
                <!-- logo End -->
            </div>
        </header>  <!-- end of header -->
		<article id="content">
			<h2 class="hidden">LOGIN</h2>
			<form  name="member_form" method="post" action="login.php"> 
				<div id="id_pw_input">
					<ul>
						<li>
							<label for="id" class="hidden"></label>
							<input type="text" id="id" name="id" class="login_input" placeholder="아이디를 입력하세요" required>
						</li>
						<li>
							<label for="pass" class="hidden"></label>
							<input type="password" id="pass" name="pass" class="login_input" placeholder="비밀번호를 입력하세요" required>
						</li>
					</ul>
				</div>
				<div class="login_btn_wrap">
					<div id="login_button" class="login_cancel">
						<a href="#" onclick="submit()">로그인</a>
					<!-- <button type="submit">로그인</button> -->
					</div>
					<div id="cancel_button" class="login_cancel">
						<a href="#" onclick="reset_form()">취소하기</a>
					</div>
				</div>
				<div class="find_id_pw_wrap">
					<a href="./id_find_form.php">아이디찾기 바로가기</a> / 
					<a href="./pw_find_form.php">비밀번호찾기 바로가기</a>
				</div>	
				<!-- end of form_login -->
				<div class="join_wrap">
					<dl>
						<dt>JOIN US</dt>
						<dd>아직 롯데알미늄 회원이 아니신가요?</dd>
						<dd>회원가입을 통해 다양한 정보를 확인하세요.</dd>
					</dl>
					<div id="join_button">
						<a href="../member/member_check.html">회원가입</a>
					</div>
				</div>
			</form>
		</article> <!-- end of content -->
		<!-- Footer Start -->
        <footer id="footerArea">
            <div class="footer_inner">
                <a href="#" class="topMove">top</a>
                <!-- footer_top Start -->
                <div class="footer_top">
                    <ul class="f_menu">
                        <li>
                            <a href="#">개인정보처리방침</a>
                        </li>
                        <li>
                            <a href="#">이용약관</a>
                        </li>
                        <li>
                            <a href="#">사이트맵</a>
                        </li>
                        <li>
                            <a href="#">양식다운로드</a>
                        </li>
                        <li>
                            <a href="../sub6/sub6_1.html">고객센터</a>
                        </li>
                        <li class="family">
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
                        </li>
                    </ul>
                </div>
                <!-- footer_top End -->                
                <!-- footer_logo Start -->
                <img src="../common/images/footer_logo.png" alt="" class="footer_logo">
                <!-- footer_logo End-->
                <!-- footer_bottom Start -->
                <div class="footer_bottom">
                    <address>
                        A. 서울특별시 동작구 보라매로 5길 51(신대방동, 롯데타워)
                    </address>
                    <p>
                        &copy; COPYRIGHT 2013 LOTTE ALLUMINIUM CO., LTD. ALL RIGHT RESERVED
                    </p>
                </div>
                <ul class="sns">
                    <li class="instar"><a title="롯데인스타그램 새창에서 열기" target="blank" href="https://www.instagram.com/happylotteworld/">인스타그램</a></li>
                    <li class="facebook"><a title="롯데페이스북 새창에서 열기" target="blank" href="https://www.facebook.com/lotte/?ref=nf&hc_ref=ARSbTxlUW38dRIboL5M0kgb40KDZVLCrozT_kxPef_m_ktFTQUojOTZuHBEf39fLPYw">페이스북</a></li>
                    <li class="blog"><a title="롯데트위터 새창에서 열기" target="blank" href="https://twitter.com/lotte_ent?ref_src=twsrc%5Etfw%7Ctwcamp%5Eembeddedtimeline%7Ctwterm%5Eprofile%3Alotte_ent%7Ctwgr%5EeyJ0ZndfZXhwZXJpbWVudHNfY29va2llX2V4cGlyYXRpb24iOnsiYnVja2V0IjoxMjA5NjAwLCJ2ZXJzaW9uIjpudWxsfSwidGZ3X2hvcml6b25fdHdlZXRfZW1iZWRfOTU1NSI6eyJidWNrZXQiOiJodGUiLCJ2ZXJzaW9uIjpudWxsfSwidGZ3X3R3ZWV0X2VtYmVkX2NsaWNrYWJpbGl0eV8xMjEwMiI6eyJidWNrZXQiOiJjb250cm9sIiwidmVyc2lvbiI6bnVsbH19&ref_url=http%3A%2F%2Fmrkjhha.cafe24.com%2Fsub4%2Fsub4_3.html">블로그</a></li>
                </ul>
                <!-- footer_bottom End -->
            </div>
        </footer>
        <!-- Footer End -->
	</div> <!-- end of wrap -->
</body>
</html>