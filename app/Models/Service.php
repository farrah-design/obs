<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Specify the table name if it's not the default plural form
    protected $table = 'services';

    // Define the primary key if different from "id"
    protected $primaryKey = 'serviceID';

    // If primary key is not auto-incrementing
    public $incrementing = false;
    protected $keyType = 'string';

    // Define mass assignable attributes
    protected $fillable = [
        'serviceID',
        'serviceName',
        'description',
        'price',
        'duration',
    ];

    // In Service.php
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_service', 'serviceID', 'appointmentID')
                    ->using(AppointmentService::class)
                    ->withPivot('serviceNotes')
                    ->withTimestamps();
    }

}