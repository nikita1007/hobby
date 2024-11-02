<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $table = 'hotels';

    protected $fillable = ['name', 'description', 'stars', 'city_id'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(HotelRoom::class, 'hotel_id', 'id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'ref_hotels_images', 'hotel_id', 'image_id')
            ->withPivot('order');
    }
}
