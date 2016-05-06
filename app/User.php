<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'middle_name',
        'last_name',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function actions(){
        return $this->hasMany('App\Action', 'owner_id');
    }

    public function notifications(){
        return $this->belongsToMany('App\Action', 'action_user', 'user_id', 'action_id')
                    ->withTimestamps()
                    ->withPivot(['seen']);
    }

    public function posts(){
        return $this->hasMany('App\Post', 'user_id');
    }

    public function friends(){
        return $this->belongsToMany('App\Friend', 'reqr_id', 'friend_id')->withTimestamps();
    }

    public function getFullnameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
