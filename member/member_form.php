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
	<link rel="stylesheet" href="./css/member_form.css">
	
    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script src="./js/member_scroll.js"></script>
    <script src="./js/check.js"></script>
	<script>
        // <![CDATA[
        try {
         window.addEventListener('load', function(){
          setTimeout(scrollTo, 0, 0, 1);
         }, false);
        } 
        catch(e) {}
        // ]]>
        </script>
        <!--[if lt IE 9]> 
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
	<script>
	$(document).ready(function() {
 
        //id 중복검사
        $("#id").keyup(function() {    // id입력 상자에 id값 입력시
        var id = $('#id').val(); //a

            $.ajax({
                type: "POST",
                url: "check_id.php",
                data: "id="+ id,  
                cache: false, 
                success: function(data)
                {
                    //data => echo "문자열" 이 저장된
                    $("#loadtext").html(data);
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
        $('#loadtext').html('');
        $('#loadtext2').html('');
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
                            <a href="../login/login_form.php">로그인</a>
                        </li>
                        <li class="join">
                            <a href="./member_check.html">회원가입</a>
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
        </header>
        <article id="content">  
        
            <h2>회원가입</h2>
            <form  name="member_form" method="post" action="insert.php">
                <span>* 은 필수 항목입니다.</span>
                <table>
                <caption class="hidden">회원가입</caption>
                <tr>
                    <th scope="col"><label for="id">아이디&nbsp;<span>*</span></label></th>
                    <td>
                <?
                    if(!$userid){
                ?>
                    <input type="text" name="id" id="id" required>
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
                    <th scope="col"><label for="pass">비밀번호&nbsp;<span>*</span></label></th>
                    <td>
                        <input type="password" name="pass" id="pass" required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="pass_confirm">비밀번호확인&nbsp;<span>*</span></label></th>
                    <td>
                        <input type="password" name="pass_confirm" id="pass_confirm"  required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="name">이름&nbsp;<span>*</span></label></th>
                    <td>
                        <input type="text" name="name" id="name"  required> 
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="nick">닉네임&nbsp;<span>*</span></label></th>
                    <td>
                        <input type="text" name="nick" id="nick"  required>
                        <span id="loadtext2"></span>
                    </td>
                </tr>
                <tr>
                    <th scope="col">휴대폰&nbsp;<span>*</span></th>
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
                        <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2"  required> - 
                        <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3"  required>
                    </td>
                </tr>
                <tr>
                    <th scope="col">이메일&nbsp;<span>*</span></th>
                    <td>
                        <label class="hidden" for="email1">이메일아이디</label>
                        <input type="text" id="email1" name="email1"  required> @ 
                        <label class="hidden" for="email2">이메일주소</label>
                        <input type="text" name="email2" id="email2"  required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="#" onclick="check_input()">가입하기</a>
                        <a href="#" onclick="reset_form()">취소하기</a>
                    </td>
                </tr>
            </table>
        </form>
        
        </article>
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
    </div>
</body>
</html>