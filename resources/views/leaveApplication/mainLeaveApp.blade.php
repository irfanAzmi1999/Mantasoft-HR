@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.DDSearch.css')
    @include('layouts.css_js.templateDate.css')
@endsection
@section('content')
    @include('layouts.crudDiv.leavediv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Form</h2></div>
        </div>
    </div><hr>
    <form action="/createLeaveApp" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div id="story" class="card story">
            @foreach ($staff as $s)
                <input type="hidden" name="staff_id" class="form-control" value="{{$s->id}}">
                <div class="row">
                    <div class="col-12 mb-1">
                        <label style="margin-bottom: 0.25em"><strong>Approver</strong></label>
                        <input type="text" id="approver" name="approver" class="form-control" value="{{ $s->getSuperior->name ?? "No Superior associated with you!"}}" placeholder="Approver" readonly>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 col-sm-12 mb-1 mb-sm-0" id="leave">
                    <label style="margin-bottom: 0.25em"><strong>Leave Type</strong></label>
                    <select class="form-control form-select select2" name="leavetype_id" id="leavetype_id" required onchange="check()">
                        <option value="" disabled="disabled" selected="selected">Select leave type...</option>
                        @foreach($model as $m)
                            @foreach($quota as $q)
                                {{-- HAS ALL > 0 --}}
                                @if($q->balance > 0.0 && $q->mc_balance > 0.0 && $q->maternity > 0 && $q->paternity > 0)
                                    @if(!str_contains($m, 'UNPAID'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif
                                {{-- HAS MATERNITY & PATERNITY = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance > 0.0 && $q->maternity == 0 && $q->paternity == 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MATERNITY') && !str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS MATERNITY = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance > 0.0 && $q->maternity == 0 && $q->paternity > 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS PATERNITY = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance > 0.0 && $q->maternity > 0 && $q->paternity == 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS MC = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance == 0.0 && $q->maternity > 0 && $q->paternity > 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS MC & MATERNITY = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance == 0.0 && $q->maternity == 0 && $q->paternity > 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && !str_contains($m, 'MATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS MC & PATERNITY = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance == 0.0 && $q->maternity > 0 && $q->paternity == 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && !str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS ALL BUT DEFAULT = 0 --}}
                                {{-- @elseif($q->balance > 0.0 && $q->mc_balance == 0.0 && $q->maternity == 0 && $q->paternity == 0)
                                    @if(!str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && !str_contains($m, 'MATERNITY') && !str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS DEFAULT = 0 --}}
                                {{-- @elseif($q->balance == 0.0 && $q->mc_balance > 0.0 && $q->maternity > 0 && $q->paternity > 0)
                                    @if(str_contains($m, 'UNPAID') && str_contains($m, 'MEDICAL/SICK') && str_contains($m, 'MATERNITY') && str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS DEFAULT & MC = 0 --}}
                                {{-- @elseif($q->balance == 0.0 && $q->mc_balance == 0.0 && $q->maternity > 0 && $q->paternity > 0)
                                    @if(str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && str_contains($m, 'MATERNITY') && str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS ALL BUT MATERNITY = 0 --}}
                                {{-- @elseif($q->balance == 0.0 && $q->mc_balance == 0.0 && $q->maternity > 0 && $q->paternity == 0)
                                    @if(str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && str_contains($m, 'MATERNITY') && !str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS ALL BUT PATERNITY = 0 --}}
                                {{-- @elseif($q->balance == 0.0 && $q->mc_balance == 0.0 && $q->maternity == 0 && $q->paternity > 0)
                                    @if(str_contains($m, 'UNPAID') && !str_contains($m, 'MEDICAL/SICK') && !str_contains($m, 'MATERNITY') && str_contains($m, 'PATERNITY'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif --}}
                                {{-- HAS ALL = 0 --}}
                                @else
                                    @if(str_contains($m, 'UNPAID'))
                                        <option value="{{$m->id}}">{{$m->name}}</option>
                                    @else
                                        <option value="{{$m->id}}" disabled>{{$m->name}}</option>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                    <strong id="leaveTypeError" class="col-form-label text-danger" style="display: none">Select a leave type.</strong>
                </div>
                <div class="col-12 col-sm-6 mb-1 mb-sm-0" id="emer" style="display: none;">
                    <label style="margin-bottom: 0.25em"><strong>Emergency Type</strong></label>
                    <select class="form-control form-select select2" name="emergencytype_id" id="emergencytype_id">
                        <option value="" disabled="disabled" selected="selected">Select emergency type...</option>
                        @foreach($emergency as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                        @endforeach
                    </select>
                    <strong id="emergencyTypeError" class="col-form-label text-danger" style="display: none">Select an emergency type.</strong>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Leave Start Date</strong></label>
                    <input type="date" id="start_date" name="start_date" class="bg-white form-control" placeholder="Leave Start Date (D-M-Y)" required>
                    <strong id="startError" class="col-form-label text-danger" style="display: none">Select a start date.</strong>
                </div>
                <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Leave End Date</strong></label>
                    <input type="date" id="end_date" name="end_date" class="bg-white form-control" placeholder="Leave End Date (D-M-Y)"  min="1997-01-01" max="2030-12-31" required>
                    <strong id="endError" class="col-form-label text-danger" style="display: none">Select an end date.</strong>
                </div>
                <div class="col-sm-2 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Total Leave Day(s)</strong></label>
                    <input type="text" id="date_leave" name="date_leave" class="form-control" placeholder="Total Leave Day(s)"  min="1997-01-01" max="2030-12-31" readonly>
                </div>
            </div>
            <div class="row custom-options-checkable g-1 mt-0">
                <label style="margin-bottom: 0.25em"><strong>Half/Full Day Leave</strong></label>
                <div class="col-sm-4 col-12 mt-0">
                    <input class="custom-option-item-check" type="radio" name="half_day" id="customOptionsCheckableRadios1" value="0" checked>
                    <label class="custom-option-item p-1" for="customOptionsCheckableRadios1">
                        <span class="d-flex justify-content-between flex-wrap mb-50">
                            <span class="fw-bolder">Full Day</span>
                            <span class="fw-bolder"><i data-feather='sun'></i></span>
                        </span>
                        <small class="d-block">Staff will take a full working day leave.</small>
                    </label>
                </div>
                <div class="col-sm-4 col-12 mt-0">
                    <input class="custom-option-item-check" type="radio" name="half_day" id="customOptionsCheckableRadios2" value="1">
                    <label class="custom-option-item p-1" for="customOptionsCheckableRadios2">
                        <span class="d-flex justify-content-between flex-wrap mb-50">
                            <span class="fw-bolder">Half Day Morning</span>
                            <span class="fw-bolder"><i data-feather='sunrise'></i></span>
                        </span>
                        <small class="d-block">Staff will be out of work from 9:00 a.m. until 2:00 p.m.</small>
                    </label>
                </div>
                <div class="col-sm-4 col-12 mt-0">
                    <input class="custom-option-item-check" type="radio" name="half_day" id="customOptionsCheckableRadios3" value="2">
                    <label class="custom-option-item p-1" for="customOptionsCheckableRadios3">
                        <span class="d-flex justify-content-between flex-wrap mb-50">
                            <span class="fw-bolder">Half Day Evening</span>
                            <span class="fw-bolder"><i data-feather='sunset'></i></span>
                        </span>
                        <small class="d-block">Staff will be out of work from 12:00 p.m. until 6:00 p.m.</small>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <label style="margin-bottom: 0.25em"><strong>Reason</strong></label>
            <textarea class="form-control char-textarea" rows="3" style="height: 100px" id="staff_remarks" name="staff_remarks" placeholder="Reason" data-length="150" maxlength="150" required oninput="this.value = this.value.toUpperCase()"></textarea>
            <small class="textarea-counter-value float-end">max. reason length: <span class="char-count">0</span>/150</small>
            <strong id="remarksError" class="col-form-label text-danger" style="display: none">Fill in the reason.</strong>
        </div>
        <div class="col-12 mb-2">
            <div class="border rounded p-2">
                <h4 class="mb-1">Attachment(s)</h4>
                <div class="d-flex flex-column flex-md-row">
                    <img src="img/image_not_found.svg" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="170" height="110" alt="default images">
                    <div class="featured-info">
                        <small class="text-muted mt-1"><- if the first file image, it will display here.</small>
                        <p class="my-50" >
                            <a href="#" style="display: none;" id="blog-image-text">the first file is empty.jpg</a>
                        </p>
                        <div class="d-inline-block">
                            <input type="file" class="form-control btn-primary mt-1" id="attachments" name="attachments[]" multiple>
                            <strong id="attachError" class="col-form-label text-danger" style="display: none">Select at least one attachment.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid col-md-12 text-center mb-2">
            <button type="submit" id="post_add" class="btn btn-primary waves-effect waves-float waves-light">Apply Leave</button>
        </div>
    </form>
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.DDSearch.js')
    @include('layouts.css_js.templateDate.js')
    <script src={{ asset('custom_js/leaveapp.js') }}></script>
@endsection