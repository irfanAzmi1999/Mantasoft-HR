var t = $(".table-department").DataTable({
    ajax: window.location.origin + "/getDepartment",
    columns: [
        {data: null},
        {data: "name"},
        {data: "fullname"},
        {data: "order_number"},
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

$(document).on("click", "#newDepartment", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#department_name, #fullname, #order_number").val("");
    $("#nameError, #fullNameError, #orderError, #orderZero").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var fullname = $("#fullname").val();
    var department_name = $("#department_name").val();
    var order_number = $("#order_number").val();
    if (fullname == "" || typeof fullname == undefined) {
        $("#fullname").focus();
        $("#fullNameError").attr("style", "display: unset");
        return false;
    } else {
        $("#fullname").blur();
        $("#fullNameError").attr("style", "display: none");
    }
    if (department_name == "" || typeof department_name == undefined) {
        $("#department_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#department_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (order_number == "" || typeof order_number == undefined) {
        $("#order_number").focus();
        $("#orderError").attr("style", "display: unset");
        return false;
    } else {
        $("#order_number").blur();
        $("#orderError").attr("style", "display: none");
    }
    if (order_number <= 0) {
        $("#order_number").focus();
        $("#orderZero").attr("style", "display: unset");
        return false;
    } else {
        $("#order_number").blur();
        $("#orderZero").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("department_name", department_name);
    postdata.append("fullname", fullname);
    postdata.append("order_number", order_number);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to add "' + department_name + '" to departments list?',
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
                url: window.location.origin + "/createDepartment",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + department_name + '" department has been added successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#department_name, #fullname, #order_number").val("");
                    $("#nameError, #fullNameError, #orderError, #orderZero").attr("style", "display: none");
                    $(".table-department").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-update", function () {
    var id_department = $(this).attr("data-id");
    $("#department_id").val(id_department);
    var postdata = new FormData();
    postdata.append("id_department", id_department);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editDepartment",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#edit_title, .manage, #post_update").attr("style", "");
            $("#myModalLabel120, #delete_title, .delete, #post_add, #post_softdelete").attr("style", "display: none");
            $("#nameError, #fullNameError, #orderError, #orderZero").attr("style", "display: none");
            $("#department_name").val(data.data.name);
            $("#fullname").val(data.data.fullname);
            $("#order_number").val(data.data.order_number);
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_department = $("#department_id").val();
    var fullname = $("#fullname").val();
    var department_name = $("#department_name").val();
    var order_number = $("#order_number").val();
    if (fullname == "" || typeof fullname == undefined) {
        $("#fullname").focus();
        $("#fullNameError").attr("style", "display: unset");
        return false;
    } else {
        $("#fullname").blur();
        $("#fullNameError").attr("style", "display: none");
    }
    if (department_name == "" || typeof department_name == undefined) {
        $("#department_name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#department_name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (order_number == "" || typeof order_number == undefined) {
        $("#order_number").focus();
        $("#orderError").attr("style", "display: unset");
        return false;
    } else {
        $("#order_number").blur();
        $("#orderError").attr("style", "display: none");
    }
    if (order_number <= 0) {
        $("#order_number").focus();
        $("#orderZero").attr("style", "display: unset");
        return false;
    } else {
        $("#order_number").blur();
        $("#orderZero").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("id_department", id_department);
    postdata.append("department_name", department_name);
    postdata.append("fullname", fullname);
    postdata.append("order_number", order_number);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to update "' + department_name + '" department?',
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
                url: window.location.origin + "/updateDepartment",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            '"' + department_name + '" department has been updated successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#department_name, #fullname, #order_number").val("");
                    $("#nameError, #fullNameError, #orderError, #orderZero").attr("style", "display: none");
                    $(".table-department").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", ".for-delete", function () {
    var id_department = $(this).attr("data-id");
    $("#department_id").val(id_department);
    var postdata = new FormData();
    postdata.append("id_department", id_department);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/editDepartment",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#delete_title, .delete, #post_softdelete").attr("style", "");
            $("#myModalLabel120, #edit_title, .manage, #post_add, #post_update").attr("style", "display: none");
            document.getElementById("name").innerHTML = data.data.name;
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_softdelete", function () {
    var id_department = $("#department_id").val();
    var postdata = new FormData();
    postdata.append("id_department", id_department);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    $.ajax({
        url: window.location.origin + "/softDeleteDep",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function () {
            setTimeout(function () {
                toastr["success"](
                    null,
                    "Department has been deleted successfully.",
                    {
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                );
            }, 2000);
            $("#department_id, #name").val("");
            $(".table-department").DataTable().ajax.reload(null, false);
            $("#modal-type").modal("hide");
        },
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#department_id, #department_name, #fullname, #order_number, #name").val("");
    $("#nameError, #fullNameError, #orderError, #orderZero").attr("style", "display: none");
    $(".table-department").DataTable().ajax.reload(null, false);
    $("#modal-type").modal("hide");
});
