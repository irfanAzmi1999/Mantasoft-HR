$('#leave_type').val('').trigger('change');


$(document).on('click', '.for-update', function() {    
    var id_leaveCont = $(this).attr('data-id');
    $('#idLeave_Details').val(id_leaveCont);
    var postdata = new FormData();
    
    postdata.append('id_leaveCont', id_leaveCont);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/editMyLeave',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function(data) {
            $('.manage').attr('style','');
            $('.delete').attr('style','display: none');
            $('#edit_titel').attr('style','');
            $('#delete_title').attr('style','display: none');
            $('#post_softdelete').attr('style','display: none');
            $('#post_update').attr('style','');
            $('#delete_att').attr('style','display: none');
            $('.deleteAtt').attr('style','display: none');
            $('#post_softdeleteAtt').attr('style','display: none');
            $('#att_title').attr('style','display: none');
            $('.attachment').attr('style','display: none');
            $('#post_att').attr('style','display: none');
            $('#leavetype_id').val(data.data.leavetype_id);
            $('#status_id').val(data.data.status_id);
            $('#start_date').val(data.data.start_date);
            $('#end_date').val(data.data.end_date);
            $('#staff_remarks').val(data.data.staff_remarks);
            // $('#half_day').val(data.data.half_day);
            $('.custom-option-item-check[value='+ data.data.half_day +']').click();
            // $('#category_id').val(data.data.category_id).trigger('change');
            // $('#post_add').attr('style','display: none');
            var t = $('.table-attachment').DataTable({
                ajax: window.location.origin + '/getAttachment/' + id_leaveCont,
                columns: [
                    {data: null},
                    {data: 'name'},
                    {data: 'photo'},
                    {data: 'action'}
                ],
                pageLength: 5,
                destroy: true
            });
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
            $('#modal-type').modal('show');
        }
    });
});

$(document).on('click', '#post_update', function() {
    var id_leaveCont = $('#idLeave_Details').val();
    // var leavetype_id = $('#leavetype_id').val();
    // if(leavetype_id == '' || typeof leavetype_id == undefined) {
    //     alert('please choose the leave type.');
    //     return false;
    // }
    // var status_id = $('#status_id').val();
    // if(status_id == null) {
    //     alert('please Select a status for the status.');
    //     return false;
    // }
    var start_date = $('#start_date').val();
    if(start_date == null) {
        alert('please fill the start date that you leave.');
        return false;
    }    
    var end_date = $('#end_date').val();
    if(end_date == null) {
        alert('please fill the end date for you leave.');
        return false;
    }    
    var staff_remarks = $('#staff_remarks').val();
    if(staff_remarks == null) {
        alert('please fill the reason why you leave that day.');
        return false;
    }

    let half_day = null;

    $('.half_day').each(function(v){
        if($(this).prop('checked')){
            half_day = $(this).val();
        }
    }); if(half_day == null) {
        alert('please select which leave you prefer.');
        return false;
    }
    var postdata = new FormData();
    postdata.append('id_leaveCont', id_leaveCont);
    // postdata.append('leavetype_id', leavetype_id);
    // postdata.append('status_id', status_id);
    postdata.append('start_date', start_date);
    postdata.append('end_date', end_date);
    postdata.append('half_day', half_day);
    postdata.append('staff_remarks', staff_remarks);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/updateMyLeave',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function() {
            alert('leave data has been updated successfully.');
            // $('#category_id').val('').trigger('change');
            $('.table-myLeave').DataTable().ajax.reload(null, false);
            $('#modal-type').modal('hide');
        }
    });
});


$(document).on('click', '.for-delete', function() {
    var id_leaveCont = $(this).attr('data-id');
    $('#idLeave_Details').val(id_leaveCont);
    var postdata = new FormData();
    postdata.append('id_leaveCont', id_leaveCont);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/editMyLeave',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function(data) {

            $('#edit_titel').attr('style','display: none');
            $('#delete_title').attr('style','');
            $('.manage').attr('style','display: none');
            $('.delete').attr('style','');
            $('#delete_att').attr('style','display: none');
            $('.deleteAtt').attr('style','display: none');
            $('#att_title').attr('style','display: none');
            $('.attachment').attr('style','display: none');
            $('#post_att').attr('style','display: none');
            document.getElementById('leavetype_ids').innerHTML = data.data.leavetype_id;
            document.getElementById('start_dates').innerHTML = data.data.start_date;
            document.getElementById('end_dates').innerHTML = data.data.end_date;
            $('#post_add').attr('style','display: none');
            $('#post_update').attr('style','display: none');
            $('#post_softdeleteAtt').attr('style','display: none');
            $('#post_softdelete').attr('style','');
            $('#modal-type').modal('show');
        }
    });
});

$(document).on('click', '#post_softdelete', function() {
    var id_leaveCont = $('#idLeave_Details').val();
    var postdata = new FormData();
    postdata.append('id_leaveCont', id_leaveCont);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/softDeleteMyLeave',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function() {
            alert('leave data has been deleted successfully.');
            $('.table-myLeave').DataTable().ajax.reload(null, false);
            $('#modal-type').modal('hide');    
        }
    });
});

