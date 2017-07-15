$(function () {
    window.onload=function () {
        setTimeout('$(".h5-i01").attr("src",a+"/y01.png")',10);
        setTimeout('$(".h5-i04").attr("src",a+"/y04.png").addClass("tab-scroll")',800);
        setTimeout('$(".h5-i09").attr("src",a+"/y09.png").addClass("tab-scroll")',1800);
        setTimeout('$(".h5-i10").attr("src",a+"/y10.png").addClass("tab-scroll")',1800);
        setTimeout('$(".h5-i02").attr("src",a+"/y02.png");$(".h5-h01").addClass("tab-scroll");',1000);
        setTimeout('$(".h5-i03").attr("src",a+"/y03.png");$(".h5-i03").addClass("tab-scroll");',10);
    };
    $(window).scroll(function () {
        var cWidth = document.body.clientWidth;
        var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
        if(cWidth>370){
            if(scrollTop>480){
                getInA();
            }
        }
        if(cWidth>300){
            if(scrollTop>300){
                getInA();
            }
        }
    });
});
function getInA() {
    setTimeout('$(".h5-i07").attr("src",a+"/y07.png");$(".h5-i07").addClass("tab-scroll");',100);
    setTimeout('$(".h5-i08").attr("src",a+"/y08.png");$(".h5-i08").addClass("tab-scroll");',100);
}