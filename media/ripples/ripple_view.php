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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/ripple_view.css">

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
        function ripple_check_input()
        {
            if (!document.ripple_form.ripple_content.value)
            {
                alert("내용을 입력하세요!");    
                document.ripple_form.ripple_content.focus();
                return;
            }
            document.ripple_form.submit();
        }

        function del(href) 
        {
            if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                    document.location.href = href;
            }
        }
    </script>
    <script>
        // <![CDATA[
        try {
         window.addEventListener('load', function(){
          setTimeout(scrollTo, 0, 0, 1);
         }, false);
        } 
        catch(e) {}
        // ]]>
    </script>
    <!--[if lt IE 9]> 
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>
<?
	include "../lib/dbconn.php";
    // 한 화면에 표시되는 글 수

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
?>
<body>
    <div id="skipNav">
        <a href="#contents">본문바로가기</a>
        <a href="#gnb">네비게이션바로가기</a>
    </div>
    <div id="wrap">
        <header id="headerArea">
            <h1><a href="../index.html">비긴어게인</a></h1>
            <? include "../member/login_join_form.php" ?>
            <a href="#" class="menu_btn">menu</a>
            <nav id="gnb">
                <h2 class="hidden">글로벌네비게이션영역</h2>
                <ul class="gnb_menu">
                    <li><h3><a href="../sub1.html">story</a></h3></li>
                    <li><h3><a href="../sub2.html">actors</a></h3></li>
                    <li><h3><a href="../sub3.html">albums</a></h3></li>
                    <li><h3><a href="../sub4.php">gallery</a></h3></li>
                </ul>
            </nav>
        </header>
        <article id="contents">
            <h2 class="hidden">댓글페이지</h2>
            <div class="ripple_wrap">
                <div class="ripple_window">
                    <ul class="ripple_showbox">
                <?
                        $sql = "select * from $ripple where parent='$item_num'";
                        $ripple_result = mysql_query($sql);
                        $num_ripple = mysql_num_rows($ripple_result);
                        
                        while ($row_ripple = mysql_fetch_array($ripple_result))
                        {
                            $ripple_num     = $row_ripple[num];
                            $ripple_id      = $row_ripple[id];
                            $ripple_nick    = $row_ripple[nick];
                            $ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
                            $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
                            $ripple_date = explode(" ", $row[regist_day]);  //000-0000-0000
                            $ripple_date1 = $ripple_date[0];
                            $ripple_date2 = $ripple_date[1];
                ?>
                        <li class="ripples_wrap">
                            <ul class="ripple_title_wrap">
                                <li class="writer_title1"><?=$ripple_nick?></li>
                                <li class="writer_title2"><?=$ripple_date1?></li>
                            </ul>
                            <div class="ripple_content">
                                <?=$ripple_content?>
                            </div>
                        <? 
                            if($userid=="admin" || $userid==$ripple_id)
                            echo "<a class='ripple_delete_btn' href='delete_ripple.php?table=$ripple&num=$item_num&ripple_num=$ripple_num'>삭제</a>"; 
                        ?>
                        </li>
                        
                    <?
                            };
                    ?>
                    </ul>
                    <?
                            if(!$num_ripple){
                    ?>
                            <p class="none">댓글이 없습니다.</p>
                    <?
                            };
                    ?>
                </div>
                <form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
                    <div id="ripple_box">
                        <label for="ripple_content" id="ripple_box1">
                            댓글입력
                        </label>
                        <div id="ripple_box2">
                            <textarea rows="5" cols="65" name="ripple_content" id="ripple_content"></textarea>
                        </div>
                        <div id="ripple_box3">
                            <a class="complete" href="#" onclick="ripple_check_input()">작성완료</a>
                            <a class="back_to_view" href="../sub4.php">돌아가기</a>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
    <script src="../js/index_scroll.js"></script>
    <script>
        $(document).ready(function(){
            $('#contents').height($(window).height());
            $('.ripple_window').height($(window).height()*0.4);
        });
    </script>
</body>
</html>