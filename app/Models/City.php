<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function state(){
        return $this->belongsTo(State::class, 'state_id');

    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'city_id');
    // }
}
