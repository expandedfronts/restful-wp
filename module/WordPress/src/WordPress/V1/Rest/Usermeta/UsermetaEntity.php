<?php
namespace WordPress\V1\Rest\Usermeta;

class UsermetaEntity
{
	public $umeta_id;

	public $user_id;

	public $meta_key;

	public $meta_value;

	public function getArrayCopy() {
		return array(
			'umeta_id' 		=> $this->umeta_id,
			'user_id' 		=> $this->user_id,
			'meta_key' 		=> $this->meta_key,
			'meta_value' 	=> $this->meta_value,
		);
	}

	public function exchangeArray( array $array ) {
		$this->umeta_id 	= $array['umeta_id'];
		$this->user_id 		= $array['user_id'];
		$this->meta_key 	= $array['meta_key'];
		$this->meta_value	= $array['meta_value'];
	}
}
