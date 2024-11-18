@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.DDSearch.css')
    @include('layouts.css_js.filesUpload.css')
    @include('layouts.css_js.templateDate.css')
    @include('layouts.css_js.dataTable.cssTable')
@endsection
@section('content')
@include('layouts.crudDiv.leavediv')
<div class="table-title">
    <div class="row">
        <div class="col-sm-8"><h2><b>{{$title}}</b> Data</h2></div>
        <div class="col-sm-4">
        </div>
    </div>
</div>
<table class="table-myLeave table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Leave Taken</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@include('layouts.crudDiv.endmainCrud')
@include('myLeave.modal.index')
@section('extraJS')
    <script src="{{ asset('custom_js/Myleave.js') }}"></script>
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.dataTable.formValidations')
    @include('layouts.css_js.filesUpload.js')
    @include('layouts.css_js.DDSearch.js')
    @include('layouts.css_js.templateDate.js')
    <script>
    </script>
        <script>
            var t = $('.table-myLeave').DataTable({
                ajax: window.location.origin + '/getMyLeave/{{$id}}',
                columns: [
                    {data: null},
                    {data: 'leavetype_id'},
                    {data: 'start_date'},
                    {data: 'end_date'},
                    {data: 'date_leave'},
                    {data: 'status_id'},
                    {data: 'action'},
                ],
                pageLength: 25
            });
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        </script>


@endsection
@endsection
