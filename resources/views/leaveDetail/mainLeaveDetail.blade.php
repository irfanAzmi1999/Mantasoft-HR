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
        <table class="table table-leavedetail">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Employment Date</th>
                    <th>Annual Leave Taken/Balance</th>
                    <th>Annual MC Leave Taken/Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('leaveDetail.modals.index')
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.DDSearch.css')
    <script src={{ asset('custom_js/leavedetail.js') }}></script>
    @role('admin|director|sysadmin')
    <script>
        var t = $('.table-leavedetail').DataTable({
            ajax: window.location.origin + '/getLeaveDetails',
            columns: [
                {data: null},
                {data: 'name'},
                {data: 'department_id'},
                {data: 'employ_date'},
                {data: 'taken/balance'},
                {data: 'mc_taken/balance'},
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
        var t = $('.table-leavedetail').DataTable({
            ajax: window.location.origin + '/getLeaveDetailsForHod',
            columns: [
                {data: null},
                {data: 'name'},
                {data: 'department_id'},
                {data: 'employ_date'},
                {data: 'taken/balance'},
                {data: 'mc_taken/balance'},
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