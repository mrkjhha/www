$(document).ready(function(){
    var nextcount=0;
    var backcount=3;
    var main=1;
    var sub1=0;
    var sub2=2;
    $('.video_box li:eq(1)').addClass('main_video');
    $('.video_box li:eq(0)').addClass('sub_video1');
    $('.video_box li:eq(2)').addClass('sub_video2');
    //video function start
    $.videofunc=function(){
        $('.main_video>a').click(
            function(){
                $('.content_area #box').show();
                $('.main_video .video').fadeIn('fast');
                $('.main_video .video iframe').attr('id','player');
        });
        
        $('.content_area #box, .main_video .video a').click(
            function(){            
                $('.content_area #box').hide();
                $('.main_video .video').hide();

                var video = $('#player').attr('src');
                $('#player').attr('src','');
                $('#player').attr('src',video);
                $('.main_video .video iframe').removeAttr('id');
        });
    };
    //video function end
    $.videofunc();
    //swap function start
    $('.video_wrap span a').click(function(event){
        var $target=$(event.target);

        if($target.is('.next')){
            nextcount++;
            if (nextcount>3) {
                nextcount=1;
            };
            backcount=3-nextcount;
            switch(nextcount){
                case 1 : main=0; sub1=2; sub2=1; break;
                case 2 : main=2; sub1=1; sub2=0; break;
                case 3 : main=1; sub1=0; sub2=2; break;
            };
        };

        if($target.is('.before')){
            backcount++;
            if (backcount>3) {
                backcount=1;
            };
            nextcount=3-backcount;
            switch(backcount){
                case 1 : main=2; sub1=1; sub2=0; break;
                case 2 : main=0; sub1=2; sub2=1; break;
                case 3 : main=1; sub1=0; sub2=2; break;
            };
        };
        $('.video_box li:eq(' + main + ')').addClass('main_video');
        $('.video_box li:eq(' + main + ')').removeClass('sub_video1');
        $('.video_box li:eq(' + main + ')').removeClass('sub_video2');
        $('.video_box li:eq(' + sub1 + ')').addClass('sub_video1');
        $('.video_box li:eq(' + sub1 + ')').removeClass('main_video');
        $('.video_box li:eq(' + sub1 + ')').removeClass('sub_video2');
        $('.video_box li:eq(' + sub2 + ')').addClass('sub_video2');
        $('.video_box li:eq(' + sub2 + ')').removeClass('main_video');
        $('.video_box li:eq(' + sub2 + ')').removeClass('sub_video1');
        //swap function End
        $.videofunc();
    });
    $('.content_area a').click(function (e) {e.preventDefault()});
});