$(document).ready(function() {
    var modal_check=0;
    $('.list_con_wrap li .modal_list').click(function(e){
        e.preventDefault();
        var modal_ind=$(this).index('.modal_list');
        if(modal_check==0){
            modal_check=1;
            $('.list_con_wrap li:eq('+modal_ind+')').addClass('modal_open');
            $('.admin_btn:eq('+modal_ind+')').addClass('adminmod_open');
            $('.modal_bg').height($(window).height());
            $('.exit').show();
        };
    });

    $('.modal_bg, .exit').click(function(e){
        e.preventDefault();
        modal_check=0;
        $('.list_con_wrap li').removeClass('modal_open');
        $('.admin_btn').removeClass('adminmod_open');
        $('.modal_bg').height(0);
        $('.exit').hide();
    });
});