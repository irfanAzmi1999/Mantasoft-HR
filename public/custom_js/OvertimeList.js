$(document).ready(function(){
    let user_id = $('#user-id').val();
    var t = $('.table-overtimeDetails').DataTable({
        serverSide: true,
        processing: true,
        ajax: window.location.origin + '/getOvertime/' + user_id,
        columns: [
            {data: 'curentDate'},
            {data: 'clockedTime_in'},
            {data: 'location_in'},
            {data: 'clockedTime_out'},
            {data: 'location_out'},
            {data: 'clockOut'},
        ],
        pageLength: 25
    });
    
});