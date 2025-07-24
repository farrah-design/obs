<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterController
{


    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);

        Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('login');

    }
}
