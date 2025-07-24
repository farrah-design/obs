<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class CustomerProfileController extends Controller

{
    
    public function view(Request $request)
    {
        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        return view('customer.profile', compact('customer'));
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
    /** @var \App\Models\Customer $customer */
    $customer = Auth::guard('customer')->user();

    // Update attributes
    $customer->name = $validated['name'];
    $customer->email = $validated['email'];
    $customer->phone = $validated['phone'];

    // Handle password if provided
    if (!empty($validated['password'])) {
        $customer->password = bcrypt($validated['password']);
    }

    // Save to DB
    $customer->save();

    // Redirect or return response
    return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
    ]);

    /** @var \App\Models\Customer $customer */
    $customer = Auth::guard('customer')->user();

    if (!Hash::check($request->current_password, $customer->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    $customer->password = bcrypt($request->password);
    $customer->save();
    return redirect()->back()->with('success', 'Profile updated successfully.');
}

    public function adminViewCustomer()
{
    // Optional: Check if authenticated admin
    $staff = Auth::guard('staff')->user();

    // Select only essential fields for performance
    $customers = Customer::select('customerID', 'name', 'phone', 'email')
                ->orderBy('created_at', 'desc')
                ->paginate(10); // Adjust pagination as needed

    return view('admin.admin-customerdetails', compact('customers'));
}

}
