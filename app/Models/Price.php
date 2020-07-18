<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['price', 'room_type_id'];

    public function roomType()
    {
        return $this->belongsTo('App\Models\RoomType','room_type_id','id');
    }
}