$(document).on('click', '.for-deleteAtt', function() {
    var id_AttCont = $(this).attr('data-id');
    $('#idAttachment').val(id_AttCont);
    var postdata = new FormData();
    postdata.append('id_AttCont', id_AttCont);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/getDeleteAtt',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function(data) {
            $('#edit_titel').attr('style','display: none');
            $('#delete_title').attr('style','display: none');
            $('#delete_att').attr('style','');
            $('.manage').attr('style','display: none');
            $('.delete').attr('style','display: none');
            $('#att_title').attr('style','display: none');
            $('.attachment').attr('style','display: none');
            $('#post_att').attr('style','display: none');
            $('.deleteAtt').attr('style','display: unset');
            document.getElementById('nameAtt').innerHTML = data.data.name;
            $('#post_add').attr('style','display: none');
            $('#post_update').attr('style','display: none');
            $('#post_softdelete').attr('style','display: none');
            $('#post_softdeleteAtt').attr('style','');
            $('#modal-type').modal('show');
        }
    });
});

$(document).on('click', '#post_softdeleteAtt', function() {

    var id_AttCont = $('#idAttachment').val();
    var postdata = new FormData();
    postdata.append('id_AttCont', id_AttCont);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/softDeleteAtt',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function() {
            alert('attachment has been deleted successfully.');
            $('.table-attachment').DataTable().ajax.reload(null, false);
            $('.manage').attr('style','');
            $('.delete').attr('style','display: none');
            $('#edit_titel').attr('style','');
            $('#delete_title').attr('style','display: none');
            $('#post_softdelete').attr('style','display: none');
            $('#post_update').attr('style','');
            $('#delete_att').attr('style','display: none');
            $('.deleteAtt').attr('style','display: none');
            $('#post_softdeleteAtt').attr('style','display: none');
            $('#att_title').attr('style','display: none');
            $('.attachment').attr('style','display: none');
            $('#post_att').attr('style','display: none');
            $('#leavetype_id').val(data.data.leavetype_id);
            $('#status_id').val(data.data.status_id);
            $('#start_date').val(data.data.start_date);
            $('#end_date').val(data.data.end_date);
            $('#staff_remarks').val(data.data.staff_remarks);
            // $('#half_day').val(data.data.half_day);
            $('.custom-option-item-check[value='+ data.data.half_day +']').click();
            // $('#category_id').val(data.data.category_id).trigger('change');
            // $('#post_add').attr('style','display: none');
            $('.table-attachment').DataTable({
                ajax: window.location.origin + '/getAttachment/' + id_leaveCont,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'photo'},
                    {data: 'action'}
                ],
                pageLength: 5,
                destroy: true
            });
            $('#modal-type').modal('show');
        }
    });
});

$(document).on('click', '#newAttachment', function() {
    $('.manage').attr('style','display: none');
    $('.delete').attr('style','display: none');
    $('#edit_titel').attr('style','display: none');
    $('#delete_title').attr('style','display: none');
    $('#post_softdelete').attr('style','display: none');
    $('#post_update').attr('style','display: none');
    $('#delete_att').attr('style','display: none');
    $('.deleteAtt').attr('style','display: none');
    $('#post_softdeleteAtt').attr('style','display: none');
    $('#att_title').attr('style','');
    $('.attachment').attr('style','');
    $('#post_att').attr('style','');
    $('#modal-type').modal('show');
    $('#attachments').val('');
});

$(document).on('click', '#post_att', function() {
    var id_leaveCont = $('#idLeave_Details').val();
    var attachments = $('#attachments').get(0).files;
    // if(attachments == '' || typeof attachments == undefined) {
    //     alert('Fill in the attachment name.');
    //     return false;
    // }
    let attach_count = attachments.length;
    var postdata = new FormData();
    postdata.append('id_leaveCont', id_leaveCont);
    for(let x = 0;x < attachments.length; x++){
        postdata.append('attachments'+ x, attachments[x]);
    }
    postdata.append('picKuntul', attach_count);
    postdata.append('_token', $('.token').val());
    $.ajax({
        url:window.location.origin + '/newAttachment',
        data: postdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        type: 'POST',
        success: function() {
            alert('attachment data has been added successfully.');
            $('.table-attachment').DataTable().ajax.reload(null, false);
            $('.manage').attr('style','');
            $('.delete').attr('style','display: none');
            $('#edit_titel').attr('style','');
            $('#delete_title').attr('style','display: none');
            $('#post_softdelete').attr('style','display: none');
            $('#post_update').attr('style','');
            $('#delete_att').attr('style','display: none');
            $('.deleteAtt').attr('style','display: none');
            $('#post_softdeleteAtt').attr('style','display: none');
            $('#att_title').attr('style','display: none');
            $('.attachment').attr('style','display: none');
            $('#post_att').attr('style','display: none');
            $('#leavetype_id').val(data.data.leavetype_id);
            $('#status_id').val(data.data.status_id);
            $('#start_date').val(data.data.start_date);
            $('#end_date').val(data.data.end_date);
            $('#staff_remarks').val(data.data.staff_remarks);
            // $('#half_day').val(data.data.half_day);
            $('.custom-option-item-check[value='+ data.data.half_day +']').click();
            // $('#category_id').val(data.data.category_id).trigger('change');
            // $('#post_add').attr('style','display: none');
            $('.table-attachment').DataTable({
                ajax: window.location.origin + '/getAttachment/' + id_leaveCont,
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'photo'},
                    {data: 'action'}
                ],
                pageLength: 5,
                destroy: true
            });
            $('#modal-type').modal('show');
        }
    });
});


// $(document).on('change', '.check', function(){ 
//     var leave_type = $('#leave_type').val();
//     if(leave_type == 2) {
//         $('#leave_type').attr('class','bg-primary')
//     } else {
//         $('#leave_type').attr('class','bg-warning')
//     }
// })