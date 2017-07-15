
$(function () {
    $(".l-tab-ul li").on("touchstart",function () {
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().find(".l-con").children();
        if(index==1){
            $(".l-i10").show();
        }else {
            $(".l-i10").hide();
        }
        obj.hide();
        obj.eq(index).show();
    });
    $(".l-c-w:first-child").show();
    window.onload=function () {
        setTime('.l-i03',a + '/l-bg03.png','tab-scroll aniInTop',10);
        setTime('.l-i01',a + '/l-bg01.png','tab-scroll aniShow',200);
        setTime('.l-i07',a + '/l-bg07.png','tab-scroll aniShow',300);
        setTime('.l-i02',a + '/l-bg02.png','tab-scroll aniInTop1',1000);
        setTime('.l-i08',a + '/l-bg08.png','tab-scroll aniInTop1',1000);
        setTime('.l-i04',a + '/l-bg04.png','tab-scroll aniInLeft',1200);
        setTimeout("$('.l-con').fadeIn()",1500);
        setTimeout("$('.l-bar-txt').fadeIn()",500);
        setTimeout("$('.l-footer').show()",1000);
        setTimeout("$('.l-c-mes').show()",1000)
    }
});



function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
