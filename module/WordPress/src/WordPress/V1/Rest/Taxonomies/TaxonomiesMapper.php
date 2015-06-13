<?php
namespace WordPress\V1\Rest\Taxonomies;

use ZF\ApiProblem\ApiProblem;
use Zend\Paginator\Adapter\ArrayAdapter;

class TaxonomiesMapper {

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
		$this->table_name = esc_sql( $wpdb->prefix . 'taxonomy' );

		// Let WordPress know we served an API request.
		define( 'RESTFULWP_REQUEST_SERVED', true );

	}

}
