<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Student Affairs</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ request()->routeIs('vp_sad.dashboard') ? 'active' : '' }}">
                <i class="typcn typcn-home-outline"></i> Dashboard
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_sad.verify-dormitory') ? 'active' : '' }}">
                <i class="typcn typcn-group-outline"></i> Verify Students
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_sad.notes') ? 'active' : '' }}">
                <i class="typcn typcn-notes-outline"></i> Notes
            </a>
            <a href="" class="nav-link {{ request()->routeIs('vp_sad.profile') ? 'active' : '' }}">
                <i class="typcn typcn-user-outline"></i> Profile
            </a>
        </nav>
    </div>
</div>
