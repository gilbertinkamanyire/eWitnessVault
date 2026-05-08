<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; font-family: 'Outfit', sans-serif;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-user-plus" style="font-size: 1.5rem; background: linear-gradient(135deg, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; letter-spacing: -0.5px;">Create New User</h2>
            </div>
            <a href="{{ route('admin.users') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 10px; color: #94a3b8; font-size: 0.8125rem; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='rgba(168, 85, 247, 0.4)'; this.style.color='#f1f5f9'" onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.color='#94a3b8'">
                <i class="ti ti-arrow-left"></i> Back to Directory
            </a>
        </div>
    </x-slot>

    <div style="padding: 2.5rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(34, 211, 238, 0.15); border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                
                <!-- Form Header -->
                <div style="padding: 2rem 2.5rem; border-bottom: 1px solid rgba(71,85,105,0.2); background: rgba(30, 41, 59, 0.3);">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #f1f5f9;">Account Credentials</h3>
                    <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">Define identity and access level for the new operator</p>
                </div>

                <div style="padding: 2.5rem;">
                    <form action="{{ route('admin.users.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @csrf

                        <!-- Profile Info Grid -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <!-- Name -->
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Full Name</label>
                                <div style="position: relative;">
                                    <i class="ti ti-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Doe"
                                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                </div>
                                @error('name') <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email -->
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Email Identity</label>
                                <div style="position: relative;">
                                    <i class="ti ti-mail" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="operator@vault.com"
                                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                </div>
                                @error('email') <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>

                            <!-- Phone -->
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Phone Verification</label>
                                <div style="position: relative;">
                                    <i class="ti ti-phone" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+256 ..."
                                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                        onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                </div>
                            </div>

                            <!-- Roles -->
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Access Permissions</label>
                                <div style="position: relative;">
                                    <i class="ti ti-shield-lock" style="position: absolute; left: 1rem; top: 1.15rem; color: #64748b;"></i>
                                    <select name="roles[]" multiple required
                                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s; min-height: 100px;"
                                        onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(168, 85, 247, 0.1)'"
                                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" style="background: #0f172a; padding: 0.5rem;">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p style="font-size: 0.65rem; color: #475569; margin-top: 0.25rem;">Multi-select active: Use Ctrl/Cmd keys</p>
                            </div>
                        </div>

                        <!-- Security Credentials Section -->
                        <div style="margin-top: 1rem; padding-top: 1.5rem; border-top: 1px solid rgba(71,85,105,0.2); display: flex; flex-direction: column; gap: 1.5rem;">
                            <h4 style="font-size: 0.875rem; font-weight: 700; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="ti ti-lock-password"></i> Security Protocol
                            </h4>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                <!-- Password -->
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Master Key</label>
                                    <div style="position: relative;">
                                        <i class="ti ti-key" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                                        <input type="password" name="password" required placeholder="••••••••"
                                            style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                            onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                                            onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                    </div>
                                    @error('password') <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Verification Key</label>
                                    <div style="position: relative;">
                                        <i class="ti ti-refresh" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                                            style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                            onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                                            onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div style="margin-top: 1rem;">
                            <button type="submit"
                                style="width: 100%; height: 50px; background: linear-gradient(135deg, #06b6d4, #0891b2); border: none; border-radius: 12px; color: white; font-size: 1rem; font-weight: 800; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 20px -5px rgba(6, 182, 212, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.75rem;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 25px -5px rgba(6, 182, 212, 0.5)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px -5px rgba(6, 182, 212, 0.4)'">
                                <i class="ti ti-user-plus" style="font-size: 1.25rem;"></i>
                                Initialize System User
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer Info -->
                <div style="padding: 1.25rem 2rem; background: rgba(15, 23, 42, 0.4); border-top: 1px solid rgba(71, 85, 105, 0.2); display: flex; justify-content: center; align-items: center; gap: 2rem; font-size: 0.75rem; color: #475569;">
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="ti ti-shield-check" style="color: #22d3ee;"></i> Encrypted Entry</span>
                    <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="ti ti-database" style="color: #818cf8;"></i> Multi-Role Compatible</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
