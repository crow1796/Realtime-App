<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class PostController extends Controller
{

	public function index(){
		$posts = \App\Post::orderBy('created_at', 'desc')->get();
		return $posts;
	}

	public function store(Request $request){
		$post = new \App\Post();
		$post->post_content = $request->post_content;
		$posted = Auth::user()->posts()->save($post);
		return $posted ? ($post->toArray() + ['poster' => Auth::user()->fullname]) : false;
	}
}
