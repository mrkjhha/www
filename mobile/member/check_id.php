<meta charset="utf-8"/>
<?
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
    //$id='a';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>아이디체크</title>
<?
    if(!$id) 
   {
      echo("아이디를 입력하세요.");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where id='$id' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record)
      {
       
         echo "<span style='color:red'>다른 아이디를 사용하세요.</span>";
      }
      else
      {
         echo "<span style='color:green'>사용가능한 아이디입니다.</span>";
      }
      
      mysql_close();
   }
?>
</head>
</html>