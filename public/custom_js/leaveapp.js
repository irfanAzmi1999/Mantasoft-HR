function check() {
    var leavetype_id = $("#leavetype_id").val();
    if (leavetype_id != null) {
        $("#start_date, #end_date").attr("required", true);
    }
    if (leavetype_id == 3) {
        $("#emer").attr("style", "display: unset");
        $("#leave").attr("class", "col-12 col-sm-6 mb-1 mb-sm-0");
        $("#emergencytype_id").attr("required", true);
    } else {
        $("#emer").attr("style", "display: none");
        $("#leave").attr("class", "col-12 col-sm-12 mb-1 mb-sm-0");
        $("#emergencytype_id").val("").trigger("change");
        $("#emergencytype_id").attr("required", false);
    }
    if (leavetype_id == 3 || leavetype_id == 5 || leavetype_id == 6 || leavetype_id == 7) {
        $("#attachments").attr("required", true);
    } else {
        $("#attachments").attr("required", false);
    }
}

$(document).on("click", "#post_add", function () {
    var leavetype_id = $("#leavetype_id").val();
    var emergencytype_id = $("#emergencytype_id").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    //var date_leave = $("#date_leave").val();
    var staff_remarks = $("#staff_remarks").val();
    var attachments = $("#attachments").val();
    if (leavetype_id == null) {
        $("#leavetype_id").focus();
        $("#leaveTypeError").attr("style", "display: unset");
        return false;
    } else {
        $("#leavetype_id").blur();
        $("#leaveTypeError").attr("style", "display: none");
    }
    if (leavetype_id == 3 && emergencytype_id == null) {
        $("#emergencytype_id").focus();
        $("#emergencyTypeError").attr("style", "display: unset");
        return false;
    } else {
        $("#emergencytype_id").blur();
        $("#emergencyTypeError").attr("style", "display: none");
    }
    if (start_date == "" || typeof start_date == undefined) {
        $("#start_date").focus();
        $("#startError").attr("style", "display: unset");
        return false;
    } else {
        $("#start_date").blur();
        $("#startError").attr("style", "display: none");
    }
    if (end_date == "" || typeof end_date == undefined) {
        $("#end_date").focus();
        $("#endError").attr("style", "display: unset");
        return false;
    } else {
        $("#end_date").blur();
        $("#endError").attr("style", "display: none");
    }

    if (staff_remarks == "" || typeof staff_remarks == undefined) {
        $("#staff_remarks").focus();
        $("#remarksError").attr("style", "display: unset");
        return false;
    } else {
        $("#staff_remarks").blur();
        $("#remarksError").attr("style", "display: unset");
    }
    if (attachments == "" || typeof attachments == undefined) {
        $("#attachments").focus();
        $("#attachError").attr("style", "display: unset");
        return false;
    } else {
        $("#attachments").blur();
        $("#attachError").attr("style", "display: unset");
    }
});

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

$("input").bind('change',function () {
    let start_date = $("#start_date").val();

    let end_date = $("#end_date").val(); 

     if ((start_date === end_date)) {
        return $("#date_leave").val(1);
    }

    if ((start_date == "") || (end_date == "")) {
        return $("#date_leave").val(0);
    }
    
    let dt1 = new Date(start_date)
    let dt2 = new Date(end_date)

    var time_difference = dt2.getTime() - dt1.getTime();
    var result = time_difference / (1000 * 60 * 60 * 24);
 
    $("#date_leave").val(result + 1);
 });


