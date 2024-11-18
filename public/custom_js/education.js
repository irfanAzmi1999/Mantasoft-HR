$(document).on("click", "#newEducation", function () {
    $("#modal-education").attr("class", "modal-lg modal-dialog modal-dialog-centered");
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#school_name, #year_from, #year_to, #achievement, #result").val("");
    $("#nameError, #yearFromError, #yearToError, #achievementError, #resultError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var profile_id = $("#profile_id").val();
    var school_name = $("#school_name").val();
    var year_from = $("#year_from").val();
    var year_to = $("#year_to").val();
    var achievement = $("#achievement").val();
    var result = $("#result").val();
    if (school_name == "" || typeof school_name == undefined) {
        $("#school_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#school_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (year_from == null) {
        $("#year_from").focus();
        $("#yearFromError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_from").blur();
        $("#yearFromError").attr("style", "display: none");
    }
    if (year_to == null) {
        $("#year_to").focus();
        $("#yearToError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_to").blur();
        $("#yearToError").attr("style", "display: none");
    }
    if(year_from > year_to) {
        $("#year_from, #year_to").focus();
        $("#yearFromError, #yearToError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_from, #year_to").blur();
        $("#yearFromError, #yearToError").attr("style", "display: none");
    }
    if (achievement == "" || typeof achievement == undefined) {
        $("#achievement").focus();
        $("#achievementError").attr("style", "display: unset");
        return false;
    } else {
        $("#achievement").blur();
        $("#achievementError").attr("style", "display: none");
    }
    if (result == "" || typeof result == undefined) {
        $("#result").focus();
        $("#resultError").attr("style", "display: unset");
        return false;
    } else {
        $("#result").blur();
        $("#resultError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("profile_id", profile_id);
    postdata.append("school_name", school_name);
    postdata.append("year_from", year_from);
    postdata.append("year_to", year_to);
    postdata.append("achievement", achievement);
    postdata.append("result", result);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to add an education to your My Educations list?",
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
                url: window.location.origin + "/createEducation",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Education has been added successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#school_name, #achievement, #result").val("");
                    $("#year_from, #year_to").val("").trigger("change");
                    $("#nameError, #yearFromError, #yearToError, #achievementError, #resultError").attr("style", "display: none");
                    $(".table-education").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var constEducation_id = $(this).attr("data-id");
    $("#education_id").val(constEducation_id);
    var postdata = new FormData();
    postdata.append("constEducation_id", constEducation_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editEducation",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#modal-education").attr("class", "modal-lg modal-dialog modal-dialog-centered");
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #yearFromError, #yearToError, #achievementError, #resultError").attr("style", "display: none");
            $("#profile_id").val(data.data.profile_id);
            $("#school_name").val(data.data.school_name);
            $("#year_from").val(data.data.year_from).trigger("change");
            $("#year_to").val(data.data.year_to).trigger("change");
            $("#achievement").val(data.data.achievement);
            $("#result").val(data.data.result);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var constEducation_id = $("#education_id").val();
    var profile_id = $("#profile_id").val();
    var school_name = $("#school_name").val();
    var year_from = $("#year_from").val();
    var year_to = $("#year_to").val();
    var achievement = $("#achievement").val();
    var result = $("#result").val();
    if (school_name == "" || typeof school_name == undefined) {
        $("#school_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#school_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (year_from == null) {
        $("#year_from").focus();
        $("#yearFromError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_from").blur();
        $("#yearFromError").attr("style", "display: none");
    }
    if (year_to == null) {
        $("#year_to").focus();
        $("#yearToError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_to").blur();
        $("#yearToError").attr("style", "display: none");
    }
    if(year_from > year_to) {
        $("#year_from, #year_to").focus();
        $("#yearFromError, #yearToError").attr("style", "display: unset");
        return false;
    } else {
        $("#year_from, #year_to").blur();
        $("#yearFromError, #yearToError").attr("style", "display: none");
    }
    if (achievement == "" || typeof achievement == undefined) {
        $("#achievement").focus();
        $("#achievementError").attr("style", "display: unset");
        return false;
    } else {
        $("#achievement").blur();
        $("#achievementError").attr("style", "display: none");
    }
    if (result == "" || typeof result == undefined) {
        $("#result").focus();
        $("#resultError").attr("style", "display: unset");
        return false;
    } else {
        $("#result").blur();
        $("#resultError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("constEducation_id", constEducation_id);
    postdata.append("profile_id", profile_id);
    postdata.append("year_from", year_from);
    postdata.append("school_name", school_name);
    postdata.append("achievement", achievement);
    postdata.append("result", result);
    postdata.append("year_to", year_to);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to update this education?",
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
                url: window.location.origin + "/updateEducation",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            "Education has been updated successfully.",
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#education_id, #school_name, #achievement, #result").val("");
                    $("#year_from, #year_to").val("").trigger("change");
                    $("#nameError, #yearFromError, #yearToError, #achievementError, #resultError").attr("style", "display: none");
                    $(".table-education").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var constEducation_id = $(this).attr("data-id");
    $("#education_id").val(constEducation_id);
    var school_name = $(this).attr("data-education");
    var postdata = new FormData();
    postdata.append("constEducation_id", constEducation_id);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editEducation",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            $("#modal-education").attr("class", "modal-dialog modal-dialog-centered");
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            document.getElementById("name").innerHTML = school_name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var constEducation_id = $("#education_id").val();
    var postdata = new FormData();
    postdata.append("constEducation_id", constEducation_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteEducation",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Education has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#education_id, #name").val("");
            $(".table-education").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#education_id, #school_name, #achievement, #result, #name").val("").trigger("change");
    $("#year_from, #year_to").val("").trigger("change");
    $("#nameError, #yearFromError, #yearToError, #achievementError, #resultError").attr("style", "display: none");
    $(".table-education").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});

$("#year_from, #year_to").val($("#currentYear").val());
