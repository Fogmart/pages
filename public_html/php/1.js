
function prsDate(a){

    var x = new Date();

    x=x.setTime(a*1000);

    var d = {
        day: new Date(x).getDate(),
        month: new Date(x).getMonth(),
        year: new Date(x).getFullYear(),
        hour: new Date(x).getHours(),
        minute: new Date(x).getMinutes(),
        second: new Date(x).getSeconds()
    }
    var D = {};
    for (var n in d) {
        D[n] = (parseInt(d[n], 10) < 10 ) ? ('0'+d[n]) : (d[n]);

        //D[n] = parseFloat(d[n]);

    }


    var z = D.day + '.' + D.month + '.' + String(D.year).substr(2,2);
    // z = /*z + ' ' +*/ D.hour /*+ ':' + D.minute*/;
    return z;
}

function msParse(a){ // парсинг даты из datePicker
    b=a.split("-");
    b=new Date(b[0], parseFloat(b[1])-1,b[2]);
    return (b.getTime())/1000;}

$("table tr").not(":first").each(function(){
    $(this).find("td").eq(3).text(prsDate($(this).find("td").eq(3).text()));
});

