 function initialize() {
  var myLatlng = new google.maps.LatLng(37.490922599928965, 126.92312858277712);
  var myOptions = {
   zoom: 15,
   center: myLatlng

  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
  var marker = new google.maps.Marker({
   position: myLatlng,
   map: map,
   title:"우리집"
  });  
  
 
  var infowindow = new google.maps.InfoWindow({
   content: "서울특별시 동작구 보라매로 5길 51(신대방동, 롯데타워)"
  });
 
  infowindow.open(map,marker);
 }
 
 
 window.onload=function(){
  initialize();
 }