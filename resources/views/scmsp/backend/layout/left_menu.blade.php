<?php
$activeMenu                 =   (isset($activeMenuClass) && !empty($activeMenuClass) ? $activeMenuClass : '');
$activeSubMenu              =   (isset($subMenuClass) && !empty($subMenuClass) ? $subMenuClass : '');
$roleName                   =   getRoleNameByUserId(Auth::user()->id);
?>
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo setActiveMenuClass($activeMenu, 'dashboard') ?>">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt" style="color:#dc3545;"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php
        if(hasAccessPermission($roleName, 'Settings', 'listaccess')){
    ?>
    <li class="nav-item dropdown <?php echo setActiveMenuClass($activeMenu, 'settings') ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-info" aria-hidden="true" style="color:#dc3545;"></i>
            <span>Settings</span>
        </a>
        <div class="dropdown-menu <?php echo setActiveMenuClass($activeMenu, 'settings', 'hide') ?>" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'division-list', 'submenu_selector') ?>" href="{{ route('admin.department-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Division</span>
            </a>
            <a class="active nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'department-list', 'submenu_selector') ?>" href="{{ route('admin.division-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Department</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'complain-type-category-list', 'submenu_selector') ?>" href="{{ route('admin.complain-type-category-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Complain Cat.</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'complain-type-list', 'submenu_selector') ?>" href="{{ route('admin.complain-type-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Complain Sub Cat.</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'complain-status-list', 'submenu_selector') ?>" href="{{ route('admin.complain-status-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Complain Status</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'sms-status-set', 'submenu_selector') ?>" href="{{ route('admin.sms-status-set') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">SMS Status</span>
            </a>
        </div>
    </li>
    <?php } ?>
    <?php
        if(hasAccessPermission($roleName, 'Users', 'listaccess')){
    ?>
    <li class="nav-item dropdown <?php echo setActiveMenuClass($activeMenu, 'users') ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-user-circle" aria-hidden="true" style="color:#dc3545;"></i>
            <span>Users</span>
        </a>
        <div class="dropdown-menu <?php echo setActiveMenuClass($activeMenu, 'users', 'hide') ?>" aria-labelledby="pagesDropdown">
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'role-list', 'submenu_selector') ?>" href="{{ route('admin.role-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color: #dc3545;"></i>
                <span class="sub_menu_text_design">Role</span>
            </a>
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'permission-list', 'submenu_selector') ?>" href="{{ route('admin.permission-create') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
                <span class="sub_menu_text_design">Permission</span>
            </a>            
            <a class="nav-link sub_menu_text_nav_link <?php echo setActiveMenuClass($activeSubMenu, 'users-list', 'submenu_selector') ?>" href="{{ route('admin.user-list') }}">
                <i class="fa fa-bullseye" aria-hidden="true" style="color:#dc3545;"></i>
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
            <i class="fas fa-fw fa-marker" style="color:#dc3545;"></i>
            <span>Complain Details</span>
        </a>
    </li> 
        <?php } ?>
    <?php
        if(hasAccessPermission($roleName, 'Report', 'listaccess')){
    ?>
    <li class="nav-item <?php echo setActiveMenuClass($activeMenu, 'report-list') ?>">
        <a class="nav-link" href="{{ route('admin.report-list') }}">
            <i class="fas fa-fw fa-pen-nib"></i>
            <span>Report Details</span>
        </a>
    </li>
        <?php } ?>
</ul>