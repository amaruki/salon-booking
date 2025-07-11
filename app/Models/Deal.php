<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount',
        'start_date',
        'end_date',
        'is_hidden',
        'service_id',
        'price',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->price) {
            return $this->price;
        }

        return $this->service->price - ($this->service->price * $this->discount / 100);
    }
}