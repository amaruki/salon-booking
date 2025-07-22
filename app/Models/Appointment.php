<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_code',
        'cart_id',
        'user_id',
        'service_id',
        'date',
        'time_slot_id',
        'start_time',
        'end_time',
        'location_id',
        'total',
        'status',
        'queue_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public static function recalculateQueueNumbers($date, $locationId)
    {
        // Recalculate queue numbers for all appointments for the day, regardless of payment status
        $appointments = self::where('date', $date)
            ->where('location_id', $locationId)
            ->orderBy('start_time')
            ->get();

        $queueCounter = 1;
        foreach ($appointments as $app) {
            $app->queue_number = $queueCounter++;
            $app->save();
        }
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            // a readable unique code for the appointment, including the id in the code
            $appointment->appointment_code = 'APP-'.(self::count() + 1);

        });
    }
}
