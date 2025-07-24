<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    //
    
    protected $table = 'staff';
    protected $primaryKey = 'staffID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'staffID', 'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->staffID) {
                $model->staffID = 'STF' . strtoupper(uniqid());
            }
        });
    }
}
