<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <?php
    $roleName = getRoleNameByUserId(Auth::user()->id);
    if (isAgentRole($roleName)) {
        if (hasAccessPermission($roleName, 'Complain details', 'addaccess')) {
            ?>            
            <a class="" href="{{ route('admin.complain-details-create') }}" >
                <button type="button" class="btn btn-sm btn-success float-right margin-fixing">New Complain</button>
            </a>
        <?php }
    } ?>
    <ul class="navbar-nav ml-auto ml-md-12">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo session('logginName'); ?><i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Profile Edit</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('logout')}}">Logout</a>
            </div>
        </li>
    </ul>
</nav>