$(function () {
    $(".game-pop-close").on("click",function () {
        $(this).parents(".game-pop").hide();
    });
    $(".go-cancel-a").on("click",function () {
        $(this).parents(".game-pop").hide();
    });

    window.onload=function () {
        setTime(".g-m-logo",img + "/game-i01.png","",0);
        setTime(".down-a-i",img + "/game-i02.png","",0);
        setTime(".game-i03",img + "/game-i03.png","",0);
        setTime(".game-i04",img + "/game-i04.png","",0);
        setTime(".game-i05",img + "/game-i05.png","",0);
        setTime(".game-i06",img + "/game-i06.png","",500);
        setTime(".game-i07",img + "/game-i07.png","",500);
        setTime(".game-i08",img + "/game-i08.png","",500);
        setTime(".game-i09",img + "/game-i09.png","",500);
        setTime(".game-i10",img + "/game-i10.png","",500);
        setTime(".game-i11",img + "/game-i11.png","",500);
        setTime(".game-i12",img + "/game-i12.png","",500);
        setTime(".game-i13",img + "/game-i13.png","",500);
        setTime(".game-i14",img + "/game-i14.png","",500);
    }

});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function isIos(a) {
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid) {
        $(".game-pop").show();
        $(".game-anri").show();
    }
    if(isiOS){
        window.location = a;
    }
}

