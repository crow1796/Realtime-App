<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NotificationsController extends Controller
{
    public function index(){
    	$notifications =  \DB::table('action_user')
    						->join('actions', 'actions.id', '=', 'action_user.action_id')
    						->join('users', 'users.id', '=', 'action_user.user_id')
    						->where('seen', '=', 0)
    						->where('user_id', '=', \Auth::user()->id)
    						->get();
    	return $notifications;
    }
}
