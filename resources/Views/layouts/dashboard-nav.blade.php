<nav class="dashboard-nav" style="
    background: linear-gradient(135deg, rgba(8, 10, 25, 0.97) 0%, rgba(5, 20, 40, 0.97) 100%);
    border-bottom: 1px solid rgba(245, 158, 11, 0.2);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(20px);
    position: sticky;
    top: 0;
    z-index: 100;
    font-family: 'Outfit', sans-serif;
    padding: 0.75rem 0;
">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2" style="text-decoration: none;">
                <i class="ti ti-shield-check-filled" style="font-size: 1.6rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 8px rgba(245,158,11,0.5));"></i>
                <span style="font-size: 1.25rem; font-weight: 800; background: linear-gradient(to right, #ffffff, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 0.5px;">eWitnessVault</span>
            </a>
        </div>
        
        <!-- Center Links -->
        <div class="hidden sm:flex items-center space-x-1">
            <a href="{{ route('dashboard') }}" 
               style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
               {{ request()->routeIs('dashboard') ? 'background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}">
                <i class="ti ti-layout-dashboard" style="font-size: 1rem;"></i>
                Dashboard
            </a>
            <a href="{{ route('evidence.index') }}" 
               style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
               {{ request()->routeIs('evidence.*') ? 'background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}">
                <i class="ti ti-files" style="font-size: 1rem;"></i>
                Evidence
            </a>
            @if(Auth::check() && Auth::user()->hasRole('Admin'))
            <a href="{{ route('admin.users') }}" 
               style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
               {{ request()->routeIs('admin.*') ? 'background: rgba(168,85,247,0.15); color: #c084fc; border: 1px solid rgba(168,85,247,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}">
                <i class="ti ti-users-group" style="font-size: 1rem;"></i>
                Admin
            </a>
            @endif
        </div>
        
        <!-- User Menu -->
        <div class="hidden sm:flex items-center" style="position: relative;">
            <button onclick="toggleUserMenu()" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.4rem 0.75rem 0.4rem 0.4rem; background: rgba(30,41,59,0.6); border: 1px solid rgba(71,85,105,0.4); border-radius: 50px; cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.borderColor='rgba(6,182,212,0.4)'; this.style.background='rgba(30,41,59,0.9)';"
                    onmouseout="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.background='rgba(30,41,59,0.6)';"
                    id="userBtn">
                <div style="width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: white;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <span style="font-size: 0.875rem; font-weight: 600; color: #cbd5e1; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                <i class="ti ti-chevron-down" style="font-size: 0.75rem; color: #64748b;"></i>
            </button>
            <div id="userDropdown" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 0.5rem; width: 13rem; background: rgba(15,23,42,0.95); backdrop-filter: blur(20px); border: 1px solid rgba(71,85,105,0.3); border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 1000; overflow: hidden;">
                <div style="padding: 0.75rem 1rem; border-bottom: 1px solid rgba(71,85,105,0.3);">
                    <div style="font-size: 0.8125rem; font-weight: 700; color: #e2e8f0;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem; color: #64748b;">{{ Auth::user()->email }}</div>
                </div>
                <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1rem; color: #cbd5e1; text-decoration: none; font-size: 0.875rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(245,158,11,0.1)'; this.style.color='#fbbf24'" onmouseout="this.style.background='transparent'; this.style.color='#cbd5e1'">
                    <i class="ti ti-user-circle"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1rem; color: #f87171; background: transparent; border: none; width: 100%; text-align: left; cursor: pointer; font-size: 0.875rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">
                        <i class="ti ti-logout"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Mobile Toggle -->
        <button onclick="toggleMobileNav()" class="sm:hidden" style="padding: 0.5rem; border-radius: 8px; color: #64748b; background: transparent; border: 1px solid rgba(71,85,105,0.3); cursor: pointer;">
            <i class="ti ti-menu-2" style="font-size: 1.25rem;"></i>
        </button>
    </div>
</nav>

<script>
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

function toggleMobileNav() {
    // In a full implementation, you'd show a mobile drawer here
    alert('Mobile menu toggled');
}

window.onclick = function(event) {
    if (!event.target.closest('#userBtn') && !event.target.closest('#userDropdown')) {
        document.getElementById('userDropdown').style.display = 'none';
    }
}
</script>