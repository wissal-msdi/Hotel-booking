<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price_per_night',
        'available_rooms',
    ];

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}
public function room()
{
    return $this->belongsTo(Room::class);
}

}
