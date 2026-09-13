<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show admin login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
        }

        return view('admin.auth.login');
    }


    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);


        $remember = $request->boolean('remember');


        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();


            if (Auth::user()->is_admin) {

                return redirect()
                    ->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back to Bin Ismail Admin Panel.');

            }


            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();


            return back()
                ->withErrors([
                    'email' => 'You do not have administrator access.',
                ])
                ->onlyInput('email');
        }


        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }


    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'You have been logged out.');
    }
}