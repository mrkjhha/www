$(document).ready(function(){

    for(var i=0; i<12; i++){
        if(i>=0 && i<4){
            $('.con_box .picto:eq('+i+')').css({background:'url(../sub/images/environ_'+(i+1)+'.svg)center center no-repeat', backgroundSize:'contain'});
            $('.con_box .bg:eq('+i+')').css({background:'rgb(136,176,75)'})
        } else if(i>=4 && i<8){
            $('.con_box .picto:eq('+i+')').css({background:'url(../sub/images/product_'+(i-3)+'.svg)center center no-repeat', backgroundSize:'contain'});
            $('.con_box .bg:eq('+i+')').css({background:'rgb(90,91,159)'})
        } else if(i>=8 && i<12){
            $('.con_box .picto:eq('+i+')').css({background:'url(../sub/images/safe_'+(i-7)+'.svg)center center no-repeat', backgroundSize:'contain'});
            $('.con_box .bg:eq('+i+')').css({background:'rgb(225,84,73)'})
        }
    }
});