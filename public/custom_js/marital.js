var t = $(".table-maritals").DataTable({
    ajax: window.location.origin + "/getMaritals",
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

$(document).on("click", "#newMarital", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#marital_name").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var marital_name = $("#marital_name").val();
    if (marital_name == "" || typeof marital_name == undefined) {
        $("#marital_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#marital_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("marital_name", marital_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + marital_name + '" to maritals list?',
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
                url: window.location.origin + "/createMarital",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + marital_name + '" marital has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#marital_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-maritals").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var idCont_maritals = $(this).attr("data-id");
    $("#maritals_id").val(idCont_maritals);
    var postdata = new FormData();
    postdata.append("idCont_maritals", idCont_maritals);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editMarital",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#marital_name").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var idCont_maritals = $("#maritals_id").val();
    var marital_name = $("#marital_name").val();
    if (marital_name == "" || typeof marital_name == undefined) {
        $("#marital_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#marital_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("idCont_maritals", idCont_maritals);
    postdata.append("name", marital_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + marital_name + '" marital?',
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
                url: window.location.origin + "/updateMarital",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + marital_name + '" marital has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#marital_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-maritals").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var idCont_maritals = $(this).attr("data-id");
    $("#maritals_id").val(idCont_maritals);
    var postdata = new FormData();
    postdata.append("idCont_maritals", idCont_maritals);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editMarital",
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
    var idCont_maritals = $("#maritals_id").val();
    var postdata = new FormData();
    postdata.append("idCont_maritals", idCont_maritals);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteMar",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Marital has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#maritals_id, #name").val("");
            $(".table-maritals").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#maritals_id, #marital_name, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".table-maritals").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
