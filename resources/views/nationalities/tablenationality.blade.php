@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.DDSearch.css')
@endsection
@section('content')
    @include('layouts.crudDiv.mainCrudDiv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Data</h2></div>
            <div class="col-sm-4">
                <button id="registerNationality" class="btn btn-info add-new float-end" style="text-decoration: none; color: white;">
                    <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;&nbsp;New Data
                </button>
            </div>
        </div>
    </div><hr>
    <div class="table-responsive">
        <table class="nationalities-table table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nationality</th>
                    <th>Action(s)</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('nationalities.modals.index')
    @include('layouts.crudDiv.endmainCrud')
    @section('extraJS')
        @include('layouts.css_js.dataTable.jsTable')
        @include('layouts.css_js.DDSearch.js')
        <script src={{ asset('custom_js/nationality.js') }}></script>
    @endsection
@endsection