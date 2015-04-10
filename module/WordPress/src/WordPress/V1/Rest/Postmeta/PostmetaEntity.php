<?php
namespace WordPress\V1\Rest\Postmeta;

class PostmetaEntity
{
	public $meta_id;

	public $post_id;

	public $meta_key;

	public $meta_value;

	public function getArrayCopy() {
		return array(
			'meta_id' 		=> $this->meta_id,
			'post_id' 		=> $this->post_id,
			'meta_key' 		=> $this->meta_key,
			'meta_value' 	=> $this->meta_value,
		);
	}

	public function exchangeArray( array $array ) {
		$this->meta_id 		= $array['meta_id'];
		$this->post_id 		= $array['post_id'];
		$this->meta_key 	= $array['meta_key'];
		$this->meta_value	= $array['meta_value'];
	}
}
