$(function () {
    var clientHeight = document.documentElement.clientHeight||document.body.clientHeight;
    var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;
    var availWidth = window.screen.availWidth;
    var availHeight= window.screen.availHeight
    $(".g1-info").css("height",availHeight);
    // $(".g1-info1").css("height",clientHeight);

    window.onload=function () {
        $(".g1-imaylogo").attr("src",a+"/imaylogo.png");
        $(".g1-i75").attr("src",a+"/g-i75.png");
        $(".g1-i74").attr("src",a+"/g-i74.png");
        setTime(".g1-j01",a+"/g-bg.jpg","tab-scroll",10);
        setTime(".g1-i01",a+"/g-i01.png","tab-scroll",30);
        setTime(".g1-i02",a+"/g-i02.png","tab-scroll",200);
        setTime(".g1-i03",a+"/g-i03.png","tab-scroll",500);
        setTime(".g1-g01",a+"/g-g01.gif","tab-scroll",1000);
        setTimeout('$(".g1-g01").hide()',1800);
        setTimeout('$(".g1-g11").attr("src",a+"/g-i11.png").fadeIn()',1800);
        setTime(".g1-i04",a+"/g-i04.png","twinkling",1900);
        setTime(".g1-i04a",a+"/g-i04.png","twinkling",2200);
        //speak1
        setTime(".g1-i05",a+"/g-i05.png","tab-scroll1 aniInLeft",2200);
        setTime(".g1-i07",a+"/g-i07.png","tab-scroll1 aniShow",2300);
        setTime(".g1-i06",a+"/g-i06.png","tab-scroll1 aniInRight1",2700);
        setTime(".g1-i08",a+"/g-i08.png","tab-scroll1 aniShow",2700);
        setTime(".g1-i05a",a+"/g-i05.png","tab-scroll1 aniInLeft",2900);
        setTime(".g1-i09",a+"/g-i09.png","tab-scroll1 aniShow",2900);
        setTime(".g1-i06a",a+"/g-i06.png","tab-scroll1 aniInRight1",3200);
        setTime(".g1-i10",a+"/g-i10.png","tab-scroll1 aniShow",3200);
        setTime(".g1-i15",a+"/g-i15.png","tab-scroll1 aniShow",3300);
        setTime(".g1-i16",a+"/g-i16.png","tab-scroll1 aniShow",3400);
        setTime(".g1-g02",a+"/g-g02.gif","tab-scroll1 aniShow",3500);
    };

    $(window).scroll(function () {
        var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        if(clientWidth<400){
            if(scrollTop>300){
                getInfo2A();
            }if(scrollTop>500){
                getInfo2B();
            }if(scrollTop>800){
                getInfo3A();
            }if(scrollTop>1100){
                getInfo3B();
            }if(scrollTop>1300){
                getInfo4A();
            }if(scrollTop>1800){
                getInfo4B();
            }if(scrollTop>1900){
                getInfo5A();
            }if(scrollTop>2300){
                getInfo5B();
            }if(scrollTop>2600){
                getInfo6A();
            }if(scrollTop>2800){
                getInfo6B();
            }
        }else{
            if(scrollTop>300){
                getInfo2A();
            }if(scrollTop>600){
                getInfo2B();
            }if(scrollTop>1000){
                getInfo3A();
            }if(scrollTop>1400){
                getInfo3B();
            }if(scrollTop>1600){
                getInfo4A();
            }
            if(scrollTop>2100){
                getInfo4B();
            }if(scrollTop>2400){
                getInfo5A();
            }if(scrollTop>2600){
                getInfo5B();
            }if(scrollTop>3200){
                getInfo6A();
            }if(scrollTop>3500){
                getInfo6B();
            }
        }
    });

    window.addEventListener("resize",function () {
        $(".g1-info").css("height",availHeight);
        // $(".g1-info1").css("height",clientHeight);
    })
});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function getInfo2A() {
    setTime(".g1-i12",a+"/g-i12.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17",a+"/g-i17.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i13",a+"/g-i13.png","tab-scroll1 aniShow",100);
    setTime(".g1-i14",a+"/g-i14.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18",a+"/g-i18.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17a",a+"/g-i17.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i19",a+"/g-i19.png","tab-scroll1 aniShow",600);
    setTime(".g1-i20",a+"/g-i20.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18a",a+"/g-i18.png","tab-scroll1 aniInRight2",1000);
    setTime(".g1-i21",a+"/g-i21.png","tab-scroll1 aniInRight3",10);
}
function getInfo2B() {
    setTime(".g1-i27",a+"/g-i27.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i22",a+"/g-i22.png","tab-scroll1 aniShow",100);
    setTime(".g1-i23",a+"/g-i23.png","tab-scroll1 aniShow",300);
    setTime(".g1-i17b",a+"/g-i17.png","tab-scroll1 aniInLeft1",600);
    setTime(".g1-i24",a+"/g-i24.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18b",a+"/g-i17.png","tab-scroll1 aniInRight1",1000);
    setTime(".g1-i25",a+"/g-i25.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i17c",a+"/g-i17.png","tab-scroll1 aniInLeft1",1300);
    setTime(".g1-i26",a+"/g-i26.png","tab-scroll1 aniShow",1300);

}

