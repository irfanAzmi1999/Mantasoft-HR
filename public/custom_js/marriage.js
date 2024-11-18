$(document).on("click", "#newMarriage", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#marital_id, #marriage_date, #spouse_name, #spouse_job, #spouse_company").val("");
    $("#statusError, #dateError, #nameError, #jobError, #companyError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var profile_id = $("#profile_id").val();
    var marital_id = $("#marital_id").val();
    var marriage_date = $("#marriage_date").val();
    var spouse_name = $("#spouse_name").val();
    var spouse_job = $("#spouse_job").val();
    var spouse_company = $("#spouse_company").val();
    if (marital_id == null) {
        $("#marital_id").focus();
        $("#statusError").attr("style", "display: unset");
        return false;
    } else {
        $("#marital_id").blur();
        $("#statusError").attr("style", "display: none");
    }
    if (marital_id == 2) {
        if (marriage_date == "" || typeof marriage_date == undefined) {
            $("#marriage_date").focus();
            $("#dateError").attr("style", "display: unset");
            return false;
        } else {
            $("#marriage_date").blur();
            $("#dateError").attr("style", "display: none");
        }
        if (spouse_name == "" || typeof spouse_name == undefined) {
            $("#spouse_name").focus();
            $("#nameError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_name").blur();
            $("#nameError").attr("style", "display: none");
        }
        if (spouse_job == "" || typeof spouse_job == undefined) {
            $("#spouse_job").focus();
            $("#jobError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_job").blur();
            $("#jobError").attr("style", "display: none");
        }
        if (spouse_company == "" || typeof spouse_company == undefined) {
            $("#spouse_company").focus();
            $("#companyError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_company").blur();
            $("#companyError").attr("style", "display: none");
        }
    } else {
        marriage_date = "";
        spouse_name = "";
        spouse_job = "";
        spouse_company = "";
    }
    var postdata = new FormData();
    postdata.append("profile_id", profile_id);
    postdata.append("marital_id", marital_id);
    postdata.append("marriage_date", marriage_date);
    postdata.append("spouse_name", spouse_name);
    postdata.append("spouse_job", spouse_job);
    postdata.append("spouse_company", spouse_company);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to add a marriage to your My Marriages list?",
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
                url: window.location.origin + "/createMarriage",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Marriage has been added successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#marriage_date, #spouse_name, #spouse_job, #spouse_company").val("");
                    $("#marital_id").val("").trigger("change");
                    $("#statusError, #dateError, #nameError, #jobError, #companyError").attr("style", "display: none");
                    $(".table-Marriages").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_marriage = $(this).attr("data-id");
    $("#marriage_id").val(id_marriage);
    var postdata = new FormData();
    postdata.append("id_marriage", id_marriage);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editMarriage",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#statusError, #dateError, #nameError, #jobError, #companyError").attr("style", "display: none");
            $("#profile_id").val(data.data.profile_id);
            $("#marital_id").val(data.data.marital_id).trigger("change");
            $("#marriage_date").val(data.data.marriage_date);
            $("#spouse_name").val(data.data.spouse_name);
            $("#spouse_job").val(data.data.spouse_job);
            $("#spouse_company").val(data.data.spouse_company);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_marriage = $("#marriage_id").val();
    var profile_id = $("#profile_id").val();
    var marital_id = $("#marital_id").val();
    var marriage_date = $("#marriage_date").val();
    var spouse_name = $("#spouse_name").val();
    var spouse_job = $("#spouse_job").val();
    var spouse_company = $("#spouse_company").val();
    if (marital_id == null) {
        $("#marital_id").focus();
        $("#statusError").attr("style", "display: unset");
        return false;
    } else {
        $("#marital_id").blur();
        $("#statusError").attr("style", "display: none");
    }
    if (marital_id == 2) {
        if (marriage_date == "" || typeof marriage_date == undefined) {
            $("#marriage_date").focus();
            $("#dateError").attr("style", "display: unset");
            return false;
        } else {
            $("#marriage_date").blur();
            $("#dateError").attr("style", "display: none");
        }
        if (spouse_name == "" || typeof spouse_name == undefined) {
            $("#spouse_name").focus();
            $("#nameError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_name").blur();
            $("#nameError").attr("style", "display: none");
        }
        if (spouse_job == "" || typeof spouse_job == undefined) {
            $("#spouse_job").focus();
            $("#jobError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_job").blur();
            $("#jobError").attr("style", "display: none");
        }
        if (spouse_company == "" || typeof spouse_company == undefined) {
            $("#spouse_company").focus();
            $("#companyError").attr("style", "display: unset");
            return false;
        } else {
            $("#spouse_company").blur();
            $("#companyError").attr("style", "display: none");
        }
    } else {
        marriage_date = "";
        spouse_name = "";
        spouse_job = "";
        spouse_company = "";
    }
    var postdata = new FormData();
    postdata.append("id_marriage", id_marriage);
    postdata.append("profile_id", profile_id);
    postdata.append("marital_id", marital_id);
    postdata.append("marriage_date", marriage_date);
    postdata.append("spouse_name", spouse_name);
    postdata.append("spouse_job", spouse_job);
    postdata.append("spouse_company", spouse_company);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to update this marriage?",
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
                url: window.location.origin + "/updateMarriage",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Marriage has been updated successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#marriage_id, #marriage_date, #spouse_name, #spouse_job, #spouse_company").val("");
                    $("#marital_id").val("").trigger("change");
                    $("#statusError, #dateError, #nameError, #jobError, #companyError").attr("style", "display: none");
                    $(".table-Marriages").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_marriage = $(this).attr("data-id");
    $("#marriage_id").val(id_marriage);
    var marriage_name = $(this).attr("data-marriage");
    var postdata = new FormData();
    postdata.append("id_marriage", id_marriage);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editMarriage",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            document.getElementById("name").innerHTML = marriage_name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var id_marriage = $("#marriage_id").val();
    var postdata = new FormData();
    postdata.append("id_marriage", id_marriage);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteMarriage",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Marriage has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    });
            }, 2000);
            $("#marriage_id, #name").val("");
            $(".table-Marriages").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#marriage_id, #marriage_date, #spouse_name, #spouse_job, #spouse_company, #name").val("");
    $("#marital_id").val("").trigger("change");
    $("#statusError, #dateError, #nameError, #jobError, #companyError").attr("style", "display: none");
    $(".table-Marriages").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});

function check() {
    var marital_id = $("#marital_id").val();
    if (marital_id == 2) {
        $("#berkahwin").attr("style", "display: unset");
    } else {
        $("#berkahwin").attr("style", "display: none");
    }
}
