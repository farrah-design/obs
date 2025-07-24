<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    //
    protected $table = 'customers';
    protected $primaryKey = 'customerID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
         'name', 'email', 'password', 'phone',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->customerID) {
                $model->customerID = 'CST' . strtoupper(uniqid());
            }
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'customerID', 'customerID');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'customerID');
    }

}
