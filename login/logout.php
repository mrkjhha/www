<?
  session_start();
  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  unset($_SESSION['usernick']);
  unset($_SESSION['userlevel']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>로그아웃</title>
<?
  echo("
       <script>
          location.href = '../index.html'; 
         </script>
       ");
?>
</head>
</html>