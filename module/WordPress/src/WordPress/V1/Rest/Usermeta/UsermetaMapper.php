<?php
namespace WordPress\V1\Rest\Usermeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsermetaMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {

		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'usermeta';

		define( 'WP_SHOULD_EXIT', true );
	}

	public function create_meta( $data, $user_id ) {
		if ( ! add_user_meta( $user_id, $data->meta_key, $data->meta_value ) ) {
			return false;
		}
		return true;
	}

	public function delete_meta( $id, $user_id ) {
		if ( ! delete_user_meta( $user_id, $id ) ) {
			return false;
		}
		return true;
	}

	public function fetch_meta( $id, $user_id ) {
		$sql = $this->wpdb->prepare( "SELECT * FROM $this->table_name  WHERE meta_key = %s AND user_id = %d", $id, $user_id );
		$data = $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			// Hydrate the Usermeta Entity.
			$entity = new UsermetaEntity;
			$entity->exchangeArray( $data[0] );
			return $entity;
		}
		return false;

	}

	public function fetch_all_meta( $params, $user_id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE user_id = %s", $user_id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			$paginator_adapter = new ArrayAdapter( $data );
			$collection = new UsermetaCollection( $paginator_adapter );
			return $collection;
		}
		return false;
	}

	public function update_meta( $id, $data, $user_id ) {
		if ( ! update_user_meta( $user_id, $id, $data->meta_value ) ) {
			return false;
		}
		return true;
	}

}
