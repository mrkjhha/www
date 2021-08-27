<script>
    var p_name;
    var p_nick;
    var p_hp2;
    var p_hp3;
    var p_email1;
    var p_email2;

    $(document).ready(function() {
        p_name=$('#modify_name').val();
        p_nick=$('#modify_nick').val();
        p_hp2=$('#modify_hp2').val();
        p_hp3=$('#modify_hp3').val();
        p_email1=$('#modify_email1').val();
        p_email2=$('#modify_email2').val();
            
        //nick 중복검사		 
        $("#modify_nick").keyup(function() {    // id입력 상자에 id값 입력시
        var nick = $('#modify_nick').val();

        $.ajax({
                type: "POST",
                url: "./member/check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data)
                {
                    $("#loadtext3").html(data);
                }
            });
        });
    });
</script>
<script>
    function modify_check_input()
    {
        if (!document.modify_form.modify_pass.value)
        {
            alert("비밀번호를 입력하세요");    
            document.modify_form.modify_pass.focus();
            return;
        }

        if (!document.modify_form.modify_pass_confirm.value)
        {
            alert("비밀번호확인을 입력하세요");    
            document.modify_form.modify_pass_confirm.focus();
            return;
        }

        if (!document.modify_form.modify_name.value)
        {
            alert("이름을 입력하세요");    
            document.modify_form.modify_name.focus();
            return;
        }

        if (!document.modify_form.modify_nick.value)
        {
            alert("닉네임을 입력하세요");    
            document.modify_form.modify_nick.focus();
            return;
        }

        if (!document.modify_form.modify_hp2.value || !document.modify_form.modify_hp3.value)
        {
            alert("휴대폰 번호를 입력하세요");    
            document.modify_form.modify_nick.focus();
            return;
        }

        if (document.modify_form.modify_pass.value != 
            document.modify_form.modify_pass_confirm.value)
        {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
            document.modify_form.modify_pass.focus();
            document.modify_form.modify_pass.select();
            return;
        }

        document.modify_form.submit(); 
        // insert.php 로 변수 전송
    }

    function modify_reset_form()
    {   
        $('#loadtext3').html('');
        document.modify_form.modify_pass.value = "";
        document.modify_form.modify_pass_confirm.value = "";
        document.modify_form.modify_name.value = p_name;
        document.modify_form.modify_nick.value = p_nick;
        document.modify_form.modify_hp1.value = "010";
        document.modify_form.modify_hp2.value = p_hp2;
        document.modify_form.modify_hp3.value = p_hp3;
        document.modify_form.modify_email1.value = p_email1;
        document.modify_form.modify_email2.value = p_email2;
        
        document.modify_form.modify_pass.focus();

        return;
    }
</script>
<?
    //$userid='aaa';
    
    include "./lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
    //$row[id]....$row[level]

    $hp = explode("-", $row[hp]);  //000-0000-0000
    $modify_hp1 = $hp[0];
    $modify_hp2 = $hp[1];
    $modify_hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $modify_email1 = $email[0];
    $modify_email2 = $email[1];

    mysql_close();
?>
<form  name="modify_form" method="post" action="./member/modify.php">
    <span>* 은 필수 항목입니다.</span>
    <table>
        <caption class="hidden">정보수정</caption>
        <tr>
            <th scope="col">아이디</th>
            <td>
                <?= $userid ?>
            </td>
        </tr>
        <tr>
            <th scope="col"><label for="modify_pass">비밀번호&nbsp;<span>*</span></label></th>
            <td>
                <input type="password" name="modify_pass" id="modify_pass" value="" required>
            </td>
        </tr>
        <tr>
            <th scope="col"><label for="modify_pass_confirm">비밀번호확인&nbsp;<span>*</span></label></th>
            <td>
                <input type="password" name="modify_pass_confirm" id="modify_pass_confirm" value="" required>
            </td>
        </tr>
        <tr>
            <th scope="col"><label for="modify_name">이름&nbsp;<span>*</span></label></th>
            <td>
                <input type="text" name="modify_name" id="modify_name" value="<?= $row[name] ?>" required>
            </td>
        </tr>
        <tr>
            <th scope="col"><label for="modify_nick">닉네임&nbsp;<span>*</span></label></th>
            <td>
                <input type="text" name="modify_nick" id="modify_nick" value="<?= $row[nick] ?>" required>
                <span id="loadtext3"></span>
            </td>
        </tr>
        <tr>
            <th scope="col">휴대폰&nbsp;<span>*</span></th>
            <td>
                <label class="hidden" for="modify_hp1">전화번호앞3자리</label>
                <select class="hp" name="modify_hp1" id="modify_hp1">
                    <option value='010'>010</option>
                    <option value='011'>011</option>
                    <option value='016'>016</option>
                    <option value='017'>017</option>
                    <option value='018'>018</option>
                    <option value='019'>019</option>
                </select>  - 
                <label class="hidden" for="modify_hp2">전화번호중간4자리</label><input type="text" class="hp" name="modify_hp2" id="modify_hp2" value="<?= $modify_hp2 ?>" required> - 
                <label class="hidden" for="modify_hp3">전화번호끝4자리</label><input type="text" class="hp" name="modify_hp3" id="modify_hp3" value="<?= $modify_hp3 ?>" required>
            </td>
        </tr>
        <tr>
            <th scope="col">이메일&nbsp;<span>*</span></th>
            <td>
                <label class="hidden" for="modify_email1">이메일아이디</label>
                <input type="text" id="modify_email1" name="modify_email1" value="<?= $modify_email1 ?>" required> @ 
                <label class="hidden" for="modify_email2">이메일주소</label>
                <input type="text" id="modify_email2" name="modify_email2" value="<?= $modify_email2 ?>" required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="#" onclick="modify_check_input()">수정완료</a>&nbsp;&nbsp;
                <a href="#" onclick="modify_reset_form()">취소하기</a>
            </td>
        </tr>
    </table>
</form>