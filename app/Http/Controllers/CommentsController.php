<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function store(Request $request){
    	$comment = new \App\Comment;
    	$comment->comment = $request->comment_content;
    	$comment->likes = 0;
    	$post = \App\Post::findOrFail($request->id);
    	$commented = $post->comments()->save($comment);

    	if($commented){
    		\Event::fire(new \App\Events\PushNotificationEvent(new \App\Messages\CommentMessage(\Auth::user())));
    	}

    	return $commented ? $post : false;
    }
}
