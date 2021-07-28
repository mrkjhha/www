var xhr = new XMLHttpRequest();                 // XMLHttpRequest 객체를 생성한다.

xhr.onload = function() {                       // When readystate changes
 
  //if(xhr.status === 200) {                      // If server status was ok
    responseObject = JSON.parse(xhr.responseText);  //서버로 부터 전달된 json 데이터를 responseText 속성을 통해 가져올 수 있다.
	                                                 // parse() 메소드를 호출하여 자바스크립트 객체로 변환한다.

    var newContent = '';

    newContent +='<ul class="show_box">';

    for (var i = 0; i <responseObject.design_data.length; i++) { 
        if(i==0){
            newContent += '<li class="main_show">';
        }else{ 
            newContent += '<li>';
        }
      newContent += '<img src="' + responseObject.design_data[i].imgadress + '" ';
      newContent += 'alt="' + responseObject.design_data[i].title + '" />';
      newContent += '<dl>';
      newContent += '<dt>' + responseObject.design_data[i].title + '</dt>';
      newContent += '<dd>' + responseObject.design_data[i].subject + '</dd>';
      newContent += '</dl>';
      newContent += '<a href="#" class="d_more">더보기</a>';
      newContent += '</li>';
    }

    newContent += '</ul>';
    newContent += '<div class="img_wrap">';
    newContent += '<span class="move_box">';
    newContent += '<span class="img_box">';
    
    for (var i = 0; i <responseObject.design_data.length; i++) { 
    newContent += '<span></span>';
    }

    newContent += '</span>';
    newContent += '</span>';
    newContent += '</div>';

    newContent += '<span class="img_window"></span>';
    newContent += '<span class="btn_right btn">&rsaquo;<a class="next" href="#">다음작품</a></span>';
    newContent += '<span class="btn_left btn">&lsaquo;<a class="before" href="#">이전작품</a></span>';

    newContent += '<script src="./js/content_4/images_swap.js"></script>'

    document.getElementById('con_wrap').innerHTML = newContent;
  }
//};

xhr.open('GET', 'data/designdata.json', true);        // 요청을 준비한다.
xhr.send(null);                                 // 요청을 전송한다