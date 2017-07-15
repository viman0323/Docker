$(function () {
    window.onload=function () {
        setTime(".s-j01",img + "/s-i01.jpg","",10);
        setTime(".s-i01",img + "/s-i01.png","",10);
        setTime(".s-i06",img + "/s-i06.png","",10);
        setTime(".s-i07",img + "/s-i07.png","",10);
        setTime(".s-i08",img + "/s-i08.png","",10);
        setTime(".s-i09",img + "/s-i09.png","",10);
        setTime(".s-i10",img + "/s-i10.png","",10);
        setTimeout('$(".s-d").show()',10);
        setTimeout('$(".s-l").show()',10);
    };
});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
