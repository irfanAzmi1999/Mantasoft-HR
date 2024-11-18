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
        <table class="table table-leavesummary">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Staff Name</th>
                    <th>Department</th>
                    <th>Balance/Entitled<br>(Days in Year)</th>
                    <th>Taken (Days)</th>
                    <th>MC Balance/Entitled<br>(Days in Year)</th>
                    <th>MC Taken (Days)</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('leaveSummary.modals.index')
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.DDSearch.js')
    <script src={{ asset('custom_js/leavesummary.js') }}></script>
    <script>
        var t = $(".table-leavesummary").DataTable({
            ajax: window.location.origin + "/getAllSummary",
            columns: [{ data: null }, { data: "name" }, { data: "department_id" }, { data: "balance/default" }, { data: "taken" }, { data: "mc_balance/mc_default" }, { data: "mc_taken" }, { data: "action" }],
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