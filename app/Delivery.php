<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function user()
	{
		return $this->belongsTo('App\User');
    }
	
	public function items()
    {
        return $this->belongsToMany('App\Item')->withPivot('count');
	}

	public function custom_items()
    {
        return $this->hasMany('App\CustomItem');
	}
	
    public function system()
	{
		return $this->belongsTo('App\System')->withDefault();
	}
	
	public function city()
	{
		return $this->belongsTo('App\City')->withDefault([]);
    }
    
    public function province()
	{
		return $this->belongsTo('App\Province')->withDefault([]);
	}
}
