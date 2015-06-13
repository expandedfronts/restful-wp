<?php
namespace WordPress\V1\Rest\Users;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsersMapper {

	/**
	 * The WordPress database object.
	 * @var WPDB
	 */
	protected $wpdb;

	/**
	 * Stores the table name for this endpoint.
	 * @var string
	 */
	protected $table_name;

	/**
	 * Constructs the class.
	 *
	 * @access public
	 */
	public function __construct() {

		// Initialize the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Builds the table name to use for the mapper.
		$this->table_name = esc_sql( $wpdb->prefix . 'users' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a user.
	 *
	 * @access public
	 * @param  mixed $data
	 * @return boolean
	 */
	public function create_user( $data ) {
		return wp_insert_user( $data );
	}

	/**
	 * Deletes a user.
	 *
	 * @access public
	 * @param  int $id The ID of the user to delete.
	 * @return boolean
	 */
	public function delete_user( $id ) {
		return wp_delete_user( $id );
	}

	/**
	 * Fetches info on a user.
	 *
	 * @access public
	 * @param  int $id The ID of the user to fetch.
	 * @return mixed
	 */
	public function fetch_user( $id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE ID = %d", $id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( ! $data ) return false;

		$entity = new UsersEntity();
		$entity->exchangeArray( $data[0] );
		return $entity;
	}

	/**
	 * Fetches all users.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fetch_users( $params = array() ) {
		$data 				= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );

		if ( ! $data ) return false;

		$paginator_adapter 	= new ArrayAdapter( $data );
		$collection 		= new UsersCollection( $paginator_adapter );
		return $collection;
	}

	/**
	 * Updates a user.
	 *
	 * @access public
	 * @param  mixed $data
	 * @return boolean
	 */
	public function update_user( $id, $data ) {
		return wp_update_user( $data );
	}
}
