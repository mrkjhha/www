<?
   session_start();
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
   include "../lib/dbconn.php";

   $sql = "select * from $table where num=$num";
   $result = mysql_query($sql, $connect);

   $row = mysql_fetch_array($result);
     // 하나의 레코드 가져오기
   
   $item_num     = $row[num];
   $item_id      = $row[id];
   $item_name    = $row[name];
     $item_nick    = $row[nick];
   $image_name   = $row[file_name];
   $image_copied = $row[file_copied];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>롯데알미늄</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="./common/css/sub6common.css">
    <link rel="stylesheet" href="./css/delete_form.css">

	<script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
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
            <a id="yes" href="delete.php?table=<?=$table?>&num=<?=$num?>">네</a>
            <a id="no" href="#" onclick="return_back()">아니오</a>
        </div>
    </div>
</body>
</html>