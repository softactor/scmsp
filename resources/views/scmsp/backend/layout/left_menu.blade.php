<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.department-list') }}">
            <i class="fas fa-fw fa-memory"></i>
            <span>Department</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.division-list') }}">
            <i class="fas fa-fw fa-microchip"></i>
            <span>Division</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
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
    
    
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.module-list') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Module</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.permission-list') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Permission</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-role-list') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Users Role</span>
        </a>
    </li>
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.role-list') }}">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Role</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-list') }}">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Users</span>
        </a>
    </li>
    
</ul>