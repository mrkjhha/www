<? 
session_start();
@extract($_POST);
@extract($_GET);
@extract($_SESSION);
//새글삽입  $table , 폼입력값 , 세션변수
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>데이터입력</title>
<?
	if(!$userid) {
		echo("
		<script>
			window.alert('로그인 후 이용해 주세요.')
			history.go(-1)
	   	</script>
		   </head>
		   </html>
		");
		exit;
	}

	if(!$category || !$sub_category || !$size_x || !$size_y || !$content || !$product_name){
		echo("
		<script>
			window.alert('제품정보를 정확히 입력해주세요.')
			history.go(-1)
	   	</script>
		   </head>
		   </html>
		");
		exit;
	};

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	// 단일 파일 업로드 
	// $upfile_name	 = $_FILES["upfile"]["name"];
	// $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
	// $upfile_type     = $_FILES["upfile"]["type"];
	// $upfile_size     = $_FILES["upfile"]["size"];
	// $upfile_error    = $_FILES["upfile"]["error"];
	
    $_FILES["upfile"]["name"];
    //$_FILES["upfile"]["name"][1];
    //$_FILES["upfile"]["name"][2];

	$upload_dir = './data/';  //업로드될 서버 저장경로

	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
	$upfile_type     = $_FILES["upfile"]["type"];
	$upfile_size     = $_FILES["upfile"]["size"];
	$upfile_error    = $_FILES["upfile"]["error"];
      
	$file = explode(".", $upfile_name); // a1.jpg
	$file_name = $file[0];  //a1
	$file_ext  = $file[1];  //jpg

	if (!$upfile_error) //에러가 발생되지 않으면
	{
		$new_file_name = date("Y_m_d_H_i_s");
	    // 2019_03_22_10_07_15
		$new_file_name = $new_file_name;
        // 2019_03_22_10_07_15_0
		$copied_file_name =    $new_file_name.".".$file_ext;
        // 2019_03_22_10_07_15_0.jpg
		$uploaded_file =    $upload_dir.$copied_file_name;
        // ./data/2019_03_22_10_07_15_0.jpg

		if( $upfile_size  > 500000 ) {
			echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				</head>
				</html>
			");
			exit;
		}

		if ( ($upfile_type != "image/gif") &&
			($upfile_type != "image/jpeg") &&
			($upfile_type != "image/pjpeg") )
		{
			echo("
				<script>
					alert('JPG와 GIF 이미지 파일만 업로드 가능합니다!');
					history.go(-1)
				</script>
				</head>
				</html>
				");
			exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
                
        // move_uploaded_file(임시저장파일명,실제저장할 서버경로 파일명 )    => 파일 업로드
        //파일을 업로드하고 업로그 처리가 안되었을때 메시
		{
			echo("
				<script>
				alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
				history.go(-1)
				</script>
				</head>
				</html>
			");
			exit;
		}
	}

	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	if ($mode=="modify")
	{
		if($del_file!=null || $upfile!=null){
			$num_checked = count($_POST['del_file']);
			$position = $_POST['del_file'];

			$index = $position;
			
			$del_ok = "y";
		};
		$sql = "select * from $table where num=$num";   // get target record
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		// update DB with the value of file input box

		$field_org_name = "file_name";
		$field_real_name = "file_copied";

		$org_name_value = $upfile_name;
		$org_real_value = $copied_file_name;

		if ($del_ok == "y")
		{
			$delete_field = "file_copied";
			$delete_name = $row[$delete_field];

			$delete_path = "./data/".$delete_name;

			unlink($delete_path);
			$sql = "update $table set category = '$category', sub_category = '$sub_category', $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
			mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
		}
		else
		{
			if (!$upfile_error)
			{
				$sql = "update $table set category = '$category', sub_category = '$sub_category', $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
			};
		};
		
		$product_name = htmlspecialchars($product_name);
		$content = htmlspecialchars($content);
		$product_name = str_replace("'", "&#039;", $product_name);
		$content = str_replace("'", "&#039;", $content);
		
		$sql = "update $table set product_name='$product_name', content='$content' where num=$num";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}
	else
	{
		$product_name = htmlspecialchars($product_name);
		$content = htmlspecialchars($content);
		$product_name = str_replace("'", "&#039;", $product_name);
		$content = str_replace("'", "&#039;", $content);

		$sql = "insert into $table (id, name, nick, product_name, content, category, sub_category, size_x, size_y, regist_day, ";
		$sql .= "file_name, file_copied) ";
		$sql .= "values('$userid', '$username', '$usernick', '$product_name', '$content', '$category', '$sub_category', '$size_x', '$size_y', '$regist_day', ";
		$sql .= "'$upfile_name', '$copied_file_name')";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}

	mysql_close(); // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'sub6_2.php?table=$table&page=$page';
	   </script>
	";
?>
</head>
</html>