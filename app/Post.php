<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
    	'post_content',
    	'user_id',
    ];

    public function user(){
    		return $this->belongsTo('App\User', 'user_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function getPosterAttribute(){
    		return $this->user->fullname;
    }
}
