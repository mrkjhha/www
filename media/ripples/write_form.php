<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
    //새글쓰기 =>  $table

	include "../lib/dbconn.php";

	if ($mode=="modify") //수정 글쓰기면
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject   = $row[subject];
		$item_content   = $row[content];
		$item_tag       = $row[tag];
		$item_blog      = $row[blog];
		$item_instar    = $row[instar];
		$item_file      = $row[file_name];
		$copied_file    = $row[file_copied];
	};
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
    <link rel="stylesheet" href="../css/scroll_down.css">
    <link rel="stylesheet" href="../css/write_form.css">

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
		function gallery_check_input()
		{
			if (!document.gallery_form.subject.value)
			{
				alert("제목을 입력하세요!");    
				document.gallery_form.subject.focus();
				return;
			}

			if (!document.gallery_form.content.value)
			{
				alert("내용을 입력하세요!");    
				document.gallery_form.content.focus();
				return;
			}

            if (!document.gallery_form.tag.value)
			{
				alert("내용을 입력하세요!");    
				document.gallery_form.tag.focus();
				return;
			}
			document.gallery_form.submit();
		}
	</script>
</head>
<body>
	<div id="skipNav">
        <a href="#contents">본문바로가기</a>
        <a href="#gnb">네비게이션바로가기</a>
    </div>
    <div id="wrap">
        <div class="visualBox">
            <img src="../images/visual_img4.jpg" id="imgBG" alt="비쥬얼이미지">
        </div>
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
                    <li><h3><a href="../sub4.html">gallery</a></h3></li>
                </ul>
            </nav>
        </header>
        <article id="contents">
			<h2 class="hidden">유저이미지업로드페이지</h2>
            <section class="write">
                <h3>User Write Area</h3>
                <div class="write_form">
					<?
						if($mode=="modify")
						{
					?>
							<form id="gallery_form" name="gallery_form" method="post" action="gallery_insert.php?mode=modify&num=<?=$num?>&table=<?=$table?>" enctype="multipart/form-data"> 
					<?
						}
						else
						{
					?>
							<form id="gallery_form" name="gallery_form" method="post" action="gallery_insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
					<?
						}
					?>
						<div class="write_row row1">
							<div id="write_row">
								반갑습니다. <span><b><?=$usernick?></b></span> 님 이미지와 글을 남겨주세요 :)
							</div>
						</div>
						<div class="write_row row2">
							<label class="hidden" for="subject">제목</label>
							<input type="text" id="subject" name="subject" placeholder="제목을 입력해주세요" value="<?=$item_subject?>" >
						</div>
						<div class="write_row row3">
							<label for="content" class="hidden">내용</label>
							<textarea rows="6" cols="79" id="content" name="content" placeholder="내용을 입력해주세요" ><?=$item_content?></textarea>
						</div>
						<div class="write_row row4">
							<div class="subject">
								<label class="hidden" for="tag">태그는 띄어쓰기로 구분해주세요.</label>
								<div class="col1">
									<input type="text" id="tag" name="tag" placeholder="태그는 띄어쓰기로 구분해주세요 ex)#강아지 #땅콩" value="<?=$item_tag?>">
								</div>
							</div>
							<div class="instar">
								<label class="hidden" for="instar">인스타그램주소</label>
								<div class="col1">
									<input type="text" id="instar" name="instar" placeholder="인스타그램 아이디가 있으신가요? 공유해주세요!." value="<?=$item_instar?>">
								</div>
							</div>
							<div class="blog">
								<label class="hidden" for="blog">블로그주소</label>
								<div class="col1">
									<input type="text" id="blog" name="blog" placeholder="블로그 아이디가 있으신가요? 공유해주세요!." value="<?=$item_blog?>">
								</div>
							</div>
						</div>
						<div class="row5_wrap">
							<div class="write_row5">
								<div class="col1">이미지파일</div>
								<label for="upfile" class="col2">
									<input type="file" id="upfile" name="upfile">
								</label>
							</div>
						<? 	
							if ($mode=="modify")
							{
						?>
								<label for="del_file" class="delete_ok"><?=$item_file?> 파일이 등록되어 있습니다.
									<input type="checkbox" id="del_file" name="del_file" value="0"> 삭제
								</label>
						<?
							}
							else
							{
						?>
								<div class="empty"></div>
						<?
							}
						?>
						</div>
						<div id="write_button">
							<a href="#" onclick="gallery_check_input()">저장</a>
							<a class="return_list" href="#">목록</a>
						</div>
						<div id="confirm">
							<p>저장되지 않은 데이터를 잃을 수 있습니다. 목록으로 가시겠습니까?</p>
							<div class="confirmBtn_box">
								<a id="yes" href="../sub4.php?table=<?=$table?>">네</a>
								<a id="no" href="#">아니오</a>
							</div>
						</div>
					</form>
				</div>
			</section> <!-- end of col2 -->
		</article> <!-- end of content -->
	</div> <!-- end of wrap -->
	<!-- JQuery -->
    <script src="../js/sub4_set.js"></script>
    <script src="../js/index_scroll.js"></script>
	<script>
		$(document).ready(function() {
 			var screenHeight=$(window).height();
			$('#contents').css({marginTop:$('#headerArea').height()});
			$("#no").click(function(e){
				e.preventDefault();
				$('#confirmBg').height(0);
				$('#confirm').hide();
				document.gallery_form.content.focus();
			});

			$("#write_button .return_list").click(function(e) {    // id입력 상자에 id값 입력시
				e.preventDefault();
				$('#confirmBg').height(screenHeight);
				$('#confirm').show();
			});
		});
	</script>
</body>
</html>