<meta charset="UTF-8">
<?
   session_start();
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);

   //$table, $num , 세션변수 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>데이터삭제</title>
<?
   include "../lib/dbconn.php";
   

   $sql = "select * from $table where num = $num";
   $result = mysql_query($sql, $connect);

   $row = mysql_fetch_array($result);

   $copied_name = $row[file_copied];

   //업로든된 파일 삭제

	if ($copied_name)
	{
		$image_name = "./data/".$copied_name;
		unlink($image_name);
      //unlink(업드로든 파일경로 파일명); => 파일삭제
	};

   $sql = "delete from $table where num = $num";
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
	      location.href = 'sub6_2.php?table=$table';
	   </script>
	";
?>
</head>
</html>