<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'treatment_id',
        'time_slot_id',
        'date',
        'name',
        'phone',
        'memo',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'treatment_id' => 'integer',
        'time_slot_id' => 'integer',
    ];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}