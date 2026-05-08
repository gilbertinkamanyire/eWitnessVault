<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Illuminate\Support\Facades\Log::info('Registration attempt', ['email' => $request->email]);
        
        if (\App\Models\User::where('email', $request->email)->exists()) {
            return back()->withInput()->withErrors(['email' => 'This email is already registered. Please sign in instead.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'role_requested' => ['nullable', 'string', 'in:Judge,Lawyer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_requested' => $request->role_requested,
            'is_verified' => false, // Default to unverified
        ]);

        // Assign role if requested
        if ($request->role_requested) {
            $role = \App\Models\Role::where('name', $request->role_requested)->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }
        } else {
            // Default role (e.g., User or Investigator)
            $defaultRole = \App\Models\Role::where('name', 'User')->orWhere('name', 'Investigator')->first();
            if ($defaultRole) {
                $user->roles()->attach($defaultRole->id);
            }
        }

        event(new Registered($user));

        // If user requested Judge or Lawyer role, don't auto-login, show pending message
        if ($request->role_requested && in_array($request->role_requested, ['Judge', 'Lawyer'])) {
            return redirect()->route('login')->with('status', 'Registration successful! Your account is pending admin verification. You will be able to login once approved.');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
