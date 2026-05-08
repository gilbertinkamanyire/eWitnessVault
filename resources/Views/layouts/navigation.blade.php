<nav x-data="{ open: false }" style="
    background: linear-gradient(135deg, rgba(8, 10, 25, 0.97) 0%, rgba(5, 20, 40, 0.97) 100%);
    border-bottom: 1px solid rgba(245, 158, 11, 0.2);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(20px);
    position: sticky;
    top: 0;
    z-index: 100;
    font-family: 'Outfit', sans-serif;
">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + Nav Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2" style="text-decoration: none;">
                        <i class="ti ti-shield-check-filled" style="font-size: 1.6rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 8px rgba(245,158,11,0.5));"></i>
                        <span style="font-size: 1.25rem; font-weight: 800; background: linear-gradient(to right, #ffffff, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 0.5px;">eWitnessVault</span>
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden sm:flex sm:items-center sm:ms-8 space-x-1">
                    <a href="{{ route('dashboard') }}"
                       style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
                       {{ request()->routeIs('dashboard') ? 'background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}"
                       onmouseover="if(!this.classList.contains('active-nav')) { this.style.background='rgba(245,158,11,0.1)'; this.style.color='#e2e8f0'; }"
                       onmouseout="if(!this.classList.contains('active-nav')) { this.style.background='transparent'; this.style.color='#94a3b8'; }">
                        <i class="ti ti-layout-dashboard" style="font-size: 1rem;"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('evidence.index') }}"
                       style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
                       {{ request()->routeIs('evidence.*') ? 'background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}"
                       onmouseover="this.style.background='rgba(245,158,11,0.1)'; this.style.color='#e2e8f0';"
                       onmouseout="if(!{{ request()->routeIs('evidence.*') ? 'true' : 'false' }}) { this.style.background='transparent'; this.style.color='#94a3b8'; }">
                        <i class="ti ti-files" style="font-size: 1rem;"></i>
                        Evidence
                    </a>
                    @if(Auth::check() && Auth::user()->hasRole('Admin'))
                    <a href="{{ route('admin.dashboard') }}"
                       style="display: flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s;
                       {{ request()->routeIs('admin.*') ? 'background: rgba(168,85,247,0.15); color: #c084fc; border: 1px solid rgba(168,85,247,0.3);' : 'color: #94a3b8; border: 1px solid transparent;' }}"
                       onmouseover="this.style.background='rgba(168,85,247,0.1)'; this.style.color='#e2e8f0';"
                       onmouseout="if(!{{ request()->routeIs('admin.*') ? 'true' : 'false' }}) { this.style.background='transparent'; this.style.color='#94a3b8'; }">
                        <i class="ti ti-shield-cog" style="font-size: 1rem;"></i>
                        Admin
                    </a>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="52">
                    <x-slot name="trigger">
                        <button style="display: flex; align-items: center; gap: 0.6rem; padding: 0.4rem 0.75rem 0.4rem 0.4rem; background: rgba(30,41,59,0.6); border: 1px solid rgba(71,85,105,0.4); border-radius: 50px; cursor: pointer; transition: all 0.2s; font-family: 'Outfit', sans-serif;"
                                onmouseover="this.style.borderColor='rgba(245, 158, 11, 0.4)'; this.style.background='rgba(30,41,59,0.9)';"
                                onmouseout="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.background='rgba(30,41,59,0.6)';">
                            <!-- Avatar circle -->
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: white; flex-shrink: 0;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span style="font-size: 0.875rem; font-weight: 600; color: #cbd5e1; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                            <i class="ti ti-chevron-down" style="font-size: 0.75rem; color: #64748b;"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div style="padding: 0.5rem 0;">
                            <div style="padding: 0.75rem 1rem; border-bottom: 1px solid rgba(71,85,105,0.3); margin-bottom: 0.25rem;">
                                <div style="font-size: 0.8125rem; font-weight: 700; color: #e2e8f0;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 0.75rem; color: #64748b;">{{ Auth::user()->email }}</div>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="ti ti-user-circle"></i> {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        style="display: flex; align-items: center; gap: 0.5rem; color: #f87171;">
                                    <i class="ti ti-logout"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem; border-radius: 8px; color: #64748b; background: transparent; border: 1px solid rgba(71,85,105,0.3); cursor: pointer; transition: all 0.2s;"
                        onmouseover="this.style.color='#fbbf24'; this.style.borderColor='rgba(245,158,11,0.4)';"
                        onmouseout="this.style.color='#64748b'; this.style.borderColor='rgba(71,85,105,0.3)';">
                    <i :class="open ? 'ti ti-x' : 'ti ti-menu-2'" style="font-size: 1.25rem;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden"
         style="border-top: 1px solid rgba(245,158,11,0.1); background: rgba(8,10,25,0.98);">
        <div style="padding: 0.75rem 1rem; display: flex; flex-direction: column; gap: 0.25rem;">
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.65rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('dashboard') ? '#fbbf24' : '#94a3b8' }}; background: {{ request()->routeIs('dashboard') ? 'rgba(245,158,11,0.1)' : 'transparent' }};">
                <i class="ti ti-layout-dashboard"></i> Dashboard
            </a>
            <a href="{{ route('evidence.index') }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.65rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: {{ request()->routeIs('evidence.*') ? '#fbbf24' : '#94a3b8' }}; background: {{ request()->routeIs('evidence.*') ? 'rgba(245,158,11,0.1)' : 'transparent' }};">
                <i class="ti ti-files"></i> Evidence
            </a>
            @if(Auth::check() && Auth::user()->hasRole('Admin'))
            <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.65rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: #94a3b8;">
                <i class="ti ti-shield-cog"></i> Admin
            </a>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div style="border-top: 1px solid rgba(71,85,105,0.3); padding: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 700; color: white;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-size: 0.875rem; font-weight: 700; color: #e2e8f0;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.75rem; color: #64748b;">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; color: #94a3b8;">
                    <i class="ti ti-user-circle"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 0.85rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #f87171; background: transparent; border: none; cursor: pointer; width: 100%; text-align: left; font-family: 'Outfit', sans-serif;">
                        <i class="ti ti-logout"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
