<style>
    .user-info {
        display: inline-block;
        margin-left: 10px;
    }

    .user-name {
        font-weight: bold;
    }

    .user-email {
        color: #888;
        font-size: 12px;
    }
</style>

<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="
                            @if (Auth::user()->karyawan->foto)
                                {{ asset('storage/images/karyawan/'.Auth::user()->karyawan->foto) }}
                            @else
                            {{ asset('images/profile/user-1.jpg') }}
                            @endif
                        " alt="" width="35" height="35"
                            class="rounded-circle">
                        <span class="">{{ Auth::user()->username }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            @if (Auth::user()->role_id == 1)
                                <a href="{{ route('admin.profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="{{route('admin.ubahPassword')}}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fas fa-key"></i>
                                    <p class="mb-0 fs-3">Ubah Password</p>
                                </a>
                            @elseif (Auth::user()->role_id == 2)
                                <a href="{{ route('karyawan.profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="/karyawan/ubahPassword/" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="fas fa-key"></i>
                                    <p class="mb-0 fs-3">Ubah Password</p>
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button class="btn btn-outline-primary mx-3 mt-2 d-block" type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
