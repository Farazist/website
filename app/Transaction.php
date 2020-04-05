<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
	{
		return $this->belongsTo('App\User')->withDefault();
    }
    
    public function target_user()
	{
		return $this->belongsTo('App\User', 'target_user_id', 'id')->withDefault();
	}
}
