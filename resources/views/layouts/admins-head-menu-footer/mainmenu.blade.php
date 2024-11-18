<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="navbar-header mb-1">
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item me-auto">
				<a class="navbar-brand" href="{{ url('/home') }}">
					<span class="brand-logo">
					<img src="{{ asset('img/email_logo.png') }}">
					</span>
					<h2 class="brand-text">
						<span style="color: #fd9044">MS</span> LEAVE
					</h2>
				</a>
			</li>
			<li class="nav-item nav-toggle">
				<a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
				<i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
				<i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
				</a>
			</li>
		</ul>
	</div>
	<div class="shadow-bottom"></div>
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="{{($title_menu === "Dashboard") ? 'active' : '' }}">
			<a class="d-flex align-items-center" href="{{ url('/home') }}">
                <i class="fa-solid fa-chart-line"></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
			</a>
			</li>
			@role('admin|director|hod|sysadmin')
			<li class=" navigation-header">
				<span data-i18n="Apps &amp; Pages">Staff Management</span>
				<i data-feather="more-horizontal"></i>
			</li>
			<li class="nav-item">
				<a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="User">Staff</span>
				</a>
				<ul class="menu-content">
					<li class="{{($title_menu === "Staffs") ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url('/listAllUser') }}">
                            <i data-feather="list"></i>
                            <span class="menu-item text-truncate" data-i18n="List">List Staff</span>
                        </a>
					</li>
				</ul>
			</li>
			@endrole
			<li class=" navigation-header">
				<span data-i18n="Apps &amp; Pages">Movement Tracker</span>
				<i data-feather="more-horizontal"></i>
			</li>
            <li class="{{($title_menu === "Clock In") ? 'active' : '' }}">
			<a class="d-flex align-items-center" href="{{ Request::root() }}/clock/0 ">
                <i class="fa-solid fa-clock"></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Clock in</span>
			</a>
			</li>
			<li class="nav-item">
				<a class="d-flex align-items-center" href="#">
                    <i data-feather="compass"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">Movement Tracker</span>
				</a>
				<ul class="menu-content">
					<li class="{{($title_menu === "Attendance") ? 'active' : '' }}">
						<a class="d-flex align-items-center" href="{{url('/')}}/listAttendance/{{ Auth::id()}}">
                            <i data-feather="list"></i>
                            <span class="menu-title text-truncate" data-i18n="Typography">List Tracker</span>
						</a>
					</li>
                    <li>
                    <!-- <li class="{{($title_menu === "overtimeApp") ? 'active' : '' }}">
						<a class="d-flex align-items-center" href="{{url('/')}}/overtimeApplication">
                            <i data-feather="file"></i>
                            <span class="menu-title text-truncate" data-i18n="Feather">Overtime Application</span>
						</a>
					</li> -->
					<li>
                    <li class="{{($title_menu === "Attendance Report") ? 'active' : '' }}">
						<a class="d-flex align-items-center" href="{{ url('/attendanceReport')}}">
                            <i data-feather="eye"></i>
                            <span class="menu-title text-truncate" data-i18n="Feather">Tracker Report</span>
						</a>
					</li>
					<li>
                        <li class="{{($title_menu === "Not Clocked Report") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{url('/')}}/notClockedReport">
                                <i data-feather="clock"></i>
                                <span class="menu-title text-truncate" data-i18n="Card">Not Clocked-in Report</span>
                            </a>
                        </li>
				</ul>
			</li>
			<li class=" navigation-header">
				<span data-i18n="Apps &amp; Pages">E-Leave</span>
				<i data-feather="more-horizontal"></i>
			</li>
            <li class="nav-item">
				<a class="d-flex align-items-center" href="#">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="User">E-Leave</span>
				</a>
                <ul class="menu-content">
                    <li class="nav-item {{($title_menu === "leaveApp") ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url('/leaveApplication') }}">
                            <i data-feather="package"></i>
                            <span class="menu-title text-truncate" data-i18n="Form Wizard">Leave Application</span>
                        </a>
                    </li>
                    <li class="nav-item {{($title_menu === "MyLeave") ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{url('/')}}/MyLeave/{{ Auth::user()->getStaff->id }}">
                            <i data-feather="check-circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Form Validation">My Leave</span>
                        </a>
                    </li>
                    @role('admin|director|hod|sysadmin')
                        <li class="nav-item {{($title_menu === "Approvals") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/leaveApproval') }}">
                                <i data-feather="user-check"></i>
                                <span class="menu-title text-truncate" data-i18n="Form Repeater">Leave Approval</span>
                            </a>
                        </li>
                        <li class="nav-item {{($title_menu === "Leave Details") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readLeaveDetails') }}">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="menu-title text-truncate" data-i18n="Form Layout">Leave Details</span>
                            </a>
                        </li>
                        @role('admin|director|sysadmin')
                            <li class="nav-item {{($title_menu === "Summaries") ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url('/leaveSummary') }}">
                                    <i class="fa-regular fa-window-maximize"></i>
                                    <span class="menu-title text-truncate" data-i18n="Table">Leave Summary</span>
                                </a>
                            </li>
                            <li class="nav-item {{($title_menu === "Unpaids") ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url('/leaveUnpaid') }}">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <span class="menu-title text-truncate" data-i18n="Table">Unpaid Leave</span>
                                </a>
                            </li>
                        @endrole
                        <li class="nav-item {{($title_menu === "Leave Report") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/leaveReport')}}">
                                <i class="fa-regular fa-file-lines"></i>
                                <span class="menu-title text-truncate" data-i18n="Table">Leave Report</span>
                            </a>
                        </li>
                    @endrole
                </ul>
            </li>
			@role('admin|sysadmin')
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Settings</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate" data-i18n="Charts">Settings</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{($title_menu === "Bloods") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readBlood') }}">
                                <i data-feather="droplet"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Blood Types</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Categories") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readCategory') }}">
                                <i data-feather="copy"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Categories</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Companies") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readCompany') }}">
                                <i class="fa-solid fa-building"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Companies</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Departments") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readDepartment') }}">
                                <i class="fa-regular fa-building"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Departments</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Emergency Types") ? 'active' : '' }}" >
                            <a class="d-flex align-items-center" href="{{ url('/readEmergencyType') }}">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Emergency Types</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Leave Types") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readLeaveType') }}">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Leave Types</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Maritals") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readMarital') }}">
                                <i class="fa-solid fa-ring"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Maritals</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Nationalities") ? 'active' : '' }}" >
                            <a class="d-flex align-items-center" href="{{ url('/readNationality') }}">
                                <i class="fa-solid fa-flag-usa"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Nationalities</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Positions") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readPosition') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Positions</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Holidays") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readHoliday') }}">
                                <i class="fa-solid fa-earth-asia"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Public Holidays</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Relations") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/mainRelations') }}">
                                <i class="fa-regular fa-heart"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Relations</span>
                            </a>
                        </li>
                        <li class="{{($title_menu === "Statuses") ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/readStatus') }}">
                                <i class="fa-solid fa-info"></i>
                                <span class="menu-item text-truncate" data-i18n="Apex">Statuses</span>
                            </a>
                        </li>
                    </ul>
                </li>
			@endrole
		</ul>
	</div>

</div>
