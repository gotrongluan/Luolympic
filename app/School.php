<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;

    public function district() {
    	return $this->belongsTo('App\District', 'dist_id');
    }

    public function students() {
    	return $this->hasMany('App\User', 'school_id');
    }
}
