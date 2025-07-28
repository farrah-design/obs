<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    
    protected $primaryKey = 'feedbackID';

    protected $fillable = [
        'feedbackID',
        'customerID',
        'date',
        'rating',
        'comment'
    ];

    protected $casts = [
        'date' => 'date',
        'rating' => 'integer'
    ];

    public static $rules = [
        'customerID' => 'required|exists:customers,id',
        'date' => 'required|date',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string|max:500'
    ];

    /**
     * Get the customer that gave the feedback
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }

    /**
     * Scope for highly rated feedback (4-5 stars)
     */
    public function scopeHighlyRated($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Get the rating as stars (e.g., "★★★★☆")
     */
    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }
}