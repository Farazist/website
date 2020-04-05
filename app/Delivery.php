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
        return $this->belongsToMany('App\Item')->withPivot('count');;
	}
	
    public function system()
	{
		return $this->belongsTo('App\System')->withDefault();
	}
}
