$("#year").val($("#currentYear").val()).trigger("change");

$(document).on("click", ".for-update", function () {
    var id_staff = $(this).attr("data-id");
    $("#staff_id").val(id_staff);
    var postdata = new FormData();
    postdata.append("id_staff", id_staff);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/openUnpaid",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            document.getElementById("staff_username").innerHTML = data.user.staff_username;
            $("#staff_name").val(data.user.staff_name);
            var arr = data.data;
            var append = "";
            $(".unpaid-row").empty();
            for (var x = 1; x <= 12; x++) {
                append += "<tr>" + "<td>" + arr[x].no + "</td>" + "<td>" + arr[x].monthTitle + "</td>" + "<td>" + arr[x].sum + "</td>" + +"</tr>";
            }
            $(".unpaid-row").append(append);
            $("#modal-type").modal("show");
        },
    });
});
