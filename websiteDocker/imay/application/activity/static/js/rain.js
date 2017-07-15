
$(function () {
    imgSrc ="/application/activity/static/images";
    var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
    var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;
    var availHeight= window.screen.availHeight
    $(".g1-info").css("height",availHeight);

    window.onload=function () {
        $(".g1-imaylogo").attr("src",imgSrc+"/imaylogo.png");
        // $(".g1-i75").attr("src",imgSrc+"/g-i75-a.png");
        $(".g1-i74").attr("src",imgSrc+"/g-i74-a.png");
        setTime(".g1-j01",imgSrc+"/g-bg-a.jpg","tab-scroll",10);
        setTime(".g1-i01",imgSrc+"/g-i01-a.png","tab-scroll",30);
        setTime(".g1-i02",imgSrc+"/g-i02-a.png","tab-scroll",200);
        setTime(".g1-i03",imgSrc+"/g-i03-a.png","tab-scroll",500);
        setTime(".g1-g01",imgSrc+"/g-g01-a.gif","tab-scroll",1000);
        setTimeout('$(".g1-g01").hide()',1800);
        setTimeout('$(".g1-g11").attr("src","/application/activity/static/images/g-i11-a.png").fadeIn()',1800);
        setTime(".g1-i04",imgSrc+"/g-i04-a.png","aniInLeft3 tab-scroll",1900);
        setTime(".g1-i04a",imgSrc+"/g-i04a-a.png","aniInRight5 tab-scroll",1900);
        //speak1
        setTime(".g1-i05",imgSrc+"/g-i05-a.png","tab-scroll1 aniInLeft",2200);
        setTime(".g1-i07",imgSrc+"/g-i07-a.png","tab-scroll1 aniShow",2300);
        setTime(".g1-i06",imgSrc+"/g-i06a-a.png","tab-scroll1 aniInRight1",2700);
        setTime(".g1-i08",imgSrc+"/g-i08-a.png","tab-scroll1 aniShow",2700);
        setTime(".g1-i05a",imgSrc+"/g-i05-a.png","tab-scroll1 aniInLeft",2900);
        setTime(".g1-i09",imgSrc+"/g-i09-a.png","tab-scroll1 aniShow",2900);
        setTime(".g1-i06a",imgSrc+"/g-i06a-a.png","tab-scroll1 aniInRight1",3200);
        setTime(".g1-i10",imgSrc+"/g-i10-a.png","tab-scroll1 aniShow",3200);
        setTime(".g1-h01",imgSrc+"/g-i06-a.png","tab-scroll1 aniInLeft",3300);
        setTime(".g1-h02",imgSrc+"/g-h01-a.png","tab-scroll1 aniShow",3300);

        setTime(".g1-i15",imgSrc+"/g-i15-a.png","tab-scroll1 aniShow",3600);
        setTime(".g1-i16",imgSrc+"/g-i16-a.png","tab-scroll1 aniShow",3700);
        setTime(".g1-g02",imgSrc+"/g-g02-a.gif","tab-scroll1 aniShow",3800);
    };

    $(window).scroll(function () {
        var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        if(scrollTop>availHeight/2){
            getInfo2A();
        }if(scrollTop>availHeight-50){
            getInfo2B();
        }if(scrollTop>availHeight+availHeight/2){
            getInfo3A();
        }if(scrollTop>availHeight+availHeight){
            getInfo3B();
        }if(scrollTop>availHeight*2+availHeight/2){
            getInfo4A();
        }if(scrollTop>availHeight*3-100){
            getInfo4B();
        }if(scrollTop>availHeight*3+availHeight/2-100){
            getInfo5A();
        }if(scrollTop>availHeight*4){
            getInfo5B();
        }if(scrollTop>availHeight*4+availHeight/2-150){
            getInfo6A();
        }if(scrollTop>availHeight*5-200){
            getInfo6B();
        }
    });

    window.addEventListener("resize",function () {
        $(".g1-info").css("height",availHeight);
        $(".g1-info1").css("height",clientHeight);
    })
});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function getInfo2A() {
    setTime(".g1-i12",imgSrc+"/g-i12-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i13",imgSrc+"/g-i13-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i14",imgSrc+"/g-i14-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18",imgSrc+"/g-h02-a.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17a",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i19",imgSrc+"/g-i19-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i20",imgSrc+"/g-i20-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18a",imgSrc+"/g-i18-a.png","tab-scroll1 aniInRight2",1000);
    setTime(".g1-i21",imgSrc+"/g-i21-a.png","tab-scroll1 aniInRight3",10);
}
function getInfo2B() {
    setTime(".g1-i27",imgSrc+"/g-i27-a.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i22",imgSrc+"/g-i22-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i23",imgSrc+"/g-i23-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i17b",imgSrc+"/g-h03-a.png","tab-scroll1 aniInLeft1",600);
    setTime(".g1-i24",imgSrc+"/g-i24-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18b",imgSrc+"/g-i17-a.png","tab-scroll1 aniInRight1",1000);
    setTime(".g1-i25",imgSrc+"/g-i25-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i17c",imgSrc+"/g-h03-a.png","tab-scroll1 aniInLeft1",1300);
    setTime(".g1-i26",imgSrc+"/g-i26-a.png","tab-scroll1 aniShow",1300);

}

function getInfo3A() {
    setTime(".g1-i32",imgSrc+"/g-i32-a.png","tab-scroll1 aniInRight3",50);
    setTime(".g1-i31",imgSrc+"/g-i31-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i33",imgSrc+"/g-i33-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18c",imgSrc+"/g-h09-a.png","tab-scroll1 aniInLeft",300);
    setTime(".g1-i18c-a",imgSrc+"/g-h09-a.png","tab-scroll1 aniInLeft",900);
    setTime(".g1-i35a",imgSrc+"/g-i35a-a.png","tab-scroll1 aniShow",900);
    setTime(".g1-i17c1",imgSrc+"/g-i17-a.png","tab-scroll1 aniInRight2",600);
    setTime(".g1-i34",imgSrc+"/g-i34-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i35",imgSrc+"/g-i35-a.png","tab-scroll1 aniShow",1200);
    setTime(".g1-i18d",imgSrc+"/g-i18-a.png","tab-scroll1 aniInRight2",1200);
    setTime(".g1-i18c-b",imgSrc+"/g-h09-a.png","tab-scroll1 aniInLeft",1400);
    setTime(".g1-i35b",imgSrc+"/g-i35b.png","tab-scroll1 aniShow",1400);
    setTime(".g1-i17c1-a",imgSrc+"/g-i18-a.png","tab-scroll1 aniInRight1",1600);
    setTime(".g1-i35c",imgSrc+"/g-i35c.png","tab-scroll1 aniShow",1600);
    setTime(".g1-i18c-c",imgSrc+"/g-h09-a.png","tab-scroll1 aniInLeft",1800);
    setTime(".g1-i35d",imgSrc+"/g-i35d.png","tab-scroll1 aniShow",1800);
    setTime(".g1-i17c1-b",imgSrc+"/g-i18-a.png","tab-scroll1 aniInRight1",2000);
    setTime(".g1-i35e",imgSrc+"/g-i35e.png","tab-scroll1 aniShow",2000);
}
function getInfo3B() {

}
function getInfo4A() {
    setTime(".g1-i44",imgSrc+"/g-i44-a.png","tab-scroll1 aniInRight3",50);
    setTime(".g1-i48",imgSrc+"/g-i48-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i49",imgSrc+"/g-i49-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i45",imgSrc+"/g-i45-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18g",imgSrc+"/g-h04-a.png","tab-scroll1 aniInRight2",600);
    setTime(".g1-i17f",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",1000);
    setTime(".g1-i46",imgSrc+"/g-i46-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i47",imgSrc+"/g-i47-a.png","tab-scroll1 aniShow",1300);
    setTime(".g1-i18h",imgSrc+"/g-h04-a.png","tab-scroll1 aniInRight2",1300);
    setTime(".g1-h17a",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",1500);
    setTime(".g1-h03",imgSrc+"/g1-h03-a.png","tab-scroll1 aniShow",1500);
}
function getInfo4B() {
    setTime(".g1-i54",imgSrc+"/g-i54-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i55",imgSrc+"/g-i55-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i51",imgSrc+"/g-i51-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18i",imgSrc+"/g-h05-a.png","tab-scroll1 aniInRight3",300);
    setTime(".g1-i17h",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft1",600);
    setTime(".g1-i52",imgSrc+"/g-i52-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i53",imgSrc+"/g-i53-a.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18j",imgSrc+"/g-h05-a.png","tab-scroll1 aniInRight3",1000);
    setTime(".g1-i50",imgSrc+"/g-i50-a.png","tab-scroll1 aniInLeft",10);
    setTime(".g1-i17h-a",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft1",1200);
    setTime(".g1-i50a",imgSrc+"/g-i53a.png","tab-scroll1 aniShow",1200);
}

function getInfo5A() {
    setTime(".g1-i65",imgSrc+"/g-i65-a.png","tab-scroll1 aniShow",10);
    setTime(".g1-i63",imgSrc+"/g-i63-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i17i-a",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",300);
    setTime(".g1-i57a",imgSrc+"/g1-i57a-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i57",imgSrc+"/g-i57-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18k",imgSrc+"/g-h10-a.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17i",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i58",imgSrc+"/g-i58-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i56",imgSrc+"/g-i56-a.png","tab-scroll1 aniInRight3",100);
    setTime(".g1-i18k-a",imgSrc+"/g-h10-a.png","tab-scroll1 aniInRight2",800);
    setTime(".g1-i58a",imgSrc+"/g-i58a.png","tab-scroll1 aniShow",800);
}
function getInfo5B() {
    setTime(".g1-i64",imgSrc+"/g-i64-a.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i59",imgSrc+"/g-i59-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i17j-a",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft1",300);
    setTime(".g1-i61a",imgSrc+"/g-i61a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i60",imgSrc+"/g-i60-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18l",imgSrc+"/g-h08-a.png","tab-scroll1 aniInRight1",600);
    setTime(".g1-i17j",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft1",900);
    setTime(".g1-i61",imgSrc+"/g-i61-a.png","tab-scroll1 aniShow",900);
    setTime(".g1-i62",imgSrc+"/g-i62-a.png","tab-scroll1 aniShow",1200);
    setTime(".g1-i18m",imgSrc+"/g-h08-a.png","tab-scroll1 aniInRight1",1200);
}
function getInfo6A() {
    setTime(".g1-i66",imgSrc+"/g-i66-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17k",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i67",imgSrc+"/g-i67-a.png","tab-scroll1 aniShow",100);
    setTime(".g1-i68",imgSrc+"/g-i68-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18n",imgSrc+"/g-h07-a.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17l",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i69",imgSrc+"/g-i69-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-i73",imgSrc+"/g-i73-a.png","tab-scroll1 aniInRight3",100);
    setTime(".g1-i68a",imgSrc+"/g-i69a.png","tab-scroll1 aniShow",800);
    setTime(".g1-i18n-a",imgSrc+"/g-h07-a.png","tab-scroll1 aniInRight2",800);
}
function getInfo6B() {
    setTime(".g1-i17m",imgSrc+"/g-i17-a.png","tab-scroll1 aniInLeft2",50);
    setTime(".g1-i70",imgSrc+"/g-i70-a.png","tab-scroll1 aniShow",50);
    setTime(".g1-i71",imgSrc+"/g-i71-a.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18o",imgSrc+"/g-h06-a.png","tab-scroll1 aniInRight4",300);
    setTime(".g1-i72",imgSrc+"/g-i72-a.png","tab-scroll1 aniShow",600);
    setTime(".g1-logo",imgSrc+"/logo.png","tab-scroll1 enlarge1",600);
    setTime(".iMayCode",imgSrc+"/iMayCode.png","tab-scroll1 enlarge",1000);

}