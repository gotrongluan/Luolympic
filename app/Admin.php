<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;

    protected $appends = ['full_name'];

    protected function getFullNameAttribute() {
    	return $this->attributes['last_name'] . " " . $this->attributes['first_name'];
    }

    protected function getPasswordAttribute( $password ) {
    	return decrypt( $password );
    }

    protected function setPasswordAttribute( $value ) {
    	$this->attributes['password'] = encrypt( $value );
    }
}
