<?php 
namespace App\Messages;
use App\Messages\AbstractMessage;

class CommentMessage extends AbstractMessage {
	protected function message(){
		return $this->user->fullname . ' commented on a post.';
	}
}