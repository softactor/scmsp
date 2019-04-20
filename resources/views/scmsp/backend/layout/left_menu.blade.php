<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.department-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Department</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.division-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Division</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-type-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Type</span>
        </a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-status-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Status</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.complain-details-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Details</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.feedback-details-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Feedback Details</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.role-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Role</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Users</span>
        </a>
    </li>
    
     <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.user-role-list') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Users Role</span>
        </a>
    </li>
     
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
</ul>