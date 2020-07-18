<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = ['room_id', 'start_date', 'end_date', 'fullname', 'email', 'phone', 'duration', 'amount', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room','room_id','id');
    }
}
