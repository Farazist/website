<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function class_type()
    {
        return $this->belongsTo('App\ClassType');
    }
}
