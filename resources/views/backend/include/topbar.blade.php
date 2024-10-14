<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <a class="navbar-brand text-center ps-3" target="_blank" href="">
        {{-- <img src="{{ asset('assets/img/logo.png') }}"
            class="w-100" alt="Logo"> --}}
            <img src="{{ Helper::getSettings('site_logo') ? asset('uploads/settings/' . Helper::getSettings('site_logo')) : asset('assets/img/no-img.jpg') }}"
             alt="Logo">
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fa-solid fa-bars"></i>
    </button>
    <ul class="d-flex align-items-center list-none ms-auto me-0 me-md-3 my-2 my-md-0 me-lg-4 gap-3">
        <li class="admin-profile">
            <div class="dropdown">
                <button class="topimage btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="profile-img"
                        src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('assets/img/no-img.jpg') }}"
                        alt="profile image">
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.setting') }}">
                            <i class="fa-solid fa-gear"></i> Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
