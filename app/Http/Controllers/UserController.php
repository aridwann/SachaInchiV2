<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showLogin  () {
        return view('login');
    }
    public function showRegister  () {
        return view('register');
    }

    public function register(Request $request) {
        $credentials = $request->validate([
            "name" => "required",
            "email" => "required|email:dns|unique:users",
            "password" => "required",
        ]);

        $credentials['password'] = bcrypt($credentials['password']);
        User::create($credentials);

        return redirect("/login");
    }
    
    public function logout(Request $req): RedirectResponse {
        Auth::logout();

        $req->session()->invalidate();
 
        $req->session()->regenerateToken();
    
        return redirect('/');
    }

    public function login(Request $req): RedirectResponse {
        $credentials = $req->validate([
            'email' => ['required', 'email:dns'],
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();

            if(Auth::user()->is_admin){
                return redirect('/dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function show(){
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk(config('filesystems.default_public_disk'))->delete(str_replace('storage/', '', $user->avatar));
            }
            $validated['avatar'] = 'storage/'.$request->file('avatar')->store('user-images', config('filesystems.default_public_disk'));
        }
        $user->update($validated);
        
        return redirect("/profile")->with('success', 'Profil berhasil diperbarui.');
    }
}
