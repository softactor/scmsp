<ul class="sidebar navbar-nav">    
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-info" aria-hidden="true" style="color: red;"></i>
            <span>Settings</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.department-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Division</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.division-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Department</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.complain-type-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Complain Type</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.complain-status-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Complain Status</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.module-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Module</span>
            </a>
        </div>
    </li>
<!--    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.department-list') }}">
            <i class="fas fa-fw fa-memory"></i>
            <span>Division</span>
        </a>
    </li>-->
    
<!--    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.division-list') }}">
            <i class="fas fa-fw fa-microchip"></i>
            <span>Department</span>
        </a>
    </li>-->
    
<!--    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-type-list') }}">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>Complain Type</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-status-list') }}">
            <i class="fas fa-fw fa-paste"></i>
            <span>Complain Status</span>
        </a>
    </li>-->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle" aria-hidden="true" style="color: red;"></i>
            <span>Users</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.permission-create') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Permission</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.user-role-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Users Role</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.role-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Role</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link" href="{{ route('admin.user-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Users</span>
            </a>
        </div>
    </li>
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-details-list') }}">
            <i class="fas fa-fw fa-marker"></i>
            <span>Complain Details</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.feedback-details-list') }}">
            <i class="fas fa-fw fa-pen-nib"></i>
            <span>Feedback Details</span>
        </a>
    </li>
    
    
    
<!--    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.module-list') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Module</span>
        </a>
    </li>-->
    
<!--    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.permission-create') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Permission</span>
        </a>
    </li>-->
    
<!--     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-role-list') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Users Role</span>
        </a>
    </li>-->
<!--     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.role-list') }}">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Role</span>
        </a>
    </li>-->
    
<!--     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-list') }}">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Users</span>
        </a>
    </li>-->
    
</ul>