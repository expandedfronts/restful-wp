<?php
namespace WordPress\V1\Rest\Posts;

class PostsEntity
{
	public $post_id;

	public $post_author;

	public $post_date;

	public $post_date_gmt;

	public $post_content;

	public $post_title;

	public $post_excerpt;

	public $post_status;

	public $comment_status;

	public $ping_status;

	public $to_ping;

	public $pinged;

	public $post_modified;

	public $post_modified_gmt;

	public $post_content_filtered;

	public $post_parent;

	public $guid;

	public $menu_order;

	public $post_type;

	public $post_mime_type;

	public $comment_count;

	public function getArrayCopy() {
		return array(
			'ID' 					=> $this->post_id,
			'post_author' 			=> $this->post_author,
			'post_date' 			=> $this->post_date,
			'post_date_gmt' 		=> $this->post_date_gmt,
			'post_content' 			=> $this->post_content,
			'post_title' 			=> $this->post_title,
			'post_excerpt' 			=> $this->post_excerpt,
			'post_status' 			=> $this->post_status,
			'to_ping' 				=> $this->to_ping,
			'post_modified' 		=> $this->post_modified,
			'post_modified_gmt' 	=> $this->post_modified_gmt,
			'post_content_filtered' => $this->post_content_filtered,
			'post_parent' 			=> $this->post_parent,
			'guid' 					=> $this->guid,
			'menu_order' 			=> $this->menu_order,
			'post_type' 			=> $this->post_type,
			'post_mime_type' 		=> $this->post_mime_type,
			'comment_count' 		=> $this->comment_count,
		);
	}

	public function exchangeArray(array $array) {
		$this->post_id					= $array['ID'];
		$this->post_author 				= $array['post_author'];
		$this->post_date 				= $array['post_date'];
		$this->post_date_gmt 			= $array['post_date_gmt'];
		$this->post_content 			= $array['post_content'];
		$this->post_title 				= $array['post_title'];
		$this->post_excerpt 			= $array['post_excerpt'];
		$this->post_status 				= $array['post_status'];
		$this->comment_status 			= $array['comment_status'];
		$this->ping_status 				= $array['ping_status'];
		$this->to_ping 					= $array['to_ping'];
		$this->pinged 					= $array['pinged'];
		$this->post_modified 			= $array['post_modified'];
		$this->post_modified_gmt 		= $array['post_modified_gmt'];
		$this->post_content_filtered 	= $array['post_content_filtered'];
		$this->post_parent 				= $array['post_parent'];
		$this->guid 					= $array['guid'];
		$this->menu_order 				= $array['menu_order'];
		$this->post_type 				= $array['post_type'];
		$this->post_mime_type 			= $array['post_mime_type'];
		$this->comment_count 			= $array['comment_count'];
	}

}
