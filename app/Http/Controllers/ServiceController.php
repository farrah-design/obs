<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function view(Request $request)
{
    $services = Service::all();

    return view('admin.manage-service', compact('services'));
}

public function viewServiceList()
    {
        $services = Service::all();
            
        return view('customer.servicelist', compact('services'));    
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'serviceName' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0|max:9999.99',
            'duration' => 'required|integer|min:1|max:360' // 6 hours max
        ]);

        // Generate a new service ID with APT prefix
        $latestService = Service::orderBy('created_at', 'desc')->first();
        $nextId = $latestService ? (int)str_replace('APT', '', $latestService->serviceID) + 1 : 1;
        $serviceID = 'APT' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $service = Service::create([
            'serviceID' => $serviceID,
            'serviceName' => $validated['serviceName'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration']
        ]);

        return back()->with('success', 'Service created successfully');
    }

    public function update(Request $request){

        $validated = $request->validate([
            'serviceID' => 'required|exists:services,serviceID',
            'serviceName' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0|max:9999.99',
            'duration' => 'required|integer|min:1|max:360' // 6 hours max
        ]);

        $service = Service::where('serviceID', $validated['serviceID'])->firstOrFail();
    
        $service->update([
            'serviceName' => $validated['serviceName'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration']
        ]);

        return back()->with('success', 'Service updated successfully');
    }


    public function delete(Request $request){

        $validated = $request->validate([
            'serviceID' => 'required|exists:services,serviceID'// 6 hours max
        ]);

        $service = Service::where('serviceID', $validated['serviceID'])->firstOrFail();
    
        // Actually delete the record
        $service->delete();

        return back()->with('success', 'Service updated successfully');
    }

}
