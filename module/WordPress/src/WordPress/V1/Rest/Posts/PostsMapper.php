<?php
namespace WordPress\V1\Rest\Posts;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class PostsMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {
		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'posts';
	}

	public function create_post( $data ) {

		$required = array('post_content', 'post_title', 'post_author');

		foreach ( $required as $value ) {
			if ( array_key_exists( $value, $data ) ) {
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

	public function delete_post( $id ) {
		$deletion = wp_delete_post( $id );

		if ( $deletion ) {
			return true;
		} else {
			return new ApiProblem( 503, 'There was an error deleting the entity.' );
		}
	}

	public function fetch_posts( $params ) {
		// Run the query.
		$data 	= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );

		// Compile into a collection and return.
		$paginator_adapter 	= new ArrayAdapter( $data );
		$collection 		= new PostsCollection( $paginator_adapter );
		return $collection;
	}

	public function fetch_post( $post_id ) {
		// Prepare the SQL query.
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE id = %d", $post_id );

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
}
