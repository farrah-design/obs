<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Define the table name if it's not the plural of the model
    protected $table = 'appointments';

    // Define the primary key (if it's not "id")
    protected $primaryKey = 'appointmentID';

    // If the primary key is not an incrementing integer
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'appointmentID',
        'customerID',
        'date',
        'time',
        'status',
    ];


    // In Appointment.php
    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_service', 'appointmentID', 'serviceID')
                    ->using(AppointmentService::class)
                    ->withPivot('serviceNotes')
                    ->withTimestamps();
    }

    /**
     * Relationships
     */

    // An appointment belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }
}
