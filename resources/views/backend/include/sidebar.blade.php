<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- admin  --}}
                @if (auth()->check() && auth()->user()->hasRole(['admin', 'seller']))
                    <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                    </a>
                @endif


                    {{-- Members --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setupNav"
                            aria-expanded="{{ request()->is('users*') || Route::is('users.*') ? 'true' : 'false' }}" aria-controls="setupNav">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div> Members
                            <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse {{ request()->is('users*') || Route::is('users.*') ? 'show' : '' }}" id="setupNav"
                            aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav down">
                                <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}"
                                    href="{{ route('users.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Pending Members
                                </a>
                                <a class="nav-link {{ Route::is('users.active.index') ? 'active' : '' }}"
                                    href="{{ route('users.active.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Active Members
                                </a>
                                <a class="nav-link {{ Route::is('users.reject.index') ? 'active' : '' }}"
                                    href="{{ route('users.reject.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Rejected Members
                                </a>
                            </nav>
                        </div>
                    @endif
                    {{-- Members --}}

                    {{-- service --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link {{ Route::is('service.index') ? 'active' : '' }}"
                            href="{{ route('service.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Service Management
                        </a>
                    @endif
                    {{-- service --}}

                    {{-- event --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link {{ Route::is('event.index') ? 'active' : '' }}"
                            href="{{ route('event.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Event Management
                        </a>
                    @endif
                    {{-- event --}}

                    {{-- blog --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link {{ Route::is('blog.index') ? 'active' : '' }}"
                            href="{{ route('blog.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>blog Management
                        </a>
                    @endif
                    {{-- blog --}}

                    {{-- executive committee --}}
                    {{-- @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link {{ Route::is('commitee.index') ? 'active' : '' }}"
                            href="{{ route('commitee.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Executive commitee
                        </a>
                    @endif --}}



                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#executiveNav"
                            aria-expanded="{{ request()->is('admin/executive-commitee*') || Route::is('commitee.*') ? 'true' : 'false' }}" 
                            aria-controls="executiveNav">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-cog"></i></div> Committee
                            <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>
                    
                        <div class="collapse {{ request()->is('admin/executive-commitee*') || Route::is('commitee.*') ? 'show' : '' }}" id="executiveNav"
                            aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav down">
                                <a class="nav-link {{ Route::is('commitee.index') ? 'active' : '' }}"
                                    href="{{ route('commitee.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Add Committee List
                                </a>
                                <a class="nav-link {{ Route::is('commitee.running.index') ? 'active' : '' }}"
                                    href="{{ route('commitee.running.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Running Committee
                                </a>
                                <a class="nav-link {{ Route::is('commitee.funders.index') ? 'active' : '' }}"
                                    href="{{ route('commitee.funders.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Funders Committee
                                </a>
                                <a class="nav-link {{ Route::is('commitee.advisory.index') ? 'active' : '' }}"
                                    href="{{ route('commitee.advisory.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Advisory Committee
                                </a>
                                <a class="nav-link {{ Route::is('commitee.previous.index') ? 'active' : '' }}"
                                    href="{{ route('commitee.previous.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Previous Committee
                                </a>
                            </nav>
                        </div>
                    @endif
                

                    {{-- executive committee --}}

                    {{-- Partners --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link {{ Route::is('partner.index') ? 'active' : '' }}"
                            href="{{ route('partner.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Partner Management
                        </a>
                    @endif
                    {{-- Partners --}}

                    {{-- gallery --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#galleryPhoto"
                        aria-expanded="{{ request()->is('gallery.photo*') || request()->is('gallery.video*') || Route::is('gallery.photo.*') || Route::is('gallery.video.*') ? 'true' : 'false' }}"
                        aria-controls="galleryPhoto">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div> Gallery Management
                            <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse {{ request()->is('gallery.photo*') || request()->is('gallery.video*') || Route::is('gallery.photo.*') || Route::is('gallery.video.*') ? 'show' : '' }}" id="galleryPhoto"
                            aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav down">
                                <a class="nav-link {{ Route::is('gallery.photo.index') ? 'active' : '' }}"
                                href="{{ route('gallery.photo.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Add Photos
                                </a>
                                <a class="nav-link {{ Route::is('gallery.video.index') ? 'active' : '' }}"
                                href="{{ route('gallery.video.index') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Add Videos
                                </a>
                            </nav>
                        </div>
                    @endif
                    {{-- gallery --}}

                    {{-- news --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"    data-bs-target="#newsManagementNav"
                        aria-expanded="{{ request()->is('news*') || Route::is('news.*') ? 'true' : 'false' }}" aria-controls="newsManagementNav">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div> News Management
                        <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse {{ request()->is('news*') || Route::is('news.*') ? 'show' : '' }}" id="newsManagementNav"
                            aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            {{-- <a class="nav-link {{ Route::is('news.banner.index') ? 'active' : '' }}"
                                href="{{ route('news.banner.index') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> News Banner
                            </a> --}}
                            <a class="nav-link {{ Route::is('news.index') ? 'active' : '' }}"
                                href="{{ route('news.index') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> News Portal
                            </a>
                        </nav>
                        </div>
                    @endif
                     {{-- news --}}


                    {{-- notice --}}
                        @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <a class="nav-link {{ Route::is('notice.index') ? 'active' : '' }}"
                                href="{{ route('notice.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Notice
                            </a>
                        @endif
                    {{-- notice --}}


                    {{-- notification --}}
                    @if (auth()->check() && auth()->user()->hasRole('seller'))
                        @php
                            $unreadNoticesCount = App\Models\Notice::where('status', 'published')->where('seen', 0)->count();
                        @endphp

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('notices.notifindex') ? 'active' : '' }}"
                            href="{{ route('notices.notifindex') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bell"></i></div>
                                Notices <span class="badge badge-danger">{{ $unreadNoticesCount }}</span>
                            </a>
                        </li>
                    @endif
                    {{-- notification --}}

                    {{-- seller Payment --}}
                    @if (auth()->check() && auth()->user()->hasRole('seller'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#paymentNav"
                        aria-expanded="{{ request()->is('seller.payments*') || Route::is('seller.payments.*') ? 'true' : 'false' }}" 
                        aria-controls="paymentNav">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div> Payment Management
                            <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>
                    
                        <div class="collapse {{ request()->is('seller.payments*') || Route::is('seller.payments.*') ? 'show' : '' }}" 
                            id="paymentNav" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav down">
                                <a class="nav-link {{ Route::is('seller.payments.offline') ? 'active' : '' }}"
                                href="{{ route('seller.payments.offline') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Offline Payment
                                </a>
                    
                                <a class="nav-link {{ Route::is('seller.payments.history') ? 'active' : '' }}"
                                href="{{ route('seller.payments.history') }}">
                                    <i class="fa-solid fa-angles-right ikon"></i> Payment History
                                </a>
                            </nav>
                        </div>
                    @endif
                
                    {{-- seller Payment --}}


                     {{-- admin payment --}}
                     @if (auth()->check() && auth()->user()->hasRole('admin'))
                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#adminPaymentNav"
                         aria-expanded="{{ request()->is('admin.payments*') || Route::is('admin.payments.*') ? 'true' : 'false' }}" 
                         aria-controls="adminPaymentNav">
                         <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div> Payment Management
                         <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                     </a>
                 
                     <div class="collapse {{ request()->is('admin.payments*') || Route::is('admin.payments.*') ? 'show' : '' }}" 
                         id="adminPaymentNav" aria-labelledby="headingAdmin" data-bs-parent="#sidenavAccordion">
                         <nav class="sb-sidenav-menu-nested nav down">
                             <a class="nav-link {{ Route::is('admin.payments.history') ? 'active' : '' }}"
                             href="{{ route('admin.payments.history') }}">
                                 <i class="fa-solid fa-angles-right ikon"></i> Payment History
                             </a>
                         </nav>
                     </div>
                 @endif
                 
                    {{-- admin paymen --}}

                     {{-- complaint admin --}}
                        @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <a class="nav-link {{ Route::is('admin.complain.index') ? 'active' : '' }}"
                                href="{{ route('admin.complain.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Complaints
                            </a>
                        @endif
                    {{-- complaint admin --}}

                    {{-- complaint seller --}}
                        @if (auth()->check() && auth()->user()->hasRole('seller'))
                            <a class="nav-link {{ Route::is('seller.complain.index') ? 'active' : '' }}"
                                href="{{ route('seller.complain.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>Complaints
                            </a>
                        @endif
                    {{-- complaint seller --}}


                    {{-- mail admin --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"    data-bs-target="#mailsmsNav"
                        aria-expanded="{{ request()->is('admin.mail*') || Route::is('admin.mail.*') ? 'true' : 'false' }}" aria-controls="mailsmsNav">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div> Mail & Sms Room
                        <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse {{ request()->is('admin.mail*') || Route::is('admin.mail.*') ? 'show' : '' }}" id="mailsmsNav"
                            aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
    
                            <a class="nav-link {{ Route::is('admin.mail.form') ? 'active' : '' }}"
                                href="{{ route('admin.mail.form') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> Email
                            </a>
                        </nav>
                        </div>
                    @endif
                    {{-- mail admin --}}


                     {{-- Settings --}}
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"    data-bs-target="#settingsManagementNav"
                        aria-expanded="{{ request()->is('admin/setting*') || Route::is('admin.setting.*') ? 'true' : 'false' }}" aria-controls="settingsManagementNav">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-cog"></i></div> Settings
                        <div class="sb-sidenav-collapse-arrow text-white"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse {{ request()->is('admin/setting*') || Route::is('admin.setting.*') ? 'show' : '' }}" id="settingsManagementNav"
                        aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            <a class="nav-link {{ Route::is('admin.setting.general') ? 'active' : '' }}"
                                href="{{ route('admin.setting.general') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> General Settings
                            </a>
                            <a class="nav-link {{ Route::is('admin.setting.static.content') ? 'active' : '' }}"
                                href="{{ route('admin.setting.static.content') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> Static Content Settings
                            </a>
                            <a class="nav-link {{ Route::is('admin.setting.legal.content') ? 'active' : '' }}"
                                href="{{ route('admin.setting.legal.content') }}">
                                <i class="fa-solid fa-angles-right ikon"></i> Legal Content Settings
                            </a>
                        </nav>
                        </div>
                    @endif
                     {{-- Settings --}}



        </div>
    </nav>
</div>
