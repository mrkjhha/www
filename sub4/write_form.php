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
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
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
    <link rel="stylesheet" href="./css/write_form.css">

    <script src="../mainjs/mainpopup.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
	<script>
		function check_input()
		{
			if (!document.board_form.subject.value)
			{
				alert("제목을 입력하세요!");    
				document.board_form.subject.focus();
				return;
			}

			if (!document.board_form.content.value)
			{
				alert("내용을 입력하세요!");    
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
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
				<h3>뉴스 작성</h3>
				<div class="con_inner">
					<?
						if($mode=="modify")
						{
					?>
							<form id="board_form" name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
					<?
						}
						else
						{
					?>
							<form id="board_form" name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
					<?
						}
					?>
						<div class="write_form">
							<div id="write_row1">
								<div class="col1">별명</div>
								<div class="col2"><?=$usernick?></div>
					<?
						if( $userid && ($mode != "modify") )
						{   //새글쓰기 에서만 HTML 쓰기가 보인다
					?>
								<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
					<?
						}
					?>
							</div>
							<div id="write_row2">
								<label class="col1" for="subject">제목</label>
								<div class="col2">
									<input type="text" id="subject" name="subject" placeholder="제목을 입력하세요" value="<?=$item_subject?>" >
								</div>
							</div>
							<div id="write_row3">
								<label for="content" class="col1 hidden">내용</label>
								<div class="col2">
									<textarea rows="15" cols="79" id="content" name="content"><?=$item_content?></textarea>
								</div>
							</div>
							<div class="row4_wrap">
								<div id="write_row4">
									<div class="col1">이미지파일1</div>
									<label class="col2">
										<input type="file" name="upfile[]">
									</label>
								</div>
					<? 	
						if ($mode=="modify" && $item_file_0)
							{
					?>
								<label class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다.
									<input type="checkbox" name="del_file[]" value="0"> 삭제
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
							<div class="row5_wrap">
								<div id="write_row5">
									<div class="col1"> 이미지파일2 </div>
									<label class="col2">
										<input type="file" name="upfile[]">
									</label>
								</div>
					<? 	
						if ($mode=="modify" && $item_file_1)
							{
					?>
								<label class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. 
									<input type="checkbox" name="del_file[]" value="1"> 삭제
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
							<div class="row6_wrap">
								<div id="write_row6">
									<div class="col1"> 이미지파일3  </div>
									<label class="col2">
										<input type="file" name="upfile[]">
									</label>
								</div>
					<? 	
						if ($mode=="modify" && $item_file_2)
							{
					?>
								<label class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. 
									<input type="checkbox" name="del_file[]" value="2"> 삭제
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
						</div>
						<div id="write_button">
							<a href="#" onclick="check_input()">저장</a>
							<a class="return_list" href="#">목록</a>
						</div>
						
						<div id="confirm">
							<p>저장되지 않은 데이터를 잃을 수 있습니다. 목록으로 가시겠습니까?</p>
							<div class="confirmBtn_box">
								<a id="yes" href="sub4_1.php?table=<?=$table?>&page=<?=$page?>">네</a>
								<a id="no" href="#">아니오</a>
							</div>
						</div>
					</form>
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
				document.board_form.content.focus();
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
