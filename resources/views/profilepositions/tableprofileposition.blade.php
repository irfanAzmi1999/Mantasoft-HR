@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.DDsearch.css')
@endsection
@section('content')
    @include('profiles.readallprofile')
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        @include('profiles.allProfileNavPan')
        <div class="card">
            <div class="card-body">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Data</h2></div>
                        <div class="col-sm-4">
                            <button id="newProfilePosition" class="btn btn-info add-new float-end" style="text-decoration: none; color: white;">
                                <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;&nbsp;New Data
                            </button>
                        </div>
                    </div>
                </div><hr>
                <div class="table-responsive">
                    <table class="table-Positions table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Position</th>  
                                <th>Department</th>  
                                <th>Action(s)</th> 
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('profilepositions.modals.index')
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')    
    @include('layouts.css_js.DDsearch.js')
    <script src={{ asset('custom_js/profileposition.js') }}></script>
    <script>
        var t = $(".table-Positions").DataTable({
            ajax: window.location.origin + "/getProfilePositions/{{$id}}",
            columns: [
                {data: null},
                {data: "position_id"},
                {data: "department_id"},
                {data: "action"}
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
@endsection