$(function () {
    window.onload=function () {
        setTime(".b-i01",img + "/b-i01.png","",10);
        setTime(".b-i08",img + "/b-i08.png","",100);
        setTime(".b-i03",img + "/b-i03.png","",200);
        setTime(".b-i09",img + "/b-i09.png","",200);
        setTimeout('$(".b-gift-a").show()',50);
        setTimeout('$(".b-luck-c").show()',100);
        setTimeout('$(".b-list-c").show()',200);
        setTimeout('$(".b-pager").show()',220);
    };
    $(".b-list-ul li").click(function () {
        var index =$(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".b-list-info").children();
        $(".b-list-ul li").removeClass("b-checked");
        $(this).addClass("b-checked");
        obj.hide();
        obj.eq(index).show();
    })

});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
