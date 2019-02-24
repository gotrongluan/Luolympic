<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    public function districts() {
    	return $this->hasMany('App\District', 'prov_id');
    }
}
