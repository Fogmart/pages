$(document).ready(function () {
    var i=0
    while (i<30){
        $("table").append(
            $("<tr>")
                .append($("<td>").html(i))
                .append($("<td>").html( "Test"))
                .append($("<td>").html(Math.floor(Math.random() * (100) + 500)))
                .append($("<td>").html(
                    ""+
                    Math.floor(Math.random() * (29) + 1)+".0"+
                    Math.floor(Math.random() * (9) + 1)+"."+
                    "19"
                ))
        )
        i++
    }
    console.log($("table").html())
})