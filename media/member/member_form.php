<script>
	$(document).ready(function() {
 
        //id 중복검사
        $("#join_id").keyup(function() {    // id입력 상자에 id값 입력시
        var id = $('#join_id').val(); //a

            $.ajax({
                type: "POST",
                url: "./member/check_id.php",
                data: "id="+ id,
                cache: false, 
                success: function(data)
                {
                    //data => echo "문자열" 이 저장된
                    $("#loadtext").html(data);
                }
            });
        });

        //nick 중복검사		 
        $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
            var nick = $('#nick').val();

            $.ajax({
                type: "POST",
                url: "./member/check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data)
                {
                    $("#loadtext2").html(data);
                }
            });
        });
    });
</script>
<script>

function check_input()
{
    if (!document.join_form.join_id.value)
    {
        alert("아이디를 입력하세요");
        document.join_form.join_id.focus();
        return;
    }

    if (!document.join_form.join_pass.value)
    {
        alert("비밀번호를 입력하세요");    
        document.join_form.join_pass.focus();
        return;
    }

    if (!document.join_form.join_pass_confirm.value)
    {
        alert("비밀번호확인을 입력하세요");    
        document.join_form.join_pass_confirm.focus();
        return;
    }

    if (!document.join_form.name.value)
    {
        alert("이름을 입력하세요");    
        document.join_form.name.focus();
        return;
    }

    if (!document.join_form.nick.value)
    {
        alert("닉네임을 입력하세요");    
        document.join_form.nick.focus();
        return;
    }

    if (!document.join_form.hp2.value || !document.join_form.hp3.value )
    {
        alert("휴대폰 번호를 입력하세요");    
        document.join_form.nick.focus();
        return;
    }

    if (document.join_form.join_pass.value != 
        document.join_form.join_pass_confirm.value)
    {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
        document.join_form.join_pass.focus();
        document.join_form.join_pass.select();
        return;
    }

    document.join_form.submit(); 
    // insert.php 로 변수 전송
}

function reset_form()
{   
    $('#loadtext').html('');
    $('#loadtext2').html('');
    document.join_form.join_id.value = "";
    document.join_form.join_pass.value = "";
    document.join_form.join_pass_confirm.value = "";
    document.join_form.name.value = "";
    document.join_form.nick.value = "";
    document.join_form.hp1.value = "010";
    document.join_form.hp2.value = "";
    document.join_form.hp3.value = "";
    document.join_form.email1.value = "";
    document.join_form.email2.value = "";
    
    document.join_form.join_id.focus();

    return;
}
</script>
<div id="member_join_form">
    <form  name="join_form" method="post" action="./member/insert.php">
        <span>* 은 필수 항목입니다.</span>
        <table>
            <caption class="hidden">회원가입</caption>
            <tr>
                <th scope="col"><label for="join_id">아이디&nbsp;<span>*</span></label></th>
                <td>
            <?
                if(!$userid){
            ?>
                <input type="text" name="join_id" id="join_id" required>
                <span id="loadtext"></span>
            <?
                }else{
            ?>            
                <?= $row[id] ?>                
            <?
                }
            ?> 
                </td>
            </tr>
            <tr>
                <th scope="col"><label for="join_pass">비밀번호&nbsp;<span>*</span></label></th>
                <td>
                    <input type="password" name="join_pass" id="join_pass" required>
                </td>
            </tr>
            <tr>
                <th scope="col"><label for="join_pass_confirm">비밀번호확인&nbsp;<span>*</span></label></th>
                <td>
                    <input type="password" name="join_pass_confirm" id="join_pass_confirm"  required>
                </td>
            </tr>
            <tr>
                <th scope="col"><label for="name">이름&nbsp;<span>*</span></label></th>
                <td>
                    <input type="text" name="name" id="name"  required> 
                </td>
            </tr>
            <tr>
                <th scope="col"><label for="nick">닉네임&nbsp;<span>*</span></label></th>
                <td>
                    <input type="text" name="nick" id="nick"  required>
                    <span id="loadtext2"></span>
                </td>
                </tr>
            <tr>
                <th scope="col">휴대폰&nbsp;<span>*</span></th>
                <td>
                    <label class="hidden" for="hp1">전화번호앞3자리</label>
                    <select class="hp" name="hp1" id="hp1"> 
                        <option value='010'>010</option>
                        <option value='011'>011</option>
                        <option value='016'>016</option>
                        <option value='017'>017</option>
                        <option value='018'>018</option>
                        <option value='019'>019</option>
                    </select>  - 
                    <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2"  required> - 
                    <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3"  required>
                </td>
            </tr>
            <tr>
                <th scope="col">이메일&nbsp;<span>*</span></th>
                <td>
                    <label class="hidden" for="email1">이메일아이디</label>
                    <input type="text" id="email1" name="email1"  required> @ 
                    <label class="hidden" for="email2">이메일주소</label>
                    <input type="text" name="email2" id="email2"  required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="#" onclick="check_input()">가입하기</a>
                    <a href="#" onclick="reset_form()">취소하기</a>
                </td>
            </tr>
        </table>
    </form>
</div>