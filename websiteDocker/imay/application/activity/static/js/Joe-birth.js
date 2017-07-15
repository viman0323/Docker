var joePlay = document.getElementById("joePlay");
var availHeight= window.screen.availHeight;
$(function () {
    window.onload=function () {
        showPer();
    };
    $(".joe-get").click(function () {
        $(".j-fir-joe").hide();
        $(".j-fo-c").show();
        $(this).animate({'bottom':'-100%'},function () {
            joeAniThird();
            $(".j-joe02").css("right","auto");
            $(this).hide();
        })
    });
    $(".j-but-c").click(function () {
        $(".j-mask").show();
    });
    $(".j-mask").click(function () {
        $(this).hide();
    });
    joePlay.load();
    joePlay.play();
    $(".joe-play").attr("src",img+"/play.png").addClass("i-scroll tab-scroll");
    $(".joe-play").click(function () {
        joePlay.pause();
        $(this).hide();
        $(".joe-pause").attr("src",img+"/pause.png").show();
    });
    $(".joe-pause").on('click',function () {
        joePlay.play();
        $(this).hide();
        $(".joe-play").show();
    });

});
document.addEventListener("WeixinJSBridgeReady", function () {
    joePlay.play();
}, false);
document.addEventListener('YixinJSBridgeReady', function() {
    joePlay.play();
}, false);


function openMask() {
    $(".j-mask").show();
    $(".j-i24").attr("src","images/j-i29.png");
}
var clientWidth = document.documentElement.clientWidth||document.body.clientWidth;

var t = -1;
function showPer(){
    var a = ((clientWidth*0.86)*0.9)/100;
    var b = clientWidth*0.83;
    var c = (clientWidth*0.85)/100;
    var interval = setInterval(function () {
        t += 1;
        $(".j-l-b").html(t+"%");
        $(".j-l-txt").css("left",a*t+"px");
        $(".j-i01-a").css("clip","rect(0px "+c*t+"px 50px 0px)");
        if(t==100){
            $(".j-l-txt").css("left","90%");
            $(".j-i01-a").css("clip","rect(0px "+b+"px 50px 0px)");
            clearInterval(interval);
            setTimeout('hideLoading()',300);
        }
    },20)
}

function hideLoading() {
    $('.j-loading').animate({'margin-left':'-100%'},function () {
        setTimeout('loadingFirst()',200);
        setTimeout('hideFirst()',8000);
    });
}

var width=$(window).width();

function selectFrom(lowerValue, upperValue){
    //取值范围总数
    var choices = upperValue - lowerValue + 1;
    return Math.floor(Math.random() * choices + lowerValue);
}
function foo(){
    var num = selectFrom(0, width)-20 ;
    $(".j-rose").append('<img style="left:'+num+'px" class="rotation" src="'+img+'/cake.png" />')
    $(".rotation").animate({'margin-top':'200%','transform':'translate(rotate(180deg))'},{duration:5000});
}
function rose() {
    $("body").height(availHeight);
    var timesRun = 0;
    var interval = setInterval(function(){
        foo();
        timesRun += 1;
        if(timesRun === 50){
            clearInterval(interval);
        }
    }, 500);
}
function loadingFive() {
    setTimeout('$(".j-t-c").hide()',10);
    setTime('.j-i19',img+'/j-i19.png','tab-scroll aniDis',10);
    setTime('.j-i17',img+'/j-i17.png','tab-scroll aniInRight',100);
    setTime('.j-i18',img+'/j-i18.png','tab-scroll aniInRight',500);
    setTime('.j-i23',img+'/j-i23.png','tab-scroll aniInLeft',1000);
    setTime('.j-i20',img+'/j-i20.png','tab-scroll-a aniButShow',1200);
    setTime('.j-i21',img+'/j-i21.png','tab-scroll-a aniButShow',1800);
    setTime('.j-i22',img+'/j-i22.png','tab-scroll-a aniButShow',2400);

}

function loadingThird() {
    $(".j-b-time").show();
    setTime('.j-bg01',img+'/j-bg01.png','tab-scroll aniDis',100);
    setTime('.j-i13',img+'/j-i13.png','tab-scroll aniInTop',800);
    setTime('.j-i14',img+'/j-i14.png','tab-scroll aniInLeft',1200);
    setTime('.j-i15',img+'/j-i15.png','tab-scroll aniInRight',1500);
    setTime('.j-i16',img+'/j-i16.png','tab-scroll aniInBottom getUp',1700);
    setTimeout('$(".j-s-c").hide()',100);


}

