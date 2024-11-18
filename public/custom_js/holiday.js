var t = $(".table-holidays").DataTable({
    ajax: window.location.origin + "/getHolidays",
    columns: [
        {data: null},
        {data: "name"},
        {data: "start_date"},
        {data: "end_date"},
        {data: "order_in_year"},
        {data: "action"}
    ],
    pageLength: 25
});
t.on("order.dt search.dt", function () {
    t.column(0, {
        search: "applied",
        order: "applied"
    })
    .nodes().each(function (cell, i) {
        cell.innerHTML = i + 1;
    });
}).draw();

$(document).on("click", "#newHoliday", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#holiday_name, #start_date, #end_date").val("");
    $("#nameError, #startError, #endError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var holiday_name = $("#holiday_name").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    if (holiday_name == "" || typeof holiday_name == undefined) {
        $("#holiday_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#holiday_name").blur();
        $("#nameError").attr("style", "display: none");
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
    var postdata = new FormData();
    postdata.append("holiday_name", holiday_name);
    postdata.append("start_date", start_date);
    postdata.append("end_date", end_date);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + holiday_name + '" to public holidays list?',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.location.origin + "/createHoliday",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + holiday_name + '" public holiday has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#holiday_name, #start_date, #end_date").val("");
                    $("#nameError, #startError, #endError").attr("style", "display: none");
                    $(".table-holidays").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_holiday = $(this).attr("data-id");
    $("#holiday_id").val(id_holiday);
    var postdata = new FormData();
    postdata.append("id_holiday", id_holiday);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editHoliday",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #startError, #endError").attr("style", "display: none");
            $("#holiday_name").val(data.data.name);
            $("#start_date").val(data.data.start_date);
            $("#end_date").val(data.data.end_date);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_holiday = $("#holiday_id").val();
    var holiday_name = $("#holiday_name").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    if (holiday_name == "" || typeof holiday_name == undefined) {
        $("#holiday_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#holiday_name").blur();
        $("#nameError").attr("style", "display: none");
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
    var postdata = new FormData();
    postdata.append("id_holiday", id_holiday);
    postdata.append("holiday_name", holiday_name);
    postdata.append("start_date", start_date);
    postdata.append("end_date", end_date);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + holiday_name + '" public holiday?',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.location.origin + "/updateHoliday",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + holiday_name + '" public holiday has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#holiday_name, #start_date, #end_date").val("");
                    $("#nameError, #startError, #endError").attr("style", "display: none");
                    $(".table-holidays").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_holiday = $(this).attr("data-id");
    $("#holiday_id").val(id_holiday);
    var postdata = new FormData();
    postdata.append("id_holiday", id_holiday);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editHoliday",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            document.getElementById("name").innerHTML = data.data.name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var id_holiday = $("#holiday_id").val();
    var postdata = new FormData();
    postdata.append("id_holiday", id_holiday);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteHoliday",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Public holiday has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#holiday_id, #name").val("");
            $(".table-holidays").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#holiday_id, #holiday_name, #start_date, #end_date, #name").val("");
    $("#nameError, #startError, #endError").attr("style", "display: none");
    $(".table-holidays").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
