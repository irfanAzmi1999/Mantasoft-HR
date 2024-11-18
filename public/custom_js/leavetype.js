var t = $(".table-LeaveType").DataTable({
    ajax: window.location.origin + "/getLeaveType",
    columns: [
        {data: null},
        {data: "name"},
        {data: "limit"},
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

$(document).on("click", "#newLeaveType", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#leavetype_name, #limit").val("");
    $("#nameError, #limitError, #limitZero").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var leavetype_name = $("#leavetype_name").val();
    var limit = $("#limit").val();
    if (leavetype_name == "" || typeof leavetype_name == undefined) {
        $("#leavetype_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#leavetype_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (limit == "" || typeof limit == undefined) {
        $("#limit").focus();
        $("#limitError").attr("style", "display: unset");
        return false;
    } else {
        $("#limit").blur();
        $("#limitError").attr("style", "display: none");
    }
    if (limit < 0) {
        $("#limit").focus();
        $("#limitZero").attr("style", "display: unset");
        return false;
    } else {
        $("#limit").blur();
        $("#limitZero").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("leavetype_name", leavetype_name);
    postdata.append("limit", limit);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + leavetype_name + '" to leave types list?',
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
                url: window.location.origin + "/createLeaveType",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + leavetype_name + '" leave type has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#leavetype_name, #limit").val("");
                    $("#nameError, #limitError, #limitZero").attr("style", "display: none");
                    $(".table-LeaveType").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_leavetype = $(this).attr("data-id");
    $("#leavetype_id").val(id_leavetype);
    var postdata = new FormData();
    postdata.append("id_leavetype", id_leavetype);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editLeaveType",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #limitError, #limitZero").attr("style", "display: none");
            $("#leavetype_name").val(data.data.name);
            $("#limit").val(data.data.limit);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_leavetype = $("#leavetype_id").val();
    var leavetype_name = $("#leavetype_name").val();
    var limit = $("#limit").val();
    if (leavetype_name == "" || typeof leavetype_name == undefined) {
        $("#leavetype_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#leavetype_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (limit == "" || typeof limit == undefined) {
        $("#limit").focus();
        $("#limitError").attr("style", "display: unset");
        return false;
    } else {
        $("#limit").blur();
        $("#limitError").attr("style", "display: none");
    }
    if (limit < 0) {
        $("#limit").focus();
        $("#limitZero").attr("style", "display: unset");
        return false;
    } else {
        $("#limit").blur();
        $("#limitZero").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_leavetype", id_leavetype);
    postdata.append("leavetype_name", leavetype_name);
    postdata.append("limit", limit);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + leavetype_name + '" leave type?',
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
                url: window.location.origin + "/updateLeaveType",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + leavetype_name + '" leave type has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#leavetype_name, #limit").val("");
                    $("#nameError, #limitError, #limitZero").attr("style", "display: none");
                    $(".table-LeaveType").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_leavetype = $(this).attr("data-id");
    $("#leavetype_id").val(id_leavetype);
    var postdata = new FormData();
    postdata.append("id_leavetype", id_leavetype);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editLeaveType",
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
    var id_leavetype = $("#leavetype_id").val();
    var postdata = new FormData();
    postdata.append("id_leavetype", id_leavetype);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteLeaveType",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Leave type has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#leavetype_id, #name").val("");
            $(".table-LeaveType").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#leavetype_id, #leavetype_name, #limit, #name").val("");
    $("#nameError, #limitError, #limitZero").attr("style", "display: none");
    $(".table-LeaveType").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
