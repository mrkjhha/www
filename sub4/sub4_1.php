<? 
	session_start();
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    $table = "news";
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
    <link rel="stylesheet" href="./common/css/sub4common.css">
    <link rel="stylesheet" href="./css/sub4_content1.css">

    <script src="../mainjs/mainpopup.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
        function search_submit(){
            document.news_form.submit();
        }
    </script>
</head>
<?
	include "../lib/dbconn.php";

    // echo("
    //         <script>
    //         window.alert($news_scale);
    //         window.alert($news_find);
    //         </script>
	// 	");

    if (!$scale)
        $scale=10;// 한 화면에 표시되는 글 수
    
    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page) // 페이지번호($page)가 0 일 때
		$page = 1; // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;
	$number = $total_record - $start;
?>
<body>
    <div class="wrap">
        <!-- Header Area -->
        <? include "../common/sub_head.html" ?>
        <!-- Header Area End -->
        <div class="visual">
            <img src="./common/images/sub4_visual.jpg" alt="">
        </div>
        <div class="sub_menu">
            <h3>홍보센터</h3>
            <p>promotional center</p>
            <ul>
                <li class="current"><a href="sub4_1.php">알미늄소식</a></li>
                <li><a href="sub4_2.html">PR자료실</a></li>
                <li><a href="sub4_3.html">롯데SNS</a></li>
                <li><a href="sub4_4.html">공모전</a></li>
            </ul>
        </div>
        <article id="contents">
            <div class="title_area">
                <div class="line_map">
                    home &gt; 홍보센터 &gt; <span>알미늄소식</span>
                </div>
                <h2>알미늄소식</h2>
            </div>
            <div class="content_area">
                <div class="con_inner">
                    <div class="top_box">
                        <div class="scale_wrap">
                            <label class="hidden" for="scale">보기선택값</label>
                            <select name="scale" id="scale" onchange="location.href='sub4_1.php?scale='+this.value">
                                <option value=''><?=$scale?>개씩</option>
                                <option value='5'>5개씩</option>
                                <option value='10'>10개씩</option>
                                <option value='15'>15개씩</option>
                                <option value='20'>20개씩</option>
                            </select>
                        </div>
                        <form id="search_area" name="news_form" method="post" action="sub4_1.php?table=<?=$table?>&mode=search"> 
                            <div class="category_wrap">    
                                <label class="hidden" for="search_category">Search Category</label>
                                <select name="find" id="search_category">
                                    <option value='subject'>제목</option>
                                    <option value='content'>내용</option>
                                    <option value='nick'>별명</option>
                                    <option value='name'>이름</option>
                                </select>
                            </div>
                            <div class="search_box"><label class="hidden" for="search">검색단어</label><input type="text" id="search" name="search"></div>
                            <div class="search_btn"><a href="#" onclick="search_submit()">검색</a></div>
                        </form>
                    </div>
                    <div class="list_top">
                        <ul class="list_wrap">
                            <li class="list1">번호</li>
                            <li class="list2">제목</li>
                            <li class="list3">작성자</li>
                            <li class="list4">등록일</li>
                            <li class="list5">조회수</li>
                        </ul>
                    </div>
                    <div class="list_con_wrap">
                        <?		
                            for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
                                mysql_data_seek($result, $i);       
                                // 가져올 레코드로 위치(포인터) 이동  
                                $row = mysql_fetch_array($result);       
                                // 하나의 레코드 가져오기
                                
                                $item_num     = $row[num];
                                $item_id      = $row[id];
                                $item_name    = $row[name];
                                $item_nick    = $row[nick];
                                $item_hit     = $row[hit];
                                $item_date    = $row[regist_day];
                                $item_date = substr($item_date, 0, 10);  
                                $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
                                        
                                if($row[file_copied_0]){ 
                                    $item_img = './data/'.$row[file_copied_0];  
                                }else{
                                    $item_img = './data/default.jpg'  ;
                                }
                        ?>
                                <ul class="list_item">
                                    <li class="list_item1"><?= $number ?></li>
                                    <li class="list_item2">
                                        <a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
                                            <?= $item_subject ?>
                                        </a>
                                    </li>
                                    <li class="list_item3"><?= $item_nick ?></li>
                                    <li class="list_item4"><?= $item_date ?></li>
                                    <li class="list_item5"><?= $item_hit ?></li>
                                </ul>
                        <?
                                $number--;
                            }
                        ?>
                    </div>
			        <div class="page_button">
				        <div id="page_num">
                            <?
                                $before_p=$page-1;
                                if($before_p<1){$before_p=1;}
                                if($mode=="search"){
                                    echo "<a class='before' href='sub4_1.php?page=$before_p&scale=$scale&mode=search&find=$find&search=$search'> 이전 </a>"; 
                                }else{  
                                    echo "<a class='before' href='sub4_1.php?page=$before_p&scale=$scale'> 이전 </a>";
                                }
                            ?>
                            <!-- <a class="before" href="#">이전</a> -->
                            <div>
                                <?
                                // 게시판 목록 하단에 페이지 링크 번호 출력
                                for ($i=1; $i<=$total_page; $i++)
                                {
                                    if ($page == $i)     // 현재 페이지 번호 링크 안함
                                    {
                                        echo "<span class='current'> $i </span>";
                                    }
                                    else
                                    {
                                        if($mode=="search"){
                                            echo "<a href='sub4_1.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'> $i </a>"; 
                                        }else{    
                                            
                                            echo "<a href='sub4_1.php?page=$i&scale=$scale'> $i </a>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <?
                                $next_p=$page+1;
                                if($next_p>$total_page){$next_p=$total_page;}
                                if($mode=="search"){
                                    echo "<a class='next' href='sub4_1.php?page=$next_p&scale=$scale&mode=search&find=$find&search=$search'> 다음 </a>"; 
                                }else{  
                                    echo "<a class='next' href='sub4_1.php?page=$next_p&scale=$scale'> 다음 </a>";
                                }
                            ?>
                            <!-- <a class="next" href="#">다음</a> -->
						</div>
						<div id="button">
                            <a href="sub4_1.php?table=<?=$table?>&page=<?=$page?>">목록</a>
                            <? 
                                if($userid)
                                {
                            ?>
                                    <a href="write_form.php?table=<?=$table?>">글쓰기</a>
                            <?
                                }
                            ?>
				        </div>
			        </div> <!-- end of page_button -->
                </div>
            </div>
        </article>
        <!-- Footer Area -->
        <? include "../common/sub_foot.html" ?>
        <!-- Footer Area End -->
    </div>
    <!-- JQuery -->
    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/gnb.js"></script>
    <script src="./common/js/sub4_scroll.js"></script>
</body>
</html>