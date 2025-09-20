<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin registration form.
     */
    public function createAdmin(): View
    {
        return view('auth.admin-register');
    }

    /**
     * Handle admin registration.
     */
    public function storeAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'admin_code' => ['required', 'string'], // Secret admin code
        ]);

        // Check admin registration code (you can customize this)
        if ($request->admin_code !== 'ADMIN2025') {
            return back()->withErrors(['admin_code' => 'Invalid admin registration code.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('login')->with('success', 'Admin account created successfully! Please login.');
    }

    /**
     * Display admin dashboard with system stats.
     */
    public function dashboard(): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        $stats = [
            'total_users' => User::count(),
            'total_notes' => \App\Models\Note::count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
            'recent_notes' => \App\Models\Note::with('user')->latest()->take(5)->get(),
            'recent_users' => User::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}