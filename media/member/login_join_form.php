<div class="entire_bg">
</div>
<div class="login_join">
    <? 
        if(!$userid){
    ?>
        <a id="login" href="#">login</a>
        <a id="join" href="#">join</a>
    <?
        } else {
    ?>
        <a id="logout" href="./member/logout.php">logout</a>
        <a id="info" href="#">info</a>
        <a id="del" href="#">delete</a>
    <?
        }
    ?>
</div>
<div class="login_form">
    <a href="#" class="close_btn"></a>
    <div class="logo"></div>
    <form name="login_form" method="post" action="./member/login.php">
        <div class="id_box">
            <label for="id">ID</label><input name="id" id="id" type="text">
        </div>
        <div class="pass_box">
            <label for="pass">PW</label><input name="pass" id="pass" type="password">
        </div>
        <div class="login_btn_wrap">
			<div id="login_button" class="login_cancel">
			    <a href="#" onclick="submit()">로그인</a>
		    </div>
			<div id="cancel_button" class="login_cancel">
				<a href="#" onclick="login_reset_form()">취소하기</a>
			</div>
		</div>
    </form>
</div>
<div class="join_form">
    <a href="#" class="close_btn"></a>
    <? include "./member/member_form.php" ?>
</div>
<div class="information_form">
    <a href="#" class="close_btn"></a>
    <? include "./member/modify_form.php" ?>
</div>
<div class="delete_form">
    <a href="#" class="close_btn"></a>
    <? include "./member/delete_form.php" ?>
</div>