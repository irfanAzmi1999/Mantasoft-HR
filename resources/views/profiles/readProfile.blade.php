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
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded mt-3 mb-2" src="../images/profiles/{{ Auth::user()->getProfile->image ?? 'profile.jpg' }}" height="110" width="110">
                                        <div class="user-info text-center">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <span class="badge bg-light-secondary">{{ Auth::user()->getRoleUser->getRole->display_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around my-2 pt-75">
                                    <div class="d-flex align-items-start me-2">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <i data-feather='user-check'></i>
                                        </span>
                                        <div class="ms-75">
                                            <h5 class="mb-0">{{ Auth::user()->username }}</h5>
                                            <small>Username</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <i class="fa-solid fa-flag-usa"></i>
                                        </span>
                                        <div class="ms-75">
                                            <h5 class="mb-0">{{ Auth::user()->getProfile->getNationality->name ?? 'Not yet selected' }}</h5>
                                            <small>Nationality</small>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bolder border-bottom mb-1">Details</h4>
                                <div class="info-container">
                                    <ul class="list-unstyled">
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Full Name: </span>
                                            <span>{{ Auth::user()->name }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Email: </span>
                                            <span>{{ Auth::user()->email }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Phone Number: </span>
                                            <span>{{ Auth::user()->getProfile->phone }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Birth Date: </span>
                                            @if (Auth::user()->getProfile->dob != null)
                                                <span>{{ \Carbon\Carbon::parse(Auth::user()->getProfile->dob)->format('d-m-Y') }}</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Birth Place: </span>
                                            <span>{{ Auth::user()->getProfile->pob ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Blood Type: </span>
                                            <span>{{ Auth::user()->getProfile->getBlood->name ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Gender: </span>
                                            <span>{{ Auth::user()->getProfile->gender ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Body Height: </span>
                                            @if (Auth::user()->getProfile->height != null)
                                                <span>{{ round(Auth::user()->getProfile->height) }} cm</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Body Weight: </span>
                                            @if (Auth::user()->getProfile->weight != null)
                                                <span>{{ round(Auth::user()->getProfile->weight) }} kg</span>
                                            @endif
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">NRIC: </span>
                                            <span>{{ Auth::user()->getProfile->nokp_new ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">NRIC (old): </span>
                                            <span>{{ Auth::user()->getProfile->nokp_old ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">EPF Number: </span>
                                            <span>{{ Auth::user()->getProfile->epf ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Tax Number: </span>
                                            <span>{{ Auth::user()->getProfile->tax ?? '' }}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Address: </span>
                                            <span>{{ Auth::user()->getProfile->address ?? '' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>