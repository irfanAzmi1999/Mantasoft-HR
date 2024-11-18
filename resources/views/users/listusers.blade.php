@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.dataTable.cssTable')
    @include('layouts.css_js.DDSearch.css')
    @include('layouts.css_js.templateDate.css')
@endsection
@section('content')
    @include('layouts.crudDiv.mainCrudDiv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8">
                <h2><b>{{$title}}</b>&nbsp;Data</h2>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @role('admin|hod|sysadmin')
                <div class="col-sm-4">
                    <button id="registerNew" class="btn btn-info add-new float-end" style="text-decoration: none; color: white;">
                        <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;&nbsp;Register Staff
                    </button>
                </div>
            @endrole
        </div>
    </div><hr>
    <div class="table-responsive">
        @role('admin|director|sysadmin')
            <table class="table listusers-table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Department / Superior</th>
                        <th>Phone</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
            </table>
            @include('users.modals.registerUserAdmin')
            @include('users.modals.updateModal')
        @endrole
        @role('hod')
            <table class="table usersunderhod-table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Action(s)</th>
                    </tr>
                </thead>
            </table>
            @include('users.modals.registerUserHod')
        @endrole
    </div>
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.dataTable.jsTable')
    @include('layouts.css_js.DDSearch.js')
    @include('layouts.css_js.templateDate.js')
    @role('admin|director|sysadmin')
        <script src={{asset('custom_js/registernew-allusers.js')}}></script>
    @endrole
    @role('hod')
        <script src={{asset('custom_js/registernew-underhod.js')}}></script>
    @endrole
@endsection
