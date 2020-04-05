<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function parent()
    {
        return $this->belongsTo('App\Group','parent_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Group','parent_id');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}