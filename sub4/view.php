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
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];
	
	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}
	
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) //업로드한 파일이 존재하면 0 1 2
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
            //GetImageSize(서버에 업로드된 파일 경로 파일명)
              // => 파일의 너비와 높이값, 종류
			$image_width[$i] = $imageinfo[0];  //파일너비
			$image_height[$i] = $imageinfo[1]; //파일높이
			$image_type[$i]  = $imageinfo[2];  //파일종류

        if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num"; // 글 조회수 증가시킴
	mysql_query($sql, $connect);
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
    <link rel="stylesheet" href="./css/view.css">

    <script src="../mainjs/mainpopup.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
	<script>
		function del(href) 
		{
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
					document.location.href = href;
			}
		}
	</script>
</head>
<body>
	<div id="wrap">
		<div id="confirmBg"></div>
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
				<h3 class="hidden">뉴스 작성</h3>
				<div class="con_inner">
					<dl class="view_title">
						<dt class="view_title1">
							<?= $item_subject ?>
						</dt>
						<dd class="view_title2">
							닉네임 : <?= $item_nick ?>
						</dd>
						<dd class="view_title3">
							조회 : <?= $item_hit ?>
						</dd>  
						<dd class="view_title4">
							개시일 : <?= $item_date ?>
						</dd>
						<dd class="view_title5">
							<div class="view_content">
								<?
									for ($i=0; $i<3; $i++)  //업로드된 이미지를 출력한다
									{
										if ($image_copied[$i])
										{
											$img_name = $image_copied[$i];
											$img_name = "./data/".$img_name; 
											// ./data/2019_03_22_10_07_15_0.jpg
											$img_width = $image_width[$i];
											
											echo "<img src='$img_name' width='$img_width' alt='뉴스이미지'>"."<br><br>";
										}
									}
								?>
								<?= $item_content ?>
							</div>
						</dd>
					</dl>
					<div id="view_button">
						<a href="sub4_1.php?table=<?=$table?>&page=<?=$page?>">목록</a>
						<? 
							if($userid==$item_id || $userid=="admin" || $userlevel==1 )
							{
						?>
							<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>
							<a class="delete_list" href="#">삭제</a>
						<?
							}
						?>
						<? 
							if($userid)
							{
						?>
							<a href="write_form.php?table=<?=$table?>">글쓰기</a>
						<?
							}
						?>
					</div>
					<div id="confirm">
						<p>한번 삭제된 데이터는 복구 할 수 없습니다.<br>그래도 계속 하시겠습니까?</p>
						<div class="confirmBtn_box">
							<!-- <a id="yes" href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">네</a> -->
							<a id="yes" href="delete.php?table=<?=$table?>&num=<?=$num?>">네</a>
							<a id="no" href="#">아니오</a>
						</div>
					</div>
				</div>
			</div> <!-- end of col2 -->
		</article> <!-- end of content -->
        <!-- Footer Area -->
        <? include "../common/sub_foot.html" ?>
        <!-- Footer Area End -->
	</div> <!-- end of wrap -->
    <!-- JQuery -->
    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../common/js/gnb.js"></script>
    <script src="./common/js/sub4_scroll.js"></script>
	<script>
		$(document).ready(function() {
 			var screenHeight=$(window).height();
			$("#no").click(function(e){
				e.preventDefault();
				$('#confirmBg').height(0);
				$('#confirm').hide();
			});

			$(".delete_list").click(function(e) {    // id입력 상자에 id값 입력시
				e.preventDefault();
				$('#confirmBg').height(screenHeight);
				$('#confirm').show();
			});
		});
	</script>
</body>
</html>
