@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.templateDate.css')
    @include('layouts.css_js.DDSearch.css')
@endsection

    <style>
        tr:nth-child(1) {
    background-color: #e0e2e4;
    }
    </style>

@section('content')
    @include('layouts.crudDiv.attendancediv')
    <div class="table-title">
    <div class="row">
        <div class="col-sm-8"><h2><b>{{$title}}</b> Data</h2></div>
    </div>
    
            <div class="col-sm-4">                
<a href="{{ Request::root() }}/clock/0 "><button class="btn btn-primary"> Clock In Form </button></a>
            </div><hr>


    <table class="table-attendanceDetails table">
        <thead>
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">Time In</th>
                <th class="text-center">Location (In)</th> 
                <th class="text-center">Photo (In)</th>                
                <th class="text-center">Time Out</th>
                <th class="text-center">Location (Out)</th>
                <th class="text-center">Photo (Out)</th> 
                <th class="text-center">Clock Out</th>
            </tr>
        </thead>
    </table>
    
    @include('layouts.crudDiv.endmainCrud')
    <input type="hidden" id="user-id" value="{{$id}}">
    @section('extraJS')
        @include('layouts.css_js.dataTable.jsTable')
        @include('layouts.css_js.dataTable.formValidations')
        @include('layouts.css_js.DDSearch.js')
       
        <script src="{{ asset('custom_js/AttendanceList.js') }}"></script>
    @endsection
@endsection