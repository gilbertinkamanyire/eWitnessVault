{{-- Custom eWitnessVault Security Vault Icon --}}
<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    {{-- Vault/Safe Body --}}
    <rect x="20" y="25" width="60" height="55" rx="4" fill="url(#gradient1)" stroke="#2fe1ea" stroke-width="2"/>
    {{-- Vault Door --}}
    <rect x="25" y="30" width="50" height="45" rx="2" fill="url(#gradient2)" stroke="#23a6d5" stroke-width="1.5"/>
    {{-- Lock Circle --}}
    <circle cx="50" cy="52" r="8" fill="#1ca0c6" stroke="#2fe1ea" stroke-width="2"/>
    {{-- Lock Keyhole --}}
    <path d="M50 48 L50 52 M47 50 L53 50" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
    {{-- Security Shield Overlay --}}
    <path d="M50 20 L58 25 L58 35 Q58 45 50 50 Q42 45 42 35 L42 25 Z" fill="url(#gradient3)" opacity="0.8"/>
    {{-- Decorative Lines --}}
    <line x1="30" y1="38" x2="70" y2="38" stroke="#2fe1ea" stroke-width="1" opacity="0.5"/>
    <line x1="30" y1="65" x2="70" y2="65" stroke="#2fe1ea" stroke-width="1" opacity="0.5"/>
    {{-- Gradient Definitions --}}
    <defs>
        <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#324e9e;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#1ca0c6;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#1ca0c6;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#23a6d5;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#2fe1ea;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#23a6d5;stop-opacity:1" />
        </linearGradient>
    </defs>
</svg>
