<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="ti ti-user-circle" style="font-size: 1.5rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #e2e8f0; font-family: 'Outfit', sans-serif;">My Profile</h2>
            </div>
            <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.875rem; color: #64748b; text-decoration: none; transition: color 0.2s; font-family: 'Outfit', sans-serif;"
               onmouseover="this.style.color='#f59e0b'" onmouseout="this.style.color='#64748b'">
                <i class="ti ti-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding: 2rem 1rem; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 600px; margin: 0 auto;">

            <!-- Alerts -->
            @if(session('success'))
                <div style="margin-bottom: 1.5rem; padding: 1rem 1.25rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #6ee7b7;">
                    <i class="ti ti-circle-check" style="font-size: 1.25rem; flex-shrink: 0;"></i>
                    <div style="font-size: 0.875rem;">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div style="margin-bottom: 1.5rem; padding: 1rem 1.25rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 12px; display: flex; align-items: center; gap: 0.75rem; color: #fca5a5;">
                    <i class="ti ti-alert-circle" style="font-size: 1.25rem; flex-shrink: 0;"></i>
                    <div style="font-size: 0.875rem;">{{ session('error') }}</div>
                </div>
            @endif

            <!-- Profile Card -->
            <div style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(245, 158, 11, 0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                
                <!-- Card Header -->
                <div style="padding: 2rem; border-bottom: 1px solid rgba(71,85,105,0.3); text-align: center; background: linear-gradient(to bottom, rgba(245, 158, 11, 0.05), transparent);">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 800; color: white; margin: 0 auto 1rem; border: 4px solid rgba(245, 158, 11, 0.2); box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: #e2e8f0;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.875rem; color: #64748b;">{{ Auth::user()->email }}</div>
                </div>

                <!-- Form -->
                <div style="padding: 2rem;">
                    <form method="POST" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="name" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-user" style="color: #f59e0b;"></i>
                                Full Name
                            </label>
                            <input
                                type="text" id="name" name="name"
                                value="{{ old('name', Auth::user()->name) }}" required
                                style="width: 100%; padding: 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none;"
                                onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.15)';"
                                onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                            >
                        </div>

                        <!-- Email -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="email" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-mail" style="color: #f59e0b;"></i>
                                Email Address
                            </label>
                            <input
                                type="email" id="email" name="email"
                                value="{{ old('email', Auth::user()->email) }}" required
                                style="width: 100%; padding: 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none;"
                                onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.15)';"
                                onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                            >
                        </div>

                        <div style="height: 1px; background: rgba(71,85,105,0.2); margin: 0.5rem 0;"></div>

                        <!-- Password -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="password" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                                <i class="ti ti-lock" style="color: #f59e0b;"></i>
                                New Password <span style="font-weight: 400; color: #475569;">(Optional)</span>
                            </label>
                            <div style="position: relative;">
                                <input
                                    type="password" id="password" name="password"
                                    placeholder="Leave blank to keep current"
                                    style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none;"
                                    onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.15)';"
                                    onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                                >
                                <button type="button" onclick="togglePass('password', this)" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #475569; cursor: pointer; display: flex; align-items: center;">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label for="password_confirmation" style="font-size: 0.8125rem; font-weight: 600; color: #94a3b8;">Confirm Password</label>
                            <div style="position: relative;">
                                <input
                                    type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm new password"
                                    style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; background: rgba(30,41,59,0.6); border: 1.5px solid rgba(71,85,105,0.4); border-radius: 10px; font-size: 0.9rem; font-family: 'Outfit', sans-serif; color: #e2e8f0; transition: all 0.25s; outline: none;"
                                    onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.15)';"
                                    onblur="this.style.borderColor='rgba(71,85,105,0.4)'; this.style.boxShadow='none';"
                                >
                                <button type="button" onclick="togglePass('password_confirmation', this)" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #475569; cursor: pointer; display: flex; align-items: center;">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 1rem; padding-top: 1rem;">
                            <button type="submit"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 2rem; font-size: 0.9375rem; font-weight: 700; color: white; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; border-radius: 12px; cursor: pointer; transition: all 0.25s; font-family: 'Outfit', sans-serif; box-shadow: 0 4px 20px rgba(245,158,11,0.3);"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(245,158,11,0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(245,158,11,0.3)';">
                                <i class="ti ti-device-floppy"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Status -->
            <div style="margin-top: 2rem; padding: 1.25rem; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.15); border-radius: 15px; display: flex; align-items: center; gap: 1rem;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center;">
                    <i class="ti ti-shield-check" style="font-size: 1.25rem; color: #f59e0b;"></i>
                </div>
                <div>
                    <div style="font-size: 0.875rem; font-weight: 700; color: #e2e8f0;">Identity Verified</div>
                    <div style="font-size: 0.75rem; color: #64748b;">Member since {{ Auth::user()->created_at->format('M Y') }} &bull; Digital ID: 0x{{ substr(md5(Auth::id()), 0, 8) }}</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ti ti-eye-off';
            } else {
                input.type = 'password';
                icon.className = 'ti ti-eye';
            }
        }
    </script>
</x-app-layout>
