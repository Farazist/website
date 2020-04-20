<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function systems()
	{
		return $this->hasMany('App\System');
	}

	public function province()
	{
		return $this->belongsTo('App\Province');
	}

	public function deliveries()
    {
        return $this->hasMany('App\Delivery');
    }
}
