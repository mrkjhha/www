<? 
	session_start();
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    $table = "user_gallery";
    $ripple = "gallery_ripple";

    include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);
	
	$item_num = $row[num];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Begin Again</title>

    <link rel="shortcut icon"  type="image/x-icon"  href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="app_icon.png">
    <link rel="apple-touch-startup-image" href="startup.png">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/delete_form.css">

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('body').height($(window).height());
        });
        </script>
        <script>
            function return_back(){
                history.go(-1);
            };
    </script>
</head>
<body>
    <div id="confirm">
        <p>한번 삭제된 데이터는 복구 할 수 없습니다.<br>그래도 계속 하시겠습니까?</p>
        <div class="confirmBtn_box">
            <a id="yes" href="delete.php?table=<?=$table?>&num=<?=$item_num?>">네</a>
            <a id="no" href="#" onclick="return_back()">아니오</a>
        </div>
    </div>
</body>
</html>