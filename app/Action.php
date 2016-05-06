<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';
    protected $fillable = [
    	'owner_id',
    	'message',
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function broadcastUser(){
    	return $this->belongsToMany('App\User', 'action_user', 'action_id', 'user_id')
    				->withTimestamps()
    				->withPivot(['seen']);
    }
}