function loadingSecond() {
    setTime('.j-i05',img+'/j-i05.png','tab-scroll aniInTop',100);
    setTime('.j-i06',img+'/j-i06.png','tab-scroll aniInLeft',800);
    setTime('.j-i07',img+'/j-i07.png','tab-scroll aniInRight',1500);
    setTime('.j-i08',img+'/j-i08.png','tab-scroll aniInLeft',2000);
    setTime('.j-i09',img+'/cake.png','tab-scroll aniInBottom',2500);
    setTime('.j-i10',img+'/j-i10.png','tab-scroll flyIn',3000);
    setTime('.j-i11',img+'/j-i11.png','tab-scroll aniInRight',3500);
    setTime('.j-i12',img+'/j-i12.png','tab-scroll aniDis giftUp',4000);
    setTime('.gif-cham',img+'/cham.gif','gif-hide',2000);

    setTimeout('$(".j-i09").removeClass("tab-scroll aniInBottom");',4000);
    setTimeout('$(".j-i10").removeClass("tab-scroll flyIn");',4000);
    setTimeout('$(".j-i11").removeClass("tab-scroll aniInRight");',4000);
    setTimeout('$(".j-t-c").show()',3900);

    setTime('.gif-car',img+'/car.gif','gif-hide',1500);
}

function loadingFirst() {
    setTime('.j-joe01',img+'/j-joe01.png','tab-scroll aniInRight',10);
    setTime('.j-i03-a',img+'/j-i03-a.png','tab-scroll aniShow',500);
    setTime('.j-i03-b',img+'/j-i03-b.png','tab-scroll aniShow',1500);
    setTime('.j-i03-c',img+'/j-i03-c.png','tab-scroll aniShow',2500);
    setTime('.j-i04',img+'/j-i04.png','tab-scroll enlarge',3500);
    setTime('.gif-car',img+'/car.gif','gif-hide',2850);
    setTimeout("addDrop()",500);
    setTimeout('$(".j-s-c").show()',4500);
}
function hideFirst() {
    $(".j-top-a").animate({'top':'-100%'},function () {
        loadingSecond();
    })
}
function addDrop() {
    setTime('.j-i25',img+'/j-i25.png','fly-f',100);
    setTime('.j-i26',img+'/j-i26.png','fly-g',500);
    setTime('.j-i27',img+'/j-i27.png','fly-h',200);
    setTime('.j-i28',img+'/j-i28.png','fly-i',300);
    setTime('.j-i30',img+'/j-i30.png','fly-j',800);
    setTime('.j-i31',img+'/j-i31.png','fly-k',50);
    setTime('.j-i32',img+'/j-i32.png','fly-l',150);
}

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

function joeAni() {
    $(".j-fir-joe").animate({'margin-left':'-100%'},function () {
        setTime('.j-joe02',img+'/j-joe02.png','tab-scroll aniInRight',500);
        setTimeout('hideSec()',1000);

    });
    $(".j-sec-joe").hide();
}
function hideSec() {
    $(".j-drop").hide();
    $(".j-top-b").animate({'top':'-100%'},function () {
        loadingThird();
    })
}
function joeAniThird() {
    $(".j-third-joe").animate({'margin-left':'-100%'},function () {
        setTime('.j-joe01-d',img+'/j-joe03.png','tab-scroll aniInRight',200);
        setTimeout('hideThird()',100);
    });

}
function hideThird() {
    $(".j-top-c").animate({'top':'-100%'},function () {
        loadingFive();
    })
}


var joeCake = document.getElementById("joeCake");
var joeCar = document.getElementById("joeCar");
var joeCham = document.getElementById("joeCham");


