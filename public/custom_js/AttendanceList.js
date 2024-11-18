$(document).ready(function(){
    let user_id = $('#user-id').val();
    var t = $('.table-attendanceDetails').DataTable({
        serverSide: true,
        processing: true,
        ordering: true,
        columnDefs: [{ 'targets': 0, type: 'date-eu' },{'targets': 1, type: 'date-ro'}],
        order:[[0,'desc'],[1,'desc']],
        ajax: window.location.origin + '/getCurrentAttendance/' + user_id,
        columns: [
            {data: 'curentDate'},
            {data: 'time_in'},
            {data: 'location_in'},
            {data: 'photo_in'},
            {data: 'time_out'},
            {data: 'location_out'},
            {data: 'photo_out'},
            {data: 'clock_out'},
        ],
        pageLength: 25,
    });
});