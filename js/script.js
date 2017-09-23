$(document).ready(function(){

    $("#HSD_LTR, #HSD_PER_LTR").keyup(function(){

        var Total = $("#HSD_LTR").val() * $("#HSD_PER_LTR").val();
        document.getElementById("HSD-Total").innerHTML = Total ;
    });

});