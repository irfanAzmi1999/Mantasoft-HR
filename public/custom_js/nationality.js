var t = $(".nationalities-table").DataTable({
    ajax: window.location.origin + "/getNationality",
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

$(document).on("click", "#registerNationality", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#nationalityName").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var nationalityName = $("#nationalityName").val();
    if (nationalityName == "" || typeof nationalityName == undefined) {
        $("#nationalityName").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#nationalityName").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("nationalityName", nationalityName);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + nationalityName + '" to nationalities list?',
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
                url: window.location.origin + "/createNationality",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + nationalityName + '" nationality has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#nationalityName").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".nationalities-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var idUpdate_nat = $(this).attr("data-id");
    $("#idUpdate_nat").val(idUpdate_nat);
    var postdata = new FormData();
    postdata.append("idUpdate_nat", idUpdate_nat);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editNationality",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#nationalityName").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var idUpdate_nat = $("#idUpdate_nat").val();
    var nationalityName = $("#nationalityName").val();
    if (nationalityName == "" || typeof nationalityName == undefined) {
        $("#nationalityName").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#nationalityName").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("idUpdate_nat", idUpdate_nat);
    postdata.append("name", nationalityName);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + nationalityName + '" nationality?',
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
                url: window.location.origin + "/updateNationality",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + nationalityName + '" nationality has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#nationalityName").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".nationalities-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var idUpdate_nat = $(this).attr("data-id");
    $("#idUpdate_nat").val(idUpdate_nat);
    var postdata = new FormData();
    postdata.append("idUpdate_nat", idUpdate_nat);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editNationality",
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
    var idUpdate_nat = $("#idUpdate_nat").val();
    var postdata = new FormData();
    postdata.append("idUpdate_nat", idUpdate_nat);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteNat",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Nationality has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#idUpdate_nat, #name").val("");
            $(".nationalities-table").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#idUpdate_nat, #nationalityName, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".nationalities-table").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
