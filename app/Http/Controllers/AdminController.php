<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Middleware to ensure only admins can access these routes
     */
    public function __construct()
    {
        $this->middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class]);
    }

    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $verifiedUsers = User::where('is_verified', true)->count();
        $pendingVerification = User::where('is_verified', false)
            ->where(function($query) {
                $query->whereHas('roles', function($q) {
                    $q->whereIn('name', ['Judge', 'Lawyer']);
                });
            })
            ->count();
        $totalEvidence = \App\Models\Evidence::count();
        
        $pendingUsers = User::with('roles')
            ->where('is_verified', false)
            ->whereHas('roles', function($query) {
                $query->whereIn('name', ['Judge', 'Lawyer']);
            })
            ->get();

        $recentUsers = User::with('roles')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'verifiedUsers', 'pendingVerification', 'totalEvidence', 'pendingUsers', 'recentUsers'));
    }

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::with('roles')->get();
        $pendingUsers = User::with('roles')
            ->where('is_verified', false)
            ->whereHas('roles', function($query) {
                $query->whereIn('name', ['Judge', 'Lawyer']);
            })
            ->get();
        return view('admin.users', compact('users', 'pendingUsers'));
    }

    /**
     * Verify a user (approve judge/lawyer access)
     */
    public function verifyUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_verified' => true]);

        return redirect()->route('admin.users')->with('success', 'User verified successfully!');
    }

    /**
     * Reject a user verification request
     */
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        // Remove judge/lawyer roles
        $user->roles()->whereIn('name', ['Judge', 'Lawyer'])->detach();
        // Assign default role
        $defaultRole = Role::where('name', 'User')->orWhere('name', 'Investigator')->first();
        if ($defaultRole) {
            $user->roles()->syncWithoutDetaching([$defaultRole->id]);
        }
        $user->update(['is_verified' => true, 'role_requested' => null]);

        return redirect()->route('admin.users')->with('success', 'User verification rejected. User assigned default role.');
    }

    /**
     * Show form to create a new user
     */
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.create_user', compact('roles'));
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // Assign roles
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Show edit user form
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.edit_user', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'roles' => 'required|array',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update roles
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Optional: Manage roles
     */
    public function roles()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }
}
