<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['name', 'surname', 'email', 'phone', 'password'];

    protected $hidden = ['password'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'client_id', 'id');
    }
}
