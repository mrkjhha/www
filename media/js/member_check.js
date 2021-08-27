var all_on=0;
$(document).ready(function(){
    //    회원가입 개인정보 동의
    $('input[name="agree"]').change(function(){
        var checkboxLength=$('input[type="checkbox"]').length;
        var checked_check=$('input[type="checkbox"]:checked').length;

        if(all_on==1){
            all_on=0;
            $('input[name="agree_all"]').attr('checked',false);
            $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
        } else {
            if((checkboxLength-1) == checked_check){
                all_on=1;
                $('input[name="agree_all"]').attr('checked',true);
                $('.allcheck_box').css({background:'rgba(218,41,26,.8)',color:'#fff', border:'1px solid rgba(218,41,26,.8)'});                
            }
        }
    });

    $('.allcheck_box, #check_all').click(function(){
        $('input[type="checkbox"]').attr('checked',false);
        if(all_on==1){
            all_on=0;
            $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
        } else if(all_on==0){
            all_on=1;
            $('input[type="checkbox"]').attr('checked',true);
            $('.allcheck_box').css({background:'rgba(218,41,26,.8)',color:'#fff', border:'1px solid rgba(218,41,26,.8)'});     
        }
    });

    $('.check_agree').on('click',check_agree);

    function check_agree(e){
        var checkboxLength=$('input[name="agree"]').length;
		// 체크박스의 총개수
        var checkedLength=$('input[name="agree"]:checked').length;   //체크가 되어있는 체그박스 개
        // console.log(checkboxLength,$('input[type="checkbox"]:checked').length)

        if(checkboxLength != checkedLength){
            alert("수집하는 개인정보 항목에 동의해야 가입하실 수 있습니다.");
            e.preventDefault();
        }else{
            $('.member_check_form').hide();
            $('.join_form').show();
            join_clk=1; //회원가입 폼 입력 페이지로 이동
            member_check_clk=0;
        };
    }
});

function join_cancel(){
    $('.member_check_form').hide();
    $('.entire_bg').hide();
    $('input[type="checkbox"]').attr('checked',false);
    $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
    all_on=0;
    member_check_clk=0;
};

















