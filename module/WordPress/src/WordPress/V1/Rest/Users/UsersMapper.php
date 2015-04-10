<?php
namespace WordPress\V1\Rest\Users;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsersMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {

		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'users';
	}

	public function create_user( $data ) {
		$user = wp_insert_user( $data );
		if ( $user ) {
			return true;
		}
		return false;
	}

	public function delete_user( $id ) {
		$deletion = wp_delete_user( $id );
		if ( $deletion ) {
			return true;
		}
		return false;
	}

	public function fetch_user( $id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE ID = %d", $id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		$entity = new UsersEntity();
		$entity->exchangeArray( $data[0] );
		return $entity;
	}

	public function fetch_users() {
		$data 				= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );
		$paginator_adapter 	= new ArrayAdapter( $data );
		$collection 		= new UsersCollection( $paginator_adapter );
		return $collection;
	}

	public function update_user( $id, $data ) {
		$update = wp_update_user( $data );

		if ( $update ) {
			return true;
		}
		return false;
	}

}
