<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="" class="text-nowrap logo-img">
                <img src="{{ asset('images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{-- sidebar item untuk admin --}}
                @if (Auth::user()->role_id == 1)
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="fas fa-home fa-lg"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/lokasiKantor" aria-expanded="false">
                            <span>
                                <i class="fas fa-building fa-lg"></i>
                            </span>
                            <span class="hide-menu">Lokasi Kantor</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/divisi" aria-expanded="false">
                            <span>
                                <i class="fas fa-users-cog fa-lg"></i>
                            </span>
                            <span class="hide-menu">Divisi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/karyawan" aria-expanded="false">
                            <span>
                                <i class="fas fa-users fa-lg"></i>
                            </span>
                            <span class="hide-menu">Karyawan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/destinasi" aria-expanded="false">
                            <span>
                                <i class="fas fa-map-marked-alt fa-lg"></i>
                            </span>
                            <span class="hide-menu">Destinasi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/tugas" aria-expanded="false">
                            <span>
                                <i class="fas fa-tasks fa-lg"></i>
                            </span>
                            <span class="hide-menu">Tugas</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Manajemen</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/presensi" aria-expanded="false">
                            <span>
                                <i class="far fa-calendar-check fa-lg"></i>
                            </span>
                            <span class="hide-menu">Presensi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/formIzin" aria-expanded="false">
                            <span>
                                <i class="far fa-list-alt fa-lg"></i>
                            </span>
                            <span class="hide-menu">FormIzin</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin/role" aria-expanded="false">
                            <span>
                                <i class="far fa-list-alt fa-lg"></i>
                            </span>
                            <span class="hide-menu">Role Permission</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role_id == 2)
                    {{-- sidebar item untuk karyawan --}}

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('karyawan.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="fas fa-home fa-lg"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Activity</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/karyawan/activity" aria-expanded="false">
                            <span>
                                <i class="fas fa-tasks fa-lg"></i>
                            </span>
                            <span class="hide-menu">Tugas</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Form</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/karyawan/formIzin" aria-expanded="false">
                            <span>
                                <i class="far fa-list-alt fa-lg"></i>
                            </span>
                            <span class="hide-menu">Form Izin</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role_id == 3)
                    {{-- sidebar item untuk pengelola --}}

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pengelola.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="fas fa-home fa-lg"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pengelola/karyawan" aria-expanded="false">
                            <span>
                                <i class="fas fa-users fa-lg"></i>
                            </span>
                            <span class="hide-menu">Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Manajemen</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/pengelola/presensi" aria-expanded="false">
                            <span>
                                <i class="far fa-calendar-check fa-lg"></i>
                            </span>
                            <span class="hide-menu">Presensi</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
