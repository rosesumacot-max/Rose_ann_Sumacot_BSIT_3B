<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('tourism.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid username, password, or role.');
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function touristLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'nationality' => 'required',
            'age_group' => 'required',
        ]);

        $email = $request->email ?: null;

        if ($email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'role' => 'Tourist',
                    'nationality' => $request->nationality,
                    'age_group' => $request->age_group,
                ]);

                Auth::login($user);
                return redirect()->route('dashboard');
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'username' => 'tourist_' . time() . rand(100, 999),
            'password' => Hash::make('tourist123'),
            'role' => 'Tourist',
            'nationality' => $request->nationality,
            'age_group' => $request->age_group,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}