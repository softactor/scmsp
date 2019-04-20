<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Department</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.department-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.department-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.department-edit') }}">Edit</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Division</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.division-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.division-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.division-edit') }}">Edit</a>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Type</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.complain-type-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.complain-type-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.complain-type-edit') }}">Edit</a>
        </div>
    </li>
    
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Status</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.complain-status-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.complain-status-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.complain-status-edit') }}">Edit</a>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Complain Details</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.complain-details-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.complain-details-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.complain-details-edit') }}">Edit</a>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Feedback Details</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.feedback-details-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.feedback-details-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.feedback-details-edit') }}">Edit</a>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Role</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.role-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.role-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.role-edit') }}">Edit</a>
        </div>
    </li>
     
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Users</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.user-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.user-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.user-edit') }}">Edit</a>
        </div>
    </li>
     
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Users Role</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('admin.user-role-list') }}">List</a>
            <a class="dropdown-item" href="{{ route('admin.user-role-create') }}">Create</a>
            <a class="dropdown-item" href="{{ route('admin.user-role-edit') }}">Edit</a>
        </div>
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