<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section class="app-user-view-account">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="user-avatar-section">
                                    @foreach ($model as $m)
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded mt-3 mb-2" src="../images/profiles/{{ $m->image ?? 'profile.jpg' }}" height="110" width="110">
                                        <div class="user-info text-center">
                                            <h4>{{ $m->getUser->name }}</h4>
                                            <span class="badge bg-light-secondary">{{ $m->getUser->getRoleUser->getRole->display_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around my-2 pt-75">
                                    <div class="d-flex align-items-start me-2">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <i data-feather='user-check'></i>
                                        </span>
                                        <div class="ms-75">
                                            <h5 class="mb-0">{{ $m->getUser->username }}</h5>
                                            <small>Username</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <i class="fa-solid fa-flag-usa"></i>
                                        </span>
                                        <div class="ms-75">
                                            <h5 class="mb-0">{{ $m->getNationality->name ?? 'Not yet selected' }}</h5>
                                            <small>Nationality</small>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bolder border-bottom mb-1">Details</h4>
                                <div class="info-container">
                                    <ul class="list-unstyled">
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Full Name: </span>
                                            <span>{{ $m->getUser->name }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Email:</span>
                                            <span>{{ $m->getUser->email }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Phone Number: </span>
                                            <span>{{ $m->phone }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Birth Date: </span>
                                            @if ($m->dob != null)
                                                <span>{{ \Carbon\Carbon::parse($m->dob)->format('d-m-Y') }}</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Birth Place: </span>
                                            <span>{{ $m->pob ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Blood Type: </span>
                                            <span>{{ $m->getBlood->name ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Gender: </span>
                                            <span>{{ $m->gender ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Body Height: </span>
                                            @if ($m->height != null)
                                                <span>{{ round($m->height) }} cm</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Body Weight:</span>
                                            @if ($m->weight != null)
                                                <span>{{ round($m->weight) }} kg</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">NRIC: </span>
                                            <span>{{ $m->nokp_new ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">NRIC (old): </span>
                                            <span>{{ $m->nokp_old ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">EPF Number: </span>
                                            <span>{{ $m->epf ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Tax Number: </span>
                                            <span>{{ $m->tax ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Address: </span>
                                            <span>{{ $m->address ?? '' }}</span>
                                        </li>
                                    </ul>
                                    @endforeach                                    
                                </div>
                            </div>
                        </div>
                    </div>