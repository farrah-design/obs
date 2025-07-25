<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class StaffProfileController extends Controller
{
    public function view(Request $request)
    {
        /** @var \App\Models\Staff $staff */
        $staff = Auth::guard('staff')->user();

        return view('admin.admin-profile', compact('staff'));
    }

    public function update(Request $request )
{
    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'required|string|max:20',
        'password' => 'nullable|string|confirmed|min:6',
    ]);
    
    // Get the currently authenticated user (customer)
    /** @var \App\Models\Staff $staff */
    $staff = Auth::guard('staff')->user();

    // Update attributes
    $staff->name = $validated['name'];
    $staff->email = $validated['email'];
    $staff->phone = $validated['phone'];

    // Handle password if provided
    if (!empty($validated['password'])) {
        $staff->password = bcrypt($validated['password']);
    }

    // Save to DB
    $staff->save();

    // Redirect or return response
    return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
    ]);

    /** @var \App\Models\Staff $staff */
    $staffs = Auth::guard('staff')->user();

    if (!Hash::check($request->current_password, $staff->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    $staff->password = bcrypt($request->password);
    $staff->save();
    return redirect()->back()->with('success', 'Profile updated successfully.');
}
}
