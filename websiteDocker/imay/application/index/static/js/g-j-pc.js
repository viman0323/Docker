$(function () {
    $(".mid-bar-ul li").click(function () {
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".g-mid-c .g-tab-c").children();
        $(".mid-bar-ul li").removeClass("mid-ul-check");
        $(this).addClass("mid-ul-check");
        obj.hide();
        obj.eq(index).show();
    });

    window.onload=function () {
        setTime(".g-m-logo","images/game-i01.png","",0);
    }


});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}