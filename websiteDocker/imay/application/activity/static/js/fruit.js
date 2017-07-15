$(function () {
    var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
    var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;
    var availHeight= window.screen.availHeight
    $(".g1-info").css("height",availHeight);
    var a = $(".g1-info2-b").scrollHeight;

    window.onload=function () {
        $(".g1-imaylogo").attr("src","/application/activity/static/images/fruit/imaylogo.png");
        $(".g1-i74").attr("src","/application/activity/static/images/fruit/g-i74-a.png");
        setTime(".g1-j01","/application/activity/static/images/fruit/g-bg-a.jpg","tab-scroll",10);
        setTime(".g1-i01","/application/activity/static/images/fruit/g-i01-a.png","tab-scroll",30);
        setTime(".g1-i02","/application/activity/static/images/fruit/g-i02-a.png","tab-scroll",200);
        setTime(".g1-i03","/application/activity/static/images/fruit/g-i03-a.png","tab-scroll",500);
        setTimeout('$(".g1-g11").attr("src","/application/activity/static/images/fruit/g-i11-a.png").fadeIn()',800);
        setTime(".g1-i05a-a","/application/activity/static/images/fruit/g-i18-a.png","tab-scroll1 aniInLeft",1000);
        setTime(".g1-i08-a","/application/activity/static/images/fruit/g-i08.png","tab-scroll1 aniShow",1000);
        setTime(".g1-i06","/application/activity/static/images/fruit/g-i06-a.png","tab-scroll1 aniInRight",1200);
        setTime(".g1-i08","/application/activity/static/images/fruit/g-i08-a.png","tab-scroll1 aniShow",1200);
        setTime(".g1-i05a","/application/activity/static/images/fruit/g-i18-a.png","tab-scroll1 aniInLeft",1500);
        setTime(".g1-i09","/application/activity/static/images/fruit/g-i09-a.png","tab-scroll1 aniShow",1500);
        setTime(".g1-i06a","/application/activity/static/images/fruit/g-i06-a.png","tab-scroll1 aniInRight",1800);
        setTime(".g1-i10","/application/activity/static/images/fruit/g-i10-a.png","tab-scroll1 aniShow",2000);
        setTime(".g1-i15","/application/activity/static/images/fruit/g-i15-a.png","tab-scroll1 aniShow",2300);
        setTime(".g1-i16","/application/activity/static/images/fruit/g-i16-a.png","tab-scroll1 aniShow",2500);
        setTime(".g1-g02","/application/activity/static/images/fruit/g-g02-a.gif","tab-scroll1 aniShow",2800);
    };

    $(window).scroll(function () {
        var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        if(scrollTop>clientHeight/2){
            getInfo2A();
        }if(scrollTop>clientHeight-50){
            getInfo2B();
        }if(scrollTop>clientHeight+clientHeight/2){
            getInfo3A();
        }
    });

    window.addEventListener("resize",function () {
        $(".g1-info").css("height",availHeight);
        $(".g1-info1").css("height",availHeight);
    })
});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function getInfo2A() {
    setTime(".g1-i12",aa+"/g-i12-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i13",aa+"/g-i13-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i14",aa+"/g-i14-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18",aa+"/g-h02-a.png","tab-scroll1 aniInRight",300);
    setTime(".g1-i17a",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i19",aa+"/g-i19-a.png","tab-scroll1 aniShow",600);
}
function getInfo2B() {
    setTime(".g1-i27",aa+"/g-i27-a.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i22",aa+"/g-i22-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i18b",aa+"/g-h03-a.png","tab-scroll1 aniInRight",300);
    setTime(".g1-i25",aa+"/g-i25-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i17c",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i26",aa+"/g-i26-a.png","tab-scroll1 aniShow",600);

}

function getInfo3A() {
    setTime(".g1-i54",aa+"/g-i54-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i55",aa+"/g-i55-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i51",aa+"/g-i51-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18i",aa+"/g-h03-a.png","tab-scroll1 aniInRight",300);
    setTime(".g1-i17h",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i52",aa+"/g-i52-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i53",aa+"/g-i53-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18j",aa+"/g-h03-a.png","tab-scroll1 aniInRight",1000);
    setTime(".g1-i50",aa+"/g-i50-a.png","tab-scroll1 aniInLeft",10);
    setTime(".g1-i17h-a",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",1200);
    setTime(".g1-i50a",aa+"/g-i53a.png","tab-scroll1 aniShow",1200);
    setTime(".g1-i17m",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",1400);
    setTime(".g1-i70",aa+"/g-i70-a.png","tab-scroll1 aniShow",1400);
    setTime(".g1-i71",aa+"/g-i71-a.png","tab-scroll1 aniShow",1700);
    setTime(".g1-i18o",aa+"/g-h03-a.png","tab-scroll1 aniInRight",1700);
    setTime(".g1-i17m-a",aa+"/g-i06-a.png","tab-scroll1 aniInLeft",2000);
    setTime(".g1-i70a",aa+"/g-i70a.png","tab-scroll1 aniShow",2000);
    setTime(".g1-i71a",aa+"/g1-i71a.png","tab-scroll1 aniShow",2200);
    setTime(".g1-i18o-a",aa+"/g-h03-a.png","tab-scroll1 aniInRight",2200);
    setTime(".g1-i72",aa+"/g-i72-a.png","tab-scroll1 aniShow",2400);
    setTime(".g1-logo",aa+"/logo.png","tab-scroll1 enlarge1",2500);
    setTime(".iMayCode",aa+"/iMayCode.png","tab-scroll1 enlarge",2500);
}
