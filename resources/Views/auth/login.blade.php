<x-guest-layout>
    <div class="auth-card__header">
        <h2 class="auth-card__title">Welcome Back</h2>
        <p class="auth-card__subtitle">Sign in to your secure vault</p>
    </div>

    @if (session('status'))
        <div class="auth-alert auth-alert--success">
            <i class="ti ti-circle-check"></i>
            {{ session('status') }}
        </div>
    @endif

    @if (session('message'))
        <div class="auth-alert auth-alert--success">
            <i class="ti ti-circle-check"></i>
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-alert auth-alert--error">
            <i class="ti ti-alert-circle"></i>
            {{ __('Invalid credentials. Please try again.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email -->
        <div class="auth-form__field">
            <label for="email" class="auth-label">Email Address</label>
            <div class="input-icon-wrapper">
                <i class="ti ti-mail input-icon"></i>
                <input id="email" class="auth-input" type="email" name="email"
                    value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="your@email.com">
            </div>
            @error('email')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-form__field">
            <label for="password" class="auth-label">Password</label>
            <div class="input-icon-wrapper password-wrapper">
                <i class="ti ti-lock input-icon"></i>
                <input id="password" class="auth-input" type="password" name="password"
                    required autocomplete="current-password" placeholder="••••••••"
                    style="padding-right: 3rem;">
                <button type="button" class="password-toggle" onclick="togglePassword('password', this)" title="Toggle password">
                    <i class="ti ti-eye" id="eye-password"></i>
                </button>
            </div>
            @error('password')
                <p class="auth-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Meta row -->
        <div class="auth-meta">
            <label for="remember_me" class="auth-checkbox">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="auth-button">
            <i class="ti ti-login" style="margin-right: 0.5rem;"></i>
            Sign In
        </button>
    </form>

    <div class="auth-footer">
        New to eWitnessVault?
        <a href="{{ route('register') }}" class="auth-link">Create an account</a>
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
