
$(function () {
    $(".n-list-ul li").on("touchstart",function () {
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().find(".n-list-c").children();
        $(".n-list-ul li").removeClass("n-checked");
        $(this).addClass("n-checked");
        obj.hide();
        obj.eq(index).show();
    });
    $(".list-c-d:first-child").show();
    window.onload=function () {
        setTime('.n-bg-i02',a + '/n-top.jpg','tab-scroll1',10);
        setTime('.n-bg-i03',a + '/n-bg03.png','tab-scroll',300);
        setTime('.n-i07a',a + '/n07a.png','',500);
        setTime('.n-i08a',a + '/n08a.png','',500);
        setTime('.n-i07b',a + '/n07b.png','',500);
        setTime('.n-i08b',a + '/n08b.png','',500);
        setTimeout("$('.n-list-ul').addClass('tab-scroll aniInTop1')",500)
        setTime('.n-i03',a + '/n03.png','tab-scroll aniInLeft',800);
        setTime('.n-i02a',a + '/n02.png','tab-scroll aniInTop1',1000);
        setTime('.n-i02b',a + '/fc.png','tab-scroll aniInTop1',1000);
        setTimeout('$(".list-c-mid").show().addClass("tab-scroll aniInTop1")',1200);
        setTimeout('$(".n-i02").addClass("twinkling")',1500);
        setTimeout('$(".n-footer").show()',1000);
    }
});



function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
