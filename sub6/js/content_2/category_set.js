$(document).ready(function() {
    var check_on=[0,0,0,0];
    var check_checked=0;
    var search_open=0;
    $(document).ready(function() {
        $('.total_searchbox>a').click(function(e){
            e.preventDefault();
            if(search_open==0){
                search_open=1;
                $('.total_searchbox form#search_area').css({height:'auto', padding:'30px 0 40px 0'});
            } else {
                search_open=0;
                $('.total_searchbox form#search_area').css({height:'0', padding:'0'});
            };
        })

        $('.main_cate_selec input').change(function(){
            var main_selc_ind=$(this).index('.main_cate_selec input');

            if(check_on[main_selc_ind]==0){
                check_on[main_selc_ind]=1;
                $(this).addClass('on');
                $('.sub_categoryBox dd:eq('+main_selc_ind+')').show();
                $('.sub_categoryBox dd:eq('+main_selc_ind+') input').attr('checked',true);
            } else if(check_on[main_selc_ind]==1){
                check_on[main_selc_ind]=0;
                $(this).removeClass('on');
                $('.sub_categoryBox dd:eq('+main_selc_ind+')').hide();
                $('.sub_categoryBox dd:eq('+main_selc_ind+') input').attr('checked',false);
            };

            for(var i=0; i<4;i++){
                if(check_on[i]==0){
                    check_checked++
                };
            };
            if(check_checked==4){
                $('.subcat_default').show();
            } else {
                $('.subcat_default').hide();
            }
        });

        $('.list_con_wrap').addClass('row_layout');
    });    
});