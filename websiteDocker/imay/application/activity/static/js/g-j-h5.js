$(function () {
    $(".mid-bar-ul li").click(function () {
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".g-mid-c .g-tab-c").children();
        $(".mid-bar-ul li").removeClass("mid-ul-check");
        $(".g-m-i01").attr("src",img + "/g-m-i01b.png");
        $(this).addClass("mid-ul-check");
        $(this).children().find(".g-m-i01").attr("src",img + "/g-m-i01a.png");
        obj.hide();
        obj.eq(index).show();
    });

    $(".g-i06-a").click(function () {
        $(".game-pop").show();
        var gameTxt = $(this).text();
        $(".game-mes-txt").html(gameTxt);
    });
    $(".game-pop-close").click(function () {
        $(".game-pop").hide();
    });

    window.onload=function () {
        setTime('.g-m-j01',img + '/g-m-j01.jpg','',5);
        setTime('.g-m-i04',img + '/g-m-i04.png','',5);
        setTime('.g-m-i01a',img + '/g-m-i01a.png','',10);
        setTime('.g-m-i01b',img + '/g-m-i01b.png','',10);
        setTime('.g-m-i02',img + '/g-m-i02.png','',15);
        setTime('.g-m-i03',img + '/g-m-i03.png','',15);

        setTime('.g-m-j02',img + '/g-m-j02.jpg','',5);
        setTime('.g-m-i06',img + '/g-m-i06.png','',5);
        setTime('.g-m-i07',img + '/g-m-i07.png','',5);
        setTime('.g-m-i05',img + '/g-m-i05.png','',5);
        setTime('.game-i05',img + '/game-i05.png','',5);
        setTime('.game-i06',img + '/game-i06.png','',5);
        setTimeout('$(".g-d-con").show()',5);
    }


});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
