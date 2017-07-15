var iMayPlay = document.getElementById("iMayVideo");
var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
$(function () {
    window.onload=function () {
        setTime('.g-m-j01',img + '/g-m-j01.jpg','',5);
    };
    setIMayHeight();
    $(".z-play-a").click(function () {
        $(".mid-share").show();
        videoPlay();
    });
    $(".reload-play").click(function () {
        $(".z-reload-play").hide();
        videoPlay();
    });
    $(".mid-bot-follow").click(function () {

    });
    loadPlay();

});
function videoPlay() {
    $("#zVideo").css("height",clientHeight);
    $(".z-video-v").addClass("video-play-w");
    $(".z-play").hide();
    iMayPlay.play();
    setTimeout("isShowCount();",1000);
    iMayPlay.onplay=function () {
        $(".z-loading").hide();
    };
    iMayPlay.onplaying=function () {
        $(".z-loading").hide();
    };
    iMayPlay.onwaiting=function () {
        $(".z-loading").show();
    };
    iMayPlay.onended =function () {
        $(".z-video-v").removeClass("video-play-w");
        $(".z-reload-play").show();
        $(".z-count").hide();
    };
    iMayPlay.onpause=function () {
        $(".z-video-v").removeClass("video-play-w");
        $(".z-reload-play").show();
    };
}


function setCount() {
    var i = 2;
    var img1 = img+''
$(".z-num-s").css("visibility","visible");
var interval = setInterval(function () {
    i-=1;
    setTimeout('$(".z-num-s").attr("src","/application/m/static/images/superlive/number1.png");',1000);
    if (i==0){
        clearInterval(interval);
        setTimeout(' $(".z-num-s").css("visibility","hidden");',1000);
    }
    setSecond(10);
},10000);
setTimeout('$(".z-num-s").attr("src","/application/m/static/images/superlive/number2.png");',1000);
setSecond(10);
}


function setSecond(a) {
    var t =a;
    var a = setInterval(function () {
        t-=1;
        $(".z-num-g").attr("src","/application/m/static/images/superlive/number"+t+".png");
        if(t==0){
            clearInterval(a);
        }
    },1000);
}


function isShowCount() {
    var u = navigator.userAgent;
    var ua = window.navigator.userAgent.toLowerCase();
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    if(isAndroid) {
        $(".z-count").hide();
    }
    if(isiOS){
        if(ua.match(/WeiBo/i) == 'weibo'){
            $(".z-count").hide();
            return true;
        }else {
            $(".z-count").show();
            $(".z-num-s").attr("src","/application/m/static/images/superlive/number3.png");
            $(".z-num-g").attr("src","/application/m/static/images/superlive/number0.png");
            setTimeout("$('.z-num-s').css('visibility','visible');$('.z-count').hide()",31000);
            setTimeout("setCount();",500);
        }
    }
}

function loadPlay() {
    iMayPlay.addEventListener("resize",function () {
        iMayPlay.onplay=function () {
            $(".z-loading").hide();
        };
        iMayPlay.onplaying=function () {
            $(".z-loading").hide();
        };
        iMayPlay.onwaiting=function () {
            $(".z-loading").show();
        };
        iMayPlay.onended =function () {
            $(".z-video-v").removeClass("video-play-w");
            $(".z-reload-play").show();
            $(".z-count").hide();
        };
        iMayPlay.onpause=function () {
            $(".z-video-v").removeClass("video-play-w");
            $(".z-reload-play").show();
        };
    });
}


function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function setIMayHeight(){
    $("#zVideo").css("height",clientHeight*0.65);
}

