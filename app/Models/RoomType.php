<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    protected $table = 'room_types';

    protected $fillable = ['type'];

    public function rooms(): HasMany
    {
        return $this->hasMany(HotelRoom::class, 'room_type_id', 'id');
    }
}
