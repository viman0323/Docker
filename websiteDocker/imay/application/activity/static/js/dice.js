$(function () {
    var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
    var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;
    var availHeight= window.screen.availHeight
    $(".g1-info").css("height",availHeight);
    var a = $(".g1-info2-b").scrollHeight;
    $(".g1-info3").css("height",clientHeight+clientHeight/3);
    

    window.onload=function () {
        $(".g1-imaylogo").attr("src","/application/activity/static/images/dice/imaylogo.png");
        $(".g1-i74").attr("src","/application/activity/static/images/dice/g-i74-a.png");
        setTime(".g1-j01","/application/activity/static/images/dice/g-bg-a.jpg","tab-scroll",10);
        setTime(".g1-i01","/application/activity/static/images/dice/g-i01-a.png","tab-scroll",30);
        setTime(".g1-i02","/application/activity/static/images/dice/g-i02-a.png","tab-scroll",200);
        setTime(".g1-i03","/application/activity/static/images/dice/g-i03-a.png","tab-scroll",500);
        setTimeout('$(".g1-g11").attr("src","/application/activity/static/images/dice/g-i11-a.png").fadeIn()',1000);
        setTime(".g1-i06","/application/activity/static/images/dice/g-i06-a.png","tab-scroll1 aniInRight",1200);
        setTime(".g1-i08","/application/activity/static/images/dice/g-i08-a.png","tab-scroll1 aniShow",1300);
        setTime(".g1-i05a","/application/activity/static/images/dice/g-i06a-a.png","tab-scroll1 aniInLeft",1500);
        setTime(".g1-i09","/application/activity/static/images/dice/g-i09-a.png","tab-scroll1 aniShow",1600);
        setTime(".g1-i06a","/application/activity/static/images/dice/g-i06-a.png","tab-scroll1 aniInRight",1800);
        setTime(".g1-i10","/application/activity/static/images/dice/g-i10-a.png","tab-scroll1 aniShow",2000);
        setTime(".g1-i15","/application/activity/static/images/dice/g-i15-a.png","tab-scroll1 aniShow",2500);
        setTime(".g1-i16","/application/activity/static/images/dice/g-i16-a.png","tab-scroll1 aniShow",2800);
        setTime(".g1-g02","/application/activity/static/images/dice/g-g02-a.gif","tab-scroll1 aniShow",3200);
    };

    $(window).scroll(function () {
        var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        if(scrollTop>clientHeight/2){
            getInfo2A();
        }if(scrollTop>clientHeight-50){
            getInfo2B();
        }if(scrollTop>clientHeight+clientHeight/2){
            getInfo3A();
        }if(scrollTop>clientHeight+clientHeight){
            getInfo3B();
        }if(scrollTop>clientHeight*2+clientHeight/2){
            getInfo4A();
        }
    });

    window.addEventListener("resize",function () {
        $(".g1-info").css("height",availHeight);
        $(".g1-info1").css("height",availHeight);
        $(".g1-info3").css("height",clientHeight+clientHeight/3);
    })
});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function getInfo2A() {
    setTime(".g1-i12",src+"/g-i12-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17",src+"/g-i06-a.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i13",src+"/g-i13-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i14",src+"/g-i14-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18",src+"/g-h02-a.png","tab-scroll1 aniInRight",300);
    setTime(".g1-i17a",src+"/g-i06-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i19",src+"/g-i19-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i20",src+"/g-i20-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18a",src+"/g-i18-a.png","tab-scroll1 aniInRight",1000);
    setTime(".g1-i21",src+"/g-i21-a.png","tab-scroll1 aniInRight",10);
}
function getInfo2B() {
    setTime(".g1-i27",src+"/g-i27-a.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i22",src+"/g-i22-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i23",src+"/g-i23-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i17b",src+"/g-i06-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i24",src+"/g-i24-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18b",src+"/g-h03-a.png","tab-scroll1 aniInRight",1000);
    setTime(".g1-i25",src+"/g-i25-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i17c",src+"/g-i06-a.png","tab-scroll1 aniInLeft",1300);
    setTime(".g1-i26",src+"/g-i26-a.png","tab-scroll1 aniShow",1300);
    setTime(".g1-i18b-a",src+"/g-h03-a.png","tab-scroll1 aniInRight",1500);
    setTime(".g1-i27-a",src+"/g-i27-b.png","tab-scroll1 aniInLeft",1500);

}

