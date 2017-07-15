$(function () {
    window.onload=function () {
        setTime(".m-x-i01",img + "/x-bg.jpg","",10);
        setTime(".m-x-i11",img + "/x-11.png","",50);
        setTime(".m-x-i12",img + "/x-12.png","",300);
        setTime(".m-x-i10",img + "/x-10.png","",500);
        setTime(".m-x-01",img + "/x-01.png","",800);
        setTime(".m-tab1",img + "/tab1.png","",820);
        setTime(".m-tab2",img + "/tab2.png","",820);
        setTimeout('$(".m-bot-c").show()',550);
        setTimeout('$(".b-list-top").show()',850);
        setTimeout('$(".b-pager").show()',850);
    };

});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
