<?php
$activeMenu                 =   (isset($activeMenuClass) && !empty($activeMenuClass) ? $activeMenuClass : '');
$activeSubMenu              =   (isset($subMenuClass) && !empty($subMenuClass) ? $subMenuClass : '');
$roleName                   =   getRoleNameByUserId(Auth::user()->id);
?>
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo setActiveMenuClass($activeMenu, 'dashboard') ?>">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php
        if(hasAccessPermission($roleName, 'Settings', 'listaccess')){
    ?>
    <li class="nav-item dropdown <?php echo setActiveMenuClass($activeMenu, 'settings') ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-info" aria-hidden="true" style="color: red;"></i>
            <span>Settings</span>
        </a>
        <div class="dropdown-menu <?php echo setActiveMenuClass($activeMenu, 'settings', 'show') ?>" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'division-list', 'submenu_selector') ?>" href="{{ route('admin.department-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Division</span>
            </a>
            <a class="active nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'department-list', 'submenu_selector') ?>" href="{{ route('admin.division-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Department</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'complain-type-list', 'submenu_selector') ?>" href="{{ route('admin.complain-type-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Complain Type</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'complain-status-list', 'submenu_selector') ?>" href="{{ route('admin.complain-status-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Complain Status</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'module-list', 'submenu_selector') ?>" href="{{ route('admin.module-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Module</span>
            </a>
        </div>
    </li>
    <?php } ?>
    <?php
        if(hasAccessPermission($roleName, 'Users', 'listaccess')){
    ?>
    <li class="nav-item dropdown <?php echo setActiveMenuClass($activeMenu, 'users') ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle" aria-hidden="true" style="color: red;"></i>
            <span>Users</span>
        </a>
        <div class="dropdown-menu <?php echo setActiveMenuClass($activeMenu, 'users', 'show') ?>" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'role-list', 'submenu_selector') ?>" href="{{ route('admin.role-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Role</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'permission-list', 'submenu_selector') ?>" href="{{ route('admin.permission-create') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Permission</span>
            </a>            
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'users-list', 'submenu_selector') ?>" href="{{ route('admin.user-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: red;"></i>
                <span class="sub_menu_text_design">Users</span>
            </a>
        </div>
    </li>
        <?php } ?>
    <?php
        if(hasAccessPermission($roleName, 'Complain details', 'listaccess')){
    ?>
     <li class="nav-item <?php echo setActiveMenuClass($activeMenu, 'complain-details') ?>">
        <a class="nav-link" href="{{ route('admin.complain-details-list') }}">
            <i class="fas fa-fw fa-marker"></i>
            <span>Complain Details</span>
        </a>
    </li> 
        <?php } ?>
    <?php
        if(hasAccessPermission($roleName, 'Feedback details', 'listaccess')){
    ?>
     <li class="nav-item <?php echo setActiveMenuClass($activeMenu, 'feedback-details') ?>">
        <a class="nav-link" href="{{ route('admin.feedback-details-list') }}">
            <i class="fas fa-fw fa-pen-nib"></i>
            <span>Feedback Details</span>
        </a>
    </li>
        <?php } ?>
</ul>