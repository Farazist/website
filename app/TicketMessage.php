<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
	public function ticket()
	{
		return $this->belongsTo('App\Ticket');
	}
}
