<?php
namespace WordPress\V1\Rest\Comments;

class CommentsEntity
{
	public $comment_ID;
	public $comment_post_ID;
	public $comment_author;
	public $comment_author_email;
	public $comment_author_url;
	public $comment_author_IP;
	public $comment_date;
	public $comment_date_gmt;
	public $comment_content;
	public $comment_karma;
	public $comment_approved;
	public $comment_agent;
	public $comment_type;
	public $comment_parent;
	public $user_id;

	public function getArrayCopy() {
		return array(
			'comment_ID' 			=> $this->comment_ID,
			'comment_post_ID' 		=> $this->comment_post_ID,
			'comment_author' 		=> $this->comment_author,
			'comment_author_email' 	=> $this->comment_author_email,
			'comment_author_url' 	=> $this->comment_author_url,
			'comment_author_IP' 	=> $this->comment_author_IP,
			'comment_date' 			=> $this->comment_date,
			'comment_date_gmt' 		=> $this->comment_date_gmt,
			'comment_content' 		=> $this->comment_content,
			'comment_karma' 		=> $this->comment_karma,
			'comment_approved' 		=> $this->comment_approved,
			'comment_agent' 		=> $this->comment_agent,
			'comment_type' 			=> $this->comment_type,
			'comment_parent' 		=> $this->comment_parent,
			'user_id' 				=> $this->user_id,
		);
	}

	public function exchangeArray( array $array ) {
		$this->comment_ID 			= $array['comment_ID'];
		$this->comment_post_ID 		= $array['comment_post_ID'];
		$this->comment_author 		= $array['comment_author'];
		$this->comment_author_email = $array['comment_author_email'];
		$this->comment_author_url 	= $array['comment_author_url'];
		$this->comment_author_IP 	= $array['comment_author_IP'];
		$this->comment_date 		= $array['comment_date'];
		$this->comment_date_gmt 	= $array['comment_date_gmt'];
		$this->comment_content 		= $array['comment_content'];
		$this->comment_karma 		= $array['comment_karma'];
		$this->comment_approved 	= $array['comment_approved'];
		$this->comment_agent 		= $array['comment_agent'];
		$this->comment_type 		= $array['comment_type'];
		$this->comment_parent 		= $array['comment_parent'];
		$this->user_id 				= $array['user_id'];
	}
}
