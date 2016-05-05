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
			$post->diff_for_humans = \Carbon\Carbon::parse($post->created_at)->diffForHumans();
			$post->comments = $post->comments;
			for($counter = 0; $counter < $post->comments->count(); $counter++){
				$post->comments[$counter]->by = $post->comments[$counter]->post->user->fullname;
			}
		}

		return $posts;
	}

	public function store(Request $request){
		$post = new \App\Post();
		$post->post_content = $request->post_content;
		$posted = Auth::user()->posts()->save($post);
		return $posted ? ($post->toArray() + ['poster' => Auth::user()->fullname]) : false;
	}
}
