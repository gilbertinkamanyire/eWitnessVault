<x-guest-layout>
    <div class="auth-card__header">
        <h2 class="auth-card__title">Create Account</h2>
        <p class="auth-card__subtitle">Join eWitnessVault today</p>
    </div>

    @if ($errors->any())
        <div class="auth-alert auth-alert--error">
            <i class="ti ti-alert-circle"></i>
            {{ __('Please correct the errors below.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Full Name -->
        <div class="auth-form__field">
            <label for="name" class="auth-label">Full Name</label>
            <div class="input-icon-wrapper">
                <i class="ti ti-user input-icon"></i>
                <input id="name" class="auth-input" type="text" name="name"
                    value="{{ old('name') }}" required autofocus autocomplete="name"
                    placeholder="John Doe">
            </div>
            @error('name')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="auth-form__field">
            <label for="email" class="auth-label">Email Address</label>
            <div class="input-icon-wrapper">
                <i class="ti ti-mail input-icon"></i>
                <input id="email" class="auth-input" type="email" name="email"
                    value="{{ old('email') }}" required autocomplete="username"
                    placeholder="your@email.com">
            </div>
            @error('email')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="auth-form__field">
            <label for="phone" class="auth-label">
                Phone <span style="color: #475569; font-weight: 400;">(Optional)</span>
            </label>
            <div class="input-icon-wrapper">
                <i class="ti ti-phone input-icon"></i>
                <input id="phone" class="auth-input" type="text" name="phone"
                    value="{{ old('phone') }}" autocomplete="tel"
                    placeholder="+1 234 567 890">
            </div>
            @error('phone')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Account Type -->
        <div class="auth-form__field">
            <label for="role_requested" class="auth-label">Account Type</label>
            <div class="input-icon-wrapper">
                <i class="ti ti-id-badge input-icon"></i>
                <select id="role_requested" name="role_requested" class="auth-input">
                    <option value="">Regular User</option>
                    <option value="Judge" {{ old('role_requested') == 'Judge' ? 'selected' : '' }}>Judge</option>
                    <option value="Lawyer" {{ old('role_requested') == 'Lawyer' ? 'selected' : '' }}>Lawyer</option>
                </select>
            </div>
            @error('role_requested')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-form__field">
            <label for="password" class="auth-label">Password</label>
            <div class="input-icon-wrapper password-wrapper">
                <i class="ti ti-lock input-icon"></i>
                <input id="password" class="auth-input" type="password" name="password"
                    required autocomplete="new-password" placeholder="Min. 8 characters"
                    style="padding-right: 3rem;">
                <button type="button" class="password-toggle" onclick="togglePassword('password', this)" title="Toggle password">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
            @error('password')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="auth-form__field">
            <label for="password_confirmation" class="auth-label">Confirm Password</label>
            <div class="input-icon-wrapper password-wrapper">
                <i class="ti ti-lock-check input-icon"></i>
                <input id="password_confirmation" class="auth-input" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Re-type password" style="padding-right: 3rem;">
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" title="Toggle password">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-button">
            <i class="ti ti-user-plus" style="margin-right: 0.5rem;"></i>
            Create Account
        </button>
    </form>

    <div class="auth-footer">
        Already have an account?
        <a href="{{ route('login') }}" class="auth-link">Sign in</a>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
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
</x-guest-layout>
