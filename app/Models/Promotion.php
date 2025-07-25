<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion';

    protected $primaryKey = 'promoID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'promoID',
        'staffID',
        'title',
        'description',
        'validUntil',
        'discountPrice'
    ];

    protected $casts = [
        'validUntil' => 'date',
        'discountPrice' => 'integer',
    ];

    /**
     * Relationship to Staff who created the promotion
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffID', 'staffID');
    }

    /**
     * Check if promotion is still valid
     */
    public function getIsValidAttribute()
    {
        return now()->lessThanOrEqualTo($this->validUntil);
    }

    /**
     * Scope for active promotions
     */
    public function scopeActive($query)
    {
        return $query->where('validUntil', '>=', now());
    }

    /**
     * Scope for expired promotions
     */
    public function scopeExpired($query)
    {
        return $query->where('validUntil', '<', now());
    }
}
