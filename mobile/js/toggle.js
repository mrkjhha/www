all_cnt=0;
$(document).ready(function () {
	var article = $('.content_3 dl');
	article.find('dd').slideUp(100);
    $('.content_3 dl').addClass('hide').css('background','rgb(231,118,109)');
	
	$('.content_3 dl dt a').click(function(e){
        e.preventDefault();
        var myArticle = $(this).parents('dl');
	
        if(myArticle.hasClass('hide')){
            article.find('dd').slideUp(100);
            article.removeClass('show').addClass('hide').css('background','rgb(231,118,109)');
            myArticle.removeClass('hide').addClass('show');
            myArticle.css('background','rgb(225,84,73)')
            myArticle.find('dd').slideDown(100);
        } else {
            myArticle.removeClass('show').addClass('hide');
            myArticle.css('background','rgb(231,118,109)');
            myArticle.find('dd').slideUp(100);
        }  
    });
});