$(function () {
    window.onload=function () {
        setTime('.z-d-j01',img + '/z-d-j01.jpg','',5);
        setTime('.z-d-i01',img + '/z-d-i01.png','',5);
        setTime('.z-d-j02',img + '/z-d-j02.jpg','',5);
        setTime('.z-d-i03',img + '/z-d-i03.png','',5);
        setTime('.z-d-i04',img + '/z-d-i04.png','',5);

        setTime('.z-d-i05',img + '/z-d-i05.png','',10);
        setTime('.z-d-i06',img + '/z-d-i06.png','',10);
        setTime('.z-d-i07',img + '/z-d-i07.png','',10);
        setTime('.z-d-i08',img + '/z-d-i08.png','',10);
    }


});

function setTime(a,b,c,d) {
    setTimeout('$("'+a+'").attr("src","'+b+'").addClass("'+c+'")',d);
}
