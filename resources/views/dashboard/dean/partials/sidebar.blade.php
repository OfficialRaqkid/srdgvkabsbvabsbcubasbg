<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Dean Menu</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('dean.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.pending') ? 'active' : '' }}">
                <i class="typcn typcn-document"></i> Sign Requests
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.history') ? 'active' : '' }}">
                <i class="typcn typcn-time"></i> Clearance History
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.reports') ? 'active' : '' }}">
                <i class="typcn typcn-chart-bar-outline"></i> Reports
            </a>
            <a href="" class="nav-link {{ request()->routeIs('dean.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user"></i> Profile
            </a>
        </nav>
    </div>
</div>
