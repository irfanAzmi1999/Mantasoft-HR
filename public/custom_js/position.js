var t = $(".table-position").DataTable({
    ajax: window.location.origin + "/getPositions",
    columns: [{ data: null }, { data: "department_id" }, { data: "name" }, { data: "action" }],
    pageLength: 25,
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

$(document).on("click", "#newPosition", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#department_id, #position_name").val("");
    $("#nameError, #departmentError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var department_id = $("#department_id").val();
    var position_name = $("#position_name").val();
    if (department_id == null) {
        $("#department_id").focus();
        $("#departmentError").attr("style", "display: unset");
        return false;
    } else {
        $("#department_id").blur();
        $("#departmentError").attr("style", "display: none");
    }
    if (position_name == "" || typeof position_name == undefined) {
        $("#position_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#position_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("department_id", department_id);
    postdata.append("position_name", position_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + position_name + '" to positions list?',
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
                url: window.location.origin + "/createPosition",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + position_name + '" position has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            });
                    }, 2000);
                    $("#department_id").val("").trigger("change");
                    $("#position_name").val("");
                    $("#nameError, #departmentError").attr("style", "display: none");
                    $(".table-position").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_position = $(this).attr("data-id");
    $("#position_id").val(id_position);
    var postdata = new FormData();
    postdata.append("id_position", id_position);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editPosition",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #departmentError").attr("style", "display: none");
            $("#department_id").val(data.data.department_id).trigger("change");
            $("#position_name").val(data.data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_position = $("#position_id").val();
    var department_id = $("#department_id").val();
    var position_name = $("#position_name").val();
    if (department_id == null) {
        $("#department_id").focus();
        $("#departmentError").attr("style", "display: unset");
        return false;
    } else {
        $("#department_id").blur();
        $("#departmentError").attr("style", "display: none");
    }
    if (position_name == "" || typeof position_name == undefined) {
        $("#position_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#position_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_position", id_position);
    postdata.append("department_id", department_id);
    postdata.append("position_name", position_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + position_name + '" position?',
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
                url: window.location.origin + "/updatePosition",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + position_name + '" position has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#department_id").val("").trigger("change");
                    $("#position_name").val("");
                    $("#nameError, #departmentError").attr("style", "display: none");
                    $(".table-position").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_position = $(this).attr("data-id");
    $("#position_id").val(id_position);
    var postdata = new FormData();
    postdata.append("id_position", id_position);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editPosition",
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
    var id_position = $("#position_id").val();
    var postdata = new FormData();
    postdata.append("id_position", id_position);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeletePosition",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Position has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#position_id, #name").val("");
            $(".table-position").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#position_id, #position_name, #name").val("");
    $("#department_id").val("").trigger("change");
    $("#nameError, #departmentError").attr("style", "display: none");
    $(".table-position").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
