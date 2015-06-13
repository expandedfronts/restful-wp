<?php
namespace WordPress\V1\Rest\Commentmeta;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class CommentmetaMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'commentmeta' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a new commentmeta.
	 *
	 * @access public
	 * @param  object $data The data to create the comment.
	 * @return boolean
	 */
	public function create_meta( $data ) {
		return add_comment_meta( $data->comment_id, $data->meta_key, $data->meta_value );
	}

	/**
	 * Deletes the specified commentmeta.
	 *
	 * @access public
	 * @param  string $id The commentmeta key to delete.
	 * @return boolean
	 */
	public function delete_meta( $id, $comment_id ) {
		return delete_comment_meta( $comment_id, $id );
	}

	/**
	 * Fetches a single commentmeta value.
	 *
	 * @access public
	 * @param  string $id The commentmeta key to retrieve.
	 * @param  int
	 * @return boolean
	 */
	public function fetch_meta( $id, $comment_id ) {
		$comment_meta = get_comment_meta( $comment_id, $id );

		if ( $comment_meta ) {
			$entity = new CommentmetaEntity();
			$entity->exchangeArray( $comment_meta[0] );
			return $entity;
		}
		return false;
	}

	/**
	 * Retrieves all commentmeta for a comment.
	 *
	 * @access public
	 * @param  $params
	 * @return boolean
	 */
	public function fetch_all_meta( $params, $comment_id ) {
		$data = get_comment_meta( $comment_id );

		if ( $data ) {
			$paginator_adapter = new ArrayAdapter( $data );
			$collection = new CommentsCollection( $paginator_adapter );
			return $collection;
		}

		return false;
	}

	/**
	 * Updates an existing commentmeta.
	 *
	 * @access public
	 * @param  string 	$id 		The commentmeta key.
	 * @param  object 	$data 		The data object.
	 * @param  int 		$comment_id The parent comment.
	 * @return boolean
	 */
	public function update_meta( $id, $data, $comment_id ) {
		return update_comment_meta( $comment_id, $data->meta_key, $$data->meta_value );
	}

}
