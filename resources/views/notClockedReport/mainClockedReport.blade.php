@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.DDSearch.css')
@endsection
@section('content')
    @include('layouts.crudDiv.attendancediv')
    <div class="content-body">
        <div class="row">
                <form class="form form-horizontal" action="/printnotClockedReport" method="post" enctype="multipart/form-data" target="_blank" rel="noopener noreferrer">
                    @csrf
                    <div id="story" class="card story">
                        <div class="card-header">
                            <h4 class="card-title">Not Clocked-in List</h4>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="fname-icon">Department</label>
                                        </div>
                                        <div id="leave_form" class="col-9 mb-1 mb-sm-0">
                                            @role('admin|director|sysadmin')
                                                <select class="col-sm-3 form-control form-select select2 input-group" name="departmentStaff" id="departmentStaff" required>
                                                    <option value="" disabled="disabled" selected="selected">Select department...</option>
                                                    <option value="0" selected="selected">ALL</option>
                                                    @foreach ($department as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endrole
                                            @role('hod')
                                                <input class="form-control" type="text" value="{{ $hodDepartment->getDepartment->name }}" readonly>
                                                <input class="form-control" type="hidden" value="{{ $hodDepartment->getDepartment->id }}" name="departmentStaff" id="departmentStaff">
                                            @endrole
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="email-icon">Start Date</label>
                                        </div>
                                        <!-- <div id="leave_form" class="col-9 mb-1 mb-sm-0">
                                            <select class="col-sm-3 form-control form-select select2 input-group" name="monthClocked" id="monthClocked" required>
                                                <option value="" disabled="disabled" selected="selected">Select month...</option>
                                                <option name="JANUARY" value="1">JANUARY</option>
                                                <option name="FEBRUARY" value="2">FEBRUARY</option>
                                                <option name="MARCH" value="3">MARCH</option>
                                                <option name="APRIL" value="4">APRIL</option>
                                                <option name="MAY" value="5">MAY</option>
                                                <option name="JUNE" value="6">JUNE</option>
                                                <option name="JULY" value="7">JULY</option>
                                                <option name="AUGUST" value="8">AUGUST</option>
                                                <option name="SEPTEMBER" value="9">SEPTEMBER</option>
                                                <option name="OCTOBER" value="10">OCTOBER</option>
                                                <option name="NOVEMBER" value="11">NOVEMBER</option>
                                                <option name="DECEMBER" value="12">DECEMBER</option>
                                            </select>
                                        </div> -->
                                        <div class="col-9 mb-1 mb-sm-0">
                                        <input type="date" id="start_date" name="start_date" class="bg-white form-control" placeholder="Start Date (D-M-Y)" required>
                                        <strong id="startError" class="col-form-label text-danger" style="display: none">Select a start date.</strong>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="email-icon">End Date</label>
                                        </div>
                                        
                                            <!-- <select class="col-sm-3 form-control form-select select2 input-group" name="yearLeave" id="yearLeave" required>
                                                <option value="" disabled="disabled" selected="selected">Select year...</option>
                                                @for($i = 0; $i < 5; $i++)
                                                    <option value="{{ $currentYear - $i }}">{{ $currentYear - $i }}</option>
                                                @endfor
                                            </select> -->
                                            <div class="col-9 mb-1 mb-sm-0">
                                            <input type="date" id="end_date" name="end_date" class="bg-white form-control" placeholder="End Date (D-M-Y)"  min="1997-01-01" max="2030-12-31" required>
                                            <strong id="endError" class="col-form-label text-danger" style="display: none">Select an end date.</strong>
                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-outline-primary waves-effect">
                                        <i data-feather='file-text'></i>&nbsp;&nbsp;
                                        <span>Print</span>
                                    </button>&nbsp;
                                </div>
                            
                        </div>
                    </div>
                </form>
            
          </div>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="currentMonth" value="{{ $currentMonth }}">
    <input type="hidden" id="currentYear" value="{{ $currentYear }}">

    @include('layouts.crudDiv.endleavediv2')
@endsection
@section('extraJS')
    @include('layouts.css_js.DDSearch.js')
    <script src={{ asset('custom_js/notClockedReport.js') }}></script>
@endsection