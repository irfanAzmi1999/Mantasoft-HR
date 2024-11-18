$(document).on("click", "#newProfilePosition", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#position_id").val("");
    $("#positionError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var profile_id = $("#profile_id").val();
    var position_id = $("#position_id").val();
    if (position_id == null) {
        $("#position_id").focus();
        $("#positionError").attr("style", "display: unset");
        return false;
    } else {
        $("#position_id").blur();
        $("#positionError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("profile_id", profile_id);
    postdata.append("position_id", position_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to add a position to your My Positions list?",
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
                url: window.location.origin + "/createProfilePosition",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Position has been added successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#position_id").val("").trigger("change");
                    $("#positionError").attr("style", "display: none");
                    $(".table-Positions").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_profileposition = $(this).attr("data-id");
    $("#profileposition_id").val(id_profileposition);
    var postdata = new FormData();
    postdata.append("id_profileposition", id_profileposition);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editProfilePosition",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#positionError").attr("style", "display: none");
            $("#profile_id").val(data.data.profile_id);
            $("#position_id").val(data.data.position_id).trigger("change");
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_profileposition = $("#profileposition_id").val();
    var profile_id = $("#profile_id").val();
    var position_id = $("#position_id").val();
    if (position_id == null) {
        $("#position_id").focus();
        $("#positionError").attr("style", "display: unset");
        return false;
    } else {
        $("#position_id").blur();
        $("#positionError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_profileposition", id_profileposition);
    postdata.append("profile_id", profile_id);
    postdata.append("position_id", position_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to update this position?",
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
                url: window.location.origin + "/updateProfilePosition",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Position has been updated successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#profileposition_id").val("");
                    $("#position_id").val("").trigger("change");
                    $("#positionError").attr("style", "display: none");
                    $(".table-Positions").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_profileposition = $(this).attr("data-id");
    $("#profileposition_id").val(id_profileposition);
    var position_name = $(this).attr("data-position");
    var postdata = new FormData();
    postdata.append("id_profileposition", id_profileposition);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editProfilePosition",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            document.getElementById("name").innerHTML = position_name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var id_profileposition = $("#profileposition_id").val();
    var postdata = new FormData();
    postdata.append("id_profileposition", id_profileposition);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteProPos",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null, "Position has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#profileposition_id, #name").val("");
            $(".table-Positions").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#profileposition_id, #name").val("");
    $("#position_id").val("").trigger("change");
    $("#positionError").attr("style", "display: none");
    $(".table-Positions").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
