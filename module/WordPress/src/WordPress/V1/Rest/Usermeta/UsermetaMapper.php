<?php
namespace WordPress\V1\Rest\Usermeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsermetaMapper {

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
	 * @access public
	 */
	public function __construct() {

		// Initialize the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Builds the table name to use for the mapper.
		$this->table_name = esc_sql( $wpdb->prefix . 'usermeta' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a usermeta.
	 *
	 * @access public
	 * @param  mixed 	$data
	 * @param  int 		$user_id The ID of the parent user.
	 * @return boolean
	 */
	public function create_meta( $data, $user_id ) {
		$add = add_user_meta( $user_id, $data->meta_key, $data->meta_value );
		if ( ! $add ) {
			return false;
		}
		return true;
	}

	/**
	 * Deletes a usermeta.
	 *
	 * @access public
	 * @param  string 	$id 		The meta_key of the meta to delete.
	 * @param  int 		$user_id 	The ID of the parent user.
	 * @return boolean
	 */
	public function delete_meta( $id, $user_id ) {
		return delete_user_meta( $user_id, $id );
	}

	/**
	 * Fetches a single usermeta by meta_key.
	 *
	 * @access public
	 * @param  string 	$id 		The meta_key of the meta to fetch.
	 * @param  int 		$user_id 	The ID of the parent user.
	 * @return mixed
	 */
	public function fetch_meta( $id, $user_id ) {
		$query = $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE user_id = %s AND meta_key = %s", $user_id, $id );
		$result = $this->wpdb->get_results( $query, ARRAY_A );

		if ( ! $result ) return false;

		$entity = new UsermetaEntity();
		$entity->exchangeArray( $result[0] );
		return $entity;
	}

	/**
	 * Fetches all meta for a user.
	 *
	 * @access public
	 * @param  array $params Optional parameters to filter by.
	 * @param  int 		$user_id The ID of the parent user.
	 * @return mixed
	 */
	public function fetch_all_meta( $params, $user_id ) {
		$query = $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE user_id = %s", $user_id );
		$result = $this->wpdb->get_results( $query, ARRAY_A );

		if ( ! $result ) return false;

		$paginator_adapter 	= new ArrayAdapter( $result );
		$collection 		= new UsermetaCollection( $paginator_adapter );
		return $collection;
	}

	/**
	 * Updates a meta value.
	 *
	 * @access public
	 * @param  string 	$id 		The meta_key to update.
	 * @param  mixed 	$data
	 * @param  int 		$user_id 	The ID of the parent user.
	 * @return boolean
	 */
	public function update_meta( $id, $data, $user_id ) {
		$update = update_user_meta( $user_id, $data->meta_key, $data->meta_value );
		if ( ! $update ) {
			return false;
		}
		return true;
	}
}
