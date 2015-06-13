<?php
namespace WordPress\V1\Rest\Options;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class OptionsMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'options' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

	/**
	 * Creates a new option.
	 *
	 * @access public
	 * @param  object $data
	 * @return boolean
	 */
	public function create_option( $data ) {
		return add_option( $data->option_name, $data->option_value );
	}

	/**
	 * Deletes an option with the provided option_name.
	 *
	 * @access public
	 * @param  string $id The WordPress option name.
	 * @return boolean
	 */
	public function delete_option( $id ) {
		return delete_option( $id );
	}

	/**
	 * Fetches an option with the provided option_name.
	 *
	 * @access public
	 * @param  string $id The option_name of the option to get.
	 * @return mixed
	 */
	public function fetch_option( $id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE option_name = %s", $id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( ! $data ) return false;

		$entity = new OptionsEntity();
		$entity->exchangeArray( $data[0] );
		return $entity;
	}

	/**
	 * Gets all options.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fetch_options() {
		$data 				= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );

		if ( ! $data ) return false;

		$paginator_adapter 	= new ArrayAdapter( $data );
		$collection 		= new OptionsCollection( $paginator_adapter );
		return $collection;
	}

	/**
	 * Updates an option with the provided option_name.
	 *
	 * @access public
	 * @param  string $id 	The WordPress option name.
	 * @param  object $data The data to update.
	 * @return boolean
	 */
	public function update_option( $id, $data ) {
		return update_option( $id, $data->option_value );
	}
}
