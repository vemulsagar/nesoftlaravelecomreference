<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Ecommerce') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->first_name }}</a>
            </div>
        </div> --}}
    </br>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="/home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user" class="nav-link {{ request()->is('*user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('*category*') ? 'active' : '' }}">
                        <i class="nav-icon  fa fa-tasks"></i>
                        <p>
                            Manage Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/category" class="nav-link">
                                <i class="fa fa-list-alt nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/subcategory" class="nav-link">
                                <i class="fa fa-window-restore nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/coupons"
                        class="nav-link {{ request()->is('*coupon*') ? 'active' : '' }}">
                        <i class="fa fa-gift nav-icon"></i>
                        <p>
                            Coupons
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/sizes"
                        class="nav-link {{ request()->is('*size*') ? 'active' : '' }}">
                        <i class="fa fa-adjust nav-icon"></i>
                        <p>
                            Sizes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/colors"
                        class="nav-link {{ request()->is('*color*') ? 'active' : '' }}">
                        <i class="fa fa-paint-brush nav-icon"></i>
                        <p>
                            Colors
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/brands"
                        class="nav-link {{ request()->is('*brand*') ? 'active' : '' }}">
                        <i class="fa fa-asterisk nav-icon"></i>
                        <p>
                            Brands
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/product"
                        class="nav-link {{ request()->is('*product*') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie nav-icon"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/banner/showbanner" class="nav-link {{ request()->is('*showbanner*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
             
                <li class="nav-item">
                    <a href="/coupons/showcoupons" class="nav-link {{ request()->is('*coupon*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Coupon
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/contact/showcontactdetails"
                        class="nav-link {{ request()->is('*contact*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Contact Detail
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ request()->is('*cms*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            CMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/cms/cmsbannerimage" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner Image</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/cms/cmsshowaddress" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Address</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/order/orderdetails" class="nav-link {{ request()->is('*order*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Order Detail
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/settings/showsetting" class="nav-link {{ request()->is('*settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
