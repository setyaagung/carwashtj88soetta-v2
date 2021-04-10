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
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ (request()->segment(1) == 'kendaraan') ? 'active' : '' }} {{ (request()->segment(1) == 'paket') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kendaraan.index')}}" class="nav-link {{ (request()->segment(1) == 'kendaraan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paket.index')}}" class="nav-link {{ (request()->segment(1) == 'paket') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paket</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.create')}}" class="nav-link {{ (request()->segment(1) == 'transaksi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('karyawan.index')}}" class="nav-link {{ (request()->segment(1) == 'karyawan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>Karyawan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index')}}" class="nav-link {{ (request()->segment(1) == 'user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
