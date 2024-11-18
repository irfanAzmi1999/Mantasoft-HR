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
        <table class="table table-leaveunpaid">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Staff Name</th>
                    <th>Department</th>
                    <th>Total Unpaid (Year&nbsp;{{$currentYear}})</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <input type="hidden" id="currentYear" value="{{ $currentYear }}">
    @include('leaveUnpaid.modals.index')
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.DDSearch.js')
    <script src={{ asset('custom_js/leaveunpaid.js') }}></script>
    <script>
        var t = $(".table-leaveunpaid").DataTable({
            ajax: window.location.origin + "/getAllUnpaid",
            columns: [{ data: null }, { data: "name" }, { data: "department_id" }, { data: "unpaid" }, { data: "action" }],
            pageLength: 25,
        });
        t.on("order.dt search.dt", function () {
            t.column(0, { search: "applied", order: "applied" })
                .nodes()
                .each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
        }).draw();
    </script>
@endsection