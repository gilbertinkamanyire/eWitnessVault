<section style="font-family: 'Outfit', sans-serif;">
    <header style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 0.6rem;">
            <i class="ti ti-lock-password" style="color: #c084fc;"></i>
            {{ __('Security Credentials') }}
        </h2>
        <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
            {{ __('Rotate your primary access key to maintain maximum vault security.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf
        @method('put')

        <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
            <!-- Current Password -->
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('Current Master Key') }}</label>
                <div style="position: relative;">
                    <i class="ti ti-key" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 3rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(168, 85, 247, 0.1)'"
                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                    <button type="button" onclick="togglePass('update_password_current_password', this)" style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; padding: 0.5rem; cursor: pointer;">
                        <i class="ti ti-eye"></i>
                    </button>
                </div>
                <x-input-error style="color: #f87171; font-size: 0.75rem;" :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <!-- New Password -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('New Security Key') }}</label>
                    <div style="position: relative;">
                        <i class="ti ti-rotate" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                        <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                            style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 3rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(168, 85, 247, 0.1)'"
                            onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                        <button type="button" onclick="togglePass('update_password_password', this)" style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; padding: 0.5rem; cursor: pointer;">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                    <x-input-error style="color: #f87171; font-size: 0.75rem;" :messages="$errors->updatePassword->get('password')" />
                </div>

                <!-- Confirm Password -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('Verify Key') }}</label>
                    <div style="position: relative;">
                        <i class="ti ti-shield-check" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                            style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 3rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                            onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(168, 85, 247, 0.1)'"
                            onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                        <button type="button" onclick="togglePass('update_password_password_confirmation', this)" style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; padding: 0.5rem; cursor: pointer;">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                    <x-input-error style="color: #f87171; font-size: 0.75rem;" :messages="$errors->updatePassword->get('password_confirmation')" />
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

        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
            <button type="submit" style="background: linear-gradient(135deg, #a855f7, #7c3aed); border: none; border-radius: 10px; padding: 0.75rem 2rem; color: white; font-weight: 800; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(168, 85, 247, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 15px rgba(168, 85, 247, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(168, 85, 247, 0.3)'">
                {{ __('Update Security Key') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="ti ti-lock" style="color: #4ade80;"></i> {{ __('Key Updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>
