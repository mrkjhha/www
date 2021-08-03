<? 
	session_start();
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    $table = "products";
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
    <link rel="stylesheet" href="./css/sub6_content2.css">

    <script src="../mainjs/mainpopup.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
    <script src="https://kit.fontawesome.com/cd5818eb23.js" crossorigin="anonymous"></script>
    <script>
        function search_submit(){

            document.products_form.submit();
        }
    </script>
</head>
<body>
    <?
        include "../lib/dbconn.php";
        
        $main_category_set=[$main_category_1,$main_category_2,$main_category_3,$main_category_4];
        $sub_category_set=[$sub_category_1,$sub_category_2,$sub_category_3,$sub_category_4,$sub_category_5,$sub_category_6,$sub_category_7,$sub_category_8,$sub_category_9,$sub_category_10,$sub_category_11,$sub_category_12,$sub_category_13,$sub_category_14,$sub_category_15];
    
        if (!$scale)
            $scale=4;// 한 화면에 표시되는 글 수

        if ($mode=="search")
        {
            for($i=0;$i<4;$i++){ if($main_category_set[$i]!=null){ $main_cnt++; };};
            for($i=0;$i<15;$i++){ if($sub_category_set[$i]!=null){ $sub_cnt++; };};
            if($min_size_x!=null){ $x_cnt++; };
            if($max_size_x!=null){ $x_cnt++; };
            if($min_size_y!=null){ $y_cnt++; };
            if($max_size_y!=null){ $y_cnt++; };
            // echo("
            // <script>
            // window.alert('$y_cnt');
            // </script>
            // ");
            //시작
            $sql = "select * from $table where ";

            if(!$search){
                if($x_cnt==0){
                    if($y_cnt==0){
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                echo("
                                    <script>
                                    window.alert('검색 체크항목 및 검색어를 입력해 주세요!');
                                    history.go(-1);
                                    </script>
                                    </body>
                                    </html>
                                ");
                                exit;
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $sql.=" order by num desc";
                        };
                    } else {
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/y_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/y_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/y_category.php";
                            $sql.=" order by num desc";
                        };
                    };
                } else {
                    if($y_cnt==0){
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/x_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/x_category.php";
                            $sql.=" order by num desc";
                        };
                    } else {
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/y_category.php";
                            $init2=0; include "./func_php/x_category.php";
                            $sql.=" order by num desc";
                        };
                    };
                };
            } else {
                if($x_cnt==0){
                    if($y_cnt==0){
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=1; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/search_category.php";
                            $sql.=" order by num desc";
                        };
                    } else {
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/y_category.php";
                            $init2=0; include "./func_php/search_category.php";
                            $sql.=" order by num desc";
                        };
                    };
                } else {
                    if($y_cnt==0){
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/x_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/x_category.php";
                            $init2=0; include "./func_php/search_category.php";
                            $sql.=" order by num desc";
                        };
                    } else {
                        if($sub_cnt==0){
                            if($main_cnt==0){
                                $init2=2; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            } else {
                                $init2=0; include "./func_php/main_category.php";
                                $init2=0; include "./func_php/y_category.php";
                                $init2=0; include "./func_php/x_category.php";
                                $init2=0; include "./func_php/search_category.php";
                                $sql.=" order by num desc";
                            };
                        } else {
                            $init2=0; include "./func_php/main_category.php";
                            $init2=0; include "./func_php/sub_category.php";
                            $init2=0; include "./func_php/y_category.php";
                            $init2=0; include "./func_php/x_category.php";
                            $init2=0; include "./func_php/search_category.php";
                            $sql.=" order by num desc";
                        };
                    };
                };
            };
        } else {
            $sql = "select * from $table order by num desc";
        };

        $result = mysql_query($sql, $connect);

        $total_record = mysql_num_rows($result); // 전체 글 수

        // 전체 페이지 수($total_page) 계산 
        if ($total_record % $scale == 0)     
            $total_page = floor($total_record/$scale);      
        else
            $total_page = floor($total_record/$scale) + 1; 
    
        if (!$page)  // 페이지번호($page)가 0 일 때
            $page=1; // 페이지 번호를 1로 초기화

        // 표시할 페이지($page)에 따라 $start 계산
        $start = ($page - 1) * $scale;
        $number = $total_record - $start;
    ?>
    <div class="wrap">
        <div class="modal_bg"></div>
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
                <li class="current"><a href="sub6_2.php">제품검색</a></li>
                <li><a href="sub6_3.html">FAQ</a></li>
            </ul>
        </div>
        <article id="contents">
            <div class="title_area">
                <div class="line_map">
                    home &gt; 고객센터 &gt; <span>제품검색</span>
                </div>
                <h2>제품검색</h2>
            </div>
            <div class="content_area">
                <div class="con_inner">
                    <div class="total_searchbox">
                        <a href="#"><h3>검색필터</h3><span>더 상세한 검색을 원하시면 클릭하세요 . Click!</span></a>
                        <form id="search_area" name="products_form" method="post" action="sub6_2.php?table=<?=$table?>&mode=search"> 
                            <div class="category_top">
                                <dl class="main_categoryBox">
                                    <dt>메인카테고리</dt>
                                    <dd class="main_cate_selec">
                                        <input type="checkbox" id="main_category_1" name="main_category_1" value="인쇄포장">
                                        <label for="main_category_1">인쇄포장</label>
                                    </dd>
                                    <dd class="main_cate_selec">
                                        <input type="checkbox" id="main_category_2" name="main_category_2" value="전기전자">
                                        <label for="main_category_2">전기전자</label>
                                    </dd>
                                    <dd class="main_cate_selec">
                                        <input type="checkbox" id="main_category_3" name="main_category_3" value="산업소재">
                                        <label for="main_category_3">산업소재</label>
                                    </dd>
                                    <dd class="main_cate_selec">
                                        <input type="checkbox" id="main_category_4" name="main_category_4" value="판지소재">
                                        <label for="main_category_4">판지소재</label>
                                    </dd>
                                </dl>
                                <dl class="sub_categoryBox">
                                    <dt>서브카테고리</dt>
                                    <dd>
                                        <ul>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_1" name="sub_category_1" value="식품용">
                                                <label for="sub_category_1">식품용</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_2" name="sub_category_2" value="약품용">
                                                <label for="sub_category_2">약품용</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_3" name="sub_category_3" value="파우치류">
                                                <label for="sub_category_3">파우치류</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_4" name="sub_category_4" value="용기류">
                                                <label for="sub_category_4">용기류</label>
                                            </li>
                                        </ul>
                                    </dd>
                                    <dd>
                                        <ul>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_5" name="sub_category_5" value="전선류">
                                                <label for="sub_category_5">전선류</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_6" name="sub_category_6" value="가전자동차">
                                                <label for="sub_category_6">가전자동차</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_7" name="sub_category_7" value="전자부품">
                                                <label for="sub_category_7">전자부품</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_8" name="sub_category_8" value="2차전지">
                                                <label for="sub_category_8">2차전지</label>
                                            </li>
                                        </ul>
                                    </dd>
                                    <dd>
                                        <ul>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_9" name="sub_category_9" value="건축자재">
                                                <label for="sub_category_9">건축자재</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_10" name="sub_category_10" value="산업용포장재">
                                                <label for="sub_category_10">산업용포장재</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_11" name="sub_category_11" value="이형필름">
                                                <label for="sub_category_11">이형필름</label>
                                            </li>
                                        </ul>
                                    </dd>
                                    <dd>
                                        <ul>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_12" name="sub_category_12" value="A형상자">
                                                <label for="sub_category_12">A형상자</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_13" name="sub_category_13" value="변형상자">
                                                <label for="sub_category_13">변형상자</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_14" name="sub_category_14" value="OFF-set상자">
                                                <label for="sub_category_14">OFF-set상자</label>
                                            </li>
                                            <li class="sub_cate_selec">
                                                <input type="checkbox" id="sub_category_15" name="sub_category_15" value="Pre-printing">
                                                <label for="sub_category_15">Pre-printing</label>
                                            </li>
                                        </ul>
                                    </dd>
                                    <dd class="subcat_default">메인카테고리를 선택해주세요.</dd>
                                </dl>
                                <dl class="size_selectBox">
                                    <dt>제품사이즈</dt>
                                    <dd class="size_x">
                                        <dl>
                                            <dt>X&#40;cm&#41;</dt>
                                            <dd class="min_size_x min_box">
                                                <label for="min_size_x" class="hidden">최소</label>
                                                <input type="text" id="min_size_x" placeholder="최소값" name="min_size_x">
                                            </dd>
                                            <dd class="slide_bar">
                                                <span class="min"></span>
                                                <span class="bar"></span>
                                                <span class="bar_back"></span>
                                                <span class="max"></span>
                                            </dd>
                                            <dd class="max_size_x max_box">
                                                <label for="max_size_x" class="hidden">최대</label>
                                                <input type="text" id="max_size_x" placeholder="최대값" name="max_size_x">
                                            </dd>
                                        </dl>
                                    </dd>
                                    <dd class="size_y">
                                        <dl>
                                            <dt>Y&#40;cm&#41;</dt>
                                            <dd class="min_size_y min_box">
                                                <label for="min_size_y" class="hidden">최소</label>
                                                <input type="text" id="min_size_y" placeholder="최소값" name="min_size_y">
                                            </dd>
                                            <dd class="slide_bar">
                                                <span class="min"></span>
                                                <span class="bar"></span>
                                                <span class="bar_back"></span>
                                                <span class="max"></span>
                                            </dd>
                                            <dd class="max_size_y max_box">
                                                <label for="max_size_y" class="hidden">최대</label>
                                                <input type="text" id="max_size_y" placeholder="최대값" name="max_size_y">
                                            </dd>
                                        </dl>
                                    </dd>
                                </dl>
                            </div>
                            <div class="category_bottom">
                                <div class="search_box"><label class="hidden" for="search">검색단어</label><input type="text" id="search" name="search"></div>
                                <div class="search_btn"><a href="#" onclick="search_submit()">검색</a></div>
                            </div>
                        </form>
                    </div>
                    <div class="top_box">
                        <div class="scale_wrap">
                            <label class="hidden" for="scale">보기선택값</label>
                            <?
                                if($mode=="search"){
                                    echo "<select name='scale' id='scale' class='scale2'>"; 
                                }else{  
                                    echo "<select name='scale' id='scale' class='scale1'>";
                                }
                            ?>
                                <option value=''><?=$scale?>개씩</option>
                                <option value='4'>4개씩</option>
                                <option value='8'>8개씩</option>
                                <option value='16'>16개씩</option>
                                <option value='32'>32개씩</option>
                            </select>
                        </div>
                    </div>
                    <div class="list_top"></div>
                    <ul class="list_con_wrap">
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
                                $item_level   = $row[level];
                                $item_date    = $row[regist_day];
                                $item_date = substr($item_date, 0, 10);
                                $item_product_name = str_replace(" ", "&nbsp;", $row[product_name]);
                                
                                $item_category = $row[category];
                                $item_subcategory = $row[sub_category];
            
                                $item_content = $row[content];
                                $item_content = str_replace(" ", "&nbsp;", $item_content);
		                        $item_content = str_replace("\n", "<br>", $item_content);
                                $image_name   = $row[file_name];
                                $image_copied = $row[file_copied];

                                if ($image_copied) //업로드한 파일이 존재하면
                                {
                                    $imageinfo = GetImageSize("./data/".$image_copied);
                                    //GetImageSize(서버에 업로드된 파일 경로 파일명)
                                    // => 파일의 너비와 높이값, 종류
                                    $image_width = $imageinfo[0];  //파일너비
                                    $image_height = $imageinfo[1]; //파일높이
                                    $image_type  = $imageinfo[2];  //파일종류

                                    if ($image_width > 785)
                                            $image_width = 785;

                                } else {
                                    $image_width[$i] = "";
                                    $image_height[$i] = "";
                                    $image_type[$i]  = "";
                                }
                        ?>
                                <li>
                                    <span class="hidden prod_num"><?=$item_num?></span>
                                    <span class="hidden prod_lev"><?=$item_level?></span>
                                    <a class="modal_list" href="#">
                                        <?
                                        if ($image_copied){
                                            $img_name = $image_copied;
                                            $img_name = "./data/".$img_name; 
                                            // ./data/2019_03_22_10_07_15_0.jpg
                                            $img_width = $image_width;
                                            echo "<img src='$img_name' alt='제품이미지'>";
                                        } else {
                                            echo "<img src=./data/default.jpg alt='디폴트이미지'>";
                                        }
                                        ?>
                                        <dl class="list_item">
                                            <dt class="list_item1"><?= $item_product_name ?></dt>
                                            <dd class="list_item2">
                                                <span><?= $item_category ?></span>
                                                <span><?= $item_subcategory ?></span>
                                            </dd>
                                            <dd class="list_item3">
                                                <span><?= $item_content ?></span>
                                            </dd>
                                        </dl>
                                    </a>
                                    <a href="#" class="exit"></a>
                                    <? 
                                        if($userid==$item_id || $userid=="admin" || $userlevel==1 ) {
                                    ?>
                                        <div class="admin_btn">
                                            <a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$item_num?>&page=<?=$page?>">수정</a>
                                            <a class="delete_list" href="delete_form.php?table=<?=$table?>&num=<?=$item_num?>">삭제</a>
                                        </div>
                                    <?
                                        }
                                    ?>
                                </li>
                        <?
                                $number--;
                            }
                        ?>
                    </ul>
			        <div class="page_button">
				        <div id="page_num">
                            <?
                                $before_p=$page-1;
                                if($before_p<1){$before_p=1;}
                                if($mode=="search"){
                                    echo "<a class='before' href='sub6_2.php?page=$before_p&scale=$scale&mode=search&search=$search&main_category_1=$main_category_1&main_category_2=$main_category_2&main_category_3=$main_category_3&main_category_4=$main_category_4&sub_category_1=$sub_category_1&sub_category_2=$sub_category_2&sub_category_3=$sub_category_3&sub_category_4=$sub_category_4&sub_category_5=$sub_category_5&sub_category_6=$sub_category_6&sub_category_7=$sub_category_7&sub_category_8=$sub_category_8&sub_category_9=$sub_category_9&sub_category_10=$sub_category_10&sub_category_11=$sub_category_11&sub_category_12=$sub_category_12&sub_category_13=$sub_category_13&sub_category_14=$sub_category_14&sub_category_15=$sub_category_15&min_size_x=$min_size_x&max_size_x=$max_size_x&min_size_y=$min_size_y&max_size_y=$max_size_y'> 이전 </a>"; 
                                }else{  
                                    echo "<a class='before' href='sub6_2.php?page=$before_p&scale=$scale'> 이전 </a>";
                                }
                            ?>
                            <!-- <a class="before" href="#">이전</a> -->
                            <span>...</span>
                            <div>
                                <?
                                for ($i=1; $i<=$total_page; $i++) {
                                    if($mode=="search"){
                                        echo "<a href='sub6_2.php?page=$i&scale=$scale&mode=search&search=$search&main_category_1=$main_category_1&main_category_2=$main_category_2&main_category_3=$main_category_3&main_category_4=$main_category_4&sub_category_1=$sub_category_1&sub_category_2=$sub_category_2&sub_category_3=$sub_category_3&sub_category_4=$sub_category_4&sub_category_5=$sub_category_5&sub_category_6=$sub_category_6&sub_category_7=$sub_category_7&sub_category_8=$sub_category_8&sub_category_9=$sub_category_9&sub_category_10=$sub_category_10&sub_category_11=$sub_category_11&sub_category_12=$sub_category_12&sub_category_13=$sub_category_13&sub_category_14=$sub_category_14&sub_category_15=$sub_category_15&min_size_x=$min_size_x&max_size_x=$max_size_x&min_size_y=$min_size_y&max_size_y=$max_size_y'> $i </a>"; 
                                    }else{
                                        echo "<a href='sub6_2.php?page=$i&scale=$scale'> $i </a>";
                                    };
                                };
                                ?>
                            </div>
                            <span>...</span>
                            <?
                                $next_p=$page+1;
                                if($next_p>$total_page){$next_p=$total_page;};
                                if($mode=="search"){
                                    echo "<a class='next' href='sub6_2.php?page=$next_p&next_click=1&scale=$scale&mode=search&search=$search&main_category_1=$main_category_1&main_category_2=$main_category_2&main_category_3=$main_category_3&main_category_4=$main_category_4&sub_category_1=$sub_category_1&sub_category_2=$sub_category_2&sub_category_3=$sub_category_3&sub_category_4=$sub_category_4&sub_category_5=$sub_category_5&sub_category_6=$sub_category_6&sub_category_7=$sub_category_7&sub_category_8=$sub_category_8&sub_category_9=$sub_category_9&sub_category_10=$sub_category_10&sub_category_11=$sub_category_11&sub_category_12=$sub_category_12&sub_category_13=$sub_category_13&sub_category_14=$sub_category_14&sub_category_15=$sub_category_15&min_size_x=$min_size_x&max_size_x=$max_size_x&min_size_y=$min_size_y&max_size_y=$max_size_y'> 다음 </a>"; 
                                }else{  
                                    echo "<a class='next' href='sub6_2.php?page=$next_p&next_click=1&scale=$scale'> 다음 </a>";
                                };
                            ?>
                            <!-- <a class="next" href="#">다음</a> -->
						</div>
						<div id="button">
                            <a href="sub6_2.php?table=<?=$table?>&page=<?=$page?>">목록</a>
                            <? 
                                if($userid)
                                {
                            ?>
                                    <a href="write_form.php?table=<?=$table?>">글쓰기</a>
                            <?
                                };
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
    <script src="./common/js/sub6_scroll.js"></script>
    <script src="./js/content_2/category_set.js"></script>
    <script src="./js/content_2/modal.js"></script>
    <script src="./js/content_2/size_slide.js"></script>
    <script>
        $(document).ready(function() {
            var total_pagenation=<?=$total_page?>;
            var current_page=<?=$page?>;
            var show_set=Math.floor((current_page-1)/5);

            $('#page_num>div a').hide();
            $('#page_num>div a:eq('+(current_page-1)+')').addClass('page_current').attr('href','#java');
            if(show_set==0){
                $('#page_num>span:eq(0)').hide();
            } else if (show_set==Math.floor((total_pagenation-1)/5)){
                $('#page_num>span:eq(1)').hide();
            };
            for(var i=0; i<5; i++){
                $('#page_num>div a:eq('+(show_set*5+i)+')').show();
            };

            $('.scale1').on('change',function(){
                location.href='sub6_2.php?scale='+$(this).val();
            });

            $('.scale2').on('change',function(){
                location.href='sub6_2.php?scale='+$(this).val()+'&mode=search&search=<?=$search?>&main_category_1=<?=$main_category_1?>&main_category_2=<?=$main_category_2?>&main_category_3=<?=$main_category_3?>&main_category_4=<?=$main_category_4?>&sub_category_1=<?=$sub_category_1?>&sub_category_2=<?=$sub_category_2?>&sub_category_3=<?=$sub_category_3?>&sub_category_4=<?=$sub_category_4?>&sub_category_5=<?=$sub_category_5?>&sub_category_6=<?=$sub_category_6?>&sub_category_7=<?=$sub_category_7?>&sub_category_8=<?=$sub_category_8?>&sub_category_9=<?=$sub_category_9?>&sub_category_10=<?=$sub_category_10?>&sub_category_11=<?=$sub_category_11?>&sub_category_12=<?=$sub_category_12?>&sub_category_13=<?=$sub_category_13?>&sub_category_14=<?=$sub_category_14?>&sub_category_15=<?=$sub_category_15?>&min_size_x=<?=$min_size_x?>&max_size_x=<?=$max_size_x?>&min_size_y=<?=$min_size_y?>&max_size_y=<?=$max_size_y?>';
            });
        });
    </script>
</body>
</html>