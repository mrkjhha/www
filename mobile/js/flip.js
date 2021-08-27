$(document).ready(function() {

    $('.con_wrap li a').click(function(e){
        e.preventDefault();
        var f_ind = $(this).index('.con_wrap li a');
        console.log(f_ind);
        if($('.con_wrap li a:eq('+f_ind+')').hasClass('show')){
            $('.con_wrap li a:eq('+f_ind+')').removeClass('show'); 
        } else {
            $('.con_wrap li a:eq('+f_ind+')').addClass('show');
        }
    });
});