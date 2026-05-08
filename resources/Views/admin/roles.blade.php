<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; font-family: 'Outfit', sans-serif;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-shield-half-filled" style="font-size: 1.5rem; background: linear-gradient(135deg, #f59e0b, #d97706); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; letter-spacing: -0.5px;">Role Architecture</h2>
            </div>
            <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 10px; color: #94a3b8; font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='rgba(245, 158, 11, 0.4)'; this.style.color='#f1f5f9'" onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.color='#94a3b8'">
                <i class="ti ti-layout-dashboard"></i> Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding: 2.5rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem;">
            
            @if(session('success'))
                <div style="padding: 1rem 1.25rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #6ee7b7;">
                    <i class="ti ti-circle-check" style="font-size: 1.25rem;"></i>
                    <p style="font-size: 0.875rem; font-weight: 600;">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div style="padding: 1rem 1.25rem; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #f87171;">
                    <i class="ti ti-alert-triangle" style="font-size: 1.25rem;"></i>
                    <p style="font-size: 0.875rem; font-weight: 600;">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Top Grid: Stats & Quick Add -->
            <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;">
                
                <!-- System Role Summary -->
                <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(245, 158, 11, 0.15); border-radius: 20px; padding: 2rem; display: flex; flex-direction: column; justify-content: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.25); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.5rem;">
                        <i class="ti ti-layers-intersect"></i>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 800; color: #f1f5f9; line-height: 1;">{{ $roles->count() }}</div>
                        <div style="font-size: 0.875rem; font-weight: 600; color: #64748b; margin-top: 0.25rem;">Defined Security Tiers</div>
                    </div>
                    <div style="font-size: 0.75rem; color: #475569; line-height: 1.6;">
                        Roles define the granular access controls for every operator within the eWitnessVault ecosystem.
                    </div>
                </div>

                <!-- Add New Role Form Card -->
                <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(168, 85, 247, 0.15); border-radius: 20px; overflow: hidden;">
                    <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid rgba(71,85,105,0.2); background: rgba(30, 41, 59, 0.3);">
                        <h3 style="font-size: 0.9375rem; font-weight: 700; color: #e2e8f0; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="ti ti-plus" style="color: #c084fc;"></i> Provision New Tier
                        </h3>
                    </div>
                    <div style="padding: 1.75rem;">
                        <form action="{{ route('roles.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @csrf
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Role Identifier</label>
                                <div style="position: relative;">
                                    <i class="ti ti-tag" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #475569;"></i>
                                    <input type="text" name="name" required placeholder="e.g. Legal Researcher"
                                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 10px; padding: 0.65rem 1rem 0.65rem 2.5rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(168, 85, 247, 0.1)'"
                                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                </div>
                                @error('name') <p style="color: #f87171; font-size: 0.7rem;">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" style="background: linear-gradient(135deg, #a855f7, #6366f1); border: none; border-radius: 10px; padding: 0.75rem; color: white; font-weight: 800; font-size: 0.875rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.3s;" onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-1px)'" onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'">
                                <i class="ti ti-cpu"></i> Register Role
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Roles Table Card -->
            <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(6, 182, 212, 0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
                <div style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(71,85,105,0.2); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <i class="ti ti-list" style="font-size: 1.25rem; color: #22d3ee;"></i>
                        <h3 style="font-size: 1rem; font-weight: 700; color: #f1f5f9;">Active System Hierarchy</h3>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: rgba(30, 41, 59, 0.4);">
                                <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">ID</th>
                                <th style="padding: 1rem 1.5rem; text-align: left; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Role Designation</th>
                                <th style="padding: 1rem 1.5rem; text-align: right; font-size: 0.7rem; font-weight: 700; color: #475569; text-transform: uppercase;">Operational Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr style="border-top: 1px solid rgba(71, 85, 105, 0.15); transition: background 0.2s;" onmouseover="this.style.background='rgba(34, 211, 238, 0.02)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-family: monospace; color: #475569;">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 8px; height: 8px; border-radius: 50%; background: #22d3ee; box-shadow: 0 0 8px rgba(34, 211, 238, 0.4);"></div>
                                        <span style="font-size: 0.9375rem; font-weight: 700; color: #f1f5f9; letter-spacing: 0.2px;">{{ $role->name }}</span>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                        <a href="{{ route('roles.edit', $role->id) }}" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); color: #60a5fa; border-radius: 8px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#3b82f6'; this.style.color='white'" onmouseout="this.style.background='rgba(59, 130, 246, 0.1)'; this.style.color='#60a5fa'">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; border-radius: 8px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'" onmouseout="this.style.background='rgba(239, 68, 68, 0.05)'; this.style.color='#f87171'" onclick="return confirm('Dismantle this Security Tier?')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 3rem; text-align: center; color: #475569; font-size: 0.875rem;">
                                    No custom security tiers established.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
