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
	
		$item_product_name   = $row[product_name];
		$item_content    = $row[content];
		$item_category    = $row[category];
		$item_sub_category    = $row[sub_category];
		$item_size_x    = $row[size_x];
		$item_size_y    = $row[size_y];
		$item_file = $row[file_name];
		$copied_file = $row[file_copied];
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
    <link rel="stylesheet" href="./common/css/sub6common.css">
    <link rel="stylesheet" href="./css/write_form.css">

    <script src="../mainjs/mainpopup.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
	<script>
		function check_input()
		{
			if (!document.board_form.product_name.value)
			{
				alert("제목을 입력하세요!");    
				document.board_form.product_name.focus();
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
            <img src="./common/images/sub6_visual.jpg" alt="">
        </div>
        <div class="sub_menu">
            <h3>고객센터</h3>
            <p>customer center</p>
            <ul>
                <li><a href="sub6_1.html">온라인문의</a></li>
                <li class="current"><a href="sub6_2.php">제품입력</a></li>
                <li><a href="sub6_3.html">FAQ</a></li>
            </ul>
        </div>
		<article id="contents">
			<div class="title_area">
                <div class="line_map">
                    home &gt; 고객센터 &gt; <span>제품입력</span>
                </div>
                <h2>제품입력</h2>
            </div>
			<div class="content_area">
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
						<div class="write_row row1">
							<div id="write_row">
								반갑습니다. <span><b><?=$usernick?></b></span> 님 제품 정보를 입력해주세요 :)
							</div>
						</div>
						<div class="write_row row2">
							<label class="product_name" for="product_name">제품명</label>
							<input type="text" id="product_name" name="product_name" placeholder="제품명을 입력하세요" value="<?=$item_product_name?>" >
						</div>
						<div class="write_row row3">
							<div class="main_category">	
								<?
									if($mode=="modify"){
								?>
									<a href="#"><?=$item_category?></a>
								<?	
									} else {
								?>
									<a href="#">메인카테고리</a>
								<?
									};
								?>
								<ul>
									<li><a class="main_selec" href="#">인쇄포장</a></li>
									<li><a class="main_selec" href="#">전기전자</a></li>
									<li><a class="main_selec" href="#">산업소재</a></li>
									<li><a class="main_selec" href="#">판지소재</a></li>
								</ul>
								<div class="hideback">
									<label for="category">메인카테고리</label>
									<select name="category" id="category">
										<option value='인쇄포장'>인쇄포장</option>
										<option value='전기전자'>전기전자</option>
										<option value='산업소재'>산업소재</option>
										<option value='판지소재'>판지소재</option>
                                	</select>
								</div>
							</div>
							<div class="sub_category">
								<? 
									if($mode=="modify"){
								?>
										<a href="#"><?=$item_sub_category?></a>
								<?
									} else {
								?>
									<a href="#">서브카테고리</a>
								<?
									};
								?>
								<ul>
									<li><a class="sub_selec" href="#">식품용</a></li>
									<li><a class="sub_selec" href="#">약품용</a></li>
									<li><a class="sub_selec" href="#">파우치류</a></li>
									<li><a class="sub_selec" href="#">용기류</a></li>
								</ul>
								<ul>
									<li><a class="sub_selec" href="#">전선류</a></li>
									<li><a class="sub_selec" href="#">가전자동차</a></li>
									<li><a class="sub_selec" href="#">전자부품</a></li>
									<li><a class="sub_selec" href="#">2차전지</a></li>
								</ul>
								<ul>
									<li><a class="sub_selec" href="#">건축자재</a></li>
									<li><a class="sub_selec" href="#">산업용포장재</a></li>
									<li><a class="sub_selec" href="#">이형필름</a></li>
								</ul>
								<ul>
									<li><a class="sub_selec" href="#">A형상자</a></li>
									<li><a class="sub_selec" href="#">변형상자</a></li>
									<li><a class="sub_selec" href="#">OFF-set상자</a></li>
									<li><a class="sub_selec" href="#">Pre-printing</a></li>
								</ul>
								<div class="hideback">
									<label for="sub_category">서브카테고리</label>
									<select name="sub_category" id="sub_category">
										<option value='식품용'>식품용</option>
										<option value='약품용'>약품용</option>
										<option value='파우치류'>파우치류</option>
										<option value='용기류'>용기류</option>
										<option value='전선류'>전선류</option>
										<option value='가전자동차'>가전자동차</option>
										<option value='전자부품'>전자부품</option>
										<option value='2차전지'>2차전지</option>
										<option value='건축자재'>건축자재</option>
										<option value='산업용포장재'>산업용포장재</option>
										<option value='이형필름'>이형필름</option>
										<option value='A형상자'>A형상자</option>
										<option value='변형상자'>변형상자</option>
										<option value='OFF-set상자'>OFF-set상자</option>
										<option value='Pre-printing'>Pre-printing</option>
                                	</select>
								</div>
							</div>
							<div class="x_value">
								<label for="size_x">가로치수 :</label>
								<div class="col2">
									<input type="text" id="size_x" name="size_x" value="<?=$item_size_x?>">
								</div>
							</div>
							<div class="y_value">
								<label for="size_y">세로치수 :</label>
								<div class="col2">
									<input type="text" id="size_y" name="size_y" value="<?=$item_size_y?>">
								</div>
							</div>
						</div>
						<div class="write_row row4">
							<label for="content" class="hidden">내용</label>
							<textarea rows="6" cols="79" id="content" name="content"><?=$item_content?></textarea>
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
							<a href="#" onclick="check_input()">저장</a>
							<a class="return_list" href="#">목록</a>
						</div>
						<div id="confirm">
							<p>저장되지 않은 데이터를 잃을 수 있습니다. 목록으로 가시겠습니까?</p>
							<div class="confirmBtn_box">
								<a id="yes" href="sub6_2.php?table=<?=$table?>&page=<?=$page?>">네</a>
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
    <script src="./common/js/sub6_scroll.js"></script>
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
	<script>
		$(document).ready(function() {
 			var screenHeight=$(window).height();
			var main_click=0;
			var sub_click=0;
			var main_ind=5;
			var sub_ind;

			if(<?=$mode?>='modify'){
				for(var i=0; i<4; i++){
					if($('#category option:eq('+i+')').val()=='<?=$item_category?>'){
						$('#category option:eq('+i+')').attr('selected',true);
					};
				};

				for(var i=0; i<15; i++){
					if($('#sub_category option:eq('+i+')').val()=='<?=$item_sub_category?>'){
						$('#sub_category option:eq('+i+')').attr('selected',true);
					};
				};
			};
			
			$('.main_category>a').click(function(e){
				e.preventDefault();
				if(main_click==0){
					main_click=1; 
					$('.main_category ul').show(); 
					$('.main_category>a').css({borderRadius:'10px 10px 0 0',border:'1px solid #ccc'});
				} else {
					main_click=0; 
					$('.main_category ul').hide(); 
					$('.main_category>a').css({borderRadius:'10px',border:'1px solid #eee'});
				}
			});

			$('.sub_category>a').click(function(e){
				e.preventDefault();
				if(main_ind==5){
					window.alert('메인카테고리를 선택해주세요.');
				}else {
					if(sub_click==0){
						sub_click=1;
						$('.sub_category ul').hide();
						$('.sub_category ul:eq('+main_ind+')').show(); 
						$('.sub_category>a').css({borderRadius:'10px 10px 0 0',border:'1px solid #ccc'});
					} else {
						sub_click=0;
						$('.sub_category ul:eq('+main_ind+')').hide(); 
						$('.sub_category>a').css({borderRadius:'10px',border:'1px solid #eee'});
					};
				};				
			});

			$(".main_category .main_selec").click(function(e){
				e.preventDefault();
				main_ind=$(this).index('.main_selec');

				$('.sub_category>a').text('서브카테고리');
				$('.main_category ul').hide();
				$('.main_category>a').css({borderRadius:'10px',border:'1px solid #eee'}).text($('.main_category option:eq('+main_ind+')').val());
				$('.main_category>a')
				$('.main_category select').val($('.main_category option:eq('+main_ind+')').val());
				main_click=0;
			});

			$(".sub_category .sub_selec").click(function(e){
				e.preventDefault();
				sub_ind=$(this).index('.sub_selec');

				$('.sub_category ul:eq('+main_ind+')').hide();
				$('.sub_category>a').css({borderRadius:'10px',border:'1px solid #eee'}).text($('.sub_category option:eq('+sub_ind+')').val());
				$('.sub_category>a').text($('.sub_category option:eq('+sub_ind+')').val());
				$('.sub_category select').val($('.sub_category option:eq('+sub_ind+')').val());
				sub_click=0;
			});
		});
	</script>
</body>
</html>
