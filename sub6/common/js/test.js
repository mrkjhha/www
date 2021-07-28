var bn = $(".box").length;
var num = 0;
$(document).ready(function() {

    $('.con_box .box').before($('.con_box .box').clone());
    $(".box").on("mousewheel DOMMouseScroll", function (e) {
		e.preventDefault();
		var delta = 0;
        var valuee= event.wheelDelta;

        console.log(valuee);

		// if (!event) event = window.event;

		if (event.wheelDelta) {
			delta = event.wheelDelta / 120;
			// if (window.opera) delta = -delta;

		} else if (event.detail) delta = -event.detail / 3;

        console.log(delta);

		if (delta < 0) {
				num = $(this).index()+1;
		} else { 
				num = $(this).index()-1;
		}
		console.log(num)

		if( num >= bn ) {
			num=bn-1;
		} else if (num<=-1) {
			num=0	
		}
        $('.con2_tab li').removeClass('current');
		$(".con_box").stop().animate({left:-num*100+"%"});	
        $('.con2_tab li:eq('+(num-1)+')').addClass('current');	
    });	

});