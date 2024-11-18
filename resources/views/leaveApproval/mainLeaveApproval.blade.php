@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.DDSearch.css')
@endsection
@section('content')
    @include('layouts.crudDiv.leavediv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Data</h2></div>
        </div>
    </div><hr>
    <div class="table-responsive">
        <table class="table table-leaveapproval">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Half/Full Day</th>
                    <th>Leave Type</th>
                    <th>Leave Begin</th>
                    <th>Leave End</th>
                    <th>Leave Taken (Day(s))</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('leaveApproval.modals.index')
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.DDSearch.css')
    <script src={{ asset('custom_js/leaveapproval.js') }}></script>
    @role('admin|director|sysadmin')
    <script>
        var t = $('.table-leaveapproval').DataTable({
            ajax: window.location.origin + '/getAllLeave',
            columns: [
                {data: null},
                {data: 'name'},
                {data: 'department_id'},
                {data: 'half_day'},
                {data: 'leavetype_id'},
                {data: 'start_date'},
                {data: 'end_date'},
                {data: 'date_leave'},
                {data: 'status'},
                {data: 'action'}
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
    </script>
    @endrole
    @role('hod')
    <script>
        var t = $('.table-leaveapproval').DataTable({
            ajax: window.location.origin + '/getLeaveForHod',
            columns: [
                {data: null},
                {data: 'name'},
                {data: 'department_id'},
                {data: 'half_day'},
                {data: 'leavetype_id'},
                {data: 'start_date'},
                {data: 'end_date'},
                {data: 'date_leave'},
                {data: 'status'},
                {data: 'action'}
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
    </script>
    @endrole
@endsection