<?php
namespace WordPress\V1\Rest\Postmeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class PostmetaMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'postmeta' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a postmeta.
	 *
	 * @access public
	 * @param  mixed $data
	 * @param  int The ID of the parent post.
	 * @return boolean
	 */
	public function create_meta( $data, $post_id ) {
		return add_post_meta( $post_id, $data->meta_key, $data->meta_value, true );
	}

	/**
	 * Deletes a postmeta
	 *
	 * @access public
	 * @param  int $id 		The meta_key of the postmeta to delete.
	 * @param  int $post_id The ID of the parent post.
	 * @return boolean
	 */
	public function delete_meta( $id, $post_id ) {
		return delete_post_meta( $post_id, $id );
	}

	/**
	 * Fetches a postmeta value.
	 *
	 * @access public
	 * @param  int $id 		The meta_key of the postmeta to fetch.
	 * @param  int $post_id The ID of the parent post.
	 * @return boolean
	 */
	public function fetch_meta( $id, $post_id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name  WHERE post_id = %d and meta_key = %s", $post_id, $id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			// Hydrate the Postmeta Entity.
			$entity = new PostmetaEntity;
			$entity->exchangeArray( $data[0] );
			return $entity;
		}
		return false;
	}

	/**
	 * Fetches all meta for a post.
	 *
	 * @access 	public
	 * @param  	array  	$params 	Any parameters to filter by.
	 * @param  	int 		$post_id 	The ID of the post to fetch meta for.
	 * @return 	mixed
	 */
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

	/**
	 * Updates an existing meta for a post.
	 *
	 * @access 	public
	 * @param 	mixed 	$data
	 * @param 	int 	$post_id The ID of the parent post.
	 * @return 	boolean
	 */
	public function update_meta( $id, $data, $post_id ) {
		return update_post_meta( $post_id, $id, $data->meta_value );
	}

}
