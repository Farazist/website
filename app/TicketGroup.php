<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketGroup extends Model
{
	public function tickets()
	{
		return $this->hasMany('App\Ticket');
	}
}
