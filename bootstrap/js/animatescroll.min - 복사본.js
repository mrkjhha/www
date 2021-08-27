/* Coded by Ramswaroop */
(function(e){
    e.easing["jswing"]=e.easing["swing"];
    e.extend(e.easing,{def:"easeOutQuad",swing:function(t,n,r,i,s){
        return e.easing[e.easing.def](t,n,r,i,s)
    },easeOutQuad:function(e,t,n,r,i){
            return-r*(t/=i)*(t-2)+n
        }});
    e.fn.animatescroll=function(t){
    var n=e.extend({},e.fn.animatescroll.defaults,t);
                        if(typeof n.onScrollStart=="function"){
                            n.onScrollStart.call(this)
                        }if(n.element=="html,body"){
                            var r=this.offset().top;
                            e(n.element).stop().animate({
                                scrollTop:r-n.padding},n.scrollSpeed,n.easing)
                            }else{
                                e(n.element).stop().animate({scrollTop:this.offset().top-this.parent().offset().top+this.parent().scrollTop()-n.padding},n.scrollSpeed,n.easing)
                            }
                            setTimeout(function(){
                                if(typeof n.onScrollEnd=="function"){
                                    n.onScrollEnd.call(this)
                                }
                            },n.scrollSpeed)
                        };
                            e.fn.animatescroll.defaults={
                                easing:"swing",scrollSpeed:800,padding:0,element:"html,body"
                            }
                        })(jQuery)