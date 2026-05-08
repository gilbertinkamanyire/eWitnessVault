<section style="font-family: 'Outfit', sans-serif;">
    <header style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #fca5a5; display: flex; align-items: center; gap: 0.6rem;">
            <i class="ti ti-user-x"></i>
            {{ __('Terminate Account') }}
        </h2>
        <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
            {{ __('Irreversible action. All vault data and evidence associations will be permanently purged from the system.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px; padding: 0.75rem 1.5rem; color: #f87171; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;"
        onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.borderColor='rgba(239, 68, 68, 0.5)'"
        onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.borderColor='rgba(239, 68, 68, 0.3)'"
    >{{ __('Initialize Deletion Protocol') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2.5rem; background: #0f172a; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 20px;">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9;">
                {{ __('Confirm Permanent Removal?') }}
            </h2>

            <p style="font-size: 0.875rem; color: #94a3b8; margin-top: 0.75rem; line-height: 1.5;">
                {{ __('This action cannot be undone. Please confirm your identity by entering your security key to authorize immediate account termination.') }}
            </p>

            <div style="margin-top: 1.5rem;">
                <label for="password" style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('Security Key Validation') }}</label>
                <div style="position: relative; margin-top: 0.5rem;">
                    <i class="ti ti-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="{{ __('Enter Security Key') }}"
                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#f87171'; this.style.boxShadow='0 0 0 4px rgba(239, 68, 68, 0.1)'"
                    />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" style="color: #f87171; font-size: 0.75rem; margin-top: 0.5rem;" />
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="button" x-on:click="$dispatch('close')" 
                    style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 10px; padding: 0.65rem 1.5rem; color: #94a3b8; font-weight: 600; font-size: 0.875rem; cursor: pointer;">
                    {{ __('Abort') }}
                </button>

                <button type="submit" 
                    style="background: #ef4444; border: none; border-radius: 10px; padding: 0.65rem 1.5rem; color: white; font-weight: 800; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                    {{ __('Execute Termination') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
