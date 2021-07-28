$(document).ready(function(){    
    $('.content_area>div').hide();
    $('.content_area .content_1').show();

      $('.title_area a').click(function(e){
          e.preventDefault();
          var ind = $(this).index('.link');

          $('.content_area>div').hide();
          $('.content_'+(ind+1)).show();
     });
});