<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController 
{
    //
     public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

         // Attempt to login as staff first
        if (Auth::guard('staff')->attempt($credentials)) {

            $staff = Auth::guard('staff')->user();

            if ($staff->role === 'manager') {
                return redirect()->intended('admin/admin-dashboard');
            } elseif ($staff->role === 'admin') {
                return redirect()->intended('admin/admin-dashboard');
            }

        }

        // Attempt to login as customer
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('main');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);

    }

    //log out as a prime user boy
    public function logout(Request $request)
    {
        if (Auth::guard('staff')->check()) {
            Auth::guard('staff')->logout();
        } elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        return redirect()->route('login');
    }
}
