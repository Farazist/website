<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function menus()
    {
        return $this->hasMany('App\Menu', 'role', 'role');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Delivery');
    }

    public function systems()
	{
		return $this->hasMany('App\System', 'owner_id', 'id');
    }
    
    public function items()
	{
		return $this->hasMany('App\Item', 'owner_id', 'id');
	}
    
    public function system()
	{
		return $this->belongsTo('App\System')->withDefault([]);
    }
    
    public function city()
	{
		return $this->belongsTo('App\City')->withDefault([]);
    }
    
    public function province()
	{
		return $this->belongsTo('App\Province')->withDefault([]);
	}

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
