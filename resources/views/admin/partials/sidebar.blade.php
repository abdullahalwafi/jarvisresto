<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index-2.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/logo-bk.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/logo-bk.png" alt="" height="20">
            </span>
        </a>

        <a href="index-2.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/assets/images/logo-bk.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/logo-bk.png" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/dashboard">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Apps</li>

                <li>
                    <a href="/categories" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="/product" class=" waves-effect">
                        <i class="uil-shutter-alt"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li>
                    <a href="/pesanan" class=" waves-effect">
                        <i class="uil-store"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="/transaksi" class=" waves-effect">
                        <i class="uil-dollar-alt"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="/table" class=" waves-effect">
                        <i class="uil-vertical-distribute-bottom"></i>
                        <span>Table</span>
                    </a>
                </li>
                @can('superuser')
                    <li class="menu-title">Laporan</li>
                    <li>
                        <a data-bs-toggle="modal" class=" waves-effect" data-bs-target="#lprpesanan">
                            <i class="uil-shopping-basket"></i>
                            <span>Lpr Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a data-bs-toggle="modal" class=" waves-effect" data-bs-target="#lprtransaksi">
                            <i class="uil-wifi"></i>
                            <span>Lpr Transaksi</span>
                        </a>
                    </li>
                    <li class="menu-title">Auth</li>

                    <li>
                        <a href="/user" class="waves-effect">
                            <i class="uil-user-circle"></i>
                            <span>User</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
