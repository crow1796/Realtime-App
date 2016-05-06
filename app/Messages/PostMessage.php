<?php 
namespace App\Messages;
use App\Messages\AbstractMessage;

class PostMessage extends AbstractMessage {
	protected function message(){
		return $this->user->fullname . ' has posted something.';
	}
}