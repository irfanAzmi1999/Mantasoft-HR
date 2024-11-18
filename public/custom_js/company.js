var t = $(".table-companies").DataTable({
    ajax: window.location.origin + "/getCompany",
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

$(document).on("click", "#newCompany", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#Companies_name").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var companyCont = $("#Companies_name").val();
    if (companyCont == "" || typeof companyCont == undefined) {
        $("#Companies_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#Companies_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("companyCont", companyCont);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + companyCont + '" to companies list?',
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
                url: window.location.origin + "/createCompany",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + companyCont + '" company has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#Companies_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-companies").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var contCompany_id = $(this).attr("data-id");
    $("#company_id").val(contCompany_id);
    var postdata = new FormData();
    postdata.append("contCompany_id", contCompany_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editCompany",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#Companies_name").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var contCompany_id = $("#company_id").val();
    var companyCont = $("#Companies_name").val();
    if (companyCont == "" || typeof companyCont == undefined) {
        $("#Companies_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#Companies_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("contCompany_id", contCompany_id);
    postdata.append("companyCont", companyCont);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + companyCont + '" company?',
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
                url: window.location.origin + "/updateCompany",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + companyCont + '" company has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#Companies_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".table-companies").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var contCompany_id = $(this).attr("data-id");
    $("#company_id").val(contCompany_id);
    var postdata = new FormData();
    postdata.append("contCompany_id", contCompany_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editCompany",
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
    var contCompany_id = $("#company_id").val();
    var postdata = new FormData();
    postdata.append("contCompany_id", contCompany_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteCompany",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Company has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#company_id, #name").val("");
            $(".table-companies").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#company_id, #Companies_name, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".table-companies").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
