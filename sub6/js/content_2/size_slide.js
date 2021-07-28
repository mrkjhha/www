var min_clk=0, max_clk=0;
var startX, moveX, endX, maxX, minX;
var move_p;
var max_set=[0,0];
var min_set=[0,0];
var max_set_p=[0,0];
var min_set_p=[0,0];
var clk_ind;
$(document).ready(function(){
    

    $('.size_selectBox .slide_bar span').on('mousedown',function(e){
        
        e.preventDefault();
        var $target=$(e.target);
        startX=e.clientX || e.originalEvent.clientX;
        
        if($target.is('.min')){
            min_clk=1; max_clk=0;
            clk_ind=$(this).index('.min');

        } else if($target.is('.max')){
            max_clk=1; min_clk=0;
            clk_ind=$(this).index('.max');
        };
    });

    $('.size_selectBox .slide_bar').on('mousemove',function(e){
            e.preventDefault();
            moveX=e.clientX || e.originalEvent.clientX;
            
            if(min_clk==1){
                move_p=min_set[clk_ind]+moveX-startX;

                if(move_p<0){
                    move_p=0;
                } else if(move_p>(265-max_set[clk_ind])){
                    move_p=265-max_set[clk_ind];
                };

                $('.min:eq('+clk_ind+')').css({left:move_p});
                $('.bar:eq('+clk_ind+')').css({marginLeft:move_p});
                $('.min_box:eq('+clk_ind+') input').val(Math.round(move_p/290*1000));
    
            } else if(max_clk==1){
                move_p=max_set[clk_ind]+startX-moveX;

                if(move_p<0){
                    move_p=0;
                } else if(move_p>(265-min_set[clk_ind])){
                    move_p=265-min_set[clk_ind];
                };

                $('.max:eq('+clk_ind+')').css({right:move_p});
                $('.bar:eq('+clk_ind+')').css({marginRight:move_p});
                $('.max_box:eq('+clk_ind+') input').val(Math.round((290-move_p)/290*1000));
            };
    });

    $('.size_selectBox').on('mouseup',function(e){
        e.preventDefault();
        endX=e.clientX || e.originalEvent.clientX;
        
        if(min_clk==1){
            min_set[clk_ind]=min_set[clk_ind]+endX-startX;

            if(min_set[clk_ind]<0){
                min_set[clk_ind]=0;
            } else if(min_set[clk_ind]>(265-max_set[clk_ind])){
                min_set[clk_ind]=265-max_set[clk_ind];
            };

            $('.min:eq('+clk_ind+')').css({left:min_set[clk_ind]});
            $('.bar:eq('+clk_ind+')').css({marginLeft:min_set[clk_ind]});
            $('.min_box:eq('+clk_ind+') input').val(Math.round(min_set[clk_ind]/290*1000));
            
            min_clk=0;

        } else if(max_clk==1){
            max_set[clk_ind]=max_set[clk_ind]+startX-endX;

            if(max_set[clk_ind]<0){
                max_set[clk_ind]=0;
            } else if(max_set[clk_ind]>(265-min_set[clk_ind])){
                max_set[clk_ind]=265-min_set[clk_ind];
            };

            $('.max:eq('+clk_ind+')').css({right:max_set[clk_ind]});
            $('.bar:eq('+clk_ind+')').css({marginRight:max_set[clk_ind]});
            $('.max_box:eq('+clk_ind+') input').val(Math.round((290-max_set[clk_ind])/290*1000));
            max_clk=0;
        };
    });
});