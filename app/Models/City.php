<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name', 'slug'];

    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class, 'city_id', 'id');
    }
}
