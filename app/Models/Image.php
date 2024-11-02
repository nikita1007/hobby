<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['url'];

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'ref_hotels_images', 'image_id', 'hotel_id')
            ->withPivot('order');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(HotelRoom::class, 'ref_rooms_images', 'image_id', 'hotel_room_id');
    }
}
