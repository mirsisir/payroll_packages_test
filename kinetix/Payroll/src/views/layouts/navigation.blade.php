<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item active">
            <a class="nav-link"
                href="/dashboard">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link"
                href="/department">
                <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
                <span class="menu-title">Department</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false"
                aria-controls="employees">
                <span class="icon-bg"><i class="mdi mdi-worker menu-icon"></i></span>
                <span class="menu-title">Employee</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="employees">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="/employees/create">Add Employee</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/employees">Employee Lists</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#applications1" aria-expanded="false"
               aria-controls="applications1">
                <span class="icon-bg"><i class="mdi mdi-application menu-icon"></i></span>
                <span class="menu-title">Attendance</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="applications1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('attendance')}}">Employee Attendance</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('primary_attendance_report')}}">Attendance Report</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('details_attendance_report')}}">Attendance Report <br> details</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#applications" aria-expanded="false"
                aria-controls="applications">
                <span class="icon-bg"><i class="mdi mdi-application menu-icon"></i></span>
                <span class="menu-title">Leave Applications</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="applications">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="/applications/create">Add Application</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/applications">Application Lists</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#loans" aria-expanded="false"
                aria-controls="loans">
                <span class="icon-bg"><i class="mdi mdi-water-percent menu-icon"></i></span>
                <span class="menu-title">Loan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="loans">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/loans/create">Add Loan</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/loans">Loan Lists</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#salary" aria-expanded="false"
                aria-controls="salary">
                <span class="icon-bg"><i class="mdi mdi-wallet-giftcard menu-icon"></i></span>
                <span class="menu-title">Salary</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="salary">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/salary_info">Salary Info</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/salary-sheet">Salary Sheet</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/payslip">Payslip</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false"
                aria-controls="settings">
                <span class="icon-bg"><i class="mdi mdi-settings menu-icon"></i></span>
                <span class="menu-title">Setttings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="/set-working-days">Set Working Days</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/holidays">Holiday Lists</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/leave-categories">Leave Category</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item sidebar-user-actions">
            <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-img">
                                {{-- <img src="https://www.bootstrapdash.com/demo/connect-plus/laravel/template/demo_1/assets/images/faces/face28.png"
                                    alt="image"> --}}
                            </div>
                            <div class="sidebar-profile-text">
                                <p class="mb-1">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="badge badge-danger">3</div> --}}
                </div>
            </div>
        </li>

        <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">

                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <i class="mdi mdi-logout menu-icon"></i>
                     <span class="menu-title">Log Out</span>
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
            </div>
        </li>
    </ul>
</nav>
