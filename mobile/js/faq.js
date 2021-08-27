all_cnt=0;
$(document).ready(function () {
	var article = $('.content_1 li');
	article.find('.ans').slideUp(100);
	
	$('.content_1 li .qes a').click(function(e){
        e.preventDefault();
        var myArticle = $(this).parents('li');
	
        if(myArticle.hasClass('hide')){
            article.find('.ans').slideUp(100);
            article.find('.qes').css('background','#fff')
            article.find('.qes a').css('color','#666')
            article.find('.qes span').css('color','rgb(225,84,73)')
            article.removeClass('show').addClass('hide');
            myArticle.removeClass('hide').addClass('show');
            myArticle.find('.qes').css('background','rgba(102,102,102,.8)')
            myArticle.find('.qes span').css('color','#fff')
            myArticle.find('.qes a').css('color','#fff')
            myArticle.find('.ans').slideDown(100);
        } else {
            myArticle.removeClass('show').addClass('hide');
            myArticle.find('.qes').css('background','#fff')
            myArticle.find('.qes span').css('color','rgb(225,84,73)')
            myArticle.find('.qes a').css('color','#666')
            myArticle.find('.ans').slideUp(100);
        }  
    });
  
  //모두 여닫기 처리
    $('.all').click(function(e){
        e.preventDefault();

        all_cnt++;
        if(all_cnt>2){all_cnt=1;}
        if(all_cnt==1) {
            $('.all a').addClass('a_hide')
            article.find('.qes').css('background','rgba(102,102,102,.8)')
            article.find('.qes a').css('color','#fff')
            article.find('.qes span').css('color','#fff')
            article.find('.ans').slideDown(100);
            article.removeClass('hide').addClass('show');
        } else {
            $('.all a').removeClass('a_hide')
            article.find('.qes').css('background','#fff')
            article.find('.qes a').css('color','#666')
            article.find('.qes span').css('color','rgb(225,84,73)')
            article.find('.ans').slideUp(100);
            article.removeClass('show').addClass('hide');
        };
    });
});