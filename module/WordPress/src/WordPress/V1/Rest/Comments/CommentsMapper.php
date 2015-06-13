<?php
namespace WordPress\V1\Rest\Comments;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class CommentsMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'comments' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a comment.
	 *
	 * @access public
	 * @param  mixed $data
	 * @return boolean
	 */
	public function create_comment( $data ) {
		$args = get_object_vars( $data );
		if ( wp_insert_comment( $args ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Deletes a comment with the provided ID.
	 *
	 * @access public
	 * @param  int $id The ID of the comment to delete.
	 * @return boolean
	 */
	public function delete_comment( $id ) {
		return wp_delete_comment( $id );
	}

	/**
	 * Fetch info about a comment with the provided ID.
	 *
	 * @access public
	 * @param  int $id The ID of the comment to retrieve.
	 * @return mixed
	 */
	public function fetch_comment( $id ) {
		$query 		= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE comment_ID = %s", $id );
		$results 	= $this->wpdb->get_results( $query, ARRAY_A );

		if ( ! $results ) return false;

		$entity = new CommentsEntity();
		$entity->exchangeArray( $results[0] );
		return $entity;
	}

	/**
	 * Fetches all comments
	 *
	 * @access public
	 * @param  array $params
	 */
	public function fetch_comments( $params ) {
		$data = $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );
		if ( $data ) {
			$paginator_adapter = new ArrayAdapter( $data );
			$collection = new CommentsCollection( $paginator_adapter );
			return $collection;
		}
		return false;
	}

	/**
	 * Updates an existing comment.
	 *
	 * @access public
	 * @param  int $id The ID of the comment.
	 */
	public function update_comment( $id, $data ) {
		$args = get_object_vars( $data );
		return wp_update_comment( $args );
	}
}
