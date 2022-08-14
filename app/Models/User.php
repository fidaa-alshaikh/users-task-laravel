<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // get all users attributes
    public function allUsersData()
    {
        return User::select('users.*', 'cities.name as city_name', 
        'states.name as states_name', 'countries.name as country_name')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('states', 'cities.state_id', '=', 'states.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id');
    }

    // public function city()
    // {
    //     return $this->hasOne(City::class, 'id', 'city_id');
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
