<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isSuperAdmin()) abort(403);
        $users = User::orderBy('role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->isSuperAdmin()) abort(403);
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isSuperAdmin()) abort(403);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:admin,superadmin',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->isSuperAdmin()) abort(403);
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'No puedes eliminarte a ti mismo.']);
        }
        $user->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}