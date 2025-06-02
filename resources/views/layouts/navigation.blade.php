<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Sistem Penggajian
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <!-- Left Side: Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('karyawan.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('karyawan.index') }}">Kelola Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gaji.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('gaji.index') }}">Kelola Gaji</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pembayaran.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('pembayaran.index') }}">Pembayaran Gaji</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cuti.index') ? 'active fw-semibold' : '' }}"
                                href="#">Pengajuan Cuti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('laporan') ? 'active fw-semibold' : '' }}"
                                href="#">Laporan</a>
                        </li>
                    @elseif (Auth::user()->role === 'karyawan')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('karyawan.gaji.index') ? 'active fw-semibold' : '' }}"
                                href="{{ route('karyawan.gaji.index') }}">Slip Gaji</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('karyawan.cuti.index') ? 'active fw-semibold' : '' }}"
                                href="{{ route('karyawan.cuti.index') }}">Cuti</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Side: Auth Menu -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-capitalize" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
