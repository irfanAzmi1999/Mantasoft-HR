$(document).on("click", ".for-update", function () {
    var id_staff = $(this).attr("data-id");
    $("#staff_id").val(id_staff);
    var postdata = new FormData();
    postdata.append("id_staff", id_staff);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/openLeaveDetail",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            document.getElementById("staff_username").innerHTML = data.data.staff_username;
            $("#staff_name").val(data.data.staff_name);
            $("#department").val(data.data.department);
            var t = $(".table-leavedetails").DataTable({
                ajax: window.location.origin + "/getLeaveDetail/" + id_staff,
                columns: [{ data: null }, { data: "leavetype_id" }, { data: "half_day" }, { data: "start_date" }, { data: "end_date" }, { data: "date_leave" }],
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
