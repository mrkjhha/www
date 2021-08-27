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
<title>삭제</title>
<?
    include "../lib/dbconn.php";

    $sql = "select * from $table where num = $num";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

    $copied_name = $row[file_copied];

    $image_name = "../data/".$copied_name;
    unlink($image_name);

    $sql = "delete from $table where num = $num";
    mysql_query($sql, $connect);
 
    $sql = "delete from gallery_ripple where parent=$num";
    mysql_query($sql, $connect);

    mysql_close();

    echo "
	   <script>
	    location.href = '../sub4.php?table=$table';
	   </script>
       </head>
       </html>
	";
?>

