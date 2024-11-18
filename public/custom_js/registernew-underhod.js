var t = $(".usersunderhod-table").DataTable({
    ajax: window.location.origin + "/getUserUnderHod",
    columns: [
        {data: null},
        {data: "name"},
        {data: "email"},
        {data: "role"},
        {data: "dept"},
        {data: "phone"},
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

$(document).on("click", "#registerNew", function () {
    $("#myModalLabel120, .manage, #post_add").attr("style", "");
    $("#edit_title, #delete_title, .delete, #post_update, #post_softdelete").attr("style", "display: none");
    $("#name, #role_id, #username, #password, #password-confirm, #email, #phone, #employ_date, #company_id").val("");
    $("#department_id").val();
    $("#superior_id").val();
    $("#nameError, #departmentError, #roleError, #superiorError, #usernameError, #passwordError, #confPassError, #confPassFail, #emailError, #phoneError, #employDateError, #companyError").attr("style", "display: none");
    $("#modal-type").modal("show");
});

$(document).on("click", "#post_add", function () {
    var name = $("#name").val();
    var department_id = $("#department_id").val();
    var role_id = $("#role_id").val();
    var superior_id = $("#superior_id").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var password_confirm = $("#password-confirm").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var employ_date = $("#employ_date").val();
    var company_id = $("#company_id").val();
    if (name == "" || typeof name == undefined) {
        $("#name").focus();
        $("#nameError").attr("style", "display: unset");
        return false;
    } else {
        $("#name").blur();
        $("#nameError").attr("style", "display: none");
    }
    if (role_id == null) {
        $("#role_id").focus();
        $("#roleError").attr("style", "display: unset");
        return false;
    } else {
        $("#role_id").blur();
        $("#roleError").attr("style", "display: none");
    }
    if (username == "" || typeof username == undefined) {
        $("#username").focus();
        $("#usernameError").attr("style", "display: unset");
        return false;
    } else {
        $("#username").blur();
        $("#usernameError").attr("style", "display: none");
    }
    if (password == "" || typeof password == undefined) {
        $("#password").focus();
        $("#passwordError").attr("style", "display: unset");
        return false;
    } else {
        $("#password").blur();
        $("#passwordError").attr("style", "display: none");
    }
    if (password_confirm == "" || typeof password_confirm == undefined) {
        $("#password-confirm").focus();
        $("#confPassError").attr("style", "display: unset");
        return false;
    } else {
        $("#password-confirm").blur();
        $("#confPassError").attr("style", "display: none");
    }
    if (password_confirm != password) {
        $("#password, #password-confirm").focus();
        $("#confPassFail").attr("style", "display: unset");
        return false;
    } else {
        $("#password, #password-confirm").blur();
        $("#confPassFail").attr("style", "display: none");
    }
    if (email == "" || typeof email == undefined) {
        $("#email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#email").blur();
        $("#emailError").attr("style", "display: none");
    }
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!emailRegex.test(email)) {
        $("#email").focus();
        $("#emailError").attr("style", "display: unset");
        return false;
    } else {
        $("#email").blur();
        $("#emailError").attr("style", "display: none");
    }
    if (phone == "" || typeof phone == undefined) {
        $("#phone").focus();
        $("#phoneError").attr("style", "display: unset");
        return false;
    } else {
        $("#phone").blur();
        $("#phoneError").attr("style", "display: none");
    }
    if (employ_date == "" || typeof employ_date == undefined) {
        $("#employ_date").focus();
        $("#employDateError").attr("style", "display: unset");
        return false;
    } else {
        $("#employ_date").blur();
        $("#employDateError").attr("style", "display: none");
    }
    if (company_id == null) {
        $("#company_id").focus();
        $("#companyError").attr("style", "display: unset");
        return false;
    } else {
        $("#company_id").blur();
        $("#companyError").attr("style", "display: none");
    }
    var postdata = new FormData();
    postdata.append("name", name);
    postdata.append("department_id", department_id);
    postdata.append("role_id", role_id);
    postdata.append("superior_id", superior_id);
    postdata.append("username", username);
    postdata.append("password", password);
    postdata.append("email", email);
    postdata.append("phone", phone);
    postdata.append("employ_date", employ_date);
    postdata.append("company_id", company_id);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: 'Do you want to register "' + name + '" to VN HR list staff?',
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
                url: window.location.origin + "/register",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](
                            null,
                            'Staff "' + name + '" has been registered successfully.',
                            {
                                closeButton: true,
                                tapToDismiss: true,
                                rtl: isRtl
                            }
                        );
                    }, 2000);
                    $("#name, #username, #password, #password-confirm, #email, #phone, #employ_date").val("");
                    $("#role_id, #company_id").val("").trigger("change");
                    $("#department_id").val();
                    $("#superior_id").val();
                    $("#nameError, #departmentError, #roleError, #superiorError, #usernameError, #passwordError, #confPassError, #confPassFail, #emailError, #phoneError, #employDateError, #companyError").attr("style", "display: none");
                    $(".usersunderhod-table").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});

$(document).on("click", "#cancel, #close", function () {
    $("#user_id, #name, #username, #password, #password-confirm, #email, #phone, #employ_date").val("");
    $("#role_id, #company_id").val("").trigger("change");
    $("#department_id").val();
    $("#superior_id").val();
    $("#nameError, #departmentError, #roleError, #superiorError, #usernameError, #passwordError, #confPassError, #confPassFail, #emailError, #phoneError, #employDateError, #companyError").attr("style", "display: none");
    $("#modal-type").modal("hide");
});
