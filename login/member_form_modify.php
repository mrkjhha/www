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
	<title>회원정보수정</title>
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./css/modify_form.css">
	
    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script src="../member/js/member_scroll.js"></script>
    <script src="../member/js/check.js"></script>
    <script>
        function check_id()
        {
            window.open("check_id.php?id=" + document.member_form.id.value,
                "IDcheck",
                "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
        }

        function check_nick()
        {
            window.open("../member/check_nick.php?nick=" + document.member_form.nick.value,
                "NICKcheck",
                "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
        }

        function check_input()
        {
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
        }

        function reset_form()
        {
            
            $('#loadtext2').html('');
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = p_name;
            document.member_form.nick.value = p_nick;
            document.member_form.hp1.value = p_hp1;
            document.member_form.hp2.value = p_hp2;
            document.member_form.hp3.value = p_hp3;
            document.member_form.email1.value = p_email1;
            document.member_form.email2.value = p_email2;
            
            document.member_form.pass.focus();

            return;
        }
    </script>
</head>
<?
    //$userid='aaa';
    
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
    //$row[id]....$row[level]

    $hp = explode("-", $row[hp]);  //000-0000-0000
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
?>
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
                        <li class="wellcome">
                            <a href=""><?=$usernick?>님 환영합니다.</a>
                        </li>
                        <li class="logout">
                            <a href="./logout.php">로그아웃</a>
                        </li>
                        <li class="change_info">
                            <a href="./member_form_modify.php">정보수정</a>
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
            <h2>정보수정</h2>
            <a class="member_delete" href="../member/delete_form.php">회원탈퇴</a>
            <form  name="member_form" method="post" action="modify.php">
                <span>* 은 필수 항목입니다.</span>
                <table>
                    <caption class="hidden">정보수정</caption>
                    <tr>
                        <th scope="col">아이디</th>
                        <td>
                            <?= $row[id] ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="pass">비밀번호&nbsp;<span>*</span></label></th>
                        <td>
                            <input type="password" name="pass" id="pass" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="pass_confirm">비밀번호확인&nbsp;<span>*</span></label></th>
                        <td>
                            <input type="password" name="pass_confirm" id="pass_confirm" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="name">이름&nbsp;<span>*</span></label></th>
                        <td>
                        <input type="text" name="name" id="name" value="<?= $row[name] ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="nick">닉네임&nbsp;<span>*</span></label></th>
                        <td>
                            <input type="text" name="nick" id="nick" value="<?= $row[nick] ?>" required>
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
                            <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2" value="<?= $hp2 ?>" required> - 
                            <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3" value="<?= $hp3 ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">이메일&nbsp;<span>*</span></th>
                        <td>
                            <label class="hidden" for="email1">이메일아이디</label>
                            <input type="text" id="email1" name="email1" value="<?= $email1 ?>" required> @ 
                            <label class="hidden" for="email2">이메일주소</label>
                            <input type="text" id="email2" name="email2" value="<?= $email2 ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="#" onclick="check_input()">수정완료</a>&nbsp;&nbsp;
                            <a href="#" onclick="reset_form()">취소하기</a>
                        </td>
                    </tr>
                </table>
            </form>
        </article>
    </div>
    <script>
        var p_name=$('#name').val();
        var p_nick=$('#nick').val();
        var p_hp1=$('#hp1').val();
        var p_hp2=$('#hp2').val();
        var p_hp3=$('#hp3').val();
        var p_email1=$('#email1').val();
        var p_email2=$('#email2').val();
        
        $(document).ready(function() {
            
            //nick 중복검사
            $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
                var nick = $('#nick').val();

                $.ajax({
                    type: "POST",
                    url: "../member/check_nick.php",
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
</body>
</html>
