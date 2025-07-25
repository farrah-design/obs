<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promotion;
use App\Models\Staff;

class PromotionController extends Controller
{
    /**
     * Display a listing of promotions
     */
    public function view()
    {
        $staffs = Staff::all();
        $promotions = Promotion::with('staff')
            ->orderBy('validUntil', 'desc')
            ->paginate(10);
            
        return view('admin.manage-promo', [
            'promotions' => $promotions,
            'staffMembers' => $staffs,
        ]);
    }

    /**
     * Store a newly created promotion
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'validUntil' => 'required|date|after:today',
            'discountPrice' => 'required|integer|min:1|max:100',    
        ]);

        // Generate promoID (PROMO-0001)
        $latest = Promotion::orderBy('created_at', 'desc')->first();
        $sequence = $latest ? (int) substr($latest->promoID, -4) + 1 : 1;
        $promoID = 'PROMO-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

        $staff = Auth::guard('staff')->user();

        $promotion = Promotion::create([
        'promoID'=>$promoID,
        'staffID' => $staff->staffID,
        'title'=>$validated['title'],
        'description'=>$validated['description'],
        'validUntil'=>$validated['validUntil'],
        'discountPrice'=>$validated['discountPrice'],
    ]);

    return back()->with('success', 'Promotion created successfully!');
    }

     public function update(Request $request)
    {
        $validated = $request->validate([
            'promoID' => 'required|exists:promotion,promoID',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'validUntil' => 'required|date|after:today',
            'discountPrice' => 'required|integer|min:1|max:100',
        ]);

        $promotion = Promotion::where('promoID', $validated['promoID'])->firstOrFail();
    
        $promotion->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'validUntil' => $validated['validUntil'],
            'discountPrice' => $validated['discountPrice']
        ]);

        return back()->with('success', 'Promotion updated successfully');
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'promoID' => 'required|exists:promotion,promoID'
        ]);

        $promotion = Promotion::where('promoID', $validated['promoID'])->firstOrFail();
    
        $promotion->delete();

        return back()->with('success', 'Promotion deleted successfully');
    }

    public function showCustomerPromotions()
{
    $promotions = Promotion::whereDate('validUntil', '>=', now())
        ->orderBy('validUntil')
        ->get();

    return view('customer.promotions', compact('promotions'));
}
}
