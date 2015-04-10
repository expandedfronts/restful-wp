<?php
namespace WordPress\V1\Rest\Users;

class UsersEntity
{
	public $ID;

	public $user_login;

	public $user_pass;

	public $user_nicename;

	public $user_email;

	public $user_url;

	public $user_registered;

	public $user_activation_key;

	public $user_status;

	public $display_name;

	public function getArrayCopy() {
		return array(
			'ID' 					=> $this->ID,
			'user_login' 			=> $this->user_login,
			'user_pass' 			=> $this->user_pass,
			'user_nicename' 		=> $this->user_nicename,
			'user_email' 			=> $this->user_email,
			'user_url' 				=> $this->user_url,
			'user_registered' 		=> $this->user_registered,
			'user_activation_key' 	=> $this->user_activation_key,
			'user_status' 			=> $this->user_status,
			'display_name' 			=> $this->display_name,
		);
	}

	public function exchangeArray( array $array ) {
		$this->ID 					= $array['ID'];
		$this->user_login 			= $array['user_login'];
		$this->user_pass 			= $array['user_pass'];
		$this->user_nicename 		= $array['user_nicename'];
		$this->user_email 			= $array['user_email'];
		$this->user_url 			= $array['user_url'];
		$this->user_registered 		= $array['user_registered'];
		$this->user_activation_key 	= $array['user_activation_key'];
		$this->user_status 			= $array['user_status'];
		$this->display_name 		= $array['display_name'];
	}
}
