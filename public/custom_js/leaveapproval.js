$(document).on("click", ".for-update", function () {
    var id_leave = $(this).attr("data-id");
    $("#leave_id").val(id_leave);
    var postdata = new FormData();
    postdata.append("id_leave", id_leave);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/openApproval",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            $("#staff_name").val(data.data.staff_name);
            $("#status_id").val(data.data.status_id).trigger("change");
            $("#leavetype_id").val(data.data.leavetype_id);
            $("#emergencytype_id").val(data.data.emergencytype_id);
            $("#start_date").val(data.data.start_date);
            $("#end_date").val(data.data.end_date);
            $("#staff_remarks").val(data.data.staff_remarks);
            $("#post_update").attr("style", "");
            var t = $(".table-attachment").DataTable({
                ajax: window.location.origin + "/getAttachmentApproval/" + id_leave,
                columns: [{ data: null }, { data: "name" }],
                destroy: true,
            });
            t.on("order.dt search.dt", function () {
                t.column(0, { search: "applied", order: "applied" })
                    .nodes()
                    .each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
            }).draw();
            $("#modal-type").modal("show");
        },
    });
});

$(document).on("click", "#post_update", function () {
    var id_leave = $("#leave_id").val();
    var status_id = $("#status_id").val();
    var leavetype_id = $("#leavetype_id").val();
    var approver_remarks = $("#approver_remarks").val();
    var postdata = new FormData();
    postdata.append("id_leave", id_leave);
    postdata.append("status_id", status_id);
    postdata.append("leavetype_id", leavetype_id);
    postdata.append("approver_remarks", approver_remarks);
    postdata.append("_token", $(".token").val());
    const isRtl = $("html").attr("data-textdirection") === "rtl";
    Swal.fire({
        title: "Confirm?",
        text: "Do you want to update this leave data?",
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
                url: window.location.origin + "/leaveApproval",
                data: postdata,
                contentType: false,
                processData: false,
                dataType: "json",
                type: "POST",
                success: function () {
                    setTimeout(function () {
                        toastr["success"](null, "Leave data has been updated successfully.", {
                            closeButton: true,
                            tapToDismiss: true,
                            rtl: isRtl,
                        });
                    }, 2000);
                    $("#status_id").val("").trigger("change");
                    $(".table-leaveapproval").DataTable().ajax.reload(null, false);
                    $("#modal-type").modal("hide");
                },
            });
        }
    });
});
