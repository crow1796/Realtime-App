<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'users';

    public function requestors(){
    		return $this->belongsToMany('App\User', 'reqr_id', 'friend_id')->withTimestamps();
    }
}
