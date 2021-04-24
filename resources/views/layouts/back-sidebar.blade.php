<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>TJ88 SOETTA</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard')}}" class="nav-link {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('paket.index')}}" class="nav-link {{ (request()->segment(1) == 'paket') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-car"></i>
                        <p>Paket Cuci</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rekap.create')}}" class="nav-link {{ (request()->segment(1) == 'rekap') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Rekap Pendapatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengeluaran.index')}}" class="nav-link {{ (request()->segment(1) == 'pengeluaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('karyawan.index')}}" class="nav-link {{ (request()->segment(1) == 'karyawan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>Karyawan</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ (request()->segment(1) == 'laporan-pemasukkan') ? 'active' : '' }} {{ (request()->segment(1) == 'laporan-pengeluaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan-pemasukkan.index')}}" class="nav-link {{ (request()->segment(1) == 'laporan-pemasukkan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemasukkan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan-pengeluaran.index')}}" class="nav-link {{ (request()->segment(1) == 'laporan-pengeluaran') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendapatan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index')}}" class="nav-link {{ (request()->segment(1) == 'user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Kelola Akun</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
