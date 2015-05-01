<?php
namespace WordPress\V1\Rest\Options;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class OptionsMapper {

	protected $wpdb;

	protected $table_name;

	public function __construct() {
		// Store the WordPress database object.
		global $wpdb;
		$this->wpdb = $wpdb;

		// Build the table name to use for this mapper.
		$this->table_name = $this->wpdb->prefix . 'options';

		define( 'WP_SHOULD_EXIT', true );
	}

	public function create_option( $data ) {
		$option = add_option( $data->option_name, $data->option_value );

		if ( ! $option ) {
			return false;
		} else {
			return true;
		}
	}

	public function delete_option( $id ) {
		$deletion = delete_option( $id );

		if ( $deletion ) {
			return true;
		}
		return false;
	}

	public function fetch_option( $id ) {
		$sql 	= $this->wpdb->prepare( "SELECT * FROM $this->table_name WHERE option_name = %s", $id );
		$data 	= $this->wpdb->get_results( $sql, ARRAY_A );

		if ( ! $data ) {
			return false;
		}

		$entity = new OptionsEntity();
		$entity->exchangeArray( $data[0] );
		return $entity;
	}

	public function fetch_options() {
		$data 				= $this->wpdb->get_results( "SELECT * FROM $this->table_name", ARRAY_A );
		$paginator_adapter 	= new ArrayAdapter( $data );
		$collection 		= new OptionsCollection( $paginator_adapter );
		return $collection;
	}

	public function update_option( $id, $data ) {
		var_dump( $_SERVER );
		$update = update_option( $id, $data->option_value );

		if ( $update ) {
			return true;
		}
		return false;
	}
}
