$(document).ready(function () {

    $("#table tr").not(":first").each(function(){
        var dt = $(this).find("td").eq(3).html()
        dt = dt.split(".")
        if (dt[0].length==1) dt[0] = "0"+dt[0]
        $(this).attr("d", (dt[0]) )
    });

    var sm,sd
    var cd = new Date ()
    var curday = cd.getDate()

    for (d = curday; d <= 31; d++) {
        sd = d<10? '0'+d : d
        $("#table").append($("[d="+sd+"]"))
    }
    for (d = 1; d < curday; d++) {
        sd = d<10? '0'+d : d
        $("#table").append($("[d="+sd+"]"))
    }


})
