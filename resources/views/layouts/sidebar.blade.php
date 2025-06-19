<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    @auth
        @if (Auth::user()->role === 'admin')
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-6" >Sistem Penggajian</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Karyawan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('karyawan.*') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.karyawan.index') }}">Data Karyawan</a>
                        <a class="collapse-item {{ request()->routeIs('karyawan.*') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.karyawan.create') }}">Tambah Karyawan</a>
                        <a class="collapse-item {{ request()->routeIs('cuti.index') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.cuti.index') }}">Pengajuan Cuti</a>
                        <a class="collapse-item {{ request()->routeIs('cuti.riwayat') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.cuti.riwayat') }}">Riwayat Cuti</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                    <span>Detail Gaji</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('gaji.*') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.gaji.index') }}">Kelola Gaji</a>
                        <a class="collapse-item {{ request()->routeIs('pembayaran.*') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('admin.pembayaran.index') }}">Riwayat Pembayaran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        @elseif (Auth::user()->role === 'karyawan')
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-6" >Sistem Penggajian</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('karyawan.gaji.index') ? 'active fw-semibold' : '' }}" 
                href="{{ route('karyawan.gaji.index') }}">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                    <span>Gaji</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Cuti</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('karyawan.cuti.index') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('karyawan.cuti.index') }}">Riwayat Cuti</a>
                        <a class="collapse-item {{ request()->routeIs('karyawan.cuti.create') ? 'active fw-semibold' : '' }}" 
                        href="{{ route('karyawan.cuti.create') }}">Ajukan Cuti</a>
                    </div>
                </div>
            </li>
        @endif
    @endauth
</ul>