var  startX, startY;
// touch start listener
function touchStart(event) {
    $(".j-i12").hide();
    event.preventDefault();
    var touch = event.touches[0];
    startX = touch.pageX;
    startY = touch.pageY;
    joeCar.removeEventListener("touchstart", touchStartCar, false);
    joeCar.removeEventListener("touchmove", touchMoveCar, false);
    joeCar.removeEventListener("touchend", touchEndCar, false);
    joeCham.removeEventListener("touchstart", touchStartCham, false);
    joeCham.removeEventListener("touchmove", touchMoveCham, false);
    joeCham.removeEventListener("touchend", touchEndCham, false);
}
// touch move listener
function touchMove(event) {
    event.preventDefault();
    var touch = event.touches[0];
    var x = touch.pageX - startX;
    var y = touch.pageY - startY;
    joeCake.style.webkitTransform = 'translate(' + x + 'px, ' + y + 'px)';
}
// touch end listener
function touchEnd(event) {
    if (!joeCake) return;
    rose();
    joeCake.style.display="none";
    joeCake.style.webkitTransform ='';
    setTimeout("$('.j-rose').hide()",10000);
    // $(".j-i09").addClass("tab-scroll-b giftLager");
    joeCake.style.display="none";
    joeCake.style.webkitTransform ='';
    // setTimeout('$(".j-i09").hide().removeClass("tab-scroll-b giftLager"); joeCake.style.display="none"; joeCake.style.webkitTransform ="";',3000);
    setTimeout('$(".j-i09").show();',500);
    setTimeout("joeAni();$('body').height('100%');",11000);
}
// add touch start listener
joeCake.addEventListener("touchstart", touchStart, false);
joeCake.addEventListener("touchmove", touchMove, false);
joeCake.addEventListener("touchend", touchEnd, false);



function touchStartCar(event) {
    $(".j-i12").hide();
    event.preventDefault();
    var touch = event.touches[0];
    startX = touch.pageX;
    startY = touch.pageY;
    joeCake.removeEventListener("touchstart", touchStart, false);
    joeCake.removeEventListener("touchmove", touchMove, false);
    joeCake.removeEventListener("touchend", touchEnd, false);
    joeCham.removeEventListener("touchstart", touchStartCham, false);
    joeCham.removeEventListener("touchmove", touchMoveCham, false);
    joeCham.removeEventListener("touchend", touchEndCham, false);
}
// touch move listener
function touchMoveCar(event) {
    event.preventDefault();
    var touch = event.touches[0];
    var x = touch.pageX - startX;
    var y = touch.pageY - startY;
    joeCar.style.webkitTransform = 'translate(' + x + 'px, ' + y + 'px)';
}
// touch end listener
function touchEndCar(event) {
    if (!joeCar) return;
    $('.gif-car').show();
    joeCar.style.display="none";
    joeCar.style.webkitTransform ='';
    setTimeout('$(".j-i10").show();',500);
    setTimeout('$(".gif-car").hide();',4500);
    setTimeout("joeAni()",5000);
}
// add touch start listener
joeCar.addEventListener("touchstart", touchStartCar, false);
joeCar.addEventListener("touchmove", touchMoveCar, false);
joeCar.addEventListener("touchend", touchEndCar, false);


function touchStartCham(event) {
    $(".j-i12").hide();
    event.preventDefault();
    var touch = event.touches[0];
    startX = touch.pageX;
    startY = touch.pageY;
    joeCake.removeEventListener("touchstart", touchStart, false);
    joeCake.removeEventListener("touchmove", touchMove, false);
    joeCake.removeEventListener("touchend", touchEnd, false);
    joeCar.removeEventListener("touchstart", touchStartCar, false);
    joeCar.removeEventListener("touchmove", touchMoveCar, false);
    joeCar.removeEventListener("touchend", touchEndCar, false);
}
// touch move listener
function touchMoveCham(event) {
    event.preventDefault();
    var touch = event.touches[0];
    var x = touch.pageX - startX;
    var y = touch.pageY - startY;
    joeCham.style.webkitTransform = 'translate(' + x + 'px, ' + y + 'px)';
}
// touch end listener
function touchEndCham(event) {
    if (!joeCar) return;
    $('.gif-cham').show();
    joeCham.style.display="none";
    joeCham.style.webkitTransform ='';
    setTimeout('$(".j-i11").show();',500);
    setTimeout('$(".gif-cham").hide();',6500);
    setTimeout("joeAni()",7000);
}
// add touch start listener
joeCham.addEventListener("touchstart", touchStartCham, false);
joeCham.addEventListener("touchmove", touchMoveCham, false);
joeCham.addEventListener("touchend", touchEndCham, false);