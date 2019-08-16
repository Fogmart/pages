$(document).ready(function () {

    $("#table tr").not(":first").each(function(){
        var dt = $(this).find("td").eq(3).html()
        dt = dt.split(".")
        if (dt[0].length==1) dt[0] = "0"+dt[0]
        if (dt[1].length==1) dt[1] = "0"+dt[1]
        $(this).attr("d", (dt[0]) )
        $(this).attr("m", (dt[1]) )
    });

    var sm,sd
    var cd = new Date ()
    var curday = cd.getDate(), curmonth = cd.getMonth()+1

    for (m = 1; m <= 12; m++) {
        sm = m<10? '0'+m : m
        if (curmonth == m){

            for (d = curday; d <= 31; d++) {
                sd = d<10? '0'+d : d
                $("#table").append($("[d="+sd+"][m="+sm+"]"))
            }
            for (d = 1; d < curday; d++) {
                sd = d<10? '0'+d : d
                $("#table").append($("[d="+sd+"][m="+sm+"]"))
            }
        } else {
            for (d = 1; d <= 31; d++) {
                sd = d<10? '0'+d : d
                $("#table").append($("[d="+sd+"][m="+sm+"]"))
            }
        }
    }

})
