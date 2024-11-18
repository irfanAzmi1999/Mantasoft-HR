@foreach ($model as $m)
    <ul class="nav nav-pills mb-2">
        <li class="nav-item">
            <a class="nav-link {{($title_menu === "Profile") ? 'active' : '' }}" href="/editProfile/{{$m->id}}">
                <i data-feather="user" class="font-medium-3 me-50"></i><span class="fw-bold">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($title_menu === "Education") ? 'active' : '' }}" href="{{url('/')}}/readEducation/{{ $m->id }}">
                <i data-feather='book-open' class="font-medium-3 me-50"></i><span class="fw-bold">Educations</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($title_menu === "Relatives") ? 'active' : '' }}" href="{{url('/')}}/mainRelatives/{{ $m->id }}">
                <i class="fa-regular fa-heart font-medium-3 me-50"></i><span class="fw-bold">Relatives</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($title_menu === "Marriages") ? 'active' : '' }}" href="{{url('/')}}/readMarriage/{{ $m->id }}">
                <i class="fa-solid fa-ring font-medium-3 me-50"></i><span class="fw-bold">Marriages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($title_menu === "positions") ? 'active' : '' }}" href="{{url('/')}}/readProfilePosition/{{ $m->id }}">
                <i data-feather='circle' class="font-medium-3 me-50"></i><span class="fw-bold">Positions</span>
            </a>
        </li>
    </ul>
@endforeach