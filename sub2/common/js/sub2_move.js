$(document).ready(function () {
            
    $('.title_area a').click(function(e){
       e.preventDefault();
       var value=0;
       var ind=$(this).index('.link');
       value= $('.content_area .content_'+(ind+1)).offset().top+20;
         
       $("html,body").stop().animate({"scrollTop":value},1000);
    });
 });