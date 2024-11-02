<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = ['check_in', 'check_out', 'status', 'price', 'user_id', 'room_id'];

    public function room(): BelongsTo
    {
        return $this->belongsTo(HotelRoom::class, 'room_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
