<!-- Mobile Bottom Navigation Bar -->
<nav class="bottom-nav" id="bottom-nav" role="navigation" aria-label="Mobile navigation">
    <div class="bottom-nav-items">
        <a href="{{ route('dashboard') }}" 
           class="bottom-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           aria-label="Dashboard">
            <i class="ti ti-layout-dashboard"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('evidence.index') }}" 
           class="bottom-nav-item {{ request()->routeIs('evidence.*') ? 'active' : '' }}"
           aria-label="Evidence">
            <i class="ti ti-files"></i>
            <span>Evidence</span>
        </a>
        <a href="{{ route('upload') }}" 
           class="bottom-nav-fab"
           aria-label="Upload Evidence">
            <i class="ti ti-plus"></i>
        </a>
        <a href="{{ route('profile.edit') }}" 
           class="bottom-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
           aria-label="Profile">
            <i class="ti ti-user-circle"></i>
            <span>Profile</span>
        </a>
        @if(Auth::check() && Auth::user()->hasRole('Admin'))
        <a href="{{ route('admin.dashboard') }}" 
           class="bottom-nav-item {{ request()->routeIs('admin.*') ? 'active' : '' }}"
           aria-label="Admin">
            <i class="ti ti-shield-cog"></i>
            <span>Admin</span>
        </a>
        @else
        <a href="{{ route('about') }}" 
           class="bottom-nav-item"
           aria-label="About">
            <i class="ti ti-info-circle"></i>
            <span>About</span>
        </a>
        @endif
    </div>
</nav>
