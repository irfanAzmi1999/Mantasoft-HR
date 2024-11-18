$(document).on("click", ".for-update", function () {
    var id_quota = $(this).attr("data-id");
    $("#quota_id").val(id_quota);
    var postdata = new FormData();
    postdata.append("id_quota", id_quota);
    postdata.append("_token", $(".token").val());
    $.ajax({
        url: window.location.origin + "/openSummary",
        data: postdata,
        contentType: false,
        processData: false,
        dataType: "json",
        type: "POST",
        success: function (data) {
            document.getElementById("staff_username").innerHTML = data.data.staff_username;
            $("#staff_name").val(data.data.staff_name);
            $("#default").val(data.data.default);
            $("#taken").val(data.data.taken);
            $("#balance").val(data.data.balance);
            $("#mc_default").val(data.data.mc_default);
            $("#mc_taken").val(data.data.mc_taken);
            $("#mc_balance").val(data.data.mc_balance);
            $("#post_update").attr("style", "");
            $("#modal-type").modal("show");
        },
    });
});
