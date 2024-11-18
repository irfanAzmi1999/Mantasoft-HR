var t = $(".relation-table").DataTable({
    ajax: window.location.origin + "/get-relation",
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

$(document).on("click", "#newRelations", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#relations_name").val("");
    $("#nameError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var contRel_name = $("#relations_name").val();
    if (contRel_name == "" || typeof contRel_name == undefined) {
        $("#relations_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#relations_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("contRel_name", contRel_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + contRel_name + '" to relations list?',
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
                url: window.location.origin + "/createRelation",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + contRel_name + '" relation has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#relations_name").val("");
                    $("#nameError").attr("style", "display: none");
                    $(".relation-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var contRelation_id = $(this).attr("data-id");
    $("#relations_id").val(contRelation_id);
    var postdata = new FormData();
    postdata.append("contRelation_id", contRelation_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/updateRelations",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError").attr("style", "display: none");
            $("#relations_name").val(data.name);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var contRelation_id = $("#relations_id").val();
    var contRel_name = $("#relations_name").val();
    if (contRel_name == "" || typeof contRel_name == undefined) {
        $("#relations_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#relations_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("contRelation_id", contRelation_id);
    postdata.append("contRel_name", contRel_name);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + contRel_name + '" relation?',
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
                url: window.location.origin + "/updateRelationData",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + contRel_name + '" relation has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#relations_name").val();
                    $("#nameError").attr("style", "display: none");
                    $(".relation-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var contRelation_id = $(this).attr("data-id");
    $("#relations_id").val(contRelation_id);
    var postdata = new FormData();
    postdata.append("contRelation_id", contRelation_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/updateRelations",
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
    var contRelation_id = $("#relations_id").val();
    var postdata = new FormData();
    postdata.append("contRelation_id", contRelation_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDelete",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Relation has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#relations_id, #name").val("");
            $(".relation-table").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#relations_id, #relations_name, #name").val("");
    $("#nameError").attr("style", "display: none");
    $(".relation-table").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
