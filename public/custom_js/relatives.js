$(document).on("click", "#newRelatives", function () {
    $("#modal-relative").attr("class", "modal-lg modal-dialog modal-dialog-centered");
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#relatives_name, #relatives_phone, #relatives_email, #relatives_job, #relation_id, #is_emergency").val("");
    $("#nameError, #phoneError, #emailError, #jobError, #relationError, #emergencyError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var profile_id = $("#profile_id").val();
    var relatives_name = $("#relatives_name").val();
    var relatives_phone = $("#relatives_phone").val();
    var relatives_email = $("#relatives_email").val();
    var relatives_job = $("#relatives_job").val();
    var relation_id = $("#relation_id").val();
    var is_emergency = $("#is_emergency").val();
    if (relatives_name == "" || typeof relatives_name == undefined) {
        $("#relatives_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (relatives_phone == "" || typeof relatives_phone == undefined) {
        $("#relatives_phone").focus();
        $("#phoneError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_phone").blur();
        $("#phoneError").attr("style", "display: none");
    }
    if (relatives_email == "" || typeof relatives_email == undefined) {
        $("#relatives_email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_email").blur();
        $("#emailError").attr("style", "display: none");
    }
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!emailRegex.test(relatives_email)) {
        $("#relatives_email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_email").blur();
        $("#emailError").attr("style", "display: none");
    }
    if (relatives_job == "" || typeof relatives_job == undefined) {
        $("#relatives_job").focus();
        $("#jobError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_job").blur();
        $("#jobError").attr("style", "display: none");
    }
    if (relation_id == null) {
        $("#relation_id").focus();
        $("#relationError").attr("style", "display: unset");
        return false;
    } else {
        $("#relation_id").blur();
        $("#relationError").attr("style", "display: none");
    }
    if (is_emergency == null) {
        $("#is_emergency").focus();
        $("#emergencyError").attr("style", "display: unset");
        return false;
    } else {
        $("#is_emergency").blur();
        $("#emergencyError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("profile_id", profile_id);
    postdata.append("relation_id", relation_id);
    postdata.append("relatives_name", relatives_name);
    postdata.append("relatives_phone", relatives_phone);
    postdata.append("relatives_email", relatives_email);
    postdata.append("relatives_job", relatives_job);
    postdata.append("is_emergency", is_emergency);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to add a relative to your My Relatives list?",
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
                url: window.location.origin + "/createRelatives",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Relative has been added successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#relatives_name, #relatives_phone, #relatives_email, #relatives_job").val("");
                    $("#relation_id, #is_emergency").val("").trigger("change");
                    $("#nameError, #phoneError, #emailError, #jobError, #relationError, #emergencyError").attr("style", "display: none");
                    $(".table-Relatives").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var contRelatives_id = $(this).attr("data-id");
    $("#relatives_id").val(contRelatives_id);
    var postdata = new FormData();
    postdata.append("contRelatives_id", contRelatives_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editRelatives",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#modal-relative").attr("class", "modal-lg modal-dialog modal-dialog-centered");
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #phoneError, #emailError, #jobError, #relationError, #emergencyError").attr("style", "display: none");
            $("#profile_id").val(data.data.profile_id);
            $("#relatives_name").val(data.data.relatives_name);
            $("#relatives_phone").val(data.data.relatives_phone);
            $("#relatives_email").val(data.data.relatives_email);
            $("#relatives_job").val(data.data.relatives_job);
            $("#relation_id").val(data.data.relation_id).trigger("change");
            $("#is_emergency").val(data.data.is_emergency).trigger("change");
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var contRelatives_id = $("#relatives_id").val();
    var profile_id = $("#profile_id").val();
    var relatives_name = $("#relatives_name").val();
    var relatives_phone = $("#relatives_phone").val();
    var relatives_email = $("#relatives_email").val();
    var relatives_job = $("#relatives_job").val();
    var relation_id = $("#relation_id").val();
    var is_emergency = $("#is_emergency").val();
    if (relatives_name == "" || typeof relatives_name == undefined) {
        $("#relatives_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (relatives_phone == "" || typeof relatives_phone == undefined) {
        $("#relatives_phone").focus();
        $("#phoneError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_phone").blur();
        $("#phoneError").attr("style", "display: none");
    }
    if (relatives_email == "" || typeof relatives_email == undefined) {
        $("#relatives_email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_email").blur();
        $("#emailError").attr("style", "display: none");
    }
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!emailRegex.test(relatives_email)) {
        $("#relatives_email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_email").blur();
        $("#emailError").attr("style", "display: none");
    }
    if (relatives_job == "" || typeof relatives_job == undefined) {
        $("#relatives_job").focus();
        $("#jobError").attr("style", "display: unset");
        return false;
    } else {
        $("#relatives_job").blur();
        $("#jobError").attr("style", "display: none");
    }
    if (relation_id == null) {
        $("#relation_id").focus();
        $("#relationError").attr("style", "display: unset");
        return false;
    } else {
        $("#relation_id").blur();
        $("#relationError").attr("style", "display: none");
    }
    if (is_emergency == null) {
        $("#is_emergency").focus();
        $("#emergencyError").attr("style", "display: unset");
        return false;
    } else {
        $("#is_emergency").blur();
        $("#emergencyError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("contRelatives_id", contRelatives_id);
    postdata.append("profile_id", profile_id);
    postdata.append("relation_id", relation_id);
    postdata.append("relatives_name", relatives_name);
    postdata.append("relatives_phone", relatives_phone);
    postdata.append("relatives_email", relatives_email);
    postdata.append("relatives_job", relatives_job);
    postdata.append("is_emergency", is_emergency);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to update this relative?",
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
                url: window.location.origin + "/updateRelatives",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Relative has been updated successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#relatives_id, #relatives_name, #relatives_phone, #relatives_email, #relatives_job").val("");
                    $("#relation_id, #is_emergency").val("").trigger("change");
                    $("#nameError, #phoneError, #emailError, #jobError, #relationError, #emergencyError").attr("style", "display: none");
                    $(".table-Relatives").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var contRelatives_id = $(this).attr("data-id");
    $("#relatives_id").val(contRelatives_id);
    var relative_name = $(this).attr("data-relative");
    var postdata = new FormData();
    postdata.append("contRelatives_id", contRelatives_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editRelatives",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            $("#modal-relative").attr("class", "modal-dialog modal-dialog-centered");
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            document.getElementById("name").innerHTML = relative_name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var contRelatives_id = $("#relatives_id").val();
    var postdata = new FormData();
    postdata.append("contRelatives_id", contRelatives_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteRel",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Relative has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#relatives_id, #name").val("");
            $(".table-Relatives").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#relatives_id, #relatives_name, #relatives_phone, #relatives_email, #relatives_job, #name").val("");
    $("#relation_id, #is_emergency").val("").trigger("change");
    $("#nameError, #phoneError, #emailError, #jobError, #relationError, #emergencyError").attr("style", "display: none");
    $(".table-Relatives").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
