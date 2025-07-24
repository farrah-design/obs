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

    /**
     * Admin function to view customer details
     */
    public function adminViewCustomer($id)
    {
        /** @var \App\Models\Staff $staff */
        $staff = Auth::guard('staff')->user();

        $customer = Customer::with(['appointments', 'feedback'])
            ->findOrFail($id);

        return view('admin.list', [
            'customer' => $customer,
            'appointments' => $customer->appointments()->latest()->take(5)->get(),
            'feedback' => $customer->feedback()->with('appointment')->latest()->take(5)->get()
        ]);
    }

    /**
     * Admin function to list all customers
     */
    public function adminListCustomers()
    {
        /** @var \App\Models\Staff $staff */
        $staff = Auth::guard('staff')->user();

        $customers = Customer::withCount(['appointments', 'feedback'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.customerdetails', compact('customers'));
    }

}
