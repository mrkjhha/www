var join_clk=0;
var login_clk=0;
var member_check=0;
var info_clk=0;
var delete_clk=0;
var screen_width;
var screen_width_p;
    
$(document).ready(function(){
        
    screen_width=$(window).width();
    screen_width_p=screen_width;

    login_join_height_set();

    $('#login').click(function(){
        login_clk=1;    
        $('.entire_bg').show();
        $('.login_form').show();
    });

    $('#join').click(function(){
        member_check=1;
        $('.entire_bg').show();
        $('.member_check_form').show();
    });

    $('#info').click(function(){
        info_clk=1;
        $('.entire_bg').show();
        $('.information_form').show();
    });

    $('#del').click(function(){
        delete_clk=1;
        $('.entire_bg').show();
        $('.delete_form').show();
    });

    $('.close_btn').click(function(){
        $('.entire_bg').hide();
        if(join_clk==1){ join_clk=0;
            $('.join_form').hide();
        } else if(login_clk==1) { login_clk=0;
            $('.login_form').hide();
            $('input[type="checkbox"]').attr('checked',false);
            $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
            all_on=0;
        } else if(member_check==1){ member_check=0;
            $('.member_check_form').hide();
            $('input[type="checkbox"]').attr('checked',false);
            $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
            all_on=0;
        } else if(info_clk==1){ info_clk=0;
            $('.information_form').hide();
            $('input[type="checkbox"]').attr('checked',false);
            $('.allcheck_box').css({background:'rgba(218,41,26,0)',color:'#666', border:'1px solid #666'});
            all_on=0;
        } else if(delete_clk==1){ delete_clk=0;
            $('.delete_form').hide();
        }
    });

    $(window).resize(function () {
        screen_width=$(window).width();
        if(screen_width!=screen_width_p){
            login_join_height_set();
            screen_width_p=screen_width;
        };            
    });
});

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.member_check_form').height($(window).height()*0.7);
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};