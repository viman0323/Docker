$(function () {
    if (count < 2) {
        $(".h3-c1-b .h3-c1-c").eq(0).show();
    }
    setInterval("topScroll()",300);
    $(".h3-tab-c1:nth-child(1)").show();
    $(".h3-tab1-ul li").click(function () {
        $(this).parent().parent().parent().find(".h3-tab-con").children().hide();
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".h3-tab-con").children();
        $(this).parent().children().removeClass("h3-tab1-check");
        $(this).addClass("h3-tab1-check");
        obj.fadeOut();
        obj.eq(index).fadeIn();
    });
    //tab
    $(".h3-c1-ul .click_btn").click(function () {
        var index = $(this).parent().children().index($(this));
        var obj = $(this).parent().parent().find(".h3-c1-con").children(".h3-c1-b").children();
        $(".h3-c1-ul li").removeClass("h3-ul-checked");
        $(this).addClass("h3-ul-checked");
        //alert($(this).attr("yellow_gold"));
        $(".yellow_gold").html($(this).attr("yellow_gold"));
        $(".red_gold").html($(this).attr("red_gold"));
        obj.fadeOut();
        obj.eq(index).fadeIn();
    });
    //fly
    $("#getMount").click(function () {
        $(this).hide()
        setTimeout("$('.h3-lq').show()",200);
        $('.h3-chicken').addClass("bing");
        $('.h3-fly').show().addClass("bing");

    });
    $(".h3-t4-a01").click(function () {
        $(".h3-pop").show();
    });
    $(".h3-close").click(function () {
        $(this).parent().parent().hide();
    });
});
function addAni(a) {
    $(".h3-a-01").attr("src",a+"/h3-i01.png")
    $(".h3-j-i42").attr("src",a+"/h3-i42.png").addClass("tab-scroll");
    $(".h3-j-i01").attr("src",a+"/h3-i33.png").addClass("tab-scroll");
    $(".h3-p-i02").attr("src",a+"/h3-i02.png").addClass("tab-scroll");
    $(".h3-p-i03").attr("src",a+"/h3-i40.png").addClass("tab-scroll");
    $(".h3-p-i05").attr("src",a+"/h3-i05.png").addClass("tab-scroll");
    $(".h3-p-i06").attr("src",a+"/h3-i06.png").addClass("tab-scroll");
    $(".h3-p-i10").attr("src",a+"/h3-i08.png").addClass("tab-scroll");

    $(".h3-j-i34").attr("src",a+"/h3-i34.png").addClass("tab-scroll");
    $(".h3-p-i11").attr("src",a+"/h3-i11.png").addClass("tab-scroll");
    $(".h3-p-i27").attr("src",a+"/kuang.png").addClass("tab-scroll");
    $(".h3-j-i42").attr("src",a+"/h3-i42.png").addClass("tab-scroll");
    $(".h3-info1-t1").addClass("tab-scroll");
    $(".h3-info1-t2").addClass("tab-scroll");
    $(".h3-info2-c1").addClass("tab-scroll");
}

function getInA(a) {
    $(".h3-info3-ani").addClass("tab-scroll");
    $(".h3-p-i12").attr("src",a+"/h3-i12.png");
    $(".h3-p-i26").attr("src",a+"/h3-i12.png");
    $(".h3-p-i13").attr("src",a+"/h3-i13.png");
    $(".h3-p-i40").attr("src",a+"/h3-i40.png");
    $(".h3-p-i36").attr("src",a+"/h3-i36.png");
    // $(".h3-logo").attr("src",a+"/img01.jpg");
    $(".h3-p-i35").attr("src",a+"/h3-i35.png");
    $(".h3-p-i37").attr("src",a+"/h3-i37.png");
    $(".h3-p-i15").attr("src",a+"/h3-i15.png");
    $(".h3-p-i38").attr("src",a+"/h3-i38.png");
    $(".h3-p-i16").attr("src",a+"/h3-i16.png");
    $(".h3-p-i39").attr("src",a+"/h3-i39.png");
}
function getInB() {
    $(".h3-info4-ani").addClass("tab-scroll");
    var a = $(".h3-lq").attr("style");
    if(a==""){
        $('.h3-chicken').hide();
        $(".h3-p-i23").hide();
        $(".h3-lq").show();
    }
}
function topScroll() {
    var d = document.getElementById("h3Scroll").scrollWidth;
    var f = document.getElementById("h3NacSc").scrollWidth;
    var a = $('.h3-h-txt').attr("style");
    var b = a.substring(5);
    var c = b.replace("px;","");
    var e = c-20;
    $(".h3-h-txt").css("left", e +"px");
    if(d < 0-e){
       // alert()
        $(".h3-h-txt").css("left","100px");
    }

}
function clearA() {
    $(".h3-info3-ani").removeClass("tab-scroll");
}
function clearB() {
    $(".h3-info4-ani").removeClass("tab-scroll");
}


