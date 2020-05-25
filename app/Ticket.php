<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function messages()
	{
		return $this->hasMany('App\TicketMessage');
	}

	public function group()
	{
		return $this->belongsTo('App\TicketGroup')->withDefault();
	}
	
	public function user()
	{
		return $this->belongsTo('App\User')->withDefault();
	}
}
