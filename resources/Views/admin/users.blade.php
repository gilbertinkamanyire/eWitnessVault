<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; font-family: 'Outfit', sans-serif;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-users-group" style="font-size: 1.5rem; background: linear-gradient(135deg, #a855f7, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; letter-spacing: -0.5px;">User Management</h2>
            </div>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 10px; color: #94a3b8; font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='rgba(168, 85, 247, 0.4)'; this.style.color='#f1f5f9'" onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.color='#94a3b8'">
                    <i class="ti ti-layout-dashboard"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.create') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background: linear-gradient(135deg, #06b6d4, #0891b2); border: none; border-radius: 10px; color: white; font-size: 0.8125rem; font-weight: 700; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(6, 182, 212, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(6, 182, 212, 0.3)'">
                    <i class="ti ti-user-plus"></i> Add New User
                </a>
            </div>
        </div>
    </x-slot>

    <div style="padding: 2rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            @if(session('success'))
                <div style="margin-bottom: 1.5rem; padding: 1rem 1.25rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #6ee7b7;">
                    <i class="ti ti-circle-check" style="font-size: 1.25rem; flex-shrink: 0;"></i>
                    <p style="font-size: 0.875rem; font-weight: 600;">{{ session('success') }}</p>
                </div>
            @endif

            <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                
                <!-- Card Header -->
                <div style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(71,85,105,0.3); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(168, 85, 247, 0.12); border: 1px solid rgba(168, 85, 247, 0.25); display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-users" style="font-size: 1.25rem; color: #c084fc;"></i>
                        </div>
                        <div>
                            <div style="font-size: 1rem; font-weight: 700; color: #e2e8f0;">Platform Users</div>
                            <div style="font-size: 0.8125rem; color: #475569;">Complete registry of all registered accounts</div>
                        </div>
                    </div>
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); padding: 0.3rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; color: #94a3b8;">
                        {{ $users->count() }} Total
                    </div>
                </div>

                <!-- Table Container -->
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: rgba(30, 41, 59, 0.5);">
                                <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">User Profile</th>
                                <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">Access Level</th>
                                <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">Security Status</th>
                                <th style="padding: 1rem 1.5rem; text-align: right; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px;">Operational Actions</th>
                            </tr>
                        </thead>
                        <tbody style="background: transparent;">
                            @forelse($users as $user)
                            <tr style="border-top: 1px solid rgba(71, 85, 105, 0.15); transition: background 0.2s;" onmouseover="this.style.background='rgba(168, 85, 247, 0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1.25rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #a855f7, #6366f1); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 800; color: white; box-shadow: 0 4px 10px rgba(168, 85, 247, 0.25);">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9;">{{ $user->name }}</div>
                                            <div style="font-size: 0.75rem; color: #64748b; font-family: monospace;">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1.25rem 1.5rem;">
                                    <div style="display: flex; flex-wrap: wrap; gap: 0.35rem;">
                                        @foreach($user->roles as $role)
                                            <span style="padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.3px; border: 1px solid rgba(71, 85, 105, 0.3);
                                                @if($role->name == 'Admin') background: rgba(244, 63, 94, 0.08); color: #fb7185; border-color: rgba(244, 63, 94, 0.2);
                                                @elseif($role->name == 'Judge') background: rgba(59, 130, 246, 0.08); color: #60a5fa; border-color: rgba(59, 130, 246, 0.2);
                                                @elseif($role->name == 'Lawyer') background: rgba(168, 85, 247, 0.08); color: #c084fc; border-color: rgba(168, 85, 247, 0.2);
                                                @else background: rgba(148, 163, 184, 0.08); color: #94a3b8; border-color: rgba(148, 163, 184, 0.2);
                                                @endif">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td style="padding: 1.25rem 1.5rem;">
                                    @if($user->is_verified)
                                        <div style="display: flex; align-items: center; gap: 0.5rem; color: #4ade80; font-size: 0.8125rem; font-weight: 700;">
                                            <div style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);"></div>
                                            Verified
                                        </div>
                                    @else
                                        <div style="display: flex; align-items: center; gap: 0.5rem; color: #fbbf24; font-size: 0.8125rem; font-weight: 700;">
                                            <div style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%; animation: pulse 2s infinite;"></div>
                                            Pending
                                        </div>
                                    @endif
                                </td>
                                <td style="padding: 1.25rem 1.5rem; text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); color: #60a5fa; border-radius: 8px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#3b82f6'; this.style.color='white'" onmouseout="this.style.background='rgba(59, 130, 246, 0.1)'; this.style.color='#60a5fa'" title="Edit User Account">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @if(!$user->hasRole('Admin'))
                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; border-radius: 8px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'" onmouseout="this.style.background='rgba(239, 68, 68, 0.05)'; this.style.color='#f87171'" onclick="return confirm('Immediately Terminate this User Account?')" title="Delete User Account">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding: 4rem 2rem; text-align: center;">
                                    <div style="width: 60px; height: 60px; border-radius: 15px; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                        <i class="ti ti-user-off" style="font-size: 2rem; color: #334155;"></i>
                                    </div>
                                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #e2e8f0; margin-bottom: 0.5rem;">No Active Multi-Users</h3>
                                    <p style="font-size: 0.875rem; color: #475569;">The user registry is currently empty or filtered.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Footer / Info -->
                <div style="padding: 1.25rem 2rem; background: rgba(15, 23, 42, 0.4); border-top: 1px solid rgba(71, 85, 105, 0.3); display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: #64748b;">
                    <div>System Authority Mode Active</div>
                    <div style="display: flex; gap: 1rem;">
                        <span style="display: flex; align-items: center; gap: 0.25rem;"><i class="ti ti-lock" style="font-size: 0.8rem;"></i> Encrypted Access</span>
                        <span style="display: flex; align-items: center; gap: 0.25rem;"><i class="ti ti-activity" style="font-size: 0.8rem;"></i> Real-time Sync</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.5; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</x-app-layout>
