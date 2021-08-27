<?
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>정보삭제</title>
<?
/*
table=$table
num=$item_num (본글 글번호)
ripple_num=$ripple_num(리플 글번호)
*/
    include "../lib/dbconn.php";

    $sql = "delete from gallery_ripple where num=$ripple_num";
    mysql_query($sql, $connect);
    mysql_close();

    echo "
	    <script>
	    location.href = 'ripple_view.php?table=$table&num=$num';
	   </script>
       </head>
       </html>
	  ";
?>