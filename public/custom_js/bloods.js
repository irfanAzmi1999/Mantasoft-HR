var t = $(".Bloods-table").DataTable({
    ajax: window.location.origin + "/getBloods",
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

$(document).on("click", "#newBlood", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#bloodType").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var bloodType = $("#bloodType").val();
    if (bloodType == "" || typeof bloodType == undefined) {
        $("#bloodType").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#bloodType").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("bloodType", bloodType);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + bloodType + '" to blood types list?',
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
                url: window.location.origin + "/createBlood",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + bloodType + '" blood type has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#bloodType").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".Bloods-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var idUpdate_bloods = $(this).attr("data-id");
    $("#idUpdate_bloods").val(idUpdate_bloods);
    var postdata = new FormData();
    postdata.append("idUpdate_bloods", idUpdate_bloods);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editBlood",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#bloodType").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var idUpdate_bloods = $("#idUpdate_bloods").val();
    var bloodType = $("#bloodType").val();
    if (bloodType == "" || typeof bloodType == undefined) {
        $("#bloodType").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#bloodType").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("idUpdate_bloods", idUpdate_bloods);
    postdata.append("name", bloodType);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + bloodType + '" blood type?',
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
                url: window.location.origin + "/updateBlood",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + bloodType + '" blood type has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#bloodType").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".Bloods-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var idUpdate_bloods = $(this).attr("data-id");
    $("#idUpdate_bloods").val(idUpdate_bloods);
    var postdata = new FormData();
    postdata.append("idUpdate_bloods", idUpdate_bloods);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editBlood",
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
    var idUpdate_bloods = $("#idUpdate_bloods").val();
    var postdata = new FormData();
    postdata.append("idUpdate_bloods", idUpdate_bloods);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteBlood",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Blood type has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#idUpdate_bloods, #name").val("");
            $(".Bloods-table").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#idUpdate_bloods, #bloodType, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".Bloods-table").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
