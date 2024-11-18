@extends('layouts.otClock')

@section('content')
    @include('layouts.crudDiv.clockdiv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8">
                <h2><b>MyClock</h2>
            </div>
            @role('admin|hod|sysadmin')
                <div class="col-sm-4">
                    <button id="registerNew" class="btn btn-info add-new float-end" style="text-decoration: none; color: white;">
                        <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;&nbsp;Register Staff
                    </button>
                </div>
            @endrole
        </div>
    </div><hr>

@endsection
