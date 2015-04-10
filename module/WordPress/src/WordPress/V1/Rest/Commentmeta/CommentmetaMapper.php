<?php
namespace WordPress\V1\Rest\Commentmeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class CommentmetaMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {
		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'commentmeta';
	}

	public function create_meta( $data ) {
		$create = add_comment_meta( $data->comment_id, $data->meta_key, $data->meta_value );
		if ( $create ) {
			return true;
		}
		return false;
	}

	public function delete_meta( $id ) {

	}

	public function fetch_meta( $id ) {

	}

	public function fetch_all_meta( $params ) {
		file_put_contents('/Users/matt/Repositories/test.txt', var_dump( $_REQUEST ) );
		return false;
	}

	public function update_meta( $data ) {

	}

}
