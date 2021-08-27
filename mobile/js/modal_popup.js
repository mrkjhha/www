$(document).ready(function(){
    d_modalfunc();
});
    
function d_modalfunc(){
    $('.con_wrap .d_more').click(
        function(e){
            e.preventDefault();
            $('.show_box').show();
    });
    
    $('.work_detail .modal_close').click(
        function(e){
            e.preventDefault();
            $('.show_box').hide();
    });
};