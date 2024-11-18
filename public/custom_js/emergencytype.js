var t = $(".table-emergencyType").DataTable({
    ajax: window.location.origin + "/getEmergencyType",
    columns: [
        {data: null},
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

$(document).on("click", "#newEmergencyType", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#emergencytype_name").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var emergencytype_name = $("#emergencytype_name").val();
    if (emergencytype_name == "" || typeof emergencytype_name == undefined) {
        $("#emergencytype_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#emergencytype_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("emergencytype_name", emergencytype_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + emergencytype_name + '" to emergency types list?',
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
                url: window.location.origin + "/createEmergencyType",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + emergencytype_name + '" emergency type has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#emergencytype_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-emergencyType").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_emergencytype = $(this).attr("data-id");
    $("#emergencytype_id").val(id_emergencytype);
    var postdata = new FormData();
    postdata.append("id_emergencytype", id_emergencytype);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editEmergencyType",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#emergencytype_name").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_emergencytype = $("#emergencytype_id").val();
    var emergencytype_name = $("#emergencytype_name").val();
    if (emergencytype_name == "" || typeof emergencytype_name == undefined) {
        $("#emergencytype_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#emergencytype_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_emergencytype", id_emergencytype);
    postdata.append("emergencytype_name", emergencytype_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + emergencytype_name + '" emergency type?',
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
                url: window.location.origin + "/updateEmergencyType",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + emergencytype_name + '" emergency type has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#emergencytype_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-emergencyType").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_emergencytype = $(this).attr("data-id");
    $("#emergencytype_id").val(id_emergencytype);
    var postdata = new FormData();
    postdata.append("id_emergencytype", id_emergencytype);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editEmergencyType",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            document.getElementById("name").innerHTML = data.name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var id_emergencytype = $("#emergencytype_id").val();
    var postdata = new FormData();
    postdata.append("id_emergencytype", id_emergencytype);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteEmergencyType",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Emergency type has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#emergencytype_id, #name").val("");
            $(".table-emergencyType").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#emergencytype_id, #emergencytype_name, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".table-categories").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