function getInfo3A() {
    setTime(".g1-i32",a+"/g-i32.png","tab-scroll1 aniInRight3",50);
    setTime(".g1-i31",a+"/g-i31.png","tab-scroll1 aniShow",100);
    setTime(".g1-i33",a+"/g-i33.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18c",a+"/g-i18.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17c1",a+"/g-i17.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i34",a+"/g-i34.png","tab-scroll1 aniShow",600);
    setTime(".g1-i35",a+"/g-i35.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18d",a+"/g-i18.png","tab-scroll1 aniInRight2",1000);
}
function getInfo3B() {
    setTime(".g1-i36",a+"/g-i36.png","tab-scroll1 aniShow",50);
    setTime(".g1-i37",a+"/g-i37.png","tab-scroll1 aniShow",100);
    setTime(".g1-i17d",a+"/g-i17.png","tab-scroll1 aniInLeft1",300);
    setTime(".g1-i38",a+"/g-i38.png","tab-scroll1 aniShow",300);
    setTime(".g1-i39",a+"/g-i39.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18e",a+"/g-i18.png","tab-scroll1 aniInRight3",600);
    setTime(".g1-i40",a+"/g-i40.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i41",a+"/g-i41.png","tab-scroll1 aniShow",1300);
    setTime(".g1-i18f",a+"/g-i18.png","tab-scroll1 aniInRight3",1300);
    setTime(".g1-i17e",a+"/g-i17.png","tab-scroll1 aniInLeft",1600);
    setTime(".g1-i42",a+"/g-i42.png","tab-scroll1 aniShow",1600);
    setTime(".g1-i43",a+"/g-i43.png","tab-scroll1 aniInLeft",50);
}
function getInfo4A() {
    setTime(".g1-i44",a+"/g-i44.png","tab-scroll1 aniInRight3",50);
    setTime(".g1-i48",a+"/g-i48.png","tab-scroll1 aniShow",100);
    setTime(".g1-i49",a+"/g-i49.png","tab-scroll1 aniShow",300);
    setTime(".g1-i45",a+"/g-i45.png","tab-scroll1 aniShow",600);
    setTime(".g1-i18g",a+"/g-i18.png","tab-scroll1 aniInRight2",600);
    setTime(".g1-i17f",a+"/g-i17.png","tab-scroll1 aniInLeft",1000);
    setTime(".g1-i46",a+"/g-i46.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i47",a+"/g-i47.png","tab-scroll1 aniShow",1300);
    setTime(".g1-i18h",a+"/g-i18.png","tab-scroll1 aniInRight2",1300);
}
function getInfo4B() {
    setTime(".g1-i54",a+"/g-i54.png","tab-scroll1 aniShow",50);
    setTime(".g1-i55",a+"/g-i55.png","tab-scroll1 aniShow",100);
    setTime(".g1-i51",a+"/g-i51.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18i",a+"/g-i18.png","tab-scroll1 aniInRight3",300);
    setTime(".g1-i17h",a+"/g-i17.png","tab-scroll1 aniInLeft1",600);
    setTime(".g1-i52",a+"/g-i52.png","tab-scroll1 aniShow",600);
    setTime(".g1-i53",a+"/g-i53.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18j",a+"/g-i18.png","tab-scroll1 aniInRight3",1000);
    setTime(".g1-i50",a+"/g-i50.png","tab-scroll1 aniInLeft",10);
}

function getInfo5A() {
    setTime(".g1-i65",a+"/g-i65.png","tab-scroll1 aniShow",50);
    setTime(".g1-i63",a+"/g-i63.png","tab-scroll1 aniShow",100);
    setTime(".g1-i57",a+"/g-i57.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18k",a+"/g-i18.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17i",a+"/g-i17.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i58",a+"/g-i58.png","tab-scroll1 aniShow",600);
    setTime(".g1-i56",a+"/g-i50.png","tab-scroll1 aniInRight3",10);
}
function getInfo5B() {
    setTime(".g1-i64",a+"/g-i64.png","tab-scroll1 aniInLeft",50);
    setTime(".g1-i59",a+"/g-i59.png","tab-scroll1 aniShow",100);
    setTime(".g1-i60",a+"/g-i60.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18l",a+"/g-i18.png","tab-scroll1 aniInRight1",300);
    setTime(".g1-i17j",a+"/g-i17.png","tab-scroll1 aniInLeft1",600);
    setTime(".g1-i61",a+"/g-i61.png","tab-scroll1 aniShow",600);
    setTime(".g1-i62",a+"/g-i62.png","tab-scroll1 aniShow",1000);
    setTime(".g1-i18m",a+"/g-i18.png","tab-scroll1 aniInRight1",1000);
}
function getInfo6A() {
    setTime(".g1-i66",a+"/g-i66.png","tab-scroll1 aniShow",50);
    setTime(".g1-i17k",a+"/g-i17.png","tab-scroll1 aniInLeft",100);
    setTime(".g1-i67",a+"/g-i67.png","tab-scroll1 aniShow",100);
    setTime(".g1-i68",a+"/g-i68.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18n",a+"/g-i18.png","tab-scroll1 aniInRight2",300);
    setTime(".g1-i17l",a+"/g-i17.png","tab-scroll1 aniInLeft",600);
    setTime(".g1-i69",a+"/g-i69.png","tab-scroll1 aniShow",600);
    setTime(".g1-i73",a+"/g-i73.png","tab-scroll1 aniInRight3",10);
}
function getInfo6B() {
    setTime(".g1-i17m",a+"/g-i17.png","tab-scroll1 aniInLeft2",50);
    setTime(".g1-i70",a+"/g-i70.png","tab-scroll1 aniShow",50);
    setTime(".g1-i71",a+"/g-i71.png","tab-scroll1 aniShow",300);
    setTime(".g1-i18o",a+"/g-i18.png","tab-scroll1 aniInRight4",300);
    setTime(".g1-i72",a+"/g-i72.png","tab-scroll1 aniShow",600);
    setTime(".g1-logo",a+"/logo.png","tab-scroll1 enlarge1",600);
    setTime(".iMayCode",a+"/iMayCode.png","tab-scroll1 enlarge",1000);

}