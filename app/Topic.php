<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Topic extends Model
{
	public function category()
	{
		return $this->belongsTo('App\Category')->withDefault();
	}

    public function employee()
    {
        return $this->belongsTo('App\Employee')->withDefault();
    }
}
