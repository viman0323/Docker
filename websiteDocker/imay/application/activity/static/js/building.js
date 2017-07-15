$(function () {
    $(".b-close").click(function () {
        $(".b-m-con").hide();
    });
    $(".b-pop-b").click(function () {
        $(".b-m-con").hide();
    });
    window.onload=function () {
        setTime(".b-m-j01",img + "/m-j01.jpg","",100);
        setTime(".b-m-i08",img + "/m-i08.png","",300);
        setTime(".b-m-i13",img + "/m-i13.png","",400);
        setTime(".b_01",img + "/b_01.png","",400);
        setTime(".b_02",img + "/b_02.png","",400);
        setTime(".b_03",img + "/b_03.png","",400);
        setTime(".b_04",img + "/b_04.png","",400);
        setTime(".b_05",img + "/b_05.png","",400);
        setTimeout('$(".b-con").show()',400);
        setTimeout('$(".nav-info").show()',200);
    };
    $(".b-top-ul li").click(function () {
        var index =$(this).parent().children().index($(this));
        var obj = $(this).parent().parent().parent().find(".b-c-list").children();
        $(".b-top-ul li").removeClass("b-checked");
        $(this).addClass("b-checked");
        obj.hide();
        obj.eq(index).show();
    })

});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}

// 周时间倒数
function ShowWeekCountDown(year,month,day,divname)
{
    var now = new Date();
    var endDate = new Date(year, month, day);
    var leftTime=endDate.getTime()-now.getTime();
    var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10);//计算剩余的天数
    var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);//计算剩余的小时数
    var mm = parseInt(leftTime / 1000 / 60 % 60, 10);//计算剩余的分钟数
    var ss = parseInt(leftTime / 1000 % 60, 10);//计算剩余的秒数
    dd = checkTime(dd);
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss);//小于10的话加0
    var cc = document.getElementById(divname);
    cc.innerHTML = dd + "天" + hh + ":" + mm + ":" + ss;
}

// 一天时间倒数
function ShowCountDown(year,month,day,divname)
{
    var now = new Date();
    var endDate = new Date(year, month, day);
    var leftTime=endDate.getTime()-now.getTime();
    var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);//计算剩余的小时数
    var mm = parseInt(leftTime / 1000 / 60 % 60, 10);//计算剩余的分钟数
    var ss = parseInt(leftTime / 1000 % 60, 10);//计算剩余的秒数
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss);//小于10的话加0
    var cc = document.getElementById(divname);
    cc.innerHTML = hh + ":" + mm + ":" + ss;
}
function checkTime(i)
{
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

// 当盖楼卡过期时间不足一小时时，弹出提示
function showTip(type) {
    var date = new Date();
    if (date.getHours() != 23) {
        setInterval("showTip(type)",1000);
    } else {
        $(".b-m-con").show();
    }
}
