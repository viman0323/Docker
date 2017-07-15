
$(function () {
    window.onload=function () {
        setTime('.f-i01',k + '/f-i01.png','',10);
        setTime('.f-i05',k + '/f-i05.png','tab-scroll aniBeat',100);
        setTime('.f-i02',k + '/f-i02.png','tab-scroll aniInBottom',300);
        setTime('.f-i03',k + '/f-i03.png','tab-scroll aniInTop',400);
        setTime('.f-i03',k + '/f-i03.png','tab-scroll aniInTop',400);
        setTimeout('$(".f-info").show()',450);
        setTime('.f-i04c',k + '/f-i04.png','',400);
        setTime('.f-i04a',k + '/f-i04a.png','',400);
        setTime('.f-i04b',k + '/f-i04b.png','',400);
        setTime('.f-i06',k + '/f-i06.png','',400);
        setTime('.f-i06a',k + '/f-i06a.png','',400);
        setTime('.f-i06b',k + '/f-i06b.png','',400);
        setTimeout('$(".s-bar-a").addClass("tab-scroll aniInLeft").show();',450);
        setTimeout('$(".s-bar-tit").addClass("tab-scroll aniInLeft").show();',500);
        setTimeout('$(".s-play").addClass("tab-scroll aniShow").show();',600);
        setTimeout('$(".f-footer").show();',600);

    }

    $(".s-play-a").on("click",function () {
        $((".s-mid-video video")).attr("id","");
        $(this).parent().parent().find(".s-mid-video video").attr("id","iMayVideo");
        var iMayPlay = document.getElementById("iMayVideo");
       iMayPlay.play();
        $(this).parent().hide();
        $(this).parent().parent().find(".s-mid-video video").addClass("s-video-s")
    });




});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}