<?php

namespace App\Messages;

abstract class AbstractMessage {
	protected $user;

	public function __construct($user){
		$this->user = $user;
	}

	protected abstract function message();
	public function get(){
		return $this->message();
	}
}