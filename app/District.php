<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;

    public function province() {
    	return $this->belongsTo('App\Province', 'prov_id');
    }

    public function schools() {
    	return $this->hasMany('App\School', 'dist_id');
    }
}
