<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function owner()
	{
		return $this->belongsTo('App\User', 'owner_id', 'id')->withDefault();
	}

	public function citizens()
	{
		return $this->hasMany('App\User');
	}

	public function city()
	{
		return $this->belongsTo('App\City')->withDefault();
	}

	public function sliders()
	{
		return $this->hasMany('App\Slider');
	}

	public function work_times()
	{
		return $this->hasMany('App\WorkTime');
	}

	public function deliveries()
	{
		return $this->hasMany('App\Delivery');
	}
}
