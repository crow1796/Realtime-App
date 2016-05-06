<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class PostController extends Controller
{

	public function index(){
		$posts = \App\Post::orderBy('created_at', 'desc')->get();
		foreach($posts as $post){
			$post->posted_by = $post->user->fullname;
			$post->diff_for_humans = 
				$post->created_at < \Carbon\Carbon::today() ?  
							\Carbon\Carbon::parse($post->created_at)->format('F d, Y h:i A') : 
							\Carbon\Carbon::parse($post->created_at)->diffForHumans();
			$post->comments = $post->comments;
			$this->attachUserTo($post);
		}

		return $posts;
	}

	public function store(Request $request){
		$post = new \App\Post();
		$post->post_content = $request->post_content;
		$posted = Auth::user()->posts()->save($post);
		if($posted){
			\Event::fire(new \App\Events\PushNotificationEvent(new \App\Messages\PostMessage(\Auth::user())));
		}
		return $posted ? ($post->toArray() + ['poster' => Auth::user()->fullname]) : false;
	}

	private function attachUserTo($post){
		for($counter = 0; $counter < $post->comments->count(); $counter++){
			$post->comments[$counter]->by = $post->comments[$counter]->post->user->fullname;
			$post->comments[$counter]->diff_for_humans = 
				$post->comments[$counter]->created_at < \Carbon\Carbon::today() ? 
							\Carbon\Carbon::parse($post->comments[$counter]->created_at)->format('F d, Y h:i A') : 
							\Carbon\Carbon::parse($post->comments[$counter]->created_at)->diffForHumans();
		}
	}
}
