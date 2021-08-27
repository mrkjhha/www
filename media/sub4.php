<? 
	session_start();
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    $table = "user_gallery";
    $ripple = "gallery_ripple";
?>
<!DOCTYPE html>
<html lang="ko">
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
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/sub4.css">
    <link rel="stylesheet" href="./css/scroll_down.css">

    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/jquery-migrate-1.4.1.min.js"></script>
    <script src="./js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
        function submit()
        {   
            document.login_form.submit(); 
            // login.php 로 변수 전송
        };

        function login_reset_form()
        {
            document.login_form.id.value = "";
            document.login_form.pass.value = "";
            document.login_form.id.focus();
            return;
        };
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
<body>
    <?
        include "./lib/dbconn.php";
        // 한 화면에 표시되는 글 수

        if ($mode=="search")
        {
            if(!$search)
            {
                echo("
                    <script>
                    window.alert('검색할 단어를 입력해 주세요!');
                    history.go(-1);
                    </script>
                    </body>
                    </html>
                ");
                exit;
            }
            $sql = "select * from $table where $find like '%$search%' order by num desc";
        }
        else
        {
            $sql = "select * from $table order by num desc";
        };

        $result = mysql_query($sql, $connect);
        $total_record = mysql_num_rows($result); // 전체 글 수
    ?>
    <div id="skipNav">
        <a href="#contents">본문바로가기</a>
        <a href="#gnb">네비게이션바로가기</a>
    </div>
    <div id="wrap">
        <div class="visualBox">
            <img src="./images/visual_img4.jpg" id="imgBG" alt="비쥬얼이미지">
        </div>
        <header id="headerArea">
            <h1><a href="./index.html">비긴어게인</a></h1>
            <? include "./member/login_join_form.php" ?>
            <a href="#" class="menu_btn">menu</a>
            <nav id="gnb">
                <h2 class="hidden">글로벌네비게이션영역</h2>
                <ul class="gnb_menu">
                    <li><h3><a href="./sub1.html">story</a></h3></li>
                    <li><h3><a href="./sub2.html">actors</a></h3></li>
                    <li><h3><a href="./sub3.html">albums</a></h3></li>
                    <li><h3><a href="./sub4.php">gallery</a></h3></li>
                </ul>
            </nav>
        </header>
        <article id="contents">
            <div class="visual_title">
                <div class="title_wrap">
                    <h2 class="title">Gallery</h2>
                </div>
                <a class="scroll_down mouse" href="#"></a>
                <p class="scroll_text">Scroll_down</p>
            </div>
            <section class="gallery">
                <div class="box">
                    <h3>gallery</h3>
                    <? 
                        if($userid)
                        {
                    ?>
                        <div class="gallery_btnbox">
                            <a href="./ripples/write_form.php?table=<?=$table?>">글쓰기</a>
                        </div>
                    <?
                        };
                    ?>
                </div>
                <div class="gallery_wrap">
                    <div class="gallery_box">
                    <?  
                        include "./lib/dbconn.php";
                        $sql = "select * from $table order by num desc";
                        $result = mysql_query($sql, $connect);

                        for ($i=0; $i<$total_record; $i++)
                        {
                            mysql_data_seek($result, $i);     // 포인터 이동        
                            $row = mysql_fetch_array($result); // 하나의 레코드 가져오기
                            
                            $item_num     = $row[num];
                            $item_id      = $row[id];
                            $item_name    = $row[name];
                            $item_nick    = $row[nick];
                            $item_tag     = $row[tag];
                            $item_instar  = $row[instar];
                            $item_blog    = $row[blog];
                            $item_date    = $row[regist_day];

                            $item_date = substr($item_date, 0, 10);  
                            $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

                            $item_content = $row[content];
                            $item_content = str_replace(" ", "&nbsp;", $item_content);
                            $item_content = str_replace("\n", "<br>", $item_content);
                            $item_subject = str_replace(" ", "&nbsp;", $item_subject);
                            $item_subject = str_replace("\n", "<br>", $item_subject);
                            $item_tag = str_replace(" ", "&nbsp;", $item_tag);
                            $item_tag = str_replace("\n", "<br>", $item_tag);
                            $item_instar = str_replace(" ", "&nbsp;", $item_instar);
                            $item_instar = str_replace("\n", "<br>", $item_instar);
                            $item_blog = str_replace(" ", "&nbsp;", $item_blog);
                            $item_blog = str_replace("\n", "<br>", $item_blog);
                            
                            $image_name   = $row[file_name];
                            $image_copied = $row[file_copied];

                            $imageinfo = GetImageSize("./data/".$image_copied);
                            //GetImageSize(서버에 업로드된 파일 경로 파일명)
                            // => 파일의 너비와 높이값, 종류
                            $image_width = $imageinfo[0];  //파일너비
                            $image_height = $imageinfo[1]; //파일높이
                            $image_type  = $imageinfo[2];  //파일종류

                            if ($image_width > 785)
                                    $image_width = 785;

                            $sql = "select * from $ripple where parent=$item_num";
                            $result2 = mysql_query($sql, $connect);
                            $num_ripple = mysql_num_rows($result2);

                    echo "<div class='g_box box".($i+1)."'>";
                    ?>
                            <span class="hidden gallery_id"><?=$item_num?></span>
                            <div class="g_box_top">
                    <?
                                $img_name = $image_copied;
                                $img_name = "./data/".$img_name;
                                // ./data/2019_03_22_10_07_15_0.jpg
                                $img_width = $image_width;
                                echo "<img src='$img_name' alt='유저갤러리이미지'>";
                    ?>
                    <? 
                        if($userid==$item_id || $userid=='master' || $userid=='admin')
                        {
                    ?>
                        <a class="delete_btn" href="./ripples/delete_form.php?table=<?=$table?>&num=<?=$item_num?>">글삭제</a>
                        <a class="modify_btn" href="./ripples/write_form.php?table=<?=$table?>&mode=modify&num=<?=$item_num?>">수정</a>
                    <?
                        };
                    ?>
                                <dl>
                                    <dt><?=$item_subject?><a class="more_btn" href="#">내용보기</a></dt>
                                    <dd class="gal_content"><?=$item_content?></dd>
                                    <dd><?=$item_tag?></dd>
                                </dl>
                            </div>
                            <div class="sns_box">
                    <?
                                $sql_likes = "select * from likes where parant='$item_num'";
                                $total_likes = mysql_query($sql_likes, $connect);
                                $num_total = mysql_num_rows($total_likes);

                                $sql_likes = "select * from likes where parant='$item_num' and id='$userid'";
                                $exist_like_result = mysql_query($sql_likes, $connect);
                                $exist = mysql_num_rows($exist_like_result);
                    ?>
                                <span>
                    <?          
                                if($userid){
                                    if($exist) {
                                        echo "<a class='likes likes_on' href='#'>좋아요</a>";
                                    } else {
                                        echo "<a class='likes likes_off' href='#'>좋아요</a>";
                                    };
                                } else {
                                    echo "<a class='nonuser' href='#'>좋아요</a>";
                                };
                    ?>
                                    <span class='like_cnt'><?=$num_total?></span>
                                </span>
                                <span>
                                    <a href="<?=$item_instar?>">인스타그램</a>
                                </span>
                                <span>
                                    <a href="<?=$item_blog?>">블로그</a>
                                </span>
                                <span>
                                    <a href="./ripples/ripple_view.php?num=<?=$item_num?>">덧글+<br>
                                <?
		                            if ($num_ripple){
				                        echo "[ $num_ripple ]";
                                    } else {
                                        echo "[ 0 ]";
                                    };
                                ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    <?
                        };
                    ?>
                    </div>
                </div>
            </section>
        </article>
        <footer id="footerArea">
            <p class="foot_title">Begin Again</p>
            <p>Made by John Carney, in 2013</p>
            <p>Main actors : Mark Ruffalo, Keira Knightley, Adam Levine</p>
            <a href="#" class="topMove">top</a>
        </footer>
    </div>
    <script src="./js/sub4_set.js"></script>
    <script src="./js/index_scroll.js"></script>
    <script>
        var likes_ind;
        var gallary_num;
        var id_user;
        $(document).ready(function() {
            //like_check
            id_user='<?=$userid?>';
            
            $(".likes").click(function(e) {    // 좋아요클릭시
                e.preventDefault();
                likes_ind = $(this).index('.sns_box .likes');
                gallary_num = $('.gallery_id:eq('+likes_ind+')').text();

                // 로그인된 userid 값 확인
                $.ajax({
                    type: "POST",
                    url: "./likes/likes_check.php",
                    data: {gallery_num:gallary_num},
                    cache: false, 
                    success: function(data)
                    {
                        //data => echo "문자열" 이 저장된
                        $('.g_box .like_cnt:eq('+likes_ind+')').html(data);
                        if($('.g_box .likes:eq('+likes_ind+')').hasClass('likes_on')){
                            $('.g_box .likes:eq('+likes_ind+')').removeClass('likes_on').addClass('likes_off');
                            $('.gallery_wrap .g_box:eq('+likes_ind+')').removeClass('likes_on');
                        } else {
                            $('.g_box .likes:eq('+likes_ind+')').removeClass('likes_off').addClass('likes_on');
                            $('.gallery_wrap .g_box:eq('+likes_ind+')').addClass('likes_on');
                        };
                    }
                });
            });
            $(".nonuser").click(function(e){
                e.preventDefault();
                window.alert('좋아요기능을 이용하시려면 로그인을 해주세요!');
            });
        });
    </script>
</body>
</html>