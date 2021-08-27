<meta charset="utf-8">
<?
   session_start();
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
    //$id='a';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>좋아요체크</title>
<?
   if(!$gallery_num)
   {
      echo("잘못된 접근입니다!!");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from likes where parant='$gallery_num' and id='$userid'";
      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record)
      {
        $sql = "delete from likes where parant='$gallery_num' and id='$userid'";
        mysql_query($sql, $connect);
        echo "<script>$('.g_box .like_cnt:eq('+likes_ind+')').addClass('likes_off');</script>";
      }
      else
      {
        $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
        //$ip = $REMOTE_ADDR;         // 방문자의 IP 주소를 저장

        $sql = "insert into likes(parant, id, name, nick, regist_day) ";
		$sql .= "values('$gallery_num', '$userid', '$username', '$usernick', '$regist_day')";
        mysql_query($sql, $connect);
      };

      $sql = "select * from likes where parant='$gallery_num'"; //입력 후 전체 레코드 조회
      $total_likes = mysql_query($sql, $connect);
      $num_total = mysql_num_rows($total_likes);
      echo "$num_total";
      mysql_close();
   }
?>
</head>
</html>