function getInfo3A() {
    setTime(".g1-i32",src+"/g-i32-a.png","tab-scroll1 aniInRight",50);
    setTime(".g1-i31",src+"/g-i31-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i33",src+"/g-i33-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18c",src+"/g-i06-a.png","tab-scroll1 aniInLeft",300);
    setTime(".g1-i18c-a",src+"/g-h09-a.png","tab-scroll1 aniInLeft",900);
    setTime(".g1-i35a",src+"/g-i35a-a.png","tab-scroll1 aniShow",900);
    setTime(".g1-i17c1",src+"/g-h09-a.png","tab-scroll1 aniInRight",600);
    setTime(".g1-i34",src+"/g-i34-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i35",src+"/g-i35-a.png","tab-scroll1 aniShow",1200);
    setTime(".g1-i18d",src+"/g-h02-a.png","tab-scroll1 aniInRight",1200);
    setTime(".g1-i18c-b",src+"/g-i06-a.png","tab-scroll1 aniInLeft",1400);
    setTime(".g1-i35b",src+"/g-i35b.png","tab-scroll1 aniShow",1400);
    setTime(".g1-i17c1-a",src+"/g-h02-a.png","tab-scroll1 aniInRight1",1600);
    setTime(".g1-i35c",src+"/g-i35c.png","tab-scroll1 aniShow",1600);

}
function getInfo3B() {
    setTime(".g1-i27a",src+"/g1-i27a.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i18c-c",src+"/g-i06-a.png","tab-scroll1 aniInLeft",300);
    setTime(".g1-i35d",src+"/g-i35d.png","tab-scroll1 aniShow",500);
    setTime(".g1-i17c1-b",src+"/g-h02-a.png","tab-scroll1 aniInRight",800);
    setTime(".g1-i35e",src+"/g-i35e.png","tab-scroll1 aniShow",1000);
}
function getInfo4A() {
    setTime(".g1-i44",src+"/g-i44-a.png","tab-scroll1 aniInRight",50);
    setTime(".g1-i17f-a",src+"/g-i06-a.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i46a",src+"/g1-i46a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i48",src+"/g-i48-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i49",src+"/g-i49-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i45",src+"/g-i45-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18g",src+"/g-h03-a.png","tab-scroll1 aniInRight",600);
    setTime(".g1-i17f",src+"/g-i06-a.png","tab-scroll1 aniInLeft",800);
    setTime(".g1-i46",src+"/g-i46-a.png","tab-scroll1 aniShow",800);
    setTime(".g1-i47",src+"/g-i47-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18h",src+"/g-h03-a.png","tab-scroll1 aniInRight",1000);
    setTime(".g1-h17a",src+"/g-i06-a.png","tab-scroll1 aniInLeft",1200);
    setTime(".g1-h03",src+"/g1-h03-a.png","tab-scroll1 aniShow",1200);
    setTime(".g1-i17m",src+"/g-i06-a.png","tab-scroll1 aniInRight",1500);
    setTime(".g1-i70",src+"/g-i70-a.png","tab-scroll1 aniShow",1500);
    setTime(".g1-i71",src+"/g-i71-a.png","tab-scroll1 aniShow",1800);
    setTime(".g1-i18o",src+"/g-h03-a.png","tab-scroll1 aniInLeft",1800);
    setTime(".g1-i17m-a",src+"/g-i06-a.png","tab-scroll1 aniInRight",2000);
    setTime(".g1-i71a",src+"/g1-i71a.png","tab-scroll1 aniShow",2000);
    setTime(".g1-i18o-a",src+"/g-h03-a.png","tab-scroll1 aniInLeft",2200);
    setTime(".g1-i70a",src+"/g-i70a.png","tab-scroll1 aniShow",2200);
    setTime(".g1-i72",src+"/g-i72-a.png","tab-scroll1 aniShow",2400);
    setTime(".g1-logo",src+"/logo.png","tab-scroll1 enlarge1",2500);
    setTime(".iMayCode",src+"/iMayCode.png","tab-scroll1 enlarge",2500);
}
