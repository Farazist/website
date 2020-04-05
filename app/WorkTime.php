<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
	public function system()
	{
		return $this->belongsTo('App\System')->withDefault();
	}
}
