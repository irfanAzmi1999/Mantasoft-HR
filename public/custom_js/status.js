var t = $(".table-statuses").DataTable({
    ajax: window.location.origin + "/getStatus",
    columns: [
        {data: null},
        {data: "category_id"},
        {data: "name"},
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

$(document).on("click", "#newStatus", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#status_name, #category_id").val("");
    $("#nameError, #categoryError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var category_id = $("#category_id").val();
    var status_name = $("#status_name").val();
    if (category_id == null) {
        $("#category_id").focus();
        $("#categoryError").attr("style", "display: unset");
        return false;
    } else {
        $("#category_id").blur();
        $("#categoryError").attr("style", "display: none");
    }
    if (status_name == "" || typeof status_name == undefined) {
        $("#status_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#status_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("category_id", category_id);
    postdata.append("status_name", status_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + status_name + '" to statuses list?',
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
                url: window.location.origin + "/createStatus",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + status_name + '" status has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#status_name").val("");
                    $("#category_id").val("").trigger("change");
                    $("#nameError, #categoryError").attr("style", "display: none");
                    $(".table-statuses").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_status = $(this).attr("data-id");
    $("#status_id").val(id_status);
    var postdata = new FormData();
    postdata.append("id_status", id_status);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editStatus",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #categoryError").attr("style", "display: none");
            $("#category_id").val(data.data.category_id).trigger("change");
            $("#status_name").val(data.data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_status = $("#status_id").val();
    var status_name = $("#status_name").val();
    if (category_id == null) {
        $("#category_id").focus();
        $("#categoryError").attr("style", "display: unset");
        return false;
    } else {
        $("#category_id").blur();
        $("#categoryError").attr("style", "display: none");
    }
    if (status_name == "" || typeof status_name == undefined) {
        $("#status_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#status_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_status", id_status);
    postdata.append("category_id", category_id);
    postdata.append("status_name", status_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + status_name + '" status?',
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
                url: window.location.origin + "/updateStatus",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + status_name + '" status has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#category_id").val("").trigger("change");
                    $("#status_name").val("");
                    $("#nameError, #categoryError").attr("style", "display: none");
                    $(".table-statuses").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_status = $(this).attr("data-id");
    $("#status_id").val(id_status);
    var postdata = new FormData();
    postdata.append("id_status", id_status);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editStatus",
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
    var id_status = $("#status_id").val();
    var postdata = new FormData();
    postdata.append("id_status", id_status);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteStatus",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Status has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#status_id, #name").val("");
            $(".table-statuses").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#status_id, #status_name, #name").val("");
    $("#category_id").val("").trigger("change");
    $("#nameError, #categoryError").attr("style", "display: none");
    $(".table-statuses").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
