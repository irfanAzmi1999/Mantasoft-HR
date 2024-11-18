@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.templateDate.css')
    @include('layouts.css_js.DDsearch.css')
@endsection
@section('content')
    @include('layouts.crudDiv.overtimediv')
    <div class="table-title">
    <div class="row">
        <div class="col-sm-8"><h2><b>{{$title}}</b> Data</h2></div>
    </div>

    <div class="col-sm-4">
                <a href="{{ Request::root() }}/otClock/0 "><button class="btn btn-primary"> Overtime Clock In Form </button></a>
            </div><hr>
    
    <table class="table-overtimeDetails table">
        <thead>
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">Time In</th>
                <th class="text-center">Location (In)</th>
                <th class="text-center">Time Out </th>
                <th class="text-center">Location (Out)</th>
                <th class="text-center">Clock Out</th>
            </tr>
        </thead>
    </table>
    @include('layouts.crudDiv.endmainCrud')
    <input type="hidden" id="user-id" value="{{$id}}">
    @section('extraJS')
        @include('layouts.css_js.dataTable.jsTable')
        @include('layouts.css_js.dataTable.formValidations')
        @include('layouts.css_js.DDsearch.js')
       
        <script src="{{ asset('custom_js/OvertimeList.js') }}"></script>
    @endsection
@endsection