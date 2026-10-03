<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back to Bin Roshan!',
                    'user' => [
                        'id' => Auth::id(),
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ],
                ]);
            }

            return redirect()
                ->intended(route('home'))
                ->with('success', 'Welcome back to Bin Roshan!');
        }


        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'The email or password is incorrect.',
            ], 422);
        }


        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }


    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ]);


        $user = User::create($validated);

        Auth::login($user);

        $request->session()->regenerate();


        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your account has been created successfully!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
        }


        return redirect()
            ->route('home')
            ->with(
                'success',
                'Your account has been created successfully. Welcome to Bin Roshan!'
            );
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'You have been logged out successfully.');
    }
}