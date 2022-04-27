<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
