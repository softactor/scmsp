<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('theme/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://avatars.githubusercontent.com/u/4972599?v=4" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Tanveer Qureshee</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.department-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Division</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.division-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.complain-type-category-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Cat.</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.complain-type-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Sub Cat.</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.complain-status-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complain Status</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.sms-status-set') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Status</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.address_upazila') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Address Upazila</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.address_union') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Address Union</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.role-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.permission-create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.complain-details-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Complain Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.query-details-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Query Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.report-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            Report Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.staff-location') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Staff Location
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.manual-complain-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Manual Query Details
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.common-sms-view') }}" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Common SMS
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
