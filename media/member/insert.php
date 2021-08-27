<?
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>회원가입</title>
<?   
    //$id='';  (중복검사)
		//$pass='';
		//$pass_confirm='';
		//$nick='';   (중복검사)

		//$hp1 = '010';
		//$hp2 = '중간자리';
		//$hp3 = '끝자리';

		//$email1='메일아이디';
		//$email2='nate.com';

   $hp = $hp1."-".$hp2."-".$hp3;  //010-0000-0000
   $email = $email1."@".$email2;  //bini@nate.com

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
   $ip = $REMOTE_ADDR;         // 방문자의 IP 주소를 저장

   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $sql = "select * from member where id='$join_id'";
   $result = mysql_query($sql, $connect);
   $exist_id = mysql_num_rows($result);

   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 존재합니다.');
             location.href = '../index.html';
           </script>
           </head>
           </html>
         ");
         exit;
   }
   else
   {            // 레코드 삽입 명령을 $sql에 입력
	    $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level) ";
		$sql .= "values('$join_id', password('$join_pass'), '$name', '$nick', '$hp', '$email', '$regist_day', 9)";

		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
   }

   mysql_close();                // DB 연결 끊기
   echo "
	   <script>
		  alert('회원가입이 정상적으로 처리되었습니다. 방가방가~');
	    location.href = '../index.html';
	   </script>
	";
?>
</head>
</html>