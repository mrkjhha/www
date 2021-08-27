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
<title>회원탈퇴</title>
<?
    // 이전화면에서 이름이 입력되지 않았으면 "이름을 입력하세요"
    // 메시지 출력
    // $id=>입력id값    $pass=>입력 pass

    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $num_match = mysql_num_rows($result);  //1 0

    $row = mysql_fetch_array($result); 
    //$row[id] ,.... $row[level]
    $sql ="select * from member where id='$userid' and pass=password('$delete_pass')";
    $result = mysql_query($sql, $connect);
    $num_match = mysql_num_rows($result);

    if(!$num_match)  //적은 패스워드와 디비 패스워드가 같지않을때
    {
        echo("
            <script>
            window.alert('비밀번호가 틀립니다.');
            location.href = '../index.html';
            </script>
            </head>
            </html>
        ");
        exit;
    }
    else    // 입력 pass 와 테이블에 저장된 pass 일치한다.
    {  
        $sql ="delete from member where id='$userid'";
        mysql_query($sql, $connect);

        //세션변수종료 및 delete 
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['usernick']);
        unset($_SESSION['userlevel']);

        echo "
        <script>
            alert('회원탈퇴가 정상적으로 처리되었습니다. 안녕히가세요~');
            location.href = '../index.html';
        </script>
        ";
    }
?>
</head>
</html>