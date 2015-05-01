<?php
namespace WordPress\V1\Rest\Comments;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class CommentsMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {
		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'comments';

		define( 'WP_SHOULD_EXIT', true );
	}

	public function create_comment( $data ) {
		$comment = wp_insert_comment( $data );
		if ( $comment ) {
			return true;
		}
		return false;
	}

	public function delete_comment( $id ) {
		$deletion = wp_delete_comment( $id );
		if ( $deletion ) {
			return true;
		}
		return false;
	}

	public function fetch_comment( $id ) {
		$comment = get_comment( $id, ARRAY_A );
		if ( $comment ) {
			$entity = new CommentsEntity();
			$entity->exchangeArray( $comment[0] );
			return $entity;
		}
		return false;
	}

	public function fetch_comments( $params ) {
		$data = $this->wpdb->get_results( "SELECT * FROM $this->table_name", $params );
		if ( $data ) {
			$paginator_adapter = new ArrayAdapter( $data );
			$collection = new CommentsCollection( $paginator_adapter );
			return $collection;
		}
		return false;
	}

	public function update_comment( $id, $data ) {
		$update = wp_update_comment( $data );
		if ( $update ) {
			return true;
		}
		return false;
	}
}
