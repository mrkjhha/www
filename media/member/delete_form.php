<script>
    function delete_submit()
	{
		document.delete_form.submit(); 
		// login.php 로 변수 전송
	};
    
    function delete_check_input()
    {
        if (!document.delete_form.delete_pass.value)
        {
            alert("비밀번호를 입력하세요");    
            document.delete_form.delete_pass.focus();
            return;
        } else {
            $('.confirm').show();
        }
        // insert.php 로 변수 전송
    };

    function delete_reset_form()
    {   
        $('.confirm').hide();
        document.delete_form.delete_pass.value = "";
         
        document.delete_form.delete_pass.focus();
        return;
    };
</script>
<div class="delete_inner">
    <p class="delete_title">회원탈퇴</p>
    <form name="delete_form" method="post" action="./member/delete.php">
        <span class="inform">정보확인을 위해 비밀번호를 다시 한 번 입력해주세요.</span>
        <div class="id_box">
            <div class="id_name">ID</div><div id="delete_id"><?=$userid?></div>
        </div>
        <div class="pass_box">
            <label for="delete_pass">PW</label><input name="delete_pass" id="delete_pass" type="password">
        </div>
    </form>
    <div class="login_btn_wrap">
        <div id="delete_button" class="login_cancel">
            <a href="#" onclick="delete_check_input()">회원탈퇴</a>
            <!-- <button type="submit">로그인</button> -->
        </div>
        <div id="delete_cancel_button" class="login_cancel">
            <a href="#" onclick="delete_reset_form()">취소하기</a>
        </div>
    </div>
    <div class="confirm">
        <span class="inform">지워진 정보는 복구 할 수 없습니다.<br>그래도 계속 진행하시겠습니까?</span>
        <div id="delete_recheck_button" class="login_cancel">
            <a href="#" onclick="delete_submit()">네</a>
        </div>
        <div id="delete_recancel_button" class="login_cancel">
            <a href="#" onclick="delete_reset_form()">아니오</a>
        </div>
    </div>
</div>