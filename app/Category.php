<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;

class Category extends Model
{
    public function topics()
    {
    	return $this->hasMany('App/Topic');
    }
}
