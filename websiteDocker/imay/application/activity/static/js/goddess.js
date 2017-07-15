$(function () {
    $(".god-list-ul li").on("click",function () {
        var index= $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".god-list-d").children();
        $(".god-list-ul li").removeClass("god-list-check");
        $(this).addClass("god-list-check");
        obj.hide();
        obj.eq(index).show();
    });
    window.onload=function () {
        setTime('.god-bg','/application/activity/static/images/goddess/bg.jpg','tab-scroll aniShow',10);
        setTime('.god-i01','/application/activity/static/images/goddess/g-i01.png','tab-scroll aniInTop',10);
        setTime('.god-i02','/application/activity/static/images/goddess/g-i02.png','tab-scroll enlarge',200);
        setTime('.god-i03','/application/activity/static/images/goddess/g-i03.png','',500);
        setTime('.god-i05','/application/activity/static/images/goddess/g-i05.png','',300);
        setTime('.god-yun1','/application/activity/static/images/goddess/yun.png','tab-scroll aniInLeft',700);
        setTime('.god-i06','/application/activity/static/images/goddess/g-i06.png','',1000);
        setTime('.god-i07','/application/activity/static/images/goddess/g-i07.png','',1000);
        setTime('.god-i07a','/application/activity/static/images/goddess/g-i07a.png','',1000);
        setTime('.god-i08','/application/activity/static/images/goddess/g-i08.png','tab-scroll aniInRight',1200);
        setTime('.god-i18','/application/activity/static/images/goddess/g-i18.png','',1400);
        setTime('.g-tab-c','/application/activity/static/images/goddess/g-tab-c.png','',1500);
        setTime('.g-tab-d','/application/activity/static/images/goddess/g-tab-d.png','',1500);
        setTime('.g-tab-a','/application/activity/static/images/goddess/g-tab-a.png','',1500);
        setTime('.g-tab-b','/application/activity/static/images/goddess/g-tab-b.png','',1500);
        setTime('.god-yun','/application/activity/static/images/goddess/yun.png','',1400);
        setTime('.god-i09','/application/activity/static/images/goddess/g-i09.png','',1500);
        setTime('.g-list-a','/application/activity/static/images/goddess/g-list.png','',1500);
        setTime('.god-i17','/application/activity/static/images/goddess/g-i17.png','',1500);
        setTimeout('$(".god-vs-c").show()',1200);
        setTimeout('$(".god-bar-c").show()',1800);
        setTimeout('$(".god-list").show()',1600);
        setTimeout('$(".god-list-ul1").show()',1600);
        setTimeout('$(".god-nav-ni").addClass("tab-scroll aniInBottom").show();',300);
        setTimeout('$(".god-nav-c").addClass("tab-scroll aniInTop").show();',300);
        setTimeout('$(".god-bar-c").addClass("tab-scroll aniInLeft")',1000);

    }

});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
