<?php
namespace WordPress\V1\Rest\Postmeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class PostmetaMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {
		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'postmeta';
	}

	public function create_meta( $data, $post_id ) {
		if ( ! add_post_meta( $post_id, $data->meta_key, $data->meta_value, true ) ) {
			return false;
		}
		return true;
	}

	public function delete_meta( $id, $post_id ) {
		if ( ! delete_post_meta( $post_id, $id ) ) {
			return false;
		}
		return true;
	}

	public function fetch_meta( $id, $post_id ) {
		$sql = $this->wpdb->prepare( "SELECT * FROM $this->table_name  WHERE post_id = %d and meta_key = %s", $post_id, $id );
		$data = $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			// Hydrate the Postmeta Entity.
			$entity = new PostmetaEntity;
			$entity->exchangeArray( $data[0] );
			return $entity;
		}
		return false;
	}

	public function fetch_all_meta( $params, $post_id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE post_id = %d", $post_id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			$paginator_adapter = new ArrayAdapter( $data );
			$collection = new PostmetaCollection( $paginator_adapter );
			return $collection;
		}
		return false;
	}

	public function update_meta( $id, $data, $post_id ) {
		if ( ! update_post_meta( $post_id, $id, $data->meta_value ) ) {
			return false;
		}
		return true;
	}

}
