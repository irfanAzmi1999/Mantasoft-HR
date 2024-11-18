@extends('layouts.app')
@section('extra-css')
    @include('layouts.css_js.homechart.csschart')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row match-height">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title mb-1">Leave Balance</h4>
                                        <div class="font-small-2">{{ date('Y') }}</div>
                                        <h5 class="mt-1">
                                            {{ str_contains($leave->balance, '.0') ? str_replace('.0', '', $leave->balance) : $leave->balance }}
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <div id="earnings-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">My Leave</h4>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                </div>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-box font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$leaveApp}}</h4>
                                                <p class="card-text font-small-3 mb-0">Applied</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-info me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-circle-check font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$leaveapproved}}</h4>
                                                <p class="card-text font-small-3 mb-0">Approved</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-user-xmark font-medium-4"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$leaveRejected}}</h4>
                                                <p class="card-text font-small-3 mb-0">Rejected</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-house-medical-flag font-medium-4" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">
                                                    {{ str_contains($leave->mc_balance, '.0') ? str_replace('.0', '', $leave->mc_balance) : $leave->mc_balance }}
                                                </h4>
                                                <p class="card-text font-small-3 mb-0">MC Balance</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @role('admin|director|sysadmin')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Pending Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$userLeavePending}}</h3>
                                            <span class="small">Total staff leave on hold.</span>
                                        </div>
                                        <div class="avatar bg-light-warning p-50">
                                            <span class="avatar-content">
                                                <i class="fa-regular fa-circle-pause font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Approved Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$userLeaveApproved}}</h3>
                                            <span class="small">Total approved staff leave.</span>
                                        </div>
                                        <div class="avatar bg-light-success p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-check font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Rejected Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$userLeaveRejected}}</h3>
                                            <span class="small">Total rejected staff leave.</span>
                                        </div>
                                        <div class="avatar bg-light-danger p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-xmark font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Today Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('D, d M') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$userLeaveToday}}</h3>
                                            <span class="small">Total staff on leave today.</span>
                                        </div>
                                        <div class="avatar bg-light-primary p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-person-walking-arrow-right font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole
                    @role('hod')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Pending Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$underHODPendingLeave}}</h3>
                                            <span class="small">Total staff leave in department on hold.</span>
                                        </div>
                                        <div class="avatar bg-light-warning p-50">
                                            <span class="avatar-content">
                                                <i class="fa-regular fa-circle-pause font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Approved Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$underHODApprovedLeave}}</h3>
                                            <span class="small">Total approved staff leave in department.</span>
                                        </div>
                                        <div class="avatar bg-light-success p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-user-check font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Rejected Leave</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-glow bg-info font-small-2 me-25 mb-0">{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75">{{$underHODRejectedLeave}}</h3>
                                            <span class="small">Total rejected staff leave in department.</span>
                                        </div>
                                        <div class="avatar bg-light-danger p-50">
                                            <span class="avatar-content">
                                                <i class="fa-solid fa-xmark font-medium-4"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole
                    <section>
                        <div class="app-calendar overflow-hidden border">
                            <div class="row g-0">
                                <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
                                    <div class="sidebar-wrapper">
                                        <div class="card-body pb-0">
                                            <h5 class="section-label mb-1">
                                                <span class="align-middle">Filter Leave</span>
                                            </h5>
                                            <div class="form-check mb-1">
                                                <input type="checkbox" class="form-check-input select-all" id="select-all" checked>
                                                <label class="form-check-label" for="select-all">All</label>
                                            </div>
                                            <div class="calendar-events-filter">
                                                <div class="form-check form-check-success mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="annual_leave" data-value="1" checked>
                                                    <label class="form-check-label" for="annual_leave">Annual</label>
                                                </div>
                                                <div class="form-check form-check-dark mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="compassionate_leave" data-value="2" checked>
                                                    <label class="form-check-label" for="compassionate_leave">Compassionate</label>
                                                </div>
                                                <div class="form-check form-check-danger mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="emergency_leave" data-value="3" checked>
                                                    <label class="form-check-label" for="emergency_leave">Emergency</label>
                                                </div>
                                                <div class="form-check form-check-dark mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="examination_leave" data-value="4" checked>
                                                    <label class="form-check-label" for="examination_leave">Examination</label>
                                                </div>
                                                <div class="form-check form-check-primary mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="maternity_leave" data-value="5" checked>
                                                    <label class="form-check-label" for="maternity_leave">Maternity</label>
                                                </div>
                                                <div class="form-check form-check-danger mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="mc_leave" data-value="6" checked>
                                                    <label class="form-check-label" for="mc_leave">Medical/Sick</label>
                                                </div>
                                                <div class="form-check form-check-primary mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="paternity_leave" data-value="7" checked>
                                                    <label class="form-check-label" for="paternity_leave">Paternity</label>
                                                </div>
                                                <div class="form-check form-check-success mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="special_leave" data-value="8" checked>
                                                    <label class="form-check-label" for="special_leave">Special</label>
                                                </div>
                                                <div class="form-check form-check-secondary mb-1">
                                                    <input type="checkbox" class="form-check-input input-filter" id="unpaid_leave" data-value="9" checked>
                                                    <label class="form-check-label" for="unpaid_leave">Unpaid</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <img src="img/calender_footer.png" alt="Calendar illustration" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col position-relative">
                                    <div class="card shadow-none border-0 mb-0 rounded-0">
                                        <div class="card-body pb-0">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="body-content-overlay"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('extraJS')
    <script>
        var taken = {{$leave->taken}}
        var leaveBalance = {{ $leave->balance }};
    </script>
    @include('layouts.css_js.homechart.jshome')
@endsection
