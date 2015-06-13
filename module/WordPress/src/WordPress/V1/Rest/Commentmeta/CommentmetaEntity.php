<?php
namespace WordPress\V1\Rest\Commentmeta;

class CommentmetaEntity
{
	public $meta_id;

	public $comment_id;

	public $meta_key;

	public $meta_value;

	public function getArrayCopy() {
		return array(
			'meta_id' 		=> $this->meta_id,
			'comment_id' 	=> $this->comment_id,
			'meta_key' 		=> $this->meta_key,
			'meta_value' 	=> $this->meta_value,
		);
	}

	public function exchangeArray( array $array ) {
		$this->meta_id 		= $array['meta_id'];
		$this->comment_id 	= $array['comment_id'];
		$this->meta_key 	= $array['meta_key'];
		$this->meta_value	= $array['meta_value'];
	}
}
