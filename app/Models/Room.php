<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'hotel_id', 'room_type_id', 'image'];

    public function roomType()
    {
        return $this->belongsTo('App\Models\RoomType','room_type_id','id');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel','hotel_id','id');
    }
}
