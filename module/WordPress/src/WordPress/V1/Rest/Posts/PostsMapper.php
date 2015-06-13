<?php
namespace WordPress\V1\Rest\Posts;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class PostsMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'posts' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a post.
	 *
	 * @access public
	 * @param  mixed $data
	 * @return boolean
	 */
	public function create_post( $data ) {
		$required = array('post_content', 'post_title', 'post_author');

		foreach ( $required as $value ) {
			if ( ! array_key_exists( $value, $data ) ) {
				return new ApiProblem(503, 'This method requires the following fields: ' . implode( ', ', $required ) );
			}
		}

		$defaults 	= array();

		$params 	= wp_parse_args( $data, $defaults );

		$post 		= wp_insert_post( $params );

		if ( $post ) {
			return true;
		} else {
			return new ApiProblem( 503, 'There was an error creating the entity.' );
		}
	}

	/**
	 * Deletes a post.
	 *
	 * @access public
	 * @param  int $id The ID of the post to delete.
	 * @return boolean
	 */
	public function delete_post( $id ) {
		$deletion = wp_delete_post( $id );

		if ( $deletion ) {
			return true;
		} else {
			return new ApiProblem( 503, 'There was an error deleting the entity.' );
		}
	}

	/**
	 * Fetches a single post.
	 *
	 * @access public
	 * @param  int $id The ID of the post to fetch.
	 * @return mixed
	 */
	public function fetch_post( $id ) {
		// Prepare the SQL query.
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE id = %d", $id );

		// Run the query.
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( $data ) {
			// Hydrate the Posts Entity.
			$entity = new PostsEntity;
			$entity->exchangeArray( $data[0] );
			return $entity;
		}
		return false;
	}

	/**
	 * Fetches all posts.
	 *
	 * @access public
	 * @param  array $params Optional params to filter by.
	 * @return mixed
	 */
	public function fetch_posts( $params = array() ) {
		// Run the query.
		$data 	= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );

		if ( $data ) {

			// Compile into a collection and return.
			$paginator_adapter 	= new ArrayAdapter( $data );
			$collection 		= new PostsCollection( $paginator_adapter );
			return $collection;

		}

		return false;
	}

	/**
	 * Updates an existing post.
	 *
	 * @access public
	 * @param  int 		$id 	The ID of the post to update.
	 * @param  mixed 	$data 	The data to update with.
	 * @return boolean
	 */
	public function update_post( $id, $data ) {

	}
}
