@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.DDsearch.css')
    @include('layouts.css_js.templateDate.css')
@endsection
@section('content')
    @include('profiles.readProfile')
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        @include('profiles.headNavPan')
        <div class="card mt-3">
            <div class="card">
                <div class="card-header border-bottom">
                    @foreach ($model as $m)
                    <h4 class="card-title">Profile Details</h4>
                </div>
                <div class="card-body py-2 my-25">
                    <div class="d-flex">
                        <form class="pt-50" action="/updateProfile" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" class="form-control" value="{{ $m->id }}">
                            <input type="hidden" name="user_id" class="form-control" value="{{ $m->getUser->id }}">
                            <div class="d-flex mb-2">
                                <div class="me-25">
                                    <img src="../images/profiles/{{ $m->image ?? "profile.jpg" }}" class="uploadedAvatar rounded me-50" height="100" width="100">
                                </div>
                                <div class="d-flex align-items-end ms-1">
                                    <div>
                                        <p class="mb-1">Current Image: {{ $m->image ?? 'profile image file not found.' }}</p>
                                        <input type="file" class="form-control btn-primary mb-75 me-75" name="image">
                                        <p class="mb-0">Allowed profile image file extension: .png, .jpg, .jpeg.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name_user" value="{{ $m->getUser->name }}" placeholder="Full name">
                                </div>
                                <div class="col-sm-6 mb-0">
                                    <div>
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control char-textarea" name="username_user" value="{{ $m->getUser->username }}" placeholder="Username" maxlength="15">
                                    </div>
                                    <small class="textarea-counter-value float-end">max. username length <span class="char-count">0</span>/15</small>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email_user" value="{{ $m->getUser->email }}" placeholder="Email">
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $m->phone }}" placeholder="Phone Number">
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Nationality</label>
                                    <select class="form-control form-select select2" name="nationality_id">
                                        <option value="" disabled="disabled" selected="selected">Select nationality...</option>
                                        @foreach ($nationality as $n)
                                            @if ($n->id == $m->nationality_id)
                                                <option selected value="{{ $n->id }}">{{ $n->name }}</option>
                                            @else
                                                <option value="{{ $n->id }}">{{ $n->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" name="pob" value="{{ $m->pob }}" placeholder="Birth Place">
                                </div>
                                <div class="col-12 col-sm-4 mb-1">
                                    <label class="form-label">Birth Date</label>
                                    @if($m->dob != null)
                                        <input type="text" name="dob" class="bg-white form-control flatpickr-basic" value="{{ date('d-m-Y', strtotime($m->dob)) }}" placeholder="Birth Date (D-M-Y)">
                                    @else
                                        <input type="text" name="dob" class="bg-white form-control flatpickr-basic" placeholder="Birth Date (D-M-Y)">
                                    @endif
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label">Age</label>
                                    <input type="text" class="form-control" name="age" readonly>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control form-select select2" name="gender">
                                        <option disabled="disabled" selected="selected" readonly="readonly">{{ $m->gender ?? 'Select gender...' }}</option>
                                        @if ($m->gender == "")
                                            <option value="FEMALE">FEMALE</option>
                                            <option value="MALE">MALE</option>
                                        @elseif ($m->gender == "MALE")
                                            <option value="FEMALE">FEMALE</option>
                                        @else
                                            <option value="MALE">MALE</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label">Blood Type</label>
                                    <select class="form-control form-select select2" name="blood_id">
                                        <option value="" disabled="disabled" selected="selected">Select blood...</option>
                                        @foreach ($blood as $b)
                                            @if ($b->id == $m->blood_id)
                                                <option selected value="{{ $b->id }}">{{ $b->name }}</option>
                                            @else
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label">Body Height (cm)</label>
                                    @if(str_contains($m->height, '.0'))
                                        <input type="number" class="form-control" name="height" value="{{ str_replace('.0', '', $m->height) }}" placeholder="Body Height" maxlength="3">
                                    @else
                                        <input type="number" class="form-control" name="height" value="{{ $m->height }}" placeholder="Body Height" maxlength="3">
                                    @endif
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label">Body Weight (kg)</label>
                                    @if(str_contains($m->weight, '.0'))
                                        <input type="number" class="form-control" name="weight" value="{{ str_replace('.0', '', $m->weight) }}" placeholder="Body weight" maxlength="3">
                                    @else
                                        <input type="number" class="form-control" name="weight" value="{{ $m->weight }}" placeholder="Body Weight" maxlength="3">
                                    @endif
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">NRIC</label>
                                    <input type="text" name="nokp_new" class="form-control"  maxlength="20" value="{{ $m->nokp_new }}" placeholder="NRIC">
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">NRIC (old)</label>
                                    <input type="text" name="nokp_old" class="form-control" value="{{ $m->nokp_old }}" placeholder="NRIC (old)">
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">EPF Number</label>
                                    <input type="text" name="epf" class="form-control" value="{{ $m->epf }}" placeholder="EPF Number">
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Tax Number</label>
                                    <input type="text" name="tax" class="form-control" value="{{ $m->tax }}" placeholder="Tax Number">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea data-length="100" maxlength="100" class="form-control char-textarea" rows="3" style="height: 100px" name="address" placeholder="Address">{{ $m->address }}</textarea>
                                    <small class="textarea-counter-value float-end">max. address length <span class="char-count">0</span>/100</small>
                                </div>
                            </div>
                            @endforeach
                            <div class="border-bottom mt-2">
                                <h4 class="card-title">Staff Details</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Role</label>
                                    <input type="text" name="role" class="form-control" value="{{ Auth::user()->getRoleUser->getRole->display_name }}" placeholder="Role" readonly>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Department</label>
                                    <input type="text" name="Department" class="form-control" value="{{ Auth::user()->getStaff->getDepartment->name }}" placeholder="Department" readonly>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Superior</label>
                                    <input type="text" name="superior" class="form-control" value="{{ Auth::user()->getStaff->getSuperior->name ?? '' }}" placeholder="Superior" readonly>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label">Employment Date</label>
                                    <input type="text" name="employee_date" class="form-control" value={{ date('d-m-Y', strtotime(Auth::user()->getStaff->employ_date)) }} placeholder="Employment Date (D-M-Y)" readonly>
                                </div>
                            </div>
                            <div class="d-grid col-md-12 text-center">
                                <button type="submit" class="d-grid col-md-12 text-center btn btn-primary mt-1 me-1">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.DDsearch.js')
    @include('layouts.css_js.templateDate.js')
@endsection