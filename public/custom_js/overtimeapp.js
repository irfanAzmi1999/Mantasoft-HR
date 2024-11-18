$(document).on("click", "#post_ot", function () {
    var date = $("#date").val();
    var time_in = $("#time_in").val();
    var time_out = $("#time_out").val();
    var location = $("#location").val();

    if (date == "" || typeof date == undefined) {
        $("#date").focus();
        $("#startError").attr("style", "display: unset");
        return false;
    } else {
        $("#date").blur();
        $("#startError").attr("style", "display: none");
    }
    if (time_in == "" || typeof time_in == undefined) {
        $("#time_in").focus();
        $("#endError").attr("style", "display: unset");
        return false;
    } else {
        $("#time_in").blur();
        $("#endError").attr("style", "display: none");
    }
    if (time_out == "" || typeof time_out == undefined) {
        $("#time_out").focus();
        $("#endError").attr("style", "display: unset");
        return false;
    } else {
        $("#time_out").blur();
        $("#endError").attr("style", "display: none");
    }
    if (location == "" || typeof location == undefined) {
        $("#location").focus();
        $("#endError").attr("style", "display: unset");
        return false;
    } else {
        $("#location").blur();
        $("#endError").attr("style", "display: none");
    }
});
