<section style="font-family: 'Outfit', sans-serif;">
    <header style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 0.6rem;">
            <i class="ti ti-id" style="color: #22d3ee;"></i>
            {{ __('Profile Identity') }}
        </h2>
        <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">
            {{ __("Manage your public identity and notification endpoints.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
        @csrf
        @method('patch')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <!-- Name -->
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('Full Name') }}</label>
                <div style="position: relative;">
                    <i class="ti ti-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                </div>
                <x-input-error style="color: #f87171; font-size: 0.75rem;" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase;">{{ __('Email Endpoint') }}</label>
                <div style="position: relative;">
                    <i class="ti ti-mail" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                        style="width: 100%; background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 12px; padding: 0.75rem 1rem 0.75rem 2.75rem; color: #f1f5f9; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                        onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 0 4px rgba(6, 182, 212, 0.1)'"
                        onblur="this.style.borderColor='rgba(71, 85, 105, 0.4)'; this.style.boxShadow='none'">
                </div>
                <x-input-error style="color: #f87171; font-size: 0.75rem;" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div style="margin-top: 0.5rem;">
                        <p style="font-size: 0.8125rem; color: #f1f5f9;">
                            {{ __('Verification Pending.') }}
                            <button form="send-verification" style="background: none; border: none; padding: 0; color: #22d3ee; text-decoration: underline; cursor: pointer; font-size: 0.8125rem;">
                                {{ __('Request new link') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p style="margin-top: 0.25rem; font-weight: 600; font-size: 0.75rem; color: #4ade80;">
                                {{ __('A new verification link has been dispatched.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem;">
            <button type="submit" style="background: linear-gradient(135deg, #06b6d4, #0891b2); border: none; border-radius: 10px; padding: 0.75rem 2rem; color: white; font-weight: 800; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 15px rgba(6, 182, 212, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(6, 182, 212, 0.3)'">
                {{ __('Update Identity') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    style="font-size: 0.8125rem; color: #94a3b8; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="ti ti-check" style="color: #4ade80;"></i> {{ __('Synchronized.') }}
                </p>
            @endif
        </div>
    </form>
</section>
